<?php

include './dbconfig.php';


//add in cart
if (isset($_GET['pid']) && !empty($_GET['pid'])) {

    $cartArr = array();
    $product_id = mysqli_real_escape_string($con, $_GET['pid']);
    $qty = 1;


    if (isset($_COOKIE[$cookie_name])) {


        $cartData = json_decode($_COOKIE[$cookie_name]);

        //assign data in another array
        foreach ($cartData as $keyid => $crData) {
            $cartArr[$keyid] = $crData;
        }


        //update product quantity
        foreach ($cartArr as $keyid => $crData) {
            if ($keyid == $product_id) {
                $cart_qty = $crData + $qty;
                $cartArr[$keyid] = $cart_qty;
            }
        }


        //add new product
        if (!isset($cartArr[$product_id])) {
            $cartArr[$product_id] = $qty;
        }

        unset($_COOKIE[$cookie_name]);
        setcookie($cookie_name, '', time() - $expire);
        setcookie($cookie_name, json_encode($cartArr), time() + $cookie_time);
    } else {

        $cartArr[$product_id] = $qty;
        setcookie($cookie_name, '', time() - $expire);
        setcookie($cookie_name, json_encode($cartArr), time() + $cookie_time);
    }
}


//delete from cart
if (isset($_GET['dpid']) && !empty($_GET['dpid'])) {

    $cartArr = array();
    $prodid = mysqli_real_escape_string($con, $_GET['dpid']);
    if (isset($_COOKIE[$cookie_name])) {

        $cartData = json_decode($_COOKIE[$cookie_name]);
        //assign data in another array
        foreach ($cartData as $keyid => $crData) {
            $cartArr[$keyid] = $crData;
        }

        //remove from cart
        if (!empty($prodid)) {
            unset($cartArr[$prodid]);
            unset($cartData->$prodid);
        }

        unset($_COOKIE[$cookie_name]);
        setcookie($cookie_name, '', time() - $expire);
        setcookie($cookie_name, json_encode($cartArr), time() + $cookie_time);
    }
}

//updatecard

if (isset($_POST)) {

    $cartArr = array();
    if (isset($_COOKIE[$cookie_name])) {

        //assign data in another array
        $cartData = json_decode($_COOKIE[$cookie_name]);
        foreach ($cartData as $keyid => $crData) {
            $cartArr[$keyid] = $crData;
        }

        $count = $_POST['count'];
        for ($i = 1; $i <= $count; $i++) {

            $proid = $_POST['temp' . $i];
            $pqty = $_POST['qty' . $i];

            //update product quantity
            foreach ($cartArr as $keyid => $crData) {
                if ($keyid == $proid) {
                    $cart_qty = $crData + $qty;
                    $cartArr[$keyid] = $pqty;
                }
            }
        }
        unset($_COOKIE[$cookie_name]);
        //setcookie($cookie_name, '', time() - $expire);
        setcookie($cookie_name, json_encode($cartArr), time() + $cookie_time);
    }
}


header("location:./cart.php");
?>
