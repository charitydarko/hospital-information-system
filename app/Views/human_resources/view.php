<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?=base_url("/humanresources/employee/add") ?>"> <i class="fa fa-plus"></i> Add Employee</a>  
                    <a class="btn btn-primary" href="<?= base_url("/humanresources/employee/") ?>"> <i class="fa fa-list"></i> Employee List</a>  
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
                                    <dt>Employee Name</dt><dd><?php echo esc($employee->firstname. ' ' . $employee->lastname) ?></dd> 
                                    <dt>Date of Birth</dt><dd><?php echo date('d M Y',strtotime(esc($employee->date_of_birth))) ?></dd> 
                                    <dt>Age</dt><dd><?php echo date_diff(date_create(esc($employee->date_of_birth)), date_create('now'))->y; ?> Years</dd> 
                                    <dt>Gender</dt>
                                    <dd>
                                    <?php 
                                        switch($employee->gender) {
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
                                    <dt>Mobile</dt><dd><?php echo esc($employee->mobile) ?></dd>
                                    <dt>Email</dt><dd><?php echo esc($employee->email) ?></dd> 
                                    <dt>Address</dt><dd><?php echo esc($employee->address) ?></dd> 
                                    <dt>Created Date</dt><dd><?php echo esc($employee->created_at) ?></dd>
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
                                            <th>Doctor Name</th>
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
                                                    <td><?php echo esc($document->doctor_name); ?></td>
                                                    <td><?php echo esc(character_limiter(strip_tags($document->description),50)); ?></td>
                                                    <td><?php echo date('d-m-Y',strtotime($document->date)); ?></td> 
                                                    <td><?php echo esc($document->upload_by); ?></td> 
                                                    <td class="center no-print" width="110"> 
                                                        <a target="_blank" href="<?php echo base_url($document->hidden_attach_file) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo base_url("patient/document_form/$document->patient_id") ?>" class="btn btn-xs btn-warning" title="Add Document"><i class="fa fa-plus"></i></a> 
                                                        <a download target="_blank" href="<?php echo base_url($document->hidden_attach_file) ?>" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
                                                        <a href="<?php echo base_url("patient/document_delete/$document->id?file=$document->hidden_attach_file") ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?') "><i class="fa fa-trash"></i></a> 
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
                      History
                    </div>
                </div>  
            </div> 
        </div>
    </div>
  
</div>
