<?php
header('content-type:text/html;charset=utf-8');

include_once '../lib/fun.php';


//关联到商家
session_start();
$userID = $_SESSION['user'][0]['Id'];

$sql = " select * from t_user where Id='$userID'";

$data = exeRead($sql);
$user = $data[0];

if (!empty($_REQUEST['submit'])) {

    $name = trim($_REQUEST['name']);
    $tel = trim($_REQUEST['tel']);

    //图片上传
    $pic = imgUpload("../uploadfile/", $_FILES['file']);

    if ($pic === "图片类型验证错误,请上传png或者gif或者jpg格式") {
        echo "<script language=javascript>alert('图片类型验证错误,请上传png或者gif或者jpg格式');window.location.href='merch_info.php';</script>";
        exit;
    }


    $username = $user['username'];//用户名

    $sql = " select * from t_user where username='$username'";

    $data = exeRead($sql);

    if (is_array($data) && !empty($data)) {
        $sql = " update t_user set name='$name', tel='$tel', avatar='$pic' where Id=$userID ";

//        print_r($sql);exit;
        $result = exeWrite($sql);

        if ($result) {
            echo "<script language=javascript>alert('修改成功');window.location.href='merch_info.php';</script>";
            exit;
        } else {
            echo "<script language=javascript>alert('修改失败');window.location.href='merch_info.php';</script>";
            exit;
        }
    } else {
        echo "<script language=javascript>alert('修改失败');window.location.href='merch_info.php';</script>";
        exit;
    }


}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <link href="css/main.css" type="text/css" rel="stylesheet">


    <script language="javascript" type="text/javascript">

        function checkform() {

            // if (document.getElementById('file').value=="")
            // {
            //     alert("头像不能为空");
            //     return false;
            // }
            //
            return true;

        }


    </script>
</head>


<body>


<br>
<form action="merch_info.php?submit=1" method="post" onsubmit="return checkform()" enctype="multipart/form-data">
    <table class="table" cellspacing="1" cellpadding="2" width="90%" align="center" border="1">
        <tbody>

        <tr>
            <td align="center" colspan="2"><span style="font-weight: bold;font-size: 22px;">修改信息</span></td>

        </tr>

        <tr>

            <td align="right" width="30%">
                <span style="font-weight: bold;">头像:</span></td>
            <td><input type="file" id="file" name="file"/></td>
        </tr>

        <?php
        if ($user['avatar']) {
            ?>
            <tr>

                <td align="right" width="30%">
                    <span style="font-weight: bold;">头像图片:</span></td>
                <td>
                    <img src="../uploadfile/<?php echo $user['avatar']; ?>" width="150px" height="150px;"/>
                </td>

            </tr>
            <?php
        }
        ?>

        <tr>
            <td align="right" width="30%">
                <span style="font-weight: bold;">姓名:</span>
            </td>
            <td>
                <input type="text" name="name" style="width: 300px;height: 25px;" id="nameid"
                       value="<?php echo $user['name']; ?>"/>
            </td>
        </tr>

        <tr>
            <td align="right" width="30%">
                <span style="font-weight: bold;">手机号码:</span>
            </td>
            <td>
                <input type="text" name="tel" style="width: 300px;height: 25px;" id="telid"
                       value="<?php echo $user['tel']; ?>"/>
            </td>

        </tr>

        <!--    <tr>-->
        <!--        <td align="right" width="30%">-->
        <!--            <span style="font-weight: bold;">姓名:</span>-->
        <!--        </td>-->
        <!--        <td>-->
        <!--            <input type="text" name="address" style="width: 300px;height: 25px;" id="addressid"-->
        <!--                   value="--><?php //echo $user['address'] ?><!--"/>-->
        <!--        </td>-->
        <!---->
        <!--    </tr>-->


        <tr>
            <td align="right" width="30%">
                <span style="font-weight: bold;">操作:</span>
            </td>
            <td>
                &nbsp; &nbsp; &nbsp; &nbsp;
                <input type="submit" value="&nbsp;&nbsp;提&nbsp;&nbsp;交&nbsp;&nbsp;" style="width: 80px;"/>
                &nbsp; &nbsp; &nbsp; &nbsp;

            </td>

        </tr>


        </tbody>
    </table>
</form>
</body>
</html>