<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Models\Option;
use App\Models\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class settingController extends Controller
{
    //
    public function show(){

        $settings = (object)[];
        $settings->site_social_img = ((DB::table('options')->where('name','site_social_img')->first())->value);
        $settings->site_logo = ((DB::table('options')->where('name','site_logo')->first())->value);
        $settings->site_icon =  ((DB::table('options')->where('name','site_icon')->first())->value);
        $settings->site_name = (DB::table('options')->where('name','site_name')->first())->value;
        $settings->facebook_id = (DB::table('options')->where('name','facebook_id')->first())->value;
        $settings->newsletter_email = (DB::table('options')->where('name','newsletter_email')->first())->value;
        $settings->widjet_1 = (DB::table('options')->where('name','widjet_1')->first())->value;
        $settings->widjet_2 = (DB::table('options')->where('name','widjet_2')->first())->value;
        $settings->widjet_3 = (DB::table('options')->where('name','widjet_3')->first())->value;
        $settings->s_facebook = (DB::table('options')->where('name','s_facebook')->first())->value;
        $settings->s_twitter = (DB::table('options')->where('name','s_twitter')->first())->value;
        $settings->s_instagram = (DB::table('options')->where('name','s_instagram')->first())->value;
        $settings->s_pinterest = (DB::table('options')->where('name','s_pinterest')->first())->value;
        $settings->site_url = (DB::table('options')->where('name','site_url')->first())->value;
        $settings->site_description = (DB::table('options')->where('name','site_description')->first())->value;
        $settings->about = (DB::table('options')->where('name','about')->first())->value;
        $settings->shipping_cost = (DB::table('options')->where('name','shipping_cost')->first())->value;
        $settings->terms_and_conditions = (DB::table('options')->where('name','terms_and_conditions')->first())->value;
        $settings->privacy_policies = (DB::table('options')->where('name','privacy_policies')->first())->value;
        $settings->header_codes = (DB::table('options')->where('name','header_codes')->first())->value;
        $settings->footer_codes = (DB::table('options')->where('name','footer_codes')->first())->value;
        $settings->instagramPhotos = $this->getIntagramPhotos((DB::table('options')->where('name','instagram_photos')->first())->value);
        $array = array('settings' => $settings);
        return view('admin.settings.all',$array);
    }

    // edit site infos
    public function editSiteInfos(Request $request){

        DB::table('options')->where('name','site_name')->update(['value' => $request->site_name]);
        DB::table('options')->where('name','site_url')->update(['value' => $request->site_url]);
        DB::table('options')->where('name','site_description')->update(['value' => $request->site_desc]);
        DB::table('options')->where('name','facebook_id')->update(['value' => $request->facebook_id]);
        DB::table('options')->where('name','newsletter_email')->update(['value' => $request->newsletter_email]);
        DB::table('options')->where('name','shipping_cost')->update(['value' => $request->shipping_cost]);
        DB::table('options')->where('name','about')->update(['value' => $request->about]);

        return $this->show();
    }

    // update site logo
    public function editSitelogo(Request $request){
        $logo = $this->getMediaFile($request->site_logo);
        DB::table('options')->where('name','site_logo')->update(['value' => $logo->file]);

        return $this->show();
    }

    // update site Icon
    public function editSiteIcon(Request $request){
        $logo = $this->getMediaFile($request->site_icon);
        DB::table('options')->where('name','site_icon')->update(['value' => $logo->file]);

        return $this->show();
    }

    // update social image
    public function editSocialImage(Request $request){
        $logo = $this->getMediaFile($request->social_image);
        DB::table('options')->where('name','site_social_img')->update(['value' => $logo->file]);

        return $this->show();
    }

    // edit social links
    public function editSocialLinks(Request $request){
        DB::table('options')->where('name','s_facebook')->update(['value' => $request->facebook_link]);
        DB::table('options')->where('name','s_twitter')->update(['value' => $request->twitter_link]);
        DB::table('options')->where('name','s_instagram')->update(['value' => $request->instagram_link]);
        DB::table('options')->where('name','s_pinterest')->update(['value' => $request->pinterest_link]);
        return $this->show();
    }

    // edit privacy
    public function editPrivacy(Request $request){
        DB::table('options')->where('name','privacy_policies')->update(['value' => $request->privacy]);
        return $this->show();
    }

    // edit privacy
    public function editTerms(Request $request){
        DB::table('options')->where('name','terms_and_conditions')->update(['value' => $request->termes]);
        return $this->show();
    }

    // edit widget 1
    public function editWidjet1(Request $request){
        DB::table('options')->where('name','widjet_1')->update(['value' => $request->wiget1]);
        return $this->show();
    }

    // edit widget 2
    public function editWidjet2(Request $request){
        DB::table('options')->where('name','widjet_2')->update(['value' => $request->wiget2]);
        return $this->show();
    }

    // edit widget 3
    public function editWidjet3(Request $request){
        DB::table('options')->where('name','widjet_3')->update(['value' => $request->wiget3]);
        return $this->show();
    }

    // get Media file
    private function getMediaFile($id){
        $thumbnail = DB::table('medias')->where('id',$id)->first();
        return $thumbnail;
    }

    // get banners
    public function getBanners(){
        $banners = DB::table('banners')->get();
        foreach($banners as $banner){
            $banner->thumbnail = $this->getMediaFile($banner->icon);
        }
        $array = array('banners' => $banners);
        return view('admin.settings.banners',$array);
    }

    // edit Banners
    public function editBanners(Request $request){
        $count = count($request->id);
        for($i=0;$i < $count;$i++){
            DB::table('banners')->where('id',$request->id[$i])->update(['title' => $request->title[$i],'text' => $request->text[$i], 'icon' => $request->icon[$i],'updated_at' => now()]);
        }
        return $this->getBanners();
    }

    // get Carts
    public function getCartes(){
        $cards = DB::table('cards')->get();
        foreach($cards as $card){
            $card->Thumbnail = $this->getMediaFile($card->thumbnail);
        }
        $array = array('cards' => $cards);
        return view('admin.settings.cards',$array);
    }

    // edit cards
    public function editCartes(Request $request){
        $count = count($request->id);
        for($i=0;$i < $count;$i++){
            DB::table('cards')->where('id',$request->id[$i])->update(['label' => $request->label[$i],'title' => $request->title[$i], 'link' => $request->link[$i], 'thumbnail' => $request->thumbnail[$i],'updated_at' => now()]);
        }
        return $this->getCartes();
    }

    // get header & footer page
    public function getHFcodes(){
        $codes = (object)[];
        $codes->header = (DB::table('options')->where('name','header_codes')->first())->value;
        $codes->footer = (DB::table('options')->where('name','footer_codes')->first())->value;
        $codes->afterBody = (DB::table('options')->where('name','after_body_code')->first())->value;
        $codes->beforeBody = (DB::table('options')->where('name','before_body_code')->first())->value;
        $array = array('codes' =>$codes);
        return view('admin.settings.hreder-footer-codes',$array);
    }

    // edit header Codes
    public function editHeaderCode(Request $request){
        DB::table('options')->where('name','header_codes')->update(['value' => $request->code]);
        return $this->getHFcodes();
    }

    // edit before body Codes
    public function editbeforeBodyCode(Request $request){
        DB::table('options')->where('name','before_body_code')->update(['value' => $request->code]);
        return $this->getHFcodes();
    }

    // edit footer Codes
    public function edirFooterCode(Request $request){
        DB::table('options')->where('name','footer_codes')->update(['value' => $request->code]);
        return $this->getHFcodes();
    }

    // edit after body Codes
    public function editAfterBodyCode(Request $request){
        DB::table('options')->where('name','after_body_code')->update(['value' => $request->code]);
        return $this->getHFcodes();
    }

    // get Citys
    public function getCities(){
        $cities = DB::table('citys')->get();
        $array = array('cities' => $cities);
        return view('admin.settings.cities',$array);
    }

    // edit citys
    public function editCities(Request $request){
        $count = count($request->title);
        for($i=0;$i<$count;$i++){
            if(is_null($request->id[$i])){
                DB::table('citys')->insert(['name'=>$request->title[$i],'slug_name' =>$request->sub_title[$i],'shipping_cost' => $request->shipping_cost[$i]]);
            }else{
                DB::table('citys')->where('id',$request->id[$i])->update(['name'=>$request->title[$i],'slug_name' =>$request->sub_title[$i],'shipping_cost' => $request->shipping_cost[$i]]);
            }
        }
        return $this->getCities();
    }


    //delete city
    public function deleteCities($id){
        if(isset($id)){
            DB::table('citys')->delete($id);
            return 1;
        }else{
            return 0;
        }
    }

    public function updateInstagramPhotos(Request $request)
    {
        $photos = [];
        if(isset($request->instaphotos)){
            foreach($request->instaphotos as $photo){
                if(!is_null($photo)){
                    array_push($photos,$photo);
                }
            }
        }
        $instagramPhotos = Option::where('name','instagram_photos')->first();
        if($instagramPhotos){
            $instagramPhotos->value =  implode(',',$photos);
            $instagramPhotos->save();
        }
        return $this->show();
    }

    private function getIntagramPhotos($photos){
        $photos = explode(',',$photos);
        $data = [];
        foreach ($photos as $photo) {
            array_push($data,Media::where('id',$photo)->first());
        }
        return $data;
    }


}
