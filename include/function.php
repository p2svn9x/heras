<?php
function protect($string) {
	$protection = htmlspecialchars(trim($string), ENT_QUOTES);
	return $protection;
}

function idinfo($id,$value) {
    global $bdd;
	$sql = $bdd->prepare("SELECT * FROM vanguard_users WHERE usern=?");
    $sql->execute(array($id));
	$row = $sql->fetch(PDO::FETCH_ASSOC);
	return $row[$value];
}

function getBin(){
  global $bdd;
  $sql = $bdd->prepare("SELECT * FROM bin ");
   $sql->execute();
	$row = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}

function getCC(){
  global $bdd;
  $sql = $bdd->prepare("SELECT * FROM ccv ");
   $sql->execute();
	$row = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $row;
}

function success($text) {
	return '<div class="alert alert-success" role="alert">'.$text.'</div>';
}

function info($text) {
	return '<div class="alert alert-warning" role="alert">'.$text.'</div>';
}

function error($text) {
	return '<div class="alert alert-danger" role="alert">'.$text.'</div>';
}

function isValidURL($url) {
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}


function genSKey($length = 10) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}


function truncate($text, $chars = 30) {
    if(strlen($text) > $chars) {
        $text = $text.' ';
        $text = substr($text, 0, $chars);
        $text = substr($text, 0, strrpos($text ,' '));
        $text = $text.'...';
    }
    return $text;
}



function isCC($line){
  $regex = preg_replace("/[^A-Za-z0-9 ]/", '|', $line);
  $data = explode("|",$regex);
  $info = "";
   $ccnum="";
      $month="";
      $year="";
      $cvv="";
      $type="";
  foreach ($data as $k){
    
    if (is_numeric(trim($k))){
        
          if(strlen($k)==16){
              if (substr($k, 0, 1) == 4) {
                    $ccnum = $k;
                    $type  = 'C';
                } elseif (substr($k, 0, 1) == 5) {
                    $ccnum = $k;
                    $type  = 'M';
                } elseif (substr($k, 0, 1) == 6) {
                    $ccnum = $k;
                    $type  = 'D';
                }
          }
          if (strlen($k)==15){ 
              if (substr($k, 0, 1) == 3){
              $ccnum = $k;
                    $type  = 'A';}}
        
   
        if(strlen($k)==2 && intval($k)<=12 && intval($k)>=1){$month = $k;}
        if(strlen($k)==2 && intval($k)>=19){$year=$k;}
        if(strlen($k)==4 && intval($k)>=2019 && intval($k)<=2030){$year=$k;}
      
      if(strlen($k)==3){$cvv=$k;}
        
      if(strlen($k)==4 && $type=='A'){
        $cvv = $k;
      }      

    } else { $info = $info."|".$k; }
        }
  
  if (isset($ccnum) && isset($month) && isset($year) && isset($cvv)) {
    $output = array("ccnum"=>$ccnum,"month"=>$month,"year"=>$year,"cvv"=>$cvv,"info"=>$info,"result"=>0);
  } else {$output = array("result"=>1);}
  return $output;
}

?>