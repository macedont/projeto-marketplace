@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 mt-2">
            <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success" target="_blank"><i class="fa fa-plus"></i> Adicionar</a>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Telefone</th>
                    <th>Celular</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($stores as $store)
                    <tr>
                        <td>{{$store->id}}</td>
                        <td>{{$store->name}}</td>
                        <td>{{$store->description}}</td>
                        <td>{{$store->phone}}</td>
                        <td>{{$store->mobile_phone}}</td>
                        <td>
                            <a href="{{route('admin.stores.edit', ['id' => $store->id])}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.stores.delete', ['id' => $store->id])}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{$stores->links()}}
        </div>
    </div>
@endsection
