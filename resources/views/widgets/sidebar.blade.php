@php
    $categories = [
        [
            'name' => 'Chamados',
            'type' => 'tickets',
            'route' => '/chamados',
        ],
        [
            'name' => 'Usuários',
            'type' => 'users',
            'route' => '/usuarios',
        ],
        [
            'name' => 'Níveis de Acesso',
            'type' => 'access_levels',
            'route' => '/niveis-de-acesso',
        ],
        [
            'name' => 'Produtos',
            'type' => 'products',
            'route' => '/produtos',
        ],
        [
            'name' => 'Categorias',
            'type' => 'categories',
            'route' => '/categorias',
        ],
        [
            'name' => 'Marcas',
            'type' => 'brands',
            'route' => '/marcas',
        ],
    ];

    $menu_items = [];

    foreach ($categories as $key => $category) {
        foreach($user->access_level->permissions as $permission) {
            if ($permission->category->type == $category['type'] && $permission->type == 'view' && $permission->pivot && $permission->pivot->allow == true) {
                array_push($menu_items, $category);
            }
        }
    }
@endphp

<aside>
    <h1 class="d-none">PLSS</h1>
    <div class="sidebar-logo d-flex justify-content-center mb-5">
        <img src="{{ asset('assets/img/plss.png') }}" alt="Logo" width="100">
    </div>
    <div class="mb-5">
        <div class="row">
            <div class="col-2 d-flex justify-content-center align-items-center text-center pb-4">
                <i class="fa-solid fa-user fa-lg"></i>
            </div>
            <div class="col-10 justify-content-start align-items-end text-start">
                <span class="user-name m-0 p-0 fs-5">{{ $user->name }}</span>
                <p class="text-muted m-0 p-0">{{ $user->access_level_id ? $user->access_level->name : '' }}</p>
            </div>
        </div>
    </div>
    {{-- <hr> --}}
    <div class="menu mt-5">
        {{-- <a class="sidemenu-item" href="{{ url('/') }}">
            <div class="menu-item mb-2">
                <h6 class="m-0">Home</h6>
            </div>
        </a> --}}
        <a class="sidemenu-item" href="{{ url('/dashboard') }}">
            <div class="menu-item mb-2">
                <h6 class="m-0">Dashboard</h6>
            </div>
        </a>
        @foreach ($menu_items as $item)
        <a class="sidemenu-item" href="{{ url($item['route']) }}">
            <div class="menu-item mb-2">
                <h6 class="m-0">{{ $item['name'] }}</h6>
            </div>
        </a>
        @endforeach
    </div>
    <div class="bottom-fixed mb-2">
        <form action="{{ url('/usuarios/logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary sidemenu-item d-flex gap-2 justify-content-start align-items-center mb-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <h6 class="m-0">Sair</h6>
            </button>
        </form>
    </div>
</aside>