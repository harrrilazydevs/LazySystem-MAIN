<div class="shadow-sm pt-3 pb-1 px-4 mb-3 bg-white">

    @foreach ($widget_settings as $wkey => $setting)

        @if ( $wkey  == 'record')

            <div class="my-2">

                <h6 class="font-weight-bold mb-2">RECORD</h6>

                <ul class="list-group list-group-flush">

                    @foreach ($setting as $skey => $value)

                        @if ($skey == 'r-add')
                                
                            @if ( $value )
                                
                                <a class="list-group-item ld-list-item  {{$value}}">

                                    <i class="far fa-plus-square fa-fw mr-2" style="font-size:13pt;"></i>New Record

                                </a>
                                
                            @endif
                            
                        @endif

                        @if ($skey == 'r-archive')

                            @if ( $value )

                                <a class="list-group-item ld-list-item {{$value}}">

                                    <i class="fas fa-file-archive fa-fw mr-2 " style="font-size:13pt;"></i>Archived Records
                        
                                </a>

                            @endif
                            
                        @endif

                    @endforeach

                </ul>
                
            </div>
            
        @endif

        @if ( $wkey  == 'import')

            <div class="my-2">

                <h6 class="font-weight-bold mb-2">IMPORT</h6>

                <ul class="list-group list-group-flush">

                    @foreach ($setting as $skey => $value)

                        @if ($skey == 'i-excel')

                            @if ( $value )
                                
                                <a class="list-group-item ld-list-item {{$value}}">

                                    <i class="far fa-file-excel fa-fw mr-2 " style="font-size:13pt;"></i> From Excel
                        
                                </a>
                                
                            @endif
                            
                        @endif

                        @if ($skey == 'i-sql')

                            @if ( $value )

                                <a class="list-group-item ld-list-item {{$value}}">

                                    <i class="fas fa-database fa-fw mr-2 " style="font-size:13pt;"></i> From SQL

                                </a>
                                
                            @endif
                            
                        @endif
                        
                    @endforeach

                </ul>
                
            </div>
            
        @endif

        @if ( $wkey  == 'export')

            <div class="my-2">

                <h6 class="font-weight-bold mb-2">EXPORT</h6>

                <ul class="list-group list-group-flush">

                    @foreach ($setting as $skey => $value)

                        @if ($skey == 'e-pdf')

                            @if ( $value )

                                <a class="list-group-item ld-list-item {{$value}}">

                                    <i class="far fa-file-pdf fa-fw mr-2 " style="font-size:13pt;"></i> To PDF
                        
                                </a>
                                
                            @endif
                            
                        @endif

                        @if ($skey == 'e-excel')

                            @if ( $value )

                                <a class="list-group-item ld-list-item {{$value}}">

                                    <i class="far fa-file-excel fa-fw mr-2 " style="font-size:13pt;"></i> To Excel

                                </a>
                                
                            @endif
                            
                        @endif
                        
                    @endforeach

                </ul>
                
            </div>
 
        @endif

    @endforeach

</div>