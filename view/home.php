<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>GudangMovie</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<center>
		<h2 class="text-2xl pt-10" style="color: white;">Your Movie</h2>

		<div class="p-5">
			<td class="px-6 py-4"><a href="home.php" class="px-4 py-1 text-sm text-white bg-yellow-400 rounded">Home</a></td>
			<td class="px-6 py-4"><a href="movie-popular.php" class="px-4 py-1 text-sm text-white bg-green-400 rounded">Popular</a></td>
			<td class="px-6 py-4"><a href="movie-top-rated.php" class="px-4 py-1 text-sm text-white bg-purple-400 rounded">Top Rated</a></td>
			<td class="px-6 py-4"><a href="movie-upcoming.php" class="px-4 py-1 text-sm text-white bg-blue-400 rounded">Movie Upcoming</a></td>
			<td class="px-6 py-4"><a href="../model/logout.php" class="px-4 py-1 text-sm text-white bg-red-400 rounded">Logout</a></td>
		</div>

		<div class="container flex justify-center mx-auto">
			<div class="flex flex-col">
				<div class="w-full">
					<div class="border-b border-gray-200 shadow">
						<table>
							<thead class="bg-gray-50">
								<tr>
									<th class="px-6 py-2 text-xs text-gray-500">
										Title
									</th>
									<th class="px-6 py-2 text-xs text-gray-500">
										Image
									</th>
									<th class="px-6 py-2 text-xs text-gray-500">
										Overview
									</th>
									<th class="px-6 py-2 text-xs text-gray-500">
										Release Date 
									</th>
									<th class="px-6 py-2 text-xs text-gray-500">
										Status 
									</th>
									<th class="px-6 py-2 text-xs text-gray-500">
										Action
									</th>
								</tr>
							</thead>
							<tbody class="bg-white">
								<?php
									require '../utils/utils_http.php';
									$http = new Utils_http();
									$data_json = $http->http_request("api/user/movie", "GET", "");
									if (count($data_json["data"])) {
										foreach ($data_json["data"] as $idx => $data) {
											echo "<tr>";
											echo '<tr class="whitespace-nowrap">';
											echo '<td class="px-6 py-4 text-sm text-gray-500 max-w-xs"><div class="text-sm text-gray-900">' . $data["movie_title"] . "</div></td>";
											echo '<td class="px-6 py-4 text-sm text-gray-500"><div class="text-sm text-gray-900"><img style="max-width: 100px;" class="max-w-xs" src="https://image.tmdb.org/t/p/w300_and_h300_bestv2' . $data["movie_image"] . '"></img></div></td>';
											echo '<td class="px-6 py-4 text-sm text-gray-500"><div class="text-sm text-gray-900 max-w-sm">' . substr_replace($data["movie_overview"], "...", 20) . "</div></td>";
											echo '<td class="px-6 py-4 text-sm text-gray-500"><div class="text-sm text-gray-900">' . $data['release_date'] . "</div></td>";
											$status = "Belum ditonton";
											if ($data['status'] == "2") {
												$status = "Sudah ditonton";
											}
											echo '<td class="px-6 py-4 text-sm text-gray-500"><div class="text-sm text-gray-900">' . $status . "</div></td>";
											if ($data['status'] == "1") {
												echo '<td class="px-6 py-4"><a href="../model/watch-movie-model.php?id_movie='.$data["id_movie_user"].'" class="px-4 py-1 text-sm text-white bg-green-400 rounded">Tonton</a>';
											}else{
												echo '<td class="px-6 py-4">';
											}
											echo '<a href="../model/delete-movie-model.php?id_movie='.$data["id_movie_user"].'" style="margin-left: 5px;" class="px-4 py-1 text-sm text-white bg-red-400 rounded">Delete</a></td>';

											echo "</tr>";
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</center>
	<script>
		$(document).ready(function () {
			$("form").submit(function (event) {
				var formData = {
					kelas: $("#kelas").val(),
					wali_kelas: $("#wali_kelas").val(),
				};
				$.ajax({
					type: "POST",
					url: "http://localhost/kelas/api.php?function=insert_kelas",
					data: formData,
					dataType: "json",
					encode: true,
				}).done(function (data) {
					$.ajax({
						type: "POST",
						url: "http://localhost/kelasapi/api.php?function=insert_kelas",
						data: formData,
						dataType: "json",
						encode: true,
					}).done(function (data) {
						window.location = "http://localhost/tugas2/kelas/index.php";
					});
				});

				event.preventDefault();
			});
		});

	</script>
</body>

</html>