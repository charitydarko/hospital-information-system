<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail">

      <!-- Heading -->
      <div class="panel-heading">
        <div class="btn-group">
          <a class="btn btn-primary" href="<?php echo base_url("vitals") ?>"> <i class="fa fa-list"></i> Vitals List</a> 
        </div>
      </div>

      <!-- Form Body -->
      <div class="panel-body">
        <div class="row">
          <div id="output" class="hide alert"></div>
          <div class="col-md-9 col-sm-12">
            <form action="/vitals/create" method="post">
              <?= csrf_field() ?>

              <div class="form-group row">
                <label for="appointment_id" class="col-xs-3 col-form-label">Appointment Code<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="appointment_id"  type="text" class="form-control" id="appointment_id" value="<?= $uri ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="blood_pressure" class="col-xs-3 col-form-label">Blood Pressure<i class="text-danger">*</i></label>
                <div class="input-group col-xs-9">
                  <input name="blood_pressure"  type="text" class="form-control" id="blood_pressure">
                  <div class="input-group-addon"> mmHg</div>
                </div>
              </div>

              <div class="form-group row">
                <label for="pulse" class="col-xs-3 col-form-label">Pulse<i class="text-danger">*</i></label>
                <div class="input-group col-xs-9">
                  <input name="pulse"  type="text" class="form-control" id="pulse">
                  <div class="input-group-addon"> bpm</div>
                </div>
              </div>

              <div class="form-group row">
                <label for="height" class="col-xs-3 col-form-label">Height<i class="text-danger">*</i></label>
                <div class="input-group col-xs-9">
                  <input name="height"  type="text" class="form-control" id="height">
                  <div class="input-group-addon"> cm</div>
                </div>
              </div>

              <div class="form-group row">
                <label for="weight" class="col-xs-3 col-form-label">Weight<i class="text-danger">*</i></label>
                <div class="input-group col-xs-9">
                  <input name="weight"  type="text" class="form-control" id="weight">
                  <div class="input-group-addon"> kg</div>
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