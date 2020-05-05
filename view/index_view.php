<!doctype html />
<html>
<head>

<link rel="stylesheet" href="Assets/bootstrap.min.css" />

</head>
<body> 

<header>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal " >Домашний бухгалтер

  </h5>

  <?php if(empty($users)):?>
  <a class="btn btn-outline-primary" href="reg.php">Регистрация</a>
  <a class="btn ml-1 btn-outline-primary" href="auth.php">Авторизация</a>
  </div>
</header>
<div class="container">
 
  
    <h5 class="mt-0">Добро пожаловать, для продолжения работы, пожалуйста, пройдите регистрацию или авторизируйтесь на сайте.</h5>
  
  
</div>
  <?php endif; ?>
  
  
  
  <?php if(!empty($users)):?>
  <nav class="my-2 my-md-0 mr-md-3">
  <table>
  <tr>
  <td><a class="p-2 btn-outline-danger" id="btn" href="records_add.php">Добавить запись</a></td>
  </tr>
  </table>
  </nav>
   <a class="btn ml-1 btn-outline-primary" href="?logout">Выход</a>
   </div>
</header>

<?php foreach( $all_records as $r ) : ?>
   
  <div class="container">
  <div class="card">
  <div class="card-body">
  <div class="media">
  <div class="media-body">
  <a href="Detail.php?dtl=<?=$r['id']?>" id="dtl">
    <h5 class="mt-0"> <?=$r[ 'title'  ] ?> </b></h5>
  
    
    </a>
  </div>
</div> 

  </div>
</div>
</div>

<?php  endforeach ; endif; ?>
  





<script src="Assets/jquery-3.4.1.min.js"></script>
<script src="Assets/bootstrap.bundle.min.js"></script>

</body>
</html>



