<!-- MODAL BOX -->
<!-- Modal Add Sales -->
<div class="modal fade" id="modal-add-sales">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Invoice
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <form id="addSalesManually" method="POST" action="{{ route('dashboard.invoices.manuallyCreateInvoice') }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-7">
                                <!-- Date Input -->
                                <label class="text-white">Date</label>
                                <div class="input-group date mt-2">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    <input name="done_at" type="date" class="form-control pull-right">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Invoice Code -->
                                <label class="text-white">Invoice Code</label>
                                <input name="invoice_code" type="text" class="form-control" placeholder="Bills Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Shipping Code -->
                                <label class="text-white">Shipping Code</label>
                                <input name="shipping_code" type="text" class="form-control" placeholder="Shipping Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Courier Expedition -->
                                <label class="text-white">Courier Expedition :</label>
                                <select name="courier" class="form-control select2" style="width: 100%;">
                                    <option value="JNE" selected="selected">JNE</option>
                                    <option value="J&T">J&T</option>
                                    <option value="TIKI">TIKI</option>
                                    <option value="Wahana">Wahana</option>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Client Name -->
                                <label class="text-white">Client</label>
                                <input name="client_name" type="text" class="form-control" placeholder="Client Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Discount -->
                                <label class="text-white">Discount</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input name="discount" type="text" class="form-control" placeholder="Discount" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Expedition Price -->
                                <label class="text-white">Expedition Price</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input name="expedition_price" type="text" class="form-control" placeholder="Expedition Price" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Total Price -->
                                <label class="text-white">Grand Total (Tanpa Discount)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input name="grand_total" type="text" class="form-control" placeholder="Grand Total" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Status -->
                                <label class="text-white">Status :</label>
                                <select name="status" class="form-control select2" style="width: 100%;">
                                    <option selected="selected">Paid</option>
                                    <option>Unpaid</option>
                                    <option>Shipped</option>
                                    <option>Progress</option>
                                    <option>Pending</option>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Sales -->
                                <label class="text-white">Sales :</label>
                                <input name="sales_name" type="text" class="form-control" placeholder="Sales Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Payment Due -->
                                <label class="text-white">Payment Due Date</label>
                                <div class="input-group date mt-2">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar-alt"></i>
                                    </div>
                                    <input name="done_at" type="date" class="form-control pull-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="addSalesManually" type="submit" class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-product-sales">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Invoice Item
                </h4>
            </div>
            <div class="modal-body">
                <div id="addSalesItem_flashStatus">
                    
                </div>

                <!-- Form Group -->
                <form id="addSalesItemManuallyForm" method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 mt-3">
                                <!-- Product -->
                                <label class="text-white">Product :</label>
                                <select id="addSalesItem_product_id" name="product_id" class="form-control select2" style="width: 100%;">
                                    @foreach($categories as $key => $category)
                                        <optgroup label="{{ $category->name }}">
                                            @foreach($category->subcategories as $key => $__subcategory)
                                                <optgroup label="{{ $category->name }} - {{ $__subcategory->name }}">
                                                    @foreach($__subcategory->products as $key => $__product)
                                                        <option value="{{ $__product->id }}">
                                                            {{ $__product->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Product -->
                                <label class="text-white">Quantity :</label>
                                <input id="addSalesItem_amount" name="amount" type="number" class="form-control" placeholder="Quantity" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Notes -->
                                <label class="text-white">Notes :</label>
                                <div class="input-group">
                                    <span class="item-notes">
                                        <textarea id="addSalesItem_note" name="note" placeholder="Notes" style="background-color: white;border:2px solid #F2F2F2; width: 100%; height: 100px"></textarea>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button onclick="storeInvoiceItem()" class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Sales -->
<div class="modal fade" id="modal-edit-sales">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Invoice
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <form action=""></form>
                <div class="form-group">
                    <div class="row">
                        <form id="insertShipping" action="" method="POST">
                            @csrf

                            <div class="col-xs-12 col-sm-12 mt-3">
                                <!-- Invoice Code -->
                                <label class="text-white">Invoice Code</label>
                                <input name="invoice_code" id="invoiceCode" type="text" class="form-control" placeholder="Bills Code" readonly>
                            </div>

                            <div class="col-xs-12 col-sm-12 mt-3">
                                <!-- Shipping Code -->
                                <label class="text-white">Shipping Code</label>
                                <input name="shipping_code" id="shippingCode" type="text" class="form-control" placeholder="Shipping Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-12 mt-3">
                                <!-- Courier Expedition -->
                                <label class="text-white">Courier Expedition :</label>
                                <select name="courier" id="courier" class="form-control select2" style="width: 100%;">
                                    <option value="JNE">JNE</option>
                                    <option value="J&T">J&T</option>
                                    <option value="TIKI">TIKI</option>
                                    <option value="Wahana">Wahana</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="insertShipping" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->