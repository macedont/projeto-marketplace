@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 mt-2">
            <a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success" target="_blank"><i class="fa fa-plus"></i> Adicionar</a>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Loja</th>
                    <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>R$ {{number_format($product->price, 2,',', '.')}}</td>
                        <td>{{$product->store->name}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.products.edit', ["product" => $product->id])}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{route('admin.products.destroy', ["product" => $product->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
            {{$products->links()}}
        </div>
    </div>
@endsection
