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
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                        <table class="table table-sm table-hover table-bordered" id="car-category-table">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Category</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                if (!empty('categories')) :
                                    foreach ($categories as $category) :
                                ?>
                                <tr>
                                    <td><?php echo $i;?> </td>
                                    <td><?php echo $category->category;?></td>
                                    <td><?php echo $category->created_at;?></td>
                                    <td>
                                        <?php if($category->id != 1):?>
                                        <button type="button" onclick="openEditCategoryModal(<?php echo $category->id;?>, '<?php echo $category->category;?>')" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</button>
                                        <button type="button" onclick="removeCategory(<?php echo $category->id;?>)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</button>
                                        <?php endif; ?>
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
<div class="modal" tabindex="-1" role="dialog" id="show-category-add-modal"></div>
<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>