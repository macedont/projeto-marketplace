<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPhoto;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{

    protected $photo;

    public function __construct(ProductPhoto $photo){
        $this->photo = $photo;
    }

    public function removePhoto(Request $request){
        $photoName = $request->get('photoName');

        if(Storage::disk('public')->exists($photoName)){
            Storage::disk('public')->delete($photoName);
            $this->photo->where('image', $photoName)->delete();
        }

        \flash('Foto removida com sucesso.')->success();
        return redirect()->back();
    }
}
