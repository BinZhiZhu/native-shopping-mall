<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

if(!empty($_REQUEST['submit']))
{
    $username = trim($_REQUEST['username']);//获取用户名
    $password = trim($_REQUEST['password']);//获取密码
    $verifycode = $_REQUEST['verifycode'];

    session_start();
    //检验验证码咯
    if (trim($verifycode) !== trim($_SESSION['verifycode'])) {
        echo "<script language=javascript>alert('验证码错误');window.location.href='login.php';</script>";
        exit;
    }

    //判断用户名不能为空
    if(!$username)
    {
        echo "<script language=javascript>alert('用户名不能为空');window.location.href='login.php';</script>";
        exit;
    }
    
    //判断密码是否为空
    if(!$password)
    {
        echo "<script language=javascript>alert('密码不能为空');window.location.href='login.php';</script>";
        exit;
    
    }
    
    //sql查询语句，查询用户名和密码在数据库中是否存在
    $sql = "select * from t_user where username='$username' and password='$password' and role=1 LIMIT 1";
    
   
    $data = exeRead($sql);

    //登录成功
    if(is_array($data) && !empty($data))
    {
        //设置session
        session_start();
        $_SESSION['user'] = $data;
        //弹出登录成功的对话框
        echo "<script language=javascript>alert('登录成功');window.location.href='index.php';</script>";
    }
    else
    {
        //弹出登录失败的对话框
        echo "<script language=javascript>alert('用户名或者密码错误');window.location.href='login.php';</script>";

    }

    
    
}    






?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>购物商城管理后台</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="147"  background="images/top02.gif" align="center">
    <span style="font-size: 40px;font-weight: bold;color: black;">

    购物商城管理后台</span>
    </td>
  </tr>
</table>
<table width="562" border="0" align="center" cellpadding="0" cellspacing="0" class="right-table03">
  <tr>
    <td width="221"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="login-text01">
      
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="login-text01">
          <tr>
            <td align="center"><img src="images/ico13.gif" width="107" height="97" /></td>
          </tr>
          <tr>
            <td height="40" align="center">&nbsp;</td>
          </tr>
          
        </table></td>
        <td><img src="images/line01.gif" width="5" height="292" /></td>
      </tr>
    </table></td>
  
    
    
    <td>
     <form method="post"   action="login.php?submit=1" onsubmit="document.getElementById('submitid').disabled='disabled';">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="31%" height="35" class="login-text02">用户名：<br /></td>
        <td width="69%"><input name="username" type="text" style="width: 150px;" /></td>
      </tr>
      <tr>
        <td height="35" class="login-text02">密　码：<br /></td>
        <td><input name="password" type="password" style="width: 150px;" /></td>
      </tr>
        <tr>
            <td height="35" class="login-text02">验证码：<br/></td>
            <td>
                <input type="text" placeholder="验证码" style="width: 150px;" name="verifycode" class="captcha">
            </td>
        </tr>
        <tr>
            <td height="35" class="login-text02"><br/></td>
            <td>
                <div style="display: flex;align-items: center">
                    <img id="captcha_img" src="/lib/captcha.php?r=<?php echo rand(); ?>" alt="验证码">
                    <a href="javascript:void(0)" rel="external nofollow"
                       style="text-decoration: none;padding-left: 10px;font-size: 12px"
                       onclick="document.getElementById('captcha_img').src='/lib/captcha.php?r='+Math.random()">换一个</a>
                </div>
            </td>
        </tr>


        <tr>
        <td height="35">&nbsp;</td>
        <td>
        	<input name="Submit2" id='submitid'  type="submit" class="right-button01" value="&nbsp;&nbsp;登&nbsp;&nbsp;录&nbsp;&nbsp;"  />
          
          <input name="Submit232" type="button"  onclick="window.location.href='../';" class="right-button01" value="返回首页" />
          
          
          </td>
      </tr>
    </table>
    </form>
    
    </td>
  </tr>
</table>
</body>
</html>