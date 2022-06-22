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

$query = 'INSERT INTO movie_users VALUES(NULL, "'.$data['original_title'].'", "'.$data['overview'].'", "'.$data['poster_path'].'", "'.$data["release_date"].'", 1, "'.$_SESSION["user_id"].'");';
echo $query;
$result = mysqli_query($koneksi, $query);

$dataRequest = $http->http_request("api/user/movie", "PUT", json_encode(array(
    "movie_title" => $data["original_title"], 
    "movie_overview" => $data["overview"], 
    "movie_image" => $data["poster_path"], 
    "release_date" => $data["release_date"],
    "status" => 1 )));


if ($dataRequest["status"]) {
    header("location: ../view/home.php", true, 301);
    exit();
}else {
    header("location: ../index.php?error=yes ", true, 301);
    exit();
}

 ?>
