<?php
include './dbconfig.php';
if (empty($user_id)) {
    header("location:login.php?status=login");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Thank You - SMART SOLUTIONS</title>
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
                <div id="center-page">
                    <div class="content">
                        <div class="clear">&nbsp;</div>
                        <div class="pay-head"><h2>Thank You</h2></div>
                        <table width="100%" align="center">
                            <tr><td height="50">&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <h3>
                                        Your order has been placed.<br/>
                                        Your Order no is <?php echo $_GET['inv']; ?>
                                    </h3>
                                    <h4>
                                        Your order will dispatched shortly. <a href="order-list.php">order history</a>.
                                    </h4>

                                </td>
                            </tr>

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
