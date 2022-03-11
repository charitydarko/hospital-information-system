<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/vitals/add") ?>"> <i class="fa fa-plus"></i>  Add Vitals </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Appointment Code</th>
                            <th>Patient Code</th>
                            <th>Patient Name</th>
                            <th>Blood Pressure(mmHg)</th>
                            <th>Pulse(bpm)</th>
                            <th>Height(cm)</th>
                            <th>Weight(kg)</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($vitals)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($vitals as $vital) { ?>
                                <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?= $sl; ?></td>
                                    <td><?= esc($vital->appointment_id); ?></td>
                                    <td>
                                        <?php 
                                            $appointment = $appointments->find($vital->appointment_id);
                                            echo esc($appointment->patient_id);
                                        ?>
                                    </td>
                                    <td>
                                        <input type="hidden" name="patient_registration_code" value="<?php $appointment->patient_id ?>">
                                        <?php 
                                            $patient = $patients->where('registration_code', $appointment->patient_id)->select('firstname, lastname, gender, phone, mobile, address, age, status')->find();
                                            echo esc($patient[0]->firstname) . ' ' . esc($patient[0]->lastname);
                                        ?>
                                    </td>
                                    <td><?= esc($vital->blood_pressure); ?></td>
                                    <td><?= esc($vital->pulse); ?></td>
                                    <td><?= esc($vital->height); ?></td>
                                    <td><?= esc($vital->weight); ?></td>
                                    <td>
                                        <?= $staff->find($vital->created_by)->firstname; ?>
                                        <?= $staff->find($vital->created_by)->lastname; ?>
                                    </td>
                                    <td><?= esc($vital->created_at); ?></td>
                                    <td class="center">
                                        <a href="<?=site_url("/vitals/view/".$vital->id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                        <a href="<?=site_url("/diagnosis/add/".$vital->id)?>" class="btn btn-xs btn-warning"><i class="fa ti-book"></i></a> 
                                        <a href="<?=site_url("/vitals/edit/".$vital->id)?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?=site_url("/vitals/delete/".$vital->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a> 
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

