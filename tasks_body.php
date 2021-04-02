<?php
  //print_r(SITE_URL());
  $records = $filters['records'];
  $pageno = $filters['pageno'];
  $sortby = $filters['sortby'];
  $sort_order = $filters['sort_order'];
  $sort_order_alt = $filters['sort_order']=='asc'? 'desc':'asc';
    
  $code = $tasks['code']??'';
  $name = $tasks['name']??'';
  $project = $tasks['project']??'';
  $parent = $tasks['parent']??'';
  $start_at = $tasks['start_at']??'';
  $end_at = $tasks['end_at']??'';
  $estimate_time = $tasks['estimate_time']??'';
  $priority = $tasks['priority']??'';
  $responsible = $tasks['responsible']??'';
  $assigned_to = $tasks['assigned_to']??'';
  $status = $tasks['status']??'';
  $progress = $tasks['progress']??'';
  $search = $tasks['search']??'';
  $created_at = $tasks['created_at']??'';
  $updated_at = $tasks['updated_at']??'';

  $pages = ceil($totalTasks/$records);
  $i = $filters['records']*($filters['pageno'] - 1) + 1;
?>
<form class="form-inline">
  <div class="container-fluid">
    <!-- Pagination -->
    <h4><?='Tasks';?></h4>
    <div class="float-left">
      <div class="form-group">
        <input name="search" id="search" type="text" class="form-control" placeholder="Type text to search ..." value="<?= $search; ?>">
      </div>
      <div class="form-group">
        <a class="btn btn-outline-success btn-sm" id="search" onclick="tasks_body('<?php print $records;?>', '<?php print $pageno;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" title="search">
          <i  class="fa fa-search"></i>
        </a>&nbsp;
        <a class="btn btn-outline-info btn-sm" onclick="reset_tasks_body()" title="Reset">
          <i class="fas fa-sync-alt"></i>
        </a>
      </div>
      <div class="form-group">
        <?php print $totalTasks;?> records
      </div>
    </div>
    <div class="float-right">
      <a href="<?=base_url()?>/task_add" class="btn btn-outline-info btn-sm"><i class="fa fa-plus"></i> Add New Task</a>
    </div>
    <div class="clearfix"></div>
    <div class="float-right">
      <div  id='records' class="form-group">
        <label class="control-label">Show</label>
        <select name="records" class="selectpicker" data-style="btn-default" data-max-options="1">
          <option value="10" <?php print $records=='10'? 'selected="selected"':'';?> >10</option>
          <option value="20" <?php print $records=='20'? 'selected="selected"':'';?> >20</option>
          <option value="50" <?php print $records=='50'? 'selected="selected"':'';?> >50</option>
          <option value="100" <?php print $records=='100' ? 'selected="selected"':'';?> >100</option>
        </select>
        <label class="control-label">records per page</label>
      </div>
      <?php if(isset($totalTasks) && $totalTasks != 0) { ?>
      <div id="pagination" class="form-group">
        <ul class="pagination">
          <?php if($pageno!=1) : ?>
          <li class="page-item">
            <a class="page-link" href="javascript:tasks_body('<?php print $records;?>', '1', '<?php print $sortby;?>', '<?php print $sort_order;?>')" tabindex="-1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
          </li>
          <li class="page-item" >
            <a class="page-link" href="javascript:tasks_body('<?php print $records;?>', '<?=$pageno-1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" tabindex="-1"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
          </li>
          <?php else : ?>
          <li class="page-item disabled" >
            <a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>
          </li>
          <li class="page-item disabled" >
            <a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
          </li>
          <?php endif; ?>
          <li class="page-item active">
            <a class="page-link" tabindex="-1"><?=$pageno;?></a>
          </li>
          <?php if($pageno!=$pages) : ?>
          <li>
            <a class="page-link" href="javascript:tasks_body('<?php print $records;?>', '<?=$pageno+1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" tabindex="-1"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </li>
          <li>
            <a class="page-link" href="javascript:tasks_body('<?php print $records;?>', '<?=$pages;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" tabindex="-1"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
          </li>
          <?php else : ?>
          <li class="page-item disabled" >
            <a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
          </li>
          <li class="page-item disabled" >
            <a class="page-link" href="javascript:void(0)" tabindex="-1"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
          </li>
          <?php endif; ?>
        </ul>
      </div>
      <?php } ?>
    </div>
    <div class="clearfix"></div>
    <table class="table table-bordered" id="tasks-list">
      <thead>
        <tr>
          <th>S NO</th>
          <th class="sortable <?=($sortby=='code')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'code', '<?php print $sort_order_alt;?>')">Code</th>
          <th class="sortable <?=($sortby=='user_name')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'user_name', '<?php print $sort_order_alt;?>')">Name</th>
          <th class="sortable <?=($sortby=='parent')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'parent', '<?php print $sort_order_alt;?>')">Parent</th>
          <th class="sortable <?=($sortby=='project')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'project', '<?php print $sort_order_alt;?>')">Project</th>
          <th class="sortable <?=($sortby=='start_at')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'start_at', '<?php print $sort_order_alt;?>')">Start Date</th>
          <th class="sortable <?=($sortby=='end_at')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'end_at', '<?php print $sort_order_alt;?>')">End Date</th>
          <th class="sortable <?=($sortby=='created_at')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'created_at', '<?php print $sort_order_alt;?>')">Added Date</th>
          <th class="sortable <?=($sortby=='updated_at')? $sort_order:'';?> text-center" onclick="tasks_body('<?php print $records;?>', '1', 'updated_at', '<?php print $sort_order_alt;?>')">Updated Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#</td>
          <td><input type="text" class="form-control input-sm" id="code" placeholder="Code" value="<?php print $code;?>" ></td>
          <td><input type="text" name="name" class="form-control input-sm" placeholder="Name" id="name" value="<?php print $name;?>"></td>
          <td><input type="text" name="parent" class="form-control input-sm" id="parent" placeholder="Parent" value="<?php print $parent;?>"></td>
          <td><input type="text" name="project" class="form-control input-sm" placeholder="Project" id="project" value="<?php print $project;?>"></td>
          <td><input type="text" name="start_at" class="form-control input-sm" placeholder="Start Date" id="start_at" value="<?php print $start_at;?>"></td>
          <td><input type="text" name="end_at" class="form-control input-sm" placeholder="End Date" id="end_at" value="<?php print $end_at;?>"></td>
          <td>#</td>
          <td>#</td>
        </tr>
        <?php if($tasks): ?>
          
        <?php
        $i=1; 
        //print('<pre>');print_r($users);print('<pre/>');exit();
        foreach($tasks as $task): 
        ?>
        <tr>
          <td><?php echo $i++; ?></td>
          <td><?php echo $task['code']; ?></td>
          <td><?php echo $task['name']; ?></td>
          <td><?php echo $task['email']; ?></td>
          <td><?php echo $task['phone']; ?></td>
          <td><?php echo isset($task['created_at'])? date("d-m-Y", strtotime($task['created_at'])):''; ?></td>
          <td><?php echo isset($task['updated_at'])? date("d-m-Y", strtotime($task['updated_at'])):''; ?></td>
          <td nowrap="nowrap">
            <div class="button-group"> 
              <a href="<?=base_url()?>/taskdetails/<?=$task['id']?>" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i> view</a>
              <a href="<?=base_url()?>/taskedit/<?=$task['id']?>" class="btn btn-outline-primary btn-sm"><i class="fa fa-edit"></i> edit</a>
              <a href="<?=base_url()?>/taskdelete/<?=$task['id']?>" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash-alt"></i> delete</a>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
          <td colspan="9"> 
            <div class="alert alert-warning"><?php print _("No Records Found");?></div>
          </td>
        </tr>
      <? endif; ?>
      </tbody>
    </table>
  </div>
</form>
<script type="text/javascript">
  function tasks_body(records, pageno, sortby, sort_order) {
    var qStr = {
      "records" : records,
      "pageno" : pageno,
      "sortby" : sortby,
      "sort_order" : sort_order,
      "code" : $("#code").val(),
      "user_name" : $("#user_name").val(),
      "username" : $("#username").val(),
      "email" : $("#email").val(),
      "phone" : $("#phone").val(),
      "search" : $("#search").val(),
    };
    $.post(SITE_URL+"users", qStr, function (data) {
      $("#tasks_body").html(data);
    });
  }
  function reset_tasks_body() {
    $('input[name="search"]').val("");
    tasks_body(10, 1, 'created_at', 'desc');
  }
  $("input[name='search']").on('keypress', function(e) {
    if(e.keyCode==13) {
      tasks_body($('select[name="records"]').val(), 1, 'created_at', 'desc');
    }
  });
  $("select[name='records']").on('change', function() {
    tasks_body($(this).val(), 1, 'created_at', 'desc');
  });
</script>