@include('inc.header')
    <main style="position: relative;overflow: hidden;"><img src="/assets/img/Intersection%2010.svg" style="position: absolute;left: 0;top: 0;width: 10%;">
        <div>
            <form action="/finalisation-de-commande" method="POST">
                @csrf
                @method('POST')
                <div class="container-fluid">
                    <div class="row align-items-stretch" style="min-height: calc(105vh);">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8" style="padding: 5% 10%;">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger text-left">
                                <ul style="margin:0px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div style="margin-bottom: 15px;height: 70vh;overflow-y: auto;">
                            <div class="row no-gutters">
                            @if($carProducts != null)
                                @foreach($carProducts as $Product)
                                    <div class="col-6 col-lg-4 col-xl-3 text-center carte-product fixed-carte-product" style="padding: 10px;margin-bottom: 15px;">
                                    <input type="text" name="product_id[]" value="{{$Product->Product->id}}" hidden />
                                        <div style="position: relative;padding: 2px;"><img style="width: 100%;margin-bottom: 5px;" src="{{asset('storage/' . $Product->Thumbnail->file)}}" />
                                            <p style="font-size: 14px;line-height: 19px;margin-bottom: 5px;width: 100%;">{{$Product->Product->name}}</p>
                                            <p style="width: 100%;font-size: 14px;line-height: 19px;margin-bottom: 0;color: #ff0000;"><strong>@lang("Prix"): <span class="product-price">{{$Product->Product->price}}</span> @lang("Dh")</strong><br /></p>
                                            <div class="input-group qte_input" style="width: fit-content;margin: auto;">
                                                <div class="input-group-prepend">
                                                <button class="btn btn-primary minus" type="button" style="color: #000000;font-size: 14px;line-height: 19px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;background: none;">-</button>
                                                </div><input readonly data-max="{{$Product->Product->stock_amount}}" name="product_qte[]" value="1" class="form-control"
                                                    type="text" style="height: 40px;max-width: 60px;border: none;text-align: center;font-size: 14px;line-height: 19px;font-weight: 100;background-color: transparent;padding: 0px;" inputmode="numeric"/>
                                                <div class="input-group-append">
                                                <button class="btn btn-primary text-center plus" type="button" style="color: #000000;font-size: 14px;line-height: 19px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;background: none;">+</button></div>
                                            </div>
                                            <p style="width: 100%;font-size: 14px;line-height: 19px;margin-bottom: 0;color: #ff0000;"><strong>@lang("Prix total"): <span class="total-product-price cart-total-product-price">{{$Product->Product->price}}</span> @lang("Dh")</strong><br /></p><button onclick="removeFromCarte(this)" data-id="{{$Product->Product->id}}" class="btn btn-primary shadow-sm" type="button" style="border: none;color: #ff0000;box-shadow: none;position: absolute;top: -10px;right: -10px;background-color: rgb(255,255,255);border-radius: 50px;border: 2px solid rgb(255,223,0);width: 20px;height: 20px;font-size: 12px;text-align: center;padding: 0px;"><i class="fa fa-close" style="display: block;"></i></button></div>
                                    </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                            <div>
                                <label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;display: block;">@lang("Ajouter une note"):</label>
                                <input value="{{ Request::old('note') }}" type="text" name="note" style="height: 45px;width: 80%;border-radius: 50px;border: 2px solid rgb(255,230,0);background-color: #F5F5F5;padding-left: 22px;font-size: 12px;line-height: 16px;"placeholder="Quelques mots à l'équipe interne...">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4" style="background-color: #FFE600;position: relative;padding-right: 0;">
                            <div style="margin-top: 12vh;margin-right: 15%;margin-bottom: 12vh;position: relative;z-index: 1;">
                                <p style="font-size: 36px;line-height: 49px;border-bottom: 3px solid #ffffff;margin-bottom: 35px;">@lang("Mon Panier")</p>
                                <div style="margin-right: 15%;">
                                    <p style="font-size: 16px;line-height: 20px;">@lang("Frais de livraison et taxes calculés au moment de la finalisation de la commande").</p>
                                    <div>
                                        <div class="form-group {{ $errors->has('termes_check') ? ' has-error' : '' }}">
                                            <input class="form-check-input" name="termes_check" type="checkbox" id="termes_check">
                                            <label class="form-check-label" for="termes_check">@lang("J'accepte")&nbsp;<a href="#" style="font-weight: bold;">@lang("les termes et conditions")</a></label>
                                        </div>
                                    </div><button class="btn btn-primary" type="submit" style="font-size: 18px;line-height: 24px;padding: 15px 25px;border-radius: 50px;font-weight: 100;margin-top: 15px;">@lang("finaliser la commande")</button></div>
                            </div><img src="/assets/img/Intersection%209.svg" style="max-width: 90%;max-height: 35%;position: absolute;bottom: 0;right: 0;"></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    @include('inc.footer')
