<header>
    <div class="d-flex justify-content-between mx-2">
        <div class="icon-container">
            @if (request()->url() === url('/usuarios'))
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @else
            <a href="{{ url('/usuarios') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
        </div>
        <div class="title-container">
            <h1 class="title m-0">Usuários</h1>
        </div>
        <div class="icon-container">
            <a href="{{ url('/usuarios/novo') }}"><i class="fa-solid fa-plus"></i></a>
            {{-- <i class="fa-solid fa-filter"></i> --}}
        </div>
    </div>
</header>
