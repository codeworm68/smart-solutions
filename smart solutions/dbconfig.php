<?php
error_reporting(0);
ob_start();
session_start();

// header('Cache-control: private'); // IE 6 FIX
// // always modified
// header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
// // HTTP/1.1
// header('Cache-Control: no-store, no-cache, must-revalidate');
// header('Cache-Control: post-check=0, pre-check=0', false);
// // HTTP/1.0
// header('Pragma: no-cache');

//database conneciton
$hostname = "localhost"; //sql port no
$username = "root"; //user name
$password = ""; //password
$dbname = "php_ecom_electronics";

$con = mysqli_connect($hostname, $username, $password)
        or die("Unable to connect to MySQL");

//select a database
$selected = mysqli_select_db($con, $dbname) //database name
        or die("Could not select examples");


$user_id = $user_name = $user_type = "";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
}
if (isset($_SESSION['user_type'])) {
    $user_type = $_SESSION['user_type'];
}

$cookie_name = 'my_big_cart';
$cookie_time = 3600 * 24 * 15; // 15 days
$expire = 3600 * 24 * 30; // 15 days
//function for validate name field
function DoSecure($a_value) {
    $output = trim($a_value);
    $output = str_replace("<!--", "", $output);
    //Replace JS Tag, HTML tags, etc...
    $search = array('@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@([\r\n])[\s]+@'
    );
    $replace = array('',
        '',
        '\1'
    );
    $output = preg_replace($search, $replace, $output);
    $output = htmlspecialchars($output);
    return $output;
}
?>
