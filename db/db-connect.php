<?php 

$dbhost = "localhost";
$dbname = "dz-php";
$user_login = "admin";
$user_psw = "1234";

// Обработка ошибок подключения
try {
  $db = new PDO("mysql:host=localhost;dbname=$dbname", "$user_login", "$user_psw");
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage();
  die();
}

# получение информации о всех пользователях

#$data = $db->query("SELECT * FROM `lesson-8`")->fetchAll(PDO::FETCH_ASSOC);



?>