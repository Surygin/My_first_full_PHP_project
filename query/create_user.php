<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$msg_danger = 'Этот эл. адрес уже занят другим пользователем.';
$msg_success = 'Пользователь добавлен';

$status = $_POST['user_status'];
$img_name = $_FILES['user_avatar']['name'];
$new_img_name = name_for_avatar($img_name);
$img_path  =  $_FILES['user_avatar']['tmp_name'];

$new_user = [
  'name'    =>  $_POST['user_name'],
  'job'     =>  $_POST['user_job'],
  'phone'   =>  $_POST['user_phone'],
  'geo'     =>  $_POST['geo'],
  'email'   =>  $_POST['user_email'],
  'psw'     =>  md5($_POST['user_psw']),
  'status'  =>  convert_status($status),
  'vk'      =>  $_POST['user_vk'],
  'tm'      =>  $_POST['user_tm'],
  'im'      =>  $_POST['user_im'],
  'avatar'  =>  $new_img_name,
];

$data = get_id_by_email($new_user['email']);

if(!empty($new_user['email'] and !empty($new_user['psw']))){
  if (!empty($data)){
    set_flash_message($msg_danger);
    set_flash_message_status(false);
    header('Location:../users.php');
    exit;
  }
  else{
    #add_user_plus($new_user['email'], $new_user['psw'], $new_user['name'], $new_user['job'], $new_user['phone'], $new_user['geo'], $new_user['status'], $new_user['vk'], $new_user['tm'], $new_user['im'], $new_user['avatar']);
    add_user($new_user['email'], $new_user['psw']);
    $id = get_id_by_email($new_user['email']);
    add_user_info_main($new_user['name'], $new_user['job'], $new_user['phone'], $new_user['geo'], $id);
    add_user_info_social($new_user['vk'], $new_user['tm'], $new_user['im'], $id);
    add_user_info_status($new_user['status'], $id);
    add_user_avatar($new_user['avatar'], $id);
    move_uploaded_file($img_path, '../' . $new_user['avatar']);
    set_flash_message($msg_success);
    set_flash_message_status(true);
    header('Location:http://localhost:8888/dz-php/dz1/users.php');
  };
};




#header('Location:http://localhost:8888/dz-php/dz1/users.php');

?>