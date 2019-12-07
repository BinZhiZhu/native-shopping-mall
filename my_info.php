<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';

session_start();

//判断用户是否登录
if (!isset($_SESSION['buys']) || empty($_SESSION['buys'])) {
    echo "<script language=javascript>alert('请先登录');window.location.href='login.php';</script>";
    exit;
}

$userid = $_SESSION['buys'][0]['Id'];

//$sql = " select c.*,g.pic from t_cart AS c LEFT JOIN  t_goods AS g ON c.goodsid = g.id where userid=$userid ";
$sql = " SELECT * FROM t_user WHERE id=$userid";

$user = exeRead($sql);

//兼容格式
$user = $user[0];

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0034)http://tz.meituan.com/dianying/all -->
<HTML>
<HEAD>
    <META content="IE=7.0000" http-equiv="X-UA-Compatible">
    <TITLE>购物商城</TITLE>
    <META content="text/html; charset=UTF-8" http-equiv=Content-Type>


    <LINK rel=stylesheet href="_files2/combo.css">
    <LINK rel=stylesheet href="_files2/combo(1).css">

    <META name=msapplication-navbutton-color content=#C3E9F6>
    <META name=msapplication-window content=width=device-width;height=device-height>

    <META name=GENERATOR content="MSHTML 8.00.7601.18210">


    <script language="javascript" type="text/javascript">

        function changenum(id) {
            var num = document.getElementById(id + "_num").value;

            var reg1 = /^\d+$/;
            if (num.match(reg1) == null) {
                alert("购买数量必须为正整数");
                return false;
            }
            if (num == 0) {
                alert("购买数量必须大于0的正整数");
                return false;
            }
            var now = new Date();
            var t = now.getTime() + '';
            window.location.href = "cartnumberupdate.php?Id=" + id + "&shuliang=" + num + "&t=" + t;


        }

    </script>

</HEAD>

<style>
    .my-info-list{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .option-switch{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>
<BODY id=index>

<DIV id=doc>

    <?php
    include_once 'head.php';
    ?>

    <DIV id=bdw class=bdw>
        <DIV id=bd class=cf>

            <DIV class=recommend-movies>
                <DIV class=option-switch>

                    <A hideFocus class="J-option-trigger option-switch__option option-switch__option--selected"
                       href="javascript:void(0)">我的信息</A>
                    <SPAN class=option-switch__delimiter></SPAN>

                </DIV>

                <DIV class=recommend-movies__slides-w>
                    <div class="my-info-list">
                        <div class="">昵称：<?php echo $user['name']?></div>
                        <div class="">联系电话：<?php echo $user['tel']?></div>
                        <div class="">地址：<?php echo $user['address']?></div>
                        <div class="">注册时间：<?php echo $user['ctime']?></div>
                    </div>
                </DIV>
            </DIV>


        </DIV><!-- bd end --></DIV><!-- bdw end -->

</DIV><!-- doc end -->


</BODY>
</HTML>

