<div class="row">
  <!--  form area -->
  <div class="col-sm-12">
    <div  class="panel panel-bd">
      <!--  Start heading area with blue buttons -->
      <div class="panel-heading no-print">
        <div class="btn-group m-t-10 m-b-5"> 
          <a class="btn btn-primary" href="<?= base_url("user/index/7") ?>">
            <i class="fa fa-list"></i> Receptionist List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/2") ?>">
            <i class="fa fa-list"></i> Doctor List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/5") ?>">
            <i class="fa fa-list"></i> Pharmacist List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/6") ?>">
            <i class="fa fa-list"></i> Laboratorist List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/4") ?>">
            <i class="fa fa-list"></i> Cashier List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/3") ?>">
            <i class="fa fa-list"></i> Accountant List
          </a>
        </div>
        <div class="btn-group m-t-10 m-b-5">
          <a class="btn btn-primary" href="<?= base_url("user/index/1") ?>">
            <i class="fa fa-list"></i> Admin List
          </a>
        </div>
      </div>
      <!--  End heading area with blue buttons -->
      
      <div class="panel-body panel-form">
        <div  class="row">
          <div class="col-md-9 col-sm-12">
            <form action="<?= base_url('user/create'); ?>" method="post">
              <?= csrf_field() ?>
              <div class="form-group row">
                <label for="user_role" class="col-xs-3 col-form-label">
                  User Role
                  <i class="text-danger">*</i>
                </label>
                <div class="col-xs-9">
                  <?php echo form_dropdown('user_role', $userRoles,esc('$user->user_role'), 'class="form-control" id="user_role" ');
                  ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="firstname" class="col-xs-3 col-form-label">
                  First Name
                <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="firstname" type="text" class="form-control" id="firstname" placeholder="" value="" >
                </div>
              </div>
              <div class="form-group row">
                <label for="lastname" class="col-xs-3 col-form-label">
                  Last Name
                <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-xs-3 col-form-label">
                  Email <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="email" class="form-control" type="email" placeholder=""  value="">
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-xs-3 col-form-label">
                  Password<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="password" class="form-control" type="password" placeholder="" id="password"/>
                </div>
              </div>

              <div class="form-group row">
                <label for="mobile" class="col-xs-3 col-form-label">
                  Mobile No.<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="mobile" class="form-control" type="number" placeholder="" id="mobile"  value="">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-xs-3">Gender</label>
                <div class="col-xs-9">
                  <div class="form-check">
                  <label class="radio-inline">
                  <input type="radio" name="gender" value="Male" <?php echo  esc(set_radio('gender', 'Male', TRUE)); ?> >Male
                  </label>
                  <label class="radio-inline">
                  <input type="radio" name="gender" value="Female" <?php echo  esc(set_radio('gender', 'Female')); ?> >Female
                  </label>
                  <label class="radio-inline">
                  <input type="radio" name="gender" value="Other" <?php echo  esc(set_radio('gender', 'Other')); ?> >Other
                  </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                      <label for="age" class="col-xs-3 col-form-label">Age<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="age" class="form-control" type="number" placeholder="Age" id="age" value="<?= old('age') ?>">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="date_of_birth" class="col-xs-3 col-form-label">Date of Birth</i></label>
                      <div class="col-xs-9">
                          <input name="date_of_birth" type="date" class="form-control" id="date_of_birth" placeholder="Date of birth" value="<?= old('date_of_birth') ?>">
                      </div>
                  </div>
              <div class="form-group row">
                <label for="picture" class="col-xs-3 col-form-label">Picture</label>
                <div class="col-xs-9">
                  <input type="file" name="picture" id="picture" value="">
                  <input type="hidden" name="old_picture" value="">
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-xs-3 col-form-label"> Address<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <textarea name="address" class="form-control" id="address" placeholder="" maxlength="140" rows="7"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-xs-3">Status</label>
                <div class="col-xs-9">
                  <div class="form-check">
                    <label class="radio-inline">
                      <input type="radio" name="status" value="1" <?php echo  esc(set_radio('status', '1', TRUE)); ?> />Active
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="status" value="0" <?php echo  esc(set_radio('status', '0')); ?> >Inactive
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-6">
                  <div class="ui buttons">
                    <button type="reset" class="ui button">Reset</button>
                    <div class="or"></div>
                    <button class="ui positive button">Add</button>
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