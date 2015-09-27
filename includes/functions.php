<?php
  // Your code here
$pagename=curPageName();

  function trim_string($str1,$length)
  {
    $count=strlen($str1);
      if ($count>$length)
      {
       $str1=substr($str1,0,$length);
      }
      return $str1;
  }
 
// Redirect to another page or site
  function tep_redirect($url) {
       header('Location: ' . $url);
    tep_exit();
  }
function tep_exit()
{
exit();
}
 function tep_href_link($page = '', $parameters = '') {
    global $request_type, $session_started, $SID;

   if (tep_not_null($parameters)) {
      $link .= $page . '?' . $parameters;
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }


    return $link;
  }

 function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

function generate_max_id($table,$max_field)
{
global $mysqli;
          $sql="select max(".$max_field.") as id from ".$table;
          $res=mysqli_query($mysqli, $sql);
          $row=mysqli_fetch_object($res);
          if($row->id=="")
              $id=1;
          else
              $id=$row->id+1;
          return $id;
}

function check_max_id($table,$max_field)
{
global $mysqli;
          $sql="select max(".$max_field.") as id from ".$table;
          $res=mysqli_query($mysqli, $sql);
          $row=mysqli_fetch_object($res);
          if($row->id=="")
              $id=1;
          else
              $id=$row->id;
          return $id;
}

 

function return_field($table,$checkcolumn,$checkvalue,$returncolumn)
{
global $mysqli;
 if (is_numeric($checkvalue)) {
 $query11="select  ". $returncolumn. " from ". $table . " where " .$checkcolumn. " = ".$checkvalue; 
    } else {
 $query11="select  ". $returncolumn. " from ". $table . " where " .$checkcolumn. " = '".$checkvalue."'";
     }
          $sql11 = mysqli_query($mysqli, $query11) or die(mysqli_connect_error());
 	      $row11= mysqli_fetch_assoc($sql11);
		$value=$row11[$returncolumn];
        return $value;
}
 

function CurPageQS()
{
$qs= $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
return $qs;
}


function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}


function curPageURL() {
 $pageURL = 'http';
// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function create_sessionid($length)
	{
	  if($length>0)
	  {
	   $rand_id="";
	   for($i=1; $i<=$length; $i++)
	   {
	    mt_srand((double)microtime() * 1000000);
	    $num = mt_rand(27,36);
	    $rand_id .= assign_rand_value($num);
	   }
	  }
	  return $rand_id;
    }
	
function create_randomid($length)
	{
	  if($length>0)
	  {
	   $rand_id="";
	   for($i=1; $i<=$length; $i++)
	   {
	    mt_srand((double)microtime() * 1000000);
	    $num = mt_rand(1,36);
	    $rand_id .= assign_rand_value($num);
	   }
	  }
	  return $rand_id;
    }	
 
function assign_rand_value($num)
	{
	// for random session id >> accepts 1 - 36
	  switch($num)
	  {
	    case "1":
	     $rand_value = "a";
	    break;
	    case "2":
	     $rand_value = "b";
	    break;
	    case "3":
	     $rand_value = "c";
	    break;
	    case "4":
	     $rand_value = "d";
	    break;
	    case "5":
	     $rand_value = "e";
	    break;
	    case "6":
	     $rand_value = "f";
	    break;
	    case "7":
	     $rand_value = "g";
	    break;
	    case "8":
	     $rand_value = "h";
	    break;
	    case "9":
	     $rand_value = "i";
	    break;
	    case "10":
	     $rand_value = "j";
	    break;
	    case "11":
	     $rand_value = "k";
	    break;
	    case "12":
	     $rand_value = "l";
	    break;
	    case "13":
	     $rand_value = "m";
	    break;
	    case "14":
	     $rand_value = "n";
	    break;
	    case "15":
	     $rand_value = "o";
	    break;
	    case "16":
	     $rand_value = "p";
	    break;
	    case "17":
	     $rand_value = "q";
	    break;
	    case "18":
	     $rand_value = "r";
	    break;
	    case "19":
	     $rand_value = "s";
	    break;
	    case "20":
	     $rand_value = "t";
	    break;
	    case "21":
	     $rand_value = "u";
	    break;
	    case "22":
	     $rand_value = "v";
	    break;
	    case "23":
	     $rand_value = "w";
	    break;
	    case "24":
	     $rand_value = "x";
	    break;
	    case "25":
	     $rand_value = "y";
	    break;
	    case "26":
	     $rand_value = "z";
	    break;
	    case "27":
	     $rand_value = "1"; // no zeros, because if it starts with a zero, it might get cut off
	    break;
	    case "28":
	     $rand_value = "1";
	    break;
	    case "29":
	     $rand_value = "2";
	    break;
	    case "30":
	     $rand_value = "3";
	    break;
	    case "31":
	     $rand_value = "4";
	    break;
	    case "32":
	     $rand_value = "5";
	    break;
	    case "33":
	     $rand_value = "6";
	    break;
	    case "34":
	     $rand_value = "7";
	    break;
	    case "35":
	     $rand_value = "8";
	    break;
	    case "36":
	     $rand_value = "9";
	    break;
	  }
	return $rand_value;
	}

 
function ShortenText($text,$len) 
{
// Change to the number of characters you want to display        
$chars = $len;        
$text = $text." "; 
if(strlen($text)>$len)
{
$text = substr($text,0,$chars);
$text = substr($text,0,strrpos($text,' '));
$text = $text."...";
}
return $text; 
}
 

function cleanQuery($string)
{
$string= trim($string);
  if(get_magic_quotes_gpc())  // prevents duplicate backslashes
  {
    $string = stripslashes($string);
  }
  /*if (phpversion() >= '4.3.0')
  {
    $string = mysqli_real_escape_string($string);
  }
  else
  { */
    $string = mysql_escape_string($string);
  return $string;
}


function isValidEmail($email){
if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
$valid=0;
}
else {
$valid =1;
}
return $valid;
}


function backup_tables($tables = '*')
{ 
global $mysqli;
 
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysqli_query($mysqli, 'SHOW TABLES');
		while($row = mysqli_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	$return='';
	//cycle through
	foreach($tables as $table)
	{
		$result = mysqli_query($mysqli, 'SELECT * FROM '.$table);
		$num_fields = mysqli_num_fields($result);
		
		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysqli_fetch_row(mysqli_query($mysqli, 'SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysqli_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				$columns = count($row);
				for($j=0; $j<$columns; $j++)
				{
					$row[$j] = addslashes($row[$j]);
//					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"'; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	$date2=date('Y-m-d');
	//save file
	$handle = fopen('../backupdb/db-backup-'.$date2.'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
}

function isexists($table,$field, $value)
{
global $mysqli;
        $rcount= mysqli_num_rows(mysqli_query($mysqli, "select * from ". $table ." where ".$field."='".$value."'"));
		return $rcount;		
}
   
function checkAdminLogin()
{
	if($_SESSION['admin']=="")
	{		 
		header("Location: login.php");
		exit();
	}
}
function checkState()
{
	if($_SESSION['stateid']=="")
	{		 
		header("Location: states.php");
		exit();
	}
}

function checkMemberLogin()
{
	if($_SESSION['member_number']=="")
	{		 
		header("Location: login.php");
		exit();
	}
}

function checkUserLogin()
{
	/*session_destroy();
	header("Location: index.php");
		exit();	*/
	
	if($_SESSION['user']=="")
	{		 
		header("Location: login.php");
		exit();
	} 
	$userb=return_field('users','id',$_SESSION["userid"],'status2');
	if($userb!=1)
	{
	session_destroy();
	header("location:login.php?action1=err3");
	}	
}
 
function dateformat($date2)
{
if($date2!="" && $date2!='0000-00-00')
return date("m-d-Y", strtotime($date2));
else
return "";
} 

function dateformat3($date2)
{
if($date2!="" && $date2!='0000-00-00')
return date("m-d-Y  H:i:s", strtotime($date2));
else
return "";
} 

function dateformat2($date2)
{
if($date2!="" && $date2!='0000-00-00')
return date("Y-m-d", strtotime($date2));
else
return "";
} 

function dvalue($value)
{
if($value==0)
return '';
else
return $value;
} 

function cbvalue($value)
{
if($value==1)
return 'yes';
else
return '';
} 

function cbcheck($value)
{
if($value==1)
echo 'checked="checked"';
}

function cv($value)
{
$value=cleanQuery($value);
return (isset($value)&& $value!="") ? $value : 0;
}
function Execute($sql){
global $mysqli;
		$res=mysqli_query($mysqli, $query);
		return $res;
}


function numrows($query)
{
global $mysqli;
$ss=array();
											$sqla=strtolower($query);
											$c=substr_count($sqla, 'from'); 
											if($c==1)
											{
											$ss=explode('from',$sqla,2);	
											$sqla="select count(*) as cnt from ".$ss[1];
											}
								    $resultrow=mysqli_query($mysqli, $sqla);
									$count=mysqli_num_rows($resultrow);
								 
									if($c!=1)
									return $count;
									else
									{
									$row=mysqli_fetch_assoc($resultrow);
									return $row['cnt'];
									}
}

	 
	function getrecord($table, $id)
	{
		global $mysqli;
		$query="SELECT * FROM ".$table." WHERE id = '" . intval($id) . "' LIMIT 1";
		if (numrows($query))
		{
		$res=mysqli_query($mysqli, $query);
        $row=mysqli_fetch_assoc($res);
		return $row;
		}
		else
		return false;
	}
	
	  function get($var)
  {
      if (isset($_GET[$var]))
          return cleanQuery($_GET[$var]);
		  else
		  return '';
  }  
 
  
//json_encode not in old versions. then its effect
if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}

function mvalue($value)
{
if($value==0)
return '';
else
return number_format($value, 0, '.', ',');
} 

function EmptyDir($dir) {

$handle=opendir($dir);



while (($file = readdir($handle))!==false) {

//echo "$file <br>";

@unlink($dir.'/'.$file);

}
closedir($handle);
}

function info_create_thumb($dest,$source,$pic)
{ 
		$width1=130;
	$height1=120;
	
    $arr=explode(".",$pic);
    $ii=count($arr);
    $ii=$ii-1;
    $extn=strtolower($arr[$ii]);
    $dest=$dest . "/th_" . $pic;
    $source=$source . "/" . $pic;
    copy($source,$dest);
    list($width, $height) = getimagesize($source);
       if ($width>$width1 || $height>$width1)
       {
            $ratio=$width/$height;
            if ($width>$height)
            {
            $new_width=$width1;
            $new_height=(int)($new_width/$ratio);
            }
            else
            {
             $new_height=$height1;
             $new_width=(int)($new_height*$ratio);
            }
           // echo $new_width . " " . $new_height;
            //if ($extn=='jpg' || $extn=='jpeg')
            //header('Content-type: image/jpeg');
            //else if ($extn=='gif')
            //header('Content-type: image/gif');
            //else if ($extn=='png')
            //header('Content-type: image/png');

            $image_p = imagecreatetruecolor($new_width, $new_height);
           // $image = imagecreatefromjpeg($dest);
            //imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            // Output
            //imagejpeg($image_p,$newname, 100);

            if ($extn=='jpg' || $extn=='jpeg')
            {
            $image = imagecreatefromjpeg($dest);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p,$dest, 100);
            }
            else if ($extn=='gif')
            {
            $image = imagecreatefromgif($dest);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p,$dest, 100);
            }
            else if ($extn=='png')
            {
            $image = imagecreatefrompng($dest);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_p,$dest, 100);
            }
       }

//       return true;
}

//json_encode not in old versions. then its effect
if (!function_exists('json_encode'))
{
  function json_encode($a=false)
  {
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
      if (is_float($a))
      {
        // Always use "." for floats.
        return floatval(str_replace(",", ".", strval($a)));
      }

      if (is_string($a))
      {
        static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
      }
      else
        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a))
    {
      if (key($a) !== $i)
      {
        $isList = false;
        break;
      }
    }
    $result = array();
    if ($isList)
    {
      foreach ($a as $v) $result[] = json_encode($v);
      return '[' . join(',', $result) . ']';
    }
    else
    {
      foreach ($a as $k => $v) $result[] = json_encode($k).':'.json_encode($v);
      return '{' . join(',', $result) . '}';
    }
  }
}


function info_create_thumb3($dest,$source,$pic)

{

		$width1=700;

	$height1=520;

    $arr=explode(".",$pic);

    $ii=count($arr);

    $ii=$ii-1;

    $extn=strtolower($arr[$ii]);

    $dest=$dest . "/m_" . $pic;

    $source=$source . "/" . $pic;

    copy($source,$dest);

    list($width, $height) = getimagesize($source);

       if ($width>$width1 || $height>$width1)

       {

            $ratio=$width/$height;

            if ($width>$height)

            {

            $new_width=$width1;

            $new_height=(int)($new_width/$ratio);

            }

            else

            {

             $new_height=$height1;

             $new_width=(int)($new_height*$ratio);

            }

            



            $image_p = imagecreatetruecolor($new_width, $new_height);

           

            if ($extn=='jpg' || $extn=='jpeg')

            {

            $image = imagecreatefromjpeg($dest);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            imagejpeg($image_p,$dest, 100);

            }

            else if ($extn=='gif')

            {

            $image = imagecreatefromgif($dest);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            imagejpeg($image_p,$dest, 100);

            }

            else if ($extn=='png')

            {

            $image = imagecreatefrompng($dest);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

            imagejpeg($image_p,$dest, 100);

            }

       }



//       return true;

}

function getid($var)
  {
  $s="";
  if (isset($_GET[$var]))          
  $s=(int)$_GET[$var];
		  
		  return $s;
  }  

 
function conurl($url)
{
$url=strtolower($url); 
$url= preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $url);

$specialCharacters = array(
'#' => '',
'$' => '',
'%' => '',
'&' => '',
'@' => '',
'.' => '-',
'Ä' => '',
'+' => '',
'=' => '',
'ß' => '',
'\\' => '',
'/' => '',
':' => '-',
';' => '-',
',' => '-',
'(' => '-',
')' => '-',
' ' => '-'
);

$url=str_replace(array('ë', 'í', '\'','"','?','_','*','&','ì', 'î'), '', $url);

while (list($character, $replacement) = each($specialCharacters)) {
$url = str_replace($character, '-' . $replacement . '-', $url);
}

$url= strtr($url,"¿¡¬√ƒ≈? ·‚„‰Â“”‘’÷ÿÚÛÙıˆ¯»… ÀËÈÍÎ«ÁÃÕŒœÏÌÓÔŸ⁄€‹˘˙˚¸ˇ—Ò","AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");

// Remove all remaining other unknown characters
$url = preg_replace('/[^a-zA-Z0-9\-]/', '', $url);
$url = preg_replace('/[\-]{2,}/', '-', $url);

if(substr($url, -1)=='-')
$url=substr($url, 0, -1); 
return $url;
}
 
  
  function datediff($date1,$date2)  // date difference output
       {
        $diff= abs(strtotime($date1) - strtotime($date2)); $diff=floor($diff/(60*60*24));
		if($date1<$date2)
		$diff=$diff*(-1);
		return $diff;
       }

function check_date_is_within_range($start_date, $end_date, $todays_date)
{

  $start_timestamp = strtotime($start_date);
  $end_timestamp = strtotime($end_date);
  $today_timestamp = strtotime($todays_date);

  return (($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp));

}

function get_video($id, $type)
	{
global $tb_videos;
		for($i =0; $i < count($tb_videos); $i++) {
		if($id==$tb_videos[$i][0])
		return $tb_videos[$i][$type];
		}
	}

function contactscount($userid)
{
global $mysqli;
$stateid=$_SESSION['stateid'];
$tablename=return_field('states','id',$stateid,'tablename');		 
		$query="SELECT COUNT(id) as cnt FROM ".$tablename." WHERE userid= " . $userid;
		$res=mysqli_query($mysqli, $query);
        $row=mysqli_fetch_assoc($res);
		return $row['cnt'];
}  	
function referralcount($userid)
{
         global $mysqli;
		$query="SELECT COUNT(id) as cnt FROM referrals WHERE referrals.userfrom= " . $userid;
		$res=mysqli_query($mysqli, $query);
        $row=mysqli_fetch_assoc($res);
		return $row['cnt'];
}
function OrdinalNumber($num) {
    if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
 }
 
function return_field_2($table,$returncolumn,$condition)
{
global $mysqli;
 $query11="select  ". $returncolumn. " from ". $table . " where " .$condition; 
          $sql11 = mysqli_query($mysqli, $query11) or die(mysqli_connect_error());
 	      $row11= mysqli_fetch_assoc($sql11);
		$value=$row11[$returncolumn];
        return $value;
}
  
?>
