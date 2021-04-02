
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title" id="myModalLabel">Add Role</h4>
    </div>
    <form name="role_add" id="role_add" method="post" action="<?php print WEB_ROOT; ?>roles/role_insert">
      <div class="modal-body">
        <div class="monvi-card mb-3">
          <div class="card-header border-top-radius">
            Choose Rights for Roles
          </div>
          <div class="card-body card-shadow">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                  <label class="control-label">Role&nbsp;:</label><span class="text-danger">*</span>
                  <input type="text" name="role_name" class="form-control input-sm" placeholder="<?php print _("Role Name");?>"/>
                </div>
              </div>
            </div>
            <div>
              <?php
              if(isset($modules[1]) && !empty($modules[1])){
                ?>
                <div class="monvi-sub-card mb-3">
                  <div class="card-header border-top-radius">
                    Employee Modules
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <?
                      foreach ($modules[1] as $key => $value) {
                        ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="checkbox-label">
                            <input type="checkbox" name="user_rights[]" value="<?php print $value['id']; ?>">
                            <span class="checkbox-custom"></span>
                            <p class="checkbox-title"><?php print $value['name'];?></p>
                          </label>
                        </div>
                        <?
                      }
                      ?>
                    </div>                 
                  </div>
                </div>
              <?
              }
              ?>
              <?php
              if(isset($modules[2]) && !empty($modules[2])){
                ?>
                <div class="monvi-sub-card mb-3">
                  <div class="card-header border-top-radius">
                    Report Modules
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <?
                      foreach ($modules[2] as $key2 => $value2) {
                        ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="checkbox-label">
                            <input type="checkbox" name="user_rights[]" value="<?php print $value2['id']; ?>">
                            <span class="checkbox-custom"></span>
                            <p class="checkbox-title"><?php print $value2['name'];?></p>
                          </label>
                        </div>
                        <?
                      }
                      ?>
                    </div>                   
                  </div>
                </div>
              <?
              }
              ?>
              <?php
              if(isset($modules[3]) && !empty($modules[3])){
                ?>
                <div class="monvi-sub-card mb-3">
                  <div class="card-header border-top-radius">
                    Admin Modules
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <?
                      foreach ($modules[3] as $key3 => $value3) {
                        ?>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <label class="checkbox-label">
                            <input type="checkbox" name="user_rights[]" value="<?php print $value3['id']; ?>">
                            <span class="checkbox-custom"></span>

Anuradha@highgo, [09.09.20 12:06]
<p class="checkbox-title"><?php print $value3['name'];?></p>
                          </label>
                        </div>
                        <?
                      }
                      ?>
                    </div>                  
                  </div>
                </div>
              <?
              }
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-outline-danger" data-dismiss="modal">
          <i class="fa fa-remove" aria-hidden="true"></i>&nbsp;<?php print _("Close");?>
        </button>
        <button type="submit" class="btn btn btn-sm btn-outline-success" name="submit" >
          <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<?php print _("Add Role");?>
        </button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
  $('#role_add').bootstrapValidator({
    message: 'field is not valid',
      feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      offalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      role_name: {
        message: 'The Role name is required.',
        validators: {
          notEmpty: {
            message: 'The Role name is required.'
          }
        }
      }
    }
  })
  .on('success.form.bv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    var bv = $form.data('bootstrapValidator');
    // Use Ajax to submit form data
    $.post($form.attr('action'), $form.serialize(), function(data) {
      $(".modal-dialog").parent().html(data);
      role_body();
    });
  });
});
</script>
<style type="text/css">
  .sub-title {
    border-bottom: 1px solid #e5edf4;
    display: inline-block;
    font-weight: 600;
    margin: 10px 0px;
  }
</style>