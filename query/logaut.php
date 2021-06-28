<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

unset($_SESSION['login']);
unset($_SESSION['msg']);
unset($_SESSION['user_id']);

header('Location:http://localhost:8888/dz-php/dz1/page_login.php');

?>