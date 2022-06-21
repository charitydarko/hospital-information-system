<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Registration Code</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                            <th>Created Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patients)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($patients as $patient) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo esc($patient->registration_code); ?></td>
                                    <td><?php echo esc($patient->firstname); ?></td>
                                    <td><?php echo esc($patient->lastname); ?></td>
                                    <td><?php echo esc($patient->age); ?></td>
                                    <td>
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
                                    </td>
                                    <td><?php echo esc($patient->phone); ?></td>
                                    <td><?php echo esc($patient->address); ?></td>
                                    <td class="center">
                                        <a href="<?=site_url("/laboratorist/patient/view/".$patient->registration_code)?>" class="btn btn-xs btn-success"><i class="fa fa-eye" title="View Patient Info"></i></a>
                                    </td>
                                    <td>
                                        <?php
                                            $date = new DateTime($patient->updated_at);
                                            $strip = $date->format('Y-m-d');
                                            echo $strip;
                                        ?>
                                    </td>
                                    
                                    <td><?php echo esc($patient->status==1?'Active':'Inactive'); ?></td>
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

