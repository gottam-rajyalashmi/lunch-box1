<h2>CHanges cn be updated</h2>
<div class="container-fluid">
  <h4><? echo "Edit Projects ";?></h4>
  <div class="container">
    <div class="float-right">
      <a href="<?=base_url()?>/Projects" class="btn btn-outline-dark btn-sm"><i class="fa fa-angle-left"></i> Back</a>
    </div> 
    <div class="row">
      <div class="col-md-9">
        <form action=<?php echo base_url('projects/projects_update');?> name="projects-update" id="projects-update" method="post" accept-charset="utf-8">
           <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $projects['id'] ?>">
          <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Project Name");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="name" id="name" value="<?php echo $projects['name'] ?>" class="form-control input-sm" placeholder="<?php print _("Name");?>"/>          
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Start Date");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="start_at" id="start_at" value="<?php echo $projects['start_at'];?>" class="form-control input-sm" placeholder="<?php print _("Start Date");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Target Date");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="end_at" id="end_at" value="<?php echo $projects['end_at'];?>" class="form-control input-sm" placeholder="<?php print _("Target Date");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Priority");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
               <select name="priority" id="priority"  class="form-control input-sm" value="<?php echo $projects['priority'];?>">
              <option>All</option>
              <option value="0" <?php if($projects == "0") {print "selected=selected";}?>>0</option>
              <option value="10" <?php if($projects == "10") {print "selected=selected";}?>>10</option>
              <option value="20" <?php if($projects == "20") {print "selected=selected";}?>>20</option>
              <option value="30" <?php if($projects == "30") {print "selected=selected";}?>>30</option>
              <option value="40" <?php if($projects == "40") {print "selected=selected";}?>>40</option>
              <option value="50" <?php if($projects == "50") {print "selected=selected";}?>>50</option>
              <option value="60" <?php if($projects == "60") {print "selected=selected";}?>>60</option>
              <option value="70" <?php if($projects == "70") {print "selected=selected";}?>>70</option>
              <option value="80" <?php if($projects == "80") {print "selected=selected";}?>>80</option>
              <option value="90" <?php if($projects == "90") {print "selected=selected";}?>>90</option>
              <option value="100" <?php if($projects == "100") {print "selected=selected";}?>>100</option>
            </select>
            </div>
          </div> 
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Responsible Person");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
             <!--  <input type="text" name="responsible" id="responsible" value="<?php echo $projects['responsible'];?>" class="form-control input-sm" placeholder="<?php print _("Responsible person ");?>"/> -->
             <input type="checkbox" name="responsible[]" id="responsible" value="1" if(in_arrray('1',$responsible)){ echo 'checked';}><label>VenkatReddy</label> 
             <input type="checkbox" name="responsible[]" id="responsible" value="2"  if(in_arrray('1',$responsible)){ echo 'checked';}><label>Ramakrishna</label>
             <input type="checkbox" name="responsible[]" id="responsible" value="3"  if(in_arrray('1',$responsible)){ echo 'checked';}><label>Narayana</label>
             <input type="checkbox" name="responsible[]" id="responsible" value="4"  if(in_arrray('1',$responsible)){ echo 'checked';}><label>Ramana</label>
              </div>
            </div>
          <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Assigned" );?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
           <!--    <input type="text" name="assign_to" id="assign_to" value="<?php echo $projects['assign_to'];?>" class="form-control input-sm" placeholder="<?php print _("Assigned To ");?>"/> -->
             <input type="checkbox" name="assign_to[]" id="assign_to" value="1"  if(in_arrray('1',$assign_to)){ echo 'checked';}><label>Ramana</label>
             <input type="checkbox" name="assign_to[]" id="assign_to" value="2"  if(in_arrray('1',$assign_to)){ echo 'checked';}><label>Narayana</label>
             <input type="checkbox" name="assign_to[]" id="assign_to" value="3"  if(in_arrray('1',$assign_to)){ echo 'checked';}><label>Ramakrishna</label>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Description" );?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
             <!--  <input type="text" name="description" id="description" value="<?php //echo $projects['description'];?>" class="form-control input-sm" placeholder="<?php print _("Description ");?>"/> -->
             <textarea name="description" id="description"  class="form-control input-sm" placeholder="<?php print _("Description ");?>"><?= $projects['description'];?></textarea>
            </div>
            <?php echo isset(session('errors')['description'])? session('errors')['name']: "";?>
          </div>
          <div class="form-group">
           <button type="submit" value="Update" name="edit_projects" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 <script>
   if ($("#projects-update").length > 0) {
      $("#projects-update").validate({
       rules: {
         name: {
          required: true,
        },
        start_at: {
          required: true,
        },
        end_at: {
          required: true,
        },
        priority: {
          required: true,
        },
        responsible: {
          required: true,
        },
        assign_to: {
          required: true,
        },
        description: {
          required: true,
        },
     },
    messages: {
      name: {
        required: "Please enter  a projects name",
      },
      start_at: {
        required: "Please enter  a Start Date",
      },
      end_at: {
        required: "Please enter  a Target Date",
      },
      priority: {
        required: "Priority is requried",
      },
      responsible: {
        required: "Responsible is requried",
      },
      assign_to: {
        required: "Assigned is requried",
      },
      description: {
        required: "Description is requried",
      },
    },
  })
}
  $('#start_at').datepicker({format: 'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
    $(this).datepicker('hide');
  });

  $('#end_at').datepicker({format: 'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
    $(this).datepicker('hide');
  });
</script>
