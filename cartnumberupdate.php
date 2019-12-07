<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

session_start();

//判断用户是否登录
if(!isset($_SESSION['buys']) || empty($_SESSION['buys']))
{
   echo "<script language=javascript>alert('请先登录');window.location.href='login.php';</script>";
   exit;
}


$Id = $_REQUEST['Id'];

$shuliang = $_REQUEST['shuliang'];

$sql = " select * from t_cart where Id=$Id ";

$cartData = exeRead($sql);

$sumPrice = $cartData[0]["price"]*$shuliang;


$sql =" update t_cart set shuliang=$shuliang , sumPrice=$sumPrice where Id=$Id ";

if(exeWrite($sql)){

    echo "<script language=javascript>alert('操作成功');window.location.href='cartlist.php';</script>";
    exit;
}else{
    echo "<script language=javascript>alert('操作失败');window.location.href='cartlist.php';</script>";
    exit;
}

