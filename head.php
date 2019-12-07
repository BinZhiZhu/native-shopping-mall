<?php 
header('content-type:text/html;charset=utf-8');

//开启session
@session_start();
//购买商品的用户是否登录
$buys_logined = true;

if(!isset($_SESSION['buys']) || empty($_SESSION['buys']))
{
    $buys_logined =  false;
}


?>



<DIV id=hdw>
<DIV id=hd>
<DIV id=site-top class=cf>

<DIV class=city-info>
<a href=".">
<span style="font-size: 30px;font-weight: bold;color: white;">
购物商城
</span>
</a>
</DIV>
<br/><br/>
<DIV class=site-info>
</DIV>
<DIV class=search-w>
<DIV class="search cf">

<FORM class="search-form J-search-form" method=post name=searchForm action="index.php">
<INPUT class=s-text tabIndex=1 name="pname" onFocus="this.value=''" value="请输入商品名进行搜索" x-webkit-speech autocomplete="off"> 
<INPUT hideFocus class=s-submit value=搜索 type=submit> 
</FORM>

<DIV class=s-hot></DIV></DIV>
<DIV style="DISPLAY: none" class="search-suggest J-search-suggest">
<UL class="search-suggest__list J-search-suggest-list"></UL></DIV></DIV></DIV>
<DIV id=site-nav class=site-nav>



<DIV class="nav-wrapper cf">
<UL class=nav>
  <LI>
  <A href="./" ><SPAN class=nav-label>首页</SPAN></A></LI>
  
  
<?php 
//用户未登录状态
if(!$buys_logined){
?>

<LI>
  <A href="register.php" ><SPAN class=nav-label>用户注册</SPAN></A></LI>
	
  <LI><A href="login.php"  ><SPAN class=nav-label>用户登录</SPAN></A></LI>

<?php 
}
?>

<?php 
//用户登录状态
if($buys_logined){
?>

<LI >
 <A href="cartlist.php" ><SPAN class=nav-label>我的购物车</SPAN></A></LI>
    <A href="my_info.php"><SPAN class=nav-label>我的信息</SPAN></A></LI>

    <A href="orderslist.php" ><SPAN class=nav-label>我的订单</SPAN></A></LI>
 
 <LI>
  <A href="loginout.php"  ><SPAN class=nav-label>退出登录</SPAN></A></LI>
  <LI>
  
  <A href=""  ><SPAN class=nav-label>欢迎<?php  echo $_SESSION['buys'][0]['username']; ?>登录本网站</SPAN></A>

<?php 
}
?>
  
  
  <A href="manage/login.php" ><SPAN class=nav-label>管理后台</SPAN></A></LI>

  
  
 

	
  

 

  </UL>
</DIV></DIV></DIV>
</DIV>


