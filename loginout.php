<?php
header('content-type:text/html;charset=utf-8');

session_start();
//释放session
unset($_SESSION['buys']);
echo "<script language=javascript>alert('退出成功');window.location.href='index.php';</script>";
