<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="site-storage-url"content="{{asset('storage/')}}">
    <title>{{ $options->SiteOptions->site_name}} - admin</title>
    <link rel="icon" type="image/svg+xml" sizes="219x55" href="{{ asset('storage/' . $options->SiteOptions->site_icon)}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/admin/css/styles.css?{{ date('d')}}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="/assets/admin/css/datatables.min.css?{{ date('d')}}" rel="stylesheet">
    <link href="/assets/admin/css/datetimepicker/bootstrap-datetimepicker.min.css?{{ date('d')}}" rel="stylesheet" media="screen">
</head>

<body>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-10 col-sm-7 col-md-5 col-lg-3 col-xl-2 d-none d-sm-none d-md-none d-lg-block d-xl-block" id="side-menu">
                    <div style="left: 0;right: 0;top: 0;padding: 0px 15px;position: sticky;" width="70">
                        <div class="text-center" style="margin: 10px 0px;padding: 5px;"><a href="{{ $options->SiteOptions->site_url}}/admin" style="display: block;text-align: center;"><img class="img-fluid" width="70" src="{{ asset('storage/' . $options->SiteOptions->site_logo)}}"></a><button class="btn btn-primary close" type="button" style="position: absolute;top: 15px;right: 5px;color: var(--color-orenge);background: none;border: none;box-shadow: none;opacity: 1;text-shadow: none;"><i class="fa fa-close d-lg-none d-xl-none"></i></button></div>
                        <hr class="white-horizental-line-02">
                            <div style="margin: 10px 0px;padding: 5px;">
                                <div class="text-center"></div><a href="#" style="display: block;text-align: center;"><img class="user-avatar" src="{{ asset( 'storage/' .((Session::get('userData')->avatar)?Session::get('userData')->avatar->file:""))}}"></a></div>
                            <div class="text-center" style="margin: 10px 0px;padding: 5px;"><a href="#" style="text-decoration: none;"><span style="color: var(--color-white);font-size: 20px;line-height: 27px;">{{Session::get('userData')?Session::get('userData')->first_name:""}} {{Session::get('userData')?Session::get('userData')->last_name:""}}</span></a></div>
                            <hr class="white-horizental-line-02">
                            <ul class="nav nav-tabs">
                                <li class="nav-item active"><a class="nav-link active" href="/admin/"><span><img src="/assets/admin/img/dashboard-icon.svg"></span><span>Rapport</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                                <li
                                    class="nav-item has-elements"><a class="nav-link" href="#"><span><img src="/assets/admin/img/post-icon.svg" ></span><span>Blogs</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a>
                                    <ul
                                        class="list-unstyled">
                                        <li><a href="/admin/articles/tous" style="text-decoration: none;color: inherit;">Tous</a></li>
                                        <li><a href="/admin/articles/nouveau" style="text-decoration: none;color: inherit;">Ajouter un nouveau</a></li>
                                        <li><a href="/admin/articles/categories" style="text-decoration: none;color: inherit;">Les catégories</a></li>
                            </ul>
                            </li>
                            <li class="nav-item has-elements"><a class="nav-link" href="#"><span><img src="/assets/admin/img/product-icon.svg" ></span><span>Produits</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/admin/produit/tous" style="text-decoration: none;color: inherit;">Tous</a></li>
                                    <li><a href="/admin/produit/ajouter" style="text-decoration: none;color: inherit;">Ajouter un nouveau</a></li>
                                    <li><a href="/admin/produit/categories" style="text-decoration: none;color: inherit;">Les catégories</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/admin/medias/tous"><span><img src="/assets/admin/img/medias-icon.svg" ></span><span>Medias</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/commontaires/tous"><span><img src="/assets/admin/img/comments-icon.svg" ></span><span>Commentaires</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/messages/tous"><span><img src="/assets/admin/img/mssage-icon.svg" ></span><span>Messages</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                            <li class="nav-item"><a class="nav-link" href="/admin/commandes/tous"><span><img src="/assets/admin/img/orders-icon.svg" ></span><span>Commondes</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                            <li class="nav-item has-elements"><a class="nav-link" href="#"><span><img src="/assets/admin/img/settings-icon.svg" ></span><span>Réglages</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/admin/parametres" style="text-decoration: none;color: inherit;">Paramètres</a></li>
                                    <li><a href="/admin/parametres/bannieres" style="text-decoration: none;color: inherit;">Bannières</a></li>
                                    <li><a href="/admin/parametres/cartes" style="text-decoration: none;color: inherit;">Cartes</a></li>
                                    <li><a href="/admin/parametres/villes" style="text-decoration: none;color: inherit;">Villes</a></li>
                                    <li><a href="/admin/parametres/hf-codes" style="text-decoration: none;color: inherit;">H&amp;F Codes</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="/admin/newsletter/tous"><span><img src="/assets/admin/img/newsletter-icon.svg" ></span><span>Newsletter</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a></li>
                            <li class="nav-item has-elements"><a class="nav-link" href="#"><span><img src="/assets/admin/img/users-icon.svg" ></span><span>Utilisateurs</span><span class="dropdown-icon" style="float: right;"><img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="/admin/utilisateurs/tous" style="text-decoration: none;color: inherit;">Tous</a></li>
                                    <li><a href="/admin/utilisateurs/ajouter" style="text-decoration: none;color: inherit;">Ajouter</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="/admin/utilisateurs/deconnecter">
                                <span>
                                    <img src="/assets/admin/img/log_out-icon.svg" >
                                </span>
                                <span>Se déconnecter</span>
                                <span class="dropdown-icon" style="float: right;">
                                    <img class="dropdown-icon" src="/assets/admin/img/dropdown-icon.svg">
                                </span>
                            </a>

                            </li>
                        </ul>
                        <hr class="white-horizental-line-02">
                        <div class="advertissment" style="display: none;">
                            <small style="color:var(--color-white);">Ads:</small>
                            <div class="advertissment-place" style="margin-bottom: 35px;"></div>
                        </div>
                    </div>
                </div>
