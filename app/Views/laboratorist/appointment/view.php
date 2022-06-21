<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("laboratorist/appointment") ?>"> <i class="fa fa-list"></i> Appointment List</a>  
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

                    <!-- Diagnosis -->
                    <div role="tabpanel" class="tab-pane" id="diagnosis">
                        <dl class="dl-horizontal">
                            <dt>Complain</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo strip_tags($diagnosis[0]->complain);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Diagnosis</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo strip_tags($diagnosis[0]->diagnosis);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Prescription</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo strip_tags($diagnosis[0]->prescription);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Visiting Fees</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo strip_tags($diagnosis[0]->visiting_fees);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Visiting Fees Reason</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo strip_tags($diagnosis[0]->visiting_fees_reason);
                                    } else echo "N/A "
                                ?></dd>
                        </dl> 
                    </div>

                    <!-- Prescription -->
                    <div role="tabpanel" class="tab-pane" id="prescription">
                        <dl class="dl-horizontal">
                            <dt>Prescription</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo esc($diagnosis[0]->prescription);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Status</dt><dd>
                                <?php if($prescription) 
                                    {
                                        echo esc($prescription[0]->status==1?'Served':'Not Served');
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Served By</dt>
                            <dd>
                                <?php
                                    if($prescription){
                                        $staffp = $staff->where('id', $prescription[0]->served_by)->select('firstname, lastname')->find();

                                        if(!$staffp) {
                                            echo 'N/A';
                                        } else {
                                            echo $staffp[0]->firstname . ' ' . $staffp[0]->lastname;
                                        }
                                    } else echo "N/A "
                                ?>
                            </dd>
                            <dt>Prescription Note</dt><dd>
                                <?php if($prescription[0]->note !== "") 
                                    {
                                        echo strip_tags($prescription[0]->note);
                                    } else echo "N/A "
                                ?></dd>
                        </dl> 
                    </div>

                    <!-- Laboratory -->
                    <div role="tabpanel" class="tab-pane" id="laboratory">
                        <dl class="dl-horizontal">
                            <dt>Laboratory:</dt><dd>
                                <?php if($diagnosis) 
                                    {
                                        echo esc($diagnosis[0]->laboratory);
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Lab View:</dt><dd>
                            <?php if($laboratory[0]->attach_file !== "") { ?>
                                <a target="_blank" href="<?php echo base_url('./uploads/patient/laboratory/'.$laboratory[0]->attach_file) ?>" class="btn btn-xs btn-info" title="View Lab Document"><i class="fa fa-eye"></i></a>
                            <?php } else echo "N/A "?></dd>
                            <dt>Laboratory Fees:</dt><dd>
                                <?php if($laboratory[0]->fees !== "") 
                                    {
                                        echo esc($laboratory[0]->fees);
                                    } else echo "N/A "
                                ?>
                            </dd>
                            <dt>Lab Fees Reason:</dt><dd>
                            <?php if($laboratory[0]->fees_reason !== "") 
                                {
                                    echo esc($laboratory[0]->fees_reason);
                                } else echo "N/A "
                            ?></dd>
                            <dt>Status</dt><dd>
                                <?php 
                                    if($laboratory){
                                        echo esc($laboratory[0]->status ==1 ?'Served':'Not Served');
                                    } else echo "N/A "
                                ?></dd>
                            <dt>Served By</dt>
                            <dd>
                                <?php
                                    if($laboratory) {
                                    $staffl = $staff->where('id', $laboratory[0]->served_by)->select('firstname, lastname')->find();

                                    if(!$staffl) {
                                        echo 'N/A';
                                    } else {
                                        echo $staffl[0]->firstname . ' ' . $staffl[0]->lastname;
                                    }
                                } else echo "N/A "
                                ?>
                            </dd>
                            <dt>laboratory Note</dt><dd>
                                <?php if($laboratory[0]->note !== "") 
                                    {
                                        echo strip_tags($laboratory[0]->note);
                                    } else echo "N/A "
                                ?></dd>
                        </dl> 
                    </div>

                </div>  

            </div> 


        </div>
    </div>
  
</div>
