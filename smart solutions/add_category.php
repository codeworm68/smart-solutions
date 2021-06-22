<?php
include './dbconfig.php';
if (!empty($user_id)) {
    $error_msg = "";
    if (isset($_POST['btnsubmit'])) {//add new zone
        $catname = $_POST['txtcategory'];
        //add new zone
        if (isset($_POST['btnsubmit'])) {
            $upload = "uploads/";
            $database_path = "uploads/";
            $current_images = $_FILES['image_file2']['name'];
            $times = date("dmyhis");
            $image_path = "";
            $big_images = $_FILES['image_file2']['name'];
            if (!empty($big_images)) {
                $extensions = substr(strrchr($big_images, '.'), 1);
                $upload_big_img = $upload . "bigimage/" . $times . "." . $extensions;
                $image_path = $database_path . "bigimage/" . $times . "." . $extensions; //database big image
                $actions = copy($_FILES['image_file2']['tmp_name'], $upload_big_img);
            } else {
                $error .= "Please select product image.";
            }
            $sql = "INSERT INTO a_category (cat_name,img_path) values('$catname','$image_path')";
            $result = mysqli_query($con, $sql);
            $valueInsert = (int) $result;
            if ($valueInsert > 0) {
                header("location:categorylist.php");
            } else {
                $error_msg = "Category has not been saved.!!";
            }
        }
    }
    ?>
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Add Category - Smart solutions</title>
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
                                <td valign="top" align="left">
                                    <table width="800"  style="padding-left: 20px;">
                                        <h1>Add Category</h1>
                                        <form name="" action="add_category.php" method="post" enctype="multipart/form-data">
                                            <table cellpadding="10" cellspacing="10">
                                                <?php
                                                if (!empty($error_msg)) {
                                                    echo $error_msg;
                                                }
                                                ?>
                                                <tr>
                                                    <td style="color:gray;">Category</td>
                                                    <td>
                                                        <input type="text" name="txtcategory" id="txtcategory" class="input_text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text_bold">Category Image</td>
                                                    <td>
                                                        <input type="file" name="image_file2" id="image_file2" class="input_text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" align="right">
                                                        <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" class="button" onclick="return validate();"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
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
