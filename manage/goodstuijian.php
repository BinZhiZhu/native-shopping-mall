<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

$type = $_REQUEST['type'];

$sql = "";

if($type==1){
    $sql = "update t_goods  set tuijian='已推荐' where Id=$Id";
}else{
    $sql = "update t_goods  set tuijian='未推荐' where Id=$Id";
}




if(exeWrite($sql)){

    echo "<script language=javascript>alert('操作成功');window.location.href='goodslist.php';</script>";
    exit;
}else{
    echo "<script language=javascript>alert('操作失败');window.location.href='goodslist.php';</script>";
    exit;
}

