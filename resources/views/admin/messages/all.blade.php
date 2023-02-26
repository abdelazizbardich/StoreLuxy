@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Les messages<br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Les messages<br></li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom complet</th>
                                            <th>E-mail</th>
                                            <th>Objet</th>
                                            <th>Message<br></th>
                                            <th>Etat</th>
                                            <th>Soumis le</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($messages)
                                            @foreach($messages as $message)
                                            <tr>
                                                <td class="text-nowrap">{{$message->full_name}}</td>
                                                <td>{{$message->email}}</td>
                                                <td class="text-nowrap">{{$message->subject}}</td>
                                                <td>
                                                    <p style="margin-bottom: 0px;">{{$message->message}}</p>
                                                    <ul class="list-inline">
                                                        @if($message->state == 'unread')
                                                            <li class="list-inline-item" data-id="{{$message->id}}" ><a href="/admin/messages/marquer-comme-lu/{{$message->id}}" style="color: var(--color-green);cursor:pointer;">Marquer comme lu</a></li>
                                                        @else
                                                            <li class="list-inline-item" data-id="{{$message->id}}" ><a href="/admin/messages/marquer-comme-non-lu/{{$message->id}}" style="color: var(--color-orenge);cursor:pointer;">Marquer comme non lu</a></li>
                                                        @endif
                                                        <li class="list-inline-item">|</li>
                                                        <li class="list-inline-item" data-id="{{$message->id}}" ><a href="mailto:{{$message->email}}" style="color: var(--color-blue);cursor:pointer;">Répondre </a></li>
                                                        <li class="list-inline-item">|</li>
                                                        <li class="list-inline-item" data-id="{{$message->id}}" ><a href="/admin/messages/supprimer/{{$message->id}}" style="color: var(--color-red);cursor:pointer;">Supprimer </a></li>
                                                    </ul>
                                                </td>
                                                <td class="text-nowrap">
                                                @if($message->state == 'unread')
                                                    <span style="color: var(--color-red);">Non lu</span>
                                                @else
                                                    <span style="color: var(--color-green);">Lu</span>
                                                @endif
                                                </td>
                                                <td class="text-nowrap">{{$message->created_at}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')