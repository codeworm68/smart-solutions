<?php
include './dbconfig.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Welcome to SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
        <!--Slider -->
        <link href="css/nivo-slider.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.js"></script>
        <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                $('#slider').nivoSlider();
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="container">
                <div id="header">
                    <?php
                    include 'header.php';
                    ?>
                </div>
                <div class="banner-middle">
                    <div id="slider" class="nivoSlider">
                      <img src="images/my logo.png" />

                    </div>
                </div>
                <div class="content">
                    <br/><br/>
                    <div class="product-category">
                        <?php
                        $sql_query = "SELECT * FROM a_category WHERE is_deleted = '0' order by cat_name ASC";
                        $result = mysqli_query($con, $sql_query);
                        if (mysqli_num_rows($result) > 0) {
                            ?>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                ?>
                                <div class="product"  style="width: 300px;">
                                    <div class="prod-img">
                                        <a href="category.php?category_id=<?php echo $row['cat_id'] ?>">
                                            <img src="<?php echo $row['img_path'] ?>" style="width: 300px;height: 240px;"/>
                                        </a>
                                    </div>
                                    <div class="product-title"  sty                                                                                                                              le="width: 290px;font-size: 24px;">
                                        <a href="category.php?category_id=<?php echo $row['cat_id'] ?>">
                                            <?php echo $row['cat_name'] ?>
                                        </a>
                                    </div>

                                </div>

                                <?php
                            }
                            ?>
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
