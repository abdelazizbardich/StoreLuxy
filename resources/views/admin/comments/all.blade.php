@include('/admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Les commentaires</strong></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{$options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="{{$options->SiteOptions->site_url}}/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Les commentaires</strong></li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Auteur</th>
                                            <th>Commentaire<br></th>
                                            <th>en réponse à</th>
                                            <th>Soumis le</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($comments)
                                        @foreach($comments as $comment)
                                            <tr>
                                                <td class="text-nowrap">{{$comment->name}}</td>
                                                <td>
                                                    <p style="margin-bottom: 0px;">{{$comment->comment}}</p>
                                                    <ul class="list-inline">
                                                        @if($comment->state == 'pending')
                                                            <li class="list-inline-item" data-id="{{$comment->id}}"><a style="color: var(--color-green); cursor:pointer;" href="/admin/commontaires/approver/{{$comment->id}}">Approuver </a></li>
                                                            <li class="list-inline-item">|</li>
                                                        @else
                                                            <li class="list-inline-item" data-id="{{$comment->id}}"><a style="color: var(--color-orenge); cursor:pointer;" href="/admin/commontaires/disapprover/{{$comment->id}}">Désapprouver </a></li>
                                                            <li class="list-inline-item">|</li>
                                                        
                                                        @endif
                                                        
                                                        <li class="list-inline-item" data-id="{{$comment->id}}" ><a href="/admin/commontaires/supprimer/{{$comment->id}}"" style="color: var(--color-red); cursor:pointer;">Supprimer </a></li>
                                                    </ul>
                                                </td>
                                                <td><a target="_blank" href="/article/{{$comment->post->slug_name}}" style="color: var(--color-blue);">{{$comment->post->name}}</a></td>
                                                <td class="text-nowrap">{{$comment->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')