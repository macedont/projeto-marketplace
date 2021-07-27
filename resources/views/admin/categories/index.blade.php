@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12 mt-2">
            <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success" target="_blank"><i class="fa fa-plus"></i> Adicionar</a>
        </div>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('admin.categories.edit', ["category" => $category->id])}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                <form action="{{route('admin.categories.destroy', ["category" => $category->id])}}" method="post">
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
            {{$categories->links()}}
        </div>
    </div>
@endsection
