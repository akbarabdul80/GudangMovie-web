<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="../css_home.css/" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <form action="model/login-model.php" method="post">
      <div class="form-inner">
        <h1 class="text-center">Login</h1><br>
        <?php 
        if ($_GET['success'] != "") {
            echo '
            <div class="alert alert-warning" role="alert">
                Register berhasil silahkan login!
            </div>';
        }
        if ($_GET['error'] != "") {
            echo '
            <div class="alert alert-danger" role="alert">
                Silahkan cek email dan password anda!
            </div>';
        }
        if ($_GET['session'] != "") {
            echo '
            <div class="alert alert-warning" role="alert">
                Session anda tidak valid silahkan login ulang!
            </div>';
        }
        ?>
        <input name="email" type="email" placeholder="Email">
        <input name="password" type="password" placeholder="Password">
        <br>
        <div class="btn-block text-center">
        <button onclick="location.href='view/register.php'" type="button">
         Register</button>
          <button type="submit" class="ms-2">Login</button>
        </div>
      </div>
    </form>
  </body>
</html>