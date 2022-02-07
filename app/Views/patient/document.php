<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group">
                    <a class="btn btn-success" href="<?php echo base_url("patient/add_document/") ?>"> <i class="fa fa-plus"></i> Add Document</a>  
                </div>
            </div>

            <div class="panel-body"> 

                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Patient Id</th>
                            <th>Doctor Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Upload By</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($documents)) { ?>
                            <?php $sl = 1; ?>
                            <?php foreach ($documents as $document) { ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($document->patient_id); ?></td>
                                    <td><?php echo html_escape($document->doctor_name); ?></td>
                                    <td><?php echo html_escape(character_limiter(strip_tags($document->description),50)); ?></td>
                                    <td><?php echo html_escape($document->date); ?></td> 
                                    <td><?php echo html_escape($document->upload_by); ?></td> 
                                    <td class="center" width="80">
                                        <a target="_blank" href="<?php echo base_url($document->hidden_attach_file) ?>" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                                        <a download href="<?php echo base_url($document->hidden_attach_file) ?>" class="btn btn-xs btn-success"><i class="fa fa-download"></i></a>
                                        <a href="<?php echo base_url("patient/document_delete/$document->id?file=$document->hidden_attach_file") ?>" class="btn btn-xs btn-danger" onclick="return confirm('<?php echo display('are_you_sure') ?>') "><i class="fa fa-trash"></i></a> 
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
 
 