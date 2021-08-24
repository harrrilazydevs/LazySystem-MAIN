@extends('layouts.dashboard')

@section('content')

    {{-- !!! VERY IMPORTANT DO NOT REMOVE THIS !!! --}}
    <div class="fd" identifier="{{$page_settings['identifier']}}"></div>

    <div class="container-fluid px-5">

        <div class="row mt-3">

            <div class="col">

                <h4 style="font-family: 'Atkinson Hyperlegible', sans-serif; color:#191919;">{{ $page_settings['page_subtitle'] }}</h4>
            </div>

        </div>

        @include('inc.navs.breadcrumb')

        @include('inc.alerts.basic')

        {{-- ADD CONTENT HERE --}}

            <div class="container-fluid px-0">

                <div class="row">

                    <div class="col-lg-3">

                        @include('inc.widgets.side-widget')

                    </div>

                    <div class="col-lg-9 ">

                        <div class=" shadow-sm px-3 mb-3 bg-white">

                            <div class="row py-2 ">

                                <div class="col-9 pt-1">

                                    <h6 class="card-heading ld-font-card-heading ">{{ $table_title }}</h6>

                                </div>

                                <div class="col-3">

                                    <select class="form-control form-control-sm mt-1">

                                        <option value="">- Filter -</option>

                                        <option value="">Value</option>

                                        <option value="">Date Range</option>

                                    </select>

                                </div>

                            </div>
                            
                        </div>

                        <div class="row">

                            <div class="col">

                                <div class="table-responsive mb-3 shadow-sm " style="height:310px;">
                            
                                    <table class="table table-hover table-sm bg-white rounded " >
                    
                                        <thead style="font-size:10pt; border-radius:20px; !important" class="ld-sticky-header" >
                        
                                            <tr>

                                                <th class="text-center" width="2%">#</th>
                                                
                                                @foreach ($table_settings['headers'] as $header)
                                                    
                                                <th class="text-center" width="{{$header[1]}}%">{{$header[0]}}</th>

                                                @endforeach

                                                @if ( array_key_exists('buttons',$table_settings) )
                                                
                                                    <th class="text-center" width="15%"></th>

                                                @endif
                                            
                                            </tr>
                        
                                        </thead>
                        
                                        <tbody >

                                            @php

                                                $count=1;

                                            @endphp

                                            @foreach ($table_contents as $DATA)
        
                                                <tr class="py-0 my-0">

                                                    <th class="text-center" width="5%">{{$count++}}</th>

                                                    @foreach ($table_settings['body'] as $body)

                                                        @if (isset($body[2]))

                                                            @foreach ($body[2] as $key => $special)

                                                                @if ( $key = 'LD-PILLS' )

                                                                    @if ( $special[0] == 'PILL-RED' )

                                                                        @if ( $special[1] == $DATA->{$body[0]} )

                                                                            <td class="{{$body[1]}}" >

                                                                                <span class="badge rounded-pill bg-danger text-light p-2" style="width:{{$special[2]}}px">{{ $DATA->{$body[0]} }}</span>

                                                                            </td>
                                                                            
                                                                        @endif

                                                                    @elseif ($special[0] == 'PILL-GREEN' )

                                                                        @if ( $special[1] == $DATA->{$body[0]} )

                                                                            <td class="{{$body[1]}}" >

                                                                                <span class="badge rounded-pill bg-success text-light p-2" style="width:{{$special[2]}}px">{{ $DATA->{$body[0]} }}</span>

                                                                            </td>
                                                                                
                                                                        @endif

                                                                    @elseif ($special[0] == 'PILL-BLUE' )

                                                                        @if ( $special[1] == $DATA->{$body[0]} )

                                                                            <td class="{{$body[1]}}" >

                                                                                <span class="badge rounded-pill bg-primary text-light p-2" style="width:{{$special[2]}}px">{{ $DATA->{$body[0]} }}</span>

                                                                            </td>
                                                                                
                                                                        @endif

                                                                    @elseif ($special[0] == 'PILL-YELLOW' )

                                                                        @if ( $special[1] == $DATA->{$body[0]} )

                                                                            <td class="{{$body[1]}}" >

                                                                                <span class="badge rounded-pill bg-warning text-dark p-2" style="width:{{$special[2]}}px">{{ $DATA->{$body[0]} }}</span>

                                                                            </td>
                                                                                
                                                                        @endif
                                                                   
                                                                    @endif

                                                                @endif
                                                                
                                                            @endforeach
                                                
                                                        @else
                                                            
                                                            <td class="{{$body[1]}}" >{{ $DATA->{$body[0]} }}</td>

                                                        @endif

                                                    @endforeach

                                                    @if ( array_key_exists('buttons',$table_settings) )

                                                        @foreach ($table_settings['buttons'] as $button)

                                                            <td class="text-center" style="font-size: 11pt;color: #3490DC !important;">
                                                                
                                                                @foreach ($button as $key => $btn)

                                                                    @if ($key == 'view')

                                                                        <a class="text-center ld-mouse-point  {{ $btn['trigger'] }} " 

                                                                            @foreach ($btn['attribs'] as $attr)

                                                                                {{ $attr[0] }} ="{{ $DATA->{$attr[1]} }}" 
                                                                                
                                                                            @endforeach
                                                                            
                                                                        ><i class="fa fa-eye fa-fw" ></i></a>

                                                                    @endif

                                                                    @if ($key == 'edit')
                                                                                
                                                                        <a class="text-center ld-mouse-point {{ $btn['trigger'] }} " 

                                                                            @foreach ($btn['attribs'] as $attr)

                                                                                {{ $attr[0] }} ="{{ $DATA->{$attr[1]} }}" 
                                                                                
                                                                            @endforeach
                                                                        
                                                                        ><i class="fa fa-edit fa-fw" ></i></a>

                                                                    @endif

                                                                    @if ($key == 'delete')
                                                                                    
                                                                        <a class="text-center ld-mouse-point {{ $btn['trigger'] }} " 

                                                                            @foreach ($btn['attribs'] as $attr)

                                                                                {{ $attr[0] }} ="{{ $DATA->{$attr[1]} }}" 
                                                                                
                                                                            @endforeach
                                                                    
                                                                        ><i class="fa fa-trash-alt fa-fw" ></i></a>

                                                                    @endif

                                                                @endforeach
                                                                    
                                                            </td>

                                                        @endforeach
                                             
                                                    @endif
                            
                                                </tr>
                                                
                                            @endforeach
                                            
                                        </tbody>
                        
                                    </table>
        
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-7">

                                {{ 'Showing ' . $table_contents->firstItem().' - '. $table_contents->lastItem() . ' of ' . $table_contents->total()  }}
  
                              </div>

                            <div class="col-5 ">

                              {{ $table_contents->links() }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        {{-- END CONTENT HERE --}}


    </div>

@endsection

@section('script')

  @include('inc\js\dashboard\functions\profile') 

@endsection

