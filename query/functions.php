<?php 

#получение id пользователя по email 
function get_id_by_email($email){
  global $db;
  $sql = $db->query("SELECT * FROM `users` WHERE login = '$email'")->fetchAll(PDO::FETCH_ASSOC);
  return $sql[0]['id'];
};

#проверка на совпадение по двум полям в таблице пользователей
function autorization_user($email, $psw){
  global $db;
  $sql = $db->query("SELECT * FROM `users` WHERE `login` = '$email' AND `password` = '$psw' ")->fetchAll(PDO::FETCH_ASSOC);
  return $sql[0]['id'];
};

#получение информации о пользователе по id
function get_user_by_id($id){
  global $db;
  $sql = $db->query("SELECT * FROM `users` WHERE `id` = '$id'")->fetchAll(PDO::FETCH_ASSOC);
  return $sql;
};

#получение информации о всех пользователях
function get_all_users(){
  global $db;
  $sql = $db->query("SELECT * FROM `users`")->fetchAll(PDO::FETCH_ASSOC);
  return $sql;
};

# установка логина в сессию
function set_login_user($user){
  $_SESSION['login'] = $user;
  return $_SESSION['login'];
};

#установка флеш сообщения
function set_flash_message($text){
  $_SESSION['msg'] =  $text;
  return $_SESSION['msg'];
};

#установка статуса флеш сообщения
function set_flash_message_status($status){
  $_SESSION['status'] =  $status;
  return $_SESSION['status'];
};

#добавление пользователя в таблицу 
function add_user($login, $psw){
  global $db;
  $insert = $db->prepare("INSERT INTO `users` (`login`, `password`) VALUES (:some_login, :some_psw)");
  $insert->bindParam(":some_login", $login);
  $insert->bindParam(":some_psw", $psw);
  $insert->execute();
  return true;
};

#проверка на автоизацию
function login_or_not($login){
  if (empty($login)){
    header('Location:http://localhost:8888/dz-php/dz1/page_login.php');
}
}

#проверка на админа
function admin_or_not($user){
  if($user != 'admin'){
    header('Location:http://localhost:8888/dz-php/dz1/users.php');
  };
}

# установка id пользователя в сессию
function set_id_user($user){
  $_SESSION['user_id'] = $user;
  return $_SESSION['user_id'];
};

# получение роли пользователя в сессию
function get_role_user($user){
  $role = $user[0]['role'];
  return $role;
};

# установка роли пользователя в сессию
function set_role_user($role){
  $_SESSION['user_role'] = $role;
  return $_SESSION['user_role'];
};

# получение Имени пользователя в сессию
function get_firstName_user($user){
  $name = $user[0]['firstName'];
  return $name;
};

#добавление пользователя в таблицу для Админа
function add_user_for_admin($user_info){
  global $db;
  $insert = $db->prepare("INSERT INTO `users` (`login`, `password`, `firstName`, `role`, `phone`, `geo`, `status`, `VKlink`, `TMlink`, `IMlink`) VALUES (:some_login, :some_psw, :some_name, :some_job, :some_phone, :some_geo, :some_status, :some_vk, :some_tm, :some_im)");
  $insert->execute([
    'some_login'    =>  $user_info['email'],
    'some_psw'      =>  $user_info['psw'],
    'some_name'     =>  $user_info['name'],
    'some_job'      =>  $user_info['job'],
    'some_phone'    =>  $user_info['phone'],
    'some_geo'      =>  $user_info['geo'],
    'some_status'   =>  $user_info['status'],
    'some_vk'       =>  $user_info['vk'],
    'some_tm'       =>  $user_info['tm'],
    'some_im'       =>  $user_info['im'],
  ]);
  return true;
};

#добавление пользователя в таблицу 
function add_user_plus($login, $psw, $name, $job, $phone, $geo, $status, $vk, $tm, $im, $img){
  global $db;
  $insert = $db->prepare("INSERT INTO `users` (`login`, `password`, `firstName`, `jobRole`, `phone`, `geo`, `status`, `VKlink`, `TMlink`, `IMlink`, `img`) VALUES (:some_login, :some_psw, :some_name, :some_job, :some_phone, :some_geo, :some_status, :some_vk, :some_tm, :some_im, :some_img)");
  $insert->bindParam(":some_login", $login);
  $insert->bindParam(":some_psw", $psw);
  $insert->bindParam(":some_name", $name);
  $insert->bindParam(":some_job", $job);
  $insert->bindParam(":some_phone", $phone);
  $insert->bindParam(":some_geo", $geo);
  $insert->bindParam(":some_status", $status);
  $insert->bindParam(":some_vk", $vk);
  $insert->bindParam(":some_tm", $tm);
  $insert->bindParam(":some_im", $im);
  $insert->bindParam(":some_img", $img);
  $insert->execute();
  return true;
};

#########################################################
#разбитая на кусочку функция добавления нового юзера в БД
#########################################################

function add_user_info_main($name, $job, $phone, $geo, $id){
  global $db;
  $insert = $db->prepare("UPDATE `users` SET `firstName` = :some_name, `jobRole` = :some_job, `phone` = :some_phone, `geo` = :some_geo WHERE (id = :some_id)");
  $insert->bindParam(":some_name", $name);
  $insert->bindParam(":some_job", $job);
  $insert->bindParam(":some_phone", $phone);
  $insert->bindParam(":some_geo", $geo);
  $insert->bindParam(":some_id", $id);
  $insert->execute();
  return true;
};

function add_user_info_social($vk, $tm, $im, $id){
  global $db;
  $insert = $db->prepare("UPDATE `users` SET `VKlink` = :some_vk, `TMlink` = :some_tm, `IMlink` = :some_im WHERE (id = :some_id)");
  $insert->bindParam(":some_vk", $vk);
  $insert->bindParam(":some_tm", $tm);
  $insert->bindParam(":some_im", $im);
  $insert->bindParam(":some_id", $id);
  $insert->execute();
  return true;
};


function add_user_info_status($status, $id){
    global $db;
    $insert = $db->prepare("UPDATE `users` SET `status` = :some_status WHERE (id = :some_id)");
    $insert->bindParam(":some_status", $status);
    $insert->bindParam(":some_id", $id);
    $insert->execute();
    return true;
};

function update_user_info_security($mail, $psw, $id){
  global $db;
  $insert = $db->prepare("UPDATE `users` SET `login` = :some_mail, `password` = :some_psw WHERE (id = :some_id)");
  $insert->bindParam(":some_mail", $mail);
  $insert->bindParam(":some_psw", $psw);
  $insert->bindParam(":some_id", $id);
  $insert->execute();
  return true;
};


function add_user_avatar($img_name, $id){
    global $db;
    $insert = $db->prepare("UPDATE `users` SET `img` = :some_img WHERE (id = :some_id)");
    $insert->bindParam(":some_img", $img_name);
    $insert->bindParam(":some_id", $id);
    $insert->execute();
    return true;

};

function name_for_avatar($file_name){
  if (!empty($file_name)){
    $name = 'img/demo/avatars/' . uniqid('avatar-') . '.jpg';
  } 
  return $name;
};

function delete_avatar_file($file_path){
  if (!empty($file_path)){
    unlink($file_path);
  }
};

function user_delete($id){
  global $db;
  $insert = $db->prepare("DELETE FROM `users` WHERE (id = :some_id)");
  $insert->bindParam(":some_id", $id);
  $insert->execute();
  return true;
};

#########################################################
#########################################################
#########################################################

#конвертация статуса 
function convert_status($status){
  if($status == 'Онлайн'){
    $status = 'success';
  }
  else if ($status == 'Отошел'){
    $status = 'danger';
  }
  else if ($status == 'Не беспокоить'){
    $status = 'warning';
  };
  return $status;
};

?>