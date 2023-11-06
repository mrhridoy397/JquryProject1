<?php
session_start();
require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
if ($_POST) {

    $orderDate                         = date('Y-m-d', strtotime($_POST['orderDate']));
    $deliveryDate                         = date('Y-m-d', strtotime($_POST['deliveryDate']));
    $clientName                     = $_POST['clientName'];
    $clientContact                 = $_POST['clientContact'];
    $subTotalValue                 = $_POST['subTotalValue'];
    $vatValue                     = $_POST['vatValue'];
    $totalAmountValue             = $_POST['totalAmountValue'];
    $discount                     = $_POST['discount'];
    $grandTotalValue                 = $_POST['grandTotalValue'];
    $paid                         = $_POST['paid'];
    $dueValue                     = $_POST['dueValue'];
    $paymentType                     = $_POST['paymentType'];
    $paymentStatus                 = $_POST['paymentStatus'];
    $paymentPlace                 = $_POST['paymentPlace'];
    $gstn                         = $_POST['gstn'];
    $userid                        = $_SESSION['userId'];
    // sql
    $sql = "INSERT INTO orders (order_date, deliveryDate, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type, payment_status,payment_place, gstn,order_status,user_id) VALUES ('$orderDate','$deliveryDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue', '$paymentType', '$paymentStatus','$paymentPlace','$gstn', '1','$userid')";
    // init variable
    $order_id;
    // initial status
    $orderStatus = false;
    // insert order 
    if ($con->query($sql) === true) {
        // get order id form db
        $order_id = $con->insert_id;
        // add order id msg
        $valid['order_id'] = $order_id;
        $orderStatus = true;
    }
    // initial order item status
    $orderItemStatus = false;
    for ($x = 0; $x < count($_POST['productmainName']); $x++) {
        $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = " . $_POST['productmainName'][$x] . "";
        $updateProductQuantityData = $con->query($updateProductQuantitySql);
        while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            $tq = $_POST['quantity'] + $_POST['squantity'];
            $updateQuantity[$x] = $updateProductQuantityResult[0] - $tq[$x];
            // update product table
            $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity[$x] . "' WHERE product_id = " . $_POST['productName'][$x] . "";
            $con->query($updateProductTable);
            // add into order_item
            $orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity,squantity, rate, total, order_item_status) 
				VALUES ('$order_id', '" . $_POST['productmainName'][$x] . "', '" . $_POST['quantity'][$x] . "', '" . $_POST['squantity'][$x] . "', '" . $_POST['rateValue'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";
            $con->query($orderItemSql);
            if ($x == count($_POST['productmainName'])) {
                $orderItemStatus = true;
            }
        }
    }
    $valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$con->close();

	echo json_encode($valid);
}
