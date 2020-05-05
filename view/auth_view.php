
<!doctype html />
<html>
<head>

<link rel="stylesheet" href="Assets/bootstrap.min.css" />
<style>
  body{
    background-image: url("background/login.jpg");
    background-size:100% 100%;
    background-repeat: no-repeat;
   
    
  }
</style>
</head>
<body class="text-center">

<header>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal " >Домашний бухгалтер </h5>
  <button class="btn btn- btn-primary  mt-1" type="button" ><a href="index.php" style="color:white;  text-decoration:none;">На главную</a></button>
</div>

</header>
    <form class="form-signin" method="POST" action="auth.php">
  <div class="container " style="width:350px; margin-top:15%;">
  <h1 class="h3 mb-3 font-weight-normal" style="Color:white;">Пожалуйста авторизируйтесь</h1>
  <label for="inputLogin"  class="sr-only">Логин</label>
  <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Логин" required="" autofocus="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" style="margin-top:5px;" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required="">
  
  <button class="btn btn- btn-primary mt-3" type="submit">Войти</button>
  
  
</form>


</body>


<script src="Assets/jquery-3.4.1.min.js"></script>
<script src="Assets/bootstrap.min.js"></script>
</body>
</html>