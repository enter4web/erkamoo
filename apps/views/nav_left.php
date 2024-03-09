		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo ($getUsr[0]->usrImg == null) ? BASE_URL."assets/images/avatar.png" : BASE_URL."assets/upload/profile/".$getUsr[0]->usrImg; ?>" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p style="/* white-space: pre-wrap;      CSS3 */   
						   white-space: -moz-pre-wrap; /* Firefox */    
						   white-space: -pre-wrap;     /* Opera <7 */   
						   white-space: -o-pre-wrap;   /* Opera 7 */    
						   word-wrap: break-word;      /* IE */">
							<?php echo textExplode($getUsr[0]->fullName, ","); ?>
						</p>
						<a href="#"><i class="fa fa-circle text-success"></i> <?php echo $_SESSION['SESS_GROUP_NAME']; ?></a>
					</div>
				</div>
				
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<?php
					if($leftMenu)
					{
						$refs = array();
						$list = array();
						
						foreach($leftMenu as $leftMenu)
						{
							$thisref = &$refs[$leftMenu->menuId];
							$thisref['menuParent'] = $leftMenu->menuParent;
							$thisref['menuName'] = $leftMenu->menuName;
							$thisref['menuLink'] = $leftMenu->menuLink;
							$thisref['menuIcon'] = $leftMenu->menuIcon;
							$thisref['menuDesc'] = $leftMenu->menuDesc;
							
							if($leftMenu->menuParent == 0){
								$list[$leftMenu->menuId] = &$thisref;
							}
							else{
								$refs[$leftMenu->menuParent]['children'][$leftMenu->menuId] = &$thisref;
							}
						}
						function create_list($arr, $urutan)
						{
							if($urutan==0){
								$html = '';
							}
							else{
								$html = '<ul class="treeview-menu">';
							}
							foreach($arr as $key=>$v)
							{
								if(array_key_exists('children', $v)){
									$html .= '<li class="treeview '.$v['menuDesc'].'">';
									$html .= '<a href="#">
												<i class="'.$v['menuIcon'].'"></i> <span>'.$v['menuName'].'</span>
												<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
											</a>';
									$html .= create_list($v['children'],1);
									$html .= "</li>";
								}
								else{
									if($urutan==0){
										$html .= '<li class="'.$v['menuDesc'].'"><a href="'.BASE_URL.$v['menuLink'].'"><i class="'.$v['menuIcon'].'"></i> <span>'.$v['menuName'].'</span></a></li>';
									}
									else{
										$html .= '<li class="'.$v['menuDesc'].'"><a href="'.BASE_URL.$v['menuLink'].'"><i class="'.$v['menuIcon'].'"></i> '.$v['menuName'].'</a></li>';
									}
								}
							}
							if($urutan==0){
								$html .= "";
							}
							else{
								$html .= "</ul>";
							}
							return $html;
						}
						echo create_list($list, 0);
					}
					?>
				</ul>
			</section>
		</aside>