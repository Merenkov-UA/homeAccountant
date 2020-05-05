
<html>
<head>

<link rel="stylesheet" href="Assets/bootstrap.min.css" />

</head>
<body> 
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-gray">
   <a class="navbar-brand" href="index.php">Домашний бухгалтер</a>

</nav>

</header>




<div class="card mb-3" >
  <div class="row ">
    
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $d_records[ 'title'  ] ?></h5>
        <p class="card-text"><?= $d_records[ 'description'  ] ?></p>
        <p class="card-text"><?= $d_records[ 'operation'  ] ?> грн</p>
        <p class="card-text"><small class="text-muted"><?= $d_records[ 'dt_create'  ] ?></small></p>
        <a href="delete_record.php?dtl=<?=$d_records['id']?>" class="btn btn-primary">Удалить</a> 
        <a href="edit_record.php?dtl=<?=$d_records['id']?>" class="btn btn-primary">Редактировать</a> 
        <a href="index.php" class="btn btn-primary">Назад</a> 
       
      </div>
    </div>
  </div>
</div>









<script src="Assets/jquery-3.4.1.min.js"></script>
<script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>



