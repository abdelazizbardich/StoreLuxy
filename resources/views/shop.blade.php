@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;">
        <div style="height: 150px;background-color: #F7F8FA;position: relative;">
            <p class="text-center" style="font-size: 54px;line-height: 74px;font-weight: bold;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;"><strong>@lang("Boutique")</strong></p>
        </div>
        <div style="min-height: calc(100vh - 210px);margin-bottom: 35px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col" style="padding: 0;">
                        <div id="cat-grid-container" class="shop">
                        <?php $i=1; ?>
                        @foreach($categorys as $category)
                            <div id="cat{{$i++}}" style="min-height: 38vh;background-image: url(&quot;{{asset('storage/' . $category->thumbnail->file)}}&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;"><a style="color: inherit;" href="/boutique/{{$category->category->slug_name}}" class="btn btn-primary text-uppercase" role="button" style="font-size: 15px;line-height: 20px;">{{$category->category->name}}</a></div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3"><span style="font-size: 18px;line-height: 24px;font-weight: bold;display: block;padding-bottom: 15px;border-bottom: 1px solid rgb(255,230,0);">@lang("Catalogue"):</span>
                        <ul class="list-unstyled" style="padding-top: 15px;padding-bottom: 15px;border-bottom: 1px solid rgb(255,230,0);margin-bottom: 15px;">
                        @foreach($categorys as $category)
                            <li style="font-style: italic;font-weight: bold;"><a style="color:unset;" href="/boutique/{{$category->category->slug_name}}">{{$category->category->name}}</a>
                                <ul>
                                @foreach($category->subCategorys as $subcategory)
                                    <li style="font-style: normal;font-weight: normal;"><span style="text-decoration: underline;"><a style="color:unset;" href="/boutique/{{$category->category->slug_name}}/{{$subcategory->category->slug_name}}">{{$subcategory->category->name}}</a></span><br>
                                        <ul>
                                            @foreach($subcategory->subSubCategorys as $subsubcategory)
                                                    <li style="font-size: 14px;line-height: 19px;font-weight: bold;"><a style="color:unset;" href="/boutique/{{$category->category->slug_name}}/{{$subcategory->category->slug_name}}/{{$subsubcategory->category->slug_name}}">{{$subsubcategory->category->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                        @endforeach
                        </ul>
                        <div><span style="font-size: 14px;line-height: 19px;display: block;">@lang("Prix"):</span><input type="range" class="priceRange" style="width: 100%;">
                            <ul class="list-inline">
                                <li class="list-inline-item" style="width: 48%;float: left;">0</li>
                                <li class="list-inline-item text-right" style="width: 48%;float: right;">100 000</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                        <span class="container" style="font-size: 18px;line-height: 24px;font-weight: bold;display: block;/*border-bottom: 1px solid rgb(255,230,0);*/padding-bottom: 15px;"><strong>@lang("Produits populaires"):</strong>
                        </span>
                        <div>
                            <div class="container">
                                <div class="row" style="margin-top: 15px;margin-bottom: 15px;">
                                    @foreach($products as $product)
                                        <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3" style="margin-bottom: 15px;">
                                            <div class="text-center" style="padding: 8px;background: white;border: 1px solid #dbb300;height: 100%;">
                                            <a href="/produit/{{$product->slug_name}}">
                                                <img class="img-fluid" src="{{asset('storage/' . $product->thumbnail->file)}}" style="border: 5px solid #ffffff;margin-bottom: 15px;">
                                            </a>
                                                <p class="text-center" style="font-size: 12px;line-height: 16px;margin-bottom: 0;">
                                                <?php $i=1; $x=count((array)$product->categorys); ?>
                                                @foreach($product->categorys as $category)
                                                    <a href="/boutique/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                                @endforeach
                                                </p>
                                                <span class="text-center" style="display: block;margin-bottom: 5px;">
                                                    @for($i = 0; $i < intval($product->stars);$i++)
                                                        <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;">
                                                    @endfor
                                                    @for($i = 0; $i < (5-intval($product->stars));$i++)
                                                        <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;">
                                                    @endfor
                                                </span>
                                                <p class="text-center" style="font-size: 12px;line-height: 19px;margin-bottom: 5px;    min-height: 38px;">{{$product->name}}</p>
                                                <p class="text-center" style="margin-bottom: 10px;color: #E74C3C;font-weight: bold;">{{$product->price}} @lang("Dh")</p>
                                                <ul class="list-inline">
                                                @foreach($product->photos as $photo)
                                                    <li class="list-inline-item"><img src="{{asset('storage/' . $photo->file)}}" class="lightZoom" style="width: 30px;height: 30px;"></li>
                                                @endforeach
                                                </ul>
                                                <a class="btn btn-danger text-uppercase btn-add-to-carte w-100 p-2" data-id="{{$product->id}}" role="button" style="margin: auto;border: none;border-radius: 0;font-size: 12px;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;@lang("Ajouter au panier")</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col">
                                        {{$products->render()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('inc.footer')
