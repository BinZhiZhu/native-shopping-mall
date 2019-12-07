<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$url ="orderslist.php?1=1";

$ordersid = !empty($_REQUEST['ordersid'])?$_REQUEST['ordersid']:'';

$username = !empty($_REQUEST['username'])?$_REQUEST['username']:'';



//组装查询条件
$where  = " where ";

if(!empty($_REQUEST['username'])){
    
    $where = $where." username like '%$username%' and ";
    
    $url = $url."&username=".$username;
}   

if(!empty($_REQUEST['ordersid'])){

    $where = $where." ordersid like '%$ordersid%' and ";

    $url = $url."&ordersid=".$ordersid;
}

$where = $where." 1=1  ";

//获取并检查当前页pagenum参数
$pagenum = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
//把pagenum与1对比 取中间最大值
$pagenum = max($pagenum, 1);
//每页显示条数
$pageSize = 10;
//偏移量
$offset = ($pagenum - 1) * $pageSize;

//查询数据列表信息
$sql = " select * from t_orders  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_orders $where";

$dataTotal = exeRead($sql);

$total =  $dataTotal[0]['total'];


$pageinfo = pages($total,$pageSize,$pagenum,$url,"共有".$total."条记录");



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">
</head>
<body bottommargin="0" leftmargin="0" topmargin="0" rightmargin="0">
    <br>
    <table class="usertableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">订单查询</th>
        </tr>
        
    </table>
    <br>
    <form action="orderslist.php?submit=1" method="post">
<div align="left">

订单号：<input type="text" name="ordersid" value="<?php echo $ordersid;?>" style="height: 26px;">
&nbsp;&nbsp;
下订单用户：<input type="text" name="username" value="<?php echo $username;?>" style="height: 26px;">
&nbsp;&nbsp;
<input type="submit" value="&nbsp;搜&nbsp;索&nbsp;" style="width: 60px;">
</div>
</form>
  
    <table class="table" cellspacing="1" cellpadding="2" width="100%" align="center" border="1">
  <tbody>
    
    
    <tr>
      <td >订单号</td>
      <td >生成时间</td>
      <td >下订单用户</td>
      <td >收货人姓名</td>
      <td >支付方式</td>
      <td >价格总计</td>
      <td >订单状态</td>
     

      <td class="td_bg" >操作</td>
    </tr>
    
    <?php 
    foreach ($dataArray as $value){
        ?>
        
      <tr>
    
      <td ><?php echo $value['ordersid'];?>&nbsp;</td>
      <td ><?php echo $value['ctime'];?>&nbsp;</td>
      <td ><?php echo $value['username'];?>&nbsp;</td>
      <td ><?php echo $value['name'];?>&nbsp;</td>
      <td ><?php echo $value['payway'];?>&nbsp;</td>
      <td ><?php echo $value['totalprice'];?>&nbsp;</td>
      <td ><?php echo $value['status'];?>&nbsp;</td>
     

      <td class="td_bg" >
	  	
	  <a href="ordersupdate5.php?Id=<?php echo $value['Id'];?>"><span style="font-size: 12px;">查看订单详情</span></a>
      &nbsp;

    
      
      
      
     
      
  
      </td>
    </tr>  
        
    <?php 
    }
    ?>
    

  
    
  </tbody>
</table>
<?php echo $pageinfo?>
</body>
</html>