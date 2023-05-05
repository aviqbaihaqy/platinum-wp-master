<!-- MODAL BOX -->
<!-- Modal View Carts -->
<script type="text/javascript">
    function getProductData(productId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/products/' + productId + '/get_details',
            cache: false,
            dataType: 'JSON',
            success: function(data) {
                var product = JSON.parse($.parseJSON(JSON.stringify(data)));
                var photo = product.photo
                var attributes = product.attributes

                console.log(product)

                $('#viewProductImage').attr('src', '/' + photo.directory)
                $('#viewProductTitle').text(product.name + ' - ' + product.product_code)
                $('#viewProductBuyingPrice').text(product.buying_price)
                $('#viewProductPrice').text(product.price)
                $('#viewProductProfit').text(product.price - product.buying_price)

                $('#viewProductStatus').val(product.status)
                if(product.status == 'available')
                    $('#viewProductStatus').attr('class', 'label label-success')
                else
                    $('#viewProductStatus').attr('class', 'label label-danger')

                var divElement = ''
                $('#viewProductAttributes').empty() // empty the div
                for(var loop = 0; loop < attributes.length; loop++) {
                    divElement += '<div class="details-info"><p>' + attributes[loop].attribute_name + '</p>'
                        divElement += '<span>' + attributes[loop].value.value + '</span>'
                        divElement += '<div class="clearfix"></div>'
                    divElement += '</div>'
                }
                $('#viewProductAttributes').append(divElement) // fill with new items
            }
        })
    }
</script>

@foreach($carts as $userModal => $cartModalItems)
    <div class="modal fade" id="modal-view-carts-{{ $cartModalItems->userId }}" style="z-index: 1045">
        <div class="modal-dialog">
            <div class="modal-content-b">
                <div class="modal-header">
                    <!-- Button Close -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- Modal Title -->
                    <h4 class="text-black">
                        <i class="fa fa-shopping-cart mr-2"></i>Carts Details
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive no-border" id="printableSection">
                        <a id="export-link" style="display:none;"></a>
                        {{-- Table --}}
                        <table id="datatables" data-toggle="table" data-search="true" data-filter-control="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product Code</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $grandTotal = 0; 
                                ?>
                                @foreach($cartModalItems as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                {{ $item->product->product_code }}
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="getProductData('{{ $item->product->id }}')" data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                                {{ $item->product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $item->product->subcategory->category->name }}</td>
                                        <td class="rp-content">
                                            {{ number_format($item->product->price) }}
                                        </td>
                                        <td>{{ $item->amount }}</td>
                                        <td class="rp-content">
                                            {{ number_format($item->product->price * $item->amount) }}
                                        </td>
                                    </tr>

                                    <?php $grandTotal += $item->total; ?>
                                @endforeach

                                <tr>
                                    <td colspan="6"><b>Grand Total</b></td>

                                    <td class="rp-content">
                                        {{ number_format($grandTotal) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- Modal Edit Cart Status -->
<div class="modal fade" id="modal-edit-carts-status">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Carts Status
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Status Option -->
                            <label class="text-white">Cart Status :</label>
                            <div>
                                <button class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Shipped</button>
                                <button class="btn btn-sm btn-flat btn-warning mt-md-2 mr-1">Progress</button>
                                <button class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">Pending</button>
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
<!-- /MODAL BOX -->