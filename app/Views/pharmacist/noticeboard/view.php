<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?= base_url("pharmacist/noticeboard/") ?>"> <i class="fa fa-list"></i> Notice List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Notice Information</a>
                    </li>
                </ul>  

                <!-- Tab panes --> 
                <div class="col-xs-12 tab-content">
                    <br>
                    <!-- INFORMATION -->
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="col-sm-9"> 
                                <dl class="dl-horizontal">
                                    <dt>Notice Title</dt><dd><?php echo esc($notice->title) ?></dd> 
                                    <dt>Description</dt><dd><?php echo strip_tags($notice->description) ?></dd> 
                                    <dt>Start Date</dt><dd><?php echo esc($notice->start_date) ?></dd>
                                    <dt>End Date</dt><dd><?php echo esc($notice->end_date) ?></dd>  
                                    <dt>Created By</dt>
                                    <dd>
                                        <?= $staff->find($notice->created_by)->firstname; ?>
                                        <?= $staff->find($notice->created_by)->lastname; ?>
                                    </dd>
                                    <dt>Status</dt><dd><?= ((esc($notice->status)==1)?'Active':'Inactive'); ?></dd> 
                                </dl> 
                            </div>
                        </div>
                    </div> 
                </div>  
            </div> 
        </div>
    </div>
  
</div>
