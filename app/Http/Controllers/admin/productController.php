<?php

namespace App\Http\Controllers\admin;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class productController extends Controller
{
    //
    public function show(){
        $products = $this->getAllProductsData();
        $array = array('products' => $products);
        return view('admin.products.all',$array);
    }

    // Get All Products data

    private function getAllProductsData(){
        $products = DB::table('products')->orderBy('id', 'DESC')->get();
        foreach($products as $product){
            $categories = explode(',',$product->categorys_ids);
            $categoriesData = [];
            foreach($categories as $category){
                $categoryItem = $this->getProductCategorys($category);
                array_push($categoriesData,$categoryItem);
            }
            $product->categories = $categoriesData;
            $product->starsAvrage = $this->getProductStarsAvrage($product->id);
        }
        return $products;
    }
    // Get Single Products data

    private function getSingleProductsData($id){
        $product = DB::table('products')->where('id',$id)->first();
            $categories = explode(',',$product->categorys_ids);
            $categoriesData = [];
            foreach($categories as $category){
                $categoryItem = $this->getProductCategorys($category);
                array_push($categoriesData,$categoryItem);
            }
            $product->categories = $categoriesData;
            $product->starsAvrage = $this->getProductStarsAvrage($product->id);
        return $product;
    }
    // Get Product categorys
    private function getProductCategorys($id){
        $categories = DB::table('categorys')->where('id',$id)->first();
        return $categories;
    }

    // Get Products Stars avrage

    private function getProductStarsAvrage($id){
        $reviews = DB::table('reviews')->where('product_id',$id)->orderBy('id', 'DESC')->get();
        $reviewsCount = count($reviews);
        $starsCount = 0;
        $reviewsAvrage = 0;
        foreach($reviews as $review){$starsCount += intval($review->stars);}
        if($reviewsCount > 0){
            $reviewsAvrage = $starsCount/$reviewsCount;
        }
        return $reviewsAvrage;
    }

    // show new product page
    public function newproduct(){
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.products.add-new',$array);
    }

    // Get posts categories
    private function getcategories(){
        $categories = DB::table('categorys')->where('type','category')->orderBy('id','DESC')->get();
        foreach($categories as $category){
            $subCategories = DB::table('categorys')->where('parent',$category->id)->where('type','sub_category')->orderBy('id','DESC')->get();
            $category->subCategory = $subCategories;
            foreach($category->subCategory as $category){
                $subSubCategories = DB::table('categorys')->where('parent',$category->id)->where('type','sub_sub_category')->orderBy('id','DESC')->get();
                $category->subCategory = $subSubCategories;
            }
        }
        return $categories;
    }
    // get single category
    private function getSingleCategories($id){
        $category = DB::table('categorys')->where('id',$id)->first();
        return $category;
    }
    // add NewProduct
    public function addNewProduct(Request $request){
        $SKU = $this->getSKUCode();
        if($request->in_slider == 'on'){$in_slider = 1;}else{$in_slider = 0;}
        if($request->is_trend == 'on'){$is_trend = 1;}else{$is_trend = 0;}
        if($request->is_best_saller == 'on'){$in_best_salle = 1;}else{$in_best_salle = 0;}
        if($request->sponsored == 'on'){$sponsored = 1;}else{$sponsored = 0;}
        if(isset($request->save)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $photos = '';
            $x=0;
            if(isset($request->photos)){
                foreach($request->photos as $photo){
                    if($i== 0){$photos = $photos.$photo;}else{$photos = $photos.', '.$photo;}
                    $x = 1;
                }
            }else {$photos = '';}
            $post = DB::table('products')->insertGetId([
                'old_price' => $request->old_price,
                'price' => $request->prix,
                'sall_end' => $request->promo_end,
                'tax' => $request->tax,
                'stock_size' => $request->stock_size,
                'stock_amount' => $request->in_stock,
                'is_best_saller' => $in_slider,
                'is_trend' => $is_trend,
                'is_best_saller' => $in_best_salle,
                'sponsored' => $sponsored,
                'short_desc' => $request->short_desc,
                'gallery_ids' => $photos,
                'slider_thumbnail_id' => $request->slider_thumbnail,
                'type' => 'porduct',
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'long_desc' => $request->long_dec,
                'tags' => $request->tags,
                'categorys_ids' => $categories,
                'thumbnail_id' => $request->thumbnail,
                'state' => '0',
                'sku' => $SKU,
                'created_at' => now()
            ]);
            return $this->show();
        }elseif(isset($request->publish)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $photos = '';
            $x=0;
            if(isset($request->photos)){
                foreach($request->photos as $photo){
                    if($i== 0){$photos = $photos.$photo;}else{$photos = $photos.', '.$photo;}
                    $x = 1;
                }
            }else {$photos = '';}
            $post = DB::table('products')->insertGetId([
                'old_price' => $request->old_price,
                'price' => $request->prix,
                'sall_end' => $request->promo_end,
                'tax' => $request->tax,
                'stock_size' => $request->stock_size,
                'stock_amount' => $request->in_stock,
                'is_best_saller' => $in_slider,
                'is_trend' => $is_trend,
                'is_best_saller' => $in_best_salle,
                'sponsored' => $sponsored,
                'short_desc' => $request->short_desc,
                'gallery_ids' => $photos,
                'slider_thumbnail_id' => $request->slider_thumbnail,
                'type' => 'porduct',
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'long_desc' => $request->long_dec,
                'tags' => $request->tags,
                'categorys_ids' => $categories,
                'thumbnail_id' => $request->thumbnail,
                'state' => '1',
                'sku' => $SKU,
                'created_at' => now()
            ]);
            return $this->show();
        }
    }

    // generate randome unique sku code
    private function getSKUCode(){
        do
        {
            $code = 'SL-'.rand(0, 99999999);
            $user_code = DB::table('products')->where('sku',$code)->first();
        }
        while(!empty($user_code));

        return $code;

    }

    // publish product
    public function publish($id){
        $product = DB::table('products')->where('id',$id)->update(['state' => '1']);
        return $this->show();
    }

    // Move prduct to draft
    public function moveToDraft($id){
        $product = DB::table('products')->where('id',$id)->update(['state' => '0']);
        return $this->show();
    }

    // delete product
    public function delete($id){
        $product = DB::table('products')->delete($id);
        return $this->show();
    }

    // get edit page
    public function getEditPage($id){
        $product = $this->getSingleProductsData($id);
        $product->thumbnail = $this->getMediaFile($product->thumbnail_id);
        $product->sliderThumbnail = $this->getMediaFile($product->slider_thumbnail_id);
        $galleryIds = explode(',',$product->gallery_ids);
        $gallery = [];
        foreach($galleryIds as $id){
            $image = $this->getMediaFile($id);

            array_push($gallery,$image);
        }
        if($gallery[0] == null){unset($gallery[0]);}
        $gallery = array_values($gallery);
        $product->gallery = $gallery;
        if($product->tags !== null){
            $tags = explode(',',$product->tags);
            $tagsData = [];
            foreach($tags as $tag){
                $tag = trim($tag);
                array_push($tagsData,$tag);
            }
        }else {
            $tagsData = [''];
        }
        $product->tagsObjects = $tagsData;
        $categories = $this->getcategories();
        $array = array('product' => $product, 'categories'=> $categories);
        return view('admin.products.edit',$array);
    }

    // edit product
    public function edit(Request $request){
        $id = $request->id;
        $SKU = $this->getSKUCode();
        if($request->in_slider == 'on' && isset($request->slider_thumbnail)){$in_slider = 1;}else{$in_slider = 0;}
        if($request->is_trend == 'on'){$is_trend = 1;}else{$is_trend = 0;}
        if($request->is_best_saller == 'on'){$in_best_salle = 1;}else{$in_best_salle = 0;}
        if($request->sponsored == 'on'){$sponsored = 1;}else{$sponsored = 0;}
        if(isset($request->save)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $photos = '';
            $x=0;
            if(isset($request->photos)){
                foreach($request->photos as $photo){
                    if(!is_null($photo)){
                        if($i== 0){$photos = $photos.$photo;}else{$photos = $photos.', '.$photo;}
                        $x = 1;
                    }
                }
            }else {$photos = '';}
            $post = DB::table('products')->where('id',$id)->update([
                'old_price' => $request->old_price,
                'price' => $request->prix,
                'sall_end' => $request->promo_end,
                'tax' => $request->tax,
                'stock_size' => $request->stock_size,
                'stock_amount' => $request->in_stock,
                'in_slider' => $in_slider,
                'is_trend' => $is_trend,
                'is_best_saller' => $in_best_salle,
                'sponsored' => $sponsored,
                'short_desc' => $request->short_desc,
                'gallery_ids' => $photos,
                'slider_thumbnail_id' => $request->slider_thumbnail,
                'type' => 'porduct',
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'long_desc' => $request->long_dec,
                'tags' => $request->tags,
                'categorys_ids' => $categories,
                'thumbnail_id' => $request->thumbnail,
                'state' => '0',
                'created_at' => now()
            ]);
            return $this->show();
        }elseif(isset($request->publish)){
            $categories = '';
            $i=0;
            if(isset($request->categories)){
                foreach($request->categories as $category){
                    if($i== 0){$categories = $categories.$category;}else{$categories = $categories.', '.$category;}
                    $i = 1;
                }
            }else {$categories = '';}
            $photos = '';
            $x=0;
            if(isset($request->photos)){
                foreach($request->photos as $photo){
                    if(!is_null($photo)){
                        if($i== 0){$photos = $photos.$photo;}else{$photos = $photos.', '.$photo;}
                        $x = 1;
                    }
                }
            }else {$photos = '';}
            $post = DB::table('products')->where('id',$id)->update([
                'old_price' => $request->old_price,
                'price' => $request->prix,
                'sall_end' => $request->promo_end,
                'tax' => $request->tax,
                'stock_size' => $request->stock_size,
                'stock_amount' => $request->in_stock,
                'in_slider' => $in_slider,
                'is_trend' => $is_trend,
                'is_best_saller' => $in_best_salle,
                'sponsored' => $sponsored,
                'short_desc' => $request->short_desc,
                'gallery_ids' => $photos,
                'slider_thumbnail_id' => $request->slider_thumbnail,
                'type' => 'porduct',
                'name' => $request->title,
                'slug_name' => $request->sub_title,
                'long_desc' => $request->long_dec,
                'tags' => $request->tags,
                'categorys_ids' => $categories,
                'thumbnail_id' => $request->thumbnail,
                'state' => '1',
                'updated_at' => now()
            ]);
            return $this->show();
        }

    }
    // get Media file
    private function getMediaFile($id){
        $thumbnail = DB::table('medias')->where('id',$id)->first();
        return $thumbnail;
    }

    // get All products categorys
    public function getAllcategorys(){
        //$categories = DB::table('categorys')->get();
        $categories = $this->getcategories();
        $array = array('categories' => $categories);
        return view('admin.products.categories',$array);
    }

    // add new category
    public function addNewCategory(Request $request){
        $type = "category";
        if(count(explode(',',$request->parent))>1 && explode(',',$request->parent)[1] == 'sub_category'){$type = 'sub_sub_category';}
        if(count(explode(',',$request->parent))>1 && explode(',',$request->parent)[1] == 'category'){$type = 'sub_category';}
        if($request->in_home == "on"){$inHome = 1;}else{$inHome = 0;}
        $data = [
            'name' => $request->title,
            'slug_name' => $request->sub_title,
            'type' => $type,
            'car_desc' => $request->description,
            'in_home' => $inHome,
            'thumbnail' => $request->thumbnail,
            'parent' => isset(explode(',',$request->parent)[0]),
            'created_at' => now()
        ];
        $category = DB::table('categorys')->insertGetId($data);
        return $this->getAllcategorys();
    }

    // delete Category
    public function deleteCategory($id){
        $category = DB::table('categorys')->delete($id);
        return $this->getAllcategorys();
    }

    // get edit category page
    public function getCategoryEdtiPage($id){
        $category = $this->getSingleCategories($id);
        $thumbnail = $this->getMediaFile($category->thumbnail);
        $category->Thumbnail = $thumbnail;
        $categories = $this->getcategories();
        $array = array('categories' => $categories,'thisCategory' => $category);
        return view('admin.products.edit-categories',$array);
    }

    // edit category
    public function edticategory(Request $request){
        $id = $request->id;
        if(!is_null($request->parent)){
            if(explode(',',$request->parent)[1] == 'category'){$type = 'sub_category'; $parent = explode(',',$request->parent)[0];}
            if(explode(',',$request->parent)[1] == 'sub_category'){$type = 'sub_sub_category';  $parent = explode(',',$request->parent)[0];}
        }else{
            $parent = 0;
            $type = "category";
        }
        if($request->in_home == "on"){$inHome = 1;}else{$inHome = 0;}
        $data = [
            'name' => $request->title,
            'slug_name' => $request->sub_title,
            'type' => $type,
            'car_desc' => $request->description,
            'in_home' => $inHome,
            'thumbnail' => $request->thumbnail,
            'parent' => $parent,
            'updated_at' => now()
        ];
        $category = DB::table('categorys')->where('id',$id)->update($data);
        return $this->getAllcategorys();
    }
}

