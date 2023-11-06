<?php
session_start();
require_once('./api/core.php');
include_once('./partials/header.php')
?>

<?php
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $con->query($sql);
$result = $query->fetch_assoc();

$con->close();
?>
<!-- Breadcump Start -->
<section>
    <div class="breadcump shadow">
        <h6 class="text-light mt-2"> <a href="dashboard.php" class="text-dark">Dashboard</a><span class="text-first text-light"> / Settings </span></h6>
    </div>
</section>
<!-- Breadcump End -->

<section>
    <div class="container">
        <div class="col-md-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between">
                    <div class=""><i class="fa fa-wrench" aria-hidden="true"></i> Settings</div>
                    <!-- <a href="#addProductModal" class="btn shadow brand_b" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Product</a> -->
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form action="api/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
                            <fieldset>
                                <legend>Change Username</legend>

                                <div class="changeUsenrameMessages"></div>

                                <div class="form-group">
                                    <label for="username" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value="<?php echo $result['username']; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" />
                                        <button type="submit" class="btn btn-success" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <form action="api/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
                            <fieldset>
                                <legend>Change Password</legend>

                                <div class="changePasswordMessages"></div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="npassword" class="col-sm-2 control-label">New password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" />
                                        <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>

                                    </div>
                                </div>


                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script src="./app/setting.js"></script>


<?php
include_once('./partials/footer.php')
?>