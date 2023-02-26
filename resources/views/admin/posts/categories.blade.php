@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Categories</strong></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Posts</li>
                                <li class="list-inline-item" style="font-weight: bold;">|</li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Categories</strong></li>
                            </ul>
                        </div>
                        <div>
                            <div class="row no-gutters" style="padding: 5px;">
                                <div class="col" style="padding: 15px;">
                                    <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Ajouter une nouvelle catégorie:</p>
                                    <form action="/admin/articles/categories/ajouter" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nom:</label>
                                        <input class="form-control" type="text" name="title"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nom de la limace:</label>
                                        <input class="form-control" type="text" name="sub_title"></div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">La description:</label>
                                            <textarea class="form-control" style="min-height: 150px;" name="description"></textarea></div>
                                            
                                        <div class="form-group" style="position:relative;">
                                        <div class="thumbnail-input-holder">
                                            <label style="line-height: 22px;font-size: 16px;">Miniature:</label>
                                            <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                        <input type="text" hidden class="form-control" name="thumbnail"><img class="img-fluid thumbnail-placeholder" src="/assets/admin/img/thumbnail.jpg"></div></div>
                                        <div class="form-group"><button class="btn btn-primary btn-block btn-lg" type="submit">Ajouter une nouvelle catégorie</button></div>
                                    </form>
                                </div>
                                <div class="col-12 col-md-8" style="padding: 15px;">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th class="text-nowrap">Nom de la limace</th>
                                                    <th>La description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($categories))
                                                    @foreach($categories as $category)
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 0px;"><span style="color: var(--color-blue);">{{$category->name}}</span></p><span style="font-size: 12px;display: block;">{{$category->created_at}}</span>
                                                                <ul class="list-inline">
                                                                    <li class="list-inline-item"><a  style="color: var(--color-blue);" href="/admin/articles/categories/modifier/{{$category->id}}">Éditer</a></li>
                                                                    <li class="list-inline-item">|</li>
                                                                    <li class="list-inline-item" ><a style="color: var(--color-off-blue);" href="/blogs/{{$category->slug_name}}">Aperçu</a></li>
                                                                    <li class="list-inline-item">|</li>
                                                                    <li class="list-inline-item"><a  style="color: var(--color-red);" href="/admin/articles/categories/supprimer/{{$category->id}}">Supprimer</a></li>
                                                                </ul>
                                                            </td>
                                                            <td>{{$category->slug_name}}</td>
                                                            <td>{{$category->car_desc}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')