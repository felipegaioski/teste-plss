@extends('site.layout')

@section('content')
    <main>
        <div class="main-container">
            <div>
                @include('site.users.header')
            </div>
            <div class="inner-container">
                <div class="form-container">
                    <form action="{{ url('/chamados/novo') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="title">Título*</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Título do chamado">
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Descrição</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Descrição do chamado"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Categoria*</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option class="cursor-pointer" value="">Selecione a categoria</option>
                                @foreach ($categories as $category)
                                    <option class="cursor-pointer" value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection