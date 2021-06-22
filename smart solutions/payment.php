<?php

include './dbconfig.php';

if (empty($user_id)) {
    header("location:login.php?status=login");
}


if (isset($_POST['btnPayment'])) {


    $INVOICE = 100001;
    $ORDER = 1;
    $valueInsert = 0;
    $error = "";

    //increase order id and invoice no
    $result = mysqli_query($con, "SELECT od_id FROM i_order ORDER BY(od_id) DESC LIMIT 1");
    while ($row = mysqli_fetch_array($result)) {
        //get top order id from order table
        $res = $row ['od_id'];
        $INVOICE = $INVOICE + (int) $res;
        $ORDER = $ORDER + (int) $res;
    }
    $INVOICE = 100000 + $ORDER;

    $payment_type = $_POST['payment_type'];
    $Amount = $_POST['BillingAmount'];

    //getting parameter
    $billing_cust_name = $_SESSION['BillName'];
    $billing_cust_address = $_SESSION['BillAddress'];
    $billing_city = $_SESSION['BillCity'];
    $billing_zip = $_SESSION['BillPinCode'];
    $billing_cust_state = $_SESSION['BillState'];
    $billing_cust_country = 'India';
    $billing_cust_tel = $_SESSION['BillContactNo'];
    $billing_cust_email = $_SESSION['BillEmailID'];

    //delivery information
    $delivery_cust_name = $_SESSION['ShipName'];
    $delivery_cust_address = $_SESSION['ShipAddress'];
    $delivery_cust_state = $_SESSION['ShipState'];
    $delivery_cust_country = 'India';
    $delivery_city = $_SESSION['ShipCity'];
    $delivery_zip = $_SESSION['ShipPinCode'];
    $delivery_cust_tel = $_SESSION['ShipContactNo'];

    $card_no = $_POST['card_no'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $name_on_card = $_POST['name_on_card'];


    $Shipping_Cost = 0;


     if (isset($_COOKIE[$cookie_name])) { // if cookies exits
         $cart = explode("//", base64_decode($_COOKIE[$cookie_name])); //getting cart value in array
         $cartsize = sizeof($cart); //get array size
        //insert value in order table
     $sql = "INSERT INTO i_order(od_invoice,od_billing_amount,od_date,od_last_update,od_billing_name,od_billing_address,
od_billing_city,od_billing_state,od_billing_postal_code,od_billing_email,od_billing_phone,od_shipping_name,
od_shipping_address,od_shipping_city,od_shipping_state,od_shipping_postal_code,od_shipping_phone,od_shipping_cost,user_id,payment_type,card_no,expiry,cvv,name_on_card)
VALUES('$INVOICE','$Amount',NOW(),NOW(),'$billing_cust_name','$billing_cust_address','$billing_city','$billing_cust_state','$billing_zip','$billing_cust_email',
        '$billing_cust_tel','$delivery_cust_name','$delivery_cust_address','$delivery_city','$delivery_cust_state','$delivery_zip','$delivery_cust_tel','$Shipping_Cost','$user_id','$payment_type','$card_no','$expiry','$cvv','$name_on_card')";

         $result1 = mysqli_query($con, $sql);
         if (mysqli_insert_id($con)) {
             //insert into
             $cartArr = json_decode($_COOKIE[$cookie_name]);

             foreach ($cartArr as $keyid => $qty) {

                $query_product = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id WHERE b_product.pro_id = '" . $keyid . "' AND b_product.status='1'";

                  $result_product = mysqli_query($con, $query_product);
                 if (mysqli_num_rows($result_product) > 0) {

                     $row = mysqli_fetch_assoc($result_product);


                    $sql1 = "INSERT INTO i_order_item(order_id,product_id,product_image,product_name,product_price,quantity,created) VALUES('" . $ORDER . "','" . $keyid . "','" . $row ['img_path'] . "','" . $row ['pro_name'] . "','" . $row ['price'] . "','" . $qty . "','" . date('Y-m-d H:i:s') . "')";
                    $result2 = mysqli_query($con, $sql1);
                    $valueInsert = (int) $result2;
                 }
             }
         }
 }

     //success message
    if ($valueInsert == 0) {
        $error = "Your order has not been proceed. Plese try again.";
    } else {
        header("location:thankyou.php?inv=" . $INVOICE);
    }
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Checkout - SMART SOLUTIONS</title>
            <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
            <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
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
                    <div id="center-page">
                        <div class="content">
                            <div class="clear">&nbsp;</div>
                            <div class="pay-head"><h2>Thank You</h2></div>
                            <table width="100%" align="center">
                                <tr><td height="120">&nbsp;</td></tr>
                                <tr>
                                    <td>
                                        <?php
                                        if (!empty($error)) {
                                            echo $error;
                                        } else {
                                            setcookie($cookie_name, '', time() - $expire);
                                            unset($_COOKIE[$cookie_name]);
                                            ?>
                                            <h3>
                                                Your order has been placed.<br/>
                                                Your Order no is <?php echo $INVOICE; ?>
                                            </h3>

                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr><td height="120">&nbsp;</td></tr>
                            </table>
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
    <?php
} else {
    header("location:cart.php");
}
?>
