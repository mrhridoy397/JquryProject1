<?php
session_start();
require_once('./api/core.php');
include_once('./partials/header.php')
?>
<!-- Breadcump Start -->
<section>
    <div class="breadcump shadow">
        <h6 class="text-light mt-2"> <a href="dashboard.php" class="text-dark">Dashboard</a><span class="text-first text-light"> / Product </span></h6>
    </div>
</section>
<!-- Breadcump End -->

<!-- <section> -->
<div class="container">
    <div class="row">

        <!-- <div class="container"> -->
        <div class="col-12">
            <div class="card mt-4">
            <div class="removeProductMessages"></div>
                <div class="card-header d-flex justify-content-between">
                    <div class=""><i class="fa fa-pencil-square-o fs-w" aria-hidden="true"></i> Manage Product Attribute
                    </div>
                    <a href="#addProductModal" class="btn shadow brand_b" data-toggle="modal" id='addProductModalBtn'><i class="fa fa-plus-circle"></i> Add Product</a>
                </div>
                <div class="card-body overflow-auto">
                    <table id="manageProductTable" class="table table-striped table-bordered overflow-auto">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>M.R.P</th>
                                <th>Flat Rate</th>
                                <th>Qty</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- </section> -->

<!-- Add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Add Product Attribute</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multiport/form-data" id='submitProductForm' action="api/createProduct.php">
                <div class="modal-body">
                    <div id='add-product-messages'></div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="product_image">Photo Attribute : Image </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">

                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <!-- the avatar markup -->
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input type="file" class="form-control" id="productImage" placeholder="Product Name" name="productImage" class="file-loading" style="width:auto;" />
                                    </div>

                                </div>
                            </div> <!-- /form-group-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="product_name">Product Name : </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Products name">
                                <small class="product_name_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="attribute">Product Attribute:</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="attribute" id="attribute" class="form-control" placeholder="Product Attribute">
                                <small class="product_attribute_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="quantity">Quantity :</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                                <small class="product_quantity_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="squantity">Sample Quantity :</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="squantity" id="squantity" class="form-control" placeholder="Sample Quantity">
                                <small class="product_sample_quantity_msg"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="rate">Flat Rate :</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="rate" id="rate" class="form-control" placeholder="Flat Rate">
                                <small class="rate"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="mrp">MRP :</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" name="mrp" id="mrp" class="form-control" placeholder="MRP">
                                <small class="Flat_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="brand_id">Brand : </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="">~~SELECT~~</option>
                                    <?php
                                    $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                    $result = $con->query($sql);

                                    while ($row = $result->fetch_array()) {
                                    ?>
                                        <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                                <small class="brand_name_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="categories_id">Category: </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select name="categories_id" id="categories_id" class="form-control">
                                    <option value="">~~SELECT~~</option>
                                    <?php
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                    $result = $con->query($sql);

                                    while ($row = $result->fetch_array()) {
                                    ?>
                                        <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>

                                <small class="categories_name_msg"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="status">Status : </label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                                <small class="status_msg"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id='createProductBtn'>Save Change</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- edit Products -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">
                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="div-result">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-success">Photo</a></li>
                        <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-info">Product Info</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="photo">
                            <form action="api/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
                                <br />
                                <div id="edit-productPhoto-messages"></div>
                                <!--  -->
                                <div class="form-group row">
                                    <label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <!-- the avatar markup -->
                                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                        <div class="kv-avatar center-block">
                                            <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;" />

                                        </div>

                                    </div>
                                    <input type="hidden" name="oldPath" id="oldImagePath">
                                </div> <!-- /form-group-->
                                <div class="modal-footer editProductPhotoFooter">
                                    <button type="button" class="btn btn-info" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                                    <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="productInfo">
                            <form class="form-horizontal" id="editProductForm" action="api/editProduct.php" method="POST">
                                <br />
                                <div id="edit-product-messages"></div>
                                <div class="form-group row">
                                    <label for="editProductName" class="col-sm-3 control-label">Product Name
                                    </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editattribute" class="col-sm-3 control-label">Product Attribute
                                    </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editattribute" placeholder="Product Attribute" name="editattribute" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->

                                <div class="form-group row">
                                    <label for="editmrp" class="col-sm-3 control-label">M.R.P </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editmrp" placeholder="M.R.P" name="editmrp" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editRate" class="col-sm-3 control-label">Flat Rate: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="editRate" placeholder="Flat Rate" name="editRate" autocomplete="off">
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="editBrandName" name="editBrandName">
                                            <option value="">~~SELECT~~</option>
                                            <?php
                                            $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                            $result = $con->query($sql);

                                            while ($row = $result->fetch_array()) {
                                                echo "<option value='" . $row[0] . "' >" . $row[1] . "</option>";
                                            } // while

                                            ?>
                                        </select>
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <select type="text" class="form-control" id="editCategoryName" name="editCategoryName">
                                            <option value="">~~SELECT~~</option>
                                            <?php
                                            $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                            $result = $con->query($sql);

                                            while ($row = $result->fetch_array()) {
                                                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                                            } // while

                                            ?>
                                        </select>
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="form-group row">
                                    <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="editProductStatus" name="editProductStatus">
                                            <option value="">~~SELECT~~</option>
                                            <option value="1">Available</option>
                                            <option value="2">Not Available</option>
                                        </select>
                                    </div>
                                </div> <!-- /form-group-->
                                <div class="modal-footer editProductFooter">
                                    <button type="button" class="btn btn-info" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>

                                    <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save
                                        Changes</button>
                                </div> <!-- /modal-footer -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure ? </p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-info" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> No</button>
                <button type="button" class="btn btn-danger" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i>Yes Remove</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->

<script src="./app/products.js"></script>

<?php
include_once('./partials/footer.php')
?>