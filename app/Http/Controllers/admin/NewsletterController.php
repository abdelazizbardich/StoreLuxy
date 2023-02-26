<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    //
    public function show(){
        $newsletters = $this->getNewslettersData();
        $array = array('newsletters' => $newsletters);
        return view('admin.newsletters.all',$array);
    }
    private function getNewslettersData(){
        $newsletters = DB::table('newsletters')->orderBy('id', 'DESC')->get();
        return $newsletters;
    }
}
