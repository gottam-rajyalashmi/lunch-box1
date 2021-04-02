<? echo $note['name']; ?>
<div class="container-fluid">
  <div class="text-right">
    <a href="<?=base_url('notes')?>" class="btn btn-outline-dark btn-sm"><i class="fa fa-angle-left"> </i> Back</a>
  </div>
  <h4><?='Note Edit';?></h4>
  <hr>
  <form method="POST" action="<?=base_url('notes_update')?>" accept-charset="UTF-8" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $note['id'];?>">
    <div class="row">
      <div class="form-group">
        <label class="control-label">Note</label>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <div class="inputGroupContainer">
            <div class="input-group">
              <textarea id="name" name="name" placeholder="Note" class="form-control" type="text"><?= $note['name'];?></textarea>
            </div>
            <?php echo isset(session('errors')['name'])? session('errors')['name']: "";?>
          </div>
        </div>
      </div>
    </div>
    <div align="right">
      <button type="submit" class="btn btn-outline-info btn-sm" >Update</button>
    </div>
  </form>
</div>