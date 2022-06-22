<?php 

session_start();

require '../utils/utils_http.php';
require '../utils/utils_movie.php';
require_once "../koneksi.php";

$id_movie = $_GET['id_movie'];

$http = new Utils_http();
$http_movie = new Utils_movie();

$data = $http_movie->http_request($id_movie, "GET", "");
// var_dump($data["original_title"]);

$query = 'UPDATE `movie_users` SET `status`=2 WHERE `movie_users`.`id_movie_user` = '.$id_movie.' AND `movie_users`.`user_id` = '.$_SESSION["user_id"].'';
echo $query;
$result = mysqli_query($koneksi, $query);

$dataRequest = $http->http_request("api/user/movie", "PATCH", json_encode(array(
    "id_movie_user" => (int)$id_movie)));

var_dump($dataRequest);
if ($dataRequest["status"]) {
    header("location: ../view/home.php", true, 301);
    exit();
}else {
    header("location: ../index.php?error=yes ", true, 301);
    exit();
}

 ?>
