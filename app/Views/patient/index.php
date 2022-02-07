<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("/patient/new") ?>"> <i class="fa fa-plus"></i>  Add Patient </a>  
                </div>
            </div> 
            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Id No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Action</th>
                            <th>Date of Birth</th>
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
                                    <td><?php echo esc($patient->id); ?></td>
                                    <td><?php echo esc($patient->firstname); ?></td>
                                    <td><?php echo esc($patient->lastname); ?></td>
                                    <td><?php echo esc($patient->email); ?></td>
                                    <td><?php echo esc($patient->phone); ?></td>
                                    <td><?php echo esc($patient->address); ?></td>
                                    <td>
                                      <?php 
                                        switch($patient->gender) {
                                          case '0':
                                            {echo 'Male'; break;}
                                          case '1':
                                            {echo 'Female'; break;}
                                          case '2':
                                            {echo 'Other'; break;}
                                          default:
                                            {echo 'Not provided'; break;}
                                        }
                                      ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?=site_url("/patient/profile/".$patient->id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?=site_url("/patient/edit/".$patient->id)?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 

                                        <a href="<?=site_url("/patient/add_document/".$patient->id)?>" class="btn btn-xs btn-warning" title="Add Patient Document"><i class="fa fa-plus"></i></a> 

                                        <a href="<?=site_url("/patient/delete/".$patient->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a> 
                                    </td>
                                    <td><?php echo esc($patient->date_of_birth); ?></td> 
                                    <td><?php echo esc($patient->created_at); ?></td>
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

