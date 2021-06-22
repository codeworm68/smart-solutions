<?php
include './dbconfig.php';
if (empty($user_id)) {
    header("location:login.php?status=login");
}

$totPrice = 0;
$itemno = 0;
$cart = array();
$arr = array();
$taxprice = 0;
$total = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Confirmation - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
        <script type="text/javascript">
            function termsCondition() {
                //terms and condition
                if (document.getElementById('chkTerms').checked == false) {
                    alert('Please, Check terms and condition.!!');
                    chkTerms.focus();
                    return false;
                }
            }
        </script>
        <style type="text/css">

            .style2 {
                font-size: 18px;
                font-weight: bold;
            }
            .style3 {font-size: 18px}
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                <div id="header">
                    <?php
                    include('header.php');
                    ?>
                </div>
                <br class="clear" />
                <div id="center-page">
                    <div class="content">

                        <div class="clear">&nbsp;</div>
                        <div class="pay-head">ORDER SUMMARY </div>
                        <form name="" action="payment.php" method="post">
                            <table width="900" border="0" cellpadding="5" >
                                <tr>
                                    <td colspan="5">
                                        <table align="center" width="100%">
                                            <tr>
                                                <td width="50%">
                                                    <table cellpadding="5" cellspacing="5" align="center">
                                                        <tr>
                                                            <td class="note" colspan="2">Billing Information</td>
                                                        </tr>

                                                        <tr>
                                                            <td class="td_text">Name </td>
                                                            <td class="normal_text">:
                                                                <?php echo $_SESSION['BillName']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Address</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillAddress']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Pin Code </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillPinCode']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">City </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillCity']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">State </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillState']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Email ID</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillEmailID']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Contact No.</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['BillContactNo']; ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="top" width="50%">
                                                    <table cellpadding="5" cellspacing="5">
                                                        <tr>
                                                            <td class="note" colspan="2">Shipping Information</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Name </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipName']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Address</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipAddress']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Pin Code</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipPinCode']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">City </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipCity']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">State </td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipState']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="td_text">Contact No.</td>
                                                            <td class="normal_text">: <?php echo $_SESSION['ShipContactNo']; ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div  style="border:solid 1px #ccc;padding: 0px;background: #ccc;margin: 0px;">
                                            <table width="100%" style="padding: 10px;">
                                                <?php
                                                if (isset($_COOKIE[$cookie_name])) { // if cookies exits
                                                    $cartArr = json_decode($_COOKIE[$cookie_name]);
                                                    ?>
                                                    <tr bgcolor="#f2f2f2">
                                                        <td width="188" align="center" height="30"><strong>Product Image</strong></td>
                                                        <td width="207" align="center"><strong>Product Name</strong></td>
                                                        <td width="129" align="center"><strong>Unit Price</strogn></td>
                                                        <td width="110" align="center"><strong>Quantity</strong></td>
                                                        <td width="131" align="center"><strong>Sub Total</strong></td>
                                                    </tr>
                                                    <?php
                                                    $ctr = 1;
                                                    foreach ($cartArr as $keyid => $qty) {

                                                        $query_product = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id WHERE b_product.pro_id = '" . $keyid . "' AND status='1'";
                                                        $result_product = mysqli_query($con, $query_product);
                                                        if (mysqli_num_rows($result_product) > 0) {

                                                            $row = mysqli_fetch_array($result_product);

                                                            $proName = $row ['pro_name'];
                                                            $proImage = $row ['img_path'];
                                                            $price = $row ['price'];
                                                            $itemPrice = $qty * (float) $price;
                                                            $totPrice = $totPrice + $itemPrice;
                                                            $itemno = $itemno + $qty;
                                                            $PROD = "pid" . $ctr;
                                                            $ITM = "item" . $ctr;
                                                            $ctr++;
                                                            ?>
                                                            <tr style="background:#fff;">
                                                                <td  align="center">
                                                                    <img src="<?php echo $proImage; ?>" height="85" width="147"/>
                                                                </td>
                                                                <td align="center"><?php echo $proName; ?></td>
                                                                <td align="center"><?php echo $price; ?></td>
                                                                <td align="center">
                                                                    <input type="hidden" name="<?php echo $PROD; ?>" id="<?php echo $PROD; ?>" value="<?php echo $keyid; ?>"/>
                                                                    <?php echo $qty; ?>
                                                                </td>
                                                                <td align="center"><?php echo $itemPrice; ?></td>

                                                            </tr>
                                                            <?php
                                                        }
                                                        //$taxprice = ($totPrice * 12.5) / 100;
                                                        $taxprice = 0;
                                                        $total = $totPrice - $taxprice;
                                                    }
                                                    //}
                                                    ?>
                                                    <tr>
                                                        <td colspan="4" align="right"><strong> CST/VAT</strong></td>
                                                        <td colspan="1" align="left"><?php echo 0; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="right"> Total without CST/VAT </td>
                                                        <td colspan="1" align="left"><?php echo $total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="left">Items(<b><?php echo $itemno; ?></b>)</td>
                                                        <td colspan="2" align="right"><strong>Total Price</strong></td>
                                                        <td colspan="1" align="left"><input type="text" name="BillingAmount" id="BillingAmount" value="<?php echo $totPrice; ?>" readonly class="cartupdate" style="border: none;font-weight: bold;"/></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;" colspan="3">
                                            <strong>Payment Type</strong>&nbsp;&nbsp;
                                            <input type="radio" name="payment_type" id="payment_online" value="Online" checked/>&nbsp;<strong>Online</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <strong>Card&nbsp;No.&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                            <input type="number" name="card_no" id="card_no" class="input_text" required="" min="0" maxlength="16"/>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <strong>Expiry&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                            <input type="text" name="expiry" id="expiry" class="input_text" required="" maxlength="10"/>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <strong>CVV&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;
                                            <input type="number" name="cvv" id="cvv" class="input_text" required="" maxlength="3"/>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 10px;">
                                            <strong>Name&nbsp;on&nbsp;Card</strong>&nbsp;&nbsp;
                                            <input type="text" name="name_on_card" id="name_on_card" class="input_text" required=""/>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="padding-top: 10px;">
                                            <input type="checkbox" name="chkTerms" id="chkTerms"/>
                                            <span class="readyToPayment">Yes, I accept the terms and conditions. Info </span><br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input class="prdbuttonbuynow" type="button" value="Back" name="btnBack" id="btnBack" onclick="window.history.back()"/>&nbsp;                                              </td>
                                        <td></td>
                                        <td align="right"><input class="prdbuttonmore" type="submit" value="Order Now" name="btnPayment" id="btnPayment" onclick="return termsCondition();" /></td>
                                    </tr>

                                <?php } ?>
                            </table>
                        </form>


                    </div>
                </div>
                <div class="clear">&nbsp;</div>
                <?php
                include('footer.php');
                ?>
            </div>
        </div>

    </body>
</html>
