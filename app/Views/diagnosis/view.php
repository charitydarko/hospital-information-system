<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/vitals") ?>"> <i class="fa fa-plus"></i> Add Diagnosis</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("diagnosis") ?>"> <i class="fa fa-list"></i> Diagnosis List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Diagnosis Information</a>
                    </li>

                </ul>  

                <!-- Tab panes --> 
                <div class="col-xs-12 tab-content">
                    <br>
                    <!-- INFORMATION -->
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="col-sm-9"> 
                                <dl class="dl-horizontal">
                                    <dt>Patient Name</dt><dd><?= $patient[0]->firstname . ' ' . $patient[0]->lastname ?></dd>
                                    <dt>Patient Age</dt><dd><?= $patient[0]->age ?></dd>
                                    <dt>Patient Gender</dt>
                                    <dd>
                                        <?php 
                                            switch($patient[0]->gender) {
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
                                    </dd>
                                    <dt>Appointment Code</dt><dd><?= esc($appointment->id) ?></dd>
                                    <dt>Patient Code</dt><dd><?php echo esc($appointment->patient_id) ?></dd>
                                    <dt>Blood Pressure</dt><dd><?= esc($vital->blood_pressure)?>mmHg</dd> 
                                    <dt>Pulse</dt><dd><?= esc($vital->pulse)?>bpm</dd>
                                    <dt>Height</dt><dd><?= esc($vital->height)?>cm</dd>
                                    <dt>Weight</dt><dd><?= esc($vital->height)?>kg</dd>
                                    <dt>Note from Vitals</dt><dd><?= strip_tags($vital->note)?></dd>
                                    <dt>Complain</dt><dd><?= strip_tags($diagnosis->complain)?></dd>
                                    <dt>Diagnosis</dt><dd><?= strip_tags($diagnosis->diagnosis)?></dd>
                                    <dt>Prescription</dt><dd><?= strip_tags($diagnosis->prescription)?></dd>
                                    <dt>Visiting Fees</dt><dd><?= strip_tags($diagnosis->visiting_fees)?></dd>
                                    <dt>Visiting Fees Reason</dt><dd><?= strip_tags($diagnosis->visiting_fees_reason)?></dd>
                                </dl> 
                            </div>
                        </div>
                    </div> 

                    <!-- Vitals -->
                    <div role="tabpanel" class="tab-pane" id="vitals">
                        <div class="row">
                            <div class="col-sm-12">
                                Vitals
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div role="tabpanel" class="tab-pane" id="diagnosis">
                        Diagnosis
                    </div>

                    <!-- Prescription -->
                    <div role="tabpanel" class="tab-pane" id="prescription">
                        Prescription
                    </div>

                    <!-- Laboratory -->
                    <div role="tabpanel" class="tab-pane" id="laboratory">
                        Laboratory
                    </div>

                    <!-- Billing -->
                    <div role="tabpanel" class="tab-pane" id="billing">
                        Billing
                    </div>

                </div>  

            </div> 

            <!-- <div class="panel-footer">
                <div class="text-center">
                    <strong><?php #echo esc($this->session->userdata('title')); ?></strong>
                    <p class="text-center"><?php #echo esc($this->session->userdata('address')); ?></p>
                </div>
            </div> -->
        </div>
    </div>
  
</div>
