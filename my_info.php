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

$sql = " SELECT * FROM t_user WHERE id=$userid";

$user = exeRead($sql);

//兼容格式
$user = $user[0];


//更新数据
if (!empty($_REQUEST['submit'])) {

    $name = trim($_REQUEST['name']);
    $tel = trim($_REQUEST['tel']);
    $address = trim($_REQUEST['address']);

    $sql = " UPDATE t_user SET name='$name' ,tel='$tel',address='$address' WHERE id=$userid";

//    print_r($sql);exit;

    $rs = exeWrite($sql);

    if ($rs) {
        echo "<script language=javascript>alert('保存成功');window.location.href='my_info.php';</script>";
        exit;
    } else {
        echo "<script language=javascript>alert('保存失败');window.location.href='my_info.php';</script>";
        exit;
    }

}

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
    <script type="text/javascript" language="javascript">
        //重置表单咯
        function onResetForm() {
            console.log('onResetForm')
            document.getElementById('nameid').value = '';
            document.getElementById('telid').value = '';
            document.getElementById('addressid').value = '';
        }
    </script>
</HEAD>

<style>
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
                    <form action="my_info.php?submit=1" method="post" id="info-form">
                        <table align="center" border="1" cellpadding="5" cellspacing="3" width="100%">
                            <tr>
                                <td>
                                    姓名:
                                </td>
                                <td>
                                    <input type="text" name="name" style="width: 300px;height: 25px;" id="nameid"
                                           value="<?php echo $user['name'] ?>"/>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    手机号码:
                                </td>
                                <td>
                                    <input type="text" name="tel" style="width: 300px;height: 25px;" id="telid"
                                           value="<?php echo $user['tel'] ?>"/>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    收货地址:
                                </td>
                                <td>
                                    <input type="text" name="address" style="width: 300px;height: 25px;" id="addressid"
                                           value="<?php echo $user['address'] ?>"/>
                                </td>
                            </tr>


                            <tr>

                                <td>
                                    操作
                                </td>
                                <td>
                                    <input type="submit" id="submitid" value="&nbsp;保&nbsp;&nbsp;存&nbsp;"
                                           style="width: 100px;height: 30px;"/>
                                </td>
                            </tr>

                        </table>

                    </form>
                </DIV>
            </DIV>


        </DIV><!-- bd end --></DIV><!-- bdw end -->

</DIV><!-- doc end -->


</BODY>
</HTML>

