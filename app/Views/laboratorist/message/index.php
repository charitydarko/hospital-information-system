<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("laboratorist/message/add") ?>"> <i class="fa fa-paper-plane"></i>  New Message </a>
                    <a class="btn btn-primary" href="<?php echo base_url("laboratorist/message/sent") ?>"> <i class="fa fa-share"></i>  Sent </a>
                </div>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th> 
                            <th>Status</th> 
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($messages)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($messages as $message) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td>
                                        <?php
                                            $message_sender = $user->find($message->sender_id);
                                            echo $message_sender->firstname . ' ' . $message_sender->lastname; 
                                        ?>
                                    </td>
                                    <td><?php echo esc($message->subject); ?></td>
                                    <td><?php echo esc(character_limiter(strip_tags($message->message),50)); ?></td>
                                    <td><?php echo date('d M Y h:i:s a', strtotime(esc($message->created_at))); ?></td>  
                                    <td><?php echo ((esc($message->receiver_status) == 0) ? "<i class='label label-warning'>not seen</label>" : "<i class='label label-success'>seen</label>"); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?php echo base_url("laboratorist/message/inbox_information_inbox/$message->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
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
 
 