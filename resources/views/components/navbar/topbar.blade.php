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