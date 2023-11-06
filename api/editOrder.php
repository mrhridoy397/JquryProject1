<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {
    $orderId = $_POST['orderId'];

    $orderDate                         = date('Y-m-d', strtotime($_POST['orderDate']));
    $deliveryDate                         = date('Y-m-d', strtotime($_POST['deliveryDate']));
    $clientName                     = $_POST['clientName'];
    $clientContact                 = $_POST['clientContact'];
    $subTotalValue                 = $_POST['subTotalValue'];
    $vatValue                         =    $_POST['vatValue'];
    $totalAmountValue     = $_POST['totalAmountValue'];
    $discount                         = $_POST['discount'];
    $grandTotalValue             = $_POST['grandTotalValue'];
    $paid                                 = $_POST['paid'];
    $dueValue                         = $_POST['dueValue'];
    $paymentType                     = $_POST['paymentType'];
    $paymentStatus                 = $_POST['paymentStatus'];
    $paymentPlace                 = $_POST['paymentPlace'];
    $gstn                 = $_POST['gstn'];
    $userid                 = $_SESSION['userId'];


    $sql = "UPDATE orders SET order_date = '$orderDate', deliveryDate = '$deliveryDate  ', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', order_status = 1 ,user_id = '$userid',payment_place = '$paymentPlace' , gstn = '$gstn' WHERE order_id = {$orderId}";
    $con->query($sql);

    $readyToUpdateOrderItem = false;
    // add the quantity from the order item to product table
    for ($x = 0; $x < count($_POST['productName']); $x++) {
        //  product table
        $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = " . $_POST['productName'][$x] . "";
        $updateProductQuantityData = $con->query($updateProductQuantitySql);

        while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
            // order item table add product quantity
            $orderItemTableSql = "SELECT order_item.quantity FROM order_item WHERE order_item.order_id = {$orderId}";
            $orderItemResult = $con->query($orderItemTableSql);
            $orderItemData = $orderItemResult->fetch_row();

            $editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];

            $updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = " . $_POST['productName'][$x] . "";
            $con->query($updateQuantitySql);
        } // while	

        if (count($_POST['productName']) == count($_POST['productName'])) {
            $readyToUpdateOrderItem = true;
        }
    } // /for quantity

    // remove the order item data from order item table
    for ($x = 0; $x < count($_POST['productName']); $x++) {
        $removeOrderSql = "DELETE FROM order_item WHERE order_id = {$orderId}";
        $con->query($removeOrderSql);
    } // /for quantity

    if ($readyToUpdateOrderItem) {
        // insert the order item data 
        for ($x = 0; $x < count($_POST['productName']); $x++) {
            $updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = " . $_POST['productName'][$x] . "";
            $updateProductQuantityData = $con->query($updateProductQuantitySql);

            while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
                $tq = $_POST['quantity'] + $_POST['squantity'];
                $updateQuantity[$x] = $updateProductQuantityResult[0] - $tq[$x];
                // update product table
                $updateProductTable = "UPDATE product SET quantity = '" . $updateQuantity[$x] . "' WHERE product_id = " . $_POST['productName'][$x] . "";
                $con->query($updateProductTable);

                // add into order_item
                $orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity,squantity, rate, total, order_item_status) 
				VALUES ({$orderId}, '" . $_POST['productName'][$x] . "', '" . $_POST['quantity'][$x] . "','" . $_POST['squantity'][$x] . "', '" . $_POST['rateValue'][$x] . "', '" . $_POST['totalValue'][$x] . "', 1)";

                $con->query($orderItemSql);
            } // while	
        } // /for quantity
    }



    $valid['success'] = true;
    $valid['messages'] = "Successfully Updated";

    $con->close();

    echo json_encode($valid);
} // /if $_POST
// echo json_encode($valid);