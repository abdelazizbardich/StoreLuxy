@include('admin.inc.header')
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-10 float-right" id="wrapper">
                    <header><span class="d-inline d-sm-inline d-md-inline d-lg-none d-xl-none" style="display: inline-block;"><button class="btn btn-primary" id="menu-button" type="button"><img src="/assets/admin/img/bars-icon.svg"></button></span><span style="display: inline-block;margin-left: 25px;line-height: 80px;">Rapport</span>
                        <span
                            class="d-none d-md-block d-lg-block d-xl-block" style="display: inline-block;float: right;"><a target="_blan" href="{{ $options->SiteOptions->site_url}}" class="btn btn-primary" role="button" id="website-button"><img src="/assets/admin/img/home-icon.svg"></a></span>
                    </header>
                    <div id="content">
                        <div style="margin: 15px 0px;padding: 10px 0px;">
                            <div class="row no-gutters justify-content-center align-items-center">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/orders-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Commondes</span></div><span class="count">{{$ordersCount}}</span></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/post-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Postes</span></div><span class="count">{{$postsCount}}</span></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/stars-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Avis</span></div><span class="count">{{$reviewsCount}}</span></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/product-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Produits</span></div><span class="count">{{$productsCount}}</span></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/newsletter-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Newsletter</span></div><span class="count">{{$newslettersCount}}</span></div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                    <div class="cart-1">
                                        <div style="position: relative;"><span class="ban"><img src="/assets/admin/img/users-icon.svg" style="width: 37px;height: 37px;"></span><span class="title">Utilisateurs</span></div><span class="count">{{$usersCount}}</span></div>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 15px 0px;padding: 10px 0px;">
                            <div class="row no-gutters justify-content-center align-items-center">
                                <div class="col-12">
                                    <div class="cart-2">
                                        <div style="position: relative;">
                                            <div style="margin-top: -45px;display: inline-block;margin-left: 17px;margin-bottom: 15px;margin-right: 17px;">
                                                <div style="display: inline-block;background-color: var(--color-white);border: 4px solid var(--color-white);box-shadow: rgba(0,0,0,0.16) 0px 3px 6px;border-radius: 5px;"><span class="ban"><img src="/assets/admin/img/chart-icon.svg" style="width: 49px;height: 37px;"></span><span class="title">Revenu mensuel</span></div>
                                            </div>
                                        </div>
                                        <div style="padding: 43px;">
                                            <div><canvas data-bs-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Fev&quot;,&quot;Mar&quot;,&quot;Avr&quot;,&quot;Mai&quot;,&quot;Jun&quot;,&quot;Jui&quot;,&quot;Aoû&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Déc&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;rgba(255,255,255,0)&quot;,&quot;borderColor&quot;:&quot;#ffffff&quot;,&quot;data&quot;:
                                            [&quot;{{$monthlyEarning[1]}}&quot;,
                                            &quot;{{$monthlyEarning[2]}}&quot;,
                                            &quot;{{$monthlyEarning[3]}}&quot;,
                                            &quot;{{$monthlyEarning[4]}}&quot;,
                                            &quot;{{$monthlyEarning[5]}}&quot;,
                                            &quot;{{$monthlyEarning[6]}}&quot;,
                                            &quot;{{$monthlyEarning[7]}}&quot;,
                                            &quot;{{$monthlyEarning[8]}}&quot;,
                                            &quot;{{$monthlyEarning[9]}}&quot;,
                                            &quot;{{$monthlyEarning[10]}}&quot;,
                                            &quot;{{$monthlyEarning[11]}}&quot;,
                                            &quot;{{$monthlyEarning[12]}}&quot;]
                                            ,&quot;fill&quot;:true,&quot;borderWidth&quot;:&quot;4&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;reverse&quot;:false},&quot;title&quot;:{&quot;display&quot;:false},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgba(255,255,255,0.33)&quot;,&quot;zeroLineColor&quot;:&quot;rgba(255,255,255,0.33)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#ffffff&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:15}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgba(255,255,255,0.33)&quot;,&quot;zeroLineColor&quot;:&quot;rgba(255,255,255,0.33)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:true,&quot;drawOnChartArea&quot;:true},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#ffffff&quot;,&quot;beginAtZero&quot;:false,&quot;padding&quot;:15}}]}}}"></canvas></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('admin.inc.footer')