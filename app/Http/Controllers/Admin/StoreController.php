<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash;

class StoreController extends Controller
{

    public function index(){
        $stores = \App\Store::paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create(){
        return view('admin.stores.create');
    }

    public function store(Request $request){
        $data = $request->post();
        $user = auth()->user();

        $slug = preg_replace('/\s/', '-', $data['name']);
        $data['slug'] = strtolower($slug);

        $user->store()->create($data); //retorna a loja criada comno json caso seja retornado em uma api

        \flash('Loja criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($id){
        $stores = \App\Store::find($id);
        return view('admin.stores.edit', compact('stores'));
    }

    public function update(Request $request, $id){
        if($request->post()){
            $post = $request->post();

            $store = \App\Store::find($id);
            $store->update($post);

            /*\App\Store::where('id', $post['id'])->update([
                'name' => $post['name'],
                'description' => $post['description'],
                'phone' => $post['phone'],
                'mobile_phone' => $post['mobile_phone']
            ]);*/
        }
        \flash('Os dados foram atualizados com sucesso!')->success();
        return redirect('/admin/stores');
    }

    public function destroy($id){
        $products = \App\Product::where('store_id', $id)->delete();
        $store = \App\Store::find($id)->delete();

        \flash('Loja removida com sucesso!')->success();
        return redirect('/admin/stores');
    }
}
