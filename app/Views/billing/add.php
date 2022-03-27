<div class="row">
    <!--  form area -->
    <div class="col-sm-12">
        <div  class="panel panel-default thumbnail">
 
            <div class="panel-heading no-print">
                <div class="btn-group"> 
                    <a class="btn btn-primary" href="<?= base_url("billing") ?>"> <i class="fa fa-list"></i>  Invoice List </a>  
                </div>
            </div> 
 
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 table-responsive">
                        <form action="/billing/create" method="post">
                            <?= csrf_field() ?>
                            <table class="table table-striped">
                                <tfoot>
                                    <tr>  
                                        <th width="40%">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <strong>Appointment Code</strong>
                                                    <input type="text" required name="appointment_code" id="appointment_code" class="invoice-input">
                                                    <p class="text-center text-danger  invlid_appointment_code"></p>
                                                </li> 
                                                <li>
                                                    <strong>Patient Code</strong>
                                                    <input type="text" required name="patient_code" id="patient_code" class="invoice-input" disabled>
                                                    <p class="text-center text-danger  invlid_patient_code"></p>
                                                </li>   
                                                <li><strong>Full Name</strong>
                                                    <input type="text" class="invoice-input" id="patient_name" disabled>
                                                </li>  
                                                <li> 
                                                <strong>Address&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                    <input type="text" class="invoice-input" id="patient_address" disabled>
                                                </li>  
                                            </ul>
                                        </th>  
                                        <th width="20%" class="text-center"> 
                                            <strong class="text-border">Invoice</strong> 
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
                                            <input type="text" name="item_name[]" id="item" class="form-control" value="Diagnosis Cost">
                                        </td> 
                                        <td>
                                            <textarea name="description[]" class="form-control" placeholder="Description" rows="1" id="diagnosis_cost_reason"></textarea>
                                        </td> 

                                        <td>
                                            <input type="number" name="quantity[]" required autocomplete="off" class="totalCal form-control" placeholder="Quantity" min="0">
                                        </td>  
                                        <td>
                                            <input type="number" name="price[]" required autocomplete="off" class="totalCal form-control" placeholder="Price" min="0" id="diagnosis_cost_price">
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
                                </tbody>
                                <tfoot> 
                                    <tr class="bg-info">  
                                        <td colspan="3"></td> 
                                        <th class="text-right">Total</th>  
                                        <th><input type="number" name="total" id="total" class="form-control" readonly required placeholder="Total"  value="0.00"></th>  
                                        <td></td> 
                                    </tr>
                                    <tr>  
                                        <th colspan="3" class="text-right">Vat</th> 
                                        <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">%</div>
                                            <input type="number" id="vatParcent" required autocomplete="off"  class="form-control" value="0" min="0">
                                            </div>
                                        </td> 
                                        <td><input type="number" name="vat" id="vat" required autocomplete="off"  class="vatDiscount paidDue form-control" placeholder="Vat" value="0.00" min="0"></td>  
                                        <td></td> 
                                    </tr>
                                    <tr>  
                                        <th colspan="3" class="text-right">Discount</th> 
                                        <td>
                                            <div class="input-group">
                                            <div class="input-group-addon">%</div>
                                            <input type="number" id="discountParcent" required autocomplete="off" class=" form-control" value="0" min="0">
                                            </div>
                                        </td> 

                                        <td>
                                            <input type="number" name="discount" required autocomplete="off" id="discount" class="vatDiscount paidDue form-control" placeholder="Discount"  value="0.00" min="0">
                                        </td> 
                                        <td></td>  
                                    </tr> 
                                    <tr class="bg-success">  
                                        <td colspan="3"></td>  
                                        <th class="text-right">Grand Total</th>  
                                        <th>
                                            <input type="number" name="Grand Total" readonly required autocomplete="off"  id="grand_total" class="paidDue form-control" placeholder="Grand Total" value="0.00" min="0">
                                        </th> 
                                        <td></td>  
                                    </tr>
                                    
                                    <tr>  
                                        <td colspan="3">
                                            <div class="form-group row">
                                                <label class="col-xs-3">Status</label>
                                                <div class="col-xs-9"> 
                                                    <div class="form-check">
                                                        <label class="radio-inline"><input type="radio" name="status" value="1" checked>Paid</label>
                                                        <label class="radio-inline"><input type="radio" name="status" value="0">Not paid</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>  
                                        <td><button type="reset" class="btn btn-info btn-block">Reset</button></td>  
                                        <td><button class="btn btn-success btn-block">Save</button></td>  
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
<script src="<?php echo base_url('/js/admin/billing/add.js') ?>" type="text/javascript"></script>