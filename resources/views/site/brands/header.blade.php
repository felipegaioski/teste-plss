<header>
    <div class="d-flex justify-content-between mx-2">
        <div class="icon-container">
            @if (request()->url() === url('/marcas'))
            <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @else
            <a href="{{ url('/marcas') }}"><i class="fa-solid fa-arrow-left"></i></a>
            @endif
        </div>
        <div class="title-container">
            <h1 class="title m-0">Marcas</h1>
        </div>
        <div class="icon-container">
            {{-- <a href="{{ url('/products/novo') }}"><i class="fa-solid fa-plus"></i></a> --}}
        </div>
    </div>
</header>
