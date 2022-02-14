<div class="row">
  <!--  form area -->
  <div class="col-sm-12">
    <div  class="panel panel-default thumbnail">

        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="btn btn-primary" href="<?= site_url("/patient") ?>"> <i class="fa fa-list"></i> Patient List</a>  
            </div>
        </div> 


        <div class="panel-body panel-form">
          <div class="row">
              <div class="col-md-9 col-sm-12 ">
                <form action="/patient/create" method="post" >
                  <?= csrf_field() ?>
                  <div class="form-group row">
                      <label for="firstname" class="col-xs-3 col-form-label">First Name<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="firstname" type="text" value="" class="form-control" id="firstname" placeholder="First Name">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="lastname" class="col-xs-3 col-form-label">Last Name<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="lastname" type="text" value="" class="form-control" id="lastname" placeholder="Last Name">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="age" class="col-xs-3 col-form-label">Age<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="age" class="form-control" value="" type="number" placeholder="Age" id="age">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="date_of_birth" class="col-xs-3 col-form-label">Date of Birth</i></label>
                      <div class="col-xs-9">
                          <input name="date_of_birth" type="date" value="" class="form-control" id="date_of_birth" placeholder="Date of birth" value="">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="phone" class="col-xs-3 col-form-label">Phone No.<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                          <input name="phone" class="form-control" type="text" value="" placeholder="Phone No." id="phone">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="mobile" class="col-xs-3 col-form-label">Mobile No.</label>
                      <div class="col-xs-9">
                          <input name="mobile" class="form-control" type="text" value="" placeholder="Mobile No." id="mobile">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="email" class="col-xs-3 col-form-label">Email Address</label>
                      <div class="col-xs-9">
                          <input name="email" class="form-control" type="email" value="" placeholder="Email Address" id="email">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-xs-3">Gender</label>
                      <div class="col-xs-9">
                          <div class="form-check">
                              <label class="radio-inline">
                              <input type="radio" name="gender" value="Male" <?= set_radio('sex', '1', TRUE)?> >Male
                              </label>
                              <label class="radio-inline">
                              <input type="radio" name="gender" value="Female" <?= set_radio('sex', '2')?> >Female
                              </label>
                              <label class="radio-inline">
                              <input type="radio" name="gender" value="Other" <?= set_radio('sex', '3')?> >Other
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="town" class="col-xs-3 col-form-label">Town</label>
                      <div class="col-xs-9">
                        <input name="town" class="form-control" type="text" placeholder="Town" id="town">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="city" class="col-xs-3 col-form-label">City</label>
                      <div class="col-xs-9">
                        <input name="city" class="form-control" type="text" placeholder="City" id="city">
                      </div>
                  </div> 

                  <div class="form-group row">
                      <label for="region" class="col-xs-3 col-form-label">Region</label>
                      <div class="col-xs-9"> 
                          <?php
                              $regionList = array(
                                  ''   => 'Select Option',
                                  '1' => 'Northern Region',
                                  '2' => 'Ashanti Region',
                                  '3' => 'Western Region',
                                  '4' => 'Volta Region',
                                  '5' => 'Eastern Region',
                                  '6' => 'Upper West Region',
                                  '7' => 'Upper East Region',
                                  '8' => 'Central Region',
                                  '9' => 'Bono East Region',
                                  '10' => 'Greater Accra Region',
                                  '11' => 'Savannah Region',
                                  '12' => 'Oti Region',
                                  '13' => 'Western North Region',
                                  '14' => 'Ahafo Region',
                                  '15' => 'Bono East Region',
                                  '16' => 'North-East Region '
                              );
                              echo form_dropdown('region', $regionList, '', 'class="form-control" id="region" '); 
                          ?>
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="address" class="col-xs-3 col-form-label">Address<i class="text-danger">*</i></label>
                      <div class="col-xs-9">
                        <input name="address" class="form-control" type="text" value="" placeholder="Address" id="address">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="occupation" class="col-xs-3 col-form-label">Occupation</label>
                      <div class="col-xs-9">
                        <input name="occupation" class="form-control" type="text" value="" placeholder="Occupation" id="occupation">
                      </div>
                  </div> 

                  <div class="form-group row">
                    <label for="marital_status" class="col-xs-3 col-form-label">Marital Status</label>
                    <div class="col-xs-9"> 
                        <?php
                            $maritalStatusList = array(
                                ''   => 'Select Option',
                                '1' => 'Single',
                                '2' => 'Married',
                                '3' => 'Other'
                            );
                            echo form_dropdown('marital_status', $maritalStatusList, '', 'class="form-control" id="marital_status" '); 
                        ?>
                    </div>
                  </div>

                  <div class="form-group row">
                      <label for="religion" class="col-xs-3 col-form-label">Religion</label>
                      <div class="col-xs-9"> 
                          <?php
                              $religionList = array(
                                  ''   => 'Select Option',
                                  '1' => 'Christian',
                                  '2' => 'Muslim',
                                  '3' => 'Traditional',
                                  '4' => 'Other'
                              );
                              echo form_dropdown('religion', $religionList, '', 'class="form-control" id="religion" '); 
                          ?>
                      </div>
                    </div>


                  <div class="form-group row">
                    <label for="insurance_type" class="col-xs-3 col-form-label">Insurance Type</label>
                    <div class="col-xs-9">
                      <input name="insurance_type" class="form-control" type="text" value="" placeholder="Insurance Type" id="insurance_type">
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label for="insurance_number" class="col-xs-3 col-form-label">Insurance Number</label>
                    <div class="col-xs-9">
                      <input name="insurance_number" class="form-control" type="text" value=""  placeholder="Insurance Number" id="insurance_number">
                    </div>
                  </div> 

                  <div class="form-group row">
                    <label for="registration_code" class="col-xs-3 col-form-label">Registration Code<i class="text-danger">*</i></label>
                    <div class="col-xs-9">
                      <input name="registration_code" class="form-control" type="text" value="" placeholder="Registration Code" id="registration_code">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="emergency_contact_name" class="col-xs-3 col-form-label">Emergency Contact Name</label>
                    <div class="col-xs-9">
                      <input name="emergency_contact_name" class="form-control" type="text" value="" placeholder="Emergency Contact Name" id="emergency_contact_name">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="emergency_contact_phone" class="col-xs-3 col-form-label">Emergency Contact Phone</label>
                    <div class="col-xs-9">
                      <input name="emergency_contact_phone" class="form-control" type="text" value="" placeholder="Emergency Contact Phone" id="emergency_contact_phone">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="emergency_contact_address" class="col-xs-3 col-form-label">Emergency Contact Address</label>
                    <div class="col-xs-9">
                      <input name="emergency_contact_address" class="form-control" type="text" value="" placeholder="Emergency Contact Address" id="emergency_contact_address">
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
            <div class="col-md-3"></div>
          </div>
        </div>
    </div>
  </div>
</div>

 