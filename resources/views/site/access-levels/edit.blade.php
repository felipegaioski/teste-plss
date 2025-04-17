@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            <div>
                @include('site.access-levels.header')
            </div>
            <div class="inner-container flex-column justify-content-center align-items-center">
                <div class="my-2">
                    <span>Editando o nível de acesso "{{ old('name', $access_level->name) }}"</span>
                </div>
                <div class="form-container">
                    <form action="{{ url('/niveis-de-acesso/' . $access_level->id . '/editar') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $access_level->name) }}" 
                                   placeholder="Digite o nome do nível de acesso">
                        </div>
                        <div>
                            <span class="fw-bold">Permissões</span>
                        </div>
                        @foreach($permission_categories as $category)
                        <div class="form-group mb-2">
                            <label for="name">{{  $category->name }}</label>
                            <div class="form-check d-flex row">
                                @foreach($access_level->permissions as $permission)
                                @if($permission->category->id == $category->id)
                                    <div class="col-6">
                                        <input type="hidden" name="permissions[{{ $permission->id }}][allow]" value="0">
                                        <input 
                                            class="form-check-input permission-checkbox" 
                                            type="checkbox" 
                                            id="permission_{{ $permission->id }}" 
                                            name="permissions[{{ $permission->id }}][allow]" 
                                            value="1"
                                            {{ $permission->pivot->allow ? 'checked' : '' }}
                                            {{ ($user->access_level_id == 1 && $access_level->id == 1 && ($permission->category->id == 1 || $permission->category->id == 2)) ? 'disabled' : '' }}
                                        >
                                        <label class="form-check-label" for="permission_{{ $permission->id }}" 
                                            {{ ($user->access_level_id == 1 && $access_level->id == 1 && ($permission->category->id == 1 || $permission->category->id == 2)) ? 'disabled' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const permissionId = this.dataset.permissionId;
                    const hiddenInput = document.querySelector(`input[name="permissions[${permissionId}][allow]"][type="hidden"]`);
    
                    if (this.checked) {
                        hiddenInput.value = '1';
                    } else {
                        hiddenInput.value = '0';
                    }
                });
            });
        });
    </script>
    
@endsection
