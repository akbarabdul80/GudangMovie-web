<?php
	$server="localhost";
	$username="root";
	$password="";
	$database="gudangmovie";

	$koneksi=mysqli_connect($server,$username,$password,$database);

	if(!$koneksi){
		die("gagal terhubung dengan database".mysqli_connect_error());
	}
?>