<?php 
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

$Id = $_REQUEST["Id"];



if(!empty($_REQUEST['submit'])){
    
    $sql = " select * from t_pingjia where Id=$Id ";
    
    $pingjiaData = exeRead($sql);

    $ordersid = $pingjiaData[0]["ordersid"];
    
    $pleixing = $_REQUEST['pleixing'];
    $pcontent = $_REQUEST['pcontent'];
    
    
    $ctime = getTime();
    
    $sql = " update t_pingjia set pcontent='$pcontent' ,pleixing='$pleixing',status='已评价',ctime='$ctime' where Id=$Id ";
    

    if(exeWrite($sql)){

        echo "<script language=javascript>alert('操作成功');window.location.href='pingjialist.php?ordersid=$ordersid';</script>";
        exit;
    }else{
        echo "<script language=javascript>alert('操作失败');window.location.href='pingjialist.php?ordersid=$ordersid';</script>";
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
商品评价</A> 
<SPAN class=option-switch__delimiter></SPAN>


 </DIV>
 
<DIV class=recommend-movies__slides-w>

<DIV style="WIDTH: 940px" class="reco-slides J-option-content">
<form action="pingjiaupdate.php?submit=1&Id=<?php echo $Id?>" method="post" onsubmit="return checkform()">
    	<table align="center" border="1" cellpadding="5" cellspacing="3" width="100%">
    	<tr>
    	<td>
    	评价类型:
    	</td>
    	<td>
    	<select name="pleixing">
    	<option value="好评">好评</option>
    	<option value="中评">中评</option>
    	<option value="差评">差评</option>
    	</select>
    	</td>
    	</tr>
    	
    	<tr>
    	<td>
    	评价内容:
    	</td>
    	<td>
    	<input type="text" name="pcontent" style="width: 300px;height: 25px;" id="pcontentid" />
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

