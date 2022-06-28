<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <h2>Reset Password</h2>
            </div> 

            <div class="panel-body panel-form">
                <div class="row">
                    <div class="col-md-9 col-sm-12">
                    <form action="<?= base_url('admin/user/update_password'); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label for="password" class="col-xs-3 col-form-label">Password <i class="text-danger">*</i></label>
                            <div class="col-xs-9">
                                <input name="password" type="text" class="form-control" id="password" placeholder="Password" required="required">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="ui buttons">
                                    <button type="reset" class="ui button">Reset</button>
                                    <div class="or"></div>
                                    <button class="ui positive button">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>

 