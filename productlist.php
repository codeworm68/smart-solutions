<?php
include './dbconfig.php';
$error = "";
if (!empty($user_id)) {

    if (isset($_GET['reg_id']) && !empty($_GET['reg_id'])) {
        $id = mysqli_real_escape_string($con, $_GET['reg_id']);
        $sql = "DELETE FROM b_product WHERE pro_id='" . $id . "'";
        $result = mysqli_query($con, $sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            $error = "Product has been deleted.";
        } else {
            $error = "Product has not been deleted.";
        }
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Product List - SMART SOLUTIONS</title>
            <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
            <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
            <script type="text/javascript" src="js/crawler.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
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
                        <table border="0" width="100%">
                            <tr>
                                <td valign="top">
                                    <?php
                                    include('custmenu.php');
                                    ?>
                                </td>
                                <td valign="top" width="800"  align="center">
                                    <table cellpadding="2" cellspacing="2" width="100%" >
                                        <?php
                                        if (!empty($error)) {
                                            echo '<tr><td colspan="6" align="center" style="font-size:14px;">' . $error . '</td></tr>';
                                        }
                                        ?>
                                        <tr style="background: #ccc;font-size: 14px;padding: 5px;height: 30px;font-weight: bold;color: #000;">
                                            <td width="10%" align="center">S.No</td>
                                            <td width="25%" align="center">Product Name</td>
                                            <td width="10%" align="center">Price</td>
                                            <td width="10%" align="center">Discount</td>
                                            <td width="20%" align="center">Image</td>
                                            <td width="15%" align="center">Summary</td>
                                            <td width="10%" align="center">&nbsp;&nbsp;Delete&nbsp;&nbsp;</td>
                                        </tr>
                                        <?php
                                        $sql_query = "SELECT pro_id,pro_name,add_date,price,discount,warranty,img_path FROM b_product ORDER BY pro_id desc";
                                        $result = mysqli_query($con, $sql_query);
                                        $i = 0;
                                        while ($row = mysqli_fetch_array($result)) {

                                            $i++;
                                            $pro_id = $row ['pro_id'];
                                            $pro_name = $row ['pro_name'];
                                            $price = $row ['price'];
                                            $discount = $row ['discount'];
                                            $img_path = $row ['img_path'];
                                            $warranty = $row ['warranty'];
                                            ?>
                                            <tr style="background: #f2f2f2;font-size: 14px;padding: 5px;height: 24px;color: #000;">
                                                <td align="center"><?php echo $i; ?></td>
                                                <td><?php echo $pro_name; ?></td>
                                                <td><?php echo $price; ?></td>
                                                <td><?php echo $discount; ?></td>
                                                <td><img src="<?php echo $img_path; ?>" width="150px;" height="100px;"></td>
                                                <td align="center"><?php echo $warranty; ?></td>
                                                <td align="center"><a href="productlist.php?reg_id=<?php echo $pro_id; ?>" class="linka">Delete</a></td>
                                            </tr>
                                        <?php } ?>
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
