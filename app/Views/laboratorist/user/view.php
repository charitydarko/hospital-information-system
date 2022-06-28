<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail"> 
        
            <div class="panel-heading no-print">
                 <div class="btn-group">
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-success" ><i class="fa fa-print"></i></button>            
                    <a href="<?= base_url("laboratorist/user/edit/".session()->get('id'))?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> 
                </div>
            </div>


            <div class="panel-body">  
                <div class="row">
                    <div class="col-sm-12" align="center">  
                    <br>
                    </div>

                    <div class="col-sm-4" align="center"> 
                        <img alt="Picture" src="<?= base_url("/images/no-img.png"); ?>" class="img-responsive img-hw-200" >
                        <h3>
                            <?php echo esc($user->firstname. ' ' . $user->lastname) ?> 
                            (
                                <?php 
                                    switch($user->user_role) {
                                        case '1':
                                            {echo 'Admin'; break;}
                                        case '2':
                                            {echo 'Doctor'; break;}
                                        case '3':
                                            {echo 'Accountant'; break;}
                                        case '4':
                                            {echo 'Cashier'; break;}
                                        case '5':
                                            {echo 'Pharmacist'; break;}
                                        case '6':
                                            {echo 'Laboratorist'; break;}
                                        case '7':
                                            {echo 'Receptionist'; break;}
                                        default:
                                            {echo 'Not provided'; break;}
                                    }
                                ?>
                            )
                        </h3>
                    </div> 

                    <div class="col-sm-8"> 
                        <dl class="dl-horizontal">
                        <?php if(!empty($user->email)) { ?>
                            <dt>Email</dt><dd><?= esc($user->email); ?></dd>
                        <?php } ?>

                        <?php if(!empty($user->address)) { ?>
                            <dt>Address</dt><dd><?= esc($user->address); ?></dd>
                        <?php } ?> 

                        <?php if(!empty($user->mobile)) { ?>
                            <dt>Mobile</dt><dd><?= esc($user->mobile); ?></dd>
                        <?php } ?> 
                        <?php if(!empty($user->phone)) { ?>
                            <dt>Phone</dt><dd><?= esc($user->phone); ?></dd>
                        <?php } ?> 
                        <?php if(!empty($user->gender)) { ?>
                            <dt>Gender</dt><dd>
                                <?php 
                                    switch($user->gender) {
                                        case '1':
                                            {echo 'Male'; break;}
                                        case '2':
                                            {echo 'Female'; break;}
                                        case '3':
                                            {echo 'Other'; break;}
                                        default:
                                            {echo 'Not provided'; break;}
                                    }
                                ?></dd>
                        <?php } ?> 
  
                        <?php if(!empty($user->created_at)) { ?>
                            <dt>Create Date</dt><dd>
                                <?php 
                                    $date = new DateTime($user->created_at);
                                    $strip = $date->format('Y-m-d');
                                    echo $strip;
                                ?></dd>
                        <?php } ?>  
  
                        <?php if(!empty($user->updated_at)) { ?>
                            <dt>Update Date</dt><dd><?php 
                                    $date = new DateTime($user->updated_at);
                                    $strip = $date->format('Y-m-d');
                                    echo $strip;
                                ?></dd>
                        <?php } ?>  
   
                        <?php if(!empty($user->status)) { ?>
                            <dt>Status</dt><dd><?php echo (!empty($user->status)?
                            'Active':'Inactive') ?></dd>
                        <?php } ?>  
                        </dl> 
                    </div>
                </div>  

            </div> 

            <div class="panel-footer">
                <div class="text-center">
                    <strong><?= HOSPITAL_TITLE ?><br> </strong>
                    <p class="text-center"><?= HOSPITAL_LOCATION ?></p>
                </div>
            </div>
        </div>
    </div>
 

</div>
