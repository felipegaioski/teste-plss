<header>
    <div class="d-flex justify-content-between mx-2">
        <div class="icon-container">
            @if (request()->url() === url('/niveis-de-acesso'))
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @else
            <a href="{{ url('/niveis-de-acesso') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
        </div>
        <div class="title-container">
            <h1 class="title m-0">Níveis de acesso</h1>
        </div>
        <div class="icon-container">
            <a href="{{ url('/niveis-de-acesso/novo') }}"><i class="fa-solid fa-plus"></i></a>
            {{-- <i class="fa-solid fa-filter"></i> --}}
        </div>
    </div>
</header>
