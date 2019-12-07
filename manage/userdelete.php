<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

$sql = "delete from t_user  where Id=$Id";

if(exeWrite($sql)){

    echo "<script language=javascript>alert('操作成功');window.location.href='userlist.php';</script>";
    exit;
}else{
    echo "<script language=javascript>alert('操作失败');window.location.href='userlist.php';</script>";
    exit;
}

