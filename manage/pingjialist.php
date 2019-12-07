<?php 
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$url ="pingjialist.php?1=1";

$username = !empty($_REQUEST['username'])?$_REQUEST['username']:'';

$goodsname = !empty($_REQUEST['goodsname'])?$_REQUEST['goodsname']:'';

$pleixing = !empty($_REQUEST['pleixing'])?$_REQUEST['pleixing']:'';

//组装查询条件
$where  = " where ";


if(!empty($_REQUEST['pleixing'])){

    $where = $where." pleixing like '%$pleixing%' and ";

    $url = $url."&pleixing=".$pleixing;
}

if(!empty($_REQUEST['goodsname'])){
    
    $where = $where." goodsname like '%$goodsname%' and ";
    
    $url = $url."&goodsname=".$goodsname;
}   

if(!empty($_REQUEST['username'])){

    $where = $where." username like '%$username%' and ";

    $url = $url."&username=".$username;
}

$where = $where." status='已评价'  ";

//获取并检查当前页pagenum参数
$pagenum = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
//把pagenum与1对比 取中间最大值
$pagenum = max($pagenum, 1);
//每页显示条数
$pageSize = 10;
//偏移量
$offset = ($pagenum - 1) * $pageSize;

//查询数据列表信息
$sql = " select * from t_pingjia  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_pingjia $where";

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
    <table class="pingjiatableborder" cellspacing="1" cellpadding="3" width="96%" align="center"
        border="0">
        <tr>
            <th colspan="3">评价管理</th>
        </tr>
        
    </table>
    <br>
    <form action="pingjialist.php?submit=1" method="post">
<div align="left">

用户名：<input type="text" name="username" value="<?php echo $username;?>" style="height: 26px;">
&nbsp;&nbsp;
商品名：<input type="text" name="goodsname" value="<?php echo $goodsname;?>" style="height: 26px;">
&nbsp;&nbsp;
评价类型：
<select name="pleixing">
<option value="">所有选项</option>
<option value="好评" <?php if ($pleixing==='好评'){ echo 'selected';} ?>  >好评</option>
<option value="中评" <?php if ($pleixing==='中评'){ echo 'selected';} ?>>中评</option>
<option value="差评" <?php if ($pleixing==='差评'){ echo 'selected';} ?>>差评</option>
</select>
&nbsp;&nbsp;
<input type="submit" value="&nbsp;搜&nbsp;索&nbsp;" style="width: 60px;">
</div>
</form>
  
    <table class="table" cellspacing="1" cellpadding="2" width="100%" align="center" border="1">
  <tbody>
    
    
    <tr>
      <td >评价用户</td>
      <td >评价商品</td>
      <td >购买数量</td>
      <td >评价类型</td>
      <td >评价内容</td>
      <td >评价时间</td>
     

      <td class="td_bg" >操作</td>
    </tr>
    
    <?php 
    foreach ($dataArray as $value){
        ?>
        
      <tr>
    
      <td ><?php echo $value['username'];?>&nbsp;</td>
      <td ><?php echo $value['goodsname'];?>&nbsp;</td>
      <td ><?php echo $value['shuliang'];?>&nbsp;</td>
      <td ><?php echo $value['pleixing'];?>&nbsp;</td>
      <td ><?php echo $value['pcontent'];?>&nbsp;</td>
      <td ><?php echo $value['ctime'];?>&nbsp;</td>
     

      <td class="td_bg" >
	  	
	
      <a href="pingjiadelete.php?Id=<?php echo $value['Id'];?>" onclick="return confirm('确定要删除吗?'); ">
      <span style="font-size: 12px;">删除评价</span></a>
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