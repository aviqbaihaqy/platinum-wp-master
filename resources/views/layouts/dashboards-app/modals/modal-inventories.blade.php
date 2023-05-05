<!-- MODAL BOX -->
<!-- Modal Add Inventory -->
<div class="modal fade" id="modal-add-inventory">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Product Inventory
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="productStoreForm" method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xs-12 col-sm-8">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo</label>
                                <!-- Form Upload -->
                                <input form="productStoreForm" type="file" name="photo" />
                            </div>

                            <div class="col-xs-12 col-sm-5 mt-3">
                                <!-- Product Code -->
                                <label class="text-white">Product Code</label>
                                <input name="product_code" type="text" class="form-control" placeholder="Product Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Product Name -->
                                <label class="text-white">Product Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Product Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Sub Category -->
                                <label class="text-white">Sub Category :</label>
                                <select name="subcategory_id" class="form-control select2" style="width: 100%;">
                                    @foreach($subcategories as $key => $__subcategory)
                                        <option value="{{ $__subcategory->id }}" <?php if($subcategory == $__subcategory) echo 'selected' ?>>{{ $__subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Total Price -->
                                <label class="text-white">Price/pcs (Modal)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input name="buying_price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Total Price -->
                                <label class="text-white">Price/pcs (Sales)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input name="price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-5 mt-3">
                                <!-- Stock -->
                                <label class="text-white">Stock</label>
                                <input name="amount" type="number" class="form-control" placeholder="Product Stock" required>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status</label>
                                <input id="productStoreStatus" type="hidden" name="status" value="available">

                                <div>
                                    <button type="button" onclick="$('#productStoreStatus').val('available')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Available</button>
                                    <button type="button" onclick="$('#productStoreStatus').val('unavailable')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Unavaliable</button>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Sub Category -->
                                <label class="text-white">Description :</label>
                                
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="productStoreForm" type="submit" class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Inventory -->
<div class="modal fade" id="modal-edit-inventory">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Product Inventory
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="productUpdateForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-8">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo</label>
                                <!-- Form Upload -->
                                <input form="productUpdateForm" type="file" name="edit_product_photo" />
                            </div>

                            <div class="col-xs-12 col-sm-5 mt-3">
                                <!-- Product Code -->
                                <label class="text-white">Product Code</label>
                                <input id="edit_product_code" name="product_code" type="text" class="form-control" placeholder="Product Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Product Name -->
                                <label class="text-white">Product Name</label>
                                <input id="edit_product_name" name="name" type="text" class="form-control" placeholder="Product Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Sub Category -->
                                <label class="text-white">Sub Category :</label>
                                <select id="edit_product_subcategory_id" name="subcategory_id" class="form-control select2" style="width: 100%;">
                                    @foreach($subcategories as $key => $__subcategory)
                                        <option value="{{ $__subcategory->id }}" <?php if($subcategory == $__subcategory) echo 'selected' ?>>{{ $__subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Total Price -->
                                <label class="text-white">Price/pcs (Modal)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input id="edit_product_buying_price" name="buying_price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Total Price -->
                                <label class="text-white">Price/pcs (Sales)</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input id="edit_product_price" name="price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-5 mt-3">
                                <!-- Stock -->
                                <label class="text-white">Stock</label>
                                <input id="edit_product_amount" name="amount" type="number" class="form-control" placeholder="Product Stock" required>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status</label>
                                <input id="edit_product_status" type="hidden" name="status" value="available">

                                <div>
                                    <button type="button" onclick="$('#edit_product_status').val('available')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Available</button>
                                    <button type="button" onclick="$('#edit_product_status').val('unavailable')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Unavaliable</button>
                                </div>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Sub Category -->
                                <label class="text-white">Description :</label>
                                
                                <textarea id="edit_product_description" class="form-control" name="description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="productUpdateForm" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->