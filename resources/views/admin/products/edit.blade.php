@extends('layouts.app')
@section('content')

    <form action="{{route('admin.products.update', ["product" => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto:</label>
            <input type="text" class="form-control @error('name')is-invalid @enderror" name="name" value="{{$product->name}}">
            @error('name')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" class="form-control @error('description')is-invalid @enderror" name="description" value="{{$product->description}}">
            @error('description')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo:</label>
            <textarea name="body" class="form-control @error('body')is-invalid @enderror" cols="30" rows="3">{{$product->body}}</textarea>
            @error('body')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="text" class="form-control @error('price')is-invalid @enderror" name="price" value="{{$product->price}}">
            @error('price')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="categories">Categorias:</label>
            <select name="categories[]" class="form-control @error('categories')is-invalid @enderror" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                            @if($product->categories->contains($category)) selected @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
            @error('categories')
            <div class="invalid-feedback">
                <p>{{$message}}</p>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photos">Fotos:</label>
            <input type="file" name="photos[]" accept="image/*" id="photos" multiple class="form-control @error('photos.*')is-invalid @enderror">
            @error('photos.*')
                <div class="invalid-feedback">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>

        <div class="mt-3">
            <button class="btn btn-lg btn-success" type="submit">Atualizar Produto</button>
        </div>
    </form>

    <div class="row mt-3">
        @foreach($product->photos as $photo)
            <div class="col-md-4">
                <form action="{{route('admin.photo.remove')}}" method="post">
                    <input type="hidden" name="photoName" value="{{$photo->image}}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger float-end">
                        <i class="fa fa-times"></i>
                    </button>
                </form>
                <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid">
            </div>
        @endforeach
    </div>

@endsection
