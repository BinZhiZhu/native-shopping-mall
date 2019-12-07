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

$sql = " select * from t_cart AS c LEFT JOIN  t_goods AS g ON c.goodsid = g.id where userid=$userid ";

$cartlist = exeRead($sql);


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
                       href="javascript:void(0)">我的购物车</A>
                    <SPAN class=option-switch__delimiter></SPAN>

                </DIV>

                <DIV class=recommend-movies__slides-w>

                    <DIV style="WIDTH: 940px" class="reco-slides J-option-content">
                        <TABLE border=1 cellSpacing=0 cellPadding=0 width="100%">
                            <THEAD>
                            <TR class=chose-tt>
                                <TH>商品名</TH>
                                <TH>商品图片</TH>
                                <TH>销售单价</TH>
                                <TH>购买数量</TH>
                                <TH>价格小计</TH>
                                <TH>操作</TH>
                            </TR>

                            </THEAD>

                            <TBODY>

                            <?php
                            $totalPrice = 0;
//                            var_dump($cartlist);exit;
                            foreach ($cartlist as $var) {

                                $totalPrice = $totalPrice + $var["sumprice"];

                                ?>

                                <TR class=blocks begtime="00:05" ttype="D601" name="checi">
                                    <TD><?php echo $var["goodsname"] ?></STRONG></TD>
                                    <TD><IMG src="uploadfile/<?php echo $var['pic']?>" width=80 height=80 border="0"> </TD>
                                    <TD>

                                        <?php echo $var["price"] ?>元

                                    </TD>
                                    <TD>

                                        <input type="text" name="sl" value="<?php echo $var["shuliang"] ?>"
                                               id="<?php echo $var["Id"] ?>_num" size="5"/>&nbsp;
                                        <a href="javascript:;" onclick="changenum(<?php echo $var["Id"] ?>)">变更</a>
                                        &nbsp;
                                    </TD>
                                    <TD>

                                        <?php echo $var["sumprice"] ?>元

                                    </TD>


                                    <TD>
                                        <A class=btn href="cartdelete.php?Id=<?php echo $var["Id"] ?>">取消购买</A>
                                    </TD>
                                </TR>

                                <?php
                            }
                            ?>


                            <TR class=blocks begtime="00:05" ttype="D601" name="checi">
                                <TD colspan="3">
                                    <span style="font-size: 25px;font-weight: bold;">总价:<?php echo $totalPrice ?>元</span>
                                </TD>


                                <TD colspan="2">
                                    <A class=btn href="ordersadd.php">&nbsp;生&nbsp;成&nbsp;订&nbsp;单&nbsp;</A>
                                </TD>
                            </TR>

                            </TBODY>

                        </TABLE>


                    </DIV>
                </DIV>
            </DIV>


        </DIV><!-- bd end --></DIV><!-- bdw end -->

</DIV><!-- doc end -->


</BODY>
</HTML>

