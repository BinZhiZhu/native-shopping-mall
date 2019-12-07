<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

if(empty($_REQUEST['submit'])){
    
    $sql = "select * from t_orders where Id = $Id";

    $data = exeRead($sql);
    
   
}




?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">
    
    
    
</head>
 

<body>


<table class="usertableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">查看订单信息</th>
        </tr>
        
    </table>
    <br>
    <form method="post"   action="ordersdelete.php?submit=1&Id=<?php echo $Id;?>"  onsubmit="return checkform()"  enctype="multipart/form-data">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
  <tbody>
    
    
     <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">订单状态:</span></td>
      <td>
      <?php echo $data[0]['status'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">订单号:</span></td>
      <td>
      <?php echo $data[0]['ordersid'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">订单号下订单的用户:</span></td>
      <td>
      <?php echo $data[0]['username'];?>
      </td>
      
    </tr>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">收货人姓名:</span></td>
      <td>
      <?php echo $data[0]['name'];?>
      </td>
      
    </tr>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">手机号码:</span></td>
      <td>
      <?php echo $data[0]['tel'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">收货地址:</span></td>
      <td>
      <?php echo $data[0]['address'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">备注:</span></td>
      <td>
      <?php echo $data[0]['remark'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">生成时间:</span></td>
      <td>
      <?php echo $data[0]['ctime'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">支付方式:</span></td>
      <td>
      <?php echo $data[0]['payway'];?>
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品购买详情:</span></td>
      <td>
      <?php echo $data[0]['goodsinfo'];?>
      </td>
      
    </tr>
    
   
    
    
    
     <tr>
       <td align="right" width="30%">
      <span style="font-weight: bold;">操作:</span></td>
      
      <td>
       &nbsp; &nbsp; &nbsp; &nbsp;
     
      
      <input  onclick="javascript:history.go(-1);"  type="button" value="&nbsp;&nbsp;返&nbsp;&nbsp;回&nbsp;&nbsp;" style="width: 80px;" />
      
      
      </td>
      
    </tr>
    
  
    
  </tbody>
</table>
</form>
</body>
</html>