@extends('layouts.dashboard')

@section('content')

<div class="fd" identifier="{{$page_settings['identifier']}}"></div>

    <div class="container">

        <div class="row mt-3">

            <div class="col">

                <h4 style="font-family: 'Atkinson Hyperlegible', sans-serif; color:#191919;">{{$page_settings['page_subtitle']}}</h4>

            </div>

        </div>

        @include('inc.navs.breadcrumb')

        @include('inc.alerts.basic')

        <div class="container-fluid">

            <div class="row">

                <div class="col">

                    <div class="ld-card shadow-sm ld-font-card">

                        <div class="card-header ld-font-card-header">
        
                            <h4 class="card-heading ld-font-card-heading">Change Password</h4>
        
                        </div>
        
                        <div class="card-body pb-3">

                            <div class="alert alert-danger alert-dismissible fade show d-none" role="alert">

                                Passwords do not match
                                
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                  <span aria-hidden="true">&times;</span>

                                </button>

                            </div>

                            <form action="/UNIV/EDIT/EMP/PASSWORD" id="formChangePass" method="post">

                                @csrf

                                <input type="text" name="v1" value="1" hidden>
                                <input type="text" name="v2" value="Password Changed Successfully." hidden>
                                <input type="text" name="v3" value="" id="formChangePassV3" hidden>

                                <label class="text-uppercase form-label mb-2" for="email">Password</label>

                                <div class="row">
                                    
                                    <div class="col-lg-7 col-10">
                                      
                                        <input id="txt_password_1" type="password" class="form-control" required>
                                 
                                    </div>

                                    <div class="col-lg-5 col-2 px-0 pt-2">
                                      
                                       <a class="ld-mouse-point ld-eye-peek" ld-peek-id="#txt_password_1"><i class="fas fa-eye"></i></a> 
                                 
                                    </div>

                                </div>

                                <label class="text-uppercase form-label mb-0 mt-2" for="email">Confirm Password</label>
                                
                                <div class="row my-2 mb-3">

                                    <div class="col-lg-7 col-10">
                                      
                                        <input id="txt_password_2" name="2" type="password" class="form-control " required>
                                 
                                        <div class="invalid-feedback">

                                            Passwords do not match

                                        </div>

                                    </div>

                                    <div class="col-lg-5 col-2 px-0 pt-2">
                                      
                                       <a class="ld-mouse-point ld-eye-peek" ld-peek-id="#txt_password_2"><i class="fas fa-eye"></i></a> 
                                 
                                    </div>

                                </div>

                                <div class="row my-2">

                                    <div class="col-lg-7 col-12">

                                       <button type="submit" class="btn btn-sm btn-primary ">Save Changes</button>

                                    </div>
                                    
                                </div>

                            </form>

                        </div>
                
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@section('script')

  @include('inc\js\dashboard\functions\profile') 

@endsection

