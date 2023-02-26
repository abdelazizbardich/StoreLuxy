@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Medias</strong><br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Medias</strong></li>
                                <li class="list-inline-item" style="font-weight: bold;"><button class="btn btn-primary btn-sm" id="show-upload-form" type="button">Ajouter</button></li>
                            </ul>
                        </div>
                        <div style="margin-bottom: 35px;">
                        </div>
                        <div id="upload-file">
                            <form class="uploadMedias" action="/admin/medias/ajouter" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group text-center">
                                    <p style="font-size: 19px;line-height: 26px;">Déposer des fichiers à télécharger<br>ou</p>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary fileSelect" type="button" style="font-size: 19px;">Sélectionnez les fichiers</button>
                                    <input type="file" class="filesInput" multiple="" name="files[]" style="font-size: 19px;"  hidden />
                                </div>
                                <div class="form-group text-center">
                                    <p class="text-info" style="font-size: 14px;line-height: 26px;">Taille maximale du fichier de téléchargement: 80 Mo.</p>
                                </div>
                            </form>
                            <button class="btn btn-primary close" type="button" style="top: 5px;right: 5px;position: absolute;color: rgb(0,0,0);background: none;box-shadow: none;"><i class="fa fa-close"></i></button></div>
                        <div id="media-grid" style="max-height: 90vh;overflow-y: auto;">
                            <ul class="list-inline">
                                @if($medias)
                                @foreach($medias as $media)
                                <li class="list-inline-item">
                                    <div class="media-grid-thumbnail"><img title="{{$media->name}}" alt="{{$media->alt_title}}" description="{{$media->file_desc}}" data-type="{{$media->type}}" data-id="{{$media->id}}" data-time="{{$media->created_at}}"  class="img-fluid" src="{{ asset('storage/' . $media->file) }}" ></div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    @include('admin.inc.footer')