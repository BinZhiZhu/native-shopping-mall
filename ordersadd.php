<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

session_start();

//判断用户是否登录
if(!isset($_SESSION['buys']) || empty($_SESSION['buys']))
{
    echo "<script language=javascript>alert('请先登录');window.location.href='login.php';</script>";
    exit;
}

$userid = $_SESSION['buys'][0]['Id'];

$sql = " select count(Id) as total from t_cart where userid=$userid ";

$cartCountData = exeRead($sql);

if($cartCountData[0]['total'] <= 0){
    echo "<script language=javascript>alert('购物车为空，生成订单失败');window.location.href='cartlist.php';</script>";
    exit;
}

$payMoney =0;

if(empty($_REQUEST['submit'])){
    
    $sql = " select * from t_cart where userid=$userid ";
    
    $cartList = exeRead($sql);
    
    foreach ($cartList as $cart){
    
        $payMoney = $payMoney+$cart["sumprice"];
    
       
    
    }
}



if(!empty($_REQUEST['submit'])){

    $name = $_REQUEST['name'];
    $tel = $_REQUEST['tel'];
    $address = $_REQUEST['address'];
    $remark = $_REQUEST['remark'];
    $payway = $_REQUEST['payway'];
    
    $ordersid = getBianhao();
    $ctime = getTime();
    
    $sql = " select * from t_user where Id=$userid ";
    
    $userData = exeRead($sql);
    
    $username = $userData[0]["username"];
    
    $uuname = $userData[0]["name"];
    
    
    $sql = "insert into t_orders(ordersid,userid,username,address,tel,remark,ctime,status,name,payway) values
    ('$ordersid','$userid','$username','$address','$tel','$remark','$ctime','未发货','$name','$payway')";
    
    if(!exeWrite($sql)){
        echo "<script language=javascript>alert('生成失败');window.location.href='ordersadd.php';</script>";
        exit;
    }
    
    $sql =" select max(Id) as Id from t_orders " ;
    
    $IdData = exeRead($sql);
    
    
    $ordersId = $IdData[0]["Id"];

    
    $sql = " select * from t_cart where userid=$userid ";
    
    $cartList = exeRead($sql);
    
    $totalPrice = 0;
    $goodsinfo =""; 
    
    foreach ($cartList as $cart){
        
        $totalPrice = $totalPrice+$cart["sumprice"];
        
        $goodsinfo = $goodsinfo."商品名:".$cart["goodsname"].",销售单价:".$cart["price"]
        .",购买数量:".$cart["shuliang"].",价格小计:".$cart["sumprice"]."<br/>";
        
        //更新商品销量
        $goodsid = $cart["goodsid"];
        $shuliang = $cart["shuliang"];
        $price = $cart["price"];
        $goodsname = $cart["goodsname"];
        
        $sql = " update t_goods set buys= buys+$shuliang where  Id = $goodsid";
        
        exeWrite($sql);

        //补充商家ID，应该是去查商家关联的mid

        $gsql = "SELECT * FROM t_goods where Id=$goodsid ";
        $rs = exeRead($gsql);
//        print_r($rs);exit;
        $mid = intval($rs[0]['mid']);

        //生成评价记录
        $sql = "insert into t_pingjia(ordersid,goodsid,shuliang,price,userid,username,name,goodsname,status,mid) values 
            ($ordersId,$goodsid,$shuliang,$price,$userid,'$username','$uuname','$goodsname','未评价','$mid')";
        
        exeWrite($sql);
        

        //删除购物车中的商品
        $cartId =  $cart["Id"];
        
        $sql = " delete from t_cart where Id=$cartId ";
        
        exeWrite($sql);
        
    }
    
    
    
    
    
    $sql = " update t_orders set totalprice=$totalPrice,goodsinfo='$goodsinfo' where Id=$ordersId ";
    

    if(exeWrite($sql)){

        echo "<script language=javascript>alert('操作成功');window.location.href='orderslist.php';</script>";
        exit;
    }else{
        echo "<script language=javascript>alert('操作失败');window.location.href='orderslist.php';</script>";
        exit;
    }

}

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
<script type="text/javascript" language="javascript">

function checkform(){
	
	if(document.getElementById("nameid").value==""){
		
		alert('姓名不能为空');
		return false;
	}
	
	

	
	if(document.getElementById("telid").value==""){
		
		alert('手机号码不能为空');
		return false;
	}
	
	valid = /^0?1[3,4,5,6,7,8,9][0,1,2,3,4,5,6,7,8,9]\d{8}$/;
	
	if(!valid.test(document.getElementById("telid").value)){
		
		alert('请输入正确的手机号码格式');
		return false;
	}

	
	if(document.getElementById("addressid").value==""){
		
		alert('收货地址不能为空');
		return false;
	}
	

	document.getElementById('submitid').disabled="disabled";
	
	
	return true;

}


</script>
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

<A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected" href="javascript:void(0)"  >
生成新订单</A> 
<SPAN class=option-switch__delimiter></SPAN>


 </DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">
<form action="ordersadd.php?submit=1" method="post" onsubmit="return checkform()">
    	<table align="center" border="1" cellpadding="5" cellspacing="3" width="100%">
    	<tr>
    	<td>
    	收货人姓名:
    	</td>
    	<td>
    	<input type="text" name="name" style="width: 300px;height: 25px;"   id="nameid" />
    	</td>
    	</tr>
    	
    	<tr>
    	<td>
    	手机号码:
    	</td>
    	<td>
    	<input type="text" name="tel" style="width: 300px;height: 25px;" id="telid" />
    	</td>
    	</tr>
    	
    	
    	<tr>
    	<td>
    	收货地址:
    	</td>
    	<td>
    	<input type="text" name="address" style="width: 300px;height: 25px;" id="addressid" />
    	</td>
    	</tr>
    	
    	
    	
    	
    	<tr>
    	<td>
    	支付金额:
    	</td>
    	<td>
    	<span style="font-weight: bold;font-size: 20px;">
    	<?php echo $payMoney ?>元
    	</span>
    	</td>
    	</tr>
    	
    	
    	
    	
    	<tr>
    	<td>
    	支付方式:
    	</td>
    	<td>
    	<img src="images/01.jpg" width="100" height="100"  />
    	<input type="radio" name="payway" value="银联支付" checked="checked" />
    	<img src="images/02.jpg" width="100" height="100"/>
    	<input type="radio" name="payway" value="支付宝支付" />
    	<img src="images/03.jpg" width="100" height="100"/>
    	<input type="radio" name="payway" value="微信支付" />
    	</td>
    	</tr>
    	
    	
    	<tr>
    	<td>
    	备注:
    	</td>
    	<td>
    	<input type="text" name="remark" style="width: 300px;height: 25px;" id="remarkid" />
    	</td>
    	</tr>
    	
    	
    	
    	<tr>
    	
    	<td>
    	操作
    	</td>
    	<td >  
    	<input type="submit" id="submitid" value="&nbsp;提&nbsp;&nbsp;交&nbsp;" style="width: 100px;height: 30px;" />
    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    	<input type="reset" value="&nbsp;重&nbsp;&nbsp;置&nbsp;" style="width: 100px;height: 30px;"/>
    	</td>
    	</tr>
    	
    	</table>
    	
    	</form>
  
 
</DIV>
</DIV>
</DIV>






</DIV><!-- bd end --></DIV><!-- bdw end -->

 </DIV><!-- doc end -->





 </BODY></HTML>

