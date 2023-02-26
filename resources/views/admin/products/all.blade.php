@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Les produits</span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Les produits</li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>SKU</th>
                                            <th>Stock</th>
                                            <th>Prix</th>
                                            <th>Catégories</th>
                                            <th>Mots clés</th>
                                            <th>Étoiles</th>
                                            <th>Publié le</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($products)
                                            @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <p style="margin-bottom: 0px;">
                                                            <span style="color: var(--color-blue);">
                                                                <a target="_blank" href="/produit/{{$product->slug_name}}">{{$product->name}}</a>
                                                            </span>
                                                            @if($product->state == 0)
                                                                &nbsp;-&nbsp;<span style="font-weight: bold;">Brouillon</span>
                                                            @endif
                                                        </p>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item" data-id="{{$product->id}}" ><a style="color: var(--color-blue);cursor:pointer;" href="/admin/produit/modifier/{{$product->id}}">Éditer</a></li>
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$product->id}}" ><a style="color: var(--color-off-blue);cursor:pointer;" href="/produit/{{$product->slug_name}}" target="_blank">Aperçu</a></li>
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$product->id}}"><a style="color: var(--color-red);cursor:pointer;" href="/admin/produit/supprimer/{{$product->id}}">Supprimer </a></li>
                                                            @if($product->state == 0)
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$product->id}}"><a style="color: var(--color-green);cursor:pointer;" href="/admin/produit/publier/{{$product->id}}">Publier </a></li>
                                                            @elseif($product->state == 1)
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$product->id}}"><a style="color: var(--color-dark-orenge);cursor:pointer;" href="/admin/produit/passer-au-brouillon/{{$product->id}}">Annuler la publication</a></li>
                                                            @endif
                                                        </ul>
                                                    </td>
                                                    <td class="text-nowrap">{{$product->sku}}</td>
                                                    <td class="text-nowrap">
                                                    @if($product->stock_amount > 0)
                                                    <span style="color: var(--color-green);">En stock ({{$product->stock_amount}})</span>
                                                    @else
                                                    <span style="color: var(--color-red);">Stock terminé ({{$product->stock_amount}})</span>
                                                    @endif
                                                    </td>
                                                    <td class="text-nowrap"><span style="text-decoration: line-through;">{{$product->old_price}} Dh</span><br>{{$product->price}} Dh</td>
                                                    <td>
                                                    @foreach($product->categories as $category)
                                                        <a target="_blank" href="/boutique/{{$category->slug_name}}">{{$category->name}}</a>, 
                                                    @endforeach
                                                    </td>
                                                    <td>{{$product->tags}}</td>
                                                    <td>
                                                        <ul class="list-inline text-nowrap" style="margin: 0;">
                                                            @for($i=0;$i<intval($product->starsAvrage);$i++)
                                                            <li class="list-inline-item" style="margin-right: 4px;"><img src="/assets/admin/img/star-full.png"></li>
                                                            @endfor
                                                            @for($i=0;$i<(5 - intval($product->starsAvrage));$i++)
                                                            <li class="list-inline-item" style="margin-right: 4px;"><img src="/assets/admin/img/star-empty.png"></li>
                                                            @endfor
                                                        </ul>
                                                    </td>
                                                    <td class="text-nowrap">{{$product->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')