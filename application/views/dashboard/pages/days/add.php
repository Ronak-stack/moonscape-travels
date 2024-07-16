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
        <form action="<?php echo base_url(); ?>admin/days/add" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h3>Add Package Days</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label class="label">Select Package</label>
                                <select name="package_id" id="selected_package_id" class="form-control form-control-sm">
                                    <option value="">Select Package</option>
                                    <?php if ($packages) : foreach ($packages as $package) : ?>
                                            <option value="<?php echo $package->id; ?>"><?php echo $package->package_name; ?></option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2 pt-4 mt-1">
                            <button type="button" class="btn btn-sm btn-primary" onclick="searchPackage()"><i class="fa fa-search"></i> Search Package</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="package_details"></div>
                    </div>
                    <div id="days"></div>
                </div>
                <div class="card-footer" id="card-body-set" style="display:none;">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>