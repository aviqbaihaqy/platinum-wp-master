<!-- MODAL BOX -->
<!-- Modal Edit Profile -->
<div class="modal fade" id="modal-edit-profile">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Profile
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form action="{{ route('dashboard.users.self-update', $auth->id) }}" id="edit_mydata_form" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-12 col-sm-8">
                                <!-- NIP -->
                                <label class="text-white">NIP</label>
                                <input value="{{ $userDetail->nip }}" name="nip" type="text" class="form-control" id="nip" placeholder="NIP" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- First Name -->
                                <label class="text-white">First Name</label>
                                <input value="{{ $userDetail->first_name }}" name="first_name" type="text" class="form-control" placeholder="First Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Last Name -->
                                <label class="text-white">Last Name</label>
                                <input value="{{ $userDetail->last_name }}" name="last_name" type="text" class="form-control" placeholder="Last Name" required>
                            </div>

                            <div class="col-xs-12 col-sm-7 mt-3">
                                <!-- Position -->
                                <label class="text-white">Position</label>
                                <select name="role" class="form-control select2" style="width: 100%;">
                                    <option <?php if($user->role == 'admin') echo 'selected' ?> value="admin">Admin</option>
                                    <option <?php if($user->role == 'staff') echo 'selected' ?> value="staff">Staff</option>
                                </select>
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Address -->
                                <label class="text-white">Address</label>
                                <input value="{{ $userDetail->address }}" name="address" type="text" class="form-control" placeholder="Address">
                            </div>
                            
                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Email Address -->
                                <label class="text-white">E-Mail Address</label>
                                <input value="{{ $user->email }}" name="email" type="text" class="form-control" placeholder="E-Mail Address">
                            </div>

                            <div class="col-xs-12 col-sm-6 mt-3">
                                <!-- Phone Number -->
                                <label class="text-white">Phone Number</label>
                                <input value="{{ $userDetail->phone }}" name="phone" type="text" class="form-control" id="phoneNumber" placeholder="Phone Number">
                            </div>

                            <div class="col-xs-12 mt-3">
                                <!-- Status Option -->
                                <label class="text-white">Status: </label>
                                <input type="hidden" id="edit_mydata_status" name="status" value="{{ $user->status }}">
                                <div>
                                    <button type="button" onclick="$('#edit_mydata_status').val('active')" class="btn btn-sm btn-flat btn-success mt-md-2 mr-1 active">Active</button>
                                    <button type="button" onclick="$('#edit_mydata_status').val('inactive')" class="btn btn-sm btn-flat btn-danger mt-md-2 mr-1">InActive</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="edit_mydata_form" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Photo -->
<div class="modal fade" id="modal-edit-photo">
    <div class="modal-dialog">
        <div class="modal-content-b">
            <div class="modal-header">
                <!-- Button Close -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- Modal Title -->
                <h4 class="text-black">
                    <i class="fa fa-edit mr-2"></i>Edit Profile Photo
                </h4>
            </div>
            <div class="modal-body">
                <!-- Form Group -->
                <div class="form-group">
                    <div class="row">
                        <form id="upload_myphoto" action="{{ route('dashboard.users.self-update', $auth->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
                                <!-- Form Upload -->
                                <input type="file" name="photo" required />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Button Save -->
                <button form="upload_myphoto" type="submit" class="btn btn-d">Save</button>
                <!-- Button Cancel -->
                <button class="btn btn-c" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /MODAL BOX -->