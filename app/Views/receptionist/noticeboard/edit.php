<div class="row">
  <!--  form area -->
  <div class="col-sm-12">
    <div  class="panel panel-default thumbnail">

        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="btn btn-primary" href="<?= site_url("/noticeboard") ?>"> <i class="fa fa-list"></i> Notice List</a>  
            </div>
        </div> 


        <div class="panel-body panel-form">
          <div class="row">
              <div class="col-md-9 col-sm-12 ">
                <form action="<?= '/noticeboard/update/'.$notice->id ?>" method="post" >
                  <?= csrf_field() ?>
                  <div class="form-group row">
                      <label for="title" class="col-xs-3 col-form-label">Title<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="title" type="text" class="form-control" id="title" placeholder="Title" value="<?= $notice->title ?>">
                          <input name="created_by" type="hidden" class="form-control" id="created_by" placeholder="Title" value="<?= $notice->created_by ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                    <label for="description" class="col-xs-3 col-form-label">Description<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                    <textarea name="description" class="form-control tinymce"  placeholder="Description"  rows="7"><?= $notice->description ?></textarea>
                    </div>
                  </div> 

                  <div class="form-group row">
                      <label for="start_date" class="col-xs-3 col-form-label">Start Date<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <input name="start_date" class="form-control" type="date" placeholder="Start Date" id="start_date" value="<?= $notice->start_date ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="end_date" class="col-xs-3 col-form-label">End Date<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <input name="end_date" class="form-control" type="date" placeholder="End Date" id="end_date" value="<?= $notice->end_date ?>">
                      </div>
                  </div>
               
                  <div class="form-group row">
                    <label class="col-xs-3">Status</label>
                    <div class="col-xs-9">
                    <div class="form-check">
                        <label class="radio-inline">
                        <input type="radio" name="status" value="1" <?php echo  esc(set_radio('status', '1', TRUE)); ?> />Active
                        </label>
                        <label class="radio-inline">
                        <input type="radio" name="status" value="0" <?php echo  esc(set_radio('status', '0')); ?> >Inactive
                        </label>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-offset-3 col-sm-6">
                      <div class="ui buttons">
                        <button type="reset" class="ui button">Reset</button>
                        <div class="or"></div>
                        <button class="ui positive button">Update</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            <div class="col-md-3"></div>
          </div>
        </div>
    </div>
  </div>
</div>

 