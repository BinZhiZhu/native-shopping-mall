<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';



$goodsid = $_REQUEST["goodsid"];

$url ="pingjialist2.php?goodsid=$goodsid";

//组装查询条件
$where  = " where ";

 



$where = $where." goodsid=$goodsid and status='已评价'  ";

//获取并检查当前页pagenum参数
$pagenum = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
//把pagenum与1对比 取中间最大值
$pagenum = max($pagenum, 1);
//每页显示条数
$pageSize = 10;
//偏移量
$offset = ($pagenum - 1) * $pageSize;

//查询数据列表信息
$sql = " select * from t_pingjia  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_pingjia $where";

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
class="J-option-trigger option-switch__option option-switch__option--selected" href="javascript:void(0)"   >评价查看</A> 
<SPAN class=option-switch__delimiter></SPAN>


</DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">

 <A class=btn  href="goods.php?Id=<?php echo $goodsid?>" >返回</A>

<TABLE  border=1 cellSpacing=0 cellPadding=0 width="100%">
  <THEAD>
  <TR class=chose-tt>
    <TH >评价用户</TH>
    <TH >购买数量</TH>
    <TH >评价类型</TH>
    <TH >评价内容</TH>    
    <TH >评价时间</TH>
    <TH >评价状态</TH>
    </TR></THEAD>
  <TBODY>
  
<?php 
foreach ($dataArray as $val){
?>
    

	
  <TR class=blocks begtime="00:05" ttype="D601" name="checi">
    <TD><?php echo $val["name"]?></STRONG></TD>
    <TD><?php echo $val["shuliang"]?></TD>
    <TD><?php echo $val["pleixing"]?></TD>
    <TD><?php echo $val["pcontent"]?></TD>
    <TD><?php echo $val["ctime"]?></TD>
    <TD><?php echo $val["status"]?></TD>


    
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


