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
                        <h3 class="card-title">Packages List</h3>
                    </div>
                    <div class="card-body">
                        <table id="package-list" class="table table-sm table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Details</th>
                                    <th>Image</th>
                                    <th>Activation</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $activationBtn;
                                if ($packages) : foreach ($packages as $package) : 
                                if($package->is_active) {
                                    $activationBtn = '<button type="button" class="btn btn-sm btn-success" onclick="changePackageActvation('.$package->id.', '.$package->is_active.')">Activated</button>';
                                } else {
                                    $activationBtn = '<button type="button" class="btn btn-sm btn-danger" onclick="changePackageActvation('.$package->id.', '.$package->is_active.')" >De-activated</button>';
                                }

                                $publishedStatusTooltip;
                                $showPublishiedBtn = false;
                                $this->load->model('DaysModel');
                                $query = $this->db->where('package_id',$package->id)->get('package_days_visiting_details');
                                $havingVisitingDays = $query->num_rows();
                                if(($havingVisitingDays > 0) && !$package->published) {
                                    $publishedStatusTooltip = 'Package has visiting days but still not published';
                                    $showPublishiedBtn = true;
                                } else {
                                    $publishedStatusTooltip = 'Visiting days not added for this package';
                                }
                                ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $package->package_name; ?> </td>
                                            <td><?php echo $package->package_details; ?></td>
                                            <td><button type="button" onclick="showPackageDetails(<?php echo $package->id; ?>)" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button></td>
                                            <td style="width:50px;">
                                                <img class="img-fluid" src="<?php echo base_url() . 'uploads/' . getMedia($package->id, 'package'); ?>" alt="">
                                            </td>
                                            <td>
                                                <?php echo $activationBtn;?>
                                            </td>
                                            <td>
                                                <?php echo $package->published ? '<span class="badge bg-success" data-toggle="tooltip" data-placement="top" title="'.$publishedStatusTooltip.'">Published</span>' : '<span class="badge bg-danger" data-toggle="tooltip" data-placement="top" title="'.$publishedStatusTooltip.'">Not Published</span>';?>
                                            </td>
                                            <td><?php echo $package->created_at; ?></td>
                                            <td>
                                                <?php if($showPublishiedBtn):?>
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Publish Package" onclick="publishPackage(<?php echo $package->id;?>)" class="btn btn-sm btn-success"><i class="fa fa-upload"></i></button>
                                                <?php else: ?>
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Un Publish Package" <?php echo $havingVisitingDays > 0 ? '': 'disabled';?> onclick="unPublishPackage(<?php echo $package->id;?>)" class="btn btn-sm btn-secondary"><i class="fa fa-download"></i></button>
                                                <?php endif; ?>
                                                <a href="<?php echo base_url();?>admin/package/update/show/<?php echo $package->id;?>" data-toggle="tooltip" data-placement="top" title="Edit Package" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <button type="button" data-toggle="tooltip" data-placement="top" title="Remove Package" onclick="removePackage(<?php echo $package->id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
<div class="modal" tabindex="-1" role="dialog" id="show-package-details"></div>
<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>