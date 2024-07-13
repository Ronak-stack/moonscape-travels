<?php $this->load->view('layouts/dashboardLayouts/header'); ?>
<?php $this->load->view('layouts/dashboardLayouts/sidebar'); ?>

<section>
    <div class="container">
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?php echo $this->session->flashdata('success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <form action="<?php echo  base_url(); ?>admin/itineraries/add" method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <div class="card mt-5">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        Add New Itinerary
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="itinerary_name" class="lead">Itinerary Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Enter itinerary name" name="itinerary_name" />
                            </div>
                            <div class="form-group">
                                <label for="itinerary_details" class="lead">Itinerary Description</label>
                                <textarea name="itinerary_details" rows="8" placeholder="Enter itinerary decription" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-sm btn-success">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Add Itinerary</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>