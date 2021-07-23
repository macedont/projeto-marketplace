<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use const http\Client\Curl\AUTH_ANY;

class ProductController extends Controller
{

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
        $products = $this->product->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create');
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

            $post["slug"] = preg_replace('/\s/', '-', $post["name"]);

            $store = auth()->user()->store;
            $store->products()->create($post);

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
        return view('admin.products.edit', compact('product'));
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
            $post["slug"] = preg_replace('/\s/', '-',  $post["name"]);

            $product = $this->product->find($id);
            $product->update($post);

            \flash('O produto foi atualizado com sucesso.')->success();
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
        $product->delete();

        \flash('O produto foi deletado com sucesso!')->warning();
        return redirect()->route('admin.products.index');
    }
}
