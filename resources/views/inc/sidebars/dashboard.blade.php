
<div class="bs-canvas-content accordion mt-lg-2  mt-4 py-1 " >

    <div class="breaker pt-3 mt-4 mt-lg-5"></div>

    @foreach ($page_settings['ld_sidebar'] as $ld_main)

        <div class="1-cut ">

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center mt-2 mb-3 pl-4 text-light" style="font-family: 'Atkinson Hyperlegible', sans-serif; font-style: 15pt !important;">
                
                <span>{{$ld_main[0]}}</span>
            
            </h6>

            <ul class="nav flex-column pl-3 py-1">

                @foreach ( $ld_main[1] as $ld_modules )

                    @if (is_array($ld_modules))

                        @if ( $ld_modules[1] == 'nav-item' )

                            <li class="nav-item my-1 ">
            
                                <a class="nav-link ld-nav-item text-light py-1 " href="{{$ld_modules[3]}}" style="font-size: 10pt;" >
                                    
                                    <i class="{{$ld_modules[2]}} fa-fw mr-2" style="font-size: 11pt;" ></i>

                                    {{$ld_modules[0]}}
                                </a>
                                
                            </li>
                            
                        @endif

                        @if ( $ld_modules[1] == 'collapse' )

                            <li class="nav-item my-1 ">
                
                                <a class="nav-link ld-nav-item text-light py-1 "  style="font-size: 10pt;" data-toggle="collapse" data-target="#{{$ld_modules[3]}}" >
                                    
                                    <i class="{{$ld_modules[2]}} fa-fw mr-2" style="font-size: 11pt;"></i>

                                    {{$ld_modules[0]}}
                                </a>
                                
                            </li>

                            <div class="row py-0 my-0 " style="background: #4d698541!important; max-height: 200px; overflow: auto;">

                                <div class="col">
                    
                                    <div id="{{$ld_modules[3]}}" class="collapse my-1">

                                        @foreach ( $ld_modules[4] as $ld_module_mini )

                                            <li class="nav-item my-0">
                            
                                                <a class="nav-link ld-nav-item-mini text-light ml-3" href="{{$ld_module_mini[3]}}" style="font-size: 10pt;">
                    
                                                    <i class="{{$ld_module_mini[2]}} fa-fw fa-sm mr-2" style="font-size: 9pt;"></i>

                                                    {{$ld_module_mini[0]}}

                                                </a>
                                                
                                            </li>
                                    
                                        @endforeach

                                    </div>
                                
                                </div>
                            
                            </div>
                            
                        @endif

                    @endif
                        
                @endforeach

            </ul>
    
        </div>      

    @endforeach

      