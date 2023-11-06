<?php    

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_place,gstn FROM orders WHERE order_id = $orderId";

$orderResult = $con->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$payment_place = $orderData[10];
$gstn = $orderData[11];


$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
   INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $con->query($orderItemSql);

 $table = '<style>
.star img {
    visibility: visible;
}</style>
<table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
               <tbody>
                  <tr>
                     <td colspan="5" style="text-align:center;color: red;text-decoration: underline;    font-size: 25px;">INVOICE</td>
                  </tr>
                  <tr>
                     <td rowspan="8" colspan="2" style="border-left:1px solid black;" background-image="logo.jpg"><img src="assets/img/icbd.png" alt="logo" width="250px;"></td>
                     <td colspan="3" style=" text-align: right;">ORIGINAL</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;">DUPLICATE</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;color: red;font-style: italic;font-weight: 600;text-decoration: underline;font-size: 25px;">INNOVA Computers BD</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;">Masterpara, Charbata, Subarnachar, Noakhali</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;">Charbata-3813</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;">Phone: 01817682323,01867033550.</td>
                  </tr>
                  <tr>
                     <td colspan="3" style=" text-align: right;">Email: innovacomputersbd@gmail.com</td>
                  </tr>
                  
                  <tr>
                     <td colspan="2" style="padding: 0px;vertical-align: top;border-right:1px solid black;">
                        <table align="left" cellpadding="0" cellspacing="0" style="border: thin solid black; width: 100%">
                           <tbody>
                              <tr>
                                 <td style="width: 74px;vertical-align: top;color: red;" rowspan="3">TO, </td>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: red">&nbsp;'.$clientName.'</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: black">&nbsp;</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: black">&nbsp;</td>
                              </tr>
                           </tbody>
                        </table>
                        <table align="left" cellspacing="0" style="width: 100%; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-right-width: thin; border-bottom-width: thin; border-left-width: thin; border-right-color: black; border-bottom-color: black; border-left-color: black;">
                           <tbody>
                              <tr>
                                 <td style=" border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: red;color: red;">Vat :'.$gstn.'</td>
                                 <td style="border-left-style: solid; border-left-width: thin; border-left-color: black; border-bottom-style: solid; border-bottom-width: thin; border-bottom-color: red;color: red;">Mobile No: '.$clientContact.'</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                     <td style="padding: 0px;vertical-align: top;" colspan="3">
                        <table align="left" cellpadding="0" cellspacing="0" style="width: 100%">
                           <tbody>
                              <tr>
                                 <td style="border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;border-top: 1px solid black;border-right: 1px solid black;color: red;">Bill No : .</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;border-right: 1px solid black;    color: red;">Date: '.$orderDate.'</td>
                              </tr>
                              <tr>
                                 <td style="border-bottom-style: solid;border-bottom-width: thin;border-bottom-color: black;height: 52px;border-right: 1px solid black;    color: red;">G.S.T.IN: lorem ipsum</td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td style="width: 123px;text-align: center;background-color: black;color: white;border-right: 1px solid white;border-left: 1px solid black;border-bottom: 1px solid black;-webkit-print-color-adjust: exact;">SL
                     </td>
                     <td style="width: 50%;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: white;border-bottom-color: black;color: white;background-color: black;-webkit-print-color-adjust: exact;">Description</td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: #fff;border-bottom-color: black;background-color: black;color: white;-webkit-print-color-adjust: exact;">Qty.</td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: #fff;border-bottom-color: black;background-color: black;color: white;-webkit-print-color-adjust: exact;">Rate<br>
                        Ps
                     </td>
                     <td style="width: 150px;text-align: center;border-top-style: solid;border-right-style: solid;border-bottom-style: solid;border-top-width: thin;border-right-width: thin;border-bottom-width: thin;border-top-color: black;border-right-color: black;border-bottom-color: black;color: white;background-color: black;-webkit-print-color-adjust: exact;">Amount
                     </td>
                  </tr>';
                  $x = 1;
                  $cgst = 0;
                  $igst = 0;
                  $tax = $subTotal*3/100;
                  $subTotalMain = $subTotal-$discount;
                  if($payment_place == 2)
                  {
                     $igst = $subTotal*7.5/100;
                  }
                  else
                  {
                     $cgst = $subTotal*7.5/100;
                  }
                  $total = $subTotalMain+$cgst+$tax;
            while($row = $orderItemResult->fetch_array()) {       
                        
               $table .= '<tr>
                     <td style="border-left: 1px solid black;border-right: 1px solid black;height: 27px;">'.$x.'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[4].'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[2].'</td>
                     <td style="border-left: 1px solid black;height: 27px;">'.$row[1].'</td>
                     <td style="border-left: 1px solid black;border-right: 1px solid black;height: 27px;">'.$row[3].'</td>
                  </tr>
               ';
            $x++;
            } // /while
                $table.= '
                  <tr style="border-bottom: 1px solid black;">
                     <td style="border-left: 1px solid black;border-right: 1px solid black;height: 27px;"></td>
                     <td style="border-left: 1px solid black;height: 27px;"></td>
                     <td style="border-left: 1px solid black;height: 27px;"></td>
                     <td style="width: 149px;border-right-style: solid;border-bottom-style: solid;border-right-width: thin;border-bottom-width: thin;border-right-color: black;border-bottom-color: #000;background-color: black;color: white;padding-left: 5px;-webkit-print-color-adjust: exact;">Total</td>
                     <td style="width: 218px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-top-width: thin; border-right-width: thin; border-bottom-width: thin; border-top-color: black; border-right-color: black; border-bottom-color: black;">'.$subTotal.'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-top: 1px solid black;border-bottom: 1px solid black;border-left: 1px solid black;padding: 5px;">Neft For:- Bank Name</td>
                     <td rowspan="2" style="border-bottom: 1px solid black;width: 199px;color: white;background-color: black;padding-left: 5px;-webkit-print-color-adjust: exact;">VAT 7.5%</td>
                     <td rowspan="2" style="border-bottom: 1px solid black;width: 288px;border-right: 1px solid black;">'.$cgst.'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-bottom: 1px solid black;width: 859px;border-left: 1px solid black;padding: 5px;">Branch:- branch Address</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-bottom: 1px solid black;border-left: 1px solid black;padding: 5px;">Bank IFSC CODE:- 78945612301</td>
                     <td rowspan="2" style="border-bottom: 1px solid black;width: 149px;background-color: black;color: white;padding-left: 5px;-webkit-print-color-adjust: exact;">Tax 3%</td>
                     <td rowspan="2" style="width:218px;border-bottom: 1px solid black;border-right: 1px solid black;">'.$tax.'
                     </td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-bottom: 1px solid black;border-left: 1px solid black;padding: 5px;">AC. HO. Name:- Comapany Name</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-bottom: 1px solid black;border-left: 1px solid black;padding: 5px;">AC.NO. :- lorem ipsum</td>
                     <td style="border-bottom: 1px solid black;background-color: black;color: white;padding: 5px;-webkit-print-color-adjust: exact;">Discount</td>
                     <td style="border-bottom: 1px solid black;border-right: 1px solid black;">'.$discount.'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-left: 1px solid black;border-bottom: 1px solid black;color: red;padding: 5px;">Amount in words</td>
                     <td style="border-bottom: 1px solid #fff;background-color: black;color: white;padding: 5px;-webkit-print-color-adjust: exact;">G. Total</td>
                     <td style="border-bottom: 1px solid black;border-right: 1px solid;">'.$total.'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-left: 1px solid black;border-bottom: 1px solid black;padding: 5px;border-right: 1px solid black;">* Subject to lorem ipsum             <span style="float: right;"> E.&amp;.O.E.</span></td>
                     <td rowspan="2" colspan="2" style="vertical-align: bottom;padding: 5px;color: red;border-right: 1px solid black;text-align: center;">for, Company Name</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="border-left: 1px solid black;padding-left: 5px;border-right: 1px solid black;">
                        * Intrest will be charged upon all acounts 
                        <p style="margin: 0px;">remaning unpaid after due date</p>
                     </td>
                  </tr>
               </tbody>
            </table>';
$con->close();

echo $table;