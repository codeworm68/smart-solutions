<div class="leftbacground">
    <div id="cssmenu">
        <ul style="">
            <?php
            if ($user_type == "admin") {
                ?>            
                <li><a href="admin_home.php">Dashboard</a></li>
                <li><a href="add_category.php">Add Category</a></li>
                <li><a href="categorylist.php">Category List</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="productlist.php">Product List</a></li>
                <li><a href="userlist.php">User List</a></li>                
                <li><a href="ner-order.php">Order List</a></li>                
                <li><a href="changepwd.php">Change Password</a></li>  
                <?php
            } else {
                ?>
                <li><a href="myprofile.php">My Profile</a></li>
                <li><a href="order-list.php">My Order</a></li>            
                <li><a href="changepwd.php">Change Password</a></li>  
                <?php
            }
            ?>

        </ul>
    </div>
</div>