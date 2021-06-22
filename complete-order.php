<?php
include 'dbconfig.php';
if (!empty($user_id)) {
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title>Delivered Order List - SMART SOLUTIONS</title>
             <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
            <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
            <script type="text/javascript" src="js/crawler.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
        </head>
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
                                <td valign="top">
                                    <?php
                                    include('custmenu.php');
                                    ?>
                                </td>
                                <td width="80%" class="right_content" valign="top">
                                    <table width="100%">
                                        <tr>
                                            <td align="left">
                                                <h2>Complete Order</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left">
                                                <table cellpadding="2" cellspacing="2" border="0" width="100%">
                                                    <tr bgcolor="#ccc">
                                                        <td width="188" align="center" height="30"><strong>S.No.</strong></td>
                                                        <td width="207" align="center"><strong>Invoice No.</strong></td>
                                                        <td width="129" align="center"><strong>Amounte</strogn></td>
                                                        <td width="110" align="center"><strong>Date</strong></td>
                                                         <td width="110" align="center"><strong>Billing&nbsp;Name</strong></td>
                                                        <td width="110" align="center"><strong>Billing&nbsp;Address</strong></td>
                                                        <td width="110" align="center"><strong>User&nbsp;Name</strong></td>
                                                    </tr>
                                                    <?php
                                                    $ctr = 0;
                                                    $query_order = "SELECT o.od_id,o.od_invoice,o.od_billing_amount,o.od_date,o.od_status,o.od_billing_name,o.od_billing_address,u.name FROM i_order o JOIN users u WHERE o.user_id= u.id AND o.od_status = 'Cancelled'";
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
                                                                <td align="center"><?php echo $row ['od_billing_name']; ?></td>
                                                                <td align="center"><?php echo $row ['od_billing_address']; ?></td>
                                                                <td align="center"><?php echo $row ['name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="7" style="border:solid 1px darkgreen;">
                                                                    <table cellpadding="2" cellspacing="2" border="0" bgcolor="#f2f2f2" border="0" style="padding: 5px;" width="100%">
                                                                        <tr bgcolor="#f2f2f2">
                                                                            <td width="188" align="center" height="30"><strong>Product Image</strong></td>
                                                                            <td width="207" align="center"><strong>Product Name</strong></td>
                                                                            <td width="129" align="center"><strong>Unit Price</strogn></td>
                                                                            <td width="110" align="center"><strong>Quantity</strong></td>
                                                                            <td width="131" align="center"><strong>Sub Total</strong></td>
                                                                        </tr>
                                                                        <?php
                                                                        $query_product = "SELECT order_id,product_id,product_image,product_name,product_price,quantity FROM i_order_item WHERE order_id = '" . $row ['od_id'] . "'";
                                                                        $result_product = mysqli__query($con, $query_product);
                                                                        if (mysqli_num_rows($result_product) > 0) {

                                                                            while ($row1 = mysqli_fetch_array($result_product)) {
                                                                                ?>
                                                                                <tr style="background:#fff;">
                                                                                    <td  align="center">
                                                                                        <img src="../<?php echo $row1['product_image']; ?>" height="70"/>
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
                                            </td>
                                        </tr>
                                    </table>
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
