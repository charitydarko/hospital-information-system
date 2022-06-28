<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/doctor/appointment/add") ?>"> <i class="fa fa-plus"></i>  Add Appointment </a>  
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
                                    <td><?= esc($appointment->id); ?></td>
                                    <td><?= esc($appointment->patient_id); ?></td>
                                    <td>
                                        <?php
                                            if ($appointment->note) {
                                                echo character_limiter(strip_tags($appointment->note));
                                            } else echo "N/A";
                                        ?>
                                    </td>
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
                                        <a href="<?=site_url("/doctor/appointment/view/".$appointment->appointment_id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye" title="View Appointment"></i></a>
                                        <a href="<?=site_url("/doctor/vitals/add/".$appointment->appointment_id)?>" class="btn btn-xs btn-warning" title="Add Vitals"><i class="fa fa-heart-pulse"></i></a> 
                                        <a href="<?=site_url("/doctor/appointment/edit/".$appointment->appointment_id)?>" class="btn btn-xs btn-primary" title="Edit Appointment"><i class="fa fa-edit"></i></a> 
                                        <a href="<?=site_url("/doctor/appointment/delete/".$appointment->appointment_id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" title="Delete Appointment"><i class="fa fa-trash"></i></a> 
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

