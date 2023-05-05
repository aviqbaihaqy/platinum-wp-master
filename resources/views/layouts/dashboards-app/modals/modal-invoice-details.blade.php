<!-- MODAL BOX -->
<!-- Modal Add Sales -->
<div class="modal fade" id="modal-view-invoice" style="z-index: 1045">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-file-invoice mr-2"></i>Invoice Details
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
                                <th>Shipping Code</th>

                                <th>Product Code</th>
                                <th>Product Name</th>

                                <th>Sub Category</th>
                                <th>Category</th>
                                
                                <th>Qty</th>
                                <th>Grand Total</th>
                            </tr>
                        </thead>

                        <tbody id="invoiceDetailsBody">
                            <tr>
                                <td>1</td>
                                <td>J11348917541</td>
                                <td>
                                    <a data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                    BR2A001</a>
                                </td>
                                <td>
                                    <a data-target="#modal-view-product" data-toggle="modal" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="View" style="cursor: pointer">
                                    LED Bulb 5w</a>
                                </td>
                                <td>LED Bulb</td>
                                <td>LED Bulb</td>
                                <td>5</td>
                                <td class="rp-content">300.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->