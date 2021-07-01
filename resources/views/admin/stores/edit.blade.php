@extends('layouts.app')
@section('content')

    <form action="{{route('admin.stores.update', ['id' => $stores['id']])}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">

        <div class="form-group">
            <label>Nome Loja:</label>
            <input type="text" class="form-control" name="name" value="{{$stores['name']}}">
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control" name="description" value="{{$stores['description']}}">
        </div>

        <div class="form-group">
            <label>Telefone:</label>
            <input type="text" class="form-control" name="phone" value="{{$stores['phone']}}">
        </div>

        <div class="form-group">
            <label>Celular:</label>
            <input type="text" class="form-control" name="mobile_phone" value="{{$stores['mobile_phone']}}">
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-primary" type="submit">Atualizar Dados</button>
        </div>
    </form>

@endsection
