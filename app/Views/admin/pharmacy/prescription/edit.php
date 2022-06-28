<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail">

      <!-- Heading -->
      <div class="panel-heading">
        <div class="btn-group">
          <a class="btn btn-primary" href="<?php echo base_url("admin/pharmacy/prescription/request") ?>"> <i class="fa fa-list"></i> Prescription List</a>
        </div>
      </div>

      <div class="panel-body">
          <div class="row">
            <div class="col-sm-6">
                <div>
                    <strong>Appointment Code:</strong> <?= $appointment->appointment_id ?>
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
                    <strong>Prescription:</strong> <?= $diagnosis->prescription ?>
                </div>
            </div>
          </div>
          <br/><br/>
          <div class="row">
              <?php
                $prescription = $prescription->where('diagnosis_id', $diagnosis->id)->select('id')->find();
                $prescription_id = $prescription[0]->id;
              ?>
              <form action=<?="/admin/pharmacy/prescription/update/$prescription_id"?> method="post" >
                  <?= csrf_field() ?>
                  <br/><br/><br/>
                  <div class="col-sm-12 form-group">
                      <input type="hidden" value="<?= session()->get('id') ?>" name="served_by" class="form-control">
                  </div>
                  <div class="col-sm-12 form-group">
                      <label for="Status" class="col-sm-2 col-form-label">Status:</label>
                      <div class="col-sm-10">
                        <?php
                            $statusList = array(
                                ''   => 'Choose Status',
                                '1' => 'Served',
                                '2' => 'Not Served',
                            );
                            echo form_dropdown('status', $statusList, '', 'class="form-control" id="status" ');
                        ?>
                      </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="note" class="col-sm-2 col-form-label">Note:</label>
                      <div class="col-sm-10">
                          <textarea name="note" class="form-control"  placeholder="Note"  rows="5"></textarea>
                        </div>
                  </div>

                  <div class="form-group row">
                      <div class="col-sm-offset-3 col-sm-6">
                          <div class="ui buttons">
                              <button type="reset" class="ui button"> Reset</button>
                              <div class="or"></div>
                              <button type="submit" class="ui positive button"> Update</button>
                          </div>
                      </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>