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
                                <dl class="dl-horizontal">
                                    <dt>Blood Pressure</dt><dd><?= esc($vital->blood_pressure)?>mmHg</dd> 
                                    <dt>Pulse</dt><dd><?= esc($vital->pulse)?>bpm</dd>
                                    <dt>Height</dt><dd><?= esc($vital->height)?>cm</dd>
                                    <dt>Weight</dt><dd><?= esc($vital->height)?>kg</dd>
                                    <dt>Note</dt><dd><?= strip_tags($vital->note)?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis -->
                    <div role="tabpanel" class="tab-pane" id="diagnosis">
                        <dl class="dl-horizontal">
                            <dt>Complain</dt><dd><?= strip_tags($diagnosis[0]->complain)?></dd>
                            <dt>Diagnosis</dt><dd><?= strip_tags($diagnosis[0]->diagnosis)?></dd>
                            <dt>Prescription</dt><dd><?= strip_tags($diagnosis[0]->prescription)?></dd>
                            <dt>Visiting Fees</dt><dd><?= strip_tags($diagnosis[0]->visiting_fees)?></dd>
                            <dt>Visiting Fees Reason</dt><dd><?= strip_tags($diagnosis[0]->visiting_fees_reason)?></dd>
                        </dl> 
                    </div>

                    <!-- Prescription -->
                    <div role="tabpanel" class="tab-pane" id="prescription">
                        <dl class="dl-horizontal">
                            <dt>Prescription</dt><dd><?php echo esc($diagnosis[0]->prescription) ?></dd>
                            <dt>Status</dt><dd><?php echo esc($prescription[0]->status==1?'Served':'Not Served') ?></dd>
                            <dt>Served By</dt>
                            <dd>
                                <?php
                                    $staffp = $staff->where('id', $prescription[0]->served_by)->select('firstname, lastname')->find();

                                    if(!$staffp) {
                                        echo 'N/A';
                                    } else {
                                        echo $staffp[0]->firstname . ' ' . $staffp[0]->lastname;
                                    }
                                ?>
                            </dd>
                            <dt>Prescription Note</dt><dd><?php echo esc($prescription[0]->note) ?></dd>
                        </dl> 
                    </div>

                    <!-- Laboratory -->
                    <div role="tabpanel" class="tab-pane" id="laboratory">
                        <dl class="dl-horizontal">
                            <dt>laboratory</dt><dd><?php echo esc($diagnosis[0]->laboratory) ?></dd>
                            <dt>Status</dt><dd><?php echo esc($laboratory[0]->status==1?'Served':'Not Served') ?></dd>
                            <dt>Served By</dt>
                            <dd>
                                <?php
                                    $staffl = $staff->where('id', $laboratory[0]->served_by)->select('firstname, lastname')->find();

                                    if(!$staffl) {
                                        echo 'N/A';
                                    } else {
                                        echo $staffl[0]->firstname . ' ' . $staffl[0]->lastname;
                                    }
                                ?>
                            </dd>
                            <dt>laboratory Note</dt><dd><?php echo esc($laboratory[0]->note) ?></dd>
                        </dl> 
                    </div>

                    <!-- Billing -->
                    <div role="tabpanel" class="tab-pane" id="billing">
                        <div class="panel-body">
                            <table width="100%" class="datatable table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Total Bill(GH¢)</th>
                                        <th>Served By</th>
                                        <th>Served On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($billings)) { ?>
                                        <?php $sl = 1; ?>
                                        <?php foreach ($billings as $billing) { ?>
                                            <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                                <td><?= $sl; ?></td>
                                                <td><?= esc($billing->total); ?></td>
                                                <td>
                                                    <?php echo $staff->find($billing->served_by)->firstname; ?>
                                                    <?php echo $staff->find($billing->served_by)->lastname; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $date = new DateTime($billing->updated_at);
                                                        $strip = $date->format('Y-m-d');
                                                        echo $strip;
                                                    ?>
                                                </td>
                                                <td><?= ((esc($billing->status)==1)?'Paid':'Unpaid'); ?></td>
                                                <td class="center">
                                                    <a href="<?=site_url("billing/view/".$billing->id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                    <a href="<?=site_url("billing/edit/".$billing->id)?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                                    <a href="<?=site_url("billing/delete/".$billing->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a> 
                                                </td>
                                            </tr>
                                            <?php $sl++; ?>
                                        <?php } ?> 
                                    <?php } ?> 
                                </tbody>
                            </table>  <!-- /.table-responsive -->
                        </div>
                    </div>

                </div>  

            </div> 


        </div>
    </div>
  
</div>
