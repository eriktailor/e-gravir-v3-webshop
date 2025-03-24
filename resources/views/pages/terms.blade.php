@extends ('layouts.shop')

@section ('title', 'Általános Szerződési Feltételek')

@section ('metas')
    <meta name="robots" content="noindex">
@endsection

@section('content')

    <main class="markdown">
        <div class="container">
            <div class="max-w-3xl mx-auto">
                {!! $html !!}
            </div>
        </div>
    </main>

@endsection