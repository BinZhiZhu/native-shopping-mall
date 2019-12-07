<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';
//删除订单
$Id = $_REQUEST['Id'];

$sql = " delete from  t_orders  where Id=$Id ";

exeWrite($sql);

echo "<script language=javascript>alert('操作成功');window.location.href='orderslist.php';</script>";

exit;


