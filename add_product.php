<?php
include './dbconfig.php';
if (!empty($user_id)) {
    if (isset($_POST['btnsubmit'])) {

        $categories = $_POST['cmbcategory'];
        $proname = $_POST['txtproname'];
        $price = $_POST['txtprice'];
        $warranty = $_POST['txtwarrenty'];
        $proDesc = $_POST['textdescription'];
        $discount = $_POST['discount'];
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
            $sql = "insert into b_product(pro_name,add_date,price,warranty,description,img_path,discount) values('$proname',now(),'$price','$warranty','$proDesc','$image_path','" . $discount . "')";
            $result1 = mysqli_query($con, $sql);
            $proid = mysqli_insert_id($con);
            if (!empty($proid)) {

                foreach ($categories as $category) {
                    mysqli_query($con, "INSERT INTO a_category_products(cat_id,product_id) VALUES ('" . $category . "','" . $proid . "')");
                }
                header("location:add_product.php?msg=success");
            } else {
                $error = "Product has been not saved";
            }
        }
    }
    ?>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <title>Add Product - SMART SOLUTIONS</title>
            <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
            <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
            <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
            <script type="text/javascript" src="js/crawler.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
            <script type="text/javascript">
                function validate() {
                    // iEdit["textdescription"].php();
                    //category
                    var category = document.getElementById('cmbcategory');//txtwarrenty
                    if (category.value.trim() == "na") {
                        alert('Please, Select category.!!');
                        category.focus();
                        return false;
                    }

                    var proname = document.getElementById('txtproname');
                    if (proname.value.trim() == "") {
                        alert('Product Name field cannot be blank left.!!');
                        proname.focus();
                        return false;
                    }
                    var price = document.getElementById('txtprice');
                    if (price.value.trim() == "") {
                        alert('Price field cannot be blank left.!!');
                        price.focus();
                        return false;
                    }
                    var warranty = document.getElementById('txtwarrenty');
                    if (warranty.value.trim() == "") {
                        alert('Warranty field cannot be blank left.!!');
                        warranty.focus();
                        return false;
                    }
                    var description = document.getElementById('textdescription');
                    if (description.value.trim() == "") {
                        alert('Product Description field cannot be blank left.!!');
                        description.focus();
                        return false;
                    }
                    var image = document.getElementById('fileimage2');
                    if (image.value.trim() == "") {
                        alert('Please select product image.');
                        image.focus();
                        return false;
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
                        <table border="0" width="100%">
                            <tr>
                                <td valign="top">
                                    <?php
                                    include('custmenu.php');
                                    ?>
                                </td>
                                <td valign="top" width="800"  align="center">
                                    <table cellpadding="2" cellspacing="2" width="100%">
                                        <tr>
                                            <td width="100%" colspan="2">
                                                <div class="overflow">
                                                    <form action="add_product.php" method="post" enctype="multipart/form-data">
                                                        <table  width="100%" cellpadding="10" cellspacing="10">
                                                            <tr>
                                                                <td colspan="4">
                                                                    <h2>Add Product</h2>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            if (!empty($error)) {
                                                                echo '<tr><td colspan="4">' . $error . '</td></tr>';
                                                            }
                                                            if (!empty($_GET['msg']) && $_GET['msg'] == "success") {
                                                                echo '<tr><td colspan="4">Product has been added.</td></tr>';
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="text_bold" rowspan="2">Category</td>
                                                                <td rowspan="2">
                                                                    <select name="cmbcategory[]" id="cmbcategory" multiple>
                                                                        <?php
                                                                        $sql_query2 = "SELECT cat_id,cat_name FROM a_category WHERE is_deleted = '0'";
                                                                        $result2 = mysqli_query($con, $sql_query2);
                                                                        while ($row2 = mysqli_fetch_array($result2)) {
                                                                            $cat_id = $row2 ['cat_id'];
                                                                            ?>
                                                                            <option value="<?php echo $cat_id; ?>"><?php echo $row2 ['cat_name']; ?></option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td class="text_bold">Product Name</td>
                                                                <td>
                                                                    <input type="text" name="txtproname" id="txtproname" class="input_text">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text_bold">Price</td>
                                                                <td>
                                                                    <input type="text" name="txtprice" id="txtprice" class="input_text" onkeyup="CheckForFloat(this)">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text_bold">Discount(%)</td>
                                                                <td>
                                                                    <input type="text" name="discount" id="discount" class="input_text" onkeyup="CheckForFloat(this)">
                                                                </td>

                                                                <td class="text_bold" rowspan="2">Summary</td>
                                                                <td rowspan="2">
                                                                    <textarea  name="txtwarrenty" id="txtwarrenty" class="input_text"style="height: 50px;"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text_bold">Product Image</td>
                                                                <td>
                                                                    <input type="file" name="image_file2" id="image_file2" class="input_text"/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text_bold" valign="top">Description</td>
                                                                <td class="FeatureContainer" colspan="3">
                                                                    <textarea id="textdescription" name="textdescription" style="width:590px;height:200px" cols="" rows=""></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr><td class="border-top" colspan="2">&nbsp;</td></tr>
                                                            <tr>
                                                                <td align="center" colspan="2">
                                                                    <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" class="button" onclick="return validate()"/>
                                                                    <input type="reset" name="btnreset" id="btnreset" value="Reset" class="button"/>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>
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
