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
                            <form style="padding: 10px;border: 1px solid var(--color-orenge);margin-bottom: 15px;" action="/admin/parametres/cartes/modifier" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                @if(isset($cards))
                                    @foreach($cards as $card)
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre:</label>
                                                <input class="form-control" name="label[]" value="{{$card->label}}" type="text">
                                                <input type="hidden" name="id[]" value="{{$card->id}}" hidden />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Text:</label>
                                                <textarea class="form-control" name="title[]"  type="text">{{$card->title}}</textarea></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Lien:</label>
                                                <input class="form-control" name="link[]" value="{{$card->link}}" type="text"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group" style="position:relative;">
                                                <label style="line-height: 22px;font-size: 16px;">Image:</label>
                                                <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                                <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);position: relative;">
                                                        <img class="img-fluid thumbnail-placeholder" style="height: 100%;width: auto;margin: 0;" src="{{ asset( 'storage/' . $card->Thumbnail->file)}}">
                                                        <input type="text" name="thumbnail[]" value="{{$card->thumbnail}}" required style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                    </div>
                    @include('admin.inc.footer')