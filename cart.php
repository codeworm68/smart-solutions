<?php
include './dbconfig.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Cart - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                <div id="header">
                    <?php
                    include('header.php');
                    ?>
                </div>
                <div class="content" style="min-height: 450px;">
                    <form action="addtocart.php" method="post">
                        <div style="background-color: #F3F3F3;width: 920px;margin: 50px 0px 20px 0px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <?php
                                if (isset($_COOKIE[$cookie_name])) {
                                    $num = 0;
                                    ?>
                                    <tr bgcolor="#F3F3F3">
                                        <td  valign="top"  style="padding: 10px;">
                                            <table border="0" width="100%" style="border-top: 1px solid #CCC;">
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="activeItemsHead" style="border-top: none">
                                                            <span class="readyToBuy">Items in your Shopping cart - ready to buy now </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <?php
                                                $cartArr = json_decode($_COOKIE[$cookie_name]);
                                                foreach ($cartArr as $keyid => $qty) {

                                                    $query_product = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id WHERE b_product.pro_id = '" . $keyid . "' AND b_product.status='1'";
                                                    $result_product = mysqli_query($con, $query_product);
                                                    if (mysqli_num_rows($result_product) > 0) {
                                                        $row = mysqli_fetch_array($result_product);
                                                        $num++;
                                                        $pname = $row ['pro_name'];
                                                        $price = $row ['price'];
                                                        $total = $total + $price * $qty;
                                                        $qtt = "qty" . $num;
                                                        $t_id = "temp" . $num;
                                                        ?>
                                                        <tr>
                                                            <td height="80" valign="middle"><img src="<?php echo $row ['img_path']; ?>" height="70" width="110" /></td>
                                                            <td align="left" valign="top">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td colspan="2" class="green_font">
                                                                            <input type="hidden" id="<?php echo $t_id; ?>" name="<?php echo $t_id; ?>" value="<?php echo $row ['pro_id'] ?>" />
                                                                            Name : <?php echo $pname; ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="teamname">Qty : <input type="number" id="<?php echo $qtt; ?>" name="<?php echo $qtt; ?>" value="<?php echo $qty; ?>" min="1" max="10" style="width:50px;padding: 3px;"/></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td class="red_font" valign="middle">Total : <?php echo $price * $qty; ?><br/><br/></td>
                                                            <td align="right" valign="middle" style="padding-right: 20px;"><a href="addtocart.php?dpid=<?php echo $row ['pro_id'] ?>" class="handshape"><img src="images/delete.jpg" height="24" width="24"/></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
                                                    <td colspan="4" align="right">
                                                        <div class="activeItemsHead">
                                                            <input type="hidden" id="count" name="count" value="<?php echo $num; ?>"/>
                                                            <span class="readyToBuy">Your current subtotal: Rs.&nbsp;&nbsp;<?php echo $total; ?></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
                                                    <td align="left" colspan="2">
                                                        <input type="button" value="CONTINUE SHOPPING" class="prdbuttonbuynow" onclick="window.location.href = 'category.php'"/>
                                                    </td>
                                                    <td align="right" height="40" valign="middle" colspan="2">
                                                        <input type="submit" value="Update" class="prdbuttonbuynow"/>
                                                        <a href="checkout.php"  class="prdbuttonmore"> >> PROCEED TO CHECKOUT</a>
                                                    </td>
                                                </tr>

                                                <?php
                                            } else {
                                                ?>
                                                <tr><td height="100">&nbsp;</td></tr>
                                                <tr>
                                                    <td align="center">
                                                        <h3>You have no items in your shopping basket.</h3>
                                                    </td>
                                                </tr>
                                                <tr><td>&nbsp;</td></tr>
                                                <tr>
                                                    <td align="center">
                                                        <input type="button" value="CONTINUE SHOPPING" class="prdbuttonbuynow" onclick="window.location.href = 'category.php'"/>
                                                    </td>
                                                </tr>
                                                <tr><td height="100">&nbsp;</td></tr>
                                                <?php
                                            }
                                            ?>

                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>

                </div>
                <div class="clear">&nbsp;</div>
                <?php
                include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>
