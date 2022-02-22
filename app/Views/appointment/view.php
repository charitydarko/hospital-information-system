<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/appointment/add") ?>"> <i class="fa fa-plus"></i> Add Appointment</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("appointment") ?>"> <i class="fa fa-list"></i> Appointment List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Appointment Information</a>
                    </li>
                    <li role="presentation">
                        <a href="#vitals" aria-controls="vitals" role="tab" data-toggle="tab">Vitals</a>
                    </li>
                    <li role="presentation">
                        <a href="#diagnosis" aria-controls="diagnosis" role="tab" data-toggle="tab">Diagnosis</a>
                    </li>
                    <li role="presentation">
                        <a href="#prescription" aria-controls="prescription" role="tab" data-toggle="tab">Prescription</a>
                    </li>
                    <li role="presentation">
                        <a href="#laboratory" aria-controls="laboratory" role="tab" data-toggle="tab">Laboratory</a>
                    </li>
                    <li role="presentation">
                        <a href="#billing" aria-controls="billing" role="tab" data-toggle="tab">Billing</a>
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
                                    <dt>Appointment Code</dt><dd><?php echo esc($appointment->id) ?></dd>
                                    <dt>Appointment Note</dt><dd><?php echo esc(character_limiter(strip_tags($appointment->note))) ?></dd>  
                                    <dt>Patient Code</dt><dd><?php echo esc($appointment->patient_id) ?></dd>
                                    <dt>Patient Name</dt><dd><?= $patient->firstname . ' ' . $patient->lastname ?></dd>
                                    <dt>Patient Age</dt><dd><?= $patient->age ?></dd>
                                    <dt>Patient Gender</dt>
                                    <dd>
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
                                    </dd>
                                    <dt>Patient Phone</dt>
                                    <dd>
                                        <?php 
                                            echo($patient->phone); 
                                            if($patient->mobile) {
                                                echo(' | ' . $patient->mobile);
                                            }
                                        ?>
                                    </dd>
                                    <dt>Patient Address</dt><dd><?= $patient->address ?></dd>
                                    <dt>Appointment Status</dt><dd><?= esc($patient->status==1?'Active':'Inactive') ?></dd>                                   
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
