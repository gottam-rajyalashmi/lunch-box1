<?php
  //print_r(SITE_URL());
  $pageno = $params['pageno'];
  $rows = $params['rows'];
  $sort_order = $params['sort_order'];
  $sortby = $params['sortby'];
  $sort_order_alt = $params['sort_order']=='asc'? 'desc':'asc';
  $code_id = $projects['code_id']??'';
  $name = $projects['name']??'';
  $start_at = $projects['start_at']??'';
  $end_at = $projects['end_at']??'';
  $priority_id = $projects['priority_id']??'';
  $created_at = $projects['created_at']??'';
  $updated_at = $projects['updated_at']??'';
  $updated_by = $projects['updated_by']??'';
  $status = $projects['status']??'';
  $keywords = $params['keywords']??'';
  $pages = ceil($totalProject/$rows);
  $i = $params['rows']*($params['pageno'] - 1) + 1;
?>
<form class="form-inline">
  <div class="container-fluid">
    <!-- Pagination -->
    <h4><?='Project';?></h4>
    <div class="float-left">
      <div class="form-group">
        <input name="keywords" id="keywords" type="text" class="form-control" placeholder="Type text to search ..." value="<?= $keywords; ?>">
      </div>
      <div class="form-group">
        <a class="btn btn-outline-success btn-sm" id="search" onclick="projects_body('<?php print $rows;?>', '<?php print $pageno;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" title="search">
          <i  class="fa fa-search"></i>
        </a>&nbsp;
        <a class="btn btn-outline-info btn-sm" onclick="reset_projects_body()" title="Reset">
          <i class="fas fa-sync-alt"></i>
        </a>
      </div>
      <div class="form-group">
        <?php print $totalProject;?> Records
      </div>
    </div>
    <div class="float-right">
      <a href="projects/addprojects" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Add New Project</a>
    </div>
    <div class="clearfix"></div>
    <div class="float-right">
      <div  id='rows' class="form-group">
         <select class="form-control input-sm" name="rows" onchange="projects_body(this.value,'1','<?php print $sortby;?>','<?php print $sort_order; ?>')">
            <option value="10" <?php if($rows == 10) print 'selected="selected"';?> >10 <?php print _("Records"); ?></option>
            <option value="20" <?php if($rows == 20) print 'selected="selected"';?> >20 <?php print _("Records"); ?></option>
            <option value="30" <?php if($rows == 30) print 'selected="selected"';?> >30 <?php print _("Records"); ?></option>
            <option value="40" <?php if($rows == 40) print 'selected="selected"';?> >40 <?php print _("Records"); ?></option>
            <option value="50" <?php if($rows == 50) print 'selected="selected"';?> >50 <?php print _("Records"); ?></option>
            <option value="100" <?php if($rows == 100) print 'selected="selected"';?> >100 <?php print _("Records"); ?></option>
          </select>
      </div>
       <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <?php
                if ($pageno == 1) {
                 print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-backward"></i></button>';
                  print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-left"></i></button>';
                }
                else {
                  ?>
                  <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="projects_body('<?php print $rows;?>', '1', '<?php print $sortby;?>', '<?php print $sort_order;?>')">
                   <i class="fa fa-backward"></i>
                  </a>
                  <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="projects_body('<?php print $rows;?>', '<?php print $pageno-1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
                   <i class="fa fa-chevron-left"></i>
                  </a>
                  <?php
                }
              ?>
            </span>
            <select class="form-control input-sm" name="rows" onchange="projects_body('<?php print $rows;?>', this.value, '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
              <?php
              for ($pg=1; $pg <= $pages; $pg++) {
              ?>
              <option value="<?php print $pg?>" <?php if ($pg == $pageno) print 'selected="selected"';?> >
                <?php print $pg . '/' . $pages;?>
              </option>
              <?php
              }
              ?>
            </select>
            <span class="input-group-btn">
              <?
              if ($pageno == $pages) {
                print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>';
                print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-forward"></i></button>';
              }
              else {
                ?>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="projects_body('<?php print $rows;?>', '<?php print $pageno+1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')">
                  <i class="fa fa-chevron-right"></i>
                </a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="projects_body('<?php print $rows;?>', '<?php print $pages;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
                  <i class="fa fa-forward"></i>
                </a>
                <?php
              }
              ?>
            </span>
          </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <table class="table table-bordered" id="project-list">
      <thead>
        <tr>
          <th>S.NO</th>
         <th class="sortable <?=($sortby=='name')? $sort_order:'';?> text-center" onclick="projects_body('<?php print $rows;?>', '1', 'code', '<?php print $sort_order_alt;?>')">Code</th>
         <th class="sortable <?=($sortby=='name')? $sort_order:'';?> text-center" onclick="projects_body('<?php print $rows;?>', '1', 'name', '<?php print $sort_order_alt;?>')">Project Name</th>
         <th class="sortable <?=($sortby=='priority')? $sort_order:'';?> text-center" onclick="projects_body('<?php print $rows;?>', '1', 'priority', '<?php print $sort_order_alt;?>')">Priority </th>
          <th class="sortable <?=($sortby=='start_at')? $sort_order:'';?> text-center" onclick="projects_body('<?php print $rows;?>', '1', 'start_at', '<?php print $sort_order_alt;?>')">Start Date </th>
          <th class="sortable <?=($sortby=='end_at')? $sort_order:'';?> text-center" onclick="projects_body('<?php print $rows;?>', '1', 'end_at', '<?php print $sort_order_alt;?>')">Target Date </th>
         <th>Status</th>
         <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#</td>
          <td><input type="text" class="form-control input-sm" id="code_id" placeholder="Code"  value="<?= $code_id; ?>" ></td>
          <td><input type="text" name="name" class="form-control input-sm" placeholder="Name" id="name" value="<?php print $name;?>"></td>
          <td><input type="text" name="priority_id" class="form-control input-sm" id="priority_id" placeholder="Priority" value="<?php print $priority_id;?>"></td>
          <td>
             <div class="input-group">
              <input type="text" name="start_at" id="start_at" class="form-control input-sm" placeholder="DD-MM-YYYY" value="<?php print set_value('start_at'); ?>">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
          </td>
          <td>#</td>
          <td>#</td>
          <td>#</td>
        </tr>
        <?php if($projects): ?>
        <?php
        $i=1; 
        //print('<pre>');print_r($projects);print('<pre/>');exit();
        foreach($projects as $pro): 
        ?>
        <tr>
        <td><?php print $i++;?></td>
          <td><?php echo $pro['code']; ?></td>
          <td><?php echo $pro['name']; ?></td>
          <td><?php echo $pro['priority']; ?></td>
          <td><?php echo isset($pro['start_at'])? date("d-m-Y", strtotime($pro['start_at'])):''; ?></td>
          <td><?php echo isset($pro['end_at'])? date("d-m-Y", strtotime($pro['end_at'])):''; ?></td>
          <td class="text-center"><?php 
            switch ($pro['status']) {
              case '0':print '<span class="badge badge-warning">Inactive</span>';break;
              case '1':print '<span class="badge badge-success">Active</span>';break;
            /*  case '2':print '<span class="badge badge-warning">Delete</span>';break;*/
              default:print ''; break;
            }
          ?></td>
          <td>
            <a href="projects/edit_projects/<?php echo $pro['id']; ?>" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
            <a href="projects/projectsDelete/<?php echo $pro['id']; ?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="9"> 
            <div class="alert alert-warning"><?php print _("No rows Found");?></div>
          </td>
        </tr>
      <? endif; ?>
      </tbody>
    </table>
  </div>
</form>
<script type="text/javascript">
  function projects_body(rows,pageno,sortby,sort_order) {
    var qStr = {
      "rows" : rows,
      "pageno" : pageno,
      "sortby" : sortby,
      "sort_order" : sort_order,
      "code_id" : $("#code_id").val(),
      "name" : $("#name").val(),
      "start_at" : $("#start_at").val(),
      "name" : $("#end_at").val(),
      "priority_id" : $("#priority_id").val(),
      "created_at" : $("#created_at").val(),
      "created_by" : $("#created_by").val(),
      "updated_at" : $("#updated_at").val(),
      "updated_by" : $("#updated_by").val(),
      "keywords" : $("#keywords").val(),
    };
    $.post(WEB_ROOT+"projects", qStr, function (data) {
      $("#projects_body").html(data);
    });
  }
  function reset_projects_body() {
    $('input[name="keywords"]').val("");
    projects_body(10, 1, 'created_at', 'desc');
  }
  $('#from').datepicker({format: 'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
    $(this).datepicker('hide');
  });

  $('#start_at').datepicker({format: 'dd-mm-yyyy',autoclose: true}).on('changeDate', function(ev) {
    $(this).datepicker('hide');
  });
</script>