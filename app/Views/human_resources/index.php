<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?= base_url("humanresources/employee/add") ?>"> <i class="fa fa-plus"></i> Add Employee </a>   
                </div>
            </div> 


            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Gex</th>
                            <th>Action</th>
                            <th>User Role</th>
                            <th>Create Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($employees)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($employees as $employee) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo esc($employee->firstname); ?></td>
                                    <td><?php echo esc($employee->lastname); ?></td>
                                    <td><?php echo esc($employee->email); ?></td>
                                    <td><?php echo esc($employee->phone); ?></td>
                                    <td><?php echo esc($employee->address); ?></td>
                                    <td><?php echo esc($employee->gender); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?= site_url("/humanresources/employee/view/".$employee->id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?= site_url("/humanresources/employee/edit/".$employee->id)?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?= site_url("/humanresources/employee/delete/".$employee->id)?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo 'Are you sure' ?>')"><i class="fa fa-trash"></i></a>
                                    </td> 
                                    <td><?php
                                            switch($employee->user_role) {
                                                case 1:
                                                    echo "Admin";
                                                    break;
                                                case 2:
                                                    echo "Doctor";
                                                    break;
                                                case 3:
                                                    echo "Accountant";
                                                    break;
                                                case 4:
                                                    echo "Cashier";
                                                    break;
                                                case 5:
                                                    echo "Pharmacist";
                                                    break;
                                                case 6:
                                                    echo "Laboratorist";
                                                    break;
                                                case 7:
                                                    echo "Receptionist";
                                                    break;
                                                default:
                                                    echo "Unknown";
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    <td><?= esc($employee->created_at); ?></td>
                                    <td><?= ((esc($employee->status)==1)?'active':'inactive'); ?></td>
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