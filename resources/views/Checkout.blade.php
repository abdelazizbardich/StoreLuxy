@include('inc.header')
    <main style="position: relative;overflow: hidden;"><img src="/assets/img/Intersection%2010.svg" style="position: absolute;left: 0;top: 0;width: 10%;">
        <div>
            <form method="POST" action="/confirmer-la-commande">
            @csrf
            @method('POST')
                <input type="hidden" name="products" value="{{$products}}"/>
                <input type="hidden" name="totalCart" value="{{$totalCart}}"/>
                <input type="hidden" name="totalTax" value="{{$totalTax}}"/>
                <input type="hidden" name="note" value="{{$note}}"/>
                <div class="container-fluid">
                    <div class="row align-items-stretch" style="min-height: calc(105vh);">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="padding: 5%;padding-top: 12vh;">
                            <div></div>
                            <p style="font-size: 36px;line-height: 49px;margin-bottom: 15px;">Finalisation de la commande</p>
                            
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;">Nom:</label>
                                        <input class="form-control" value="{{ Request::old('last_name') }}" name="last_name" type="text" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;"
                                                placeholder="Nom"></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>Prénom</strong><span style="color: rgb(255,15,0);">*</span><strong>:</strong></label>
                                        <input class="form-control" value="{{ Request::old('first_name') }}" name="first_name" type="text" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;" placeholder="Prénom"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>Téléphone</strong><span style="color: rgb(255,15,0);">*</span><strong>:</strong></label>
                                        <input class="form-control" value="{{ Request::old('phone') }}" name="phone" type="tel" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;" placeholder="Écrivez votre numéro de téléphone"></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                            <label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>Ville<span style="color: rgb(255,15,0);">*</span>:</strong></label>
                                                <select class="form-control city"  name="city" style="border-radius: 50px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;height: 45px;">
                                                <option value="" selected="">Choisissez votre ville</option>
                                                @foreach($Citys as $city)
                                                    <option value="{{$city->id}}" data-cost="{{$city->shipping_cost}}" {{ Request::old('city') == $city->id ? 'selected' : '' }} >{{$city->name}}</option>
                                                @endforeach
                                                    <!-- <option value="1">Casa</option>
                                                    <option value="2">Rabat</option>
                                                    <option value="3">Kenitra</option>
                                                    <option value="4">Tanger</option>
                                                    <option value="5">Tetouan</option>
                                                    <option value="6">Chefchaoun</option>
                                                    <option value="7">Fnideq</option>
                                                    <option value="8">Mdiq</option>
                                                    <option value="9">Martil</option>
                                                    <option value="10">Nador</option>
                                                    <option value="11">Oujda</option>
                                                    <option value="12">El houcima</option>
                                                    <option value="13">Taza</option>
                                                    <option value="14">Fes</option>
                                                    <option value="15">Sefrou</option>
                                                    <option value="16">Guercif</option>
                                                    <option value="17">Meknes</option>
                                                    <option value="18">El jadida</option>
                                                    <option value="19">Azemmour</option>
                                                    <option value="20">Ouarzazat</option>
                                                    <option value="21">Marrakech</option>
                                                    <option value="22">Agadir</option>
                                                    <option value="23">Sahra</option>
                                                    <option value="24">Laarache</option>
                                                    <option value="25">Asilah</option>
                                                    <option value="26">Berkan</option>
                                                    <option value="27">Khouribga</option>
                                                    <option value="28">Beni mellal</option>
                                                    <option value="29">Azilal</option>
                                                    <option value="30">Fkih ben saleh</option>
                                                    <option value="31">Souk sebt</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group{{ $errors->has('adress') ? ' has-error' : '' }}"><label class="text-uppercase" style="font-size: 16px;line-height: 22px;font-weight: bold;"><strong>Adress:</strong><br></label><textarea name="adress" class="form-control form-control-lg" style="border-radius: 35px;border: 3px solid #FFE600;background-color: #F5F5F5;font-size: 12px;min-height: 186px;padding-top: 21px;padding-left: 31px;"
                                                placeholder="Écrivez votre adress complette...">{{ Request::old('adress') }}</textarea></div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <p>les champs avec le signe (<span style="color: rgb(255,15,0);">*</span>) sont obligatoires</p>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6" style="background-color: #FFE600;position: relative;padding-right: 0;">
                            <div style="margin-top: 12vh;margin-left: 15%;margin-bottom: 12vh;position: relative;animation: 1;">
                                <p style="font-size: 36px;line-height: 49px;border-bottom: 3px solid #ffffff;margin-bottom: 35px;">Finalisation de la commande</p>
                                <div style="margin-right: 15%;"><span style="font-size: 18px;line-height: 28px;">Total du Panier:</span><span style="font-size: 18px;line-height: 28px;float: right;font-weight: bold;"><span class="product-total">{{$totalCart}}</span> Dh</span></div>
                                <div style="margin-right: 15%;"><span style="font-size: 18px;line-height: 28px;">Frais de Livraison:</span><span style="font-size: 18px;line-height: 28px;float: right;font-weight: bold;"><span class="shipping-cost">0.00</span> Dh</span></div>
                                <div style="margin-right: 15%;"><span style="font-size: 18px;line-height: 28px;">Frais de Taxes:</span><span style="font-size: 18px;line-height: 28px;float: right;font-weight: bold;"><span class="tax">{{$totalTax}}</span> Dh</span></div>
                                <div style="margin-right: 15%;"><span style="font-size: 18px;line-height: 28px;">Total du Commande:</span><span style="font-size: 18px;line-height: 28px;float: right;font-weight: bold;color: rgb(255,0,0);"><span class="total-order"></span> Dh</span></div>
                                <p style="font-size: 16px;line-height: 20px;">Notre équipe vous appellera pour confirmer votre commande dans les plus brefs délais.</p>
                                <div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  name="termes_check" id="termes_check"><label class="form-check-label" for="termes_check">J'accepte&nbsp;<a href="#" style="font-weight: bold;">les termes et conditions</a></label></div>
                                </div><button class="btn btn-primary text-uppercase" type="submit" style="font-size: 18px;line-height: 24px;padding: 15px 25px;border-radius: 50px;font-weight: 100;margin-top: 15px;">confirmez</button></div><img src="/assets/img/Intersection%209.svg"
                                style="max-width: 90%;max-height: 35%;position: absolute;bottom: 0;right: 0;"></div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    @include('inc.footer')