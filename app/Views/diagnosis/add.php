<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail">

      <!-- Heading -->
      <div class="panel-heading">
        <div class="btn-group">
          <a class="btn btn-primary" href="<?php echo base_url("diagnosis") ?>"> <i class="fa fa-list"></i> Diagnosis List</a> 
        </div>
      </div>

      <div class="panel-body">
          <div class="row">
            <div class="col-sm-6">
                <div>
                    <strong>Appointment Code:</strong> <?= $appointment->id ?>
                </div>
                <div>
                    <strong>Patient Code:</strong> <?= $appointment->patient_id ?>
                </div>
                <div>
                    <strong>Patient Name:</strong> <?= $patient->firstname . ' ' . $patient->lastname?>
                </div>
                <div>
                    <strong>Patient Gender:</strong> 
                    <?php 
                        switch($patient->gender) {
                            case '1':
                            {echo 'Male'; break;}
                            case '2':
                            {echo 'Female'; break;}
                            case '3':
                            {echo 'Other'; break;}
                            default:
                            {echo 'Not provided'; break;}
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div>
                    <strong>Blood Pressure:</strong> <?= $vitals->blood_pressure ?> <span>mmHg</span>
                </div>
                <div>
                    <strong>Pulse:</strong> <?= $vitals->pulse ?> <span>bpm</span>
                </div>
                <div>
                    <strong>Weight:</strong> <?= $vitals->weight ?> <span>kg</span>
                </div>
                <div>
                    <strong>Height:</strong> <?= $vitals->height ?> <span>cm</span>
                </div>
            </div>
          </div>
          <br/><br/>
          <div class="row">
              <form action="/diagnosis/create" method="post" >
                  <?= csrf_field() ?>
                  <input type="hidden" name="appointment_id" id="appointment_id" value="<?= $appointment->id ?>">
                  <div class="col-sm-12 bg-success">
                      <div class="col-sm-4"><h3>Diagnosis</h3></div>
                      <div class="col-sm-4"><h3>Prescription</h3></div>
                      <div class="col-sm-4"><h3>Visiting Fees</h3></div>
                  </div>
                  <br/><br/><br/>
                  <div class="col-sm-12 form-group">
                      <label for="complain" class="col-sm-2 col-form-label">Complain:<i class="text-danger">*</i></label>
                      <div class="col-sm-10">
                          <input name="complain" class="form-control"  placeholder="Complain">
                      </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="diagnosis" class="col-sm-2 col-form-label">Findings/Diagnosis:<i class="text-danger">*</i></label>
                      <div class="col-sm-10">
                          <textarea name="diagnosis" class="form-control"  placeholder="List all diagnosis and findings here"  rows="5"></textarea>
                      </div>
                  </div>
                  
                  <div class="col-sm-12 form-group">
                      <label for="prescription" class="col-sm-2 col-form-label">Prescription:<i class="text-danger">*</i></label>
                      <div class="col-sm-10">
                          <textarea name="prescription" class="form-control"  placeholder="List all prescription details here"  rows="5"></textarea>
                      </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="laboratory" class="col-sm-2 col-form-label">Laboratory:</label>
                      <div class="col-sm-10">
                          <textarea name="laboratory" class="form-control"  placeholder="List all laboratory requests"  rows="5"></textarea>
                      </div>
                  </div>
                  
                  <div class="col-sm-12 form-group">
                      <label for="visiting_fees" class="col-sm-2 col-form-label">Visiting Fees:</label>
                      <div class="col-sm-10">
                          <input name="visiting_fees" class="form-control"  placeholder="Visiting Fees">
                      </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="visiting_fees_reason" class="col-sm-2 col-form-label">Reason for Visiting Fees:</label>
                      <div class="col-sm-10">
                          <textarea name="visiting_fees_reason" class="form-control"  placeholder="List reason for charges here"  rows="5"></textarea>
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