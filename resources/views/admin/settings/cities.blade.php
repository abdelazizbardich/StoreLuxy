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
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Cartes</strong><br></li>
                            </ul>
                        </div>
                        <div>
                            <form style="padding: 10px;border: 1px solid var(--color-orenge);margin-bottom: 15px;" action="/admin/parametres/villes/modifier" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="city-container">
                                @if(isset($cities))
                                    @foreach($cities as $city)
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre:</label>
                                                <input onkeyup="getnerateSlugname(this)" class="form-control" name="title[]" value="{{$city->name}}" type="text">
                                                <input type="hidden" name="id[]" value="{{$city->id}}" hidden />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Slug name:</label>
                                                <input class="form-control" name="sub_title[]"  type="text" value="{{$city->slug_name}}" /></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-groupstyle="position:relative;"><button onclick="removeThisRow(this)" class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button><label style="line-height: 22px;font-size: 16px;">shipping cost:</label>
                                                <input class="form-control" name="shipping_cost[]" value="{{$city->shipping_cost}}" type="text"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                </div>
                                <div class="form-group"><button style="margin-right:5px;" class="btn btn-info btn-lg append-new-city-field" type="button">Ajouter</button><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                    </div>
                    @include('admin.inc.footer')