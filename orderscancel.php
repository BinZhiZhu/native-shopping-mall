<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';
//取消订单
$Id = $_REQUEST['Id'];

$sql = " update t_orders set status='已取消' where Id=$Id ";

exeWrite($sql);

$sql = " select * from t_pingjia where ordersid=$Id ";

$pingjialist = exeRead($sql);


foreach ($pingjialist as $pingjia){
    
   $goodsid = $pingjia["goodsid"];
   $shuliang = $pingjia["shuliang"];
   
   $sql = " update t_goods set buys=buys-$shuliang where Id=$goodsid ";
   
   exeWrite($sql);
   
   $pingjiaid = $pingjia['Id'];
   
   $sql = " delete from t_pingjia where Id=$pingjiaid ";
   
   exeWrite($sql);
   
}




echo "<script language=javascript>alert('操作成功');window.location.href='orderslist.php';</script>";

exit;


