<?php
include './dbconfig.php';
if (empty($user_id)) {
    header("location:login.php?status=login");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Checkout - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
        <script type="text/javascript">
            function cehckUserDetails() {

                //billing first name
                var billingName = document.getElementById('txtBillingName');
                if (billingName.value.trim() == "") {
                    alert('Billing Name Field Cannot be Balnk left.!!');
                    billingName.focus();
                    return false;
                }
                //billing address line1
                var billingAddress = document.getElementById('textBillingAddress');
                if (billingAddress.value.trim() == "") {
                    alert('Billing Address Line Field Cannot be Balnk left.!!');
                    billingAddress.focus();
                    return false;
                }
                //billing pin code
                var billingPinCode = document.getElementById('txtBillingPinCode');
                if (billingPinCode.value.trim() == "") {
                    alert('Billing Pin Code Field Cannot be Balnk left.!!');
                    billingPinCode.focus();
                    return false;
                }

                //billing city
                var billingCity = document.getElementById('txtBillingCity');
                if (billingCity.value.trim() == "") {
                    alert('Billing City Field Cannot be Balnk left.!!');
                    billingCity.focus();
                    return false;
                }
                //billing state
                var billingState = document.getElementById('cmbBillingState');
                if (billingState.value.trim() == "na") {
                    alert('Please, Select State from drop down box for Billing .!!');
                    billingState.focus();
                    return false;
                }
                //billing email id
                var billingEmailID = document.getElementById('txtBillingEmailID');
                if (billingEmailID.value.trim().search(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) == -1) {
                    alert('Please, Enter valid Email ID for Billing .!!');
                    billingEmailID.focus();
                    return false;
                }

                //billing contact no
                var billingContNo = document.getElementById('txtBillingContNo');
                if (billingContNo.value.trim() == "") {
                    alert('Billing Contact No. Field Cannot be Balnk left.!!');
                    billingContNo.focus();
                    return false;
                }//chkSame

                if (document.getElementById('chkSame').checked == true) {

                    document.getElementById('txtShippingFirstName').value = billingName.value;//first name
                    document.getElementById('textShippingAddressLine').value = billingAddress.value;//address line 1
                    document.getElementById('txtShippingPinCode').value = billingPinCode.value;//pin code
                    document.getElementById('txtShippingCity').value = billingCity.value;//city
                    document.getElementById('cmbShippingState').value = billingState.value;//state
                    document.getElementById('txtShippingContNo').value = billingContNo.value;//contact no

                } else if (document.getElementById('chkSame').checked == false) {
                    alert('Please, Fill Shipping Information.!!');
                    //return false;
                }

                //shipping address validation
                //shipping first name
                var shipName = document.getElementById('txtShippingName');
                if (shipName.value.trim() == "") {
                    alert('Shipping Name Field Cannot be Balnk left.!!');
                    shipName.focus();
                    return false;
                }

                //shipping address line1
                var shipAddress = document.getElementById('textShippingAddressLine');
                if (shipAddress.value.trim() == "") {
                    alert('Shipping Address Line Field Cannot be Balnk left.!!');
                    shipAddress.focus();
                    return false;
                }
                //shipping pin code
                var shipPinCode = document.getElementById('txtShippingPinCode');
                if (shipPinCode.value.trim() == "") {
                    alert('Shipping Pin Code Field Cannot be Balnk left.!!');
                    shipPinCode.focus();
                    return false;
                }

                //shipping city
                var shipCity = document.getElementById('txtShippingCity');
                if (shipCity.value.trim() == "") {
                    alert('Shipping City Field Cannot be Balnk left.!!');
                    shipCity.focus();
                    return false;
                }
                //shipping state
                var shipState = document.getElementById('cmbShippingState');
                if (shipState.value.trim() == "na") {
                    alert('Please, Select State from drop down box for Shipping.!!');
                    shipState.focus();
                    return false;
                }

                //shipping contact no
                var shipContNo = document.getElementById('txtShippingContNo');
                if (shipContNo.value.trim() == "") {
                    alert('Shipping Contact No. Field Cannot be Balnk left.!!');
                    shipContNo.focus();
                    return false;
                }

            }

            function copyToShip() {

                if (document.getElementById('chkSame').checked == true) {

                    var billingFName = document.getElementById('txtBillingName').value.trim();
                    document.getElementById('txtShippingName').value = billingFName;//first name

                    var billingAddress = document.getElementById('textBillingAddress').value.trim();
                    document.getElementById('textShippingAddressLine').value = billingAddress;//address line 1

                    var billingPinCode = document.getElementById('txtBillingPinCode').value.trim();
                    document.getElementById('txtShippingPinCode').value = billingPinCode;//pin code

                    var billingCity = document.getElementById('txtBillingCity').value.trim();
                    document.getElementById('txtShippingCity').value = billingCity;//city

                    var billingState = document.getElementById('cmbBillingState').value.trim();
                    document.getElementById('cmbShippingState').value = billingState;//state

                    var billingContNo = document.getElementById('txtBillingContNo').value.trim();
                    document.getElementById('txtShippingContNo').value = billingContNo;//contact no

                } else {
                    document.getElementById('txtShippingName').value = "";//first name
                    document.getElementById('textShippingAddressLine').value = "";//address line 1
                    document.getElementById('txtShippingPinCode').value = "";//pin code
                    document.getElementById('txtShippingCity').value = "";//city
                    document.getElementById('cmbShippingState').value = "na";//state
                    document.getElementById('txtShippingContNo').value = "";//contact no
                }
            }
        </script>
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
                        <?php
                        if (isset($_POST['btnOrder'])) {

                            $InsertCheck = 0; //InsertCheck
                            //get value from form
                            //for billing fields
                            $InsertData['txtBillingName'] = DoSecure($_POST['txtBillingName']);
                            $InsertData['textBillingAddress'] = DoSecure($_POST['textBillingAddress']);
                            $InsertData['txtBillingPinCode'] = DoSecure($_POST['txtBillingPinCode']);
                            $InsertData['txtBillingCity'] = DoSecure($_POST['txtBillingCity']);
                            $InsertData['cmbBillingState'] = DoSecure($_POST['cmbBillingState']);
                            $InsertData['txtBillingEmailID'] = DoSecure($_POST['txtBillingEmailID']);
                            $InsertData['txtBillingContNo'] = DoSecure($_POST['txtBillingContNo']);

                            //for shipping address

                            $InsertData['txtShippingName'] = DoSecure($_POST['txtShippingName']);
                            $InsertData['textShippingAddressLine'] = DoSecure($_POST['textShippingAddressLine']);
                            $InsertData['txtShippingPinCode'] = DoSecure($_POST['txtShippingPinCode']);
                            $InsertData['txtShippingCity'] = DoSecure($_POST['txtShippingCity']);
                            $InsertData['cmbShippingState'] = DoSecure($_POST['cmbShippingState']);
                            $InsertData['txtShippingContNo'] = DoSecure($_POST['txtShippingContNo']);

                            //server side validation
                            $error_msg = '';
                            //billing first name
                            if ($InsertData['txtBillingName'] == '') {
                                $error_msg .= "Please enter your name.<br/>";
                            }
                            //billing address line 1
                            if ($InsertData['textBillingAddress'] == '') {
                                $error_msg .= "Please enter your address.<br/>";
                            }

                            //billing billing city
                            if ($InsertData['txtBillingCity'] == '') {
                                $error_msg .= "Please enter your city.<br/>";
                            }
                            //billing state
                            if ($InsertData['cmbBillingState'] == '') {
                                $error_msg .= "Please, select your state.<br/>";
                            }
                            //billing email id
                            if ($InsertData['txtBillingEmailID'] == '') {
                                $error_msg .= "Please enter your email id.<br/>";
                            }
                            //billing contact no.
                            if ($InsertData['txtBillingContNo'] == '') {
                                $error_msg .= "Please enter contact no.<br/>";
                            }
                            //shipping information
                            //shipping first name
                            if ($InsertData['txtShippingName'] == '') {
                                $error_msg .= "Please enter your name.<br/>";
                            }
                            //shipping address line 1
                            if ($InsertData['textShippingAddressLine'] == '') {
                                $error_msg .= "Please enter your address.<br/>";
                            }
                            //shipping pin code
                            if ($InsertData['txtShippingPinCode'] == '') {
                                $error_msg .= "Please enter your pin code.<br/>";
                            }
                            //shipping billing city
                            if ($InsertData['txtShippingCity'] == '') {
                                $error_msg .= "Please enter your city.<br/>";
                            }
                            //shipping state
                            if ($InsertData['cmbShippingState'] == 'na') {
                                $error_msg .= "Please, select your state.<br/>";
                            }

                            //shipping contact no.
                            if ($InsertData['txtShippingContNo'] == '') {
                                $error_msg .= "Please enter contact no.<br/>";
                            }

                            //
                            if ($error_msg == '') {
                                $InsertCheck = 2;
                                //billing address
                                $_SESSION['BillName'] = $InsertData['txtBillingName'];
                                $_SESSION['BillAddress'] = $InsertData['textBillingAddress'];
                                $_SESSION['BillPinCode'] = $InsertData['txtBillingPinCode'];
                                $_SESSION['BillCity'] = $InsertData['txtBillingCity'];
                                $_SESSION['BillState'] = $InsertData['cmbBillingState'];
                                $_SESSION['BillEmailID'] = $InsertData['txtBillingEmailID'];
                                $_SESSION['BillContactNo'] = $InsertData['txtBillingContNo'];
                                //shipping address
                                $_SESSION['ShipName'] = $InsertData['txtShippingFirstName'];
                                $_SESSION['ShipAddress'] = $InsertData['textShippingAddressLine'];
                                $_SESSION['ShipPinCode'] = $InsertData['txtShippingPinCode'];
                                $_SESSION['ShipCity'] = $InsertData['txtShippingCity'];
                                $_SESSION['ShipState'] = $InsertData['cmbShippingState'];
                                $_SESSION['ShipContactNo'] = $InsertData['txtShippingContNo'];
                                header("location:userconfirmation.php");
                            } else {
                                $InsertCheck = 1;
                            }
                            //for message printing
                            $message = '';
                            switch ($InsertCheck) {
                                case 2: $message .= "<span class=\"successmsg\">Thank You for your time. we will contact you soon.</span>";
                                    break;
                                case 1: $message .= "<span class=\"errormsg\">" . $error_msg . "</span>";
                                    break;
                            }
                        }
                        ?>
                        <div class="pay-head"><h2>Payment and delivery information</h2></div>
                        <?php
                        if ($message != '')
                            echo $message
                            ?>
                        <form name="" action="" method="post">
                            <div>
                                <div class="form-left">
                                    <div class="indv-field">
                                        <span class="ref_font_bold">*</span>&nbsp;<span class="note">Marked fields are mandatory</span>
                                    </div>
                                    <div class="indv-field">
                                        <span class="note">Billing Information</span>
                                    </div>
                                    <?php
                                    $result_user = mysqli_query($con, 'select * from users where id = "' . $user_id . '" ');
                                    if (mysqli_num_rows($result_user) > 0) {
                                        $row = mysqli_fetch_array($result_user);
                                        ?>
                                        <div class="indv-field">
                                            <label for="Name">Name <span class="ref_font_bold">*</span></label>
                                            <input type="text" name="txtBillingName" id="txtBillingName" class="input-text" value="<?php echo $row['name']; ?>"/>
                                        </div>
                                        <div class="indv-field">
                                            <label for="address">Address <span class="ref_font_bold">*</span></label>
                                            <textarea name="textBillingAddress" id="textBillingAddress" class="input-textarea"><?php echo $row['address']; ?></textarea>
                                        </div>

                                        <div class="indv-field">
                                            <label for="pin">Pin Code <span class="ref_font_bold">*</span></label>
                                            <input type="text" name="txtBillingPinCode" id="txtBillingPinCode" class="input-text" value="<?php echo $row['pincode']; ?>" onkeyup="CheckForIntegers(this)"/>
                                        </div>

                                        <div class="indv-field">
                                            <label for="city">City <span class="ref_font_bold">*</span></label>
                                            <input type="text" name="txtBillingCity" id="txtBillingCity" class="input-text" value="<?php echo $row['city']; ?>"/>
                                        </div>

                                        <div class="indv-field">
                                            <label for="state">State <span class="ref_font_bold">*</span></label>
                                            <select name="cmbBillingState" id="cmbBillingState" class="input-text" style="width:208px; height:25px;">
                                                <option value="na" selected> - - - - - Select - - - - -</option>
                                                <?php
                                                $sql_query = "SELECT StateID,State FROM z_state";
                                                $result = mysqli_query($con, $sql_query);
                                                while ($row1 = mysqli_fetch_array($result)) {
                                                    if ($row1 ['State'] == $row['state']) {
                                                        echo '<option value="' . $row1 ['State'] . '" selected>' . $row1 ['State'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $row1 ['State'] . '">' . $row1 ['State'] . '</option>';
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="indv-field">
                                            <label for="email">Email ID <span class="ref_font_bold">*</span></label>
                                            <input type="text" name="txtBillingEmailID" id="txtBillingEmailID" class="input-text" value="<?php echo $row['email']; ?>"/>
                                        </div>

                                        <div class="indv-field">
                                            <label for="phone">Contact No.<span class="ref_font_bold">*</span></label>
                                            <input type="text" name="txtBillingContNo" id="txtBillingContNo" class="input-text" value="<?php echo $row['mobile']; ?>" onkeyup="CheckForIntegers(this)"/>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>


                                <div class="form-left">

                                    <div class="indv-field">
                                        <input type="checkbox" name="chkSame" id="chkSame" onclick="copyToShip()"/>&nbsp; Please Check, If Shipping Address is same.
                                    </div>
                                    <div class="indv-field">
                                        <span class="note">Shipping Information</span>
                                    </div>

                                    <div class="indv-field">
                                        <label for="Name">Name <span class="ref_font_bold">*</span></label>
                                        <input type="text" name="txtShippingName" id="txtShippingName" class="input-text" value="<?php echo $_SESSION['ShipName']; ?>"/>
                                    </div>

                                    <div class="indv-field">
                                        <label for="address">Address <span class="ref_font_bold">*</span></label>
                                        <textarea name="textShippingAddressLine" id="textShippingAddressLine" class="input-textarea"><?php echo $_SESSION['ShipAddress']; ?></textarea>
                                    </div>

                                    <div class="indv-field">
                                        <label for="pin">Pin Code <span class="ref_font_bold">*</span></label>
                                        <input type="text" name="txtShippingPinCode" id="txtShippingPinCode" class="input-text" onkeyup="CheckForIntegers(this)" value="<?php echo $_SESSION['ShipContactNo']; ?>"/>
                                    </div>

                                    <div class="indv-field">
                                        <label for="city">City <span class="ref_font_bold">*</span></label>
                                        <input type="text" name="txtShippingCity" id="txtShippingCity" class="input-text" value="<?php echo $_SESSION['ShipCity']; ?>"/>
                                    </div>

                                    <div class="indv-field">
                                        <label for="state">State <span class="ref_font_bold">*</span></label>
                                        <select name="cmbShippingState" id="cmbShippingState" class="input-text" style="width:208px; height:25px;">
                                            <option value="na" selected> - - - - - Select - - - - -</option>
                                            <?php
                                            $sql_query = "SELECT StateID,State FROM z_state";
                                            //execute query
                                            $result = mysqli_query($con, $sql_query);
                                            while ($row = mysqli_fetch_array($result)) {

                                                $stateid = $row ['StateID'];
                                                $state = $row ['State'];
                                                ?>
                                                <option value="<?php echo $state; ?>"><?php echo $state; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="indv-field">
                                        <label for="phone">Contact No. <span class="ref_font_bold">*</span></label>
                                        <input type="text" name="txtShippingContNo" id="txtShippingContNo" class="input-text" value="<?php echo $_SESSION['ShipContactNo']; ?>" onkeyup="CheckForIntegers(this)"/>
                                    </div>
                                </div>
                                <div style="text-align: right;width: 890px;clear: both;">
                                    <input class="prdbuttonbuynow" type="button" name="btnBuyMore" id="btnBuyMore" value="Buy More" onclick="window.location.href = 'category.php'"/>&nbsp;
                                    <input class="prdbuttonmore" type="submit" value="Order Now" name="btnOrder" id="btnOrder" onclick="return cehckUserDetails();" />
                                </div>
                            </div>
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
