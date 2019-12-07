<?php
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';

session_start();
if (!checkLogin()) {
    echo "<script language=javascript>alert('请先登录');window.location.href='login.php';</script>";
    exit;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>

    <title>购物商城管理后台</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/default.css" type="text/css" rel="stylesheet">

    <script language="javascript" src="js/menu.js" type="text/javascript"></script>

</head>
<body onLoad="javascript:border_left('left_tab1','left_menu_cnt1');">
<form id="form1">
    <table id="indextablebody" cellpadding="0">
        <thead>
        <tr>
            <th>
                    <span style="font-size: 20px;font-weight: bold;">
                       
                       </span>
            </th>
            <th>

                <a style="color: #16547E">
                    用户 ：<?php echo $_SESSION['user'][0]['username']; ?></a>&nbsp;&nbsp; <a style="color: #16547E">
                    身份 ：<?php echo $_SESSION['user'][0]['name']; ?></a>&nbsp;&nbsp;

            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="menu">
                <ul class="bigbtu">
                    <li id="now01"><a title="安全退出" href="loginout.php">安全退出</a></li>


                </ul>
            </td>
            <td class="tab">
                <ul id="tabpage1">


                </ul>
            </td>
        </tr>
        <tr>
            <td class="t1">
                <div id="contents">
                    <table cellpadding="0">
                        <tr class="t1">
                            <td>
                                <div class="menu_top">
                                </div>
                            </td>
                        </tr>
                        <tr class="t2">
                            <td>
                                <div id="menu" class="menu">


                                    <ul class="tabpage2">
                                        <li id="left_tab1" title="操作菜单"
                                            onClick="javascript:border_left('left_tab1','left_menu_cnt1');">
                                            <span>菜单</span></li>
                                    </ul>
                                    <div id="left_menu_cnt1" class="left_menu_cnt">
                                        <ul id="dleft_tab1">
                                            <!--                                            商家-->
                                            <?php
                                            if ($_SESSION['user'][0]['role'] == 3) {
                                                ?>
                                                <li id="now11"><a href="password.php"
                                                                  target="content3"><span>修改密码</span></a></li>
                                                <li id="now11"><a href="loginout.php"><span>退出系统</span></a></li>
                                                <li id="now11"><a href="fenleilist.php"
                                                                  target="content3"><span>商品分类管理</span></a>
                                                </li>
                                                <li id="now11"><a href="goodslist.php"
                                                                  target="content3"><span>商品管理</span></a></li>

                                                <li id="now11"><a href="pingjialist.php"
                                                                  target="content3"><span>商品评价管理</span></a>
                                                </li>


                                            <?php }
                                            ?>
                                            <!--                                            管理员-->
                                            <?php
                                            if ($_SESSION['user'][0]['role'] == 1) {
                                                ?>
                                                <li id="now11"><a href="password.php"
                                                                  target="content3"><span>修改密码</span></a></li>
                                                <li id="now11"><a href="loginout.php"><span>退出系统</span></a></li>
                                                <li id="now11"><a href="userlist.php"
                                                                  target="content3"><span>用户管理</span></a></li>
                                                <li id="now11"><a href="merch_list.php"
                                                                  target="content3"><span>商家管理</span></a></li>
                                                <li id="now11"><a href="orderslist.php"
                                                                  target="content3"><span>待发货订单</span></a>
                                                </li>


                                                <li id="now11"><a href="orderslist3.php"
                                                                  target="content3"><span>待退货订单</span></a>
                                                </li>

                                                <li id="now11"><a href="orderslist2.php"
                                                                  target="content3"><span>订单查询</span></a>
                                                </li>
                                            <?php }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="clear">
                                    </div>


                                </div>
                        <tr class="t3">
                            <td>
                                <div class="menu_end">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td class="t2">
                <div id="cnt">
                    <div id="dtab1">
                        <iframe name="content3" src="main.php" frameborder="0"></iframe>
                    </div>


                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <script>
        //修改标题
        function show_title(str) {
            document.getElementById("spanTitle").innerHTML = str;
        }
    </script>
</form>
</body>
</html>


