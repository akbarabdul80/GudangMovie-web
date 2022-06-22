<?php 

session_start();

require '../utils/utils_http.php';


$username = $_POST['email'];
$password = $_POST['password'];

$http = new Utils_http();
$profile = $http->http_request("api/auth/login", "POST", json_encode(array("email" => $username, "password" => $password)));
var_dump($profile);

if ($profile["status"]) {
    $_SESSION["user_id"] = $profile["data"]["id"];
    $_SESSION["token"] = $profile["data"]["token"];
    $_SESSION["refresh_token"] = $profile["data"]["refresh_token"];
    header("location: ../view/home.php", true, 301);
    exit();
}else {
    header("location: ../index.php?error=yes ", true, 301);
    exit();
}

?>