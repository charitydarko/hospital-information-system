<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("admin/pharmacy/inventory/sale") ?>"> <i class="fa fa-plus"></i> Add Prescription Sale</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("admin/pharmacy/prescription/request") ?>"> <i class="fa fa-list"></i> Prescription List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Prescription Information</a>
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
                                    <dt>Appointment Code</dt><dd><?= esc($appointment->appointment_id) ?></dd>
                                    <dt>Patient Code</dt><dd><?php echo esc($appointment->patient_id) ?></dd>
                                    <dt>Prescription</dt><dd><?php echo esc($diagnosis->prescription) ?></dd>
                                    <dt>Status</dt><dd><?php echo esc($prescription[0]->status==1?'Served':'Not Served') ?></dd>
                                    <dt>Served By</dt>
                                    <dd>
                                        <?php
                                            $staff = $staff->where('id', $prescription[0]->served_by)->select('firstname, lastname')->find();

                                            if(!$staff) {
                                                echo 'N/A';
                                            } else {
                                                echo $staff[0]->firstname . ' ' . $staff[0]->lastname;
                                            }
                                        ?>
                                    </dd>
                                    <dt>Prescription Note</dt><dd>
                                        <?php
                                            if($prescription[0]->note) {
                                                echo esc($prescription[0]->note);
                                            } else echo 'N/A';
                                        ?></dd>
                                </dl> 
                            </div>
                        </div>
                    </div> 
                </div>  
            </div> 
        </div>
    </div>
  
</div>
