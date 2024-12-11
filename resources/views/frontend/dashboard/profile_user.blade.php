@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
<div class="flex-wrap mb-5 breadcrumb-content d-flex align-items-center justify-content-between">
    <div class="media media-card align-items-center">
        <div class="rounded-full media-img media--img media-img-md">
            <img class="rounded-full" src="{{(!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo): url('upload/no_image.jpg')}}" alt="Student thumbnail image">
        </div>
        <div class="media-body">
            <h2 class="section__title fs-30">Hello, {{$profileData->name}}</h2>
            <div class="pt-2 rating-wrap d-flex align-items-center">
                <div class="review-stars">
                    <span class="rating-number">4.4</span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star"></span>
                    <span class="la la-star-o"></span>
                </div>
                <span class="pl-1 rating-total">(20,230)</span>
            </div><!-- end rating-wrap -->
        </div><!-- end media-body -->
    </div><!-- end media -->
    <div class="file-upload-wrap file-upload-wrap-2 file--upload-wrap">
        <input type="file" name="files[]" class="multi file-upload-input">
        <span class="file-upload-text"><i class="mr-2 la la-upload"></i>Upload a course</span>
    </div><!-- file-upload-wrap -->
</div><!-- end breadcrumb-content -->
<div class="mb-5 section-block"></div>
<div class="mb-5 dashboard-heading">
    <h3 class="fs-22 font-weight-semi-bold">Settings</h3>
</div>
<ul class="nav nav-tabs generic-tab pb-30px" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="edit-profile-tab" data-toggle="tab" href="#edit-profile" role="tab" aria-controls="edit-profile" aria-selected="false">
            Profile
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="true">
            Password
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="change-email-tab" data-toggle="tab" href="#change-email" role="tab" aria-controls="change-email" aria-selected="false">
            Change Email
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab" aria-controls="withdraw" aria-selected="false">
            Withdraw
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">
            Account
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Edit Profile</h3>
            <form method="post" action="{{route('user.profile.update')}}" class="row pt-40px" enctype="multipart/form-data">
                @csrf
            <div class="media media-card align-items-center">
                <div class="mr-4 media-img media-img-lg bg-gray">
                    <img class="mr-3" src="{{(!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo): url('upload/no_image.jpg')}}" alt="avatar image">
                </div>
                <div class="media-body">
                    <div class="file-upload-wrap file-upload-wrap-2">
                        <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                        <span class="file-upload-text"><i class="mr-2 la la-photo"></i>Upload a Photo</span>
                    </div><!-- file-upload-wrap -->
                    <p class="fs-14">Max file size is 5MB, Minimum dimension: 200x200 And Suitable files are .jpg & .png</p>
                </div>
            </div><!-- end media -->
            
                <div class="input-box col-lg-6">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="name" value="{{$profileData->name}}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="address" value="{{$profileData->address}}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Username</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="username" value="{{$profileData->username}}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" value="{{$profileData->email}}">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12">
                    <label class="label-text">Phone Number</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="phone" value="{{$profileData->phone}}">
                        <span class="la la-phone input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                {{-- <div class="input-box col-lg-12">
                    <label class="label-text">Bio</label>
                    <div class="form-group">
                        <textarea class="pl-3 form-control form--control user-text-editor" name="message">Hello! I am Alex Smith Washington area graphic designer with over 6 years of graphic design experience. I specialize in designing infographics, icons, brochures, and flyers</textarea>
                    </div>
                </div><!-- end input-box --> --}}
                <div class="py-2 input-box col-lg-12">
                    <button class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->


    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Change Password</h3>
            <form method="post" action="{{route('user.password.update')}}" enctype="multipart/form-data">
                @csrf
                <div class="input-box col-lg-4">
                    <label class="label-text">Old Password</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="password" name="old_password" placeholder="Old Password" class="form-control" @error('old_password') is-invalid @enderror id="old_password">
                        @error('old_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="password" name="new_password" placeholder="New Password">
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">Confirm New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="password" name="new_password_confirmation" placeholder="Confirm New Password">
                        <span class="la la-lock input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="py-2 input-box col-lg-12">
                    <button class="btn theme-btn">Change Password</button>
                </div><!-- end input-box -->
            </form>
            <form method="post" class="pt-5 mt-5 border-top border-top-gray">
                <h3 class="pb-1 fs-17 font-weight-semi-bold">Forgot Password then Recover Password</h3>
                <p class="pb-4">Enter the email of your account to reset password. Then you will receive a link to email
                    to reset the password. If you have any issue about reset password
                    <a href="contact.html" class="text-color">contact us</a></p>
                <div class="input-box">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="email" name="email" placeholder="Enter email address">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="py-2 input-box">
                    <button class="btn theme-btn">Recover Password</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
    <div class="tab-pane fade" id="change-email" role="tabpanel" aria-labelledby="change-email-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Change Email</h3>
            <form method="post" class="row">
                <div class="input-box col-lg-4">
                    <label class="label-text">Old Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" placeholder="Old Email">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">New Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" placeholder="New Email">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">Confirm New Email</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" placeholder="Confirm New Email">
                        <span class="la la-envelope input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="py-2 input-box col-lg-12">
                    <button class="btn theme-btn">Change Email</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
    <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">Select a Withdraw Method</h3>
            <form method="post" class="row mb-40px">
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="bankTransfer" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="bankTransfer">
                            <span class="text-black font-weight-semi-bold d-block">Bank Transfer</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="eCheck" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="eCheck">
                            <span class="text-black font-weight-semi-bold d-block">E-Check</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="payoneer" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="payoneer">
                            <span class="text-black font-weight-semi-bold d-block">Payoneer</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="PayPal" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="PayPal">
                            <span class="text-black font-weight-semi-bold d-block">PayPal</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="skrill" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="skrill">
                            <span class="text-black font-weight-semi-bold d-block">Skrill</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
                <div class="col-lg-2 responsive-column-half">
                    <div class="pl-0 mb-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="stripe" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="stripe">
                            <span class="text-black font-weight-semi-bold d-block">Stripe</span>
                            <span class="d-block fs-14 lh-18">Min withdraw $50.00</span>
                        </label>
                    </div>
                </div><!-- end col-lg-2 -->
            </form>
            <form method="post" class="row">
                <h3 class="pb-4 fs-17 font-weight-semi-bold col-lg-12">Account info</h3>
                <div class="input-box col-lg-4">
                    <label class="label-text">Account Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" value="Alex Smith">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">Account Number</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" value="3275476222500">
                        <span class="la la-pencil input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-4">
                    <label class="label-text">Bank Name</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" value="South State Bank">
                        <span class="la la-bank input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">IBAN</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" value="3030">
                        <span class="la la-pencil input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">BIC/SWIFT</label>
                    <div class="form-group">
                        <input class="form-control form--control" type="text" name="text" value="CDDHDBBL">
                        <span class="la la-pencil input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="py-2 input-box col-lg-12">
                    <button class="btn theme-btn">Save withdraw account</button>
                </div><!-- end input-box -->
            </form>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
    <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
        <div class="setting-body">
            <h3 class="pb-4 fs-17 font-weight-semi-bold">My Account</h3>
            <form method="post" class="mb-40px">
                <div class="flex-wrap custom-control-wrap d-flex align-items-center">
                    <div class="flex-shrink-0 pl-0 mb-2 mr-3 custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="deactivateAccount" name="radio-stacked" required>
                        <label class="custom-control-label custom--control-label custom--control-label-boxed" for="deactivateAccount">
                            <span class="text-black font-weight-semi-bold">Deactivate Account</span>
                        </label>
                    </div>
                    <button class="mb-2 btn theme-btn">Deactivate</button>
                </div><!-- end custom-control-wrap -->
            </form>
            <div class="section-block"></div>
            <div class="danger-zone pt-40px">
                <h4 class="fs-17 font-weight-semi-bold text-danger">Delete Account Permanently</h4>
                <p class="pt-1 pb-4"><span class="text-warning">Warning: </span>Once you delete your account, there is no going back. Please be certain.</p>
                <button class="btn theme-btn" data-toggle="modal" data-target="#deleteModal">Delete my account</button>
            </div>
        </div><!-- end setting-body -->
    </div><!-- end tab-pane -->
</div><!-- end tab-content -->

@endsection
