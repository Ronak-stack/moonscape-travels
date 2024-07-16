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
        <form action="<?php echo base_url(); ?>admin/package/update/<?php echo $package_id;?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
            <?php
                $itinerariesValue = [];
                $itinerariesText = [];
                foreach($itineraries as $itinerary) {
                    $itinerariesValue[] = $itinerary->itinery_id;
                    $itinerariesText[] = $itinerary->itinerary_name;
                }
            ?>
            <input type="hidden" name="package_itineraries[]" value="<?php print_r($itinerariesValue);?>" />
            <div class="card mt-5">
                <div class="card-header bg-primary">
                    <h3 class="card-title">
                        Update Package
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label for="package_name" class="lead">Package Name</label>
                                <input type="text" value="<?php echo $details->package_name;?>" class="form-control form-control-sm" placeholder="Enter package name" name="package_name" />
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input type='file' id="imageUpload" name="package_image" accept=".png, .jpg, .jpeg" onchange="previewFile()" />
                                    <label for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <img id="imagePreview" src="<?php echo base_url();?>uploads/<?php echo getMedia($package_id,'package');?>">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="package_details" class="lead">Package Description</label>
                                <textarea name="package_details" rows="8" placeholder="Enter package decription" class="form-control form-control-sm"><?php echo $details->discription;?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title">Location</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="package_location_id" class="lead">Select Visiting Location</label>
                                <select class="form-control form-control-sm" name="package_location_id" id="package_location_id" require>
                                    <option value="">Select Location</option>
                                    <?php foreach ($locations as $location) : ?>
                                        <option value="<?php echo  $location->id; ?>" <?php echo $location->id == $details->location_id ? 'selected' : '';?>><?php echo $location->location; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="receiving_location" class="lead">Receving Location</label>
                                <input type="text" value="<?php echo $details->receiving_location;?>" class="form-control form-control-sm" name="receiving_location" placeholder="Enter receiving location">
                            </div>
                            <div class="form-group">
                                <label for="departure_location" class="lead">Departure Location</label>
                                <input type="text" value="<?php echo $details->departure_location;?>" class="form-control form-control-sm" name="departure_location" placeholder="Enter departure location">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="receiving_time" class="lead">Receiving Time</label>
                                <input type="time" value="<?php echo $details->receiving_timing;?>" class="form-control form-control-sm" name="receiving_time" />
                            </div>
                            <div class="form-group">
                                <label for="departure_time" class="lead">Departure Time</label>
                                <input type="time" value="<?php echo $details->departure_time;?>" class="form-control form-control-sm" name="departure_time">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-heading">Package Details</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="package_days" class="lead">Package Tour Days</label>
                                <input type="number" value="<?php echo $details->package_days;?>" class="form-control form-control-sm" placeholder="Select package tour days" name="package_days">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="package_nights" class="lead">Package Tour Nights</label>
                                <input type="number" value="<?php echo $details->package_nights;?>" class="form-control form-control-sm" placeholder="Select package tour nights" name="package_nights">
                            </div>
                        </div>
                    </div>
                    <label for="package_itineraries" class="lead">Select Itineraries</label>
                    (<?php echo implode(',', $itinerariesText);?>)
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>Itineraries</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="itinerary_rows">
                            <tr>
                                <td>
                                    <select name="package_itineraries[]" class="form-control form-control-sm" id="package_itineraries">
                                        <option value="">Select Itineraries</option>
                                        <?php if (!empty($all_itineries)) : foreach ($all_itineries as $itinerary) : ?>
                                                <option value="<?php echo $itinerary->id; ?>"><?php echo $itinerary->itinerary_name; ?></option>
                                        <?php endforeach;
                                        endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="button" id="add_itineraries" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-heading">Privilege</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="package_person_count" class="lead">Packge For Person Count</label>
                                <input type="text" class="form-control form-control-sm" name="package_person_count" value="<?php echo $details->package_person_count;?>" placeholder="Enter person limit for this package">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="package_age_bar" class="lead">Packge For Person Age Bar</label>
                                <input type="text" value="<?php echo $details->package_age_bar;?>" class="form-control form-control-sm" name="package_age_bar" placeholder="Enter person age bar for this package">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="package_required_docs">Required Documents</label>
                            <input type="text" value="<?php echo $details->package_required_docs;?>" name="package_required_docs[]" placeholder="Enter required doc type for this package" class="form-control form-control-sm" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-heading">Price</div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="package_price" class="lead">Package Price</label>
                        <input type="number" placeholder="Enter package price for current package" class="form-control form-control-sm" value="<?php echo $details->package_price;?>" name="package_price">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-sm btn-success">Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>