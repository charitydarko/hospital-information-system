<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?=base_url("accountant/message/add") ?>"> <i class="fa fa-paper-plane"></i> New Message</a>  
                    <a class="btn btn-primary" href="<?= base_url("accountant/message/") ?>"> <i class="fa fa-inbox"></i> Inbox</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Message Information</a>
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
                                    <dt>Receiver</dt><dd>
                                        <?php 
                                            $message_sender = $user->find($message->receiver_id);
                                            echo $message_sender->firstname . ' ' . $message_sender->lastname;
                                        ?>
                                    </dd> 
                                    <dt>Subject</dt><dd><?php echo strip_tags($message->subject) ?></dd>
                                    <dt>Message</dt><dd><?php echo strip_tags($message->message) ?></dd> 
                                    <dt>Date</dt><dd><?php echo esc($message->created_at) ?></dd>
                                </dl> 
                            </div>
                        </div>
                    </div> 
                </div>  
            </div> 
        </div>
    </div>
  
</div>
