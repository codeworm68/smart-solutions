<?php
include './dbconfig.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Contact Us - SMART SOLUTIONS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"/>
        <link href="stylesheet/style.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/menu.css" rel="stylesheet" type="text/css" />
        <link href="stylesheet/form-field.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="stylesheet/left-panel.css" rel="stylesheet"/>
        <script type="text/javascript" src="js/crawler.js"></script>
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/menu1.js"></script>
    </head>
    <body>
<!--
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
<button align="center"><a href="http://localhost/chatbot/bot.php" target="_self" > Chatbot</a></button>
-->
<div class="chat_icon">
  <a href="http://localhost/chatbot/bot.php"><i class="fa fa-comments-o" aria-hidden="true"></i></a>
</div>
        <div id="wrapper">
            <div id="container">
                <div id="header">
                    <?php
                    include('header.php');
                    ?>
                </div>
                <div id="center-page">
                    <div class="content">
                        <table  width="970" border="0" style="margin-left: -20px;float: left;">
                            <tr>
                                <td height="44" colspan="2" valign="top" class="title" style="padding-top: 10px;">
                                    <img src="images/tl-contactus.gif" width="110" height="30" alt="Samepal.com- Eshop"/>
                                </td>
                            </tr>
                            <tr>
                                <td width="350" valign="top">
                                    <table cellpadding="10" cellspacing="10" width="100%">
                                        <tr>
                                            <td class="newuser_bold"><h2>Office Location</h2></td>
                                        </tr>
                                        <tr>
                                            <td class="boldmatter"><h3>Online Shopping</h3></td>
                                        </tr>

                                        <tr>
                                            <td class="boldmatter"><h4>D - Block Vikaspuri</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="boldmatter"><h4>New Delhi - 110018</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="boldmatter"><h4>Mobile No.: +91- 9354330089</h4></td>
                                        </tr>
                                        <tr>
                                            <td class="boldmatter"><h4> Email ID.: sachi18wadhawan@gmail.com</h4></td>
                                        </tr>
                                        <tr><td><hr/></td></tr>
                                    </table>
                                </td>
                                <td width="600">
                                    <iframe width="600" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.co.in/maps?hl=en&amp;q=B3%2F90+LGF+Safdarjung+Enclave&amp;ie=UTF8&amp;sqi=2&amp;hq=B3%2F90+LGF+Safdarjung+Enclave&amp;hnear=&amp;radius=15000&amp;t=m&amp;ll=37.38645,-121.963745&amp;spn=0.006295,0.006295&amp;output=embed"></iframe>
                                </td>
                            </tr>
                            <tr><td colspan="2">&nbsp&nbsp&nbsp&nbsp;</td></tr>
                        </table>
                    </div>

                </div>


                <?php
                    include('footer.php');
                ?>
            </div>
        </div>
    </body>
</html>
