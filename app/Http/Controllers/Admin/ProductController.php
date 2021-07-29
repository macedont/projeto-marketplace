<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use const http\Client\Curl\AUTH_ANY;

class ProductController extends Controller
{

    use UploadTrait;
    protected $product;

    public function __construct(Product $product){
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(){
        $user = auth()->user()->store;
        $products = $user->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $categories = \App\Category::all(['id', 'name']);
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(ProductRequest $request)
    {
        if($request->post()){
            $post = $request->post();
            $post["price"] = str_replace(',', '.', $post["price"]);

            $store = auth()->user()->store;
            $product = $store->products()->create($post);
            $product->categories()->sync($post['categories']);

            if($request->hasFile('photos')){
                $images = $this->imageUpload($request->file('photos'), 'image');

                $product->photos()->createMany($images);
            }

            \flash('Os dados foram inseridos com sucesso!')->success();
        }
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id)
    {
        if($request->post()){
            $post = $request->post();
            $product = $this->product->find($id);
            $product->update($post);
            $product->categories()->sync($post['categories']);
            if($request->hasFile('photos')){
                $images = $this->imageUpload($request->file('photos'), 'image');

                $product->photos()->createMany($images);
            }

            \flash('O produto foi atualizado com sucesso.')->success();
//            \flash()->overlay('O produto foi atualizado com sucesso.','Atenção');
        }
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        //$product->delete();

        $categories = \App\Category::where('product_id', 49);
        dd($categories);
        $categories->delete();

        \flash('O produto foi deletado com sucesso!')->warning();
        return redirect()->route('admin.products.index');
    }


}
