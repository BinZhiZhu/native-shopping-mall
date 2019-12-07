<?php
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

$url = "merch_list.php?1=1";

$username = !empty($_REQUEST['username']) ? $_REQUEST['username'] : '';

$name = !empty($_REQUEST['name']) ? $_REQUEST['name'] : '';


//组装查询条件
$where = " where ";

if (!empty($_REQUEST['name'])) {

    $where = $where . " name like '%$name%' and ";

    $url = $url . "&name=" . $name;
}

if (!empty($_REQUEST['username'])) {

    $where = $where . " username like '%$username%' and ";

    $url = $url . "&username=" . $username;
}

$where = $where . " role=3  ";

//获取并检查当前页pagenum参数
$pagenum = isset($_GET['pagenum']) ? intval($_GET['pagenum']) : 1;
//把pagenum与1对比 取中间最大值
$pagenum = max($pagenum, 1);
//每页显示条数
$pageSize = 10;
//偏移量
$offset = ($pagenum - 1) * $pageSize;

//查询数据列表信息
$sql = " select username,name,ctime from t_user  $where order by id desc limit {$offset},{$pageSize}";

$dataArray = exeRead($sql);


//查询记录的总数量
$sql = " select count(Id) as total from t_user $where";

$dataTotal = exeRead($sql);

$total = $dataTotal[0]['total'];


$pageinfo = pages($total, $pageSize, $pagenum, $url, "共有" . $total . "条记录");


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
        <th colspan="3">商家管理</th>
    </tr>

</table>
<br>
<form action="userlist.php?submit=1" method="post">
    <div align="left">

        用户名：<input type="text" name="username" value="<?php echo $username; ?>" style="height: 26px;">
        &nbsp;&nbsp;
        姓名：<input type="text" name="name" value="<?php echo $name; ?>" style="height: 26px;">
        &nbsp;&nbsp;
        <input type="submit" value="&nbsp;搜&nbsp;索&nbsp;" style="width: 60px;">
    </div>
</form>

<table class="table" cellspacing="1" cellpadding="2" width="100%" align="center" border="1">
    <tbody>


    <tr>
        <td>用户名</td>
        <td>姓名</td>
        <!--      <td >手机号码</td>-->
        <!--      <td >收货地址</td>-->
        <td>注册时间</td>


        <td class="td_bg">操作</td>
    </tr>

    <?php
    foreach ($dataArray as $value) {
        ?>

        <tr>

            <td><?php echo $value['username']; ?>&nbsp;</td>
            <td><?php echo $value['name']; ?>&nbsp;</td>
            <!--      <td >--><?php //echo $value['tel'];
            ?><!--&nbsp;</td>-->
            <!--      <td >--><?php //echo $value['address'];
            ?><!--&nbsp;</td>-->
            <td><?php echo $value['ctime']; ?>&nbsp;</td>


            <td class="td_bg">

                <a href="userpassword.php?Id=<?php echo $value['Id']; ?>" onclick="return confirm('确定要重置密码吗?'); ">
                    <span style="font-size: 12px;">重置密码</span></a>
                &nbsp;

                <a href="userdelete.php?Id=<?php echo $value['Id']; ?>" onclick="return confirm('确定要注销用户吗?'); ">
                    <span style="font-size: 12px;">注销商家</span></a>
                &nbsp;


            </td>
        </tr>

        <?php
    }
    ?>


    </tbody>
</table>
<?php echo $pageinfo ?>
</body>
</html>