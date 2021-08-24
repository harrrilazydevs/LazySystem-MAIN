@extends('layouts.dashboard')

@section('content')

{{-- VERY IMPORTANT --}}
<div class="fd" identifier="{{ $page_settings['identifier'] }}"></div>

    <div class="container">

        <div class="row mt-3">

            <div class="col">

                <h4 style="font-family: 'Atkinson Hyperlegible', sans-serif; color:#191919;">{{ $page_settings['page_subtitle'] }}</h4>

            </div>

        </div>

        @include('inc.navs.breadcrumb')

        @include('inc.alerts.basic')

        {{-- THE ACTUAL CONTENT STARTS HERE --}}
        @foreach ($acc_data as $data)

        <div class="row">

            <div class="mb-lg-5 mb-lg-3  col-lg-4">

                <div class="container-fluid px-0">

                    <div class="row ">

                        <div class="col">

                            <div class="ld-card shadow-sm ld-font-card">

                                <div class="card-body container">

                                    <div class="row">

                                        <div class="col">
                                            <a style="float:right; font-size:10pt; margin-top:-10px;margin-right:-18px;color:white;" class="btn emp_chg_profile">
                
                                                <i class="fas fa-camera p-1" style="border-radius:20px; background: grey;"></i>
                                            
                                            </a>
                                        </div>
                                    </div>
                
                                    <div class="row">
                
                                        <div class="col text-center">

                                            <img class="img-fluid rounded-circle mx-auto" src="{{$page_settings['profile_url']}}" style="height: 150px; width: 150px; " >
                
                                        </div>
                
                                    </div>
                
                                    <div class="row">
                
                                        <div class="col text-center font-weight-bold mt-3">
                
                                            <h4 class="font-weight-bold" style="font-family: 'Roboto Condensed', sans-serif;">{{$username}}</h4>
                
                                        </div>
                
                                    </div>
                
                                    <div class="row">
                
                                        <div class="col text-center">
                
                                            <label style="font-family: 'Roboto Condensed', sans-serif;">{{$page_settings['role']}}</label>
                
                                        </div>
                
                                    </div>
                
                                </div>
                        
                            </div>

                        </div>

                    </div>

                    <div class="row  mt-3">

                        <div class="col">

                            <div class="ld-card shadow-sm ld-font-card">

                                <div class="card-body container">

                                    <a class="font-weight-bold" style="font-family: 'Roboto Condensed', sans-serif; color:#191919;">Signature</a>
                
                                    <div class="row">
                
                                        <div class="col text-center">
                
                                            <img class="ml-4" src="{{$signature_url}}" style="width:50%; border-radius: 20px;" alt="">
                                            
                                            <a style="float:right; font-size:10pt; margin-top:-35px;margin-right:-8px;color:white;" class="btn emp_chg_signature">
                
                                                <i class="fas fa-camera p-1" style="border-radius:20px; background: grey;"></i>
                                            
                                            </a>

                                        </div>
                
                                    </div>
                
                                </div>
                        
                            </div>

                        </div>

                    </div>

                    <div class="row  mt-3">

                        <div class="col">

                            <div class="ld-card shadow-sm ld-font-card">

                                <div class="card-body container">

                                    <a href="#" class="font-weight-bold" style="font-family: 'Roboto Condensed', sans-serif; color:#191919;">Requirements</a>
                
                                    <div class="row mt-2">
                
                                        <div class="col text-center">

                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                              </div>
                
                                        </div>
                
                                    </div>
                
                                </div>
                        
                            </div>

                        </div>

                    </div>

                    <div class="row  mt-3">

                        <div class="col">

                            <div class="ld-card shadow-sm ld-font-card">

                                <div class="card-body container">

                                    <a href="#" class="font-weight-bold" style="font-family: 'Roboto Condensed', sans-serif; color:#191919;">Tasks</a>
                
                                    <div class="row mt-2">
                
                                        <div class="col text-center">

                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                  Migrate student data
                                                  <span class="badge badge-warning badge-pill">pending</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                  Report to Es
                                                  <span class="badge badge-warning badge-pill">pending</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                  Complete requirements
                                                  <span class="badge badge-warning badge-pill">pending</span>
                                                </li>
                                              </ul>
                
                                        </div>
                
                                    </div>
                
                                </div>
                        
                            </div>

                        </div>

                    </div>

                   
                </div>
            
            </div>

            <div class="mb-5 mt-3 mt-lg-0 col-lg-8">

                <div class="container-fluid px-0 ">

                    <div class="row">

                        <div class="col">

                            <div class="ld-card shadow-sm ld-font-card">

                                <div class="card-header ld-font-card-header">
                
                                    <h4 class="card-heading ld-font-card-heading">Account Information</h4>

                                    <a class="btn ld-icon-edit" id="btnAccountInfo" 

                                    employee_role="{{$page_settings['role']}}"

                                    identifier="{{$page_settings['identifier']}}"

                                    email="{{$data->email}}"

                                    >
                
                                        <i class="far fa-edit"></i>
                                    
                                    </a>
                
                                </div>
                
                                <div class="card-body">
                
                                    <div class="mb-lg-4">
                                
                                        <div class="row">

                                            <div class="col-6 pr-0">

                                                <label class="text-uppercase form-label" for="email">Email</label>

                                                <input readonly name="email" id="email" type="email" class="form-control account_info" value="{{$data->email}}">

                                            </div>

                                            <div class="col-6 ">

                                                <label class="text-uppercase form-label" for="employeeNo">Position</label>

                                                <input readonly name="employeeNo" id="employeeNo" type="text" class="form-control account_info" value="{{$page_settings['role']}}">

                                            </div>

                                        </div>

                                    </div>
                                    
                                    <div class="mb-lg-4">
                                
                                        <label class="text-uppercase form-label" for="email">Password</label>

                                        <div class="row">

                                            <div class="col-11 pr-0 mr-0 pb-0">

                                                <a class="btn form-control border" href="/dashboard/changepassword"> Change Password </a>

                                            </div>

                                            <div class="col-1 py-2 pl-0 pr-3 text-right">

                                                <a class=" p-0 btn" type="button"  data-container="body" data-toggle="popover" data-placement="bottom"
                                                data-content="The request password link will be sent to your email">

                                                    <i class="far fa-question-circle" style="font-size:12pt; color:#343A40;"></i>

                                                </a>

                                            </div>

                                        </div>
                                        
                                    </div>
                                
                                </div>
                        
                            </div>

                        </div>

                    </div>

    @endforeach

    @foreach ($p_data as $item)

                <div class="row my-3">

                    <div class="col">

                        <div class="ld-card shadow-sm ld-font-card">

                            <div class="card-header ld-font-card-header">
            
                                <h4 class="card-heading ld-font-card-heading">Personal Information</h4>

                                <a class="btn ld-icon-edit" 

                                    id="btnPersonalInfo" 

                                    ld-edit-mode = "1"

                                >
                                
                                    <i class="far fa-edit" id="edit_icon"></i>
                                    <i class="fas fa-times d-none" id="edit_cancel_icon"></i>
                                
                                </a>
            
                            </div>
            
                            <div class="card-body">

                                <form action="/UNIV/EDIT/FST" method="POST">

                                    @csrf

                                    <input name="_fn" value = "profile" hidden>
                                    <input name="_tc" value = "0" hidden>
                                    <input name="_pk" value = "{{$page_settings['identifier']}}" hidden>
                                    <input name="_pc" value = "employee_code" hidden>
                                    <input name="_bm" value = "Personal Information Updated Successfully!" hidden>

                                    <div class="mb-lg-3">

                                        <div class="row">

                                            <div class="col-lg-4 my-1">

                                                <label class="text-uppercase form-label" for="email">First Name</label>
                                    
                                                <input  readonly name="fname" id="fname" type="text"  class="form-control p_info" value="{{$item->fname}}">
                                            
                                            </div>

                                            <div class="col-lg-3 my-1 pl-lg-0">

                                                <label class="text-uppercase form-label" for="email">Middle Name</label>
                                    
                                                <input  readonly name="mname" id="mname" type="text"  class="form-control p_info" value="{{$item->mname}}">
                                            
                                            </div>

                                            <div class="col-lg-3 my-1 pl-lg-0 pr-lg-0">

                                                <label class="text-uppercase form-label" for="email">Last Name</label>
                                    
                                                <input  readonly name="lname" id="lname" type="text"  class="form-control p_info" value="{{$item->lname}}">
                                            
                                            </div>

                                            <div class="col-lg-2 my-1">

                                                <label class="text-uppercase form-label" for="email">Suffix</label>
                                    
                                                <input  readonly name="suffix" id="suffix" type="text"  class="form-control p_info" value="{{$item->suffix}}">
                                            
                                            </div>

                                        </div>
            
                                    </div>

                                    <div class="mb-lg-3">

                                        <div class="row">

                                            <div class="col-lg-4 my-1">

                                                <label class="text-uppercase form-label" for="email">Gender</label>

                                                <select  class="form-control p_info" name="gender" id="gender" readonly>
                                                    
                                                    @if ($item->gender == 'Male')

                                                        <option value="Male" selected>Male</option>
                                                        
                                                    @else

                                                        <option value="Male" >Male</option>

                                                    @endif

                                                    @if ($item->gender == 'Female')

                                                        <option value="Female" selected>Female</option>
                                                    
                                                    @else

                                                        <option value="Female" >Female</option>

                                                    @endif

                                                 

                                                </select>
                                    
                                            </div>

                                            <div class="col-lg-3 my-1 pl-lg-0">

                                                <label class="text-uppercase form-label" for="email">Birth Place</label>
                                    
                                                <input  readonly name="birthplace" id="birthplace" type="text"  class="form-control p_info" value="{{$item->birthplace}}">
                                            
                                            </div>


                                            <div class="col-lg-3 my-1 pl-lg-0 pr-lg-0">

                                                <label class="text-uppercase form-label" for="email">Birth Date</label>
                                    
                                                <input  readonly name="birthdate" id="birthdate" type="date"  class="form-control p_info" value="{{$item->birthdate}}">
                                            
                                            </div>


                                            <div class="col-lg-2 my-1">

                                                <label class="text-uppercase form-label" for="email">Age</label>
                                    
                                                <input  readonly name="age" id="age" type="text"  class="form-control" value="{{$item->age}}">
                                            
                                            </div>

                                        </div>
                                
                                    </div>

                                    <div class="mb-lg-3">

                                        <div class="row">

                                            <div class="col-lg-4 my-1">

                                                <label class="text-uppercase form-label" for="email">Civil Status</label>
                                    
                                                <select  class="form-control p_info" name="civil_status" id="civil_status" readonly>

                                                    @if ($item->civil_status == 'Single')

                                                        <option value="Single" selected>Single</option>
                                                    
                                                    @else

                                                        <option value="Single" >Single</option>

                                                    @endif
                                                    
                                                    @if ($item->civil_status == 'Married')

                                                        <option value="Married" selected>Married</option>
                                                    
                                                    @else

                                                        <option value="Married" >Married</option>

                                                    @endif

                                                    @if ($item->civil_status == 'Widowed')

                                                        <option value="Widowed" selected>Widowed</option>
                                                    
                                                    @else

                                                        <option value="Widowed" >Widowed</option>

                                                    @endif

                                                  

                                                </select>

                                            </div>

                                            <div class="col-lg-3 my-1 pl-lg-0">

                                                <label class="text-uppercase form-label" for="email">Religion</label>
                                    
                                                <input  readonly name="religion" id="religion" type="text"  class="form-control p_info" value="{{$item->religion}}">
                                            
                                            </div>


                                            <div class="col-lg-5 my-1 pl-lg-0 ">

                                                <label class="text-uppercase form-label" for="email">Nationality</label>
                                    
                                                <input  readonly name="nationality" id="nationality" type="text"  class="form-control p_info" value="{{$item->nationality}}">
                                            
                                            </div>

                                        </div>
                                
                                    </div>

                                    <div class="mb-lg-3">

                                        <div class="row">

                                            <div class="col-lg-7 my-1">

                                                <label class="text-uppercase form-label" for="email">Email Address</label>
                                    
                                                <input readonly name="email_address" id="txtEmail" type="text"  class="form-control p_info" value="{{$item->email_address}}">
                                            
                                            </div>

                                            <div class="col-lg-5 my-1 pl-lg-0">

                                                <label class="text-uppercase form-label" for="email">Contact No</label>
                                    
                                                <input readonly name="mobile_no" id="contact" type="text"  class="form-control p_info" value="{{$item->mobile_no}}">
                                            
                                            </div>

                                        </div>
                                
                                    </div>
                            
                                    <div class="mb-lg-3">

                                        <div class="row">

                                            <div class="col-lg-7 my-1"></div>

                                            <div class="col-lg-5 my-1 text-right">

                                                <button class="btn btn-sm btn-primary d-none" id="btnSave" type="submit">Save Changes</button>
                                    
                                            </div>
                                        
                                        </div>
                                
                                    </div>

                                </form>

                            </div>
                    
                        </div>

                    </div>

                </div>
                
    @endforeach

                </div>
            
            </div>

        </div>

    </div>

      {{-- THE ACTUAL CONTENT ENDS HERE --}}

@endsection

@section('script')

  @include('inc\js\dashboard\functions\profile') 

@endsection

