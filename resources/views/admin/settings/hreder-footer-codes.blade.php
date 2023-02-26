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
                            <p style="font-size: 20px;line-height: 27px;font-weight: bold;"><strong>Codes d'en-tête et de pied de page:</strong></p>
                        </div>
                        <div>
                            <form action="/admin/parametres/hf-codes/modifier/Codes-en-tete" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Codes d'en-tête (head):</label><textarea class="form-control" style="min-height: 450px;" name="code">{{$codes->header}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form action="/admin/parametres/hf-codes/modifier/avant-body" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Codes daprès l'ouverture de la balise (body):</label><textarea class="form-control" style="min-height: 450px;" name="code">{{$codes->beforeBody}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form action="/admin/parametres/hf-codes/modifier/Codes-de-pied" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Codes de pied (footer):</label><textarea class="form-control" style="min-height: 450px;" name="code">{{$codes->footer}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                            <form action="/admin/parametres/hf-codes/modifier/apres-body" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">après la fermeture de la balise (body):</label><textarea class="form-control" style="min-height: 450px;" name="code">{{$codes->afterBody}}</textarea></div>
                                <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Enregistrer</button></div>
                            </form>
                        </div>
                    </div>
                    @include('admin.inc.footer')