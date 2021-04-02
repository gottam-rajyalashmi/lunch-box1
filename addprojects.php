<div class="container-fluid">
  <h4><? echo "Add Progress ";?></h4>
  <div class="container">
    <div class="float-right">
      <a href="<?=base_url()?>/Projects" class="btn btn-outline-dark btn-sm"><i class="fa fa-angle-left"></i> Back</a>
    </div> 
    <div class="row">
      <div class="col-md-9">
        <form action=<?php echo base_url('projects/projects_add');?> name="projects-add" id="projects-add" method="post" accept-charset="utf-8">
          <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Project Name");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="name" id="name" class="form-control input-sm" placeholder="<?php print _("Name");?>"/>          
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Start Date");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="start_at" id="start_at" class="form-control input-sm" placeholder="<?php print _("Start Date");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Target Date");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="end_at" id="end_at" class="form-control input-sm" placeholder="<?php print _("Target Date");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Priority");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="priority" id="priority" class="form-control input-sm" placeholder="<?php print _("Priority");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Responsible Person");?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="responsible" id="responsible" class="form-control input-sm" placeholder="<?php print _("Responsible person ");?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Assigned" );?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="assigned_to" id="assigned_to" class="form-control input-sm" placeholder="<?php print _("Assigned To ");?>"/>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-sm-3">
              <?php print _("Description" );?>&nbsp;:&nbsp;<span class="text-danger">*</span>
            </label>
            <div class="col-sm-8">
              <input type="text" name="description" id="description" class="form-control input-sm" placeholder="<?php print _("Description ");?>"/>
            </div>
          </div>
          <div class="form-group">
           <button type="submit" value="Add" name="addprojects" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 <script>
   if ($("#projects-add").length > 0) {
      $("#projects-add").validate({
       rules: {
         name: {
          required: true,
        },
     },
    messages: {
      name: {
        required: "Please enter  a projects name",
      },
    },
  })
}
</script>
