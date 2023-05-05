<!-- Modal Edit Desc -->
<div class="modal fade" id="modal-edit-desc">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Description
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="productEditDescriptionForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12">
                                <textarea name="description" id="productEditDescription" value="" style="width: 100%;height: 125px"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="productEditDescriptionForm" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Price & Quantity -->
<div class="modal fade" id="modal-edit-price-qty">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Price & Quantity
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-5">
                                <!-- Product Code -->
                                <label class="text-white">Product Code</label>
                                <input id="editProductForm_product_code" name="product_code" type="text" class="form-control" placeholder="Product Code" required>
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-sm-3">
                                <!-- Product Name -->
                                <label class="text-white">Product Name</label>
                                <input id="editProductForm_name" name="name" type="text" class="form-control" placeholder="Product Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Buying Price -->
                                <label class="text-white">Buying Price/pcs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input id="editProductForm_buying_price" name="buying_price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Buying Price -->
                                <label class="text-white">Selling Price/pcs</label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input id="editProductForm_selling_price" name="price" type="number" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Stock -->
                                <label class="text-white">Stock</label>
                                <input id="editProductForm_amount" name="amount" type="number" class="form-control" placeholder="Product Stock" required>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status</label>
                                <input id="editProductForm_status" name="status" type="hidden" value="available">

                                <div>
                                    <button type="button" onclick="$('#editProductForm_status').val('available')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1">Available</button>
                                    <button type="button" onclick="$('#editProductForm_status').val('unavailable')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Unavaliable</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="editProductForm" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Product Photo -->
<div class="modal fade" id="modal-add-product-photo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Add Massive Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="addMassivePhoto" method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xs-12 col-sm-7">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo 1</label>
                                <!-- Form Upload -->
                                <input type="file" name="photos[0]" />
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo 2</label>
                                <!-- Form Upload -->
                                <input type="file" name="photos[1]" />
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo 3</label>
                                <!-- Form Upload -->
                                <input type="file" name="photos[2]" />
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Upload  -->
                                <label class="text-white">Product Photo 4</label>
                                <!-- Form Upload -->
                                <input type="file" name="photos[3]" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="addMassivePhoto" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add Product Photo -->
<div class="modal fade" id="modal-edit-product-photo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="updateProductPhotoForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-7">
                                <!-- Upload  -->
                                <label class="text-white">New Photo</label>
                                <!-- Form Upload -->
                                <input type="file" name="photo" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="updateProductPhotoForm" type="submit" class="btn btn-d">Update</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add Dimension Photo -->
<div class="modal fade" id="modal-add-dimension-photo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Dimension Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="addDimensionPhoto" method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xs-12 col-sm-7">
                                <!-- Upload  -->
                                <label class="text-white">Dimension Photo</label>
                                <!-- Form Upload -->
                                <input type="file" name="photo" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="addDimensionPhoto" type="submit" class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Dimension Photo -->
<div class="modal fade" id="modal-edit-dimension-photo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Dimension Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="updateDimensionPhoto" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-7">
                                <!-- Upload  -->
                                <label class="text-white">Dimension Photo</label>
                                <!-- Form Upload -->
                                <input type="file" name="photo" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="updateDimensionPhoto" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Product Attributes -->
<div class="modal fade" id="modal-edit-attributes">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Product Attribute
                </h4>
            </div>
            <div class="modal-body">
                <form id="editAttributeForm" method="POST" action="">
                    @csrf
                    @method('PATCH')

                    <!-- Form Group -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <label class="text-white">Attribute Name</label>
                                <input name="attribute_name" type="text" class="form-control" id="editAttributeName" placeholder="">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-sm-3">
                                <label class="text-white">Attribute Value</label>
                                <input name="value" type="text" class="form-control" id="editAttributeValue" placeholder="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="editAttributeForm" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Warranty & Terms -->
<div class="modal fade" id="modal-edit-warranty-terms">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Warranty & Terms
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="editProductWarrantyForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <div class="col-xs-12 col-sm-6">
                                <!-- Warranty -->
                                <label class="text-white">Warranty</label>
                                <input id="warrantyUnit" name="warranty_unit" type="text" class="form-control" required>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Terms -->
                                <label class="text-white">Terms</label>
                                <div class="box no-border bg-white">
                                    <div class="box-bodypad">
                                        <textarea id="warrantyTerms" name="warranty_terms" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                            </textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="editProductWarrantyForm" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Add Product Photo -->
<div class="modal fade" id="modal-add-product-banner">
    <div class="modal-dialog modal-sm">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Product Banner
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="updateOrCreateBannerForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-7">
                                <!-- Upload  -->
                                <label class="text-white">New Photo</label>
                                <!-- Form Upload -->
                                <input form="updateOrCreateBannerForm" name="banner" type="file" name="photo" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="updateOrCreateBannerForm" type="submit" class="btn btn-d">Upload</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>