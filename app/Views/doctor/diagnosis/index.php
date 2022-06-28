<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/doctor/vitals") ?>"> <i class="fa fa-plus"></i>  Add Diagnosis </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Appointment Code</th>
                            <th>Patient Code</th>
                            <th>Visiting Fees</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($diagnosis)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($diagnosis as $diag) { ?>
                                <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?= $sl; ?></td>
                                    <td><?= esc($diag->appointment_id); ?></td>
                                    <td>
                                        <?php 
                                            $appointment = $appointments->find($diag->appointment_id);
                                            echo esc($appointment->patient_id);
                                        ?>
                                    </td>
                                    <td><?= esc($diag->visiting_fees); ?></td>
                                    <td><?php echo esc($appointment->status==1?'Active':'Inactive'); ?></td>
                                    <td>
                                        <?= $staff->find($diag->created_by)->firstname; ?>
                                        <?= $staff->find($diag->created_by)->lastname; ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = new DateTime($diag->updated_at);
                                            $strip = $date->format('Y-m-d');
                                            echo $strip;
                                        ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?=site_url("/doctor/diagnosis/view/".$diag->appointment_id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye" title="View Diagnosis"></i></a>
                                        <a href="<?=site_url("/doctor/diagnosis/edit/".$diag->appointment_id)?>" class="btn btn-xs btn-primary" title="Edit Diagnosis"><i class="fa fa-edit"></i></a>  
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

