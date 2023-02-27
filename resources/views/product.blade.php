@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;">
        <div style="height: 150px;background-color: #F7F8FA;position: relative;">
            <p class="text-center" style="font-size: 54px;line-height: 74px;font-weight: bold;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;">@lang("PRODUIT")</p>
        </div>
        <div id="product-banner" style="min-height: calc(100vh - 210px);margin-bottom: 35px;padding-top: 15px;padding-bottom: 15px;">
            <div class="container">
                <p><a href="/">@lang("accueil")&nbsp;</a>&nbsp;&gt;&nbsp;<a href="/boutique">@lang("Boutique")&nbsp;</a>&nbsp;&gt;&nbsp;
                @foreach($categorys as $key=>$category)
                    <a style="text-transform: lowercase;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a>@if(count($categorys) > $key+1)،@endif
                @endforeach
                &nbsp;&gt;&nbsp;{{$Product->name}}</p>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 15px;"><img class="img-fluid lightZoom" title="{{$Thumbnail->name}}" alt="{{$Thumbnail->alt_title}}" src="{{asset('storage/' . $Thumbnail->file)}}" style="margin-bottom: 5px; width:100%">
                        <div>
                            <div class="row no-gutters">
                            @foreach($Photos as $Photo)
                                <div class="col-2"><img style="padding: 2px;" class="img-fluid lightZoom" title="{{$Photo->name}}" alt="{{$Photo->alt_title}}" src="{{asset('storage/' . $Photo->file)}}"></div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h1>{{$Product->name}}</h1>
                        <span>
                                @for($i = 0; $i < intval($globalStarsAvr);$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;">
                                @endfor
                                @for($i = 0; $i < (5-intval($globalStarsAvr));$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;">
                                @endfor
                        </span>
                        <div><span class="price">{{$Product->price}}@lang("Dh")</span><span class="old-price"><span style="text-decoration: line-through;">{{$Product->old_price}}@lang("Dh")</span></span><span class="reduction"><?php echo '-'.number_format(100-(($Product->price/$Product->old_price)*100), 2, '.', '').'%'; ?></span></div>
                        <p class="text-justify shortDesc">{{$Product->short_desc}}</p>
                        <div id="dealcount">
                            <p>@lang("Seulement") {{$Product->stock_amount}} @lang("restant en stock")</p>
                            <div class="progress" style="height: 33px;border-radius: 17px;">

                                <div class="progress-bar" aria-valuenow="{{number_format((($Product->stock_amount/$Product->stock_size)*100), 2, '.', '')}}" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format((($Product->stock_amount/$Product->stock_size)*100), 2, '.', '')}}%;">
                                    <span class="sr-only">{{number_format((($Product->stock_amount/$Product->stock_size)*100), 2, '.', '')}}%</span>
                                </div>

                            </div>
                            <div id="countDown" class="countdown-circles d-flex flex-wrap justify-content-center pt-4"><span id="dataDate" style="display: none;opacity: 0;width: 0;height: 0;overflow: hidden;">{{$Product->sall_end}}</span>
                                <ul class="list-inline" id="countdown">
                                    <li class="list-inline-item text-center"><span id="days" style="display: block;background-color: #ff0000;color: rgb(255,255,255);font-size: 36px;line-height: 61px;width: 60px;height: 60px;">-</span><span>@lang("Journées")</span></li>
                                    <li class="list-inline-item text-center"><span id="hours" style="display: block;background-color: #ff0000;color: rgb(255,255,255);font-size: 36px;line-height: 61px;width: 60px;height: 60px;">-</span><span>@lang("Heures")</span></li>
                                    <li class="list-inline-item text-center"><span id="minutes" style="display: block;background-color: #ff0000;color: rgb(255,255,255);font-size: 36px;line-height: 61px;width: 60px;height: 60px;">-</span><span>@lang("Minutes")</span></li>
                                    <li class="list-inline-item text-center"><span id="seconds" style="display: block;background-color: #ff0000;color: rgb(255,255,255);font-size: 36px;line-height: 61px;width: 60px;height: 60px;">-</span><span>@lang("Secondes")</span></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <ul class="list-inline d-flex justify-content-start align-items-center">
                                <li class="list-inline-item"><span style="font-size: 18px;line-height: 61px;">@lang("Quantité")</span></li>
                                <li class="list-inline-item">
                                    <div class="input-group qte_input" style="width: 184px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-primary minus" type="button" style="background-color: #F7F8FA;color: #9D9D9F;font-size: 36px;font-weight: bold;line-height: 24px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;">-</button>
                                        </div>
                                        <input class="form-control product-qte" data-max="{{$Product->stock_amount}}" readonly type="text" style="height: 40px;max-width: 60px;border: none;text-align: center;font-size: 24px;line-height: 61px;font-weight: 100;" inputmode="numeric" value="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary text-center plus" type="button" style="background-color: #E4E4E4;color: #9D9D9F;font-size: 36px;font-weight: bold;line-height: 24px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;">+</button>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item">
                                    <ul class="list-inline d-none d-lg-block d-xl-block" style="height: 42px;background: #F7F8FA;min-width: 150px;border-radius: 25px;padding-right: 10px;">
                                        <li class="list-inline-item text-center" style="height: 42px;width: 42px;background: #0066FF;border-radius: 25px;float: left;"><img class="img-fluid" src="/assets/img/Icon%20feather-share-2.svg" style="width: 22px;margin: 10px;"></li>

                                        <li class="list-inline-item " style="height: 42px;width: 35px;border-radius: 25px;text-align: center;float: left;">
                                            <a target="_blank" style="color: inherit;" href="https://www.facebook.com/sharer/sharer.php?u={{ $options->SiteOptions->site_url}}/produit/{{$Product->slug_name}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                            <i class="fa fa-facebook" style="font-size: 22px;line-height: 42px;"></i></a>
                                        </li>
                                        <li class="list-inline-item" style="height: 42px;width: 35px;border-radius: 25px;text-align: center;float: left;">
                                            <a target="_blank" style="color: inherit;" href="https://twitter.com/intent/tweet?text={{$Product->slug_name}}%0APrix: {{$Product->price}}%0ALien: {{ $options->SiteOptions->site_url}}/produit/{{$Product->slug_name}}">
                                            <i class="fa fa-twitter" style="font-size: 22px;line-height: 42px;"></i>
                                        </a>
                                    </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-group actions" role="group">
                            <a class="btn btn-primary order-now" data-id="{{$Product->id}}" role="button" style="background-color: #FFE600;color: rgb(0,0,0);"><i class="far fa-hand-point-right"></i>&nbsp;@lang("Acheter maintenant")</a>
                            <a data-id="{{$Product->id}}" class="btn btn-primary btn-add-to-carte" role="button" style="background-color: #FF0000;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;@lang("Ajouter au panier")</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div style="padding-bottom: 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9" style="margin-bottom: 15px;">
                        <div style="background-color: #F7F8FA;padding-left: 15px;padding-right: 15px;margin-bottom: 35px;"><span style="font-size: 20px;line-height: 61px;">@lang("Détails du produit"):</span></div>
                        <div id="product-details" style="padding: 35px;border-bottom: 1px solid rgb(255,230,0);background-color: #f7f8fa;margin-bottom: 65px;position: relative;">
                            <div class="product-details-content">
                            {!! $Product->long_desc !!}
                            </div><button class="btn btn-primary shadow" id="show-more-details" type="button" style="width: 54px;height: 54px;border-radius: 50%;position: absolute;bottom: -27px;left: 0;right: 0;margin: auto;background-color: rgb(255,255,255);border: none;z-index: 1;"><i class="fa fa-chevron-down" style="color: rgb(255,230,0);"></i></button>
                            <div
                                class="feader" style="width: 100%;height: 150px;background-image: linear-gradient(rgba(0,0,0,0), rgba(255,223,0,0.3));position: absolute;bottom: 0;left: 0;right: 0;"></div>
                    </div>
                    <div style="background-color: #F7F8FA;padding-left: 15px;padding-right: 15px;margin-bottom: 35px;"><span style="font-size: 20px;line-height: 61px;">@lang("Évaluations et commentaires"):</span></div>
                    <div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-sm-12 col-md-4 col-lg-6 text-center text-sm-center text-md-left text-lg-left text-xl-left" style="margin-bottom: 15px;">
                                <p style="font-size: 82px;line-height: 61px;font-weight: bold;">{{$globalStarsAvr}}/5</p><span><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;"></span><span>&nbsp;{{$reviewsCount}} @lang("évaluations")</span></div>
                            <div
                                class="col" style="margin-bottom: 15px;">
                                <div class="row no-gutters align-items-center" style="margin-bottom: 10px;">
                                    <div class="col-auto" style="line-height: 0;"><span><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"></span></div>
                                    <div
                                        class="col">
                                        <div class="progress" style="border-radius: 0px;margin-left: 15px;">
                                            <div class="progress-bar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: {{$reviewStarsCountArr->star5}}%;"><span class="sr-only">{{$reviewStarsCountArr->star5}}%</span></div>
                                        </div>
                                </div>
                        </div>
                        <div class="row no-gutters align-items-center" style="margin-bottom: 10px;">
                            <div class="col-auto" style="line-height: 0;"><span><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"></span></div>
                            <div
                                class="col">
                                <div class="progress" style="border-radius: 0px;margin-left: 15px;">
                                    <div class="progress-bar" aria-valuenow="{{$reviewStarsCountArr->star4}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$reviewStarsCountArr->star4}}%;"><span class="sr-only">{{$reviewStarsCountArr->star4}}%</span></div>
                                </div>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center" style="margin-bottom: 10px;">
                        <div class="col-auto" style="line-height: 0;"><span><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"></span></div>
                        <div
                            class="col">
                            <div class="progress" style="border-radius: 0px;margin-left: 15px;">
                                <div class="progress-bar" aria-valuenow="{{$reviewStarsCountArr->star3}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$reviewStarsCountArr->star3}}%;"><span class="sr-only">{{$reviewStarsCountArr->star3}}%</span></div>
                            </div>
                    </div>
                </div>
                <div class="row no-gutters align-items-center" style="margin-bottom: 10px;">
                    <div class="col-auto" style="line-height: 0;"><span><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"></span></div>
                    <div
                        class="col">
                        <div class="progress" style="border-radius: 0px;margin-left: 15px;">
                            <div class="progress-bar" aria-valuenow="{{$reviewStarsCountArr->star2}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$reviewStarsCountArr->star2}}%;"><span class="sr-only">{{$reviewStarsCountArr->star2}}%</span></div>
                        </div>
                </div>
            </div>
            <div class="row no-gutters align-items-center" style="margin-bottom: 10px;">
                <div class="col-auto" style="line-height: 0;"><span><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"><img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;"></span></div>
                <div
                    class="col">
                    <div class="progress" style="border-radius: 0px;margin-left: 15px;">
                        <div class="progress-bar" aria-valuenow="{{$reviewStarsCountArr->star1}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$reviewStarsCountArr->star1}}%;"><span class="sr-only">{{$reviewStarsCountArr->star1}}%</span></div>
                    </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <div style="padding-left: 15px;padding-right: 15px;margin-bottom: 35px;border-top: 1px solid rgba(112,112,112,0.12);border-bottom: 1px solid rgba(112,112,112,0.12);"><span style="font-size: 20px;line-height: 44px;">@lang("Avis sur le produit"):</span></div>
        <!-- Start: review -->
        @foreach($reviews as $review)
        <div class="review">
            <span>
                @for($i = 0; $i < intval($review->data->stars);$i++)
                    <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;">
                @endfor
                @for($i = 0; $i < (5-intval($review->data->stars));$i++)
                    <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;">
                @endfor
            </span>
            <p>@lang("Par")&nbsp;<span style="color: rgb(0,102,255);">{{$review->data->username}}</span></p>
            <p style="font-size: 18px;line-height: 23px;">{{$review->data->comment}}</p>
            <div>
                <ul class="list-inline">
                @if(isset($review->photos))
                    @foreach($review->photos as $photo)
                        <li class="list-inline-item"><img class="img-thumbnail img-fluid lightZoom" src="{{ asset('storage/' . $photo->file) }}"></li>
                    @endforeach
                @endif
                </ul>
            </div>
        </div>
        @endforeach
        <!-- End: review -->

        <div style="background-color: #ffffff;border: 2px solid #ffe600;">
            <div style="background-color: #ffe600;padding: 15px;"><span style="font-size: 21px;line-height: 28px;font-weight: bold;">@lang("Écrivez Une Avis")</span></div>
            <form style="padding: 15px;" method="POST" action="/produit/nouvelle-avis" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{$Product->id}}">
                <div class="form-row">
                    <div class="col">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger text-left">
                            <ul style="margin:0px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        <div class="form-group{{ $errors->has('fulnamelname') ? ' has-error' : '' }}"><label style="font-size: 18px;line-height: 14px;">@lang("Nom"):</label>
                        <input class="form-control" name="name" value="{{ Request::old('name') }}" type="text" placeholder="@lang("Tapez votre nom")..." style="font-size: 14px;line-height: 19px;padding: 30px;background-color: #F7F8FA;border: 1px solid #FFCB00;box-shadow: none;border-radius: 0;padding-left: 15px;padding-right: 15px;"
                                required=""></div>
                        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}"><label style="font-size: 18px;line-height: 14px;">@lang("Avis"):</label>
                        <textarea class="form-control" name="comment" value="{{ Request::old('comment') }}" style="font-size: 14px;line-height: 19px;padding: 15px;background-color: #F7F8FA;border: 1px solid #FFCB00;box-shadow: none;border-radius: 0;min-height: 150px;"
                                placeholder="@lang("Tapez votre avis")..." required=""></textarea></div>
                        <div class="form-group{{ $errors->has('strCount') ? ' has-error' : '' }}">
                        <label style="font-size: 18px;display: block;">@lang("Combien d'étoiles pouvez-vous attribuer à ce produit ?")</label>
                        <ul class="list-inline starsList">
                            <li class="list-inline-item str" data-order="1"><span style="position: relative;"><input type="checkbox" style="width: 100%;height: 100%;position: absolute;top: 0;right: 0;left: 0;bottom: 0;opacity: 0;z-index: 1;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 22px;opacity: 0.50;"></span></li>
                            <li class="list-inline-item str" data-order="2"><span style="position: relative;"><input type="checkbox" style="width: 100%;height: 100%;position: absolute;top: 0;right: 0;left: 0;bottom: 0;opacity: 0;z-index: 1;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 22px;opacity: 0.50;"></span></li>
                            <li class="list-inline-item str" data-order="3"><span style="position: relative;"><input type="checkbox" style="width: 100%;height: 100%;position: absolute;top: 0;right: 0;left: 0;bottom: 0;opacity: 0;z-index: 1;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 22px;opacity: 0.50;"></span></li>
                            <li class="list-inline-item str" data-order="4"><span style="position: relative;"><input type="checkbox" style="width: 100%;height: 100%;position: absolute;top: 0;right: 0;left: 0;bottom: 0;opacity: 0;z-index: 1;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 22px;opacity: 0.50;"></span></li>
                            <li class="list-inline-item str" data-order="5"><span style="position: relative;"><input type="checkbox" style="width: 100%;height: 100%;position: absolute;top: 0;right: 0;left: 0;bottom: 0;opacity: 0;z-index: 1;"><img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 22px;opacity: 0.50;"></span></li>
                        </ul>
                        <input class="form-control" type="text" id="strCount" required="" value="{{ count($errors) > 0 ? Request::old('strCount') : '5' }}" name="strCount" required="" readonly="" autocomplete="off" hidden=""></div>
                        <div class="form-group">
                            <label style="font-size: 18px;line-height: 14px;">@lang("Quelques photos du produit"):</label>
                            <input type="file" style="font-size: 14px;line-height: 19px;padding: 8px;background-color: #ffbd00;border: 1px solid #FFCB00;box-shadow: none;border-radius: 0;display: block;width: 100%;padding-left: 30px;" multiple="" name="photos[]">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" style="background-color: #ffe600;font-size: 21px;line-height: 28px;text-transform: uppercase;color: #000000;padding: 15px;border-radius: 0;border: none;box-shadow: none;">@lang("Soumettre Une avis")</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
            <div style="background-color: #FFE600;padding-left: 15px;padding-right: 15px;margin-bottom: 35px;"><span style="font-size: 20px;line-height: 61px;">@lang("Produits sponsorisés"):</span></div>
            <div>
                <div class="row no-gutters">
                    @foreach($SponsoredProduct as $SProduct)
                    <a href="/produit/{{$SProduct->Product->slug_name}}"><div class="col-12 col-sm-6 col-md-3 col-lg-12 text-center" style="margin-bottom: 15px;padding: 5px;">
                        <img style="margin-bottom: 10px;" class="img-fluid" alt="{{$SProduct->Thumbnail->alt_title}}" title="{{$SProduct->Thumbnail->name}}" description="{{$SProduct->Thumbnail->file_desc}}" src="{{ asset('storage/' . $SProduct->Thumbnail->file) }}">
                        <h1 style="font-size: 12px;line-height: 16px;">{{$SProduct->Product->name}}</h1>
                        <span style="font-size: 15px;line-height: 20px;color: #FF0000;font-weight: bold;"><strong>{{$SProduct->Product->price}}@lang("Dh")</strong></span>
                    </div></a>
                    @endforeach
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <div style="margin-bottom: 75px;margin-top: 60px;">
            <div style="margin-bottom: 50px;"></div>
            <div class="container">
                @if($similarProducts)<p style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;">&nbsp;<strong>@lang("De la même catégorie"):</strong></p>@endif
                <div class="row justify-content-center" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($similarProducts as $similarProduct)
                    <div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3" style="margin-bottom: 15px;">
                        <div class="text-center">
                            <img class="img-fluid" title="{{$similarProduct->thumbnail->name}}" description="{{$similarProduct->thumbnail->file_desc}}" alt="{{$similarProduct->thumbnail->alt_title}}" src="{{asset('storage/' . $similarProduct->thumbnail->file)}}" style="border: 5px solid #ffffff;margin-bottom: 15px;">
                            <p class="text-center" style="font-size: 10px;line-height: 16px;margin-bottom: 0;">
                            @foreach($similarProduct->categorys as $category)
                                 <a style="color: inherit;" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a>,&nbsp;
                            @endforeach
                            </p>
                            <span class="text-center" style="display: block;margin-bottom: 5px;">
                                @for($i = 0; $i < intval($similarProduct->stars);$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 15px;">
                                @endfor
                                @for($i = 0; $i < (5-intval($similarProduct->stars));$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 15px;">
                                @endfor
                            </span>
                            <p class="text-center" style="margin-bottom: 5px;">{{$similarProduct->Product->name}}</p>
                            <p class="text-center" style="margin-bottom: 10px;color: #E74C3C;font-weight: bold;">{{$similarProduct->Product->price}} @lang("Dh")</p>
                            <a class="btn btn-primary text-uppercase btn-add-to-carte" data-id="{{$similarProduct->Product->id}}" role="button" style="margin: auto;border: none;border-radius: 0;font-size: 9px;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;@lang("Ajouter au panier")</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div><img src="/assets/img/Intersection%205-1.svg" style="position: absolute;left: 0;top: 125vh;z-index: -1;width: 50%;"></main>
        @include('inc.footer')
