<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';
$Id = $_REQUEST['Id'];


$sql = "select * from t_orders where Id = $Id";

$ordersdata = exeRead($sql);
 
 
 

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

<A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected" href="javascript:void(0)" >查看订单详情</A> 
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
                  <TH class=gridViewHeader scope=col>订单状态</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $ordersdata[0]["status"]?>
                  </TH>

                </TR>
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>订单号</TH>
                  <TH class=gridViewHeader scope=col>
                <?php echo $ordersdata[0]["ordersid"]?>
                  </TH>

                </TR>
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>下订单用户</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $ordersdata[0]["username"]?>
                  </TH>

                </TR>
                
                 <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>收货人姓名</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $ordersdata[0]["name"]?>
                  </TH>

                </TR>
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>手机号码</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $ordersdata[0]["tel"]?>
                  </TH>

                </TR>
                
                
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>收货地址</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $ordersdata[0]["address"]?>
                  </TH>

                </TR>
                
               
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>生成时间</TH>
                  <TH class=gridViewHeader scope=col>
                 <?php echo $ordersdata[0]["ctime"]?>
                  </TH>

                </TR>
                
                 <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>备注</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $ordersdata[0]["remark"]?>
                  </TH>

                </TR>
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>支付方式</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $ordersdata[0]["payway"]?>
                  </TH>

                </TR>
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>价格总计</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $ordersdata[0]["totalprice"]?>
                  </TH>

                </TR>
                
                
                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>商品购买详情</TH>
                  <TH class=gridViewHeader scope=col>
                  <?php echo $ordersdata[0]["goodsinfo"]?>
                  </TH>

                </TR>
                
                

                
                
                <TR>
                  <TH class=gridViewHeader style="WIDTH: 50px" scope=col>&nbsp;</TH>
                  <TH class=gridViewHeader scope=col>操作</TH>
                 <TH class=gridViewHeader scope=col align="center" >
           		
					<A class=btn  href="orderslist.php"  >返回</A>
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


