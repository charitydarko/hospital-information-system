<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?= base_url("cashier/billing") ?>"> <i class="fa fa-list"></i>  Invoice List </a>  
                </div>
            </div> 

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <?php $billing_id = $invoice->id; ?>
                        <form action=<?= "/cashier/billing/update/$billing_id" ?> method="post">
                            <?= csrf_field() ?>
                            <table class="table table-striped">
                                <tfoot>
                                    <tr>  
                                        <th width="40%">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <strong>Appointment Code</strong>
                                                    <input type="text" required name="appointment_code" id="appointment_code" class="invoice-input" value="<?= $invoice->appointment_id; ?>" disabled />
                                                    <input type="hidden" required name="appointment_code" id="appointment_code" class="invoice-input" value="<?= $invoice->appointment_id; ?>" />
                                                    <p class="text-center text-danger  invlid_appointment_code"></p>
                                                </li> 
                                                <li>
                                                    <strong>Patient Code</strong>
                                                    <input type="text" required name="patient_code" id="patient_code" class="invoice-input" value="<?= $appointment[0]->patient_id ?>" disabled>
                                                    <p class="text-center text-danger  invlid_patient_code"></p>
                                                </li>   
                                                <li><strong>Full Name</strong>
                                                    <input type="text" class="invoice-input" id="patient_name" value="<?= $patient[0]->firstname . ' ' . $patient[0]->lastname ?>" disabled>
                                                </li>  
                                                <li> 
                                                <strong>Address&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                    <input type="text" class="invoice-input" id="patient_address" value="<?= $patient[0]->address ?>" disabled>
                                                </li>  
                                            </ul>
                                        </th>  
                                        <th width="20%" class="text-center"> 
                                            <strong class="text-border">Sale</strong> 
                                        </th>  
                                        <th width="40%">
                                            <h4>
                                                Date :  
                                                <input type="text" name="date" required value="<?php echo date('d-m-Y') ?>" class="datepicker invoice-input"><br> 
                                                Ultisoft Hospital<br> 
                                                Kumasi, Ashanti Region
                                            </h4>
                                        </th> 
                                    </tr>
                                </tfoot>
                            </table>


                            <table id="invoice" class="table table-striped"> 
                                <thead>
                                    <tr class="bg-primary">
                                    <th>Item Name</th>
                                        <th>Description</th>
                                        <th width="50">Quantity</th>
                                        <th width="120">Price</th>
                                        <th width="120">Subtotal</th>  
                                        <th width="160">Add Or Remove</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="item_name[]" id="item" class="form-control">
                                        </td> 
                                        <td><textarea name="description[]" class="form-control" placeholder="Description" rows="1"></textarea></td> 

                                        <td>
                                            <input type="number" name="quantity[]" required autocomplete="off" class="totalCal form-control" placeholder="Quantity" min="0">
                                        </td>  
                                        <td>
                                            <input type="number" name="price[]" required autocomplete="off" class="totalCal form-control" placeholder="Price" min="0" >
                                        </td>  
                                        <td>
                                            <input type="number" name="subtotal[]" required readonly autocomplete="off" class="subtotal form-control" placeholder="Subtotal" value="0.00" min="0">
                                        </td>   

                                        <td>
                                        <div class="btn btn-group">
                                            <button type="button" class="btn btn-sm btn-primary addBtn">Add</button>
                                            <button type="button" class="btn btn-sm btn-danger removeBtn">Remove</button>
                                            </div>
                                        </td>   
                                    </tr> 
                                    <?php 
                                    if(!empty($invoice_details)) { 
                                    foreach ($invoice_details as $invoice_detail) { 
                                    ?>
                                    <tr>
                                        <td><input type="text" name="item_name[]" required autocomplete="off" class="totalCal form-control" placeholder="Item Name" value="<?= esc($invoice_detail->item_name); ?>" ></td>
                                        <td><textarea name="description[]" class="form-control" placeholder="Description"><?= esc($invoice_detail->description); ?></textarea></td> 
                                        <td><input type="number" name="quantity[]" required autocomplete="off" class="totalCal form-control" placeholder="Quantity" value="<?= esc($invoice_detail->quantity); ?>" ></td>  
                                        <td><input type="number" name="price[]" required autocomplete="off" class="totalCal form-control" placeholder="Price" value="<?= esc($invoice_detail->price); ?>"></td>  
                                        <td><input type="number" name="subtotal[]" required readonly autocomplete="off" class="subtotal form-control" placeholder="Subtotal" value="<?= esc($invoice_detail->subtotal); ?>"></td>   

                                        <td>
                                        <div class="btn btn-group">
                                            <button type="button" class="btn btn-sm btn-primary addBtn">Add</button>
                                            <button type="button" class="btn btn-sm btn-danger removeBtn">Remove</button>
                                            </div>
                                        </td>   
                                    </tr>  
                                    <?php 
                                    } 
                                    } 
                                    ?>
                                </tbody>
                                <tfoot> 
                                <tr class="bg-info">  
                                        <td colspan="3"></td> 
                                        <th class="text-right">Total</th>  
                                        <th><input type="float" name="total" id="total" class="form-control" readonly required placeholder="Total"  value="<?= $invoice->total ?>"></th>  
                                        <td></td> 
                                    </tr>
                                    <tr>  
                                        <th colspan="3" class="text-right">Vat</th> 
                                        <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">%</div>
                                            <input type="float" id="vatParcent" required autocomplete="off"  class="form-control" value="0" min="0">
                                            </div>
                                        </td> 
                                        <td><input type="float" name="tax" id="vat" autocomplete="off"  class="vatDiscount paidDue form-control" placeholder="Vat"  value="<?= $invoice->tax ?>"></td>  
                                        <td></td> 
                                    </tr>
                                    <tr>  
                                        <th colspan="3" class="text-right">Discount</th> 
                                        <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">%</div>
                                            <input type="float" id="discountParcent" required autocomplete="off" class=" form-control" value="0" min="0">
                                            </div>
                                        </td> 

                                        <td>
                                            <input type="float" name="discount" required autocomplete="off" id="discount" class="vatDiscount paidDue form-control" placeholder="Discount"  value="<?= $invoice->discount ?>">
                                        </td> 
                                        <td></td>  
                                    </tr> 
                                    <tr class="bg-success">  
                                        <td colspan="3"></td>  
                                        <th class="text-right">Grand Total</th>  
                                        <th>
                                            <input type="float" name="Grand Total" readonly required autocomplete="off"  id="grand_total" class="paidDue form-control" placeholder="Grand Total" value="0.00" min="0">
                                        </th> 
                                        <td></td>  
                                    </tr>
                                    
                                    <tr>  
                                        <td colspan="3">
                                            <div class="form-group row">
                                                <label class="col-xs-3">Status</label>
                                                <div class="col-xs-9"> 
                                                    <div class="form-check">
                                                        <label class="radio-inline"><input type="radio" name="status" value="1" checked >Paid</label>
                                                        <label class="radio-inline"><input type="radio" name="status" value="0" disabled>Not paid</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>  
                                        <td><button type="reset" class="btn btn-info btn-block">Reset</button></td>  
                                        <td><button class="btn btn-success btn-block">Update</button></td>  
                                        <td></td> 
                                    </tr>
                                </tfoot>
                            </table>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('/js/pharmacy/inventory/addSale.js') ?>" type="text/javascript"></script>