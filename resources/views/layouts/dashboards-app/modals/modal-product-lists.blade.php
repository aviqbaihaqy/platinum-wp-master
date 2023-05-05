<!-- MODAL BOX -->
<!-- Modal Add List -->
<div class="modal fade" id="modal-add-list">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add Product List
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <!-- Upload  -->
                            <label class="text-white">Product Photo</label>
                            <!-- Form Upload -->
                            <form class="uploader">
                                <input type="file" accept="image/*" />

                                <label for="file-upload" id="file-drag">
                                    <img id="file-image" src="#" alt="Preview" class="hidden">
                                    <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Select a file or drag here</div>
                                        <div id="notimage" class="hidden">
                                            Please select an image
                                        </div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                    </div>

                                    <div id="response" class="hidden">
                                        <div id="messages"></div>
                                        <!-- <progress class="progress" id="file-progress" value="0">
                                            <span>0</span>%
                                        </progress> -->
                                    </div>
                                </label>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-6 mt-3">
                            <!-- Product LED -->
                            <label class="text-white">LED</label>
                            <input type="text" class="form-control" id="productLED" placeholder="Product LED" required>
                        </div>

                        <div class="col-xs-12 col-sm-6 mt-3">
                            <!-- Product LED Efficancy -->
                            <label class="text-white">LED Efficancy</label>
                            <input type="text" class="form-control" id="ledEfficancy" placeholder="Product LED Efficancy" required>
                        </div>

                        <div class="col-xs-12 col-sm-6 mt-3">
                            <!-- Product Voltage -->
                            <label class="text-white">Voltage</label>
                            <input type="text" class="form-control" id="Voltage" placeholder="Product Voltage" required>
                        </div>

                        <div class="col-xs-12 col-sm-6 mt-3">
                            <!-- Color Temperature -->
                            <label class="text-white">Color Temperature</label>
                            <input type="text" class="form-control" id="colorTemperature" placeholder="Product Color Temperature" required>
                        </div>

                        <div class="col-xs-12 mt-3">
                            <!-- Status Option -->
                            <label class="text-white">Status</label>
                            <div>
                                <button class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Available</button>
                                <button class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Unavaliable</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit List -->
<div class="modal fade" id="modal-edit-list">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Product
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <!-- Upload  -->
                            <label class="text-white">Product Photo</label>
                            <form class="uploader">
                                <input type="file" accept="image/*" />

                                <label for="file-upload" id="file-drag">
                                    <img id="file-image" src="#" alt="Preview" class="hidden">
                                    <div id="start">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                        <div>Select a file or drag here</div>
                                        <div id="notimage" class="hidden">
                                            Please select an image
                                        </div>
                                        <span id="file-upload-btn" class="btn btn-primary">Select a file</span>
                                    </div>

                                    <div id="response" class="hidden">
                                        <div id="messages"></div>
                                        <!-- <progress class="progress" id="file-progress" value="0">
                                            <span>0</span>%
                                        </progress> -->
                                    </div>
                                </label>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-5 mt-3">
                            <!-- Product Code -->
                            <label class="text-white">Product Code</label>
                            <input type="text" class="form-control" id="productCode" placeholder="Product Code" required>
                        </div>

                        <div class="col-xs-12 col-sm-7 mt-3">
                            <!-- Product Name -->
                            <label class="text-white">Product Name</label>
                            <input type="text" class="form-control" id="productName" placeholder="Product Name" required>
                        </div>

                        <div class="col-xs-12 col-sm-4 mt-3">
                            <!-- Total Price -->
                            <label class="text-white">Price/pcs (Modal)</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 mt-3">
                            <!-- Total Price -->
                            <label class="text-white">Price/pcs (Sales)</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 mt-3">
                            <!-- Profit -->
                            <label class="text-white">Profit</label>
                            <div class="input-group">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 mt-3">
                            <!-- Stock -->
                            <label class="text-white">Stock</label>
                            <input type="number" class="form-control" id="productStock" placeholder="Product Stock" required>
                        </div>

                        <div class="col-xs-12 mt-3">
                            <!-- Status Option -->
                            <label class="text-white">Status</label>
                            <div>
                                <button class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Available</button>
                                <button class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Unavaliable</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal View Product -->
<div class="modal fade" id="modal-view-product">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-lightbulb mr-2"></i>Product Details
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <!-- Product Image -->
                        <img id="viewProductImage" src="" class="img-product-lg mb-2" alt="User Image">
                    </div>
                    
                    <div class="col-xs-12 col-md-6">
                        <h4 id="viewProductTitle" class="text-black">LED Bulb - BR2A001</h4>
                        
                        <!-- Price -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <h5 class="text-black">
                                    Modal
                                    <div id="viewProductBuyingPrice" class="rp-content">70.000</div>
                                </h5>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                 <h5 class="text-black">
                                    Sales
                                    <div id="viewProductPrice" class="rp-content">85.000</div>
                                </h5>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                 <h5 class="text-black">
                                    Profit
                                    <div id="viewProductProfit" class="rp-content">15.000</div>
                                </h5>
                            </div>
                        </div>
                        
                        <!-- Status Stock -->
                        <span id="viewProductStatus" class="">
                            Available
                        </span>

                        <!-- Product Details -->
                        <div id="viewProductAttributes" class="details mt-3">
                            {{-- <div class="details-info"><p>LED</p>
                                <span>
                                    3 W
                                </span>
                                <div class="clearfix"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX