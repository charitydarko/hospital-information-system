<div class="row">
  <!--  form area -->
  <div class="col-sm-12">
    <div  class="panel panel-bd">
      <div class="panel-body panel-form">
        <div  class="row">
          <div class="col-md-9 col-sm-12">
            <form action=<?= base_url("laboratorist/user/update/".$user->id) ?> method="post">
              <?= csrf_field() ?>
              <div class="form-group row">
                <label for="firstname" class="col-xs-3 col-form-label">
                  First Name
                <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="firstname" type="text" class="form-control" id="firstname" placeholder="" value="<?= $user->firstname ?>" >
                </div>
              </div>
              <div class="form-group row">
                <label for="lastname" class="col-xs-3 col-form-label">
                  Last Name
                <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="" value="<?= $user->lastname ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-xs-3 col-form-label">
                  Email <i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="email" class="form-control" type="email" placeholder=""  value="<?= $user->email ?>">
                </div>
              </div>

              <div class="form-group row">
                <label for="mobile" class="col-xs-3 col-form-label">
                  Mobile No.<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="mobile" class="form-control" type="text" placeholder="" id="mobile"  value="<?= $user->mobile ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="mobile" class="col-xs-3 col-form-label">
                  Phone No.<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <input name="phone" class="form-control" type="text" placeholder="" id="phone"  value="<?= $user->phone ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="address" class="col-xs-3 col-form-label"> Address<i class="text-danger">*</i></label>
                <div class="col-xs-9">
                  <textarea name="address" class="form-control" id="address" placeholder="" maxlength="140" rows="7"><?= $user->address ?></textarea>
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
        </div>
      </div>
    </div>
  </div>
</div>