<?php
header('content-type:text/html;charset=utf-8');

include_once './lib/fun.php';


if (!empty($_REQUEST['submit'])) {

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $name = '商家';
    $sql = " select count(Id) as total from t_user where username='$username' ";

    $userdata = exeRead($sql);

    if ($userdata[0]['total'] > 0) {
        echo "<script language=javascript>alert('注册失败，该用户名已经存在');window.location.href='merch_register.php';</script>";
        exit;

    }

    date_default_timezone_set('Asia/Shanghai');

    $ctime = @date('Y-m-d');

    // 3 默认是商家
    $role = 3;
    $sql = "insert into t_user(username,password,role,name,tel,address,ctime) values
    ('$username','$password','$role','$name','','','$ctime')";

    if (exeWrite($sql)) {

        echo "<script language=javascript>alert('注册成功');window.location.href='login.php';</script>";
        exit;
    } else {
        echo "<script language=javascript>alert('注册失败');window.location.href='merch_register.php';</script>";
        exit;
    }

}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0034)http://tz.meituan.com/dianying/all -->
<HTML>
<HEAD>
    <META content="IE=7.0000" http-equiv="X-UA-Compatible">
    <TITLE>购物商城用户注册</TITLE>
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

            if (document.getElementById("passwordid").value != document.getElementById("password2id").value) {

                alert('确认密码和原密码不一致');
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
                        商家注册</A>
                    <SPAN class=option-switch__delimiter></SPAN>


                </DIV>

                <DIV class=recommend-movies__slides-w>

                    <DIV style="WIDTH: 940px" class="reco-slides J-option-content">
                        <form action="merch_register.php?submit=1" method="post" onsubmit="return checkform()">
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
                                        确认密码:
                                    </td>
                                    <td>
                                        <input type="password" name="password2" style="width: 300px;height: 25px;"
                                               id="password2id"/>
                                    </td>
                                </tr>


                                <tr>

                                    <td>
                                        操作
                                    </td>
                                    <td>
                                        <input type="submit" id="submitid" value="&nbsp;注&nbsp;&nbsp;册&nbsp;"
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

