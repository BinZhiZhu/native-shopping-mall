<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';


if (!empty($_REQUEST['submit'])) {

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $verifycode = $_REQUEST['verifycode'];

    session_start();
    //检验验证码咯
    if (trim($verifycode) !== trim($_SESSION['verifycode'])) {
        echo "<script language=javascript>alert('验证码错误');window.location.href='login.php';</script>";
        exit;
    }

    $sql = " select * from t_user where username='$username' and password='$password' and role=2 ";

    $data = exeRead($sql);

    //登录成功
    if (is_array($data) && !empty($data)) {
        //设置session
        session_start();
        $_SESSION['buys'] = $data;
        echo "<script language=javascript>alert('登录成功');window.location.href='index.php';</script>";
        exit;

    } else {
        echo "<script language=javascript>alert('用户名或者密码错误，登录失败');window.location.href='login.php';</script>";
        exit;
    }


}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0034)http://tz.meituan.com/dianying/all -->
<HTML>
<HEAD>
    <META content="IE=7.0000" http-equiv="X-UA-Compatible">
    <TITLE>购物商城用户登录</TITLE>
    <META content="text/html; charset=UTF-8" http-equiv=Content-Type>


    <LINK rel=stylesheet href="_files2/combo.css">
    <LINK rel=stylesheet href="_files2/combo(1).css">

    <META name=msapplication-navbutton-color content=#C3E9F6>
    <META name=msapplication-window content=width=device-width;height=device-height>

    <META name=GENERATOR content="MSHTML 8.00.7601.18210">
    <script type="text/javascript" language="javascript">

        function checkform() {
            if (document.getElementById("usernameid").value == "") {

                alert('用户名不能为空');
                return false;
            }

            var valid = /^\w+$/;
            if (!valid.test(document.getElementById("usernameid").value)) {
                alert('用户名必须是数字，字母或者下划线');
                return false;

            }

            if (document.getElementById("passwordid").value == "") {

                alert('密码不能为空');
                return false;
            }

            if (document.getElementById("passwordid").value.length < 6) {

                alert('密码长度必须大于6位');
                return false;
            }


            document.getElementById('submitid').disabled = "disabled";


            return true;

        }


    </script>
</HEAD>
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
                       href="javascript:void(0)">
                        用户登录</A>
                    <SPAN class=option-switch__delimiter></SPAN>


                </DIV>

                <DIV class=recommend-movies__slides-w>

                    <DIV style="WIDTH: 940px" class="reco-slides J-option-content">
                        <form action="login.php?submit=1" method="post" onsubmit="return checkform()">
                            <table align="center" border="1" cellpadding="5" cellspacing="3" width="100%">
                                <tr>
                                    <td>
                                        用户名:
                                    </td>
                                    <td>
                                        <input type="text" name="username" style="width: 300px;height: 25px;"
                                               id="usernameid"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        密码:
                                    </td>
                                    <td>
                                        <input type="password" name="password" style="width: 300px;height: 25px;"
                                               id="passwordid"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        验证码:
                                    </td>
                                    <td>
                                        <input type="text" placeholder="验证码" name="verifycode" class="captcha"
                                               style="width: 300px;height: 25px;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <img id="captcha_img" src="lib/captcha.php?r=<?php echo rand(); ?>" alt="验证码">
                                        <label><a href="javascript:void(0)" rel="external nofollow"
                                                  onclick="document.getElementById('captcha_img').src='lib/captcha.php?r='+Math.random()">换一个</a>
                                        </label>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        操作
                                    </td>
                                    <td>
                                        <input type="submit" id="submitid" value="&nbsp;登&nbsp;&nbsp;录&nbsp;"
                                               style="width: 100px;height: 30px;"/>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="reset" value="&nbsp;重&nbsp;&nbsp;置&nbsp;"
                                               style="width: 100px;height: 30px;"/>
                                    </td>
                                </tr>

                            </table>

                        </form>


                    </DIV>
                </DIV>
            </DIV>


        </DIV><!-- bd end --></DIV><!-- bdw end -->

</DIV><!-- doc end -->


</BODY>
</HTML>

