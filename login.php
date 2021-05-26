<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body class="text-center row d-flex m-0 p-0 justify-content-center">
<?php
if(isset($_GET['error'])) {
    $error = urldecode($_GET['error']);
    echo <<<ERROR
    <div class="col-12 m-5 alert alert-danger"><b>ERROR: {$error}</b></div>
ERROR;
}
?>
<!-- Login Form -->
<form action="auth.php" method="post" class="form text-center col-4 m-0 mt-5">
    <h1 class="mt-5">LOGIN</h1>
    <div class="form-group">
        <input type="text" id="login" class="form-control" name="login" placeholder="login">
    </div>
    <div class="form-group">
      <input type="password" id="password" class="form-control" name="password" placeholder="password">  
    </div>
    <div class="form-group">
       <input type="submit" class="form-control" name="submit"> 
    </div>
</form>
</body>
</html>



