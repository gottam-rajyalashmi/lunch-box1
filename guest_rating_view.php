<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Guset Rating Feedback details</h4>
    </div>
    <div class="modal-body">
      <div class="card-sub-body">
        <div class="sub-pad">
          <table class="table">
            <tbody>
            <?  if(isset($guest['guest_details'])){
                  $guest_details = json_decode($guest['guest_details'],true);
                }
              ?>
                <tr>
                <?php if(isset($guest['created_at'])) { ?>
                <td>Rating date</td>
                <td><?php print date('d-m-Y',strtotime($guest['created_at'])) ;?></td> 
                <td></td>
                <?php } ?>
               </td>
              </tr> 
               <tr>
                <?php if(isset($guest['rating'])) { ?>
                <td>Consumer Code</td>
                <td>
                  <?
                  if($guest['rating']){
                    for ($i = 1; $i <= 5; $i++){
                      if ($i <= $guest['rating']) print '<i class="fa fa-star text-yellow"></i>';
                      else print '<i class="fa fa-star-o text-yellow"></i>';
                    }
                  }
                  ?>
                </td>
                <td></td>
                <?php } ?>
               </td>
              </tr> 
              <tr>
                <?php if(isset($guest['type'])) { ?>
                <td>Type</td>
                <td>
                  <?
                  if($guest['type'] == '1'){
                  print "PNG";
                  } else {
                  print "CNG";
                  }
                  ?>
                </td>
                <td></td>
                <?php } ?>
               </td>
              </tr>
              <tr>
                <td>Name</td>
                <td>
                  <?php print $guest_details['name'];?>
                </td>
              </tr>
              <tr>
                <td>Mobile</td>
                <td>
                  <?php print $guest_details['mobile'];?>
                </td>
              </tr>  
               <tr>
                <?php if(isset($guest['service'])) { ?>
                <td>Service Name</td>
                <td><?php if(isset($guest['service'])) print $guest['service']; ?></td> 
                <?php } ?>
               </td>
              </tr>  
              <tr>
                <?php if(isset($guest['feedback'])) { ?>
                <td>FeedBack</td>
                <td><?php if(isset($guest['feedback'])) print $guest['feedback']; ?></td> 
                <?php } ?>
               </td>
              </tr>  
              <tr>
                <?php if(isset($guest['feedback_received_date'])) { ?>
                <td>FeedBack Recived Date</td>
                <td><?php print date('d-m-Y',strtotime($guest['feedback_received_date'])) ;?></td>
                <?php } ?>
               </td>
              </tr>  
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-gradient-danger" data-dismiss="modal"><i class="fa fa-close" aria-hidden="true">&nbsp;</i><?php print _("Close");?></button>
    </div>
  </div>
</div>