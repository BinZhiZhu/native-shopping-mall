<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$Id = $_REQUEST['Id'];

if(empty($_REQUEST['submit'])){
    
    $sql = "select * from t_fenlei where Id = $Id";

    $data = exeRead($sql);
}


    


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">
    
   
    
</head>
 

<body>


<table class="usertableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">查看分类信息</th>
        </tr>
        
    </table>
    <br>
    <form method="post"   action="fenleiupdate.php?submit=1&Id=<?php echo $Id;?>"  onsubmit="return checkform()"  enctype="multipart/form-data">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
  <tbody>
    
    
    <tr>
    
       <td align="right" width="30%">
      <span style="font-weight: bold;">商品分类名:</span></td>
      <td><input type="text" name="fname" id="fnameid" size="40" value="<?php echo $data[0]['fname'];?>" readonly="readonly" /></td>
      
    </tr>
    
  
    
     <tr>
       <td align="right" width="30%">
      <span style="font-weight: bold;">操作:</span></td>
      
      <td>
       &nbsp; &nbsp; &nbsp; &nbsp;
      
      <input  onclick="javascript:history.go(-1);"  type="button" value="&nbsp;&nbsp;返&nbsp;&nbsp;回&nbsp;&nbsp;" style="width: 80px;" />
      
      
      </td>
      
    </tr>
    
  
    
  </tbody>
</table>
</form>
</body>
</html>