@if(session()->has('success-message'))
        
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        <strong> {{ session()->get('success-message') }}</strong> 

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

            <span aria-hidden="true">&times;</span>

        </button>

    </div>

@endif