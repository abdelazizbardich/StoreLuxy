@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;"><img src="/assets/img/65%20(1).svg" style="position: absolute;left: 0;top: 0;width: 20%;"><img src="/assets/img/65%20(2).svg" style="position: absolute;bottom: 0;right: 0;width: 40%;">
        <div style="min-height: calc(100vh - 70px);padding-top: 35px;">
            <div class="container" style="height: 100%;">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-9">
                        <form method="POST" action="/contact">
                            @csrf
                            @method('POST')
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <h1 style="font-size: 45px;line-height: 61px;font-weight: bold;"><strong>@lang("Contactez nous")</strong></h1>

                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger text-left">
                                                    <ul style="margin:0px;">
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if(isset($success))
                                                <div class="alert alert-success text-center">
                                                    {{ $success }}
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}"><label for="fullname"><strong>@lang("Nom complet"):</strong></label>
                                    <input value="{{ Request::old('fullname') }}"  id="fullname" name="fullname" class="form-control" type="text" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;height: 60px;" placeholder="@lang("Tapez votre nom et prénom")...">
                                    @error('fullName')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"><label for="email"><strong>@lang("Adresse email"):</strong><br></label>
                                    <input value="{{ Request::old('email') }}"  id="email" name="email" class="form-control" type="email" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;height: 60px;"
                                            placeholder="@lang("Votre adresse email")..."></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}"><label for="subject"><strong>@lang("Sujet"):</strong><br></label>
                                    <select value="{{ Request::old('subject') }}"  id="subject" name="subject" class="form-control" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;height: 60px;">
                                        <option value="">@lang("Votre sujet")...</option>
                                        @foreach($subjects as $subject)
                                            <option {{ Request::old('subject') == $subject->id ? 'selected' : '' }} value="{{$subject->id}}"  >{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}"><label for="message"><strong>@lang("Message"):</strong><br></label>
                                    <textarea name="message"  id="message" class="form-control" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;min-height: 150px;"
                                            placeholder="@lang("Tapez votre message")...">{{ Request::old('message') }}</textarea></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><button class="btn btn-primary btn-block btn-lg" type="submit" style="color: rgb(0,0,0);font-size: 25px;line-height: 34px;border: none;background-color: #FFCB00;border-radius: 0px;border: 3px solid #ffffff;">@lang("Envoyez")</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('inc.footer')
