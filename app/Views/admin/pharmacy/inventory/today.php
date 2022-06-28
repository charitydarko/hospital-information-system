
<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("admin/pharmacy/inventory/sale") ?>"> <i class="fa fa-plus"></i>  Add Prescription Sale </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Appointment Code</th>
                            <th>Patient Code</th>
                            <th>Total Bill(GH¢)</th>
                            <th>Served By</th>
                            <th>Served On</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($billings_today)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($billings_today as $billing) { ?>
                                <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?= $sl; ?></td>
                                    <td><?= esc($billing->appointment_id); ?></td>
                                    <td>
                                        <?php 
                                            $appointment = $appointments->find($billing->appointment_id);
                                            echo esc($appointment->patient_id);
                                        ?>
                                    </td>
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
                                        <a href="<?=site_url("admin/pharmacy/inventory/view/".$billing->id)?>" class="btn btn-xs btn-success" title="View Pharmacy Sale"><i class="fa fa-eye"></i></a>
                                        <a href="<?=site_url("admin/pharmacy/inventory/edit/".$billing->id)?>" class="btn btn-xs btn-primary" title="Edit Pharmacy Sale"><i class="fa fa-edit"></i></a> 
                                        <a href="<?=site_url("admin/pharmacy/inventory/delete/".$billing->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')" title="Delete Pharmacy Sale"><i class="fa fa-trash"></i></a> 
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

