<?php

// REDIRECT
function redirect($page) 
{
    header('Location: ' . $page);
}

function redirect_js($page) 
{
	echo "<script>window.open('$page');</script>";
}

function redirect_meta($page, $time = 0) 
{
	echo '<meta http-equiv="refresh" content="'.$time.'; url='.$page.'">';
}

// CONVERT TO TEXT
function to_text($x) 
{
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x < 12) {
        $temp = " ". $angka[$x];
    } else if ($x < 20) {
        $temp = to_text($x - 10). " belas";
    } else if ($x < 100) {
        $temp = to_text($x/10)." puluh". to_text($x % 10);
    } else if ($x < 200) {
        $temp = " seratus" . to_text($x - 100);
    } else if ($x < 1000) {
        $temp = to_text($x/100) . " ratus" . to_text($x % 100);
    } else if ($x < 2000) {
        $temp = " seribu" . to_text($x - 1000);
    } else if ($x < 1000000) {
        $temp = to_text($x/1000) . " ribu" . to_text($x % 1000);
    } else if ($x < 1000000000) {
        $temp = to_text($x/1000000) . " juta" . to_text($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = to_text($x/1000000000) . " milyar" . to_text(fmod($x,1000000000));
    } else if ($x < 1000000000000000) {
        $temp = to_text($x/1000000000000) . " trilyun" . to_text(fmod($x,1000000000000));
    }     
    return $temp;
}

function tkoma($x)
{
	$str = stristr($x,".");
	$ex = explode('.',$x);

	if(($ex[1]/10) >= 1){
		$a = abs($ex[1]);
	}
	$string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
	$temp = "";

	$a2 = $ex[1]/10;
	$pjg = strlen($str);
	$i =1;


	if($a>=1 && $a< 12){   
		$temp .= " ".$string[$a];
	}
	else if($a>12 && $a < 20){   
		$temp .= to_text($a - 10)." belas";
	}
	else if ($a>20 && $a<100){   
		$temp .= to_text($a / 10)." puluh". to_text($a % 10);
	}
	else{
		if($a2<1){
			while ($i<$pjg){    
				$char = substr($str,$i,1);     
				$i++;
				$temp .= " ".$string[$char];
			}
		}
	}  
	return $temp;
}

function terbilang($x, $style=4) 
{
    if($x<0) {
        $hasil = "minus ". trim(to_text($x));
    }
	else {
		$poin = trim(tkoma($x));
        $hasil = trim(to_text($x));
    }
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }
	if($poin)
	{
		$hasil = $hasil." koma ".$poin;
	}
	else{
		$hasil = $hasil;
	}
    return $hasil;
}

function tampil_bulan($x = null)
{
    $bulan = array (
		1	=> 'Januari',
		2	=> 'Februari',
		3	=> 'Maret',
		4	=> 'April',
		5	=> 'Mei',
		6	=> 'Juni',
		7	=> 'Juli',
		8	=> 'Agustus',
		9	=> 'September',
		10	=> 'Oktober',
		11	=> 'November',
		12	=> 'Desember');
	if($x == null)
		return $bulan;
	else
		return $bulan[$x];
}

function to_romawi($angka){
    $hsl = "";
    if($angka<1||$angka>3999){
        $hsl = "Batas Angka 1 s/d 3999";
    }else{
         while($angka>=1000){
             $hsl .= "M"; $angka -= 1000;
         }
         if($angka>=500){
             if($angka>500){
                 if($angka>=900){
                     $hsl .= "M"; $angka-=900;
                 }else{
                     $hsl .= "D"; $angka-=500;
                 }
             }
         }
         while($angka>=100){
             if($angka>=400){
                 $hsl .= "CD"; $angka-=400;
             }else{
                 $angka-=100;
             }
         }
         if($angka>=50){
             if($angka>=90){
                 $hsl .= "XC"; $angka-=90;
             }else{
                $hsl .= "L"; $angka-=50;
             }
         }
         while($angka>=10){
             if($angka>=40){
                $hsl .= "XL"; $angka-=40;
             }else{
                $hsl .= "X"; $angka-=10;
             }
         }
         if($angka>=5){
             if($angka==9){
                 $hsl .= "IX"; $angka-=9;
             }else{
                $hsl .= "V"; $angka-=5;
             }
         }
         while($angka>=1){
             if($angka==4){
                $hsl .= "IV"; $angka-=4;
             }else{
                $hsl .= "I"; $angka-=1;
             }
         }
    }
    return ($hsl);
}

function dateMin($per, $n, $d)
{
	switch($per)
	{
		case "yyyy": $n*=12;
		case "m":
			$d = mktime(date("H", $d), date("i", $d)
				, date("s", $d), date("n", $d) - $n
				, date("j", $d), date("Y", $d));
			$n = 0;
			break;
		case "ww": $n*=7;
		case "d": $n*=24;
		case "h": $n*=60;
		case "n": $n*=60;
	}
	return $d - $n;
}

// IP
function GetIP()
{
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
		$ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "unknown";

	return($ip);
}

// GENERAL
function is_true($a, $b, $c)
{
	if ($a)
	{
		return $b;
	}
	return $c;
}

function is_empty($a, $b)
{
	if ((empty($a) || $a == "") && $a != 0)
	{
		return $b;
	}
	return $a;
}

function is_nol($a, $b)
{
	if (is_null($a))
	{
		return $b;
	}
	return $a;
}

function is_selected($a, $b)
{
	if ($a == $b)
	{
		return 'selected="selected"';
	}
	return '';
}

function is_checked($a, $b)
{
	if ($a == $b)
	{
		return 'checked="checked"';
	}
	return '';
}

function to_angka($val) 
{
	$val = preg_replace('/[^a-zA-Z]/','',$val); 
	$val = trim($val, '');
	return $val;
}

function to_number($val) 
{
	$val = preg_replace('/[^0-9]/','',$val); 
	$val = trim($val, '');
	if ($val == "") { $val = 0; }
	return $val;
}

function to_nominal($val)
{
	$isKoma 	= explode(".", $val);
	$spl 	= str_replace(",","",$isKoma[0]);
	if ($spl == ""){
		$res = 0;
	}
	else{
		if($isKoma[1] != null){ $istitik = ".".$isKoma[1]; }else{ $istitik = ""; }
		$res = $spl.$istitik;
	}
	return $res;
}

function to_date($tanggal, $mode) 
{
	$exp = explode(" ", $tanggal);
	$date = $exp[0];
	if(!empty($date))
	{
		$bulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$mshort = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");

		// Y/M/D -> D/M/Y
		if($mode == 'ymd-dmy')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[0];
			$m	= $dt[1];
			$d	= $dt[2];

			$result = $d.'/'.$m.'/'.$y;
		}
		else if($mode == 'ymd-dmyhis')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[0];
			$m	= $dt[1];
			$d	= $dt[2];

			$result = $d.'/'.$m.'/'.$y.' '.$exp[1];
		}
		else if($mode == 'dmy-ymdhis')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[0];
			$m	= $dt[1];
			$y	= $dt[2];

			$result = $y.'/'.$m.'/'.$d.' '.$exp[1];
		}
		else if($mode == 'dmy-ymdhis-')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[0];
			$m	= $dt[1];
			$y	= $dt[2];

			$result = $y.'-'.$m.'-'.$d.' '.$exp[1];
		}
		else if($mode == 'dmy-ymd')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[2];
			$m	= $dt[1];
			$d	= $dt[0];

			$result = $y.'-'.$m.'-'.$d;
		}
		else if($mode == 'dmy-m')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$m	= $dt[1];

			$result = $m;
		}
		else if($mode == 'mdy-ymd')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[2];
			$m	= $dt[0];
			$d	= $dt[1];

			$result = $y.'-'.$m.'-'.$d;
		}
		else if($mode == 'ymd-y')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[0];

			$result = $y;
		}
		else if($mode == 'ymd-m')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$m	= $dt[1];

			$result = $m;
		}
		else if($mode == 'ymd-ym')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[0];
			$m	= $dt[1];

			$result = $y.'-'.$m;
		}
		else if($mode == 'dmy-ym')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[2];
			$m	= $dt[1];

			$result = $y.'-'.$m;
		}
		else if($mode == 'my-ym')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$m	= $dt[0];
			$y	= $dt[1];

			$result = $y.'-'.$m;
		}
		else if($mode == 'ym-my')
		{
			$m	= substr($date, -2);
			$y	= substr($date, 0,4);

			$result = $m.'-'.$y;
		}
		// D/M/Y -> M
		else if($mode == 'dmy-y')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$y	= $dt[2];

			$result = $y;
		}
		else if($mode == 'm-month')
		{
			$m	= $date;
			$result = $bulan[(int)$m-1];
		}
		else if($mode == 'my-month')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$m	= $dt[0];
			$y	= $dt[1];
			
			$result = $bulan[(int)$m-1].' '.$y;
		}
		else if($mode == 'ym-month')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$m	= $dt[1];
			$y	= $dt[0];
			
			$result = $bulan[(int)$m-1].' '.$y;
		}
		else if($mode == 'ymd-month')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[2];
			$m	= $dt[1];
			$y	= $dt[0];

			$result = $d.' '.$bulan[(int)$m-1].' '.$y;
		}
		else if($mode == 'ymd-monthFull')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[2];
			$m	= $dt[1];
			$y	= $dt[0];

			$result = $d.' '.$bulan[(int)$m-1].' '.$y.' - '.$exp[1];
		}
		else if($mode == 'month-ymd')
		{
			$b = array_search($exp[1], $bulan)+1;
			$d	= $exp[0];
			$m	= ($b < 10) ? "0".$b : $b;
			$y	= $exp[2];

			$result = $y.'-'.$m.'-'.$d;
		}
		else if($mode == 'ymd2-month')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[2];
			$m	= $dt[1];
			$y	= $dt[0];

			$result = $bulan[(int)$m-1].' '.$y;
		}
		else if($mode == 'dmy-month')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[0];
			$m	= $dt[1];
			$y	= $dt[2];

			$result = $d.' '.$bulan[(int)$m-1].' '.$y;
		}
		else if($mode == 'ymd-short')
		{
			$dt = preg_split("/[\-,\/]+/", $date);
			$d	= $dt[2];
			$m	= $dt[1];
			$y	= $dt[0];

			$result = $d.' '.$mshort[(int)$m-1].' '.$y;
		}
		else if($mode == 'ymdhis-h')
		{
			$dt = explode(":", $exp[1]);

			$result = $dt[0];
		}
   	return $result;
	}
}

function selisih_date($date1, $date2)
{
	// Y-m-d
	$result = ((strtotime ($date1) - strtotime ($date2))/(60*60*24));

	return $result;
}

function next_day($date, $mode) 
{
	// Y-m-d
	$result = date("Y-m-d", strtotime("$date +$mode day"));
	
	return $result;
}

function next_day2($date, $mode) 
{
	// Y-m-d
	$result = date("Y-m-d", strtotime("$date +$mode"));
	
	return $result;
}

function endOf_month($date) 
{
	// Y-m-d
	$result = date("Y-m-t", strtotime($date));
	
	return $result;
}

function add_Time($date, $mode) 
{
	// Y-m-d H:i:s
	$dates = date_create($date);
	date_add($dates, date_interval_create_from_date_string($mode));
	$result = date_format($dates, 'Y-m-d H:i:s');
	
	return $result;
}

function usia($tanggal, $delimeter = "-")
{
	// DATE DD-MM-YYYY
	// usia('17-02-1986');
	// usia('17/02/1986', '/');
	list($hari, $bulan, $tahun) = explode($delimeter, $tanggal);
	$selisih_hari	= date('d') - $hari;
	$selisih_bulan	= date('m') - $bulan;
	$selisih_tahun	= date('Y') - $tahun;
	if($selisih_hari < 0 || $selisih_bulan < 0)
	{
		$selisih_tahun--;
	}
	return $selisih_tahun;
}

// TIME AGO
function timeAgo($time_ago)
{
	// YYYY-MM-DD HH:II:SS
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function rp_digit($val, $digit = 0)
{
	return number_format($val,$digit,".",",");
}

function rp_digit2($val, $digit = 0)
{
	return ((floor($val) == round($val, $digit)) ? number_format($val) : number_format($val, $digit));
}

// SQL Injextion
function clean($str) 
{
	$str = @trim($str);
	if(get_magic_quotes_gpc()) 
	{
		$str = stripslashes($str);
	}
	else{
		$str = htmlspecialchars($str);
	}
	return $str;
}

function filter($str) 
{
	$str = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $str);
	$str = preg_replace('/[a-z0-9]+;/i','',$str); 
	$str = preg_replace('/\s+/', '', $str); // spasi lebih
	$str = preg_replace('/[^.,+&@#?$=()\/A-Za-z0-9 _-]/', '', $str);
	return $str;
}

function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$word_limit));
}

function limit_char($x, $length)
{
	if(strlen($x)<=$length)
	{
		return $x;
	}
	else{
		$y=substr($x,0,$length);
		return $y;
	}
}

function textExplode($string, $delimeter = "-", $last_text = "0")
{
	if (strpos(trim($string), $delimeter) !== FALSE) {
		$text = explode($delimeter, trim($string));
		if($last_text == "last")
		{
			$str = substr(trim($string), strrpos(trim($string), $delimeter) + 1);
		}
		else if(is_numeric($last_text)){
			$str = $text[$last_text];
		}
		else{
			$str = $text;
		}
		return $str;
	}
	else{
		return trim($string);
	}
}

function custom_replace(array $replace, $subject)
{ 
   return str_replace(array_keys($replace), array_values($replace), $subject);    
}

function isValidEmail($email)
{
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', trim($email));
}

function greeting()
{
	$date = date ("G : i A");
	if ($date>=0 and $date<10){
		$g = "Selamat Pagi";
	} else if ($date>=10 and $date<15) {
		$g = "Selamat Siang";
	} else if ($date>=15 and $date<19) {
		$g = "Selamat Sore";
	} else if ($date>=19 and $date<00) {
		$g = "Selamat Malam";
	}else{ $g = "Waktu salah"; }
	
	return $g;
}

// ENCODE DECODE
function encode($string) 
{
	$hash 	= base64_encode($string);

    return $hash;
}

function decode($string) 
{
	$hash 	= base64_decode($string);
	
    return $hash;
}

// FILE PERMISSION
function file_permission($filename)
{
	$perms = fileperms($filename);

	if (($perms & 0xC000) == 0xC000) { $info = 's'; }
	elseif (($perms & 0xA000) == 0xA000) { $info = 'l'; }
	elseif (($perms & 0x8000) == 0x8000) { $info = '-'; }
	elseif (($perms & 0x6000) == 0x6000) { $info = 'b'; }
	elseif (($perms & 0x4000) == 0x4000) { $info = 'd'; }
	elseif (($perms & 0x2000) == 0x2000) { $info = 'c'; }
	elseif (($perms & 0x1000) == 0x1000) { $info = 'p'; }
	else { $info = 'u'; }

	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : 
	(($perms & 0x0800) ? 'S' : '-'));

	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : 
	(($perms & 0x0400) ? 'S' : '-'));

	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : 
	(($perms & 0x0200) ? 'T' : '-'));

	return $info;
}

function file_create($filename, $data)
{
	$f = @fopen($filename, 'w');
	if (!$f) {
		return false;
	} else {
		$bytes = fwrite($f, $data);
		fclose($f);
		return $bytes;
	}
}

function file_read($filename)
{
	if (!function_exists('file_get_contents'))
	{
		$fhandle = fopen($filename, "r");
		$fcontents = fread($fhandle, filesize($filename));
		fclose($fhandle);
	}
	else{
		$fcontents = file_get_contents($filename);
	}
	return $fcontents;
}

function getFileType($url){
    $filename=explode('.',$url);
    $extension=end($filename);

    switch($extension){
        case 'pdf':
            $type='fa-file-'.$extension.'-o';
            break;
        case 'docx':
        case 'doc':
            $type='fa-file-word-o';
            break;
        case 'xls':
        case 'xlsx':
            $type='fa-file-excel-o';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='fa-file-audio-o';
            break;
        case 'mp4':
        case 'mov':
            $type='fa-file-video-o';
            break;
        case 'zip':
        case '7z':
        case 'rar':
            $type='fa-file-archive-o';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
            $type='fa-file-image-o';
            break;
        default:
            $type='fa-file-o';
    }

    return $type;
}

function direktori($dir)
{
	if (is_dir($dir)){
	  if ($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false){
		  echo "filename: <a href='" . $file . "'>" . $file . "</a><br>";
		}
		closedir($dh);
	  }
	}
}

function getFilesize($file)
{
    if(!file_exists($file)) return "File does not exist";

    $filesize = filesize($file);

    if($filesize > 1024)
    {
        $filesize = ($filesize/1024);

        if($filesize > 1024)
        {
            $filesize = ($filesize/1024);

            if($filesize > 1024)
            {
                $filesize = ($filesize/1024);
                $filesize = round($filesize, 1);
                return $filesize." GB";
            }
            else
            {
                $filesize = round($filesize, 1);
                return $filesize." MB";
            }
        }
        else
        {
            $filesize = round($filesize, 1);
            return $filesize." KB";
        }
    }
    else
    {
        $filesize = round($filesize, 1);
        return $filesize." Bytes";
    }
}

/* make da thumbnails - david walsh*/
function make_thumb($src, $dest, $desired_width) {
	$source_image = imagecreatefromjpeg($src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$desired_height = floor($height * ($desired_width / $width));
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	imagejpeg($virtual_image, $dest);
}

// AJAX request
function is_ajax() 
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function is_connected()
{
	$connected = fopen("http://www.google.com:80/","r");
	if($connected && substr(GetIP(),0,3) != '192')
	{
		return true;
	} else {
		return false;
	}

}

function sendEmail($from, $fromName = null, $to = array(), $toName = null, $title, $msg, $arr = array())
{
	try{
		global $config, $db;
		
		$mail = new PHPMailer(true);
					
		//Server settings
		$mail->isSMTP();						// Send using SMTP
		$mail->SMTPDebug  = 1;					// debugging: 1 = errors and messages, 2 = messages only
		$mail->Host       = $config['ehost'];	// Set the SMTP server to send through
		$mail->Port       = $config['eport'];	// TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		$mail->Username   = $config['euser'];	// SMTP username
		$mail->Password   = $config['epass'];	// SMTP password
		
		//Recipients
		if(empty($fromName) || $fromName == ''){
			$mail->setFrom($from);
		}else{
			$mail->setFrom($from, $fromName);
		}
		
		if(count($to['to']) > 1){
			foreach($to['to'] as $t){
				$mail->addAddress($t);
			}
		}else{
			if(empty($toName)){
				$mail->addAddress($to['to'][0]);
			}else{
				$mail->addAddress($to['to'][0], $toName);
			}
		}
		
		$mail->addBCC($config['euser'].'@wiratman.co.id','Admin Apps');
		
		if(count($arr) > 0){
			if(count($arr['mailCc']) > 0){
				foreach($arr['mailCc'] as $cc){
					$mail->addCC($cc);
				}
			}
			if(!empty($arr['attach'])){
				$mail->addAttachment($arr['attach']);
			}
		}

		// Content
		$mail->isHTML(true);
		$mail->Subject = $title;
		$mail->Body    = $msg;
		
		$mail->send(); // echo 'Message has been sent';
		
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}


function var_dump2($data, $label='', $return = false) {
    $debug = debug_backtrace();
    $callingFile = $debug[0]['file'];
    $callingFileLine = $debug[0]['line'];

    ob_start();
    var_dump($data);
    $c = ob_get_contents();
    ob_end_clean();

    $c = preg_replace("/\r\n|\r/", "\n", $c);
    $c = str_replace("]=>\n", '] = ', $c);
    $c = preg_replace('/= {2,}/', '= ', $c);
    $c = preg_replace("/\[\"(.*?)\"\] = /i", "[$1] = ", $c);
    $c = preg_replace('/  /', "    ", $c);
    $c = preg_replace("/\"\"(.*?)\"/i", "\"$1\"", $c);
    $c = preg_replace("/(int|float)\(([0-9\.]+)\)/i", "$1() <span class=\"number\">$2</span>", $c);

    // Syntax Highlighting of Strings. This seems cryptic, but it will also allow non-terminated strings to get parsed.
    $c = preg_replace("/(\[[\w ]+\] = string\([0-9]+\) )\"(.*?)/sim", "$1<span class=\"string\">\"", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\})/sim", "$1</span>$2", $c);
    $c = preg_replace("/(\"\n{1,})( {0,}\[)/sim", "$1</span>$2", $c);
    $c = preg_replace("/(string\([0-9]+\) )\"(.*?)\"\n/sim", "$1<span class=\"string\">\"$2\"</span>\n", $c);

    $regex = array(
        // Numberrs
        'numbers' => array('/(^|] = )(array|float|int|string|resource|object\(.*\)|\&amp;object\(.*\))\(([0-9\.]+)\)/i', '$1$2(<span class="number">$3</span>)'),
        // Keywords
        'null' => array('/(^|] = )(null)/i', '$1<span class="keyword">$2</span>'),
        'bool' => array('/(bool)\((true|false)\)/i', '$1(<span class="keyword">$2</span>)'),
        // Types
        'types' => array('/(of type )\((.*)\)/i', '$1(<span class="type">$2</span>)'),
        // Objects
        'object' => array('/(object|\&amp;object)\(([\w]+)\)/i', '$1(<span class="object">$2</span>)'),
        // Function
        'function' => array('/(^|] = )(array|string|int|float|bool|resource|object|\&amp;object)\(/i', '$1<span class="function">$2</span>('),
    );

    foreach ($regex as $x) {
        $c = preg_replace($x[0], $x[1], $c);
    }

    $style = '
    /* outside div - it will float and match the screen */
    .dumpr {
        margin: 2px;
        padding: 2px;
        background-color: #fbfbfb;
        float: left;
        clear: both;
    }
    /* font size and family */
    .dumpr pre {
        color: #000000;
        font-size: 9pt;
        font-family: "Courier New",Courier,Monaco,monospace;
        margin: 0px;
        padding-top: 5px;
        padding-bottom: 7px;
        padding-left: 9px;
        padding-right: 9px;
    }
    /* inside div */
    .dumpr div {
        background-color: #fcfcfc;
        border: 1px solid #d9d9d9;
        float: left;
        clear: both;
    }
    /* syntax highlighting */
    .dumpr span.string {color: #c40000;}
    .dumpr span.number {color: #ff0000;}
    .dumpr span.keyword {color: #007200;}
    .dumpr span.function {color: #0000c4;}
    .dumpr span.object {color: #ac00ac;}
    .dumpr span.type {color: #0072c4;}
    ';

    $style = preg_replace("/ {2,}/", "", $style);
    $style = preg_replace("/\t|\r\n|\r|\n/", "", $style);
    $style = preg_replace("/\/\*.*?\*\//i", '', $style);
    $style = str_replace('}', '} ', $style);
    $style = str_replace(' {', '{', $style);
    $style = trim($style);

    $c = trim($c);
    $c = preg_replace("/\n<\/span>/", "</span>\n", $c);

    if ($label == ''){
        $line1 = '';
    } else {
        $line1 = "<strong>$label</strong> \n";
    }

    $out = "\n<!-- Dumpr Begin -->\n".
        "<style type=\"text/css\">".$style."</style>\n".
        "<div class=\"dumpr\">
        <div><pre>$line1 $callingFile : $callingFileLine \n$c\n</pre></div></div><div style=\"clear:both;\">&nbsp;</div>".
        "\n<!-- Dumpr End -->\n";
    if($return) {
        return $out;
    } else {
        echo $out;
    }
}

## API v1 --- START
function getHeader()
{
    header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Headers: access");
	header("Access-Control-Allow-Methods: POST");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}