<script src="{{asset('public/assets/js/app.js')}}" type="text/javascript"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }

    @if ($errors->any())
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach        
    @endif


    @if(Session::has('message'))
    var type = "{{ Session::get('alert-class') }}";
    console.log(type);

    switch (type) {
        case 'success':

            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>