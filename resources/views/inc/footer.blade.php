
{{-- instagram-feed1 --}}
<div id="instagram-feed1">

</div>



<!-- Start: Fixed items -->
    <div>
    @if($options->OrderNotice == true)
        <div class="shadow" id="order-notis">
            <div class="row no-gutters" style="min-width: 250px;min-height: 100px;padding: 15px;">
                <div class="col-auto text-center"><img class="thumbnail" src="/assets/img/product-05.jpg" style="max-width: 80px;width: auto;max-height: 80px;height: auto;margin: auto;"></div>
                <div class="col" style="padding-left: 15px;max-width: 250px;">
                    <p style="font-size: 12px;line-height: 16px;margin-bottom: 0px;">@lang("Quelqu'un a commandé:")</p>
                    <p class="title" style="font-size: 12px;font-weight: bold;margin-bottom: 5px;line-height: 19px;">------------</p>
                    <div><span class="price" style="color: #FF0000;font-weight: bold;font-size: 15px;line-height: 16px;float: left;">----.-- @lang("Dh")</span><span style="font-size: 12px;line-height: 16px;line-height: 16px;float: right;">@lang("il y a 1 minute")</span></div>
                </div>
            </div><span class="close" style="opacity: 1;"><i class="la la-close" style="position: absolute;top: 5px;right: 5px;color: red;font-weight: bold;font-size: 17px;"></i></span>
            </div>
    @endif

        <div class="shadow-sm" id="chat-btn"
            style="position: fixed;right: 35px;bottom: 89px;background: #ffffff;width: 35px;height: 35px;border-radius: 50px;text-align: center;background-color: rgba(0,102,255,0.84);z-index: 999;padding: 17px;">
            <a target="blank" href="https://m.me/{{ $options->SiteOptions->facebook_id}}" >
            <img class="img-fluid" src="/assets/img/Icon%20awesome-facebook-messenger.png" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;width: 60%;"></a>
            @if($options->ChatMessage == true)
            <div style="position: absolute;left: -197px;top: -219%;">
            <img src="/assets/img/Union%201.png" style="width: 251px;height: 87px;">
            <p class="text-left" style="font-size: 12px;line-height: 16px;position: absolute;left: 35px;top: 17px;right: 32px;">@lang("Vous pouvez discuter avec notre équipe, ils sont en ligne")</p>
            <button class="btn btn-primary" id="close-chat" type="button" style="position: absolute;right: 5px;top: 5px;background: none;border: 1px solid #ffe600;box-shadow: none;color: rgb(255,0,0);padding: 0px;width: 20px;height: 20px;border-radius: 30px;background-color: #ffffff;font-size: 10px;"><i class="fa fa-close"></i></button>
            </div>
            @endif
        </div>

        <div class="shadow " id="back-to-top" style="position: fixed;right: 25px;bottom: 25px;background: #ffffff;width: 50px;height: 50px;border-radius: 50px;text-align: center;z-index: 999;cursor: pointer;">
            <img src="/assets/img/Groupe%2052.png" style="position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;">
        </div>
        <div id="searsh-box">
            <div class="container" style="height: 100%;">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-10 col-sm-10 col-md-8 col-lg-7 col-xl-6">
                        <form id="search-form" method="post" action="/recherche">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group" style="border-bottom: 4px solid #ffffff;">
                                <div class="input-group"><input name="keyword" class="form-control" type="text" style="border: none;background: none;font-size: 20px;color: rgb(255,255,255);box-shadow: none;" placeholder="Chercher...">
                                    <div class="input-group-append"><button class="btn btn-primary" type="submit" style="background: none;border: none;box-shadow: none;"><i class="fa fa-search" style="color: rgb(255,255,255);font-size: 20px;"></i></button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div><button class="btn btn-primary" id="close-search-box" type="button" style="position: absolute;top: 15%;right: 15%;font-size: 45px;padding: 5px;border: none;background: none;height: auto;box-shadow: none;"><i class="fa fa-close"></i></button>
        </div>
    <div class="d-lg-none d-xl-none" id="side-menu">
        <div style="background-color: #ffe600;height: 100%;width: 100%;overflow: hidden;"><img width="100%" src="{{ asset('storage/' . $options->SiteOptions->site_icon)}}" style="max-width: 36%;max-height: 50px;filter: brightness(0.2);/*transform: rotateZ(-15deg);*/margin: 5%;margin-bottom: 0;">
            <ul class="list-unstyled">
                <li class="text-uppercase" style="background-color: #2C3E50;"><a href="/" style="transform: translateX(-50%);">@lang("accueil")</a></li>
                <li class="text-uppercase" style="background-color: #ffe600;"><a href="/boutique" style="transform: translateX(50%);color: rgb(44,62,80);">@lang("Boutique")</a></li>
                <li class="text-uppercase" style="background-color: #2c3e50;"><a href="/à-propos" style="transform: translateX(-50%);">@lang("à propos")</a></li>
                <li class="text-uppercase" style="background-color: #ffe600;color: rgb(44,62,80);"><a href="/blogs" style="transform: translateX(50%);">@lang("Blogs")</a></li>
                <li class="text-uppercase" style="background-color: #2c3e50;"><a href="/contact" style="transform: translateX(-50%);">@lang("Contact")</a></li>
            </ul><i class="fa fa-close" id="close-side-menu" style="position: absolute;height: 36px;width: 36px;right: 5%;text-align: center;bottom: 5%;border-radius: 50px;padding: 6px;background: #ffffff;cursor: pointer;font-size: 22px;"></i></div>
        </div>
        <div id="lightBox">
            <div class="container" style="height: 100%;">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-10 text-center" style="position: relative;">
                        <div id="light-box-overflow" style="position: fixed;top: 70px;left: 0;right: 0;bottom: 0;z-index: -1;"></div><img class="img-fluid" src="/assets/img/646464.jpg" style="max-height: 80vh;width: 100%;"><button class="btn btn-primary" id="close-light-box" type="button" style="position: absolute;top: -6%;right: -2%;font-size: 20px;padding: 5px;border: none;background: none;height: auto;box-shadow: none;color: rgb(0,0,0);"><i class="fa fa-close"></i></button></div>
                </div>
            </div>
        </div>
        <div class="shadow-lg" id="fixed-carte"><img src="/assets/img/Intersection 3.svg" style="position: absolute;bottom: 0;left: 0;width: 50%;z-index: -1;" /><img src="/assets/img/Intersection 4.svg" style="position: absolute;top: 0;right: 0;width: 50%;z-index: -1;" />
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1 style="font-size: 36px;line-height: 39px;position: relative;height: 104px;">@lang("Panier")<img src="/assets/img/Icon feather-shopping-cart2.svg" style="position: absolute;left: 20px;top: -34%;width: 110px;" /></h1>
                    </div>
                </div>
            </div>
            <div class="container" style="height: 100%;overflow-y: auto;padding-top: 15px;padding-bottom: 15px;">
                <div class="row" id="fixed-carte-product-row">
                @if($options->CartProducts)
                   @foreach($options->CartProducts as $CartProduct)
                   <div class="fixed-carte-product col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                        <div style="padding: 5px;position: relative;"><img class="img-fluid" style="width: 100%;margin-bottom: 10px;" src="{{asset('storage/' . $CartProduct->Thumbnail->file)}}" />
                            <p class="text-break" style="font-size: 14px;line-height: 19px;margin-bottom: 5px;width: 100%;">{{$CartProduct->Product->name}}</p>
                            <p class="text-break" style="width: 100%;font-size: 14px;line-height: 19px;color:red">{{$CartProduct->Product->price}} @lang("Dh")</p><button onclick="removeFromCarte(this)" data-id="{{$CartProduct->Product->id}}" class="btn btn-primary shadow-sm" type="button" style="border: none;color: #ff0000;box-shadow: none;position: absolute;top: -10px;right: -10px;background-color: rgb(255,255,255);border-radius: 50px;border: 2px solid rgb(255,223,0);width: 20px;height: 20px;font-size: 12px;text-align: center;padding: 0px;"><i class="fa fa-close close-fixed-carte-product" style="display: block;"></i></button>
                        </div>
                    </div>
                   @endforeach
                @endif
                </div>
            </div>
            <i class="fa fa-close" id="close-fixed-carte" style="position: absolute;height: 36px;width: 36px;right: 5%;text-align: center;top: 45px;border-radius: 50px;padding: 6px;background: #ffffff;cursor: pointer;font-size: 22px;"></i>
            <a href="/panier"><i class="fa fa-check" id="close-fixed-carte" style="position: absolute;height: 36px;width: 36px;right: 5%;text-align: center;top: 90px;border-radius: 50px;padding: 6px;background: #007bff;cursor: pointer;font-size: 22px;color: white;"></i></a>
        </div>
        </div>
        <!-- End: Fixed items -->
        <footer style="position: relative;">
            <div style="position: absolute;left: 0;right: 0;margin: auto;width: fit-content;height: 60px;top: -80px;" class="text-center">
                <p class="text-center" style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;"><span style="color: rgb(42,115,216);">@ @lang("SUIVEZ-NOUS")</span>&nbsp;@lang("SUR")</p>
                <p class="text-center" style="line-height: 22px;font-size: 16px;margin: 0;">@lang("INSTAGRAM")</p>
                <a href="{{ @$options->SiteOptions->s_instagram}}" target="_blank" rel="noopener noreferrer">
                    <i class="fa fa-instagram"></i>
                </a>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    @foreach ($options->SiteOptions->instagram_photos as $photo)
                        @if($photo)
                            <div class="col-4 col-lg-2 col-xl-2 instagram-post" style="padding: 0;">
                                <span style="color: initial;text-decoration: none;"><img class="img-fluid lightZoom" src="{{asset('storage/'.@$photo->file)}}" style="width: 100%; height: 100%; aspect-ratio: 1/1; object-fit: cover;"></span>
                                <a href="{{ @$options->SiteOptions->s_instagram}}" target="_blank" class="link">
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div style="background-color: #0066FF;">
                <div class="container" style="padding-top: 15px;padding-bottom: 15px;">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-4 col-xl-auto text-center">
                            <p style="font-size: 14px;line-height: 19px;font-weight: bold;color: rgb(255,255,255);margin-bottom: 0;">@lang("SOYEZ EN CONTACT AVEC NOUS")</p>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-7 text-center">
                            <form id="newsletterForm">
                                <div class="form-group" style="margin: 16px;">
                                    <div class="input-group">
                                        <input id="newsemail" type name="email" class="form-control" type="text" style="font-size: 14px;line-height: 19px;border: none;" placeholder="@lang("Entrer votre Email")...">
                                        <div class="input-group-append"><button class="btn btn-primary" type="submit" style="font-size: 14px;line-height: 19px;background-color: #2A2A2A;border: none;">@lang("REJOIGNEZ-NOUS")</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-2 col-xl-auto text-center text-lg-right text-xl-right">
                            <ul class="list-inline" style="margin-bottom: 0;color: rgb(255,255,255);">
                                @if($options->SiteOptions->s_facebook)<li class="list-inline-item" style="margin: 5px;"><a href="{{ $options->SiteOptions->s_facebook}}" target="_blank" style="color: inherit;text-decoration: none;"><i class="fa fa-facebook" style="font-size: 20px;"></i></a></li>@endif
                                @if($options->SiteOptions->s_twitter)<li class="list-inline-item" style="margin: 5px;"><a href="{{ $options->SiteOptions->s_twitter}}" target="_blank" style="color: inherit;text-decoration: none;"><i class="fa fa-twitter" style="font-size: 20px;"></i></a></li>@endif
                                @if($options->SiteOptions->s_instagram)<li class="list-inline-item" style="margin: 5px;"><a href="{{ $options->SiteOptions->s_instagram}}" target="_blank" style="color: inherit;text-decoration: none;"><i class="fa fa-instagram" style="font-size: 20px;"></i></a></li>@endif
                                @if($options->SiteOptions->s_pinterest)<li class="list-inline-item" style="margin: 5px;"><a href="{{ $options->SiteOptions->s_pinterest}}" target="_blank" style="color: inherit;text-decoration: none;"><i class="fa fa-pinterest" style="font-size: 20px;"></i></a></li>@endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div style="background-image: url(&quot;/assets/img/Tracé%2026.svg&quot;);background-position: center;background-size: 100%;background-repeat: no-repeat;background-color: #F7F8FA;padding-top: 35px;padding-bottom: 35px;border-bottom: 1px solid #FFC600;">
                <div class="container">
                    <div class="row order-lg-center order-xl-center">
                        @if($options->SiteOptions->widjet_1)
                        <div class="col-12 col-md mb-5">
                            {!! $options->SiteOptions->widjet_1 !!}
                        </div>
                        @endif
                        @if($options->SiteOptions->widjet_2)
                        <div class="col-12 col-md mb-5">
                            {!! $options->SiteOptions->widjet_2 !!}
                        </div>
                        @endif
                        @if($options->SiteOptions->widjet_3)
                        <div class="col-12 col-md mb-5">
                            {!! $options->SiteOptions->widjet_3 !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="container" style="padding-bottom: 15px;padding-top: 15px;">
                    <div class="row align-items-center">
                        <div class="col-md-auto col-12"><img class="bottom-footer-logo" src="{{ asset('storage/' . $options->SiteOptions->site_logo)}}"></div>
                        <div class="col-12 col-md text-center text-lg-right text-xl-right">
                            <p style="margin-bottom: 0;font-size: 14px;line-height: 19px;">
                                <strong>{{ $options->SiteOptions->site_name}} © </strong>{{date('Y')}}. @lang("Tous droits réservés")
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if ($options->SiteOptions->footer_codes && $options->SiteOptions->footer_codes != "NULL")
                {!! $options->SiteOptions->footer_codes !!}
            @endif
        </footer>
        <script src="/assets/js/jquery.min.js?{{ date('d')}}"></script>
        <script src="/assets/bootstrap/js/bootstrap.min.js?{{ date('d')}}"></script>
        <script src="/assets/js/notiflix-2.1.3.min.js?{{ date('d')}}"></script>
        <script src="/assets/js/script.min.js?{{ date('d')}}"></script>
        <script src="/assets/js/countdown.js?{{ date('d')}}"></script>

        @if($options->SiteOptions->footer_codes && $options->SiteOptions->footer_codes != "NULL")
            {!! $options->SiteOptions->after_body_code !!}
        @endif
</body>

</html>
