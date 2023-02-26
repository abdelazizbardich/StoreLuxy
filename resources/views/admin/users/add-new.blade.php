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
                                    <form action="/admin/utilisateurs/ajouter" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        @if(isset($errors))
                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger text-left">
                                                    <ul style="margin:0px;">
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        @endif
                                        @if(isset($error))
                                            <div class="alert alert-danger">{{$error}}</div>
                                        @endif
                                        @if(isset($success))
                                            <div class="alert alert-success">{{$success}}</div>
                                        @endif
                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Nom d'utilisateur:</label>
                                        <input  name="username"  value="{{ Request::old('username') }}" class="form-control" type="text"></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Prénom:</label><input  name="first_name" value="{{ Request::old('first_name') }}" class="form-control" type="text"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Nom de famille:</label><input name="last_name" value="{{ Request::old('last_name') }}" class="form-control"  type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Email:</label><input  name="email" value="{{ Request::old('email') }}" class="form-control" type="email"></div>
                                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Genre:</label>
                                        <select name="gender" class="form-control" >
                                            <option value="">Aucune</option>
                                            <option value="male">Masculin</option>
                                            <option value="female">Féminin</option>
                                        </select>
                                        </div>
                                        <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Adresse:</label><input value="{{ Request::old('adress') }}" name="adress"  class="form-control" type="text"></div>
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Code postal:</label><input  value="{{ Request::old('zip') }}" name="zip" class="form-control" type="text"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Âge:</label><input  value="{{ Request::old('age') }}" name="age" class="form-control" type="text"></div>
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Rôle:</label>
                                        <select class="form-control" name="role" >
                                            <option value="">Aucune</option>
                                            <option value="0" >Administrateur General</option>
                                            <option value="1" >Administrateur</option>
                                        </select></div>
                                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}" style="position:relative;">
                                        <label style="line-height: 22px;font-size: 16px;">Avatar:</label>
                                        <button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: var(--red);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                        <div class="form-control thumbnail-input-holder" style="border-radius: 5px;background-color: var(--color-white);position: relative;">
                                            <img class="img-fluid thumbnail-placeholder" style="height: 100%;width: auto;margin: 0;" src="/assets/admin/img/thumbnail.jpg">
                                            <input type="text" name="avatar"  style="position: absolute;top: 0;left: 0;opacity: 1;" hidden>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6" style="padding: 15px;">
                                    <div style="margin-bottom: 35px;">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-12 col-sm-12 col-lg-5 col-xl-3 text-center"><img class="user-avatar" src="/assets/admin/img/avatar.png" style="border: 4px solid var(--color-orenge);margin-bottom: 15px;"></div>
                                            <div class="col-md-7 col-lg-8" style="padding-left: 35px;">
                                                <div><span style="font-size: 28px;line-height: 38px;text-transform: uppercase;font-weight: bold;">--------------------</span></div>
                                                <div><span style="font-size: 20px;line-height: 34px;">----------</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Prénom:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Nom de famille:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Genre:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Âge:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Code postal:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Role::</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center" style="margin-bottom: 15px;">
                                            <div class="col">
                                                <div style="background-color: var(--color-white);padding: 15px;border-bottom: 2px solid var(--color-orenge);margin: 5px;"><span style="font-size: 12px;line-height: 16px;opacity: .5;display: block;margin-bottom: 15px;">Adresse:</span><span style="font-size: 22px;line-height: 30px;display: block;color: var(--color-black);">----------</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 15px;">
                                        <div class="form-row">
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Mot de passe:</label><input  name="password" class="form-control" type="password"></div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group{{ $errors->has('password_conf') ? ' has-error' : '' }}"><label style="line-height: 22px;font-size: 16px;">Confirmez le mot de passe:</label><input class="form-control"  name="password_conf" type="password"></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><button class="btn btn-primary btn-lg" type="submit">Ajouter</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')