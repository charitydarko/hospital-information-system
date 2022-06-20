<div class="row">
    <!--  table area -->
    <div class="col-sm-12">
        <div class="panel panel-default thumbnail">

            <div class="panel-heading">
                <div class="btn-group">
                    <!-- <a class="btn btn-success" href="<?php echo base_url("receptionist/patient/add_document/") ?>"> <i class="fa fa-plus"></i> Add Document</a>   -->
                </div>
            </div>

            <div class="panel-body"> 

                <table width="100%" class="datatable table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Patient Id</th>
                            <th>Category</th>
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
                                    <td><?= esc($document->patient_id); ?></td>
                                    <td>
                                        <?php
                                            switch($document->category) {
                                                case("0"): {
                                                    echo "Other";
                                                    break;
                                                }
                                                case("2"): {
                                                    echo "Lab Report";
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($document->description) {
                                                echo esc(character_limiter(strip_tags($document->description),50)); 
                                            } else echo "N/A "
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = new DateTime($document->created_at);
                                            $strip = $date->format('Y-m-d');
                                            echo $strip;
                                         ?>
                                    </td> 
                                    <td>
                                        <?= $staff->find($document->upload_by)->firstname; ?>
                                        <?= $staff->find($document->upload_by)->lastname; ?>
                                    </td> 
                                    <td class="center" width="80">
                                        <a target="_blank" href="<?php echo base_url('./uploads/patient/documents/'.$document->hidden_attach_file) ?>" class="btn btn-xs btn-info" title="View Document"><i class="fa fa-eye"></i></a>
                                        <a download href="<?php echo base_url('./uploads/patient/documents/'.$document->hidden_attach_file) ?>" class="btn btn-xs btn-success"  title="Download Document"><i class="fa fa-download"></i></a>
                                        <a href="<?php echo base_url("receptionist/patient/document_delete/$document->id?file=$document->hidden_attach_file") ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure?') "  title="Delete Document"><i class="fa fa-trash"></i></a> 
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
 
 