<!doctype html />
<html>
<head>
<style>
	span {
		display: inline-block ;
		width  : 120px ;
	}

  body{
    background-image: url("background/login.jpg");
    background-size:100% 100%;
    background-repeat: no-repeat;
   
    
  }
h1{
  color:white;
}
</style>
<link rel="stylesheet" href="Assets/bootstrap.min.css" />
</head>

<body class="text-center">

<header>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal " >Домашняя бухгалтерия </h5>
  <button class="btn btn- btn-primary  mt-1" type="button" ><a href="index.php" style="color:white;  text-decoration:none;">На главную</a></button>
</div>


<?php /* print_r($_GET); */ ?>
<h1 >Регистрация нового пользователя</h1>
<form method="POST"   enctype="multipart/form-data" >

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Логин:</span>
  </div>
  <input type="text" class="form-control" name="login" id="login_inp" value="<?=$_SESSION[ 'login' ] ?? ''?>">
  
  <input type="button" onclick="checkLogin()" value="Check for free" />
  <i id="logCheckResult"></i>
</div>
</div>

<div class="container " style="width:500px; ">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Фамилия:</span>
  </div>
  <input type="text" class="form-control" name="surname" value="<?=$_SESSION[ 'surname' ] ?? ''?>">
  
</div>
</div>

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Имя:</span>
  </div>
  <input type="text" class="form-control" name="firstname" value="<?=$_SESSION[ 'firstname' ] ?? ''?>">
  
</div>
</div>

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Отчество:</span>
  </div>
  <input type="text" class="form-control" name="lastname" value="<?=$_SESSION[ 'lastname' ] ?? ''?>">
  
</div>
</div>

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Пароль:</span>
  </div>
  <input type="password" class="form-control" name='pass'>
  
</div>
</div>

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Ещё раз:</span>
  </div>
  <input type="password" class="form-control" name='pass2'>
  
</div>
</div>

<div class="container" style="width:500px;">
<div class="input-group mb-1" style="max-width:400px; ">
  <div class="input-group-prepend">
    <span class="input-group-text ">Емаил:</span>
  </div>
  <input type="email" class="form-control" name="email" value="<?=$_SESSION[ 'email' ] ?? ''?>">
  
</div>
</div>






<input type="submit" class="btn btn-primary" value="Регистрация" />

</form>
<span id="messenger"><?=$msg ?? ''?></span>




<script>
checkLogin = ()=>{
	var logTxt = login_inp.value;
	var x = new XMLHttpRequest();
	x.onreadystatechange = ()=>{
		if(x.readyState == 4) {
			var res = JSON.parse(x.responseText);
			switch(res['status']){
				case 1:
					logCheckResult.innerText = "Свободен";
					break;
				case -1:
					logCheckResult.innerText = "Логин не может быть пустым";
					break;
				case -2:
					logCheckResult.innerText = "Логин содержит недопустимые символы";
					break;
				case -4:
					logCheckResult.innerText = "Логин занят";
					break;
				default:
					logCheckResult.innerText = "Что-то пошло не так..."
			}
		}
	}
	x.open("GET","check_login.php?login=" + logTxt, true);
	x.send(null);	
}


</script>

<script src="Assets/jquery-3.4.1.min.js"></script>

<script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>