@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Commandes<br></span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Commandes</li>
                                <li class="list-inline-item" style="font-weight: bold;">|</li>
                                <li class="list-inline-item" style="font-weight: bold;">Modifier</li>
                            </ul>
                        </div>
                        <div>
                                <div class="form-row no-gutters" style="padding: 5px;">
                                    <div class="col" style="padding: 15px;">
                                        <p style="font-size: 20px;line-height: 27px;font-weight: bold;">Modifier la commande<br></p>
                                        <div style="border-bottom: 1px solid var(--color-orenge);padding-right: 35px;margin-bottom: 15px;">
                                            <ul class="list-inline" style="margin: 0;padding-bottom: 10px;">
                                                <li class="list-inline-item" style="font-size: 22px;line-height: 35px;font-weight: bold;margin: 5px 0px;">Détails de la commande #{{$order->code}}</li>
                                                <li class="list-inline-item float-lg-right float-xl-right">
                                                    <input type="text" id="order-id" value="{{$order->id}}" hidden />
                                                    <select class="form-control" id="order-state">
                                                        <option value="1" @if($order->state == 1) selected @endif>Terminé</option>
                                                        <option value="0" @if($order->state == 0) selected @endif>En coure</option>
                                                    </select>
                                                </li>
                                            </ul>
                                        </div>
                                        <p style="font-size: 20px;line-height: 35px;font-weight: bold;">Détails de la facturation:</p>
                                        <p style="font-size: 15px;line-height: 19px;">abdelaziz bardich<br>{{$order->adress}}<br>{{$order->city}}<br><br><strong>Téléphone : </strong>{{$order->phone}}<br><br><strong>Total de la commande : </strong>{{$order->total_order}} Dh</p>
                                        <hr>
                                        <div>
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Produit</th>
                                                            <th>Price</th>
                                                            <th>Total</th>
                                                            <th>Quantité</th>
                                                            <th>Tax</th>
                                                            <th>Livraison</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="height: 30vh;">
                                                        @foreach($order->carts as $orderCart)
                                                            <tr>
                                                                <td>{{$orderCart->product->name}}</td>
                                                                <td>{{$orderCart->price}}</td>
                                                                <td style="color: var(--color-blue);">{{$orderCart->total_price}} Dh</td>
                                                                <td>{{$orderCart->quantity}}</td>
                                                                <td>{{$order->tax_cost}} Dh</td>
                                                                <td>{{$order->shipping_cost}} Dh</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3" style="padding: 15px;">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group"><a href="/admin/commandes/supprimer/{{$order->id}}" class="btn btn-danger btn-block" type="button">Supprimer</a></div>
                                            </div>
                                        </div>
                                        <div style="background-color: var(--color-white);border: 1px solid var(--color-orenge);border-radius: 5px;padding: 10px;"><label style="line-height: 22px;font-size: 16px;">Suivi de commande:</label>
                                            <div style="padding-bottom: 15px;min-height: 250px;overflow-y: auto;">
                                                <ul class="list-unstyled">
                                                    @foreach($order->notes as $note)
                                                        <li>
                                                            <div class="order-note @if($note->state == 'done') done @endif">
                                                                <h1 style="font-size: 12px;line-height: 16px;font-weight: bold;">{{$note->title}}</h1>
                                                                <p style="font-size: 10px;line-height: 14px;">{{$note->details}}</p><span style="position: absolute;left: 0;bottom: -40px;height: 20px;font-size: 9px;line-height: 12px; color:var(--color-dark-blue)">{{$note->created_at}}</span>
                                                                <span style="position: absolute;right: 0;bottom: -26px;height: 20px; font-size: 9px;line-height: 12px;cursor: pointer; color:var(--color-black)">
                                                                @if($note->state == 'progress')
                                                                <a style="color: var(--color-green);" href="/admin/commandes/marquer-la-note-comme-terminer/{{$note->id}}/{{$order->id}}" >Marquer comme Terminer</a> | 
                                                                @elseif($note->state == 'done')
                                                                <a style="color: var(--color-blue);" href="/admin/commandes/marquer-la-note-comme-en-cours/{{$note->id}}/{{$order->id}}" >Marquer comme en cous</a> | 
                                                                @endif
                                                                <a style="color: var(--color-red);" href="/admin/commandes/supprimer-la-note/{{$note->id}}/{{$order->id}}" >Supprimer</a>
                                                            </span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <hr>
                                            <div>
                                                <form  action="/admin/commandes/ajouter-une-note" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="text" name="orderId" hidden value="{{$order->id}}">
                                                    <div class="form-group">
                                                        <label style="line-height: 22px;font-size: 16px;">Ajouter une note</label>
                                                        <input class="form-control " name="title" type="text" style="margin-bottom: 5px;">
                                                        <textarea class="form-control " name="details" style="min-height: 102px;margin-bottom: 5px;"></textarea>
                                                        <div class="input-group">
                                                            <select class="form-control " name="state" style="margin-right: 10px;border-radius: 5px;">
                                                                <option value="0">En coure</option>
                                                                <option value="1">Terminé</option>
                                                            </select>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-dark" type="submit">Ajouter</button>
                                                            </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    @include('admin.inc.footer')