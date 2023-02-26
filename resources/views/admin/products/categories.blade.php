@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Categories</strong></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blan" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Produits</li>
                                <li class="list-inline-item" style="font-weight: bold;">|</li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Categories</strong></li>
                            </ul>
                        </div>
                        <div>
                            <div class="row no-gutters" style="padding: 5px;">
                                <div class="col" style="padding: 15px;">
                                    <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Ajouter une nouvelle catégorie:</p>
                                    <form action="/admin/produit/categories/ajouter" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Nom:</label>
                                            <input class="form-control" type="text" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Nom de la limace:</label>
                                            <input class="form-control" type="text" name="sub_title"></div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Catégorie Parentale:</label>
                                            <select name="parent" class="form-control">
                                            <option>Choisir une catégorie...</option>
                                            @if(isset($categories))
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}},category" style="font-weight: bold;">{{$category->name}}</option>
                                                            @if(isset($category->subCategory))
                                                                    @foreach($category->subCategory as $category)
                                                                        <option value="{{$category->id}},sub_category" style="font-weight: 500;">&nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
                                                                            @if(isset($category->subCategory))
                                                                                    @foreach($category->subCategory as $category)
                                                                                    <option value="{{$category->id}},sub_sub_category">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category->name}}</option>
                                                                                    @endforeach
                                                                            @endif
                                                                    @endforeach
                                                            @endif
                                                    @endforeach
                                            @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">La description:</label>
                                            <textarea name="description" class="form-control" style="min-height: 150px;"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input name="in_home" class="form-check-input" type="checkbox" id="formCheck-1">
                                                <label class="form-check-label" for="formCheck-1" style="margin-left: 15px;">Afficher dans la page d'accueil</label>
                                            </div>
                                        </div>
                                        <div class="form-group" style="position:relative;">
                                        <div class="thumbnail-input-holder">
                                            <label style="line-height: 22px;font-size: 16px;">Miniature:</label>
                                            <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                            <input type="text" hidden class="form-control" name="thumbnail">
                                            <img class="img-fluid thumbnail-placeholder" src="/assets/admin/img/thumbnail.jpg">
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block btn-lg" type="submit">Ajouter une nouvelle catégorie</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xl-8" style="padding: 15px;">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th class="text-nowrap">Nom de la limace</th>
                                                    <th class="text-nowrap">La description</th>
                                                    <th>Parents</th>
                                                    <th class="text-nowrap text-right">En accueil</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <p style="margin-bottom: 0px;"><a target="blank" href="/boutique/{{$category->slug_name}}"><span style="color: var(--color-blue);">{{$category->name}}</span></a></p><span style="font-size: 12px;display: block;">{{$category->created_at}}</span>
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item" ><a style="color: var(--color-blue);" href="/admin/produit/categories/modifier/{{$category->id}}">Éditer</a></li>
                                                                <li class="list-inline-item">|</li>
                                                                <li class="list-inline-item" ><a style="color: var(--color-off-blue);" target="_blank" href="/boutique/{{$category->slug_name}}">Aperçu</a></li>
                                                                <li class="list-inline-item">|</li>
                                                                <li class="list-inline-item" ><a style="color: var(--color-red);" href="/admin/produit/categories/supprimer/{{$category->id}}">Supprimer</a></li>
                                                            </ul>
                                                        </td>
                                                        <td>{{$category->slug_name}}</td>
                                                        <td>{{$category->car_desc}}</td>
                                                        <td>-</td>
                                                        <td class="text-right">
                                                        @if($category->in_home == 1)
                                                        <img src="/assets/admin/img/in-home.svg">
                                                        @else
                                                        <img src="/assets/admin/img/not-in-home.svg">
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <?php $parant = $category->name; $parantLink1 = $category->slug_name; ?>
                                                    @if(isset($category->subCategory))
                                                        @foreach($category->subCategory as $category)
                                                        <tr>
                                                            <td>
                                                                <p style="margin-bottom: 0px;"><a target="blank" href="/boutique/{{$parantLink1}}/{{$category->slug_name}}"><span style="color: var(--color-blue);">{{$category->name}}</span></a><span class="text-nowrap"> - Parent: <b>{{$parant}}</b></span></p><span style="font-size: 12px;display: block;">{{$category->created_at}}</span>
                                                                <ul class="list-inline">
                                                                    <li class="list-inline-item" ><a style="color: var(--color-blue);" href="/admin/produit/categories/modifier/{{$category->id}}">Éditer</a></li>
                                                                    <li class="list-inline-item">|</li>
                                                                    <li class="list-inline-item" ><a style="color: var(--color-off-blue);" target="_blank" href="/boutique/{{$category->slug_name}}">Aperçu</a></li>
                                                                    <li class="list-inline-item">|</li>
                                                                    <li class="list-inline-item" ><a style="color: var(--color-red);" href="/admin/produit/categories/supprimer/{{$category->id}}">Supprimer</a></li>
                                                                </ul>
                                                            </td>
                                                            <td>{{$category->slug_name}}</td>
                                                            <td>{{$category->car_desc}}</td>
                                                            <td><a href="/boutique/{{$parantLink1}}">{{$parant}}</a><br></td>
                                                            <td class="text-right">
                                                            @if($category->in_home == 1)
                                                            <img src="/assets/admin/img/in-home.svg">
                                                            @else
                                                            <img src="/assets/admin/img/not-in-home.svg">
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        <?php $parant = $category->name; $parantLink2 = $category->slug_name; ?>
                                                        @if(isset($category->subCategory))
                                                            @foreach($category->subCategory as $category)
                                                                <tr>
                                                                    <td>
                                                                        <p style="margin-bottom: 0px;"><a target="blank" href="/boutique/{{$parantLink1}}/{{$parantLink2}}/{{$category->slug_name}}"><span style="color: var(--color-blue);">{{$category->name}}</span></a><span class="text-nowrap"> - Parent: <b>{{$parant}}</b></span></p><span style="font-size: 12px;display: block;">{{$category->created_at}}</span>
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item" ><a style="color: var(--color-blue);" href="/admin/produit/categories/modifier/{{$category->id}}">Éditer</a></li>
                                                                            <li class="list-inline-item">|</li>
                                                                            <li class="list-inline-item" ><a style="color: var(--color-off-blue);" target="_blank" href="/boutique/{{$category->slug_name}}">Aperçu</a></li>
                                                                            <li class="list-inline-item">|</li>
                                                                            <li class="list-inline-item" ><a style="color: var(--color-red);" href="/admin/produit/categories/supprimer/{{$category->id}}">Supprimer</a></li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>{{$category->slug_name}}</td>
                                                                    <td>{{$category->car_desc}}</td>
                                                                    <td><a href="/boutique/{{$parantLink1}}/{{$parantLink2}}">{{$parant}}</a><br></td>
                                                                    <td class="text-right">
                                                                    @if($category->in_home == 1)
                                                                    <img src="/assets/admin/img/in-home.svg">
                                                                    @else
                                                                    <img src="/assets/admin/img/not-in-home.svg">
                                                                    @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        @endforeach
                                                    @endif
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