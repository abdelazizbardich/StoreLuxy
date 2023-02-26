@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Modifier l'article</strong></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Articles</li>
                                <li class="list-inline-item" style="font-weight: bold;">|</li>
                                <li class="list-inline-item" style="font-weight: bold;">Modifier</li>
                            </ul>
                        </div>
                        <div>
                            <form action="/admin/articles/modifier" method="POST" enctype="multipart/form-data">
                            @csrf
                                @method('POST')
                            <input type="text" name="id" value="{{$post->id}}" hidden/>
                                <div class="form-row no-gutters" style="padding: 5px;">
                                    <div class="col" style="padding: 15px;">
                                        <p style="font-size: 20px;line-height: 27px;font-weight: bold;"><strong>Modifier l'article:</strong></p>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Titre:</label>
                                        <input class="form-control" type="text" name="title" value="{{$post->name}}" id="title"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Alternative titre:</label>
                                        <input class="form-control" type="text" name="sub_title" value="{{$post->slug_name}}" id="sub-title"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Le contenu:</label>
                                        <textarea class="form-control summernote" name="content" id="sub-title">{!! $post->content !!}</textarea></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Vues:</label>
                                                <input class="form-control" type="text" name="views" value="{{$post->views}}"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Partages:</label>
                                                <input class="form-control" type="text" name="shares" value="{{$post->shares}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3" style="padding: 15px;">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><button class="btn btn-dark btn-block" name="save" value="save" type="submit">Enregistrer</button></div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group"><button class="btn btn-success btn-block" name="publish"value="publish" type="submit">Publier</button></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Type:</label>
                                        <select class="form-control" name="type"><option value="post">Artilce</option>
                                        </select></div>
                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Les mots clés:</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="tag-input">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" type="button" id="tag-add-btn">Ajouter</button>
                                                </div>
                                            </div>
                                            <div class="form-control " id="tags-holder" style="min-height:100px;margin-top: 10px;border-radius: 5px;background-color: var(--color-off-white);">@if($post->tags)<?php $x = count($post->tagsObjects);  $i = 1; ?>@foreach($post->tagsObjects as $tag)
                                                    <a ondblclick="removeThisTag(this)" data-tag="{{$tag}}@if($i < $x), @endif" data-toggle="tooltip" data-placement="top" title="Double click pour supprimer" style="color:var(--color-blue);cursor:pointer;">@if($i !==1 &&$i < $x)<span style="color:black">, </span>@endif{{$tag}}</a><?php $i++ ?>@endforeach @endif</div>

                                            <textarea name="tags" id="tags" hidden>{{ $post->tags }}</textarea>
                                            </div>

                                        <div class="form-group">
                                            <label style="line-height: 22px;font-size: 16px;">Catégorie:</label>
                                            <div class="form-control" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;">
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    @if(in_array($category->id,explode(',',$post->categorys)))
                                                        <?php $state = 'checked'; ?>
                                                    @else
                                                        <?php $state = ''; ?>
                                                    @endif
                                                    <div class="form-check" style="margin-bottom: 8px;">
                                                    <input {{$state}}  name="categories[]" value="{{$category->id}}" class="form-check-input" type="checkbox" id="cat-{{$category->id}}">
                                                    <label class="form-check-label {{$state}}" for="cat-{{$category->id}}" style="margin-left: 15px;">{{$category->name}}</label>
                                                </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                    <div class="form-group" style="position:relative;"><label style="line-height: 22px;font-size: 16px;">Miniature:</label>                                    
                                    <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                        <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);padding: 15px;height: auto;position: relative;"><label style="cursor:pointer;color: var(--color-blue);font-size: 12px;line-height: 16px;">Modifier la miniature</label><img class="img-fluid thumbnail-placeholder" src="{{asset('storage/' . $thumbnail->file)}}">
                                        <input type="text" name="thumbnail" value="{{$thumbnail->id}}" style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
                    @include('admin.inc.footer')