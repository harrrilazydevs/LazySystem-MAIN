<nav aria-label="breadcrumb" >

    <ol class="breadcrumb">
        
        @if ($ld_nav_bread_crumb)

            @foreach ($ld_nav_bread_crumb as $item)

                @if ( $item[1] == 'SELECTED')

                    <li class="breadcrumb-item active font-weight-bold" aria-current="page"  style="color:#323232">{{$item[0]}}</li>
                    
                @else

                    <li class="breadcrumb-item"><a href="{{$item[1]}}" class="text-muted" >{{$item[0]}}</a></li>
                    
                @endif
                
                
            @endforeach
            
        @endif
 
    </ol>

</nav>