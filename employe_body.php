<?php
	$post_nums=array(5,10,15,20,25,50);
	$num_rows=$params['num_rows'];
	$pageno=$params['pageno'];
	$sortby=$params['sortby'];
	$sort_order = $params['sort_order'];
  $firstname = (isset($_POST['firstname'])) ? $_POST['firstname'] : "" ;
  $lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : "" ;
  $number = (isset($_POST['number'])) ? $_POST['number'] : "" ;
  $email = (isset($_POST['email'])) ? $_POST['email'] : "" ;
  $number = (isset($_POST['number'])) ? $_POST['number'] : "" ;
  $departments = (isset($_POST['departments'])) ? $_POST['departments'] : "" ;
  $designation = (isset($_POST['designation'])) ? $_POST['designation'] : "" ;
  $gender = (isset($_POST['gender'])) ? $_POST['gender'] : "" ;
  $address = (isset($_POST['address'])) ? $_POST['address'] : "" ;
	$t_records = $params['t_records'];
	$total_pages=ceil($t_records/$num_rows);
	$keywords = (isset($params['keywords'])) ? ($params['keywords']) : "";
  //
	if($sort_order == 'asc'){
	  $sort_order_alt = 'desc';
	  $arrow = '<i class= "fa fa-arrow-up"></i>&nbsp;';
	}
	else {
	  $sort_order_alt = 'asc';
	  $arrow = '<i class="fa fa-arrow-down"></i>&nbsp;';
	}
  $i=$params['num_rows']*($params['pageno'] - 1) + 1;
?>
<br>
Employees 
<div>
  <form class="form-inline" method="post">
    <div class="pull-left">
      <div class="form-group">
        <label class="control-label">Search&nbsp;:&nbsp;</label>
        <input class="form-control input-sm" type="text" id="keywords" name="keywords" value="<?php print $keywords; ?>">
        <button type="button" onclick="employeBody('<?php print $num_rows;?>','1','<?php print $sortby;?>','<?php print $sort_order; ?>')">Search</button>
        <button type="button" onclick="resetEmployeBody()">Reset</button>
      </div>
      <div class="form-group">
        <span class="uuser-records-count"><?php print '('. $t_records . ''. _("Records").')'; ?></span>
      </div>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary btn-sm" href="javascript:employeeAdd()" title="Add Employee">
        <i class="fa fa-plus" aria-hidden="true">&nbsp;</i>Add Employee
      </a>
      <?php
      if($employee) {
      ?>
        <div class="form-group">
          <select class="form-control input-sm" name="num_rows" onchange="employeBody(this.value,'1','<?php print $sortby;?>','<?php print $sort_order; ?>')">
            <option value="5" <?php if ($num_rows == 5) print 'selected="selected"';?> >5 <?php print _("Records");?></option>
            <option value="10" <?php if($num_rows == 10) print 'selected="selected"';?> >10 <?php print _("Records"); ?></option>
            <option value="15" <?php if($num_rows == 15) print 'selected="selected"';?> >15 <?php print _("Records"); ?></option>
            <option value="20" <?php if($num_rows == 20) print 'selected="selected"';?> >20 <?php print _("Records"); ?></option>
            <option value="30" <?php if($num_rows == 30) print 'selected="selected"';?> >30 <?php print _("Records"); ?></option>
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
                  <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="employeBody('<?php print $num_rows;?>', '1', '<?php print $sortby;?>', '<?php print $sort_order;?>')">
                   <i class="fa fa-backward"></i>
                  </a>
                  <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="employeBody('<?php print $num_rows;?>', '<?php print $pageno-1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
                   <i class="fa fa-chevron-left"></i>
                  </a>
                  <?php
                }
              ?>
            </span>
            <select class="form-control input-sm" name="num_rows" onchange="employeBody('<?php print $num_rows;?>', this.value, '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
              <?php
              for ($pg=1; $pg <= $total_pages; $pg++) {
              ?>
              <option value="<?php print $pg?>" <?php if ($pg == $pageno) print 'selected="selected"';?> >
                <?php print $pg . '/' . $total_pages;?>
              </option>
              <?php
              }
              ?>
            </select>
            <span class="input-group-btn">
              <?
              if ($pageno == $total_pages) {
                print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-chevron-right"></i></button>';
                print '<button type="button" class="btn btn-default btn-sm disabled"><i class="fa fa-forward"></i></button>';
              }
              else {
                ?>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="employeBody('<?php print $num_rows;?>', '<?php print $pageno+1;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')">
                  <i class="fa fa-chevron-right"></i>
                </a>
                <a class="btn btn-default btn-sm" href="javascript:void(0);" onclick="employeBody('<?php print $num_rows;?>', '<?php print $total_pages;?>', '<?php print $sortby;?>', '<?php print $sort_order;?>')" >
                  <i class="fa fa-forward"></i>
                </a>
                <?php
              }
              ?>
            </span>
          </div>
        </div>
      <?php } ?>
      </div> 
    <div class="clearfix"></div>
  </form>
<!--   <a href="javascript:window.history.go(-1);">Previous</a>  <div class="marTop"> -->
    <div id="user_body">
      <div class="table-responsive">
        <?php
        if ($employee) {
        ?>
        <table class="table" border="1">
          <thead>
            <tr>
              <th class="text-center" width="1%">S.No</th>
              <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'firstname', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'firstname')  print $arrow; ?> Firstname
                </a>
              </th>
              <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'lastname', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'lastname')  print $arrow; ?> lastname
                </a>
              </th>
              <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'number', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'number')  print $arrow; ?> number
                </a>
              </th>
              <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'email', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'email')  print $arrow; ?> email
                </a>
              </th>
               <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'department', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'department')  print $arrow; ?> Department
                </a>
              </th>
               <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'designation', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'designation')  print $arrow; ?> Designation
                </a>
              </th>
              <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'gender', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'gender')  print $arrow; ?> Gender
                </a>
              </th>
                   <th nowrap="nowrap">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'address', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'address')  print $arrow; ?> Address
                </a>
              </th>
              <th>Roles</th>
              <th nowrap="nowrap" class="text-center">
                <a href="javascript:void(0)" onclick="employeBody('<?php print $num_rows;?>', '1', 'status', '<?php print $sort_order_alt;?>')">
                  <?php if ($sortby == 'status')  print $arrow; ?> Status
                </a>
              </th>
              <th>Actions</th>
            </tr>
            <tr>
              <td></td>
              <td><input type="text" name="firstname" id="firstname" class="form-control input-sm" placeholder="enter a firstname" value="<?php print $firstname;?>"></td>
              <td><input type="text" name="lastname" id="lastname" class="form-control input-sm" placeholder="enter a lastname" value="<?php print $lastname;?>"></td>
              <td><input type="text" name="number" id="number" class="form-control input-sm" placeholder="enter a number" value="<?php print $number?>"></td>
              <td><input type="text" name="email" id="email" class="form-control input-sm" placeholder="enter a email" value="<?php print $email?>"></td>
              <td>
              <select id="departments" name="department" class="form-control input-sm">
              <option value="">All</option>
                <?php
                //
                  foreach($department as $dept_id => $dept_name) {
                ?><option value="<? print $dept_id;?>" <? if($departments == $dept_id){ print 'selected';}?> ><? print $dept_name['name'];?></option><?
                 }
                ?>
              </select>
            </td>
              <td>
                <select id="designation" name="designation" class="form-control input-sm">
                 <option value="">All</option>
                <?php
                //
                  foreach($designations as $desi_id => $desi_name) {
                ?><option value="<? print $desi_id;?>" <? if($designation == $desi_id){ print 'selected';}?> ><? print $desi_name['name'];?></option><?
                 }
                ?>
                </select>
              </td>
              <td>
                <select id="gender" name="gender" class="form-control input-sm">
                  <option value="">All</option>
                  <option value="female" <? if ($gender == 'female') { print "selected";}?>>female</option>
                  <option value="male" <? if ($gender == 'male') { print "selected";}?>>male</option>
                </select>
              </td>
              <td><input type="text" name="address" id="address" class="form-control input-sm" placeholder="enter a address" value="<?php print $address;?>"></td>
              <td></td>
              <td></td>
              <td><button type="button" onclick="employeBody('<?php print $num_rows;?>','1','<?php print $sortby;?>','<?php print $sort_order; ?>')">Search</button></td>
            </tr>
          </thead>
          <tbody>
            <? foreach ($employee as $id => $employe) { 
              ?>
            <tr>
             <td><?php print $i++;?></td>
  						<td><?php print $employe['firstname']; ?></td>
  						<td><?php print $employe['lastname']; ?></td>
  						<td><?php print $employe['number']; ?></td>
  						<td><?php print $employe['email']; ?></td>
              <td><?php print $employe['department']; ?></td>
              <td><?php print $employe['designations']; ?></td>
  						<td><?php print $employe['gender'];?></td>
  						<td><?php print $employe['address']; ?></td>
              <td><?php print $employe['roles'];?></td>
              <td>
               <?php
                if($employe['status'] == 1) { ?>
                  <button type="button" class="btn btn-primary btn-xs" onclick="employeeStatus('<?php print $employe['id'];?>')" title="Disable">&nbsp;   Disabled
                  </button>
                  <?php
                  }
                  else {
                  ?>
                  <button type="button" class="btn btn-success btn-xs" onclick="employeeStatus('<?php print $employe['id'];?>')" title="Enable">&nbsp;  Enabled
                  </button>
                  <?php
                  }
                ?>
              </td>
              <td>
                <button class="btn btn-xs btn-success" onclick="edit_employee('<?php print $employe['id']; ?>')" title="edit">  <i class="fa fa-plus" aria-hidden="true">&nbsp;</i><?php print _("edit"); ?></button>
                  <button class="btn btn-xs btn-danger" onclick="employee_delete('<?php print $employe['id']; ?>')" title="delete">  <i class="fa fa-plus" aria-hidden="true">&nbsp;</i><?php print _("delete"); ?></button>
                  <a class="btn btn-xs btn-info" href="Employeee/viewemployee?id=<?php print $employe['id']; ?>">View</a>
                  <button class="btn btn-xs btn-secondary" onclick="roles_employee('<?php print $employe['id']; ?>')" title="role"> <i class="fa fa-plus" aria-hidden="true">&nbsp;</i><?php print _("role"); ?></button>
                 </td>
            </tr>
          <?}
        ?>
      </tbody>
        </table>
        <?php
        } else { ?>
          <div class="alert alert-warning"><?php print _("No Records Found");?></div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() { Tablehead(); } );
</script>
