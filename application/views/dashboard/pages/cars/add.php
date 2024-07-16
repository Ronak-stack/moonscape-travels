<?php $this->load->view('layouts/dashboardLayouts/header'); ?>
<?php $this->load->view('layouts/dashboardLayouts/sidebar'); ?>

<section class="mt-5">
    <div class="container">
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <form action="<?php echo base_url(); ?>admin/cars/add" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Add Cars</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <label class="label">Select Category</label>
                            <div class="input-group">
                                <select name="car_category_id" required class="form-control form-control-sm">
                                    <option value="">Select Cateogry</option>
                                    <?php if (!empty($categories)) : foreach ($categories as $category) : ?>
                                            <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                                <div class="input-group-append">
                                    <span class="btn btn-sm btn-primary" id="add-category"><i class="fa fa-plus"></i> Add Category</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label class="label">Car Name</label>
                                <input type="text" class="form-control form-control-sm" name="car_name" placeholder="Enter car name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-gorup">
                                <label class="label">Add Image</label>
                                <input type='file' id="imageUpload" name="car_image" accept=".png, .jpg, .jpeg" onchange="previewCarFile()" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 w-100" style="max-height: 200px;">
                            <img id="carImagePreview" class="img-fluid" style="height: 100px;" src="https://www.loginradius.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png">
                        </div>
                    </div>
                </div>
                <div class="card-footer" id="card-body-set">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</section>
<div class="modal" tabindex="-1" role="dialog" id="show-category-add-modal"></div>
<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>