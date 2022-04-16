<div class="row">

    <div class="col-sm-12" id="PrintMe">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-success" href="<?php echo base_url("pharmacy/inventory/sale") ?>"> <i class="fa fa-plus"></i> Add Prescription Sale</a>  
                    <a class="btn btn-primary" href="<?php echo base_url("pharmacy/inventory") ?>"> <i class="fa fa-list"></i> Prescription Sales List</a>  
                    <button type="button" onclick="printContent('PrintMe')" class="btn btn-danger" ><i class="fa fa-print"></i></button> 
                </div>
            </div> 

            <div class="panel-body"> 
                <!-- Nav tabs --> 
                <ul class="col-xs-12 nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Patient Information</a>
                    </li>
                    <li role="presentation">
                        <a href="#prescription" aria-controls="prescription" role="tab" data-toggle="tab">Prescription Summary</a>
                    </li>
                    <li role="presentation">
                        <a href="#prescription_details" aria-controls="prescription_details" role="tab" data-toggle="tab">Prescription Details</a>
                    </li>

                </ul>  

                <!-- Tab panes --> 
                <div class="col-xs-12 tab-content">
                    <br>
                    <!-- INFORMATION -->
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            <div class="col-sm-9"> 
                                <dl class="dl-horizontal">
                                    <dt>Patient Name</dt><dd><?= $patient[0]->firstname . ' ' . $patient[0]->lastname ?></dd>
                                    <dt>Patient Age</dt><dd><?= $patient[0]->age ?></dd>
                                    <dt>Patient Gender</dt>
                                    <dd>
                                        <?php 
                                            switch($patient[0]->gender) {
                                                case '1':
                                                {echo 'Male'; break;}
                                                case '2':
                                                {echo 'Female'; break;}
                                                case '3':
                                                {echo 'Other'; break;}
                                                default:
                                                {echo 'Not provided'; break;}
                                            }
                                        ?>
                                    </dd>
                                    <dt>Appointment Code</dt><dd><?= esc($appointment[0]->id) ?></dd>
                                    <dt>Patient Code</dt><dd><?php echo esc($appointment[0]->patient_id) ?></dd>
                                    
                                </dl> 
                            </div>
                        </div>
                    </div> 

                    <!-- Prescription -->
                    <div role="tabpanel" class="tab-pane" id="prescription">
                        <div class="row">
                            <div class="col-sm-12">
                            <dl class="dl-horizontal">
                                <dt>Total Cost</dt><dd><?= 'GH¢ ' . $prescription_sale->total ?></dd>
                                <dt>Tax</dt>
                                <dd>
                                    <?php
                                        if($prescription_sale->tax) {
                                            echo 'GH¢ ' . $prescription_sale->tax;
                                        } else {
                                            echo 'N/A';
                                        }
                                    ?>
                                </dd>
                                <dt>Discount</dt>
                                <dd>
                                    <?php
                                        if($prescription_sale->discount) {
                                            echo 'GH¢ ' . $prescription_sale->discount;
                                        } else {
                                            echo 'N/A';
                                        }
                                    ?>
                                </dd>
                                <dt>Status</dt><dd><?= ((esc($prescription_sale->status)==1)?'Paid':'Unpaid'); ?></dd>
                                
                            </dl> 
                            </div>
                        </div>
                    </div>

                    <!-- Prescription Details -->
                    <div role="tabpanel" class="tab-pane" id="prescription_details">
                        <div class="row">
                            <div class="col-sm-12">
                            <table width="100%" class="datatable table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Item Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Sub Total (GH¢)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($prescription_sale_details)) { ?>
                                        <?php $sl = 1; ?>
                                        <?php foreach ($prescription_sale_details as $prescription_sale_detail) { ?>
                                            <tr class="<?= ($sl & 1)?"odd gradeX":"even gradeC" ?>">
                                                <td><?= $sl; ?></td>
                                                <td><?= esc($prescription_sale_detail->item_name); ?></td>
                                                <td><?= esc($prescription_sale_detail->description); ?></td>
                                                <td><?= esc($prescription_sale_detail->quantity); ?></td>
                                                <td><?= esc($prescription_sale_detail->price); ?></td>
                                                <td><?= esc($prescription_sale_detail->subtotal); ?></td>
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

            </div> 
        </div>
    </div>
  
</div>
