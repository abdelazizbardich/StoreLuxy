@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Les Commandes</span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blank" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-home" style="color: var(--color-orenge);"></i></li>
                                <li class="list-inline-item"><i class="fa fa-angle-double-right"></i></li>
                                <li class="list-inline-item" style="font-weight: bold;">Commandes</li>
                            </ul>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Commande</th>
                                            <th>Date</th>
                                            <th>Etat</th>
                                            <th>Total de tax</th>
                                            <th>Total de livraison</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($orders)
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>
                                                        <p style="margin-bottom: 0px;"><span style="color: var(--color-blue);">#{{$order->code}} {{$order->first_name}} {{$order->last_name}}</span><span class="show-order-details" data-id="{{$order->id}}"><img src="/assets/admin/img/preview.svg"></span></p>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item" data-id="{{$order->id}}" ><a style="color: var(--color-blue);cursor:pointer;" href="/admin/commandes/modifier/{{$order->id}}">Éditer</a></li>
                                                            <li class="list-inline-item">|</li>
                                                            <li class="list-inline-item" data-id="{{$order->id}}" ><a style="color: var(--color-red);cursor:pointer;" href="/admin/commandes/supprimer/{{$order->id}}">Supprimer </a></li>
                                                        </ul>
                                                    </td>
                                                    <td>{{$order->created_at}}</td>
                                                    <td>
                                                    @if($order->state == 1)
                                                    <span class="btn" style="background-color: var(--color-dark-blue);color: var(--color-white);">Terminé</span>
                                                    @else
                                                    <span class="btn" style="background-color: var(--color-green);color: var(--color-white);">En cours</span>
                                                    @endif
                                                    </td>
                                                    <td>{{$order->tax_cost}} Dh</td>
                                                    <td>{{$order->shipping_cost}} Dh</td>
                                                    <td>{{$order->total_order}} Dh</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')