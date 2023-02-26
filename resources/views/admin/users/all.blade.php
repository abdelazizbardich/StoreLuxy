@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Utilisateurs<br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a href="{{$options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Utilisateurs<br></li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nom d'utilisateur</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>rôle<br></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($users)
                                    @foreach($users as $user)
                                        <tr @if($user->role == 0) style="background-color: var(--color-grey);" @endif >
                                            <td>
                                                <p style="margin-bottom: 0px;">{{$user->username}}</p>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item" data-id="{{$user->id}}" ><a style="color: var(--color-blue);cursor:pointer;" href="/admin/utilisateurs/modifier/{{$user->id}}">Modifier</a></li>
                                                    @if($user->role !== 0)
                                                    @if($user->state == 0)
                                                        <li class="list-inline-item">|</li>
                                                        <li class="list-inline-item" data-id="{{$user->id}}" ><a style="color: var(--color-green);cursor:pointer;" href="/admin/utilisateurs/debloquer/{{$user->id}}">Déloquer</a></li>
                                                    @else
                                                        <li class="list-inline-item">|</li>
                                                        <li class="list-inline-item" data-id="{{$user->id}}" ><a style="color: var(--color-orenge);cursor:pointer;" href="/admin/utilisateurs/bloquer/{{$user->id}}">Bloquer</a></li>
                                                    @endif
                                                    <!-- <li class="list-inline-item">|</li>
                                                    <li class="list-inline-item" data-id="{{$user->id}}" ><a style="color: var(--color-red);cursor:pointer;" href="/admin/utilisateurs/supprimer/{{$user->id}}">Supprimer</a></li> -->
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                            @if ($user->role == 0) Administrateur general @endif
                                            @if ($user->role == 1) Administrateur @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')