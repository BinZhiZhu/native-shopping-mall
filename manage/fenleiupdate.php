<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

if(empty($_REQUEST['submit'])){
    
    $sql = "select * from t_fenlei where Id = $Id";

    $data = exeRead($sql);
}


if(!empty($_REQUEST['submit'])){
    
    $fname = $_REQUEST['fname'];

    //关联到商家
    session_start();
    $user = $_SESSION['user'][0];
    $userId = intval($user['Id']);

    $sql = "update t_fenlei set fname ='$fname', mid='$userId' where Id=$Id";
    
    if(exeWrite($sql)){
        
        echo "<script language=javascript>alert('操作成功');window.location.href='fenleilist.php';</script>";
        exit;
    }else{
        echo "<script language=javascript>alert('操作失败');window.location.href='fenleilist.php';</script>";
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
	 
	 if (document.getElementById('fnameid').value=="")
	{
		alert("商品分类名不能为空");
		return false;
	}
	
	 document.getElementById('submitid').disabled="disabled";

	 
	return true;
	
}


</script>
    
</head>
 

<body>


<table class="usertableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">修改分类信息</th>
        </tr>
        
    </table>
    <br>
    <form method="post"   action="fenleiupdate.php?submit=1&Id=<?php echo $Id;?>"  onsubmit="return checkform()"  enctype="multipart/form-data">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
  <tbody>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品分类名:</span></td>
      <td><input type="text" name="fname" id="fnameid" size="40" value="<?php echo $data[0]['fname'];?>" /></td>
      
    </tr>
    
  
    
     <tr>
       <td align="right" width="30%">
      <span style="font-weight: bold;">操作:</span></td>
      
      <td>
       &nbsp; &nbsp; &nbsp; &nbsp;
      <input type="submit" id="submitid" value="&nbsp;&nbsp;提&nbsp;&nbsp;交&nbsp;&nbsp;" style="width: 80px;"/>
      &nbsp; &nbsp; &nbsp; &nbsp;
      
      <input  onclick="javascript:history.go(-1);"  type="button" value="&nbsp;&nbsp;返&nbsp;&nbsp;回&nbsp;&nbsp;" style="width: 80px;" />
      
      
      </td>
      
    </tr>
    
  
    
  </tbody>
</table>
</form>
</body>
</html>