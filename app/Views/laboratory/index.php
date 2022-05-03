
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/vitals") ?>"> <i class="fa fa-plus"></i>  Add laboratorys Sales </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Appointment Code</th>
                            <th>Patient Code</th>
                            <th>laboratory</th>
                            <th>Requested By</th>
                            <th>Requested On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($diagnosis) && !empty($loadLaboratory)) { ?>
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
                                    <td><?= esc($diag->laboratory); ?></td>
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
                                    <td>
                                        <?php 
                                            $lab = $laboratory->where('diagnosis_id', $diag->id)->select('status')->find();
                                            echo esc($lab[0]->status==1?'Served':'Not Served')
                                        ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?=site_url("/laboratory/request/view/".$diag->id)?>" class="btn btn-xs btn-success" title="View Laboratory Request"><i class="fa fa-eye"></i></a>
                                        <a href="<?=site_url("/laboratory/request/edit/".$diag->id)?>" class="btn btn-xs btn-primary" title="Edit Laboratory Request"><i class="fa fa-edit"></i></a> 
                                        <a href="<?=site_url("/laboratory/request/delete/".$diag->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" title="Delete Laboratory Request"><i class="fa fa-trash"></i></a> 
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

