<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("human_resources/employee") ?>"> <i class="fa fa-plus"></i> Add Employee </a>   
                </div>
            </div> 


            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Picture</th>
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
                                    <td><img src="<?php echo (!empty($employee->picture) ? base_url(esc($employee->picture)) : base_url("assets/images/no-img.png")) ?>" width="65" height="50"/></td>
                                    <td><?php echo esc($employee['firstname']); ?></td>
                                    <td><?php echo esc($employee['lastname']); ?></td>
                                    <td><?php echo esc($employee['email']); ?></td>
                                    <td><?php echo esc($employee['phone']); ?></td>
                                    <td><?php echo esc($employee['address']); ?></td>
                                    <td><?php echo esc($employee['gender']); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php #echo base_url("human_resources/employee/profile/$employee['user_id']") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
                                        <a href="<?php #echo base_url("human_resources/employee/form/$employee->user_id") ?>" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a> 
                                        <a href="<?php #echo base_url("human_resources/employee/delete/$employee->user_id/$employee->user_role") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo 'Are you sure' ?>')"><i class="fa fa-trash"></i></a>
                                    </td> 
                                    <td><?php echo esc($userRoles[$employee['user_role']]) ?></td>
                                    <td><?php echo esc($employee['created_at']); ?></td>
                                    <td><?php echo ((esc($employee['status'])==1)?'active':'inactive'); ?></td>
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