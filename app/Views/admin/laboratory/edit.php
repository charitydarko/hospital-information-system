<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-default thumbnail">

      <!-- Heading -->
      <div class="panel-heading">
        <div class="btn-group">
          <a class="btn btn-primary" href="<?php echo base_url("/admin/laboratory") ?>"> <i class="fa fa-list"></i> laboratory List</a>
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
                    <strong>laboratory:</strong> <?= $diagnosis->laboratory ?>
                </div>
            </div>
          </div>
          <br/><br/>
          <div class="row">
              <?php
                $laboratory = $laboratory->where('diagnosis_id', $diagnosis->id)->select('*')->find();
                $laboratory_id = $laboratory[0]->id;
              ?>
              <form action=<?="/admin/laboratory/update/$laboratory_id"?> method="post" enctype="multipart/form-data">
                  <?= csrf_field() ?>
                  <br/><br/><br/>
                  <div class="col-sm-12 form-group">
                      <input type="hidden" value="<?=  $appointment->patient_id ?>" name="patient_id" class="form-control">
                  </div>
                  <div class="col-sm-12 form-group">
                      <label for="Status" class="col-sm-2 col-form-label">Status:<i class="text-danger">*</i></label>
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
                      <label for="category" class="col-sm-2 col-form-label">Category:<i class="text-danger">*</i></label>
                      <div class="col-sm-10">
                        <?php
                            $categoryList = array(
                                ''   => 'Choose category of the file',
                                '2' => 'Lab Report',
                                '0' => 'Other',
                            );
                            echo form_dropdown('category', $categoryList, '', 'class="form-control" id="category" ');
                        ?>
                      </div>
                  </div>
                  <div class="col-sm-12 form-group">
                    <label for="attach_file" class="col-sm-2 col-form-label"> Attach File<i class="text-danger">*</i></label>
                    <div class="col-sm-10">
                    <input type="file" name="attach_file" id="attach_file" value="<?= old('attach_file') ?>">
                    </div>
                  </div>
                  <div class="col-sm-12 form-group">
                      <label for="note" class="col-sm-2 col-form-label">Note:<i class="text-danger">*</i></label>
                      <div class="col-sm-10">
                          <textarea name="note" class="form-control"  placeholder="Note"  rows="5"><?= $laboratory[0]->note; ?></textarea>
                        </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="laboratory_fees" class="col-sm-2 col-form-label">Laboratory Fees:</label>
                      <div class="col-sm-10">
                          <input name="laboratory_fees" class="form-control"  placeholder="Laboratory Fees" value="<?= $laboratory[0]->fees; ?>" />
                      </div>
                  </div>

                  <div class="col-sm-12 form-group">
                      <label for="laboratory_fees_reason" class="col-sm-2 col-form-label">Reason for Laboratory Fees:</label>
                      <div class="col-sm-10">
                          <textarea name="laboratory_fees_reason" class="form-control"  placeholder="List reason for charges here"  rows="5"> <?= trim(strip_tags($laboratory[0]->fees_reason)); ?></textarea>
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