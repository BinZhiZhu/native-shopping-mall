<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

$url ="orderslist.php?1=1";

$ordersid = !empty($_REQUEST['ordersid'])?$_REQUEST['ordersid']:'';



//组装查询条件
$where  = " where ";

if(!empty($_REQUEST['ordersid'])){
    
    $where = $where." ordersid like '%$ordersid%' and ";
    
    $url = $url."&ordersid=".$ordersid;
}   

session_start();

$userid = $_SESSION['buys'][0]['Id'];

$where = $where." userid=$userid   ";

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
<!-- saved from url=(0034)http://tz.meituan.com/dianying/all -->
<HTML><HEAD><META content="IE=7.0000" http-equiv="X-UA-Compatible">
<TITLE>购物商城</TITLE>
<META content="text/html; charset=UTF-8" http-equiv=Content-Type>


<LINK rel=stylesheet href="_files2/combo.css">
<LINK rel=stylesheet href="_files2/combo(1).css">

<META name=msapplication-navbutton-color content=#C3E9F6>
<META name=msapplication-window content=width=device-width;height=device-height>

<META name=GENERATOR content="MSHTML 8.00.7601.18210">

</HEAD>
<BODY id=index>

<DIV id=doc>

<?php 
include_once 'head.php';
?>

<DIV id=bdw class=bdw>
<DIV id=bd class=cf>

<DIV class=recommend-movies>
<DIV class=option-switch>

<A hideFocus 
class="J-option-trigger option-switch__option option-switch__option--selected" href="javascript:void(0)"   >我的订单</A> 
<SPAN class=option-switch__delimiter></SPAN>


</DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">

<form action="orderslist.php">
订单号:<input type="text" name="ordersid" value="<?php echo $ordersid?>" style="height: 22px;" />

<input type="submit" value="搜索" />

</form>

<br/>
<TABLE  border=1 cellSpacing=0 cellPadding=0 width="100%">
  <THEAD>
  <TR class=chose-tt>
    <TH >订单号</TH>
    <TH >生成时间</TH>
    <TH >收货人姓名</TH>    
    <TH >支付方式</TH>
    <TH >价格总计</TH>
    <TH >订单状态</TH>
    <TH >操作</TH></TR></THEAD>
  <TBODY>
  
<?php 
foreach ($dataArray as $val){
?>
    

	
  <TR class=blocks begtime="00:05" ttype="D601" name="checi">
    <TD><?php echo $val["ordersid"]?></STRONG></TD>
    <TD><?php echo $val["ctime"]?></TD>
    <TD><?php echo $val["name"]?></TD>
    <TD><?php echo $val["payway"]?></TD>
    <TD><?php echo $val["totalprice"]?>元</TD>
    <TD><?php echo $val["status"]?></TD>


    <TD>
    <A class=btn  href="orders.php?Id=<?php echo $val["Id"]?>" >订单详情</A>
   <?php 
   if($val["status"]==='未发货'){
   ?>
    <A class=btn  href="orderscancel.php?Id=<?php echo $val["Id"]?>" >取消订单</A>
    <?php 
   }
    ?>
    
    <?php 
   if($val["status"]==='已取消'){
   ?>
    <A class=btn  href="ordersdelete.php?Id=<?php echo $val["Id"]?>" >删除订单</A>
    <?php 
   }
    ?>
    
    
    <?php 
   if($val["status"]==='已发货'){
   ?>
    <A class=btn  href="ordersqueren.php?Id=<?php echo $val["Id"]?>" >确认收货</A>
    <?php 
   }
    ?>
    
    
    <?php 
   if($val["status"]==='已发货'){
   ?>
    <A class=btn  href="orderstuihuo.php?Id=<?php echo $val["Id"]?>" >退货</A>
    <?php 
   }
    ?>
    
    
    <?php 
   if($val["status"]==='已收货'){
   ?>
    <A class=btn  href="pingjialist.php?ordersid=<?php echo $val["Id"]?>" >评价管理</A>
    <?php 
   }
    ?>
    
    
    </TD>
  </TR>
  
<?php     
}
?>	
	
  
  </c:forEach>
   <TR class=chose-tt>
    <Td colspan="9"><?php echo $pageinfo?></Td>
  </TR>

      </TBODY>
      
      </TABLE>
  
 
</DIV>
</DIV>
</DIV>






</DIV><!-- bd end --></DIV><!-- bdw end -->

 </DIV><!-- doc end -->





 </BODY></HTML>


