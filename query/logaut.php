<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

unset($_SESSION['login']);
unset($_SESSION['msg']);
unset($_SESSION['user_id']);

header('Location:../page_login.php');

?>