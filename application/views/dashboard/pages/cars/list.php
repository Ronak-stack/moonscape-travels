<?php $this->load->view('layouts/dashboardLayouts/header'); ?>
<?php $this->load->view('layouts/dashboardLayouts/sidebar'); ?>


<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif ($this->session->flashdata('error')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cars List</h3>
                        <a href="<?php echo base_url() ?>/admin/cars/add" class="float-right btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add Cars"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered" id="cars-list">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Car</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($cars)) :
                                    $i = 1;
                                    foreach ($cars as $car) :
                                        $imgUrl = getMedia($car->id, 'car') ? base_url() . 'uploads/' . getMedia($car->id, 'car'): null;
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $car->car_name; ?> </td>
                                            <td><?php echo $car->category; ?></td>
                                            <td style="width:150px;">
                                                <img class="img-fluid" src="<?php echo $imgUrl; ?>" alt="">
                                            </td>
                                            <td><?php echo $car->created_at; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="openUpdateCarModal(<?php echo $car->id; ?>,'<?php echo $car->car_name; ?>',<?php echo $car->car_category_id; ?>,'<?php echo $imgUrl; ?>')" data-toggle="tooltip" data-placement="top" title="Update Day"><i class="fa fa-edit"></i></button>
                                                <button type="button" onclick="removeCar(<?php echo $car->id; ?>)" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Day From Package"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="show-car-details"></div>
<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>