
<?php
//Блок подключение к базе данных
	unset($db_type);
	@include "../db_ini.php";
	if(empty($db_type)){
		echo "Config load error";
		exit;
	}
	$conStr = "$db_type:host=$db_host;dbname=$db_name;charset=$db_enc;";
try{
	$DB=new PDO($conStr, $db_user, $db_pass);
	$DB ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
	echo"CONNECTION ERROR:",$ex->getMessage();
	exit;
}
echo "Успешно вошли <br/><br/>"; //Вывод строки в слувае успешного подключения к базе.

//Блок создание таблицы пользователей при условии её отсутствия
//Строка запроса.
$query=<<<SQL
CREATE TABLE  IF NOT EXISTS Users(
id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
firstname VARCHAR(32),
lastname VARCHAR(32),
surname VARCHAR(32),
email VARCHAR(32),
login VARCHAR(32),
pass_hash CHAR(64),
pass_salt CHAR(32),
registered DATETIME DEFAULT CURRENT_TIMESTAMP,
lastlogin DATETIME 
) engine=InnoDB default charset = utf8 collate=utf8_general_ci

SQL;

//Выполнение запроса.
try{ $DB->query($query);
}catch(Exception $ex)
{
	echo  $ex->getMessage(),"<br/>",$query;
	exit;
}
echo "<br>Запрос выполнен";  //Выводит строку в случае успешного добавления таблицы.

//Первоночальное заполнение таблицы(Не обязательное)
$salt = md5(rand());
$hash = md5('123'.$salt);

$query=<<<SQL
INSERT INTO Users(firstname, lastname, surname, email, login, pass_hash, pass_salt)
VALUES('Захар','Петрович','Кузнецов','test@example.ru','test','$hash','$salt'),
	  ('Иван','Сидорович','Стрельцов','test@meta.ru','manager','$hash','$salt'),
	  ('Кристина','Олеговна','Незнайка','test@yandex.ru','бухгалтер','$hash','$salt'),
	  ('Николай','Петрович','Иванин','test@mail.ru','консультант','$hash','$salt')
SQL;
/*Строка запроса.
	Выполнение запроса.*/
try{ $DB->query($query);
}catch(Exception $ex)
{
	echo  $ex->getMessage(),"<BR>",$query;
	exit;
}
echo "<br>Добавлено успешно"; //Выводит строку в случае успешного заполнения таблицы.

