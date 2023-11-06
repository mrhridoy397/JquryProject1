var manageProductTable;

$(document).ready(function () {
  // top nav bar 
  $('#navProduct').addClass('active');
  // manage product data table
  manageProductTable = $('#manageProductTable').DataTable({
    'ajax': 'api/fetchProduct.php',
    'order': []
  });
  // add product modal btn clicked
  $("#addProductModalBtn").unbind('click').bind('click', function () {
    // // product form reset
    $("#submitProductForm")[0].reset();

    // remove text-error 
    $(".text-danger").remove();
    // remove from-group error
    $(".form-group").removeClass('has-error').removeClass('has-success');
    //file inpurt
    $("#productImage").fileinput({
      overwriteInitial: true,
      maxFileSize: 2500,
      showClose: false,
      showCaption: false,
      browseLabel: '',
      removeLabel: '',
      browseIcon: '<i class="fa fa-folder-open"></i>',
      removeIcon: '<i class="fa fa-times"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-1',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="assets/img/default.png" alt="Profile Image" style="width:100%;height:150px">',
      layoutTemplates: { main2: '{preview} {remove} {browse}' },
      allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
    });
    // submit product form
    $("#submitProductForm").unbind('submit').bind('submit', function () {
      // submit loading button
      $("#createProductBtn").button('loading');
      var form = $(this);
      var formData = new FormData(this);
      // console.log(form.attr('method'));
      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: formData,
        dataType: 'Json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
          console.log(response);
          if (response.success == true) {
            // submit loading button
            $("#createProductBtn").button('reset');
            $("#submitProductForm")[0].reset();
            // shows a successful message after operation
            $('#add-product-messages').html('<div class="alert alert-success">' +
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
              '</div>');
            // remove the mesages
            $(".alert-success").delay(500).show(10, function () {
              $(this).delay(3000).hide(10, function () {
                $(this).remove();
              });
            }); // /.alert
            // reload the manage student table
            manageProductTable.ajax.reload(null, true);
            // remove text-error 
            $(".text-danger").remove();
            // remove from-group error
            $(".form-group").removeClass('has-error').removeClass('has-success');
          }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          alert("Status: " + textStatus); alert("Error: " + errorThrown);
        }
      });
      return false;
    });
  });
});

function editProduct(productId = null) {
  if (productId) {
    $("#productId").remove();
    // remove text-error 
    $(".text-danger").remove();
    // remove from-group error
    $(".form-group").removeClass('has-error').removeClass('has-success');
    // modal spinner
    $('.div-loading').removeClass('div-hide');
    // modal div
    $('.div-result').addClass('div-hide');
    $.ajax({
      url: 'api/fetchSelectedProduct.php',
      type: 'post',
      data: { id: productId },
      dataType: 'json',
      success: function (response) {
        // alert(response.product_image);
        // console.log(response);
        // modal spinner
        $('.div-loading').addClass('div-hide');
        // modal div
        $('.div-result').removeClass('div-hide');

        $("#getProductImage").attr('src', 'stock/' + response.product_image);
        $("#oldImagePath").val(response.product_image);

        $("#editProductImage").fileinput({
        });
        // product id 
        $(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.product_id + '" />');
        $(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.product_id + '" />');
        // product name
        $("#editProductName").val(response.product_name);
        // Product arrtibute
        $("#editattribute").val(response.attribute);
        // quantity
        $("#editQuantity").val(response.quantity);
        // mrp
        $("#editmrp").val(response.mrp);
        // console.log(response.mrp);
        // rate
        $("#editRate").val(response.rate);
        // brand name
        $("#editBrandName").val(response.brand_id);
        // category name
        $("#editCategoryName").val(response.categories_id);
        // status
        $("#editProductStatus").val(response.active);
        // update the product data function
        $("#editProductForm").unbind('submit').bind('submit', function () {
          // submit loading button
          // $("#editProductBtn").button('loading');
          var form = $(this);
          var formData = new FormData(this);
          $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
              console.log(response);
              if (response.success == true) {
                // shows a successful message after operation
                $('#edit-product-messages').html('<div class="alert alert-success">' +
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                  '</div>');

                // remove the mesages
                $(".alert-success").delay(500).show(10, function () {
                  $(this).delay(3000).hide(10, function () {
                    $(this).remove();
                  });
                }); // /.alert

                // reload the manage student table
                manageProductTable.ajax.reload(null, true);

                // remove text-error 
                $(".text-danger").remove();
                // remove from-group error
                $(".form-group").removeClass('has-error').removeClass('has-success');
              }
            }
          });
          // console.log(formData);

          return false;
        });
        // update productsimage
        $("#updateProductImageForm").unbind('submit').bind('submit', function () {
          var productImage = $("#editProductImage").val();
          if (productImage == "") {
            $("#editProductImage").closest('.center-block').after('<p class="text-danger">Product Image field is required</p>');
            $('#editProductImage').closest('.form-group').addClass('is-invalid');
          } else {
            // remov error text field
            $("#editProductImage").find('.text-danger').remove();
            // success out for form 
            $("#editProductImage").closest('.form-group').addClass('is-valid');
          }	// /else
          if (productImage) {
            // submit loading button
            // $("#editProductImageBtn").button('loading');

            var form = $(this);
            var formData = new FormData(this);
            $.ajax({
              url: form.attr('action'),
              type: form.attr('method'),
              data: formData,
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              success: function (response) {
                if (response.success == true) {
                  // submit loading button
                  // $("#editProductImageBtn").button('reset');																		

                  // shows a successful message after operation
                  $('#edit-productPhoto-messages').html('<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                    '</div>');

                  // remove the mesages
                  $(".alert-success").delay(500).show(10, function () {
                    $(this).delay(3000).hide(10, function () {
                      $(this).remove();
                    });
                  }); // /.alert

                  // reload the manage student table
                  manageProductTable.ajax.reload(null, true);

                  $(".fileinput-remove-button").click();

                  $.ajax({
                    url: 'api/fetchProductImageUrl.php?i=' + productId,
                    type: 'post',
                    success: function (response) {
                      $("#getProductImage").attr('src', response);
                    }
                  });

                  // remove text-error 
                  $(".text-danger").remove();
                  // remove from-group error
                  $(".form-group").removeClass('is-invalid').removeClass('is-valid');
                }
              }
            });
          }
          // console.log(productImage);
          return false;
        });
        // form validation

      }
    });
  }
}

// remove product 
function removeProduct(productId = null) {
  if (productId) {
    $("#removeProductBtn").unbind('click').bind('click', function () {
      $.ajax({
        url: 'api/removeProduct.php',
        type: 'post',
        data: { productId: productId },
        dataType: 'json',
        success: function (response) {
          if (response.success == true) {
            // remove product modal
            $("#removeProductModal").modal('hide');

            // update the product table
            manageProductTable.ajax.reload(null, false);

            // remove success messages
            $(".removeProductMessages").html('<div class="alert alert-success">' +
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
              '</div>');

            // remove the mesages
            $(".alert-success").delay(500).show(10, function () {
              $(this).delay(3000).hide(10, function () {
                $(this).remove();
              });
            }); // /.alert
          } else {

            // remove success messages
            $(".removeProductMessages").html('<div class="alert alert-success">' +
              '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
              '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
              '</div>');

            // remove the mesages
            $(".alert-success").delay(500).show(10, function () {
              $(this).delay(3000).hide(10, function () {
                $(this).remove();
              });
            }); // /.alert

          } // /error
        }
      });
      return false;
    });
  }
}