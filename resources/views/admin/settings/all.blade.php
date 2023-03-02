@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Paramètres<br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blan" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Paramètres</strong></li>
                            </ul>
                        </div>
                        <div>
                            <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Modifier les paramètres</p>
                            <div class="row no-gutters" style="padding: 5px;">
                                <div class="col-md-6" style="padding: 15px;">
                                    <form action="/admin/parametres/modifier-infos-site" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nom du site:</label>
                                        <input value="{{$settings->site_name}}" name="site_name" class="form-control" type="text"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">URL de base:</label>
                                        <input class="form-control" name="site_url" value="{{$settings->site_url}}" type="text"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Description du site:</label>
                                        <textarea class="form-control" name="site_desc" style="min-height: 120px;">{{$settings->site_description}}</textarea></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Facebook messanger id:</label>
                                        <input class="form-control" name="facebook_id" value="{{$settings->facebook_id}}" type="text"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Email de newsletter:</label>
                                        <input class="form-control" name="newsletter_email" value="{{$settings->newsletter_email}}" type="text"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Frais de livraison:</label>
                                        <input class="form-control" name="shipping_cost" value="{{$settings->shipping_cost}}" type="text"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">À propos du site (page d'à proppos):</label>
                                        <textarea class="form-control summernote" name="about" style="min-height: 120px;">{{$settings->about}}</textarea></div>
                                        <div class="form-group"><button class="btn btn-primary" type="submit">Modifier</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col" style="padding: 15px;">
                                    <div class="row">
                                        <div class="col">
                                            <form action="/admin/parametres/modifier-site-logo" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group" style="position:relative;"><label style="line-height: 22px;font-size: 16px;">Logo du site:</label>
                                                <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;">
                                                        <label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Modifier une image</label>
                                                        <img class="img-fluid thumbnail-placeholder" src="{{ asset( 'storage/' . $settings->site_logo)}}">
                                                        <input type="text" name="site_logo"  required style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form action="/admin/parametres/modifier-site-icon" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group" style="position:relative;"><label style="line-height: 22px;font-size: 16px;">Icone du site:</label>
                                                <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;">
                                                        <label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Modifier une image</label>
                                                        <img class="img-fluid thumbnail-placeholder" src="{{ asset( 'storage/' . $settings->site_icon)}}">
                                                        <input type="text" name="site_icon" required style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <form action="/admin/parametres/modifier-site-social-image" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('POST')
                                                <div class="form-group" style="position:relative;"><label style="line-height: 22px;font-size: 16px;">Image pour les réseaux sociaux:</label>
                                                <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;">
                                                        <label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Modifier une image</label>
                                                        <img class="img-fluid thumbnail-placeholder" src="{{ asset( 'storage/' . $settings->site_social_img)}}">
                                                        <input type="text" name="social_image" required style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <hr style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 15px;">
                            <form action="/admin/parametres/modifier-site-social-liens" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Lien Facebook:</label>
                                        <input class="form-control" type="text" name="facebook_link" value="{{$settings->s_facebook}}"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Lien Twitter:</label>
                                        <input class="form-control" type="tex" name="twitter_link" value="{{$settings->s_twitter}}"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Lien Instagram :</label>
                                        <input class="form-control" type="text" name="instagram_link" value="{{$settings->s_instagram}}"></div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Lien Pinterest:</label>
                                        <input class="form-control" type="text" name="pinterest_link" value="{{$settings->s_pinterest}}"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                        <div>
                            <hr style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 15px;">
                            <form action="/admin/parametres/modifier-politiques" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Politique de confidentialité:</label>
                                <textarea class="form-control summernote" name="privacy" style="min-height: 450px;" >{{$settings->privacy_policies}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form  action="/admin/parametres/modifier-termes" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Les termes et les conditions:</label>
                                <textarea class="form-control summernote" name="termes" style="min-height: 450px;">{{$settings->terms_and_conditions}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                        <div>
                            <hr style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 15px;">
                            <form action="/admin/parametres/modifier-widget1" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Widget de pied de page (1):</label>
                                <textarea class="form-control" name="wiget1" style="min-height: 120px;">{{$settings->widjet_1}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form action="/admin/parametres/modifier-widget2" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Widget de pied de page (2):</label>
                                <textarea class="form-control" name="wiget2" style="min-height: 120px;">{{$settings->widjet_2}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form action="/admin/parametres/modifier-widget3" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Widget de pied de page (3):</label>
                                <textarea class="form-control" name="wiget3" style="min-height: 120px;">{{$settings->widjet_3}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                        <div class="mb-5">
                            <form action="/admin/parametres/instagram-posts" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label style="line-height: 22px;font-size: 16px;">les photos instagram:</label>
                                    <div class="form-row">
                                        <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                            <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[0])?asset('storage/'.$settings->instagramPhotos[0]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                            <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[0]->id}}" style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                            <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[1])?asset('storage/'.$settings->instagramPhotos[1]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                            <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[1]->id}}"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div><div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                            <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[2])?asset('storage/'.$settings->instagramPhotos[2]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                            <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[2]->id}}"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div><div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                            <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[3])?asset('storage/'.$settings->instagramPhotos[3]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                            <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[3]->id}}"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div><div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                            <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[4])?asset('storage/'.$settings->instagramPhotos[4]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                            <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[4]->id}}"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                            <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                <img class="img-fluid thumbnail-placeholder" src="{{($settings->instagramPhotos && @$settings->instagramPhotos[5])?asset('storage/'.$settings->instagramPhotos[5]->file):"/assets/admin/img/thumbnail.jpg"}}">
                                                <input type="text" name="instaphotos[]" value="{{@$settings->instagramPhotos[5]->id}}"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg" type="submit">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('admin.inc.footer')
