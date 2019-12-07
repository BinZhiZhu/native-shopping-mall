<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

if(empty($_REQUEST['submit'])){
    
    $sql = "select * from t_goods where Id = $Id";

    $data = exeRead($sql);
    
    $sql = " select * from t_fenlei  ";
    
    $fenleidata = exeRead($sql);
    
}


if(!empty($_REQUEST['submit'])){
    
    $fenleiid = $_REQUEST['fenleiid'];
    $pname = $_REQUEST['pname'];
    $price = $_REQUEST['price'];
    $xiangqing = $_REQUEST['xiangqing'];
    
    $pic ="";

    //仅当用户选择上传图片 才进行图片上传处理
    if($_FILES['file']['size'] > 0)
    {
        //图片上传
       $pic = imgUpload("../uploadfile/",$_FILES['file']);
       
       if($pic==="图片类型验证错误,请上传png或者gif或者jpg格式"){
           echo "<script language=javascript>alert('图片类型验证错误,请上传png或者gif或者jpg格式');window.location.href='goodsupdate.php?Id=$Id';</script>";
           exit;
       }
    }else{
        $sql = "select * from t_goods where Id = $Id";
        
        $data = exeRead($sql);
        
        $pic = $data[0]["pic"];
        
    }
    
 
   
    $sql = " select * from t_fenlei where Id=$fenleiid ";
    
    $data = exeRead($sql);
    
    $fname = $data[0]["fname"];

    //关联到商家
    session_start();
    $user = $_SESSION['user'][0];
    $userId = intval($user['Id']);

    
    $sql = " update t_goods set fenleiid=$fenleiid,fname='$fname',pname='$pname',pic='$pic',price='$price',
    xiangqing='$xiangqing', mid='$userId' where id=$Id";
    
    if(exeWrite($sql)){
        
        echo "<script language=javascript>alert('操作成功');window.location.href='goodslist.php';</script>";
        exit;
    }else{
        echo "<script language=javascript>alert('操作失败');window.location.href='goodslist.php';</script>";
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
	 
	 if (document.getElementById('pnameid').value=="")
	{
		alert("商品名不能为空");
		return false;
	}

	
	
	
	if (document.getElementById('priceid').value=="")
	{
		alert("销售价格不能为空");
		return false;
	}
	
	
 var reg1 =  /^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$/;
 
 var reg2 =  /^\d+$/;
 
 var flag = 0;
 if(document.getElementById('priceid').value.match(reg1) != null){
 	flag=1
 }
  if(document.getElementById('priceid').value.match(reg2) != null){
 	flag=1
 }
 

	if (flag==0)
	{
		alert("销售价格必须为正数");
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
            <th colspan="3">修改商品信息</th>
        </tr>
        
    </table>
    <br>
    <form method="post"   action="goodsupdate.php?submit=1&Id=<?php echo $Id;?>"  onsubmit="return checkform()"  enctype="multipart/form-data">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
  <tbody>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">所属商品分类:</span></td>
      <td>
      	
      	<select name="fenleiid">
      	<?php 
      	foreach ($fenleidata as $value){
      	?>
      		<option value="<?php echo $value["Id"];?>" 
      		<?php 
      		if($value["Id"]===$data[0]['fenleiid'])
      		    echo 'selected';
      		?>
      		><?php echo $value["fname"];?></option>
      	<?php 
      	}
      	?>
      	</select>
      
      </td>
      
    </tr>
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品名:</span></td>
      <td><input type="text" name="pname" value="<?php echo $data[0]['pname'];?>" id="pnameid" size="40" /></td>
      
    </tr>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品图片:</span></td>
      <td>
      <img  src="../uploadfile/<?php echo $data[0]['pic'];?>" width="150px" height="150px;" />
      </td>
      
    </tr>
    
    
     <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">重新上传商品图片:</span></td>
      <td><input type="file"  id="file" name="file" /></td>
      
    </tr>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">销售价格(元):</span></td>
      <td><input type="text" name="price" value="<?php echo $data[0]['price'];?>" id="priceid" size="40" /></td>
      
    </tr>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品详情:</span></td>
      <td>
        <textarea rows="7" cols="50" name="xiangqing" ><?php echo $data[0]['xiangqing'];?></textarea>

      
      
      </td>
      
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