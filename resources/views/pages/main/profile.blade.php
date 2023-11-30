@extends('layouts.main')

@section('content')

    <!-- Content Wrapper. Contains page content -->



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if(session('user') && session('user')->avatar)
                                    <img  class="profile-user-img img-fluid img-circle" src="{{ url('user_profile/' . session('user')->avatar) }}">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ url('user_profile/default.png') }}">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{$user->firstname . ' ' . $user->lastname}}</h3>
                           <div align="center">
                               <button id="updateImageBtn" type="button" class="btn btn-sm btn-primary align-center">
                                  <b>Update Image</b>
                               </button>
                           </div>

                             <br>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Referrals</b> <a class="float-right">{{$user->downlines()->count()}}</a>
                                </li>
                                @if($upline->role != 'admin')
                                <li class="list-group-item">
                                    <b>Upline Name:</b> <a class="float-right">{{$upline->firstname . ' ' . $upline->lastname}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Upline's Phone</b> <a class="float-right">{{$upline->phone}}</a>
                                </li>
                                    @endif
                            </ul>
                            <p hidden id="toCopy">{{url('register'.'/'.$user->username)}}</p>
                            <button class="btn btn-primary btn-block"  onclick="copyToClipboard('#toCopy')"><b><i class="fas fa-copy me-2"></i> Copy Unique Link</b></button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                            <p class="text-muted">
                                {{$user->email}}
                            </p>

                            <hr>

                            <strong><i class="fas fa-phone mr-1"></i>Phone Number</strong>

                            <p class="text-muted">{{$user->phone}}</p>

                            <hr>



                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Personal Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{route('profile.update')}}">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-5">
                                                <input type="text" value="{{$user->firstname}}"  name="firstname" class="form-control" placeholder="First Name" required>
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" value="{{$user->lastname}}"  name="lastname" class="form-control" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" value="{{$user->email}}" readonly class="form-control" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Phone number</label>
                                            <div class="col-sm-10">
                                                <input type="text"  inputmode="tel" name="phone" class="form-control" value="{{$user->phone}}" placeholder="234XXXXXXXXXX" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <label class="col-sm-2 col-form-label">Day/Month</label>
                                            <div class="col-sm-3">
                                                <select name="b_date" class="form-control" required>
                                                    <option value="">--Select--</option>
                                                    @for($i = 1; $i <= 31; $i++)
                                                        <option {{($user->b_date == $i) ? 'selected' : ''}} value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-control" name="b_month" required>
                                                    <option value="">--Select--</option>
                                                    @for($j = 1; $j <= 12; $j++)
                                                        <option {{($user->b_month == $j) ? 'selected' : ''}} value="{{date('m', strtotime('2023-' . $j))}}">{{date('F', strtotime('2023-' . $j))}}</option>
                                                    @endfor

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control"  name="address" id="inputExperience" placeholder="Enter Address"> {{$user->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">City/Gender</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" name="city" value=" {{$user->city}}" placeholder="Enter City">
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control select2 form-select" name="gender" required>
                                                    <option {{($user->gender == 'Male') ? 'selected' : ''}} value="Male">Male</option>
                                                    <option {{($user->gender == 'Female') ? 'selected' : ''}} value="Female">Female</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <label for="inputSkills" class="col-sm-2 col-form-label">State/Country</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control"  value=" {{session('user')->state}}" name="state" placeholder="Enter State">
                                            </div>
                                            <div class="col-sm-5">
                                                <select class="form-control" name="country">
                                                    <option value="{{session('user')->country}}">{{session('user')->country}}</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Bank Detail</h4>
                                </div>
                                <div class="card-body">
                                    @if($user->bank && $user->bank_code)
                                        <div class="row">
                                            <div class="col-md-6 offset-md-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Bank</label>
                                                            <input type="text" class="form-control" value="{{$user->bank}}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Account Number</label>
                                                            <input type="text" class="form-control" value="{{$user->acc_number}}" disabled>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Account Name</label>
                                                            <input type="text" class="form-control" value="{{$user->acc_name}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <form class="form-horizontal" method="post" action="{{route('profile.updateBank')}}">
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="bank" id="bankNameHidden" value="{{$user->bank}}" required>

                                            <div class="row">
                                                <div class="col-md-6 offset-md-3">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Bank</label>
                                                                <select name="bank_code" id="bankSelect" class="form-control">
                                                                    <option value="">--Select Bank--</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Account Number</label>
                                                                <input type="text" class="form-control" id="account_number" name="acc_number" required>
                                                                <small id="bankLoader" style="display: none" class="text-danger"><i class="fa fa-hourglass fa-spin"></i> Fetching beneficiary</small>
                                                            </div>
                                                        </div>
                                                        <div id="errorAlert" style="display: none" class="alert alert-danger">Unable to find account</div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Account Name</label>
                                                                <input type="text" class="form-control" name="acc_name" id="acc_name" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-success">Save Account Detail</button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
    <div class="modal fade" id="updateImageModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateProfileForm" method="post" enctype="multipart/form-data" action="{{ route('updateimage')}}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="avatar" id="croppedImage" required>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="cropperInput">
                                    <label class="custom-file-label" for="customFile">Select Image</label>
                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                                <div id="cropperDisplay"></div>
                            </div>

                            <div class="col-md-12">
                                <button style="display: none" id="cropBtn" type="button" class="btn btn-sm btn-primary mt-2"><i class="fa fa-crop"></i> Crop and Save</button>
                            </div>
                        </div>





                    </form>
                </div>
                <div class="modal-footer justify-content-between">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert ("link copied!");
        }
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css" integrity="sha512-2eMmukTZtvwlfQoG8ztapwAH5fXaQBzaMqdljLopRSA0i6YKM8kBAOrSSykxu9NN9HrtD45lIqfONLII2AFL/Q==" crossorigin="anonymous" />
    @endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
    <script>

        const bankName = $('#bankSelect');
        const bankNameHidden = $('#bankNameHidden');
        const accountNumber = $('#account_number');
        const accountName = $('#acc_name');
        const bankLoader = $('#bankLoader');
        const accountNameDiv = $('#accountNameDiv');
        const errorAlert = $('#errorAlert');

        const updateImageBtn = $('#updateImageBtn');
        const updateImageModal = $('#updateImageModal');
        const cropperInput = $('#cropperInput');
        const cropperDisplay = $('#cropperDisplay');
        const cropBtn = $('#cropBtn');
        const croppedImage = $('#croppedImage');
        const updateProfileForm = $('#updateProfileForm');
        let isCropperLoaded = false;

        accountNumber.mask('9999999999');

        $.ajax({
            method: "get",
            url: "{{route('getBanks')}}",
            success: function(data){
                if(data.status === true){
                    const resp = data.data.banks;
                    let html = '<option value="">--Select Bank--</option>';
                    for(let i = 0; i < resp.length; i++){
                        const selected = (Number(data.data.selected) === Number(resp[i].code)) ? 'selected' : '';
                        html += '<option ' + selected + ' value="' + resp[i].code + '">' + resp[i].name + '</option>';
                    }
                    bankName.html(html);
                }
            }
        });

        accountNumber.on('keyup', function(){
            const input = $(this).val().trim();
            const bank = bankName.val();
            if(input.length === 10 && bank.length){
                accountNumber.attr("disabled", true);
                accountNameDiv.hide();
                errorAlert.hide();
                bankLoader.show();
                $.ajax({
                    method: "get",
                    url: "{{route('getBankAccount')}}",
                    data: {bank: bank, account_number: input },
                    success: function(data){
                        bankLoader.hide();
                        console.log(data);
                        if(data.status === true){
                            accountNumber.attr("disabled", false);
                            accountName.val(data.data);
                            accountNameDiv.show();
                            bankNameHidden.val($('#bankSelect option:selected').text());
                        }
                    },
                    error: function(){
                        accountNumber.attr("disabled", false);
                        bankLoader.hide();
                        errorAlert.show();
                    }
                });
            } else {
                bankLoader.hide();
            }
        });

        updateImageBtn.on('click', function(){
            showProfileModal();
        });

        function showProfileModal(){
            updateImageModal.modal();

        }

        cropperInput.on('change', function(e){
            var reader = new FileReader();
            const file = e.target.files[0];

            var types = ["image/jpeg", "image/jpg", "image/png"];

            if(types.includes(file.type)){
                cropBtn.show();
                if(!isCropperLoaded){
                    cropperDisplay.croppie({
                        enableExif: true,
                        viewport: {
                            width: 200,
                            height: 200,
                            type: 'square'
                        },
                        boundary: {
                            width: 250,
                            height: 250
                        }
                    });

                    isCropperLoaded = true;
                }

                reader.addEventListener("load", function(e){
                    cropperDisplay.croppie('bind', {
                        url: e.target.result
                    }).then(function(){
                    });
                });

                reader.readAsDataURL(file);
            } else {
                cropBtn.hide();
            }
        });
        cropBtn.on('click', function(e){
            cropperDisplay.croppie('result', {
                type: 'canvas',
                size: 'viewport',
            }).then(function (resp) {
                croppedImage.val(resp);
                updateProfileForm.submit();
            })
        });



    </script>
    @endsection
