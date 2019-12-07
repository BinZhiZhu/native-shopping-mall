<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';
//确认收货
$Id = $_REQUEST['Id'];

$sql = " update t_orders set status='已收货' where Id=$Id ";

exeWrite($sql);

echo "<script language=javascript>alert('操作成功');window.location.href='orderslist.php';</script>";

exit;


