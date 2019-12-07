<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$url ="fenleilist.php?1=1";

$fname = !empty($_REQUEST['fname'])?$_REQUEST['fname']:'';



//组装查询条件
$where  = " where ";

if(!empty($_REQUEST['fname'])){
    
    $where = $where." fname like '%$fname%' and ";
    
    $url = $url."&fname=".$fname;
}    
$where = $where." 1=1  ";

//获取并检查当前页pagenum参数
$pagenum = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
//把pagenum与1对比 取中间最大值
$pagenum = max($pagenum, 1);
//每页显示条数
$pageSize = 10;
//偏移量
$offset = ($pagenum - 1) * $pageSize;

//查询数据列表信息
$sql = " select * from t_fenlei  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_fenlei $where";

$dataTotal = exeRead($sql);

$total =  $dataTotal[0]['total'];


$pageinfo = pages($total,$pageSize,$pagenum,$url,"共有".$total."条记录");



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">
</head>
<body bottommargin="0" leftmargin="0" topmargin="0" rightmargin="0">
    <br>
    <table class="usertableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">商品分类管理</th>
        </tr>
        
    </table>
    <br>
    <form action="fenleilist.php?submit=1" method="post" onsubmit="document.getElementById('submitid').disabled='disabled';" >
<div align="left">
<input type="button" value="添加新分类" onclick="javascript:window.location.href='fenleiadd.php';">
&nbsp;&nbsp;&nbsp;&nbsp;
商品分类名：<input type="text" name="fname" value="<?php echo $fname;?>" style="height: 26px;">
&nbsp;&nbsp;
<input type="submit" id="submitid" value="&nbsp;搜&nbsp;索&nbsp;" style="width: 60px;">
</div>
</form>
  
    <table class="table" cellspacing="1" cellpadding="2" width="100%" align="center" border="1">
  <tbody>
    
    
    <tr>
      <td >商品分类名</td>
     

      <td class="td_bg" >操作</td>
    </tr>
    
    <?php 
    foreach ($dataArray as $value){
        ?>
        
      <tr>
    
      <td ><?php echo $value['fname'];?>&nbsp;</td>
     

      <td class="td_bg" >
	  	
	  <a href="fenleiupdate3.php?Id=<?php echo $value['Id'];?>"><span style="font-size: 12px;">查看</span></a>
      &nbsp;
      <a href="fenleiupdate.php?Id=<?php echo $value['Id'];?>"><span style="font-size: 12px;">更新</span></a>
      &nbsp;
      <a href="fenleidelete.php?Id=<?php echo $value['Id'];?>" onclick="return confirm('确定要删除吗?'); ">
      <span style="font-size: 12px;">删除</span></a>
      &nbsp;
  
      </td>
    </tr>  
        
    <?php 
    }
    ?>
    

  
    
  </tbody>
</table>
<?php echo $pageinfo?>
</body>
</html>