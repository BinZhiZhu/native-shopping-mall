<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';






if(!empty($_REQUEST['submit']))
{
   
    $password1 = trim($_REQUEST['password1']);//获取原密码
    $password2 = trim($_REQUEST['password2']);//获取新密码
    
    //开启session
    session_start();
    
    $username = $_SESSION['user'][0]['username'];//用户名
    
    
    $sql = " select * from t_user where username='$username' and password='$password1' ";
    
    $data = exeRead($sql);
    
    //原密码正确
    if(is_array($data) && !empty($data)){
        $sql = " update t_user set password='$password2' where username='$username' ";
        
        $result = exeWrite($sql);
        
        if($result){
            echo "<script language=javascript>alert('修改成功');window.location.href='password.php';</script>";
            exit;
        }else{
            echo "<script language=javascript>alert('修改失败');window.location.href='password.php';</script>";
            exit;
        }
    }else{
        echo "<script language=javascript>alert('原密码错误，修改失败');window.location.href='password.php';</script>";
        exit;
    }
    
    
}    


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">
    
    
    
<script language="javascript" type="text/javascript">

function checkform()
{
	 
	

	if (document.getElementById('password1id').value=="")
	{
		alert("原密码不能为空");
		return false;
	}
	if (document.getElementById('password2id').value=="")
	{
		alert("新密码不能为空");
		return false;
	}
	
	if (document.getElementById('password2id').value.length<6)
	{
		alert("新密码长度必须大于6位");
		return false;
	}
	if (document.getElementById('password2id').value != document.getElementById('password3id').value)
	{
		alert("新密码与新密码确认不一致");
		return false;
	}	 
	return true;
	
}


</script>
</head>
 

<body>



    <br>
    <form action="password.php?submit=1" method="post" onsubmit="return checkform()">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
  <tbody>
    
    <tr>
      <td align="center" colspan="2"><span style="font-weight: bold;font-size: 22px;">修改密码</span></td>
      
    </tr>  
   
    
    <tr>
      <td align="right" width="30%">
      <span style="font-weight: bold;">原密码:</span>
      </td>
      <td>
      <input type="password" name="password1"  id='password1id' size="50">
      </td>
      
    </tr>
    
    <tr>
      <td align="right" width="30%">
      <span style="font-weight: bold;">新密码:</span>
      </td>
      <td>
      <input type="password" name="password2"  id='password2id' size="50">
      </td>
      
    </tr>
    
    <tr>
      <td align="right" width="30%">
      <span style="font-weight: bold;">确认新密码:</span>
      </td>
      <td>
      <input type="password" name="password3"  id='password3id' size="50">
      </td>
      
    </tr>
    
    <tr>
      <td align="right" width="30%">
      <span style="font-weight: bold;">操作:</span>
      </td>
      <td>
       &nbsp; &nbsp; &nbsp; &nbsp;
      <input type="submit" value="&nbsp;&nbsp;提&nbsp;&nbsp;交&nbsp;&nbsp;" style="width: 80px;"/>
      &nbsp; &nbsp; &nbsp; &nbsp;
      
       </td>
      
    </tr>
    
    
    
    
     
    
  
    
  </tbody>
</table>
</form>
</body>
</html>