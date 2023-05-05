<!-- MODAL BOX -->
<!-- Modal Add Staff -->
<div class="modal fade" id="modal-add-staff">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-plus mr-2"></i>Add New Staff
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="create_staff_form" method="POST" action="">
                            @csrf
                            
                            <div class="col-xs-12 col-sm-8">
                                <!-- NIP -->
                                <label class="text-white">NIP</label>
                                <input id="create_staff_nip" name="nip" type="text" class="form-control" id="nip" placeholder="NIP" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- First Name -->
                                <label class="text-white">First Name</label>
                                <input id="create_staff_first_name" name="first_name" type="text" class="form-control" id="fullName" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Last Name -->
                                <label class="text-white">Last Name</label>
                                <input id="create_staff_last_name" name="last_name" type="text" class="form-control" id="fullName" placeholder="Last Name" required>
                            </div>

                             <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Position -->
                                <label class="text-white">Position</label>
                                <select id="create_staff_role" name="role" class="form-control select2" style="width: 100%;">
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                    <option value="sales">Sales</option>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Email Address -->
                                <label class="text-white">E-Mail Address</label>
                                <input id="create_staff_email" name="email" type="text" class="form-control" id="productCode" placeholder="E-Mail Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Password -->
                                <label class="text-white">Password</label>
                                <input id="create_staff_password" name="password" type="password" class="form-control" id="fullName" placeholder="Password" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Address -->
                                <label class="text-white">Address</label>
                                <input id="create_staff_address" name="address" type="text" class="form-control" id="productCode" placeholder="Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-white">Phone Number</label>
                                <input id="create_staff_phone" name="phone" type="text" class="form-control" id="phoneNumber" placeholder="Phone Number">
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status: </label>
                                <input id="create_staff_status" type="hidden" id="create_staff_status" name="status" value="active">
                                <div>
                                    <button type="button" onclick="$('#create_staff_status').val('active')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Active</button>
                                    <button type="button" onclick="$('#create_staff_status').val('inactive')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">InActive</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="create_staff_form" type="submit" class="btn btn-d">Add</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Staff -->
<div class="modal fade" id="modal-edit-staff">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Staff
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="edit_staff_form" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-8">
                                <!-- NIP -->
                                <label class="text-white">NIP</label>
                                <input id="edit_staff_nip" name="nip" type="text" class="form-control" id="nip" placeholder="NIP" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- First Name -->
                                <label class="text-white">First Name</label>
                                <input id="edit_staff_first_name" name="first_name" type="text" class="form-control" id="fullName" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Last Name -->
                                <label class="text-white">Last Name</label>
                                <input id="edit_staff_last_name" name="last_name" type="text" class="form-control" id="fullName" placeholder="Last Name" required>
                            </div>

                             <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Position -->
                                <label class="text-white">Position</label>
                                <select id="edit_staff_role" name="role" class="form-control select2" style="width: 100%;">
                                    <option value="admin">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Email Address -->
                                <label class="text-white">E-Mail Address</label>
                                <input id="edit_staff_email" name="email" type="text" class="form-control" id="productCode" placeholder="E-Mail Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Password -->
                                <label class="text-white">Password</label>
                                <input id="edit_staff_password" name="password" type="password" class="form-control" id="fullName" placeholder="Password" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Address -->
                                <label class="text-white">Address</label>
                                <input id="edit_staff_address" name="address" type="text" class="form-control" id="productCode" placeholder="Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-white">Phone Number</label>
                                <input id="edit_staff_phone" name="phone" type="text" class="form-control" id="phoneNumber" placeholder="Phone Number">
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status: </label>
                                <input id="edit_staff_status" type="hidden" id="edit_staff_status" name="status">
                                <div>
                                    <button type="button" onclick="$('#edit_staff_status').val('active')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Active</button>
                                    <button type="button" onclick="$('#edit_staff_status').val('inactive')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">InActive</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Add -->
                <button form="edit_staff_form" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Member -->
<div class="modal fade" id="modal-edit-member">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Member
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="edit_member_form" action="" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-6">
                                <!-- First Name -->
                                <label class="text-white">First Name</label>
                                <input id="edit_member_first_name" name="first_name" type="text" class="form-control" id="fullName" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <!-- Last Name -->
                                <label class="text-white">Last Name</label>
                                <input id="edit_member_last_name" name="last_name" type="text" class="form-control" id="fullName" placeholder="Last Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Address -->
                                <label class="text-white">Address</label>
                                <input id="edit_member_address" name="address" type="text" class="form-control" id="address" placeholder="Address">
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Email Address -->
                                <label class="text-white">E-Mail Address</label>
                                <input id="edit_member_email" name="email" type="text" class="form-control" id="productCode" placeholder="E-Mail Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-white">Phone Number</label>
                                <input id="edit_member_phone" name="phone" type="text" class="form-control" id="phoneNumber" placeholder="Phone Number">
                            </div>

                            <div class="col-xs-12 col-sm-8 mt-3">
                                <!-- Phone Number -->
                                <label class="text-white">Company</label>
                                <p class="alert text-danger">*Optional</p>
                                <input id="edit_member_company" name="company" type="text" class="form-control" id="company" placeholder="Company">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button onclick="document.getElementById('edit_member_form').submit()" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal View Client -->
<div class="modal fade" id="modal-view-client">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-user mr-2"></i>Client Details
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 id="clientName" class="text-black">Bima Jati</h4>
                    
                        <div class="details">
                            <div class="details-info"><p>Address</p>
                                <span id="clientAddress">
                                    Jl.Pucang Anom Raya 3/24
                                </span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-info">
                                <p>E-Mail Address</p>
                                <span id="clientEmail">bimajep@gmail.com</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-info">
                                <p>Phone Number</p>
                                <span id="clientPhone">087832557935</span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="details-info">
                                <p>Company</p>
                                <span id="clientCompany">-</span>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->