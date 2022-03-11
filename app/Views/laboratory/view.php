<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="#"> <i class="fa fa-plus"></i> Add laboratory Sale</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("/laboratory/request") ?>"> <i class="fa fa-list"></i> laboratory List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">laboratory Information</a>
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
                                    <dt>laboratory</dt><dd><?php echo esc($diagnosis->laboratory) ?></dd>
                                    <dt>Status</dt><dd><?php echo esc($laboratory[0]->status==1?'Served':'Not Served') ?></dd>
                                    <dt>Served By</dt>
                                    <dd>
                                        <?php
                                            $staff = $staff->where('id', $laboratory[0]->served_by)->select('firstname, lastname')->find();

                                            if(!$staff) {
                                                echo 'N/A';
                                            } else {
                                                echo $staff[0]->firstname . ' ' . $staff[0]->lastname;
                                            }
                                        ?>
                                       
                                    </dd>
                                    <dt>laboratory Note</dt><dd><?php echo esc($laboratory[0]->note) ?></dd>
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

                    <!-- laboratory -->
                    <div role="tabpanel" class="tab-pane" id="laboratory">
                        laboratory
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
