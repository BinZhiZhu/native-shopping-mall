<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

$sql = "update  t_user set password='111111' where Id=$Id";

if(exeWrite($sql)){

    echo "<script language=javascript>alert('操作成功,默认密码为111111，请妥善保管');window.location.href='userlist.php';</script>";
    exit;
}else{
    echo "<script language=javascript>alert('操作失败');window.location.href='userlist.php';</script>";
    exit;
}

