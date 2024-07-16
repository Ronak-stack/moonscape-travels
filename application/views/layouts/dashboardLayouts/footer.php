<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dashboard/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dashboard/dist/js/pages/dashboard.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Toastr -->
 <script src="<?php echo base_url(); ?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
<script>
  $(document).ready(function() {

    $(function() {
      // Summernote
      $('.daysTextBox').summernote();
    });

    $(function() {
      $('[data-toggle="tooltip"]').tooltip()
    });

  });

  function previewFile() {
    var preview = document.querySelector('img[id=imagePreview]');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function() {
      preview.src = reader.result;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
  }

  function previewCarFile() {
    var carImagePreview = document.querySelector('img[id=carImagePreview]');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.addEventListener("load", function() {
      carImagePreview.src = reader.result;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
  }

  <?php if ($this->uri->segment(2) == 'itineraries') : ?>

    $("#itineraries").DataTable({
      topStart: 'pageLength',
      topEnd: 'search',
      bottomStart: 'info',
      bottomEnd: 'paging'
    });

    function editeItinerary(itineraryId, itineraryName, itineraryDescription) {
      let modal = '<div class="modal-dialog" role="document"><form action="<?php echo base_url(); ?>itineraries/update" method="post"><input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" /><div class="modal-content"><div class="modal-header bg-light"><h5 class="modal-title">Edit Itinerary</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><input type="hidden" name="itinerary_id" value="' + itineraryId + '"/><div class="form-group"><label for="itinerary_name">Itinerary Name</label><input type="text" name="itinerary_name" class="form-control form-control-sm" value="' + itineraryName + '" placeholder="Enter itineray name"/></div><div class="form-group"><label for="itinerary_description">Itinerary Description</label><textarea value="' + itineraryDescription + '" name="itinerary_discription" class="form-control form-control-sm" rows="5">' + itineraryDescription + '</textarea></div></div><div class="modal-footer bg-primary"><button type="submit" class="btn btn-light" onclick="saveItinerary();">Save changes</button><button type="button" class="btn btn-light" data-dismiss="modal">Close</button></div></div></form></div>';
      $('#editItinerary').html(modal).modal('show');
    }

    function deleteItinerary(id) {
      if (confirm('Do you want to remove this itinerary?')) {
        window.location.replace('<?php echo  base_url(); ?>admin/itineraries/delete/' + id);
      }
    }

    
    function removeItinerary(e) {
      if (!confirm('Do you want to remove this itinerary?')) {
        return false;
      }
      $(e).parent('td').parent('tr').remove();
    }
    
    <?php elseif ($this->uri->segment(2) == 'packages') : ?>
      $('#add_itineraries').click(function() {
        let row = '<tr><td class="border border-dark"><select name="package_itineraries[]" class="form-control form-control-sm" id="package_itineraries"><option value="">Select Itineraries</option><?php if (!empty($itineraries)) : foreach ($itineraries as $itinerary) : ?><option value="<?php echo $itinerary->id; ?>"><?php echo $itinerary->itinerary_name; ?></option><?php endforeach; endif; ?></select></td><td class="border border-dark"><button type="button" onclick="return removeItinerary(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></td></tr>';
        $('#itinerary_rows').append(row);
      });

      var table = $("#package-list").DataTable({
      topStart: 'pageLength',
      topEnd: 'search',
      bottomStart: 'info',
      bottomEnd: 'paging',
      autoWidth: true
      });

      table.columns.adjust().draw();

    function showPackageDetails(packageId) {
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataJson = {
        [csrfName]: csrfHash
      };
      
      $.ajax({
        url: '<?php echo base_url(); ?>admin/packages/details/' + packageId,
        method: 'POST',
        data: dataJson,
        beforeSend: function() {
          $('#overlay').show();
        },
        success: function(response) {
          let res = JSON.parse(response);
          if (res.success) {
            let model = '<div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Package Details</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><table class="table table-sm table-bordered"><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">About Tour</td></tr><tr><th colspan="2" class="border border-dark">Package Name</th><td colspan="2" class="border border-dark">' + res.data.details.package_name + '</td></tr><tr><th colspan="2" class="border border-dark">Description</th><td colspan="2" class="border border-dark">' + res.data.details.discription + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Reciving & Departure</td></tr><tr><th colspan="2" class="border border-dark">Location</th><td colspan="2" class="border border-dark">' + res.data.details.location + '</td></tr><tr><th class="border border-dark">Reciving Location</th><td class="border border-dark">' + res.data.details.receiving_location + '</td><th class="border border-dark">Reciving Time</th><td class="border border-dark">' + res.data.details.receiving_timing + '</td></tr><th class="border border-dark">Departure Location</th><td class="border border-dark">' + res.data.details.departure_location + '</td><th class="border border-dark">Departure Time</th><td class="border border-dark">' + res.data.details.departure_time + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Tour Duration Days</td></tr><tr><th class="border border-dark">Days</th><td class="border border-dark">' + res.data.details.package_days + '</td><th class="border border-dark">Nigths</th><td class="border border-dark">' + res.data.details.package_nights + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Privilege</td></tr><tr><th class="border border-dark">Package Person Allowed</th><td class="border border-dark">' + res.data.details.package_person_count + '</td><th class="border border-dark">Age Bar</th><td class="border border-dark">' + res.data.details.package_age_bar + '</td></th></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Package Approval Documents</td></tr><tr><th colspan="2" class="border border-dark">Documents</th><td colspan="2" class="border border-dark">' + res.data.details.package_required_docs + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Itineraries</td></tr>';
            res.data.itineraries.forEach(element => {
              model += '<tr><th colspan="2" class="border border-dark">Itinerary Name</th><td colspan="2" class="border border-dark">' + element.itinerary_name + '</td></tr>';
            });
            model += '</table></div><div class="modal-footer"><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button></div></div></div>';

            $('#show-package-details').html(model).modal('show');
          } else {
            toastr.error(res.message);
          }
          $('#overlay').hide();
        }
      });
    }

    function removePackage(id) {
      if (confirm('Do you want to remove this package?')) {
        window.location.replace('<?php echo  base_url(); ?>admin/packages/delete/' + id);
      }
    }

    function changePackageActvation(id, status) {
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataJson = {
        [csrfName]: csrfHash,
        id: id,
        status: !status
      };
      $('#overlay').show();
      $.ajax({
        url: '<?php echo  base_url();?>admin/package/update/status',
        method: 'POST',
        data: dataJson,
        success: function(response) {
          var res = JSON.parse(response);
          if(res.success) {
            toastr.success(res.message);
          } else {
            toastr.error(res.message);
          }
          location.reload();
        }
      });
    }

  function publishPackage(id) {
    if(confirm('Do you want to confirm published this package for user?')) {
      window.location.replace('<?php echo base_url();?>admin/packages/published/'+id);
    }
  }

  function unPublishPackage(id) {
    if(confirm('Do you want to un-published this package?')) {
      window.location.replace('<?php echo base_url();?>admin/packages/un/published/'+id);
    }
  }

  <?php elseif ($this->uri->segment(2) == 'days') : ?>

    function searchPackage() {
      var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
        csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
      var dataJson = {
        [csrfName]: csrfHash
      };
      var packageId = $('#selected_package_id').find(":selected").val();
      if (packageId != '') {
        $('#overlay').show();
        $.ajax({
          url: '<?php echo base_url(); ?>admin/packages/details/' + packageId,
          method: 'POST',
          data: dataJson,
          success: function(response) {
            let res = JSON.parse(response);
            if (res.success) {
              var html = '<div class="card"><div class="card-body"><table class="table table-sm table-bordered"><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">About Tour</td></tr><tr><th colspan="2" class="border border-dark">Package Name</th><td colspan="2" class="border border-dark">' + res.data.details.package_name + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Reciving & Departure</td></tr><tr><th class="border border-dark">Reciving Location</th><td class="border border-dark">' + res.data.details.receiving_location + '</td><th class="border border-dark">Reciving Time</th><td class="border border-dark">' + res.data.details.receiving_timing + '</td></tr><tr><th class="border border-dark">Departure Location</th><td class="border border-dark">' + res.data.details.departure_location + '</td><th class="border border-dark">Departure Time</th><td class="border border-dark">' + res.data.details.departure_time + '</td></tr><tr><td colspan="4" class="bg-primary text-light text-center border border-dark">Tour Duration Days</td></tr><tr><th class="border border-dark">Days</th><td class="border border-dark">' + res.data.details.package_days + '</td><th class="border border-dark">Nigths</th><td class="border border-dark">' + res.data.details.package_nights + '</td></tr></table></div></div>';
              $('#package_details').html(html);

              let days = parseInt(res.data.details.package_days);

              for (let i = 0; i < days; i++) {
                textBox = '<div class="row mt-2 mb-1"><div class="col-12 shadow-lg rounded-lg text-light "><div class="form-group"><label class="label text-dark">Day ' + (i + 1) + '</label><input type="file" name="day_image_' + (i + 1) + '" class="form-control form-control-sm"></div><div class="form-group"><label class="label text-dark">Description</label><textarea rows="5" name="day_description_' + (i + 1) + '" class="form-control form-control-sm"></textarea></div></div></div>';
                $('#days').append(textBox);
              }
              $('#card-body-set').show();
            } else {
              toastr.error('error', res.message);
            }
            $('#overlay').hide();
          }
        });
      }
    }

    function openUpdateDayModal(dayId, imgUrl) {
      if (dayId) {
        var formUrl = '<?php echo  base_url();?>admin/days/add';
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
          csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var dataJson = {
          [csrfName]: csrfHash
        };
        $('#overlay').show();
        $.ajax({
          url: '<?php echo base_url();?>admin/days/find/'+dayId,
          method: 'POST',
          data: dataJson,
          success: function(response) {
            let res = JSON.parse(response);
            if(res.success) {
              let dayName = res.data.single_day_data[0].day_name.split(" ");
              let modal = '<div class="modal-dialog" role="document"><div class="modal-content"><form action="'+formUrl+'" method="post" enctype="multipart/form-data"><input type="hidden" name="'+csrfName+'" value="'+csrfHash+'"/><div class="modal-header"><h5 class="modal-title">'+res.data.single_day_data[0].day_name+'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-12"><div class="row"><div class="col-12"><div class="w-100"><img src="'+imgUrl+'" class="img-fluid" /></div></div></div><input type="hidden" value="'+res.data.single_day_data[0].package_id+'" name="package_id"/><div class="form-group"><label class="label">Image</label><input type="file" class="form-control form-control-sm" name="day_image_'+dayName[1]+'"/></div><div class="form-group"><label class="label">Description</label><textarea name="day_description_'+dayName[1]+'" id="day-discription" class="form-control form-control-sm">'+res.data.single_day_data[0].day_description+'</textarea></div></div></div></div><div class="modal-footer"><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Save</button><button type="button" class="btn btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Close</button></div></form></div></div>';
              $('#show-day-details').html(modal).modal('show');
            } else {
              toastr.error(res.message);
            }
            $('#overlay').hide();
          }
        })
      }
    }

    function removeSingleDay(id) {
      if(confirm('Do you want to remove this day from your selected package?')) {
        window.location.replace('<?php echo base_url();?>admin/days/delete/'+id);
      }
    }

  <?php elseif($this->uri->segment(2) == 'cars'):?>
    $('#add-category').click(function() {
      let modal = '<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h3 class="modal-title">Add New Category</h3></div><div class="modal-body"><div class="row"><div class="col-12"><div class="form-group"><label>Category Name</label><input type="text" name="category_name" class="form-control form-control-sm" placeholder="Enter category name."></div></div></div><span class="text-danger" id="error-cate"></span></div><div class="modal-footer"><button class="btn btn-sm btn-primary" type="button" onclick="saveCategory()"><i class="fa fa-plus"></i> Save Category</button></div></div></div>';
      $('#show-category-add-modal').html(modal).modal('show');
    });

    function saveCategory(id = null) {
      categoryName = $('input[name="category_name"]').val();
      if(categoryName != '') {
        $("#error-cate").text('');
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
          csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var dataJson = {
          [csrfName]: csrfHash,
          category_name: categoryName
        };
        if(id != null) {
          dataJson['cate_id'] = id;
        }
        $('#overlay').show();
        $.ajax({
          url: '<?php echo base_url();?>admin/car/categories/add',
          method: 'POST',
          data: dataJson,
          success: function(response) {
            let res = JSON.parse(response);
            if(res.success) {
              if(res.data.type == 'add') {
                $('select[name="car_category_id"]').append($("<option></option>")
                      .attr("value", res.data.category.id)
                      .text(res.data.category.category)); 
              }
              $('#show-category-add-modal').modal('hide');
              toastr.success('success', res.message);
            } else {
              toastr.success('error', res.message);
            }
            $('#overlay').hide();
            if(id!=null) {
              location.reload();
            }
          }
        });
      } else {
        $("#error-cate").text('Please enter category name!');
        return false;
      }
    }

    $('#cars-list').DataTable({
      topStart: 'pageLength',
      topEnd: 'search',
      bottomStart: 'info',
      bottomEnd: 'paging',
      autoWidth: true
      });

      function openUpdateCarModal(id,carName,category_id, imgUrl) {
        var formUrl = '<?php echo  base_url();?>admin/cars/add';
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
          csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
        var dataJson = {
          [csrfName]: csrfHash,
          ajaxCall: true
        };
        $('#overlay').show();
        $.ajax({
          url: '<?php echo base_url();?>admin/cars/categories/list',
          method: 'POST',
          data: dataJson,
          success: function(response) {
            let res = JSON.parse(response);
            let modal = '<div class="modal-dialog" role="document"><div class="modal-content"><form action="'+formUrl+'" method="post" enctype="multipart/form-data"><input type="hidden" name="'+csrfName+'" value="'+csrfHash+'"/><input type="hidden" value="'+carName+'" name="car_name"/><input type="hidden" value="'+category_id+'" name="car_category_id"/><div class="modal-header"><h3 class="modal-title">Update Car</h3></div><div class="modal-body"><div class="row"><div class="col-12"><div class="form-group"><label>Car Name</label><input type="text" name="car_new_name" class="form-control form-control-sm" placeholder="Enter car name." value="'+carName+'"></div><div class="form-group"><label class="label">Car Category</label><select name="new_car_category_id" class="form-control form-control-sm"><option value="">Select Category</option>';
            
            if(res.success) {
              let categories = res.data.categories;
              categories.forEach(element => {
                if(element.id == category_id) {
                  modal += '<option value="'+element.id+'" selected>'+element.category+'</option>';
                } else {
                  modal += '<option value="'+element.id+'">'+element.category+'</option>';
                }
              });
            }
            modal += '</select></div><div class="form-gorup"><label class="label">Update Image</label><input type="file" id="imageUpload" class="form-control form-control-sm" name="car_image" accept=".png, .jpg, .jpeg" onchange="previewCarFile()" /></div><div class="w-100" style="max-height: 200px;"><img id="carImagePreview" class="img-fluid" style="height: 100px;" src="https://www.loginradius.com/wp-content/plugins/all-in-one-seo-pack/images/default-user-image.png"></div></div></div><span class="text-danger" id="error-cate"></span></div><div class="modal-footer"><button class="btn btn-sm btn-primary" type="submit" onclick="saveCategory()"><i class="fa fa-plus"></i> Save Category</button></div></form></div></div>';
            $('#overlay').hide();
            $('#show-car-details').html(modal).modal('show');
          }
        });
      }

      function openEditCategoryModal(id, category) {
        let modal = '<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h3 class="modal-title">Update Category</h3></div><div class="modal-body"><div class="row"><input type="hidden" name="cate_id" value="'+id+'"/><div class="col-12"><div class="form-group"><label>Category Name</label><input type="text" name="category_name" class="form-control form-control-sm" placeholder="Enter category name." value="'+category+'"></div></div></div><span class="text-danger" id="error-cate"></span></div><div class="modal-footer"><button class="btn btn-sm btn-primary" type="button" onclick="saveCategory('+id+')"><i class="fa fa-plus"></i> Save Category</button></div></div></div>'; 
        $('#show-category-add-modal').html(modal).modal('show');
       
      }
      $('table[id="car-category-table"]').DataTable();

      function removeCategory(id) {
        if(confirm('Do you want to remove this category?')) {
          window.location.replace('<?php echo base_url();?>admin/cars/categories/delete/'+id);
        }
      }

      function removeCar(id) {
        if(confirm('Do you want to remove this car?')) {
          window.location.replace('<?php echo base_url();?>admin/cars/delete/'+id);
        }
      }
  <?php endif; ?>
</script>
</body>

</html>