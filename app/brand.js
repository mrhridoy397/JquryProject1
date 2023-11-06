var ManageBrandTable;
$(document).ready(function () {
    // show Brand in Data Table
    ManageBrandTable = $("#ManageBrandTable").DataTable({
        'ajax': 'api/fetchBrand.php',
        'order': [],
        "dataSrc": ""
    });
    //insert Brand
    $("#submitBrandForm").unbind('submit').bind('submit', function () {
        // remove the error text
        $(".text-danger").remove();
        // remove the form error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // get value form
        var brandname = $("#brandname").val();
        var isActive = $("#isActive").val();
        var status = $("#status").val();
        // validation
        if (brandname == "") {
            $("#brandname").after('<p class="text-danger">Brand Name field is required</p>');
            $('#brandname').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#brandname").find('.text-danger').remove();
            // success out for form 
            $("#brandname").closest('.form-group').addClass('has-success');
        }
        if (isActive == "") {
            $("#isActive").after('<p class="text-danger">Brand Active field is required</p>');

            $('#isActive').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#isActive").find('.text-danger').remove();
            // success out for form 
            $("#isActive").closest('.form-group').addClass('has-success');
        }

        if (status == "") {
            $("#status").after('<p class="text-danger">Brand Status field is required</p>');

            $('#status').closest('.form-group').addClass('has-error');
        } else {
            // remov error text field
            $("#status").find('.text-danger').remove();
            // success out for form 
            $("#status").closest('.form-group').addClass('has-success');
        }
        //create ajax request
        if (brandname && isActive && status) {
            var form = $(this);
            //create Button Loading
            $("#createBrandBtn").button('loading');
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    $("#createBrandBtn").button('reset');
                    if (response.success == true) {
                        // reload the manage member table 
                        ManageBrandTable.ajax.reload();
                        // reset the form text
                        $("#submitBrandForm")[0].reset();
                        // remove the error text
                        $(".text-danger").remove();
                        // remove the form error
                        $('.form-group').removeClass('has-error').removeClass('has-success');
                        //add flash massage
                        $('#add-brand-messages').html('<div class="alert alert-success">' +
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

// Edit Brand
function editBrands(BrandId = null) {
    
    if (BrandId) {
        // remove hidden brand id text
        $('#brand_id').remove();
        
        // remove the error
        $('.text-danger').remove();
        // remove the form-error
        $('.form-group').removeClass('has-error').removeClass('has-success');
        // model loading
        $('.modal-loading').removeClass('div-hide');
        // model result
        $('.edit-brand-result').addClass('div-hide');
        // model footer
        $('.editBrandFooter').addClass('div-hide');
        $.ajax({
            url: 'api/fetchSelectedBrand.php',
            type: 'get',
            data: { id: BrandId },
            dataType: 'JSON',
            success: function (response) {
                // model loading
                $('.modal-loading').addClass('div-hide');
                // model result
                $('.edit-brand-result').removeClass('div-hide');
                // model footer
                $('.editBrandFooter').removeClass('div-hide');
                // setting the Brand name value
                $('#ebrandname').val(response.brand_name);
                // setting the Brand isActive value
                $('#eisActive').val(response.brand_active);
                // setting the Brand status value
                $('#estatus').val(response.brand_status);
                $(".editBrandFooter").after('<input type="hidden" name="brand_id" id="brand_id" value="' + response.brand_id + '" /> ');
                //  update brand form
                $('#editBrandForm').unbind('submit').bind('submit', function () {
                    // console.log("Check");
                    // remove the error text
                    $(".text-danger").remove();
                    // remove the form error
                    $('.form-group').removeClass('has-error').removeClass('has-success');
                    // get form
                    var form = $(this);
                    // console.log(form.serialize());
                    // submit btn
                    $('#editBrandBtn').button('loading');
                    // console.log("submiting..");
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            // reload the manage member table 
                            ManageBrandTable.ajax.reload();
                            $("#editBrandBtn").button('reset');
                            if (response.success == true) {
                                // remove the error text
                                $(".text-danger").remove();
                                // remove the form error
                                $('.form-group').removeClass('has-error').removeClass('has-success');
                                //add flash massage
                                $('#edit-brand-messages').html('<div class="alert alert-success">' +
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
// delete Brand
function removeBrands(BrandId = null) {
    if (BrandId) {
        $('.removeBrandId').remove();
        $.ajax({
            url: 'api/fetchSelectedBrand.php',
            type: 'post',
            data: { id: BrandId },
            dataType: 'json',
            success: function (response) {
                $('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="' + response.brand_id + '"/>')
                // click on remove button to remove the brand
                $("#removeBrandBtn").unbind('click').bind('click', function () {
                    // buttion loading
                    $("#removeBrandBtn").button('loading');
                    $.ajax({
                        url: 'api/removeBrand.php',
                        type: 'post',
                        data: { id: BrandId },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == true) {
                                $('#deleteBandModal').modal('hide');
                                ManageBrandTable.ajax.reload();

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
        $('.removeBrandFooter').after();
    }
    else {
        alert('error!! Refresh The Page again');
    }
}