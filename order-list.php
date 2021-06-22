<?php
include './dbconfig.php';
$error = "";
if (!empty($user_id)) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Order History - SMART SOLUTIONS</title>
            <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
            <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
            <script type="text/javascript" src="js/crawler.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
        </head>
        <body onload="emailchk();">
            <div id="wrapper">
                <div id="container">
                    <div id="header">
                        <?php
                        include('header.php');
                        ?>
                    </div>
                    <div id="center-page">
                        <table border="0" width="100%">
                            <tr>
                                <td>
                                    <?php
                                    include('custmenu.php');
                                    ?>
                                </td>
                                <td width="800" valign="top">
                                    <form action="" method="post">
                                        <table cellpadding="2" cellspacing="2" border="0">
                                            <tr>
                                                <td colspan="5"><h2>Order History</h2></td>
                                            </tr>
                                            <tr bgcolor="#ccc">
                                                <td width="188" align="center" height="30"><strong>S.No.</strong></td>
                                                <td width="207" align="center"><strong>Invoice No.</strong></td>
                                                <td width="129" align="center"><strong>Amounte</strogn></td>
                                                <td width="110" align="center"><strong>Date</strong></td>
                                                <td width="131" align="center"><strong>Status</strong></td>
                                            </tr>
                                            <?php
                                            $ctr = 0;
                                            $query_order = "SELECT od_id,od_invoice,od_billing_amount,od_date,od_status FROM i_order WHERE user_id = '$user_id' ORDER BY od_id DESC";
                                            $result_order = mysqli_query($con, $query_order);
                                            if (mysqli_num_rows($result_order) > 0) {

                                                while ($row = mysqli_fetch_array($result_order)) {
                                                    $ctr++;
                                                    ?>
                                                    <tr style="background:#f2f2f2;">
                                                        <td  align="center"><?php echo $ctr; ?></td>
                                                        <td align="center"><?php echo $row ['od_invoice']; ?></td>
                                                        <td align="center"><?php echo $row ['od_billing_amount']; ?></td>
                                                        <td align="center"><?php echo $row ['od_date']; ?></td>
                                                        <td align="center"><?php echo $row ['od_status']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" style="border:solid 1px darkgreen;">
                                                            <table cellpadding="2" cellspacing="2" border="0" bgcolor="#f2f2f2" border="0" style="padding: 5px;">
                                                                <tr bgcolor="#f2f2f2">
                                                                    <td width="80" align="center"><strong>Download</strong></td>
                                                                    <td width="188" align="center" height="30"><strong>Product Image</strong></td>
                                                                    <td width="207" align="center"><strong>Product Name</strong></td>
                                                                    <td width="129" align="center"><strong>Unit Price</strogn></td>
                                                                    <td width="110" align="center"><strong>Quantity</strong></td>
                                                                    <td width="131" align="center"><strong>Sub Total</strong></td>
                                                                </tr>
                                                                <?php
                                                                $query_product = "SELECT order_id,product_id,product_image,product_name,product_price,quantity FROM i_order_item WHERE order_id = '".$row ['od_id']."'";
                                                                $result_product = mysqli_query($con, $query_product);
                                                                if (mysqli_num_rows($result_product) > 0) {

                                                                    while ($row1 = mysqli_fetch_array($result_product)) {

                                                                        ?>
                                                                        <tr style="background:#fff;">
                                                                            <td align="center">
                                                                                <!-- <a href="download.php?imgpath=<?php // echo $row1['product_image']; ?>">Download</a> -->
                                                                                <a href="<?php echo $row1['product_image']; ?>" target="_blank">Download</a>
                                                                            </td>
                                                                            <td  align="center">
                                                                                <img src="<?php echo $row1['product_image']; ?>" height="70"/>
                                                                            </td>
                                                                            <td align="center"><?php echo $row1['product_name']; ?></td>
                                                                            <td align="center"><?php echo $row1['product_price']; ?></td>
                                                                            <td align="center"><?php echo $row1['quantity']; ?></td>
                                                                            <td align="center"><?php echo $row1['product_price'] * $row1['quantity']; ?></td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                echo '<tr><td align="center" colspan="5"><h4>No Data.</h4></td></tr>';
                                            }
                                            ?>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <?php
                    include('footer.php');
                    ?>
                </div>
            </div>
        </body>
    </html>
    <?php
} else {
    header("location:login.php?logout=success");
}
?>
