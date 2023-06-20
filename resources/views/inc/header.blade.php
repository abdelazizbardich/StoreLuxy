
<!DOCTYPE html>
<html lang="{{App::getLocale()}}" dir="@lang("dir")">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="site-storage-url"content="{{asset('storage/')}}">
    <title>{{ $options->SiteOptions->site_name}}@if(isset($Product->Product)) {{$Product->Product->name}} @elseif(isset($Product)) - {{ $Product->name }}@endif</title>
    <link rel="icon" type="image/svg+xml" sizes="219x55" href="{{  asset('storage/' . $options->SiteOptions->site_icon)}}">
    <link rel="stylesheet" href='/assets/bootstrap/css/bootstrap.@lang("dir").min.css?{{ date('d')}}'>
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/fonts/font-awesome.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/fonts/line-awesome.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/fonts/fontawesome5-overrides.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/css/styles.@lang("dir").min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/css/mobile-ready.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/css/notiflix-2.1.3.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/css/animate.min.css?{{ date('d')}}">
    <link rel="stylesheet" href="/assets/css/global.css?{{ date('d')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <!-- Meta data -->

    <meta property="og:url" content="{{ $options->SiteOptions->site_url}}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $options->SiteOptions->site_name}} @if(isset($Product->Product)) {{$Product->Product->name}} @elseif(isset($Product)) - {{ $Product->name }}@endif" />
    <meta property="og:description" content="@if(isset($Product->Product)) {{$Product->Product->short_desc}} @elseif(isset($Product)) - {{ $Product->short_desc }}@else{{ $options->SiteOptions->site_description}}@endif" />
    <meta property="og:image" content="@if(isset($Thumbnail)) - {{ $Thumbnail->file }}@else{{  asset('storage/' . $options->SiteOptions->site_social_img)}}@endif" />
    @if ($options->SiteOptions->header_codes && $options->SiteOptions->header_codes != "NULL")
        {!! $options->SiteOptions->header_codes !!}
    @endif
</head>

<body>
    @if ($options->SiteOptions->before_body_code && $options->SiteOptions->before_body_code != "NULL")
        {!! $options->SiteOptions->before_body_code !!}
    @endif
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=953076688357292&autoLogAppEvents=1"></script>
    <header class="shadow-sm" style="position: sticky;top: 0;z-index: 99;background: #ffffff;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto"><a href="/"><img id="header-logo" alt="{{ $options->SiteOptions->site_name}}" src="{{ asset('storage/' . $options->SiteOptions->site_icon)}}" style="height: 50px;"></a></div>
                <div class="col-3 col-sm-6 col-md-8 col-lg-9 col-xl-9 d-none d-md-none d-lg-block d-xl-block">
                    <nav class="navbar navbar-light navbar-expand-lg" style="padding-top: 0px;padding-bottom: 0px;">
                        <div class="container-fluid"><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                            <div class="collapse navbar-collapse" id="navcol-1">
                                <ul class="nav navbar-nav text-uppercase text-center mx-auto" style="font-size: 16px;line-height: 22px;">
                                    <li class="nav-item" role="presentation"><a class="nav-link active" href="/">@lang("accueil")</a></li>
                                    <li class="nav-item has-mega-menu" role="presentation">
                                        <div class="shadow" id="mega-menu" style="display: none;position: absolute;top: 70px;width: 835px;background: #ffffff;margin: auto;left: 0;right: 0;border-bottom: 4px solid #FFE600;text-transform: initial;">
                                            <div class="mega-menu-tabs">
                                                <ul class="nav nav-tabs" style="border: none;background: rgb(247,248,250);">
                                                    <?php $i = 0; ?>
                                                    @foreach($options->Categorys as $Category)
                                                    <li class="nav-item"><a class="nav-link <?php if($i == 0){echo 'active'; $i = 1;} ?>" role="tab" data-toggle="tab" href="#tab-{{$Category->category->id}}">{{$Category->category->name}}</a></li>
                                                    @endforeach
                                                </ul>
                                                <div class="tab-content" style="padding: 15px 5px;">
                                                <!-- ---------- -->
                                                <?php $i = 0; ?>
                                                @foreach($options->Categorys as $Category)
                                                    <div class="tab-pane <?php if($i == 0){echo 'active'; $i = 1;} ?>" role="tabpanel" id="tab-{{$Category->category->id}}">
                                                        <div>
                                                            <div class="row no-gutters">
                                                                <div class="col-auto">
                                                                    <ul class="list-unstyled">
                                                                        @foreach($Category->subCategorys as $subCategory)
                                                                            <li class="text-left"><a href="/boutique/{{$Category->category->slug_name}}/{{$subCategory->slug_name}}" style="color: initial;text-decoration: none;font-size: 14px;line-height: 19px;padding: 18px;display: block;height: unset;">{{$subCategory->name}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row no-gutters">
                                                                        <?php $ii = 0; ?>
                                                                        @foreach($Category->category->products as $product)
                                                                            @if($ii < 3)
                                                                                <div class="col-3" style="padding: 10px;">
                                                                                    <a href="/produit/{{$product->Product->slug_name}}" style="color: initial;text-decoration: none;">
                                                                                        <div><img class="img-fluid" alt="{{$product->thumbnail->alt_title}}" title="{{$product->thumbnail->name}}" description="{{$product->thumbnail->file_desc}}" src="{{asset('storage/' . $product->thumbnail->file)}}" style="width: 100%;">
                                                                                            <p class="text-left" style="font-size: 12px;line-height: 16px;margin-bottom: 0;">{{$product->Product->name}}</p>
                                                                                            <p class="text-lowercase text-left" style="font-size: 1.5rem;line-height: 20px;color: #FF0000;font-weight: bold;margin-bottom: 0;">{{$product->Product->price}}Dh</p>
                                                                                        </div>
                                                                                    </a>
                                                                                </div>
                                                                            @endif
                                                                            <?php $ii++; ?>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <!-- ------- -->
                                                </div>
                                            </div>
                                        </div><a class="nav-link" href="/boutique">@lang("Boutique")</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="/à-propos">@lang("à propos")</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="/blogs">@lang("Blogs")</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" href="/contact">@lang("Contact")</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col text-center">
                    <ul class="list-inline" style="margin: 0;">
                        <li class="list-inline-item">
                            <a id="show-search-box">
                                <img src="/assets/img/Icon%20awesome-search.svg" style="width: 14px;margin: 5px;cursor:pointer;">
                            </a>
                            <a href="/suivi-de-commande"><img src="/assets/img/Icon%20feather-truck.svg" style="width: 14px;margin: 5px;"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto text-right d-lg-none d-xl-none"><button class="btn btn-primary" id="show-side-menu" type="button" style="padding: 0;background: none;border: none;color: rgb(0,0,0);box-shadow: none;font-size: 29px;"><i class="fa fa-bars" style="color: rgb(57,57,57);"></i></button></div>
            </div>
        </div>
    </header>
