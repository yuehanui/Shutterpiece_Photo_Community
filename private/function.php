<?php

function request_is_post() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function redirect_to($location){
	header("Location: " . $location);
	exit();
}
function redirect_in_time($location, $second){
  header( "Refresh:" . $second . "; url=" . $location, true, 303);
  exit();
}
function redirect_in_time_no_exit($location, $second){
  header( "Refresh:" . $second . "; url=" . $location, true, 303);
}
// sanitize user input to prevent cross-site scripting attack
function h($string=""){
  return htmlspecialchars($string);
}
// escape special character from user input to prevent SQL injection
function db_escape($connection, $string){
  return mysqli_real_escape_string($connection, $string);
}

// connect to the database using the admin credential;
function db_connect(){
  return mysqli_connect('localhost', 'root', 'passwordishidden', 'artwork_schema');
}

function db_disconnect($connection){
  if (isset($connection)){
    mysqli_close($connection);
  }
}

// generate a string consist of random chararacters
function randomString($n) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($chars) - 1);
        $randomString .= $chars[$index];
    }
    return $randomString;
}

//store username and a random string as token in cookies
function set_cookie($username,$token){
  setcookie('username',$username, time() + 3600);
  setcookie('token',$token, time() + 3600);
}
//store username and a random string as token in session
function set_session($username,$token){
  $_SESSION[$username] = [$token,'ss'];
}

//add time to existing cookies
function refresh_cookie(){
  if (check_cookie()){
    setcookie('username',$_COOKIE['username'], time() + 3600);
    setcookie('token',$_COOKIE['token'], time() + 3600);
  }
}

// check if cookie matchs
function check_cookie(){
  if (isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_SESSION[$_COOKIE['username']])){
    if ($_COOKIE["token"] == $_SESSION[$_COOKIE['username']][0]) {
      return true;
    }
  }
  return false;
}

function unset_session_cookie(){
  unset($_SESSION[$_COOKIE['username']]) ;
  setcookie('username', '', time() -3600);
  setcookie('token','', time() - 3600);
}

function next_artist_id($db){
  $query = "SELECT max(artist_id) FROM artist;";
  $result = mysqli_query($db, $query);
  $largest_id =  mysqli_fetch_row($result)[0];

  if (isset($largest_id)){
    $next_id = $largest_id + 1;
  } else {
    $next_id = 1001;
  }
  mysqli_free_result($result);
  return $next_id;
}

function next_artwork_id($db){
  $query = "SELECT max(artwork_id) FROM artwork;";
  $result = mysqli_query($db, $query);
  $largest_id =  mysqli_fetch_row($result)[0];

  if (isset($largest_id)){
    $next_id = $largest_id + 1;
  } else {
    $next_id = 1000001;
  }
  mysqli_free_result($result);
  return $next_id;
}

function insert_artwork($db, $artwork_id, $artwork_name, $artwork_des,$artwork_path, $username, $category){
  $artwork_id = db_escape($db, $artwork_id);
  $artwork_name = "'" . db_escape($db, $artwork_name) . "'";
  $artwork_des = "'" . db_escape($db, $artwork_des) . "'";
  $artwork_path = "'" . db_escape($db, $artwork_path) . "'";
	$category = "'" . db_escape($db, $category) . "'";
	$artist_id = get_artist_id_from_username($db, $username);
  $insert_DML = "INSERT INTO artwork(artwork_id,artwork_name,artwork_des,artwork_date,artwork_path,artist_id,category) VALUES ($artwork_id, $artwork_name,$artwork_des, CURDATE(),$artwork_path, $artist_id,$category)";
  mysqli_query($db, $insert_DML);
}

function get_artist_id_from_username($db,$username){
	$username = "'" . db_escape($db, $username) . "'";
	$query= "SELECT artist_id FROM artist WHERE username=$username";
	$result = mysqli_query($db, $query);
	$artsit_id = (mysqli_fetch_row($result)[0]);
	return $artsit_id;
}
//return info of image as a array
function get_imgs($type, $name){
  $db = db_connect();
	if ($type == "C"){
		$condition = ' WHERE category="'.$name.'"';
	} else if ($type == "A") {
		$condition = ' WHERE artist_name="'.$name.'"';
	} else {
		$condition = '';
	}

	$query = 'SELECT artwork_id, artwork_name, artwork_des,DATE_FORMAT(artwork_date,"%M %d, %Y"),CONCAT(CONCAT("../img/artwork/thumbnail/",artwork_id),".png"),CONCAT("../img/artwork/",artwork_path),a.artist_id, artist_name, @rownum := @rownum + 1  FROM artwork a cross join (select @rownum := -1) r JOIN artist b ON a.artist_ID=b.artist_ID ' . $condition ;
	$result = mysqli_query($db, $query);
	if (!$result){
		return "";
	}
  $count = mysqli_num_rows($result);
  $arr = [];
  for ($i = 0; $i < $count; $i++){
    $subject = mysqli_fetch_row($result);
    array_push($arr, $subject);
  }

  return json_encode($arr);
}
function save_photo($image,$file_name, $ext){
	if ($ext == 'png' || $ext =='PNG'){
    $im = imagecreatefrompng($image);
  } else if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'JPG'){
    $im = imagecreatefromjpeg($image);

  } else {
    exit("Error 4");
  }

	$ratio = imagesy($im)/imagesx($im);
  return imagepng(imagescale($im, 2560, 2560*$ratio), IMAGE_PATH.'/artwork/'.$file_name.'.png');
}


function save_thumbnail($image,$file_name, $ext){
  if ($ext == 'png' || $ext =='PNG'){
    $im = imagecreatefrompng($image);
  } else if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPEG' || $ext == 'JPG'){
    $im = imagecreatefromjpeg($image);

  } else {
    exit("Error 4");
  }
  if (imagesx($im)*0.66 < imagesy($im) && imagesx($im)*0.67 > imagesy($im)){
    return imagepng(imagescale($im, 900, 533), IMAGE_PATH.'/artwork/thumbnail/'.$file_name.'.png');
  } else if (imagesx($im)*0.66 > imagesy($im)){
		$size = imagesy($im) * 3/2;
    $x =  (imagesx($im) - $size)/2;
    $im2 = imagecrop($im, ['x' => $x, 'y' => 0, 'width' => $size, 'height' => imagesy($im)]);
  } else {
		$size = imagesx($im) * 2/3;
    $y =  (imagesy($im) - $size)/2;
    $im2 = imagecrop($im, ['x' => 0, 'y' => $y, 'width' => imagesx($im), 'height' => $size]);
  }

  if ($im2 !== FALSE) {
    imagepng($im2, IMAGE_PATH.'/artwork/thumbnail/'.$file_name.'.png');
  } else {
    exit("Error 3");
  }
}
//check if the username is taken
function username_taken($username){
	$db = db_connect();
	$query = "SELECT * FROM artist WHERE artist_name = '$username'";
	$result = mysqli_query($db, $query);
	$username_taken = (mysqli_num_rows($result) > 0);
	return $username_taken;
}


?>
