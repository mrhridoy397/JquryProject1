var ManageCategoryTable;
$(document).ready(function () {
    // show Brand in Data Table
    ManageCategoryTable = $("#ManageCategoryTable").DataTable({
		'ajax': 'api/fetchCategory.php',
		'order': [],
        "dataSrc": ""
	});
    //insert Category
    $("#submitCategoryForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // get value form
        var categoryname = $("#categoryname").val();
        var isActive = $("#isActive").val();
        var status = $("#status").val();
        // validation
        if (categoryname == "") {
            $("#categoryname").after('<p class="text-danger">Category Name field is required</p>');
            $('#categoryname').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#categoryname").find('.text-danger').remove();
            // success out for form 
            $("#categoryname").closest('.form-group').addClass('has-success');
        }
        if (isActive == "") {
            $("#isActive").after('<p class="text-danger">Category Active field is required</p>');

            $('#isActive').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#isActive").find('.text-danger').remove();
            // success out for form 
            $("#isActive").closest('.form-group').addClass('has-success');
        }

        if (status == "") {
            $("#status").after('<p class="text-danger">Category Status field is required</p>');

            $('#status').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#status").find('.text-danger').remove();
            // success out for form 
            $("#status").closest('.form-group').addClass('has-success');
        }
        //create ajax request
        if (categoryname && isActive && status) {
            var form = $(this);
            //create Button Loading
            $("#createCategoryBtn").button('loading');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'JSON',
                success: function (response) {
                    $("#createCategoryBtn").button('reset');
                    if (response.success == true) {
                        // reload the manage member table 
                        ManageCategoryTable.ajax.reload();
                        // reset the form text
                        $("#submitCategoryForm")[0].reset();
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        //add flash massage
                        $('#add-Category-messages').html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');
                        $(".alert-success").delay(500).show(10, function () {
                            $(this).delay(3000).hide(10, function () {
                                $(this).remove();
                            });
                        });
                    }
                }
            });
        }
        return false;
    });
});


// Edit category
function editCategorys(categoryId = null) {
    if (categoryId) {
        // remove hidden brand id text
        $('#categories_id').remove();

        // remove the error
        $('.text-danger').remove();
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // model loading
        $('.modal-loading').removeClass('div-hide');
        // model result
        $('.edit-Category-result').addClass('div-hide');
        // model footer
        $('.editcategoryFooter').addClass('div-hide');
        $.ajax({
            url: 'api/fetchSelectedCategory.php',
            type: 'get',
            data: { id: categoryId },
            dataType: 'JSON',
            success: function (response) {
                // model loading
                $('.modal-loading').addClass('div-hide');
                // model result
                $('.edit-Category-result').removeClass('div-hide');
                // model footer
                $('.editcategoryFooter').removeClass('div-hide');
                // setting the Brand name value
                $('#ecategoriesname').val(response.categories_name);
                // setting the Brand isActive value
                $('#eactive').val(response.categories_active);
                // setting the Brand status value
                $('#estatus').val(response.categories_status);
                $(".editcategoryFooter").after('<input type="hidden" name="categories_id" id="categories_id" value="' + response.categories_id + '" /> ');
                //  update brand form
                $('#editcategoryForm').unbind('submit').bind('submit', function () {
                    // console.log("Check");
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    // get form
                    var form = $(this);
                    // console.log(form.serialize());
                    // submit btn
                    $('#editcategoryBtn').button('loading');
                    // console.log("submiting..");
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            // reload the manage member table 
                            ManageCategoryTable.ajax.reload();
                            $("#editcategoryBtn").button('reset');
                            if (response.success == true) {
                                // remove the error text
                                $(".text-danger").remove();
                                // remove the form error
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                //add flash massage
                                $('#edit-category-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');
                                $(".alert-success").delay(500).show(10, function () {
                                    $(this).delay(3000).hide(10, function () {
                                        $(this).remove();
                                    });
                                });
                            }

                        }
                    });
                    return false;
                });
            }
        });
    }

}

// delete Categorys
function removeCategorys(categoryId = null) {
    if (categoryId) {
        $('.removeCategorysId').remove();
        $.ajax({
            url: 'api/fetchSelectedCategory.php',
            type: 'post',
            data: { id: categoryId },
            dataType: 'json',
            success: function (response) {
                $('.editcategoryFooter').after('<input type="hidden" name="removeCategorysId" id="removeCategorysId" value="' + response.categories_id + '"/>')
                // click on remove button to remove the brand
                $("#removecategoryBtn").unbind('click').bind('click', function () {
                    // buttion loading
                    $("#removecategoryBtn").button('loading');
                    $.ajax({
                        url: 'api/removeCategory.php',
                        type: 'post',
                        data: { id: categoryId },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == true) {
                                $('#deleteCategoryModal').modal('hide');
                                ManageCategoryTable.ajax.reload();

                                $('.remove-messages').html('<div class="alert alert-success">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                    '</div>');
                                $(".alert-success").delay(400).show(10, function () {
                                    $(this).delay(2000).hide(10, function () {
                                        $(this).remove();
                                    });
                                });
                            }
                            else {

                            }

                        }
                    });
                });
            }
        });
        $('.removecategoryFooter').after();
    }
    else {
        alert('error!! Refresh The Page again');
    }
}