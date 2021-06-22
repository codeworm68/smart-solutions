<?php
include './dbconfig.php';
$category_id = "";
$category_name = "";
if (!empty($_GET['category_id'])) {
    $category_id = mysqli_real_escape_string($con, $_GET['category_id']);

    $sql_cat = "SELECT * FROM a_category WHERE cat_id = '" . $category_id . "' ";
    $result_cat = mysqli_query($con, $sql_cat);
    if (mysqli_num_rows($result_cat) > 0) {
        $row = mysqli_fetch_array($result_cat);
        $category_name = $row['cat_name'];
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>
            <?php
            if (!empty($category_name)) {
                echo $category_name;
            } else {
                echo 'Category';
            }
            ?>
            - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
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
                <div class="content">
                    <br/><br/>
                    <h1>
                        <?php
                        if (!empty($category_name)) {
                            echo $category_name;
                        } else {
                            echo 'Category';
                        }
                        ?>
                    </h1>
                    <div class="product-category">
                        <?php
                        $sql_query = "";
                        if (!empty($category_id)) {
                            $sql_query = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id  WHERE p_cat.cat_id = '" . $category_id . "' ORDER BY b_product.pro_id DESC";
                        } else {
                            $sql_query = "SELECT b_product.pro_id, b_product.pro_name,b_product.img_path,b_product.price,b_product.discount,p_cat.cat_id FROM b_product JOIN a_category_products p_cat ON b_product.pro_id = p_cat.product_id ORDER BY b_product.pro_id DESC LIMIT 12";
                        }
                        $result = mysqli_query($con, $sql_query);
                        if (mysqli_num_rows($result) > 0) {
                            ?>
                            <?php

                            $productIds = array();
                            while ($row = mysqli_fetch_array($result)) {



                                if(!in_array($row['pro_id'], $productIds)){
                                    $productIds[] = $row['pro_id'];


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
                            }
                            ?>
                            <?php
                        } else {
                            echo '<div style="text-align:center;"><h3>No Data.</h3></div>';
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
