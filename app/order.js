var manageOrderTable;

$(document).ready(function () {
	$("#paymentPlace").change(function () {
		if ($("#paymentPlace").val() == 2) {
			$(".gst").text("VAT 8.5%");
		}
		else {
			$(".gst").text("VAT 7.10%");
		}
	});
	$("#orderDate").datepicker();
	$("#deliveryDate").datepicker();

	var divRequest = $(".div-request").text();
	console.log(divRequest);
	// top nav bar 
	$("#navOrder").addClass('active');

	if (divRequest == 'manord') {

		$('#topNavManageOrder').addClass('active');

		manageOrderTable = $("#manageOrderTable").DataTable({
			'ajax': 'api/fetchOrder.php',
			'order': [],
			"dataSrc": ""
		});


	}
	else if (divRequest == 'add') {
		// add order	
		// top nav child bar 
		$('#topNavAddOrder').addClass('active');

		// create order form function
		$("#createOrderForm").unbind('submit').bind('submit', function () {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			var orderDate = $("#orderDate").val();
			var clientName = $("#clientName").val();
			var clientContact = $("#clientContact").val();
			var paid = $("#paid").val();
			var discount = $("#discount").val();
			var paymentType = $("#paymentType").val();
			var paymentStatus = $("#paymentStatus").val();

			// form validation 
			if (orderDate == "") {
				$("#orderDate").after('<p class="text-danger"> The Order Date field is required </p>');
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			} // /else

			if (clientName == "") {
				$("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else

			if (clientContact == "") {
				$("#clientContact").after('<p class="text-danger"> The Contact field is required </p>');
				$('#clientContact').closest('.form-group').addClass('has-error');
			} else {
				$('#clientContact').closest('.form-group').addClass('has-success');
			} // /else

			if (paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if (discount == "") {
				$("#discount").after('<p class="text-danger"> The Discount field is required </p>');
				$('#discount').closest('.form-group').addClass('has-error');
			} else {
				$('#discount').closest('.form-group').addClass('has-success');
			} // /else

			if (paymentType == "") {
				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			} // /else

			if (paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var productmainName = document.getElementsByName('productmainName[]');
			var validatemainProduct;
			for (var x = 0; x < productmainName.length; x++) {
				var productmainNameId = productmainName[x].id;
				if (productmainName[x].value == '') {
					$("#" + productmainNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + productmainNameId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + productmainNameId + "").closest('.form-group').addClass('has-success');
				}
			} // for

			for (var x = 0; x < productmainName.length; x++) {
				if (productmainName[x].value) {
					validatemainProduct = true;
				} else {
					validatemainProduct = false;
				}
			} // for 
			// array validation
			var productName = document.getElementsByName('productName[]');
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {
				var productNameId = productName[x].id;
				if (productName[x].value == '') {
					$("#" + productNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + productNameId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + productNameId + "").closest('.form-group').addClass('has-success');
				}
			} // for

			for (var x = 0; x < productName.length; x++) {
				if (productName[x].value) {
					validateProduct = true;
				} else {
					validateProduct = false;
				}
			} // for       		   	

			var quantity = document.getElementsByName('quantity[]');
			var validateQuantity;
			for (var x = 0; x < quantity.length; x++) {
				var quantityId = quantity[x].id;
				if (quantity[x].value == '') {
					$("#" + quantityId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + quantityId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + quantityId + "").closest('.form-group').addClass('has-success');
				}
			}  // for

			for (var x = 0; x < quantity.length; x++) {
				if (quantity[x].value) {
					validateQuantity = true;
				} else {
					validateQuantity = false;
				}
			} // for 

			var squantity = document.getElementsByName('squantity[]');
			var validateSQuantity;
			for (var x = 0; x < squantity.length; x++) {
				var squantityId = squantity[x].id;
				if (squantity[x].value == '') {
					$("#" + squantityId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + squantityId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + squantityId + "").closest('.form-group').addClass('has-success');
				}
			}  // for

			for (var x = 0; x < squantity.length; x++) {
				if (squantity[x].value) {
					validateSQuantity = true;
				} else {
					validateSQuantity = false;
				}
			} // for 
			if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
				if (validatemainProduct == true && validateProduct == true && validateQuantity == true && validateSQuantity == true) {

					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),
						dataType: 'json',
						success: function (response) {
							console.log(response);
							// reset button
							$("#createOrderBtn").button('reset');

							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if (response.success == true) {

								// create order button
								$(".success-messages").html('<div class="alert alert-success">' +
									'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
									'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
									' <br /> <br /> <a type="button" onclick="printOrder(' + response.order_id + ')" class="btn btn-primary"> <i class="fa fa-print"></i> Print </a>' +
									'<a href="addOrder.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="fa fa-plus-sign"></i> Add New Order </a>' +

									'</div>');

								$("html, body, div.panel, div.pane-body").animate({ scrollTop: '0px' }, 100);

								// disabled te modal footer button
								$(".submitButtonFooter").addClass('div-hide');
								// remove the product row
								$(".removeProductRowBtn").addClass('div-hide');

							} else {
								alert(response.messages);
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true


			return false;
		}); // /create order form function	
	}
	else if (divRequest == 'editOrd') {
		$("#orderDate").datepicker();
		// edit order form function
		$("#editOrderForm").unbind('submit').bind('submit', function () {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			var orderDate = $("#orderDate").val();
			var clientName = $("#clientName").val();
			var clientContact = $("#clientContact").val();
			var paid = $("#paid").val();
			var discount = $("#discount").val();
			var paymentType = $("#paymentType").val();
			var paymentStatus = $("#paymentStatus").val();

			// form validation 
			if (orderDate == "") {
				$("#orderDate").after('<p class="text-danger"> The Order Date field is required </p>');
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			} // /else

			if (clientName == "") {
				$("#clientName").after('<p class="text-danger"> The Client Name field is required </p>');
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else

			if (clientContact == "") {
				$("#clientContact").after('<p class="text-danger"> The Contact field is required </p>');
				$('#clientContact').closest('.form-group').addClass('has-error');
			} else {
				$('#clientContact').closest('.form-group').addClass('has-success');
			} // /else

			if (paid == "") {
				$("#paid").after('<p class="text-danger"> The Paid field is required </p>');
				$('#paid').closest('.form-group').addClass('has-error');
			} else {
				$('#paid').closest('.form-group').addClass('has-success');
			} // /else

			if (discount == "") {
				$("#discount").after('<p class="text-danger"> The Discount field is required </p>');
				$('#discount').closest('.form-group').addClass('has-error');
			} else {
				$('#discount').closest('.form-group').addClass('has-success');
			} // /else

			if (paymentType == "") {
				$("#paymentType").after('<p class="text-danger"> The Payment Type field is required </p>');
				$('#paymentType').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentType').closest('.form-group').addClass('has-success');
			} // /else

			if (paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> The Payment Status field is required </p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var productmainName = document.getElementsByName('productmainName[]');
			var validatemainProduct;
			for (var x = 0; x < productmainName.length; x++) {
				var productmainNameId = productmainName[x].id;
				if (productmainName[x].value == '') {
					$("#" + productmainNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + productmainNameId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + productmainNameId + "").closest('.form-group').addClass('has-success');
				}
			} // for

			for (var x = 0; x < productmainName.length; x++) {
				if (productmainName[x].value) {
					validatemainProduct = true;
				} else {
					validatemainProduct = false;
				}
			} // for 
			// array validation
			var productName = document.getElementsByName('productName[]');
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {
				var productNameId = productName[x].id;
				if (productName[x].value == '') {
					$("#" + productNameId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + productNameId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + productNameId + "").closest('.form-group').addClass('has-success');
				}
			} // for

			for (var x = 0; x < productName.length; x++) {
				if (productName[x].value) {
					validateProduct = true;
				} else {
					validateProduct = false;
				}
			} // for       		   	

			var quantity = document.getElementsByName('quantity[]');
			var validateQuantity;
			for (var x = 0; x < quantity.length; x++) {
				var quantityId = quantity[x].id;
				if (quantity[x].value == '') {
					$("#" + quantityId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + quantityId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + quantityId + "").closest('.form-group').addClass('has-success');
				}
			}  // for

			for (var x = 0; x < quantity.length; x++) {
				if (quantity[x].value) {
					validateQuantity = true;
				} else {
					validateQuantity = false;
				}
			} // for 

			var squantity = document.getElementsByName('squantity[]');
			var validateSQuantity;
			for (var x = 0; x < squantity.length; x++) {
				var squantityId = squantity[x].id;
				if (squantity[x].value == '') {
					$("#" + squantityId + "").after('<p class="text-danger"> Product Name Field is required!! </p>');
					$("#" + squantityId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + squantityId + "").closest('.form-group').addClass('has-success');
				}
			}  // for

			for (var x = 0; x < squantity.length; x++) {
				if (squantity[x].value) {
					validateSQuantity = true;
				} else {
					validateSQuantity = false;
				}
			} // for      	   	


			if (orderDate && clientName && clientContact && paid && discount && paymentType && paymentStatus) {
				if (validatemainProduct == true && validateProduct == true && validateQuantity == true && validateSQuantity == true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url: form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),
						dataType: 'json',
						success: function (response) {
							console.log(response);
							// reset button
							$("#editOrderBtn").button('reset');

							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if (response.success == true) {
								// create order button
								$(".success-messages").html('<div class="alert alert-success">' +
									'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
									'<strong><i class="fa fa-ok-sign"></i></strong> ' + response.messages +
									'</div>');

								$("html, body, div.panel, div.pane-body").animate({ scrollTop: '0px' }, 100);

								// disabled te modal footer button
								$(".editButtonFooter").addClass('div-hide');
								// remove the product row
								$(".removeProductRowBtn").addClass('div-hide');

							} else {
								alert(response.messages);
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true


			return false;
		}); // /edit order form function	
	}

});

// print order function
function printOrder(orderId = null) {
	if(orderId) {		
			
		$.ajax({
			url: 'api/printOrder.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10
        mywindow.resizeTo(screen.width, screen.height);
setTimeout(function() {
    mywindow.print();
    mywindow.close();
}, 1250);

        //mywindow.print();
        //mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function
// 14/11/19


function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;
	// console.log(tableLength);
	var tableRow;
	var arrayNumber;
	var count;
	if (tableLength > 0) {
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
	$.ajax({
		url: 'api/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success: function (response) {

			$("#addRowBtn").button("reset");
			// console.log(response);
			var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
				'<td>' +
				'<div class="form-group">' +

				'<select class="form-control" name="productmainName[]" id="productmainName' + count + '" onchange="getProductmainData(' + count + ')" >' +
				'<option value="">~~SELECT~~</option>';
			// console.log(response);
			$.each(response, function (index, value) {
				tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
			});

			tr += '</select>' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:25px;">' +
				'<div class="form-group">' +

				'<select class="form-control" name="productName[]" id="productName' + count + '" onchange="getProductData(' + count + ')" >' +
				'<option value="">~~SELECT~~</option>' +
				// console.log(response);
				'</select>' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px;"">' +
				'<input type="text" name="mrp[]" id="mrp' + count + '" autocomplete="off" disabled="true" class="form-control" />' +
				'<input type="hidden" name="mrpValue[]" id="mrpValue' + count + '" autocomplete="off" class="form-control" />' +
				'</td>' +
				'<td style="padding-left:20px;"">' +
				'<input type="text" name="rate[]" id="rate' + count + '" autocomplete="off" disabled="true" class="form-control" />' +
				'<input type="hidden" name="rateValue[]" id="rateValue' + count + '" autocomplete="off" class="form-control" />' +
				'</td>' +
				'<td style="padding-left:20px;">' +
				'<div class="form-group">' +
				'<p id="available_quantity' + count + '"></p>' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px;">' +
				'<div class="form-group">' +
				'<input type="number" name="quantity[]" id="quantity' + count + '" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
				'</div>' +
				'</td>' +

				'<td style="padding-left:25px;">' +
				'<div class="form-group">' +
				'<input type="number" name="squantity[]" id="squantity' + count + '" onkeyup="getsTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px; display:none;">' +
				'<div class="form-group">' +
				'<p id="available_squantity' + count + '"></p>' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px;">' +
				'<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" disabled="true" />' +
				'<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control" />' +
				'</td>' +
				'<td>' +
				'<button class="btn btn-danger removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="fa fa-trash"></i></button>' +
				'</td>' +
				'</tr>';
			// console.log(tr);
			if (tableLength > 0) {
				$("#productTable tbody tr:last").after(tr);
			} else {
				$("#productTable tbody").append(tr);
			}
		}
	});

}
function removeProductRow(row = null) {
	if (row) {
		$("#row" + row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}
function getProductmainData(row = null) {

	if (row) {
		var productmainId = $("#productmainName" + row).val();
		if (productmainId == "") {
			$("#productName" + row).val("");
		}
		else {
			//console.log(productmainId);
			$.ajax({
				url: 'api/fetchSelectedProductName.php',
				type: 'POST',
				data: { productMainId: productmainId },
				dataType: 'json',
				success: function (response) {
					//console.log(response);	
					$.each(response, function (index, value) {
						$("#productName" + row).append(
							'<option value="' + value[0] + '">' + value[1] + '</option>'
						);
						//console.log(value[0]);							
					});


				} // /success
			}); // /ajax function to fetch the product data	
		}

	} else {
		alert('no row! please refresh the page');
	}
}
// /select on product data
function getProductData(row = null) {

	if (row) {
		var productId = $("#productName" + row).val();
		// console.log(productId);
		if (productId == "") {
			$("#mrp" + row).val("");
			$("#rate" + row).val("");

			$("#quantity" + row).val("");
			$("#squantity" + row).val("");
			$("#total" + row).val("");

		} else {
			$.ajax({
				url: 'api/fetchSelectedProduct.php',
				type: 'post',
				data: { id: productId },
				dataType: 'json',
				success: function (response) {
					// setting the rate value into the rate input field
					// console.log(response);
					$("#mrp" + row).val(response.mrp);
					$("#mrpValue" + row).val(response.mrp);

					$("#rate" + row).val(response.rate);
					$("#rateValue" + row).val(response.rate);

					$("#quantity" + row).val(1);
					$("#available_quantity" + row).text(response.quantity);

					$("#squantity" + row).val(1);
					$("#available_squantity" + row).text(response.squantity);

					var total = Number(response.rate) * 1;
					total = total.toFixed(2);
					$("#total" + row).val(total);
					$("#totalValue" + row).val(total);


					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}

	} else {
		alert('no row! please refresh the page');
	}
}
// table total
function getTotal(row = null) {
	if (row) {
		var total = Number($("#rate" + row).val()) * Number($("#quantity" + row).val());
		total = total.toFixed(2);
		$("#total" + row).val(total);
		$("#totalValue" + row).val(total);

		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}
// table total
function getsTotal(row = null) {
	if (row) {
		var totalq = Number($("#quantity" + row).val()) + Number($("#squantity" + row).val());
		totalq = totalq.toFixed(2);

	} else {
		alert('no row !! please refresh the page');
	}
}
// /select on product data
function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for (x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#subTotal").val()) / 100) * parseFloat(7.5);
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	var discount = $("#discount").val();
	if (discount) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if (paidAmount) {
		paidAmount = Number($("#grandTotal").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {
		$("#due").val($("#grandTotal").val());
		$("#dueValue").val($("#grandTotal").val());
	} // else

} // /sub total amount

function discountFunc() {
	var discount = $("#discount").val();
	var totalAmount = Number($("#totalAmount").val());
	totalAmount = totalAmount.toFixed(2);
	// console.log(totalAmount);
	var grandTotal;
	if (totalAmount) {
		grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
		grandTotal = grandTotal.toFixed(2);
		// console.log(grandTotal);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	}
	else {
		//
	}
	var paid = $("#paid").val();
	var dueAmount;
	if (paid) {
		dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);

		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} else {
		$("#due").val($("#grandTotal").val());
		$("#dueValue").val($("#grandTotal").val());
	}
}
//paid amoutn function
function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if (grandTotal) {
		var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amoutn function
function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('is-valid').removeClass('is-invalid');
} // /reset order form

// remove order from server
function removeOrder(orderId = null) {
	if(orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function() {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'api/removeOrder.php',
				type: 'post',
				data: {orderId : orderId},
				dataType: 'json',
				success:function(response) {
					$("#removeOrderBtn").button('reset');

					if(response.success == true) {

						manageOrderTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						$(".success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeOrderMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}
// /remove order from server

// Payment ORDER
function paymentOrder(orderId = null) {
	if(orderId) {

		$("#orderDate").datepicker();

		$.ajax({
			url: 'api/fetchOrderData.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'json',
			success:function(response) {				

				// due 
				$("#due").val(response.order[10]);				

				// pay amount 
				$("#payAmount").val(response.order[10]);

				var paidAmount = response.order[9] 
				var dueAmount = response.order[10];							
				var grandTotal = response.order[8];

				// update payment
				$("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
					var payAmount = $("#payAmount").val();
					var paymentType = $("#paymentType").val();
					var paymentStatus = $("#paymentStatus").val();

					if(payAmount == "") {
						$("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#payAmount").closest('.form-group').addClass('has-error');
					} else {
						$("#payAmount").closest('.form-group').addClass('has-success');
					}

					if(paymentType == "") {
						$("#paymentType").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#paymentType").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentType").closest('.form-group').addClass('has-success');
					}

					if(paymentStatus == "") {
						$("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
						$("#paymentStatus").closest('.form-group').addClass('has-error');
					} else {
						$("#paymentStatus").closest('.form-group').addClass('has-success');
					}

					if(payAmount && paymentType && paymentStatus) {
						$("#updatePaymentOrderBtn").button('loading');
						$.ajax({
							url: 'api/editPayment.php',
							type: 'post',
							data: {
								orderId: orderId,
								payAmount: payAmount,
								paymentType: paymentType,
								paymentStatus: paymentStatus,
								paidAmount: paidAmount,
								grandTotal: grandTotal
							},
							dataType: 'json',
							success:function(response) {
								$("#updatePaymentOrderBtn").button('loading');

								// remove error
								$('.text-danger').remove();
								$('.form-group').removeClass('has-error').removeClass('has-success');

								$("#paymentOrderModal").modal('hide');

								$(".success-messages").html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

								// remove the mesages
			          $(".alert-success").delay(500).show(10, function() {
									$(this).delay(3000).hide(10, function() {
										$(this).remove();
									});
								}); // /.alert	

			          // refresh the manage order table
								manageOrderTable.ajax.reload(null, false);

							} //

						});
					} // /if
						
					return false;
				}); // /update payment			

			} // /success
		}); // fetch order data
	} else {
		alert('Error ! Refresh the page again');
	}
}
