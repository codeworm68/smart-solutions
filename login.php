<?php
include './dbconfig.php';
$error = "";

//login form
if (isset($_POST['btnLogin'])) {
    $email = $_POST['txtUname'];
    $password = $_POST['txtPassword'];

    $query = "select id,name,utype from users where email = '" . $email . "' and `password` = '" . $password . "' and ustatus = '1'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_row($result);
        $_SESSION['user_id'] = $row[0];
        $_SESSION['user_name'] = $row[1];
        $_SESSION['user_type'] = $row[2];

        if ($row ['utype'] == "admin") {
            header("location:admin_home.php");
        } else {
            header("location:myprofile.php");
        }
    } else {
        $error = "Email and Password are wrong.";
    }
}
//registration form
if (isset($_POST['btnsubmit'])) {
    $Name = $_POST['txtName'];
    $Email = $_POST['txtEmailID'];
    $Mobile = $_POST['txtMobile'];
    $password = $_POST['password'];

    $sql_query = "select email from users where email = '" . $Email . "'";
    $res_data = mysqli_query($con, $sql_query);
    if (mysqli_num_rows($con, $res_data) > 0) {
        $error = "Email ID allready exits.";
    } else {
        $query = "insert into users(name,email,mobile,password,created,utype) values('" . $Name . "','" . $Email . "','" . $Mobile . "','" . $password . "',now(),'user')";
        $res_user = mysqli_query($con, $query);
        $user_id = mysqli_insert_id($con);
        if ($user_id > 0) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $Name;
            $_SESSION['user_type'] = "user";
            header("location:myprofile.php");
        } else {
            $error = "Your form has not been submited.";
        }
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Login - SMART SOLUTIONS</title>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
        <script type="text/javascript">
            function regValidation() {

                var fname = document.getElementById('txtName');
                if (fname.value.trim() == "") {
                    alert('Name fileld cannot be blank left. !!');
                    fname.focus();
                    return false;
                }

                var email = document.getElementById('txtEmailID');
                if (email.value.trim() == "") {
                    alert('Email ID field cannot be blank left. !!');
                    email.focus();
                    return false;
                }
                var mobile = document.getElementById('txtMobile');
                if (mobile.value.trim() == "") {
                    alert('Mobile No. field cannot be blank left. !!');
                    mobile.focus();
                    return false;
                }
                var password = document.getElementById('password');
                if (password.value.trim() == "") {
                    alert('password. field cannot be blank left. !!');
                    password.focus();
                    return false;
                }
                var confirm_password = document.getElementById('confirm_password');
                if (confirm_password.value.trim() == "") {
                    alert('Confirm Password. field cannot be blank left. !!');
                    confirm_password.focus();
                    return false;
                }

                if(password.value.trim() != confirm_password.value.trim()){
                    alert('Password does not matched with confirm password.');
                    confirm_password.focus();
                    return false;
                }

            }
        </script>
        <script type="text/javascript">


            function LogingValidate() {
                var email = document.getElementById('txtUname');
                if (email.value.trim() == "") {
                    alert('Please enter your email.');
                    return false;
                }
                var pwd = document.getElementById('txtPassword');
                if (pwd.value.trim() == "") {
                    alert('Please enter your password');
                    return false;
                }
            }

            function validateEmail() {
                //alert('calling');
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var address = document.getElementById('txtEmailID').value;
                if (reg.test(address) == false) {
                    alert('Invalid Email Address');
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
                    <div class="content" style="height: 500px;padding: 20px;">
                        <?php
                        if (!empty($_GET['status']) && $_GET['status'] == "login") {
                            ?>
                            <div colspan="2" class="message">
                                <span class="failed">
                                    <img src="images/cross.gif"/>&nbsp;&nbsp;<b>Must be login for placing order.</b>
                                </span>
                            </div>

                            <?php
                        }
                        ?>
                        <div style="width: 420px;float: left;background: #f2f2f2;margin: 70px 10px 10px 10px;padding: 10px;">
                            <form action="" method="post">
                                <table cellpadding="12" cellspacing="12" border="0" width="100%">

                                    <tr>
                                        <td colspan="2">
                                            <h2 class="login_title">Create an account</h2>
                                        </td>
                                    </tr>
                                    <tr><td height="15"></td></tr>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <tr>
                                            <td colspan="2" class="message">
                                                <span class="failed">
                                                    <img src="images/cross.gif"/>&nbsp;&nbsp;<b><?php echo $error; ?></b>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="newuser_bold" width="150">Name</td>
                                        <td><input type="text" name="txtName" id="txtName" class="newuser_input" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td class="newuser_bold">Email ID</td>
                                        <td><input type="text" name="txtEmailID" id="txtEmailID" class="newuser_input"  onblur="return validateEmail();" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td class="newuser_bold">Mobile No.</td>
                                        <td><input type="text" name="txtMobile" id="txtMobile" class="newuser_input" onkeyup="CheckForIntegers(this);" maxlength="10"/></td>
                                    </tr>
                                    <tr>
                                        <td class="newuser_bold">Password</td>
                                        <td><input type="password" name="password" id="password" class="newuser_input" maxlength="25"/></td>
                                    </tr>
                                    <tr>
                                        <td class="newuser_bold">Confirm Password</td>
                                        <td><input type="password" name="confirm_password" id="confirm_password" class="newuser_input" maxlength="25"/></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" onclick="return regValidation();" class="prdbuttonbuynow" style="cursor: pointer;"/>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <div style="width: 420px;float: left;background: #f2f2f2;margin: 70px 10px 10px 10px;padding: 10px;">
                            <form action="#" method="post">
                                <table cellpadding="10" cellspacing="10" border="0" width="100%">
                                    <tr>
                                        <td colspan="2">
                                            <h2 class="login_title">Already registered?</h2>
                                        </td>
                                    </tr>
                                    <tr><td height="15"></td></tr>
                                    <?php
                                    if (!empty($error)) {
                                        ?>
                                        <tr>
                                            <td colspan="2" class="message">
                                                <span class="failed">
                                                    <img src="images/cross.gif"/>&nbsp;&nbsp;<b><?php echo $error; ?></b>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td class="newuser_bold">Email</td>
                                        <td><input type="text" name="txtUname" id="txtUname" class="newuser_input" maxlength="100"/></td>
                                    </tr>
                                    <tr>
                                        <td class="newuser_bold" width="150">Password</td>
                                        <td><input type="password" name="txtPassword" id="txtPassword" class="newuser_input" maxlength="25"/></td>
                                    </tr>
                                    <tr>
                                        <td align="right" colspan="2"><input type="submit" name="btnLogin" id="btnLogin" value="Login" onclick="return LogingValidate();" class="prdbuttonmore"/></td>
                                    </tr>
                                    <tr><td height="120">&nbsp;</td></tr>
                                </table>
                            </form>
                        </div>

                    </div>
                </div>

                <?php
                include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>
