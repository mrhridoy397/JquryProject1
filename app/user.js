var manageUserTable;

$(document).ready(function () {
    // top nav bar 
    $('#topNavUser').addClass('active');
    // manage user data table
    manageUserTable = $('#manageUserTable').DataTable({
        'ajax': 'api/fetchUser.php',
        'order': []
    });

    // add user modal btn clicked
    $("#addUserModalBtn").unbind('click').bind('click', function () {
        // // product form reset
        $("#submitUserForm")[0].reset();

        // remove text-error 
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        // submit product form
        $("#submitUserForm").unbind('submit').bind('submit', function () {
            // form validation
            var userName = $("#userName").val();
            var upassword = $("#upassword").val();

            if (userName == "") {
                $("#userName").after('<p class="text-danger">User name field is required</p>');
                $('#userName').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#userName").find('.text-danger').remove();
                // success out for form 
                $("#userName").closest('.form-group').addClass('has-success');
            }	// /else



            if (upassword == "") {
                $("#upassword").after('<p class="text-danger">Password field is required</p>');
                $('#upassword').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#upassword").find('.text-danger').remove();
                // success out for form 
                $("#upassword").closest('.form-group').addClass('has-success');
            }	// /else


            // /else

            if (upassword && userName) {
                // submit loading button
                $("#createUserBtn").button('loading');

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
                            $("#createUserBtn").button('reset');

                            $("#submitUserForm")[0].reset();

                            $("html, body, div.modal, div.modal-content, div.modal-body").animate({ scrollTop: '0' }, 100);

                            // shows a successful message after operation
                            $('#add-user-messages').html('<div class="alert alert-success">' +
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
                            manageUserTable.ajax.reload(null, true);

                            // remove text-error 
                            $(".text-danger").remove();
                            // remove from-group error
                            $(".form-group").removeClass('has-error').removeClass('has-success');

                        } // /if response.success

                    } // /success function
                }); // /ajax function
            }	 // /if validation is ok 					

            return false;
        }); // /submit product form

    }); // /add user modal btn clicked



}); // document.ready fucntion


// edit user
function editUser(userid = null) {

    if (userid) {
        $("#userid").remove();
        // remove text-error 
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        // modal spinner
        $('.div-loading').removeClass('div-hide');
        // modal div
        $('.div-result').addClass('div-hide');

        $.ajax({
            url: 'api/fetchSelectedUser.php',
            type: 'post',
            data: { "userid": userid },
            dataType: 'json',
            success: function (response) {
                // alert(response.product_image);
                // modal spinner
                $('.div-loading').addClass('div-hide');
                // modal div
                $('.div-result').removeClass('div-hide');



                // user id 
                $(".editUserFooter").append('<input type="hidden" name="userid" id="userid" value="' + response.user_id + '" />');
                $(".editUserPhotoFooter").append('<input type="hidden" name="userid" id="userid" value="' + response.user_id + '" />');

                // user name
                $("#edituserName").val(response.username);
                // quantity
                //$("#editPassword").val(response.quantity);

                // update the user data function
                $("#editUserForm").unbind('submit').bind('submit', function () {

                    // form validation
                    var username = $("#edituserName").val();
                    var userpassword = $("#editPassword").val();


                    if (username == "") {
                        $("#edituserName").after('<p class="text-danger">User Name field is required</p>');
                        $('#edituserName').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#edituserName").find('.text-danger').remove();
                        // success out for form 
                        $("#edituserName").closest('.form-group').addClass('has-success');
                    }	// /else

                    if (userpassword == "") {
                        $("#editPassword").after('<p class="text-danger">Password field is required</p>');
                        $('#editPassword').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editPassword").find('.text-danger').remove();
                        // success out for form 
                        $("#editPassword").closest('.form-group').addClass('has-success');
                    }	// /else			

                    if (userpassword && username) {
                        // submit loading button
                        $("#editUserBtn").button('loading');

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
                                    // submit loading button
                                    $("#editUserBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({ scrollTop: '0' }, 100);

                                    // shows a successful message after operation
                                    $('#edit-user-messages').html('<div class="alert alert-success">' +
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
                                    manageUserTable.ajax.reload(null, true);

                                    // remove text-error 
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');

                                } // /if response.success

                            } // /success function
                        }); // /ajax function
                    }	 // /if validation is ok 					

                    return false;
                }); // update the product data function


            } // /success function
        }); // /ajax to fetch user


    } else {
        alert('error please refresh the page');
    }
}

// remove user 
function removeUser(userid = null) {
    if (userid) {
        // remove product button clicked
        $("#removeProductBtn").unbind('click').bind('click', function () {
            // loading remove button
            $("#removeProductBtn").button('loading');
            $.ajax({
                url: 'api/removeUser.php',
                type: 'post',
                data: { userid: userid },
                dataType: 'json',
                success: function (response) {
                    // loading remove button
                    $("#removeProductBtn").button('reset');
                    if (response.success == true) {
                        // remove product modal
                        $("#removeUserModal").modal('hide');

                        // update the product table
                        manageUserTable.ajax.reload(null, false);

                        // remove success messages
                        $(".remove-messages").html('<div class="alert alert-success">' +
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
                        $(".removeUserMessages").html('<div class="alert alert-success">' +
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
                } // /success function
            }); // /ajax fucntion to remove the product
            return false;
        }); // /remove product btn clicked
    } // /if userid
} // /remove product function

