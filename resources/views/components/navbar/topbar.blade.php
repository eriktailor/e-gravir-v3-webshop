<div id="topBar" class="hidden">
    @if(session('success'))
        <div class="bg-green-100 text-green-600 py-2">
            <div class="container">
                <div class="text-center">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-500 py-2">
            <div class="container">
                <div class="text-center">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif
</div>

@once('navbar')
    @push('scripts')
        <script>
            /**
             * Display topbar and hide it later, if have success or error message in session
             */
            $(document).ready(function() {
                if ($('#topBar').children().length) {
                    setTimeout(function(){
                        $('#topBar').slideDown(300);
                    }, 100);

                    setTimeout(function(){
                        $('#topBar').slideUp(500);
                    }, 10000);
                }
            });
        </script>
    @endpush
@endonce