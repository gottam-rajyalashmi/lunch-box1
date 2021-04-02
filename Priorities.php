<div class="container mt-5">
  <a href="users/adduser">Add User</a>
  <div class="row mt-3">
     <table class="table table-bordered" id="users">
       <thead>
          <tr>
             <th>S.NO</th>
             <th>Name</th>
             <th>Status</th>
             <th>Created_at</th>
             <th>Created_by</th>
             <th>Updated_at</th>
             <th>Updated_by</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($priorities): ?>
          <? $i=1; ?>
          <?php foreach($priorities as $prioritie): ?>
          <tr>
             <td class="text-center"><?php print $i++;?></td>
             <td><?php echo $prioritie['name']; ?></td>
             <td><?php echo $prioritie['status']; ?></td>
             <td><?php echo $prioritie['created_at']; ?></td>
             <td><?php echo $prioritie['created_by']; ?></td>
             <td><?php echo $prioritie['updated_at']; ?></td>
             <td><?php echo $prioritie['updated_by']; ?></td>
             <td>
               <a href="priorities/edit_user/<?php echo $prioritie['id']; ?>">Edit</a>
               <a href="priorities/userDelete/<?php echo $prioritie['id']; ?>">Delete</a>
              </td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>
     <div class="row">
</div>
