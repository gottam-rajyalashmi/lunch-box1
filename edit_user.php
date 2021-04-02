<? @include_once "header.php"; ?>
  <script type="text/javascript" src="js/emp_validtions.js"></script>
  <link rel="stylesheet" type="text/css" href="css/add.css">
  <div id="div_out"></div>
  <?
  if(!isset($_SESSION['emp'])) {
    header('location:index.php');
  }
  ?>
<?
  if(isset($_GET['action']) and $_GET['action'] == 'edit') {
    $id     = $_GET['id'];
    $query  = "select * from user where id = $id";
    $result = mysqli_query($conn,$query);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
    }
  }
 // $courses = explode(',', $row['course']);
  $role = explode(',', $row['roles']);
?>
  <a href="login_employee.php">Home/Employee/useremployee</a><br>
  <form action="edit_user.php" method="get" name="myForm" id="edit_form">
    FIRSTNAME:
    <input type="text" name="firstname" id="firstname" class="form-control" value="<? print $row['firstname'];?>"></br>
    <input type="hidden" name="id" value="<? echo $id;?>">
    LASTNAME:
    <input type="text" name="lastname" id="lastname" class="form-control" value="<? print $row['lastname'];?>" >
    <input type="hidden" name="id" value="<? print $id;?>">
    USERNAME:
    <input type="text" name="username" id="username" class="form-control" value="<? print $row['username'];?>" >
    <input type="hidden" name="id" value="<? print $id;?>">
    NUMBER:
    <input type="text" name="number" id="number"  class="form-control"  value="<? print $row['number']; ?>">
    <input type="hidden" name="id" value="<? print $id;?>">
    EMAIL:
    <input type="text" name="email" id="email"  class="form-control"  value="<? print $row['email']; ?>">
    <input type="hidden" name="id" value="<? print $id;?>">
    GENDER:
   <input type="radio" name="gender" value="female" <? if ($row['gender'] == 'female') { print "checked";}?>>female
   <input type="radio" name="gender" value="male" <? if ($row['gender'] == 'male') { print "checked";}?>>male<br>
   <!--  COURSE:
    <input type="checkbox" name="course[]" value="php" <? if (in_array('php', $courses)) { print "checked";} ?>>php
    <input type="checkbox" name="course[]" value="c" <? if (in_array('c', $courses)) { print "checked";} ?>>c
    <input type="checkbox" name="course[]" value="c++" <? if (in_array('c++', $courses)) { print "checked";} ?>>c++
    <input type="checkbox" name="course[]" value="java" <? if (in_array('java', $courses)) { print "checked";} ?>>java<br> -->
   ROLES:
   <?php 
   foreach ($roles as $roles_id => $role) { 
    ?>
     <input type="checkbox" name="roles[]" value="<? print $roles_id;?>"><? print $role;?><br>
     <?
     }
   ?>
    ADDRESS:
   <textarea name="address"><? print $row['address'];?></textarea><br>
    <input type="button" name="update" value="Update" onclick="updateUser(<?php print $id; ?>)">
  </form>
<? @include_once "footer.php"; ?>
 <!-- onclick="updateEmployee(<?php print $id; ?>)" -->