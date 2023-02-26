@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;"><strong>Utilisateurs</strong><br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blan" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Utilisateurs</li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;"><strong>Modifier</strong></li>
                            </ul>
                        </div>
                        <div>
                            <div class="row no-gutters" style="padding: 5px;">
                                <div class="col" style="padding: 15px;">
                                    <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Modifier l'utilisateur:</p>
                                    <form action="/admin/utilisateurs/modifier" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="id" value="{{$user->id}}" hidden/>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nom d'utilisateur:</label>
                                        <input class="form-control" type="text" value="{{$user->username}}" readonly=""></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Prénom:</label>
                                                <input class="form-control" name="first_name" value="{{$user->first_name}}" type="text"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nom de famille:</label>
                                                <input class="form-control" name="last_name" value="{{$user->last_name}}" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Email:</label>
                                        <input class="form-control" name="email" value="{{$user->email}}" type="email"></div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Genre:</label>
                                            <select name="gender" required class="form-control">
                                                <option value="">Aucune</option>
                                                @if($user->gender == 'male')
                                                    <option value="male" selected>Masculin</option>
                                                @else
                                                    <option value="male">Masculin</option>
                                                @endif
                                                @if($user->gender == 'female')
                                                    <option value="female" selected>Féminin</option>
                                                @else
                                                    <option value="female">Féminin</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Adresse:</label>
                                        <input class="form-control" name="adress" value="{{$user->adress}}" type="text"></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Code postal:</label>
                                                <input class="form-control" name="zip" value="{{$user->zip}}" type="text"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Âge:</label>
                                                <input class="form-control" name="age" value="{{$user->age}}" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Rôle:</label>
                                            <select name="role" class="form-control">
                                            @if($user->role == 0)
                                                <option value="0" selected disabled>Administrateur General</option>
                                            @else
                                            <option value="" disabled>Administrateur General</option>
                                            @endif
                                            @if($user->role == 1)
                                                <option value="1" selected>Administrateur</option>
                                            @else
                                                <option value="1" >Administrateur</option>
                                            @endif
                                            </select>
                                        </div>
                                        <div class="form-group" style="position:relative;">
                                        <label style="line-height: 22px;font-size: 16px;">Avatar:</label>
                                        <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                        <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);position: relative;">
                                            <img class="img-fluid thumbnail-placeholder" style="height: 100%;width: auto;margin: 0;" src="{{ asset( 'storage/' . $user->image->file)}}">
                                            <input type="text" name="avatar" value="{{$user->avatar}}" required style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                        </div>
                                        </div>
                                        <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Modifier</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6" style="padding: 15px;">
                                    <div style="margin-bottom: 35px;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-12 col-sm-12 col-lg-5 col-xl-3 text-center"><img class="user-avatar" src="{{asset('storage/'.$user->image->file)}}" style="border: 4px solid var(--color-orenge);margin-bottom: 15px;"></div>
                                            <div class="col-md-7 col-lg-8" style="padding-left: 35px;">
                                                <div><span style="font-size: 28px;line-height: 38px;text-transform: uppercase;font-weight: bold;">{{$user->username}}</span></div>
                                                <div><span style="font-size: 20px;line-height: 34px;">{{$user->email}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Prénom:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">{{$user->first_name}}</span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Nom de famille:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">{{$user->last_name}}</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Genre:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">
                                                @if($user->gender == 'male') Masculin @endif
                                                @if($user->gender == 'female') Féminin @endif
                                                </span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Âge:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">{{$user->age}}</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Code postal:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">{{$user->zip}}</span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Role::</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">
                                                @if($user->role == 0) Administrateur General  @endif
                                                @if($user->role == 1) Administrateur @endif</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Adresse:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">{{$user->adress}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 15px;">
                                    <form action="/admin/utilisateurs/modifier/mot-de-pass" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <input type="text" name="id" value="{{$user->id}}" hidden/>
                                        @if(isset($passwordError))
                                        <div class="alert alert-danger">{{$passwordError}}</div>
                                        @endif
                                        <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Ancien mot de passe:</label>
                                        <input class="form-control" required name="old_password" type="password"></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Nouveau mot de passe:</label>
                                                <input class="form-control" required name="password" type="password"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group"><label style="line-height: 22px;font-size: 16px;">Confirmez le mot de passe:</label>
                                                <input class="form-control" required name="passowrd_conf" type="password"></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Modifier</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')