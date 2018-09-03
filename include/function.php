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




?>
