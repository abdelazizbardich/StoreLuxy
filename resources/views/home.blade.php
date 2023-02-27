@include('inc.header')
@if($SliderProducts)
    <div id="home-slider" style="min-height: calc(100vh - 70px);"><img id="shear1" src="/assets/img/Intersection%204.svg" style="width: 30%;"><img id="sheap2" src="/assets/img/Intersection%203.svg" style="position: absolute;left: 0;bottom: 0;width: 35%;">
        <div class="container" style="height: 100%;">
            <div class="row" style="min-height: calc(100vh - 70px);">
                <div class="col">
                    <div class="carousel slide" data-ride="carousel" id="carousel-1" style="height: 100%;padding-bottom: 10vh;">
                        <div class="carousel-inner" role="listbox" style="height: 100%;">
                        <?php $i=0; ?>
                            @foreach($SliderProducts as $SliderProduct)
                                <div class="carousel-item <?php if($i == 0){echo 'active'; $i=1;} ?>" style="height: 100%;">
                                    <div class="row justify-content-center align-items-center" style="height: 100%;">
                                        <div class="col-11 col-sm-11 col-md-12 col-lg-6 col-xl-6 order-2 order-sm-2 order-md-2 order-lg-1 order-xl-1">
                                            <div>
                                                <span>
                                                    @foreach($SliderProduct->categorys as $category)
                                                    <a style="color: inherit;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a>,
                                                    @endforeach
                                                </span>
                                                <span style="margin-left: 15px;">
                                                @for($i = 0; $i < intval($SliderProduct->stars);$i++)
                                                <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;">
                                                @endfor
                                                @for($i = 0; $i < (5-intval($SliderProduct->stars));$i++)
                                                    <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;">
                                                @endfor
                                                </span>
                                            </div>
                                            <h1>{{$SliderProduct->Product->name}}</h1>
                                            <p>{{$SliderProduct->Product->short_desc}}</p>
                                            <div style="width: fit-content;border-radius: 50px;background: #C70000;">
                                                <p style="margin-left: 15px;color: rgb(255,255,255);font-weight: bold;line-height: 33px;float: left;padding-top: 5px;padding-bottom: 5px;margin-bottom: 0px;font-size: 22px;">{{$SliderProduct->Product->price}} @lang("Dh")</p><a href="/commandez-maintenant/{{$SliderProduct->Product->id}}/1" class="btn btn-primary" role="button" style="background-color: #FF0000;border: none;border-radius: 50px;font-size: 12px;font-weight: bold;padding-top: 12px;padding-bottom: 12px;margin-left: 15px;height: 100%;color: rgb(255,255,255);">@lang("COMMANDEZ")</a></div>
                                        </div>
                                        <div class="col-8 col-sm-7 col-md-12 col-lg-6 col-xl-6 order-1 order-sm-1 order-md-1 order-lg-2 order-xl-2" style="position: relative;">
                                            <div style="position: relative;width: 100%;height: 100%;margin-bottom: 20%;margin-top: 20%;"><img class="img-fluid" src="/assets/img/Ellipse%201.svg" style="position: absolute;top: 0;left: 0;right: 0;bottom: 0;margin: auto;width: 80%;" width="100%"><img class="img-fluid" src="{{asset('storage/' . $SliderProduct->Thumbnail->file)}}" style="z-index: 1;position: relative;"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-none">
                            <!-- Start: Previous --><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span><span class="sr-only">@lang("Previous")</span></a>
                            <!-- End: Previous -->
                            <!-- Start: Next --><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><span class="carousel-control-next-icon"></span><span class="sr-only">@lang("Next")</span></a>
                            <!-- End: Next -->
                        </div>
                        <ol class="carousel-indicators">
                        <?php $i=0;$x=0; ?>
                            @foreach($SliderProducts as $SliderProduct)
                            <li data-target="#carousel-1" data-slide-to="{{$x}}" class="<?php if($i ==0){echo 'active'; $i=1;}$x++; ?>"></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 100px;">
    @if($categorys)
        <div style="padding-top: 60px;">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col">
                        <div id="cat-grid-container">
                        <?php $i=1; ?>
                        @foreach($categorys as $category)
                            <div id="cat{{$i++}}" style="min-height: 250px;background-image: url(&quot;{{asset('storage/' . $category->thumbnail->file)}}&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;"><a style="color: inherit;" href="/boutique/{{$category->category->slug_name}}" class="btn btn-primary text-uppercase" role="button" style="font-size: 15px;line-height: 20px;">{{$category->category->name}}</a></div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($banners)
        <div style="margin-bottom: 30px;margin-top: 60px;">
            <div class="container">
                <div class="row" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($banners as $banner)
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                            <div style="border: 5px solid #FFE500;background: #ffffff;padding-top: 25px;padding-bottom: 25px;height: 100%;">
                                <div class="row no-gutters align-items-center" style="height: 100%;">
                                    <div class="col-auto text-center"><img src="{{asset('storage/' . $banner->icon->file)}}" style="margin: 5px 10px;"></div>
                                    <div class="col">
                                        <p class="text-uppercase" style="font-size: 14px;line-height: 22px;font-weight: bold;color: rgb(0,102,255);margin-bottom: 0;">{{$banner->Banner->title}}</p>
                                        <p style="font-size: 12px;line-height: 19px;margin-bottom: 0;">{!! $banner->Banner->text !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($TrendingProducts)
        <div style="margin-bottom: 30px;margin-top: 60px;">
                <div style="margin-bottom: 50px;">
                    <p class="text-center" style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;">&nbsp;<strong>@lang("TENDANCE")</strong></p>
                    <p class="text-center" style="line-height: 22px;font-size: 16px;margin: 0;">@lang("VUES DE HAUT DANS CETTE SEMAINE")</p>
                </div>
            <div class="container">
                <div class="row justify-content-center" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($TrendingProducts as $TrendingProduct)
                        <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3" style="margin-bottom: 15px;">
                            <div class="text-center">
                            <a href="/produit/{{$TrendingProduct->product->slug_name}}">
                                <img class="img-fluid" src="{{asset('storage/' . $TrendingProduct->thumbnail->file)}}" style="border: 5px solid #ffffff;margin-bottom: 15px;">
                            </a>
                                <p class="text-center" style="font-size: 12px;line-height: 16px;margin-bottom: 0;">
                                <?php $i=1; $x=count((array)$TrendingProduct->categorys); ?>
                                @foreach($TrendingProduct->categorys as $category)
                                    <a style="color: inherit;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                @endforeach
                                </p>
                                <span class="text-center" style="display: block;margin-bottom: 5px;">
                                    @for($i = 0; $i < intval($TrendingProduct->stars);$i++)
                                        <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;">
                                    @endfor
                                    @for($i = 0; $i < (5-intval($TrendingProduct->stars));$i++)
                                        <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;">
                                    @endfor
                                </span>
                                <p class="text-center" style="font-size: 12px;line-height: 19px;margin-bottom: 5px;">{{$TrendingProduct->product->name}}</p>
                                <p class="text-center" style="margin-bottom: 10px;color: #E74C3C;font-weight: bold;">{{$TrendingProduct->product->price}} @lang("Dh")</p>
                                <ul class="list-inline">
                                @foreach($TrendingProduct->photos as $photo)
                                    <li class="list-inline-item"><img src="{{asset('storage/' . $photo->file)}}" style="width: 30px;height: 30px;"></li>
                                @endforeach
                                </ul>
                                <a class="btn btn-primary text-uppercase btn-add-to-carte" data-id="{{$TrendingProduct->product->id}}" role="button" style="margin: auto;border: none;border-radius: 0;font-size: 9px;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;@lang("Ajouter au panier")</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if($Cards)
        <div style="margin-bottom: 30px;margin-top: 60px;background-image: url(&quot;/assets/img/Tracé%2025.svg&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;">
            <div class="container" style="padding-top: 60px;padding-bottom: 60px;">
                <div class="row justify-content-center align-items-center">
                    <div class="col-4" style="position: relative;padding: 0;">
                        <a href="{{$Cards[0]->Card->link}}" style="color: unset;">
                        <div class="shadow-lg" style="border-radius: 500px;border: 10px solid rgb(255,255,255);background-image: url(&quot;{{asset('storage/' . $Cards[0]->thumbnail->file)}}&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;width: 100%;padding-top: 100%;box-sizing: border-box;">
                            <p class="text-center" style="position: absolute;top: 0;bottom: 0;left: 7%;right: 19%;height: fit-content;width: fit-content;max-width: 73%;margin: auto;background-color: rgba(255,255,255,0.95);padding: 10px 15px;border-radius: 10px;"><span style="font-size: 10px;font-weight: bold;line-height: 24px;display: block;">{{$Cards[0]->Card->label}}</span><span style="line-height: 30px;font-size: 16px;font-weight: bold;">{!! $Cards[0]->Card->title !!}</span>
                            </p>
                        </div>
                        </a>
                        <img style="position: absolute;bottom: 0px;width: 150px;background-size: cover;margin-left: -50px;margin-bottom: -50px;z-index: -1;" src="/assets/img/Groupe%2069.svg"></div>
                    <div class="col-4" style="padding: 0;">
                        <a href="{{$Cards[1]->Card->link}}" style="color: unset;">
                            <div class="shadow-lg" style="width: calc(100% + 120px);border-radius: 500px;border: 10px solid rgb(255,255,255);background-image: url(&quot;{{asset('storage/' . $Cards[1]->thumbnail->file)}}&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;margin-left: -60px;margin-right: -60px;z-index: 1;position: relative;padding-top: calc(100% + 120px);box-sizing: border-box;">
                                <p class="text-center" style="position: absolute;top: 0;bottom: 0;left: 0;right: 0;height: fit-content;width: fit-content;max-width: 80%;margin: auto;background-color: rgba(255,255,255,0.95);padding: 10px 15px;border-radius: 10px;"><span style="font-size: 12px;font-weight: bold;line-height: 24px;display: block;">{{$Cards[1]->Card->label}}</span><span style="line-height: 42px;font-size: 20px;font-weight: bold;">{!! $Cards[1]->Card->title !!}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="col-4" style="padding: 0;">
                        <a href="{{$Cards[2]->Card->link}}" style="color: unset;">
                            <div class="shadow-lg" style="width: 100%;padding-top: 100%;border-radius: 500px;border: 10px solid rgb(255,255,255);background-image: url(&quot;{{asset('storage/' . $Cards[2]->thumbnail->file)}}&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;">
                                <p class="text-center" style="position: absolute;top: 0;bottom: 0;right: 7%;left: 19%;height: fit-content;width: fit-content;max-width: 73%;margin: auto;background-color: rgba(255,255,255,0.95);padding: 10px 15px;border-radius: 10px;"><span style="font-size: 10px;font-weight: bold;line-height: 24px;display: block;">{{$Cards[2]->Card->label}}</span><span style="line-height: 30px;font-size: 16px;font-weight: bold;">{!! $Cards[2]->Card->title !!}</span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($BestSallerProducts)
        <div style="margin-bottom: 30px;margin-top: 60px;">
            <div style="margin-bottom: 50px;">
                <p class="text-center" style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;"><strong>@lang("BEST SELLER")</strong></p>
                <p class="text-center" style="line-height: 22px;font-size: 16px;margin: 0;">@lang("TOP VENTE DANS CETTE SEMAINE")</p>
            </div>
            <div class="container">
                <div class="row justify-content-center" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($BestSallerProducts as $BestSallerProduct)
                            <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3" style="margin-bottom: 15px;">
                                <div class="text-center">
                                    <a href="/produit/{{$BestSallerProduct->product->slug_name}}">
                                        <img class="img-fluid" src="{{asset('storage/' . $BestSallerProduct->thumbnail->file)}}" style="border: 5px solid #ffffff;margin-bottom: 15px;">
                                    </a>
                                    <p class="text-center" style="font-size: 12px;line-height: 16px;margin-bottom: 0;">
                                    <?php $i=1; $x=count((array)$BestSallerProduct->categorys); ?>
                                    @foreach($BestSallerProduct->categorys as $category)
                                        <a style="color: inherit;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                    @endforeach
                                    </p>
                                    <span class="text-center" style="display: block;margin-bottom: 5px;">
                                        @for($i = 0; $i < intval($BestSallerProduct->stars);$i++)
                                            <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;">
                                        @endfor
                                        @for($i = 0; $i < (5-intval($BestSallerProduct->stars));$i++)
                                            <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;">
                                        @endfor
                                    </span>
                                    <p class="text-center" style="font-size: 12px;line-height: 19px;margin-bottom: 5px;">{{$BestSallerProduct->product->name}}</p>
                                    <p class="text-center" style="margin-bottom: 10px;color: #E74C3C;font-weight: bold;">{{$BestSallerProduct->product->price}} @lang("Dh")</p>
                                    <ul class="list-inline">
                                    @foreach($BestSallerProduct->photos as $photo)
                                        <li class="list-inline-item"><img src="{{asset('storage/' . $photo->file)}}" style="width: 30px;height: 30px;"></li>
                                    @endforeach
                                    </ul>
                                    <a class="btn btn-primary text-uppercase btn-add-to-carte" data-id="{{$BestSallerProduct->product->id}}" role="button" style="margin: auto;border: none;border-radius: 0;font-size: 9px;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;@lang("Ajouter au panier")</a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
        </div>
        @endif
        @if($Last3Posts)
        <div style="margin-bottom: 30px;margin-top: 60px;">
            <div style="margin-bottom: 50px;">
                <p class="text-center" style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;">&nbsp;<strong>@lang("DERNIÈRE DU BLOG")</strong></p>
                <p class="text-center" style="line-height: 22px;font-size: 16px;margin: 0;">@lang("LES NOUVELLES LES PLUS FRAÎCHES ET LES PLUS EXCITANTES")</p>
            </div>
            <div class="container">
                <div class="row justify-content-center" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($Last3Posts as $Post)
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                            <div class="text-center">
                            <a href="/article/{{$Post->post->slug_name}}">
                            <img class="img-fluid" src="{{asset('storage/' . $Post->thumbnail->file)}}" alt="{{$Post->thumbnail->alt_title}}" title="{{$Post->thumbnail->name}}" description="{{$Post->thumbnail->file_desc}}" style="border: 5px solid #ffffff;width: 100%;">
                            </a>
                                <div style="margin-right: 10%;margin-left: 10%;border-radius: 24px 24px 0px 0px;padding: 10px 15px;height: 180px;margin-top: -90px;background: #ffffff;z-index: 1;position: relative;">
                                    <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;color: #0066FF;font-weight: bold;">
                                    <?php $i=1; $x=count((array)$Post->categorys); ?>
                                    @foreach($Post->categorys as $category)
                                        <a style="color: inherit;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                    @endforeach
                                    </p>
                                    <h1 style="font-size: 19px;line-height: 17px;font-weight: bold;margin-bottom: 5px;">{{$Post->post->name}}</h1>
                                    <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;">{{substr(strip_tags($Post->post->content),0,125)}}</p>
                                    <div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><span style="font-size: 10px;line-height: 14px;">@lang("Par") <strong style="text-transform: uppercase;">{{$Post->user}} </strong>@lang("le")
                                            {{substr($Post->post->created_at,0,10)}}</span></li>
                                            <li class="list-inline-item"><span style="background-image: url(&quot;/assets/img/Icon%20awesome-comment.svg&quot;);width: 27px;display: block;background-size: contain;background-repeat: no-repeat;font-size: 10px;background-position: center;">{{$Post->commentsCount}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
            <img src="/assets/img/Intersection%206.svg" style="position: absolute;left: 0;position: absolute;right: 0;z-index: -1;width: 50%;bottom: 0;opacity: 0;"><img src="/assets/img/Intersection%205.svg" style="position: absolute;right: 0;position: absolute;right: 0;top: 25vh;z-index: -1;width: 50%;"></main>
        @include('inc.footer')
