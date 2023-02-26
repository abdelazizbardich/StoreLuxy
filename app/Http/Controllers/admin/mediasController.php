<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class mediasController extends Controller
{
    //
    public function show(){
        $medias = $this->getMediasData();
        $array = array('medias'=>$medias);
        return view('admin.medias.all',$array);
    }

    // Get medias data
    public function getMediasData(){
        $medias = DB::table('medias')->orderBy('id', 'DESC')->get();
        return $medias;
    }

    // Add new medias
    public function addNewMedias(Request $request){
        $files = $request->file('files');
        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                 $this->uploadImageFile($file);
            }
        }
        return $this->show();
    }
    public function addNewAjaxMedias(Request $request){
        $files = $request->file('files');
        if($request->hasFile('files'))
        {
            foreach ($files as $file) {
                 $this->uploadImageFile($file);
            }
        }
        return '1';
       
    }
    // Upload image file
    private function uploadImageFile($file){
        $filePath = $file->store('uploads/img', 'public');
        $data = [
        'type' => 'image',
        'file' => $filePath,
        'alt_title' => explode('.',$file->getClientOriginalName())[0].'-'.now(),
        'name' => explode('.',$file->getClientOriginalName())[0].'-'.now(),
        'slug_name' => explode('.',$file->getClientOriginalName())[0].'-'.now(),
        'file_desc' => '',
        'created_at' => now()
        ];
        $fileId = DB::table('medias')->insertGetId($data);
        return $fileId;
    }

    // update Medias details
    public function updateMedias(Request $request){
        $medias = DB::table('medias')->where('id',$request->id)->update(array('alt_title'=>$request->altTitle,'name'=>$request->title,'file_desc'=>$request->description,'updated_at'=>now()));
        return $this->show();
    }

    // get All medias items as Json data
    public function getAllAsJson(){
        $medias = DB::table('medias')->orderBy('id', 'DESC')->get();
        return json_encode($medias);
    }
}
