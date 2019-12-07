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

$userid = $_SESSION['buys'][0]['Id'];

$goodsid = $_REQUEST['goodsid'];

$sql = " select count(Id) as total from t_cart where userid=$userid and goodsid=$goodsid  ";

$countdata = exeRead($sql);

if($countdata[0]["total"]>0){
    echo "<script language=javascript>alert('该商品已经添加入购物车，请勿重复添加');window.location.href='goods.php?Id=$goodsid';</script>";
    exit;
}

$sql = " select * from t_goods where id=$goodsid ";

$goodsdata = exeRead($sql);

$goodsname = $goodsdata[0]["pname"];

$price = $goodsdata[0]["price"];

$sumprice = $price *1;

$sql = " insert into t_cart(userid,goodsid,goodsname,price,shuliang,sumprice) values
   ($userid,$goodsid,'$goodsname',$price,1,$sumprice) ";


if(exeWrite($sql)){

        echo "<script language=javascript>alert('已成功加入购物车');window.location.href='goods.php?Id=$goodsid';</script>";
        exit;
}else{
        echo "<script language=javascript>alert('操作失败');window.location.href='goods.php?Id=$goodsid';</script>";
        exit;
}
