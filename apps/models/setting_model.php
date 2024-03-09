<?php
class Setting_model extends Model
{
	## LOG ACTIVITY
	public function logActivity($type = null, $activity = null, $opsi = "INSERT")
	{
		global $config, $db;
		
		$data = array(
			'userId'		=> ($_SESSION['SESS_ID']) ? $_SESSION['SESS_ID'] : 0,
			'logType'		=> $type,
			'logActivity'	=> $activity,
			'logIP'			=> GetIP(),
			'createdTime'	=> date('YmdHis')
		); 
		if($opsi == "INSERT"){ 
			$db->insert("tbl_log", $data)->getLastInsertId(); 
		}else{ 
			$db->update('tbl_log', $data, array('logType' => 'referer', 'logIP' => GetIP()))->affectedRows(); 
		}
	}
	
	# HOME
    public function getMenu_home($menuParent = 0, $where = null)
	{
		global $config, $db;
		
		if($menuParent != null){
			$idA = " AND menuParent = ".$menuParent;
		}
		$result = $db->query("SELECT m.*, u.groupId, g.groupName, group_concat(gp.permissionId) permissionId FROM
				tbl_users u
				LEFT JOIN tbl_group g ON u.groupId = g.groupId
				LEFT JOIN tbl_group_perms gp ON g.groupId = gp.groupId
				LEFT JOIN tbl_menu m ON gp.menuId = m.menuId
				WHERE g.groupId = ".$_SESSION['SESS_GROUP'].$idA.$where." 
				GROUP BY m.menuId ORDER BY m.short asc")->results();
		return $result;
    }
	
	# TBL_PARAMETER
	public function getParameter_id($id = null, $where = null)
	{
		global $config, $db;
		
		$idA = "";
        if($id != null){
            $idA = " AND param_id = ".$id;
        }
		$result = $db->query("SELECT * FROM tbl_parameter WHERE 1 ".$idA.$where)->results();	
		return $result;
    }
	
	# TBL_GROUP
	public function getGroup_id($id = null, $where = null)
	{
		global $config, $db;
		
		$idA = "";
        if($id != null){
            $idA = " AND groupId = ".$id;
        }
		$result = $db->query("SELECT * FROM tbl_group WHERE 1 ".$idA.$where)->results();	
		return $result;
    }
	
	## USER LIST
	public function getAllUser($id = null, $isActive = null, $where = null)
	{
		global $config, $db;
		
		if($isActive != null){
			$is_a = " AND u.active = '1'";
		}
        if($id != null){
            $is_b = " AND u.userId = ".$id;
        }
		
		$query = "SELECT u.*, g.groupId, g.groupName 
			FROM tbl_users u 
			LEFT JOIN tbl_group g ON u.groupId = g.groupId
			WHERE 1 ".$is_a.$is_b.$where;
		$result = $db->query($query)->results();
		return $result;
    }
}