@include('inc.header')
<main style="position: relative;overflow: hidden;"><img src="/assets/img/Intersection 10.svg" style="position: absolute;left: 0;top: 0;width: 10%;" />
    <div>
        <div class="container-fluid">
            <form  method="POST" action="/commande-confirmée">
            @csrf
            @method('POST')
                <div class="row align-items-stretch" style="min-height: calc(105vh);">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="padding: 5%;padding-top: 12vh;">
                        <div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 18px;line-height: 24px;text-transform: uppercase;"><strong>@lang("Produit")</strong></th>
                                            <th style="font-size: 18px;line-height: 24px;text-transform: uppercase;"><strong>@lang("Prix")</strong></th>
                                            <th style="font-size: 18px;line-height: 24px;text-transform: uppercase;"><strong>@lang("Qté")</strong></th>
                                            <th style="font-size: 18px;line-height: 24px;text-transform: uppercase;"><strong>@lang("Total")</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart-row">
                                            <td style="vertical-align: middle;text-align: center;"><img style="max-width: 150px;margin-bottom: 5px;" src="{{asset('storage/' . $Product->Thumbnail->file)}}" />
                                            <input type="text" name="id" value="{{$Product->Product->id}}" hidden>
                                                <p style="font-size: 14px;line-height: 19px;margin-bottom: 5px;">{{$Product->Product->name}}</p>
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;"><strong style="color: #ff0000;"><span class="product-price">{{$Product->Product->price}}</span> @lang("Dh")</strong></td>
                                            <td style="vertical-align: middle;text-align: center;">
                                                <div class="input-group qte_input product_qte_group" style="width: fit-content;margin: auto;">
                                                    <div class="input-group-prepend">
                                                    <button class="btn btn-primary minus" type="button" style="color: #000000;font-size: 14px;line-height: 19px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;background: none;">-</button></div>
                                                    <input type="text" data-max="{{$Product->Product->stock_amount}}" readonly name="product_qte" class="form-control product_qte" style="height: 40px;max-width: 60px;border: none;text-align: center;font-size: 14px;line-height: 19px;font-weight: 100;" inputmode="numeric"  value="{{ count($errors) > 0 ? Request::old('product_qte') : $Product->Product->qte }}" />
                                                    <div class="input-group-append"><button class="btn btn-primary text-center plus" type="button" style="color: #000000;font-size: 14px;line-height: 19px;width: 40px;height: 40px;padding: 0px;border-radius: 0px;border: none;background: none;">+</button></div>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;text-align: center;"><strong><span class="product-total">{{$Product->Product->price*$Product->Product->qte}}</span> @lang("Dh")</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger text-left">
                                <ul style="margin:0px;">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <p style="font-size: 36px;line-height: 49px;margin-bottom: 15px;">@lang("finaliser la commande")</p>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;">@lang("Nom"):</label>
                                    <input name="last_name" value="{{ Request::old('last_name') }}" type="text" class="form-control" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;"
                                            placeholder="@lang("Nom")" /></div>
                                </div>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>@lang("Prénom")</strong><span style="color: rgb(255,15,0);">*</span><strong>:</strong></label>
                                    <input name="first_name" value="{{ Request::old('first_name') }}" type="text" class="form-control"
                                            style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;" placeholder="@lang("Prénom")" /></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>@lang("Téléphone")</strong><span style="color: rgb(255,15,0);">*</span><strong>:</strong></label>
                                    <input name="phone" value="{{ Request::old('phone') }}" type="tel" class="form-control"
                                            style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;" placeholder="@lang("Écrivez votre numéro de téléphone")" /></div>
                                </div>
                                <div class="col">
                                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                        <label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>@lang("Ville"):</strong></label>
                                        <select name="city" class="form-control city" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;">
                                            <option>@lang("Choisissez votre ville")</option>
                                            @foreach($Citys as $city)
                                                <option value="{{$city->id}}" data-cost="{{$city->shipping_cost}}" {{ Request::old('city') == $city->id ? 'selected' : '' }} >{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}">
                                        <label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>@lang("Adress"):</strong><br /></label>
                                        <textarea name="adress" class="form-control form-control-lg" style="border-radius: 35px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;min-height: 186px;padding-top: 21px;padding-left: 31px;" placeholder="@lang("Écrivez votre adress complette")...">{{ Request::old('adress') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <p>@lang("les champs avec le signe") (<span style="color: rgb(255,15,0);">*</span>) @lang("sont obligatoires")</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="background-color: #FFE600;position: relative;padding-right: 0;">
                        <div style="margin-top: 12vh;margin-right: 15%;margin-bottom: 12vh;position: relative;animation: 1;">
                            <p style="font-size: 36px;line-height: 49px;border-bottom: 3px solid #ffffff;margin-bottom: 35px;">@lang("finaliser la commande")</p>
                            <div style="/*margin-right: 15%;*/">
                                <span style="font-size: 18px;line-height: 28px;">@lang("Total du Panier"):</span>
                                <span style="font-size: 18px;line-height: 28px;font-weight: bold;"><span class="total-cart">{{$Product->Product->price*$Product->Product->qte}}</span> @lang("Dh")</span>
                            </div>
                            <div style="/*margin-right: 15%;*/">
                                <span style="font-size: 18px;line-height: 28px;">@lang("Frais de Livraison"):</span>
                                <span style="font-size: 18px;line-height: 28px;font-weight: bold;"><span class="shipping-cost">0.00</span> @lang("Dh")</span>
                            </div>
                            <div style="/*margin-right: 15%;*/">
                                <span style="font-size: 18px;line-height: 28px;">@lang("Frais de Taxes"):</span>
                                <span style="font-size: 18px;line-height: 28px;font-weight: bold;"><span class="tax">{{ $Product->Product->tax}}</span> @lang("Dh")</span>
                            </div>
                            <div style="/*margin-right: 15%;*/">
                                <span style="font-size: 18px;line-height: 28px;">@lang("Total du Commande"):</span>
                                <span style="font-size: 18px;line-height: 28px;font-weight: bold;color: rgb(255,0,0);"><span class="total-order">{{($Product->Product->price*$Product->Product->qte)+0+$Product->Product->tax}}</span> @lang("Dh")</span>
                            </div>
                            <p style="font-size: 16px;line-height: 20px;">@lang("Notre équipe vous appellera pour confirmer votre commande dans les plus brefs délais").</p>
                            <div>
                                <div class="form-group {{ $errors->has('termes_check') ? ' has-error' : '' }}">
                                    <input type="checkbox" class="form-check-input" name="termes_check" id="termes_check" />
                                    <label class="form-check-label" for="termes_check">@lang("J'accepte") <a href="/termes-et-conditions" style="font-weight: bold;color:blue;">@lang("les termes et conditions")</a></label>
                                </div>
                            </div>
                                <button class="btn btn-danger text-uppercase" type="submit" style="font-size: 18px;line-height: 24px;padding: 15px 25px;border-radius: 8px;font-weight: 100;margin-top: 15px; min-width:200px;">@lang("confirmez")</button>
                            </div>
                            <img src="/assets/img/Intersection 9.svg" style="max-width: 90%;max-height: 35%;position: absolute;bottom: 0;right: 0;" /></div>
                </div>
            </form>
        </div>
    </div>
</main>
    @include('inc.footer')
