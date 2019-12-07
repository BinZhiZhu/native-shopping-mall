<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';
$Id = $_REQUEST['Id'];

$sql = " update t_goods set vist= vist+1 where  Id = $Id";

exeWrite($sql);

$sql = "select * from t_goods where Id = $Id";

$goodsdata = exeRead($sql);
 
 
 

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

<A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected" href="javascript:void(0)" >查看商品详情</A> 
<SPAN class=option-switch__delimiter></SPAN>

</DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">
<TABLE class=gridView id=ctl00_ContentPlaceHolder2_GridView1 
      style="WIDTH: 100%; BORDER-COLLAPSE: collapse" cellSpacing=0 rules=all 
      border=1>
              <TBODY>
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>商品名</TH>
                  <TH class=gridViewHeader scope=col>
                <?php echo $goodsdata[0]["pname"]?>
                  </TH>

                </TR>
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>商品分类名</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $goodsdata[0]["fname"]?>
                  </TH>

                </TR>
                
                 <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>销售价格</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $goodsdata[0]["price"]?>元
                  </TH>

                </TR>
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>商品图片</TH>
                  <TH class=gridViewHeader scope=col>
               <IMG src="uploadfile/<?php echo $goodsdata[0]['pic']?>" width=200 height=200 border="0"> 
                  </TH>

                </TR>
                
                
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>销量</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $goodsdata[0]["buys"]?>
                  </TH>

                </TR>
                
               
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>点击数</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $goodsdata[0]["vist"]?>
                  </TH>

                </TR>
                
                 <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>商品详情</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $goodsdata[0]["xiangqing"]?>
                  </TH>

                </TR>
                
                
               <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>评价详情</TH>
                  <TH class=gridViewHeader scope=col>
                 <a href="pingjialist2.php?goodsid=<?php echo $goodsdata[0]["Id"]?>">点击查看</a>
                  </TH>

                </TR>
                
               
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>操作</TH>
                 <TH class=gridViewHeader scope=col align="center" >
           		<A class=btn  href="cartadd.php?goodsid=<?php echo $goodsdata[0]["Id"]?>" >加入购物车</A>
           		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<A class=btn  href="index.php"  >返回</A>
                  </TH>
          
                 
                </TR>
               
                
             
              </TBODY>
            </TABLE>
  
 
</DIV>
</DIV>
</DIV>






</DIV><!-- bd end --></DIV><!-- bdw end -->

 </DIV><!-- doc end -->





 </BODY></HTML>


