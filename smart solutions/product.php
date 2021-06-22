<?php
//include database connection
include('./dbconfig.php');
$proID = "";
if (!empty($_GET['product_id'])) {
    $proID = mysqli_real_escape_string($con, $_GET['product_id']);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Product Detail - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/tab_css.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
        <script type="text/javascript" src="js/Validation.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript">
            $(function () {
                // Tabs
                $('#tabs').tabs();

                //hover states on the static widgets
                $('#dialog_link, ul#icons li').hover(
                        function () {
                            $(this).addClass('ui-state-hover');
                        },
                        function () {
                            $(this).removeClass('ui-state-hover');
                        }
                );

            });

            //set image
            function setImage(val) {
                document.getElementById('ProductImage').src = val;
            }

            function checkUser() {
                var user = document.getElementById('hiduid');
                if (user.value.trim() == "") {
                    alert('You must be login for purchasing products');
                    return false;
                }
            }


        </script>
        <style type="text/css">
            .demoHeaders { margin-top: 2em; }
            #dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
            #dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
            ul#icons {margin: 0; padding: 0;}
            ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
            ul#icons span.ui-icon {float: left; margin: 0 4px;}

            form .stars {
                background: url("stars.png") repeat-x 0 0;
                width: 150px;
                margin: 0 auto;
            }


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
                        <?php
                        $sql_query = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id WHERE b_product.pro_id = '" . $proID . "' AND b_product.status='1'";
                        //execute query
                        $result = mysqli_query($con, $sql_query);
                        while ($row = mysqli_fetch_array($result)) {

                            $proName = $row ['pro_name'];
                            $proDes = $row ['description'];
                            $price = $row['price'];
                            $warranty = $row['warranty'];
                            $proImage = $row ['img_path'];
                            $catName = $row ['cat_name'];
                            ?>

                            <table border="0" width="950" style="padding-left: 10px;">
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                    <td width="600">
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="hiduid" id="hiduid" value="<?php echo $user_id; ?>" />
                                                    <h3 class="head"><?php echo $proName; ?></h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo $proImage; ?>" alt="<?php echo $proName; ?>" height="400" width="600" id="ProductImage" style="background-color: #ffffff;"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="top">
                                        <div class="third">
                                            <h3 class="head">Specifications</h3>
                                            <div class="war"><?php echo $warranty; ?></div>
                                            <br/>
                                            <div class="prod-price">
                                                <?php
                                                if (!empty($row['discount']) && $row['discount'] != "0.00") {
                                                    ?>
                                                    <div class="org-price" style="text-align: left;width: 80px;">
                                                        <strike>
                                                            <img src="images/rupee.png" />
                                                            <span class="price"><?php echo $row['price'] ?></span>
                                                        </strike>&nbsp;&nbsp;
                                                    </div>
                                                    <div class="discount-price" style="text-align: left;width: 80px;">
                                                        &nbsp;&nbsp;<img src="images/rupee.png" />
                                                        <span class="price">
                                                            <?php
                                                            $discount_price = ($row['price'] * $row['discount'] / 100);
                                                            echo $row['price'] - $discount_price;
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="discount">
                                                        <span class="redprice"><?php echo $row['discount'] ?>%</span>
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="prod-price">
                                                        <div class="discount">
                                                            <img src="images/rupee.png" />
                                                            <span class="price"><?php echo $row['price'] ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="prod-price">
                                                <a href="addtocart.php?pid=<?php echo $proID; ?>" class="prdbuttonbuynow">Add to Cart</a>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="demo">
                                            <div id="tabs">
                                                <ul>
                                                    <li><a href="#tabs-1"><?php echo $proName; ?></a></li>
                                                </ul>

                                                <div id="tabs-1">
                                                    <h3 class="head"><?php echo $proName; ?></h3>
                                                    <p align="justify" style="line-height: 20px;">
                                                        <?php echo $proDes; ?>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <br/><br/>
                            <div style="clear: both;">
                                <h1>Related Product</h1>
                                <div class="product-category">
                                    <?php
                                    $sql_query = "";
                                    $sql_query = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id  WHERE p_cat.cat_id = '" . $row ['cat_id'] . "' AND b_product.pro_id != '" . $proID . "' GROUP BY p_cat.product_id ORDER BY b_product.pro_id DESC limit 4";
                                    $result = mysqli_query($con, $sql_query);
                                    if (mysqli_num_rows($result) > 0) {
                                        ?>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <div class="product">
                                                <div class="prod-img">
                                                    <a href="product.php?product_id=<?php echo $row['pro_id'] ?>">
                                                        <img src="<?php echo $row['img_path'] ?>" />
                                                    </a>
                                                </div>
                                                <div class="product-title">
                                                    <a href="product.php?product_id=<?php echo $row['pro_id'] ?>">
                                                        <?php echo $row['pro_name'] ?>
                                                    </a>
                                                </div>
                                                <div class="price-background">
                                                    <div class="prod-price">
                                                        <?php
                                                        if (!empty($row['discount']) && $row['discount'] != "0.00") {
                                                            ?>
                                                            <div class="org-price">
                                                                <strike>
                                                                    <img src="images/rupee.png" />
                                                                    <span class="price"><?php echo $row['price'] ?></span>
                                                                </strike>&nbsp;&nbsp;
                                                            </div>
                                                            <div class="discount-price">
                                                                &nbsp;&nbsp;<img src="images/rupee.png" />
                                                                <span class="price">
                                                                    <?php
                                                                    $discount_price = ($row['price'] * $row['discount'] / 100);
                                                                    echo $row['price'] - $discount_price;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="discount">
                                                                <span class="redprice"><?php echo $row['discount'] ?>%</span>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="prod-price">
                                                                <div class="discount">
                                                                    <img src="images/rupee.png" />
                                                                    <span class="price"><?php echo $row['price'] ?></span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="prod-button">
                                                        <a href="addtocart.php?pid=<?php echo $row['pro_id'] ?>" class="prdbuttonbuynow">
                                                            Buy Now
                                                        </a>
                                                        &nbsp;&nbsp;
                                                        <a href="product.php?product_id=<?php echo $row['pro_id'] ?>" class="prdbuttonmore">
                                                            More
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                        }
                                        ?>
                                        <?php
                                    } else {
                                        echo '<div style="text-align:center;"><h3>No Data.</h3></div>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
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
