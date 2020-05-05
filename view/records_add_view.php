<!doctype html />
<html>
<head>

<link rel="stylesheet" href="Assets/bootstrap.min.css" />


</head>
<body class="text-center"> 
<header>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal " >Домашний бухгалтер  
  
   </h5>  
   <button class="btn btn-primary"><a href="index.php" style="color:white; text-decoration:none;">На главную</a></button>
</div>

</header>



<?php if( empty( $workmode ) ) : ?>
<h1>Добавить запись</h1>

<form method="POST" action="records_add.php" enctype="multipart/form-data">
	<input type="hidden" name="author" value="<?=$user->id?>"/>
<?php else : if( $workmode == "edit" ) : ?>
<h1>Редактировать запись</h1>

<form method="POST" action="edit_record.php?dtl=<?=$rid?>" enctype="multipart/form-data">

<input type="hidden" name="author" value="<?=$user->id?>"/>
<?php endif ; endif ; ?>
<div class="container">
<div class="input-group mb-1">
  <div class="input-group-prepend">
    <span class="input-group-text " id="titlle">Название:</span>
  </div>
  <input type="text" class="form-control"  name="title" value="<?=$records->title?>">
</div>



<div class="input-group mb-1 ">
  <div class="input-group-prepend">
    <span class="input-group-text" id="titlle" >Описание:</span>
  </div>
  <textarea class="form-control" name="description" placeholder="<?=$description?>"  aria-label="With textarea"><?=$description?></textarea>
</div>

<div class="input-group mb-1 ">
  <div class="input-group-prepend">
    <span class="input-group-text" id="titlle" >Операция:</span>
  </div>
 <input type="number" step="0.01"  class="form-control" name="operation" value="<?=$operation?>">
</div>








<?php if( empty( $workmode ) ) : ?>
<input class=" btn btn-primary" type="submit" value="Добавить запись"/>
<?php else : if( $workmode == "edit" ) : ?>




<input class="btn btn-primary" id="check" type="submit" value="Сохранить изменения"/>
<?php endif ; endif ; ?>

</div>

</form>

<?php
if( ! empty( $msg ) ) {
	foreach( $msg as $m ) :
	?>
	
	<h2 style='color:fuchsia'> <?=$m?> </h2>
	
	<?php endforeach ;
}
if( $add_ok == true ):
 echo "<script>setInterval(
						()=>{
					var v=countdown.innerText-1;
					if(v<0)window.location='index.php';
					else countdown.innerText=v
				},
				1000
			)</script>
			<div class='container' style='text-align:center;'><h1>Данные приняты, через несколько секунд вы окажетесь на главной странице</h1>
			<p id='countdown'>3</p></div>" ;
			exit; ?>

<?php endif; ?>

<script src="Assets/jquery-3.4.1.min.js"></script>


<script>
check.onclick=function()
{
	alert("Данные приняты!");
};
</script>




<script src="Assets/bootstrap.bundle.min.js"></script>
</body>
</html>
