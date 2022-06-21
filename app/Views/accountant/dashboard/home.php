<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?php echo (!empty($patients) ? esc($patients) : 0) ?></h3>
                <p>Patient</p>
            </div>
            <div class="icon">
                <i class="fa fa-wheelchair"></i>
            </div>
                <a href="<?= base_url("accountant/patient") ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?php echo (!empty($appointments) ? esc($appointments) : 0) ?></h3>
                <p>Appointment</p>
            </div>
            <div class="icon">
                <i class="fa fa-list-alt"></i>
            </div>
                <a href="<?= base_url("accountant/appointment") ?>" class="small-box-footer">More Info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading">
                <h3>Noticeboard</h3>
            </div>

            <div class="panel-body">
                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($notice)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($notice as $item) { ?>
                                <tr class="<?php echo ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo esc($item->title); ?></td>
                                    <td><?php echo strip_tags($item->description); ?></td>
                                    <td><?php echo esc($item->start_date); ?></td>
                                    <td><?php echo esc($item->end_date); ?></td>
                                    <td>
                                        <?= $staff->find($item->created_by)->firstname; ?>
                                        <?= $staff->find($item->created_by)->lastname; ?>
                                    </td>
                                    <td><?= ((esc($item->status)==1)?'Active':'Inactive'); ?></td>
                                    <td class="center" width="80">
                                        <a href="<?= site_url("accountant/noticeboard/view/".$item->id)?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
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

<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">
            <div class="panel-heading">
                <h3>Message</h3>
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
                                        <a href="<?php echo base_url("accountant/message/inbox_information_inbox/$message->id") ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a> 
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