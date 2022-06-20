<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/receptionist/patient/new") ?>"> <i class="fa fa-plus"></i> Add Patient</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("receptionist/patient") ?>"> <i class="fa fa-list"></i> Patient List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Patient Information</a>
                    </li>
                    <li role="presentation">
                        <a href="#documents" aria-controls="documents" role="tab" data-toggle="tab">Documents</a>
                    </li>
                    <li role="presentation">
                        <a href="#history" aria-controls="history" role="tab" data-toggle="tab">History</a>
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
                                    <dt>Patient Code</dt><dd><?php echo esc($patient->registration_code) ?></dd> 
                                    <dt>Name</dt><dd><?php echo esc($patient->firstname. ' ' . $patient->lastname) ?></dd> 
                                    <dt>Age</dt><dd><?php echo esc($patient->age); ?> Years</dd> 
                                    <dt>Gender</dt>
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
                                    <dt>Phone</dt><dd><?php echo esc($patient->phone) ?></dd>
                                    <dt>Email</dt><dd><?php echo esc($patient->email) ?></dd> 
                                    <dt>Address</dt><dd><?php echo esc($patient->address) ?></dd> 
                                    <dt>Created Date</dt><dd>
                                        <?php
                                            $date = new DateTime($patient->updated_at);
                                            $strip = $date->format('Y-m-d');
                                            echo $strip;
                                        ?>
                                    </dd>
                                </dl> 
                            </div>
                        </div>
                    </div> 

                    <!-- DOCUMENT -->
                    <div role="tabpanel" class="tab-pane" id="documents">
                        <div class="row">
                            <div class="col-sm-12">
                                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Uploaded By</th>
                                            <th class="no-print">Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($documents)) { ?>
                                            <?php $sl = 1; ?>
                                            <?php foreach ($documents as $document) { ?>
                                                <tr>
                                                    <td><?php echo $sl; ?></td>
                                                    <td>
                                                        <?php
                                                            switch($document->category) {
                                                                case("0"): {
                                                                    echo "Other";
                                                                    break;
                                                                }
                                                                case("2"): {
                                                                    echo "Lab Report";
                                                                }
                                                            }
                                                        ?>
                                                    </td> 
                                                    <td>
                                                        <?php
                                                            if ($document->description) {
                                                                echo esc(character_limiter(strip_tags($document->description),50)); 
                                                            } else echo "N/A "
                                                        ?>
                                                    </td>
                                                    <td><?php echo date('d-m-Y',strtotime($document->date)); ?></td> 
                                                    <td>
                                                        <?= $staff->find($document->upload_by)->firstname; ?>
                                                        <?= $staff->find($document->upload_by)->lastname; ?>
                                                    </td> 
                                                    <td class="center no-print" width="110"> 
                                                    <a target="_blank" href="<?php echo base_url('./uploads/patient/documents/'.$document->hidden_attach_file) ?>" class="btn btn-xs btn-info" title="View Patient Document"><i class="fa fa-eye"></i></a>

                                                        <a href="<?php echo base_url("receptionist/patient/add_document/$document->patient_id") ?>" class="btn btn-xs btn-warning" title="Add Patient Document"><i class="fa fa-plus"></i></a>

                                                        <a download target="_blank" href="<?= base_url('./uploads/patient/documents/'.$document->hidden_attach_file) ?>" class="btn btn-xs btn-success" title="Download Patient Document"><i class="fa fa-download"></i></a>

                                                        <a href="<?php echo base_url("receptionist/patient/document_delete/$document->id?file=$document->hidden_attach_file") ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?') " title="Delete Patient Document"><i class="fa fa-trash"></i></a> 
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

                    <!-- HISTORY -->
                    <div role="tabpanel" class="tab-pane" id="history">
                        <div class="row">
                            <!--  table area -->
                            <div class="col-sm-12">
                                <div  class="panel panel-default thumbnail">
                        
                                    <div class="panel-heading no-print">
                                        <div class="btn-group"> 
                                            <a class="btn btn-success" href="<?php echo base_url("/receptionist/appointment/add") ?>"> <i class="fa fa-plus"></i>  Add Appointment </a>  
                                        </div>
                                    </div> 
                                    <div class="panel-body">
                                        <table width="100%" class="datatable table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>Appointment Code</th>
                                                    <th>Patient Code</th>
                                                    <th>Note</th>
                                                    <th>Created By</th>
                                                    <th>Created At</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($appointments)) { ?>
                                                    <?php $sl = 1; ?>
                                                    <?php foreach ($appointments as $appointment) { ?>
                                                        <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                                            <td><?= $sl; ?></td>
                                                            <td><?= esc($appointment->appointment_id); ?></td>
                                                            <td><?= esc($appointment->patient_id); ?></td>
                                                            <td><?= esc(character_limiter(strip_tags($appointment->note))); ?></td>
                                                            <td>
                                                                <?= $staff->find($appointment->created_by)->firstname; ?>
                                                                <?= $staff->find($appointment->created_by)->lastname; ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    $date = new DateTime($appointment->created_at);
                                                                    $strip = $date->format('Y-m-d');
                                                                    echo $strip;
                                                                ?>
                                                            </td>
                                                            <td><?php echo esc($appointment->status==1?'Active':'Inactive'); ?></td>
                                                            <td class="center">
                                                                <a href="<?=site_url("/receptionist/appointment/view/".$appointment->appointment_id)?>" class="btn btn-xs btn-success" title="View Patient Appointment"><i class="fa fa-eye"></i></a>

                                                                <a href="<?=site_url("/receptionist/vitals/add/".$appointment->appointment_id)?>" class="btn btn-xs btn-warning" title="Add Patient Vitals"><i class="fa fa-heart-pulse"></i></a> 

                                                                <a href="<?=site_url("/receptionist/appointment/edit/".$appointment->appointment_id)?>" class="btn btn-xs btn-primary" title="Edit Patient Appointment"><i class="fa fa-edit"></i></a> 

                                                                <a href="<?=site_url("/receptionist/appointment/delete/".$appointment->appointment_id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" title="Delete Patient Appointment"><i class="fa fa-trash"></i></a> 
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
        </div>
    </div>
  
</div>
