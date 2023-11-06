<?php
session_start();
require_once('./api/core.php');
include_once('./partials/header.php')
?>
<!-- Breadcump Start -->
<section>
    <div class="breadcump shadow">
        <h6 class="text-light mt-2"> <a href="dashboard.php" class="text-dark">Dashboard</a><span class="text-first text-light"> / Report </span></h6>
    </div>
</section>
<!-- Breadcump End -->

<section>
    <div class="container">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <div class=""><i class="fa fa-pencil-square-o fs-w" aria-hidden="true"></i>Order Report</div>
                    <!-- <a href="#addProductModal" class="btn shadow brand_b" data-toggle="modal"><i class="fa fa-plus-circle"></i> Add Product</a> -->
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" action="api/getOrderReport.php" method="post" id="getOrderReportForm">
                        <div class="form-group">
                            <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endDate" class="col-sm-2 control-label">End Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>




<script src="./app/report.js"></script>t>

<?php
include_once('./partials/footer.php')
?>