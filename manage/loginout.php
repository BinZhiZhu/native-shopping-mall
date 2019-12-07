<?php
header('content-type:text/html;charset=utf-8');
include_once '../lib/fun.php';
session_start();
//释放user
unset($_SESSION['user']);
echo "<script language=javascript>alert('退出成功');window.location.href='login.php';</script>";
