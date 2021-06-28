<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$user_id = $_SESSION['user_id'];


$msg_danger = 'Ошибка данных';
$msg_danger2 = 'Такой email уже занят';
$msg_success = 'Запись обновлена';

$update_user = [
  'mail'      =>  $_POST['user_mail'],
  'psw'    =>  md5($_POST['user_psw']),
  'id'     =>  $_POST['user_id'],
];

$old_info = get_id_by_email($update_user['mail']);

if ($user_id == $update_user['id'] or $_SESSION['user_role'] == 'admin'){
  if(!empty($old_info) and $old_info != $user_id){
    set_flash_message($msg_danger2);
    set_flash_message_status(false);
    header('Location:'.$_SERVER['HTTP_REFERER'].'');
  } 
  else {
  update_user_info_security($update_user['mail'], $update_user['psw'], $update_user['id']);
  set_flash_message($msg_success);
  set_flash_message_status(true);
  header('Location:http://localhost:8888/dz-php/dz1/users.php');
  }
}
else {
  set_flash_message($msg_danger);
  set_flash_message_status(false);
};
