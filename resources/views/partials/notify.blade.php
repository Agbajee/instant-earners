<link rel="stylesheet" href="{{ asset('vendor/iziToast/iziToast.min.css') }}">
<script src="{{ asset('vendor/iziToast/iziToast.min.js') }}"></script>

@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            'use strict';
            iziToast.{{ $msg[0] }}({message:"{{ $msg[1] }}", position: "bottomRight"});
        </script>
    @endforeach
@endif

@if ($errors->any())
    <script>
        'use strict';
        @foreach ($errors->all() as $error)
        iziToast.error({
            message: '{{ $error }}',
            position: "bottomRight"
        });
        @endforeach
    </script>

@endif
<script>
    'use strict';
    function notify(status,message) {
        iziToast[status]({
            message: message,
            position: "bottomRight"
        });
    }
</script>
