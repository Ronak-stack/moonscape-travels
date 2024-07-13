<?php $this->load->view('layouts/dashboardLayouts/header'); ?>
<?php $this->load->view('layouts/dashboardLayouts/sidebar'); ?>

<section class="mt-5">
    <div class="container">
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
            <div class="card-header bg-primary">
                <h3 class="card-heading">Itinerarie</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table id="itineraries" class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Discription</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($itineraries)) :
                                    foreach ($itineraries as $itinerary) :
                                ?>
                                        <tr>
                                            <td><?php echo $itinerary->itinerary_name; ?></td>
                                            <td><?php echo $itinerary->itinerary_discription; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" onclick="editeItinerary(<?php echo $itinerary->id; ?>,'<?php echo $itinerary->itinerary_name; ?>','<?php echo $itinerary->itinerary_discription; ?>');"><i class="fa fa-edit"></i></button>
                                                <button type="button" onclick="deleteItinerary(<?php echo $itinerary->id; ?>)" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                <?php
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
    <div class="modal" tabindex="-1" id="editItinerary" role="dialog"></div>
</section>

<?php $this->load->view('layouts/dashboardLayouts/footer'); ?>