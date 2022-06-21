<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?php echo base_url("cashier/message/") ?>"> <i class="fa fa-inbox"></i>  Inbox</a>
                    <a class="btn btn-info" href="<?php echo base_url("cashier/message/sent") ?>"> <i class="fa fa-share"></i>  Sent </a>
                </div> 
            </div>

            <div class="panel-body  panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">

                        <form action="/cashier/message/create" method="post" >
                            <?= csrf_field() ?>

                            <div class="form-group row">
                                <label for="receiver_id" class="col-xs-3 col-form-label">Receiver Name <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <select name="receiver_id" class="form-control" id="receiver_id">
                                        <option value="">Please Select</option>
                                        <?php 
                                            foreach($user_list as $user)  { ?>
                                                <?php 
                                                    if($user->id == session()->get('id')) {
                                                        continue; 
                                                    }
                                                ?>
                                                <option value="<?= $user->id; ?>"> <?= $user->firstname . ' ' . $user->lastname; ?> </option>
                                           <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject" class="col-xs-3 col-form-label">Subject <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="subject"  type="text" class="form-control" id="subject" placeholder="Subject" value="">
                                    <input name="sender_id"  type="hidden" class="form-control" id="sender_id" value="<?= session()->get('id') ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="message" class="col-xs-3 col-form-label">Message <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <textarea name="message" class="form-control tinymce"  placeholder="Message"  rows="7"></textarea>
                                </div>
                            </div>  
                            
                            <div class="form-group row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="ui buttons">
                                        <button type="reset" class="ui button">Reset</button>
                                        <div class="or"></div>
                                        <button class="ui positive button">Send</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>