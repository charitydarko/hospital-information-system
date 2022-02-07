<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail"> 

            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("patient/document") ?>"> <i class="fa fa-list"></i> Document List</a>  
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div id="output" class="hide alert"></div>

                    <div class="col-md-9 col-sm-12">

                        <?php echo form_open_multipart('patient/document_form','class="form-inner" id="mailForm" ') ?>

                            <div class="form-group row">
                                <label for="patient_id" class="col-xs-3 col-form-label">Patient Id <i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input name="patient_id"  type="text" class="form-control" id="patient_id" placeholder="Patient Id" value="<?php echo $uri ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="attach_file" class="col-xs-3 col-form-label">Attach File<i class="text-danger">*</i></label>
                                <div class="col-xs-9">
                                    <input type="file" name="attach_file" id="attach_file">

                                    <input type="hidden" name="hidden_attach_file" id="hidden_attach_file" value="">

                                    <p id="upload-progress" class="hide alert"></p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="doctor_id" class="col-xs-3 col-form-label">Doctor Name</label>
                                <div class="col-xs-9">
                                    <?php echo form_dropdown('doctor_id',$doctor_list,esc(''),'class="form-control" id="doctor_id"') ?>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label for="description" class="col-xs-3 col-form-label">Description</label>
                                <div class="col-xs-9">
                                    <textarea name="description" class="form-control tinymce"  placeholder="Description"  rows="7"></textarea>
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

                        <?php echo form_close() ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/admin/patient_document.js') ?>" type="text/javascript"></script>