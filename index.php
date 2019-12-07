<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

$url ="index.php?1=1";

$fenleiid = !empty($_REQUEST['fenleiid'])?$_REQUEST['fenleiid']:'';

$pname = !empty($_REQUEST['pname'])?$_REQUEST['pname']:'';

$tuijian = !empty($_REQUEST['tuijian'])?$_REQUEST['tuijian']:'';

//组装查询条件
$where  = " where ";

if(!empty($_REQUEST['fenleiid'])){
    
    $where = $where." fenleiid like '%$fenleiid%' and ";
    
    $url = $url."&fenleiid=".$fenleiid;
}   

if(!empty($_REQUEST['pname'])){

    $where = $where." pname like '%$pname%' and ";

    $url = $url."&pname=".$pname;
}

if(!empty($_REQUEST['tuijian'])){

    $where = $where." tuijian like '%$tuijian%' and ";

    $url = $url."&tuijian=".$tuijian;
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
$sql = " select * from t_goods  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_goods $where";

$dataTotal = exeRead($sql);

$total =  $dataTotal[0]['total'];


$pageinfo = pages($total,$pageSize,$pagenum,$url,"共有".$total."条记录");


?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0034)http://tz.meituan.com/dianying/all -->
<HTML><HEAD>

<META content="IE=7.0000" http-equiv="X-UA-Compatible">
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

<A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected" href="index.php?tuijian=已推荐" >
热销推荐
</A> 
<SPAN class=option-switch__delimiter></SPAN>

<?php 
$sql = " select * from t_fenlei";

$fenleidata = exeRead($sql);

foreach($fenleidata as $value){
 ?>   
 
 <A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected" href="index.php?fenleiid=<?php echo $value["Id"];?>" >
<?php echo $value["fname"];?>
</A> 
<SPAN class=option-switch__delimiter></SPAN>
 
 <?php    
}

?>



 </DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">
<UL class=reco-slides__slides>
  <LI>
  
  <?php 
    foreach ($dataArray as $value){
   ?>
  
  
   <DIV class=reco-movieinfo>
   <A class=reco-movieinfo__cover  href="goods.php?Id=<?php echo $value['Id']?>" >
   <IMG src="uploadfile/<?php echo $value['pic']?>" width=156 height=210 border="0"> 
   </A>
  <H2>
  <A class=reco-movieinfo__name    href="goods.php?Id=<?php echo $value['Id']?>"  >  <?php echo $value['pname']?></A>
  </H2>
   
 <STRONG class=rates><?php echo $value['price']?>元</STRONG><br/>
 
    分类:<?php echo $value['fname']?>
  
  <A class=btn  href="cartadd.php?goodsid=<?php echo $value['Id']?>" >加入购物车</A> </DIV>
  
  <?php 
      }
   ?>
  
  
  </LI>

  </UL>

<STRONG class=rates>
<?php echo $pageinfo;?>
</STRONG>
  
 
</DIV>
</DIV>
</DIV>






</DIV><!-- bd end --></DIV><!-- bdw end -->

 </DIV><!-- doc end -->





 </BODY></HTML>


