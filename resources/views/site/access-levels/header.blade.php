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
        <a href="{{ url('/niveis-de-acesso/novo') }}">
            <button class="btn btn-primary">
                Novo
                {{-- <div class="icon-container">
                            <i class="fa-solid fa-plus fa-sm"></i> --}}
                    {{-- <i class="fa-solid fa-filter"></i> --}}
                {{-- </div> --}}
            </button>
        </a>
    </div>
</header>
