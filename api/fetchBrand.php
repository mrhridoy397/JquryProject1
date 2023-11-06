<?php
require_once("./core.php");
$sql = "SELECT `brand_id`, `brand_name`, `brand_active`, `brand_status` FROM `brands` WHERE `brand_status` = 1";
$result = $con->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
  $activeBrand = "";
  $BrandStatus = "";
  while ($row = $result->fetch_array()) {
    $brandId = $row[0];
    if ($row[2] == 1) {
      // activate member
      $activeBrands = "<label class='label label-success'>Available</label>";
    } else {
      // deactivate member
      $activeBrands = "<label class='label label-danger'>Not Available</label>";
    }
    if ($row[3] == 1) {
      // activate member
      $BrandStatus = "<label class='label label-success'>Active</label>";
    } else {
      // deactivate member
      $BrandStatus = "<label class='label label-danger'>Not Active</label>";
    }

    $button = '<div class="btn-group">
          <button class="btn btn-info" data-toggle="modal" type="button" data-target="#editBandModal" onclick="editBrands(' . $brandId . ')">  Edit</button>
          <button class="btn btn-danger" data-toggle="modal" type="button" data-target="#deleteBandModal" onclick="removeBrands(' . $brandId . ')"> Remove</button>       

      </div>';

    $output['data'][] = array(
      $brandId,
      $row[1],
      $activeBrands,
      $BrandStatus,
      $button
    );
  }
}

$con->close();
echo json_encode($output);
