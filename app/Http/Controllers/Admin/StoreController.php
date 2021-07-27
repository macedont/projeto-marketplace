<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash;
use App\Http\Requests\StoreRequest;
use App\Store;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\HttpCache\StoreInterface;

class StoreController extends Controller
{

    use UploadTrait;

    protected $store;

    public function __construct(Store $store){
        $this->store = $store;
        //$this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index(){
        $store = auth()->user()->store;
        return view('admin.stores.index', compact('store'));
    }

    public function create(){
        return view('admin.stores.create');
    }

    public function store(StoreRequest $request){
        $data = $request->post();
        $user = auth()->user();

        if($request->hasFile('logo')){
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $slug = preg_replace('/\s/', '-', $data['name']);
        $data['slug'] = strtolower($slug);
        $user->store()->create($data); //retorna a loja criada comno json caso seja retornado em uma api

        \flash('Loja criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($id){
        if(auth()->user()->store->id != $id){
            \flash('Você não pode acessar esta tela.')->error();
            return redirect()->route('admin.stores.index');
        }

        $stores = \App\Store::find($id);
        return view('admin.stores.edit', compact('stores'));
    }

    public function update(StoreRequest $request, $id){
        if($request->post()){
            $post = $request->post();
            $store = $this->store->find($id);

            if($request->hasFile('logo')){
                if(Storage::disk('public')->exists($store->logo)){
                    Storage::disk('public')->delete($store->logo);
                }
                $post['logo'] = $this->imageUpload($request->file('logo'));
            }


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
