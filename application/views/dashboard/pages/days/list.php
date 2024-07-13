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
                        <h3 class="card-title">Days List With Packages</h3>
                        <a href="<?php echo base_url()?>/admin/days/add" class="float-right btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Add Days"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Day</th>
                                    <th>Package Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                if ($days) : foreach ($days as $day) : ?>
                                <?php $imgUrl = getMedia($day->id, 'day') ? base_url() . 'uploads/' . getMedia($day->id, 'day'): null; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $day->day_name; ?> </td>
                                            <td><?php echo $day->package_name; ?></td>
                                            <td><?php echo $day->day_description; ?></td>
                                            <td class="w-25">
                                                <img class="img-fluid w-25" src="<?php echo $imgUrl;?>" alt="">
                                            </td>
                                            <td><?php echo $day->created_at; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="openUpdateDayModal(<?php echo $day->id;?>,'<?php echo $imgUrl;?>')" data-toggle="tooltip" data-placement="top" title="Update Day"><i class="fa fa-edit"></i></button>
                                                <button type="button" onclick="removeSingleDay(<?php echo $day->id; ?>)" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Day From Package"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                <?php $i++;
                                    endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="show-day-details"></div>
<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>