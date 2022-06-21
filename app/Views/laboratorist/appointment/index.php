<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
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
                                    <td><?= character_limiter(strip_tags($appointment->note)); ?></td>
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
                                        <a href="<?=site_url("/laboratorist/appointment/view/".$appointment->appointment_id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye" title="View Appointment"></i></a>
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

