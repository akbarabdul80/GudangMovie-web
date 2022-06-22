<?php 

session_start();

require_once "../koneksi.php";
require '../utils/utils_http.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$http = new Utils_http();
$profile = $http->http_request("api/auth/register", "POST", json_encode(array("name" => $name,"email" => $email, "password" => $password)));

if ($profile["status"]) {
    $query = 'INSERT INTO users VALUES(NULL, "'.$name.'", "'.$email.'", "'.md5($password).'");';
    $result = mysqli_query($koneksi, $query);
    header("location: ../index.php?success=yes", true, 301);
    exit();
}else {
    header("location: ../index.php?error=yes ", true, 301);
    exit();
}

 ?>
