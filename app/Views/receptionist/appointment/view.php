<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/receptionist/appointment/add") ?>"> <i class="fa fa-plus"></i> Add Appointment</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("receptionist/appointment") ?>"> <i class="fa fa-list"></i> Appointment List</a>  
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
                                    <dt>Appointment Code:</dt><dd><?php echo esc($appointment->appointment_id) ?></dd>
                                    <dt>Appointment Note:</dt><dd><?php echo strip_tags($appointment->note) ?></dd>  
                                    <dt>Patient Code:</dt><dd><?php echo esc($appointment->patient_id) ?></dd>
                                    <dt>Patient Name:</dt><dd><?= $patient->firstname . ' ' . $patient->lastname ?></dd>
                                    <dt>Patient Gender:</dt> 
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
                                    <dt>Patient Age:</dt><dd><?= $patient->age ?></dd>
                                    <dt>Patient Date of Birth:</dt><dd><?= $patient->date_of_birth ?></dd>
                                    <dt>Patient Phone:</dt>
                                    <dd>
                                        <?php 
                                            echo($patient->phone); 
                                            if($patient->mobile) {
                                                echo(' | ' . $patient->mobile);
                                            }
                                        ?>
                                    </dd>
                                    <dt>Patient Address:</dt><dd><?= $patient->address ?></dd>
                                    <dt>Appointment Status:</dt><dd><?= esc($patient->status==1?'Active':'Inactive') ?></dd>                                   
                                </dl> 
                            </div>
                        </div>
                    </div> 

                    <!-- Vitals -->
                    <div role="tabpanel" class="tab-pane" id="vitals">
                        <div class="row">
                            <div class="col-sm-12">
                                <dl class="dl-horizontal">
                                    <dt>Blood Pressure:</dt><dd>
                                        <?php 
                                            if($vital) 
                                            {  
                                                echo esc($vital["0"]->blood_pressure); 
                                            } else echo "N/A ";
                                        ?>mmHg</dd> 
                                    <dt>Pulse:</dt><dd>
                                        <?php 
                                            if($vital) 
                                            {
                                                echo esc($vital["0"]->pulse);
                                            } else echo "N/A ";
                                        ?>bpm</dd>
                                    <dt>Height:</dt><dd>
                                        <?php if($vital) 
                                        {
                                            echo esc($vital["0"]->height);
                                        } else echo "N/A "
                                    ?>cm</dd>
                                    <dt>Weight:</dt><dd>
                                        <?php if($vital) 
                                        {
                                            echo esc($vital["0"]->height);
                                        } else echo "N/A "
                                    ?>kg</dd>
                                    <dt>Note:</dt><dd>
                                        <?php if($vital) 
                                        {
                                            echo strip_tags($vital["0"]->note);
                                        } else echo "N/A "
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
