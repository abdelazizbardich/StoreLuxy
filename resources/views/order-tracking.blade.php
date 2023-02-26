@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;"><img src="/assets/img/65%20(1).svg" style="position: absolute;left: 0;top: 0;width: 20%;"><img src="/assets/img/65%20(2).svg" style="position: absolute;bottom: 0;right: 0;width: 40%;">
        <div style="min-height: calc(100vh - 70px);padding-top: 35px;">
            <div class="container" style="height: 100%;">
                <div class="row justify-content-center align-items-center" style="height: 100%;">
                    <div class="col-9">
                        <form action="/suivi-de-commande" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group text-center">
                                        <h1 style="font-size: 45px;line-height: 61px;font-weight: bold;">Suivez votre commande</h1>
                                            @if(count($errors) > 0)
                                                <div class="alert alert-danger text-left">
                                                    <ul style="margin:0px;">
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}"><label for="code" style="font-size: 18px;line-height: 24px;font-weight: bold;">Code du commande:</label>
                                    <input id="code" value="{{ Request::old('code') }}" name="code" class="form-control" type="text" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;height: 50px;"
                                            placeholder="Tapez le code de votre commande ici...">
                                            @error('code')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"><label for="phone" style="font-size: 18px;line-height: 24px;font-weight: bold;"><strong>Numéro de téléphone:</strong></label><input value="{{ Request::old('phone') }}" id="phone" name="phone" class="form-control" type="text" style="border: 1px solid #FFCB00;border-radius: 0px;background-color: #F7F8FA;font-size: 14px;line-height: 19px;height: 50px;"
                                            placeholder="Votre numéro de téléphone...">
                                            @error('phone')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group"><button class="btn btn-primary btn-block btn-lg" type="submit" style="color: rgb(0,0,0);font-size: 25px;line-height: 34px;border: none;background-color: #FFCB00;border-radius: 0px;">Suivez</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(isset($orderDetails->ordersStates))
                    <div class="col-9">
                        <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                    <a href="/suivi-de-commande/détails-de-la-commande/{{$orderDetails->code}}/{{$orderDetails->phone}}" class="btn btn-primary btn-block btn-lg" style="color: rgb(255, 255, 255);font-size: 25px;line-height: 34px;border: none;background-color: #2978d6;border-radius: 0px;">Détails de la commande</a>
                                    </div>
                                </div>
                        </div>
                            <div class="order-step">
                                @foreach($orderDetails->ordersStates as $orderState)
                                    <div {{$orderState->state == 'done' ? 'class=done' : ''}} >
                                        <h5 style="font-weight: bold;"><strong>{{$orderState->title}}&nbsp;</strong><i class="fa fa-check-square-o" style="font-size: 15px;color: rgb(255,172,0);"></i><br></h5>
                                        <p style="font-size: 12px;">{{$orderState->details}}<br></p>
                                        @if($orderState->updated_at == null)
                                            <span class="text-right" style="position: absolute;right: 0;top: 5px;font-size: 12px;">{{substr($orderState->created_at,0,10)}}<br>
                                            <span style="font-weight: bold;">{{substr($orderState->created_at,11,5)}}</span></span>
                                        @else
                                            <span class="text-right" style="position: absolute;right: 0;top: 5px;font-size: 12px;">{{substr($orderState->updated_at,0,10)}}<br>
                                            <span style="font-weight: bold;">{{substr($orderState->updated_at,11,5)}}</span></span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @elseif(isset($orderDetails->details))
                        <div class="col-9">
                                <div class="order-details">
                                    <div>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Date:</span>&nbsp;{{$orderDetails->details->created_at}}<br></p>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Code:</span>&nbsp;{{$orderDetails->details->code}}<br></p>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Nom du client:</span>&nbsp;{{$orderDetails->details->first_name}}&nbsp;{{$orderDetails->details->last_name}}<br></p>
                                        
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Détails de livraison:</span></p>
                                        <ul style="list-style: none;">
                                            <li><strong>Téléphone:</strong> {{$orderDetails->details->phone}}</li>
                                            <li><strong>Ville:</strong> {{$orderDetails->details->city}}</li>
                                            <li><strong>Adress:</strong> {{$orderDetails->details->adress}}</li>
                                        </ul>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Produits:</span></p>
                                        <div class="row" style="margin:0px;">
                                                @foreach($orderDetails->products as $product)
                                                <div class="col-12 col-lg-6 col-xl-6 text-left fixed-carte-product" style="padding: 10px;margin-bottom: 15px;">
                                                        <table>
                                                            <tr>
                                                                <td style="vertical-align: top;"><img style="width: 100px;margin-bottom: 5px;" src="{{asset('storage/' . $product->thumbnail->file)}}"></td>
                                                                <td style="vertical-align: top;padding-left:5px;">
                                                                <p style="width: 100%;font-size: 14px;line-height: 19px;margin: 0;">{{$product->name}}</p>
                                                                <p style="width: 100%;font-size: 14px;line-height: 19px;margin: 0; color: #ff0000;"><strong>Prix: {{$product->price}} Dh</strong><br></p>
                                                                <p style="width: 100%;font-size: 14px;line-height: 19px;margin: 0;">Quantité: {{$product->qte}}</p>
                                                                <p style="width: 100%;font-size: 14px;line-height: 19px;margin: 0; color: #ff0000;"><strong>Prix total: {{$product->total_price}}Dh</strong><br></p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                @endforeach
                                        </div>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Total du panier:</span>&nbsp;{{$orderDetails->details->total_cart}} Dh</p>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Frais de livraison:</span>&nbsp;{{$orderDetails->details->shipping_cost}} Dh</p>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Frais de tax:</span>&nbsp;{{$orderDetails->details->tax_cost}} Dh</p>
                                        <p style="background: #ffd500;padding: 5px 15px;border-radius: 5px;width: fit-content;border: 2px solid #ffae00;"><span style="font-weight: bold;">Total du commande:</span>&nbsp;{{$orderDetails->details->total_order}} Dh</p>
                                        <p style="background: #ffd50026;padding: 5px 15px;border-radius: 10px;width: fit-content;"><span style="font-weight: bold;">Remarque:</span>&nbsp;{{$orderDetails->details->note}}</p>
                                    </div>
                            </div>
                        </div>
                    @endif
                    @if(isset($orderDetails->errors) and $orderDetails->errors != null)
                        <div class="col-9">
                            <div class="alert alert-info">{{$orderDetails->errors}}</div>
                        </div>
                    @endif
            </div>
        </div>
    </main>
    @include('inc.footer')