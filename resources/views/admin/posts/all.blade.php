@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Posts</span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Posts</li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Titre</th>
                                            <th>Auteur</th>
                                            <th>Catégories</th>
                                            <th>Mots clés</th>
                                            <th class="text-right"><img src="/assets/admin/img/comment-alt.svg"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($posts)
                                            @foreach($posts as $post)
                                                <tr>
                                                    <td>
                                                        <p style="margin-bottom: 0px;"><a target="_blank" href="/article/{{$post->slug_name}}" style="color: var(--color-blue);">{{$post->name}}</a>
                                                        @if($post->state == 'draft')
                                                        &nbsp;-&nbsp;<span style="font-weight: bold;">Brouillon</span>
                                                        @endif
                                                        </p><span style="font-size: 12px;display: block;">{{$post->created_at}}</span>
                                                        <ul
                                                            class="list-inline">
                                                            <li class="list-inline-item" data-id="{{$post->id}}" style="color: var(--color-blue); cursor:pointer;"><a href="/admin/article/modifier/{{$post->id}}">Éditer</a></li>
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$post->id}}" ><a target="_blank" href="/article/{{$post->slug_name}}" style="color: var(--color-off-blue); cursor:pointer;">Aperçu</a></li>
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$post->id}}" ><a style="color: var(--color-red); cursor:pointer;" href="/admin/article/supprimer/{{$post->id}}">Supprimer </a></li>
                                                            @if($post->state == 'draft')
                                                                <li class="list-inline-item">|</li>
                                                                <li class="list-inline-item" data-id="{{$post->id}}" ><a style="color: var(--color-green); cursor:pointer;" href="/admin/article/etat/publier/{{$post->id}}">Publier </a></li>
                                                            @elseif($post->state == 'published')
                                                                <li class="list-inline-item">|</li>
                                                                <li class="list-inline-item" data-id="{{$post->id}}" ><a href="/admin/article/passer-au-brouillon/{{$post->id}}" style="color: var(--color-dark-orenge); cursor:pointer;">Passer au brouillon</a></li>
                                                            @endif
                                                            </ul>
                                                    </td>
                                                    <td>{{$post->author}}</td>
                                                    <td>
                                                    @foreach($post->categories as $category)
                                                    @if(isset($category))
                                                        <a target="_blank" href="/blogs/{{$category->slug_name}}">{{$category->name}}</a>&nbsp;&nbsp;
                                                    @endif
                                                    @endforeach
                                                    </td>
                                                    <td>{{$post->tags}}</td>
                                                    <td class="text-right">{{$post->commentsCount}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')