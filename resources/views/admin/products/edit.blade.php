@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Les produits<br></span>
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
                                <li class="list-inline-item" style="font-weight: bold;">Ajouter</li>
                            </ul>
                        </div>
                        <div>
                            <form action="/admin/produit/modifier" method="POST" enctype="multipart/form-data">
                            @csrf
                                @method('POST')
                                <input type="text" name="id" value="{{$product->id}}" hidden>
                                <div class="form-row no-gutters" style="padding: 5px;">
                                    <div class="col" style="padding: 15px;">
                                        <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Ajouter un produit</p>
                                        <div class="form-row">
                                            <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre:</label>
                                                <input class="form-control" value="{{$product->name}}" type="text" name="title"  id="title"></div>
                                            </div>
                                            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Prix normal:</label>
                                                <input class="form-control" value="{{$product->old_price}}" name="old_price" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-sm-9 col-md-9">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre de la limace:</label>
                                                <input class="form-control" value="{{$product->slug_name}}" type="text" name="sub_title"  id="sub-title"></div>
                                            </div>
                                            <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Prix remise:</label>
                                                <input class="form-control" value="{{$product->price}}" name="prix" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Description:</label>
                                        <textarea class="form-control summernote" name="long_dec" style="min-height: 74vh;">{{$product->long_desc}}</textarea>
                                        </div>
                                        <div class="form-row">
                                        <div class="col">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Fin de la promotion:</label>
                                                    <div class="input-group date form_datetime" data-date="2020-05-30 15:01:31" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="dtp_input1">
                                                        <input class="form-control" size="16" value="{{$product->sall_end}}" name="promo_end" type="text" readonly>
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Frais de tax:</label>
                                                <input class="form-control" value="{{$product->tax}}" name="tax" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Taille du stock:</label>
                                                <input class="form-control" value="{{$product->stock_size}}" name="stock_size" type="text"></div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">En stock:</label>
                                                <input class="form-control" value="{{$product->stock_amount}}" name="in_stock" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <div class="form-check" style="margin-bottom: 8px;">
                                                    <input @if($product->in_slider == 1) checked="true" @endif class="form-check-input" name="in_slider" type="checkbox" id="formCheck-1"><label class="form-check-label" for="formCheck-1" style="margin-left: 15px;font-size: 12px;line-height: 16px;">Afficher dans le slider</label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <div class="form-check" style="margin-bottom: 8px;">
                                                    <input @if($product->is_trend == 1) checked="true" @endif class="form-check-input" name="is_trend" type="checkbox" id="formCheck-2"><label class="form-check-label" for="formCheck-2" style="margin-left: 15px;font-size: 12px;line-height: 16px;">Définir comme tendance</label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <div class="form-check" style="margin-bottom: 8px;">
                                                    <input @if($product->is_best_saller == 1) checked="true" @endif class="form-check-input" name="is_best_saller" type="checkbox" id="formCheck-3"><label class="form-check-label" for="formCheck-3" style="margin-left: 15px;font-size: 12px;line-height: 16px;">Définir comme meilleur vendeur</label></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <div class="form-check" style="margin-bottom: 8px;">
                                                    <input @if($product->sponsored == 1) checked="true" @endif class="form-check-input" name="sponsored" type="checkbox" id="formCheck-4"><label class="form-check-label" for="formCheck-4" style="margin-left: 15px;font-size: 12px;line-height: 16px;">Définir comme sponsorisé</label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Brève description:</label>
                                        <textarea class="form-control" name="short_desc" style="min-height: 150px;">{{$product->short_desc}}</textarea></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Plus de photos:</label>
                                            <div class="form-row">
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[0])){{asset('storage/'.$product->gallery[0]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[0])) value="{{$product->gallery[0]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[1])){{asset('storage/'.$product->gallery[1]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[1])) value="{{$product->gallery[1]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[2])){{asset('storage/'.$product->gallery[2]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[2])) value="{{$product->gallery[2]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[3])){{asset('storage/'.$product->gallery[3]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[3])) value="{{$product->gallery[3]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[4])){{asset('storage/'.$product->gallery[4]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[4])) value="{{$product->gallery[4]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[5])){{asset('storage/'.$product->gallery[5]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[5])) value="{{$product->gallery[5]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[6])){{asset('storage/'.$product->gallery[6]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[6])) value="{{$product->gallery[6]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[7])){{asset('storage/'.$product->gallery[7]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[7])) value="{{$product->gallery[7]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[8])){{asset('storage/'.$product->gallery[8]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[8])) value="{{$product->gallery[8]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[9])){{asset('storage/'.$product->gallery[9]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[9])) value="{{$product->gallery[9]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[10])){{asset('storage/'.$product->gallery[10]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[10])) value="{{$product->gallery[10]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-4 col-sm-2" style="position:relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 4%;position: absolute;color: var(--red);background: none;box-shadow: none;z-index: 1;font-size: initial;"><i class="fa fa-close"></i></button>
                                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;margin-bottom: 15px;">
                                                    <img class="img-fluid thumbnail-placeholder" src="@if(isset($product->gallery[11])){{asset('storage/'.$product->gallery[11]->file)}}@else /assets/admin/img/thumbnail.jpg @endif">
                                                    <input type="text" name="photos[]" @if(isset($product->gallery[11])) value="{{$product->gallery[11]->id}}" @endif  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4" style="padding: 15px;">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><button class="btn btn-dark btn-block" name="save" value="save"  type="submit">Enregistrer</button></div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group"><button class="btn btn-success btn-block" name="publish" value="publish"  type="submit">Publier</button></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Type:</label>
                                        <select name="type" class="form-control">
                                            <option value="product">Produit</option>
                                        </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Les mots clés::</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="tag-input">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" type="button" id="tag-add-btn">Ajouter</button>
                                                </div>
                                            </div>
                                            <div class="form-control " id="tags-holder" style="min-height:100px;margin-top: 10px;border-radius: 5px;background-color: var(--color-off-white);">@if($product->tags)<?php $x = count($product->tagsObjects);  $i = 1; ?>@foreach($product->tagsObjects as $tag)
                                                    <a ondblclick="removeThisTag(this)" data-tag="{{$tag}}@if($i < $x), @endif" data-toggle="tooltip" data-placement="top" title="Double click pour supprimer" style="color:var(--color-blue);cursor:pointer;">@if($i !==1 &&$i < $x)<span style="color:black">, </span>@endif{{$tag}}</a><?php $i++ ?>@endforeach @endif</div>

                                            <textarea name="tags" id="tags" hidden>{{ $product->tags }}</textarea>
                                            </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Catégorie:</label>
                                            <div class="form-control" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;">
                                                @if(isset($categories))
                                                <ul style="list-style: none;">
                                                    @foreach($categories as $category)
                                                        <li>
                                                            <div class="form-check" style="margin-bottom: 8px;">
                                                            @if(in_array($category->id,explode(',',$product->categorys_ids)))
                                                                                                <?php $state = 'checked'; ?>
                                                                                            @else
                                                                                                <?php $state = ''; ?>
                                                                                            @endif
                                                                <input {{$state}}  name="categories[]" value="{{$category->id}}" class="form-check-input" type="checkbox" id="cat-{{$category->id}}">
                                                                <label class="form-check-label {{$state}}" for="cat-{{$category->id}}" style="margin-left: 15px;">{{$category->name}}</label>
                                                            </div>
                                                            @if(isset($category->subCategory))
                                                                <ul style="list-style: none;">
                                                                    @foreach($category->subCategory as $category)
                                                                        <li>
                                                                            <div class="form-check" style="margin-bottom: 8px;">
                                                                            @if(in_array($category->id,explode(',',$product->categorys_ids)))
                                                                                                <?php $state = 'checked'; ?>
                                                                                            @else
                                                                                                <?php $state = ''; ?>
                                                                                            @endif
                                                                                <input {{$state}}  name="categories[]" value="{{$category->id}}" class="form-check-input" type="checkbox" id="cat-{{$category->id}}">
                                                                                <label class="form-check-label {{$state}}" for="cat-{{$category->id}}" style="margin-left: 15px;">{{$category->name}}</label>
                                                                            </div>
                                                                            @if(isset($category->subCategory))
                                                                                <ul style="list-style: none;">
                                                                                    @foreach($category->subCategory as $category)
                                                                                        <li>
                                                                                            <div class="form-check" style="margin-bottom: 8px;">
                                                                                            @if(in_array($category->id,explode(',',$product->categorys_ids)))
                                                                                                <?php $state = 'checked'; ?>
                                                                                            @else
                                                                                                <?php $state = ''; ?>
                                                                                            @endif
                                                                                                <input {{$state}}  name="categories[]" value="{{$category->id}}" class="form-check-input" type="checkbox" id="cat-{{$category->id}}">
                                                                                                <label class="form-check-label {{$state}}" for="cat-{{$category->id}}" style="margin-left: 15px;">{{$category->name}}</label>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group" style="position: relative;"><label style="line-height: 22px;font-size: 16px;">Miniature:</label>
                                    
                                    <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;">
                                        <label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Définir l'image de miniature</label>
                                        <img class="img-fluid thumbnail-placeholder" src="{{asset('storage/'.$product->thumbnail->file)}}">
                                        <input type="text" name="thumbnail" value="{{$product->thumbnail->id}}" hidden style="position: absolute;top: 0;left: 0;opacity: 1;" >
                                    </div>

                                    </div>
                                    <div class="form-group" style="position: relative;"><label style="line-height: 22px;font-size: 16px;">Miniature pour slider (png):</label>
                                    <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                    <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;">
                                        <label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Définir l'image de miniature</label>
                                        <img class="img-fluid thumbnail-placeholder" data-placeholder="/assets/admin/img/thumbnail.jpg" src="@if(isset($product->sliderThumbnail)) {{asset('storage/'.$product->sliderThumbnail->file)}} @else  /assets/admin/img/thumbnail.jpg  @endif">
                                        <input type="text" name="slider_thumbnail" value="@if(isset($product->sliderThumbnail)) {{$product->sliderThumbnail->id}} @endif" hidden style="position: absolute;top: 0;left: 0;opacity: 1;" >
                                    </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                    @include('admin.inc.footer')