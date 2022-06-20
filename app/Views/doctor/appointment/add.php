<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail">

      <!-- Heading -->
      <div class="panel-heading">
        <div class="btn-group">
          <a class="btn btn-primary" href="<?php echo base_url("doctor/appointment") ?>"> <i class="fa fa-list"></i> Appointment List</a> 
        </div>
      </div>

      <!-- Form Body -->
      <div class="panel-body">
        <div class="row">
          <div id="output" class="hide alert"></div>
          <div class="col-md-9 col-sm-12">
            <form action="/doctor/appointment/create" method="post" >
              <?= csrf_field() ?>

              <div class="form-group row">
                <label for="patient_id" class="col-xs-3 col-form-label">Patient Code<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="patient_id"  type="text" class="form-control" id="patient_id" value="<?= old('patient_id') ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="note" class="col-xs-3 col-form-label"> Note</label>
                <div class="col-xs-9">
                  <textarea name="note" class="form-control tinymce"  placeholder="note"  rows="7"></textarea>
                </div>
              </div> 

              <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                  <div class="ui buttons">
                    <button type="reset" class="ui button"> Reset</button>
                    <div class="or"></div>
                    <button type="submit" class="ui positive button"> Send</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>