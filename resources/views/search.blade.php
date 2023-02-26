@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;">
        <div style="height: 150px;background-color: #F7F8FA;position: relative;">
            <div class="text-center" style="font-size: 18px;line-height: 24px;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;">
                <p class="text-uppercase text-center" style="font-size: 18px;line-height: 24px;font-weight: normal;"><strong>Résultat de recherche pour:</strong><br></p><span style="font-size: 35px;line-height: 47px;font-weight: bold;">{{$keyword}}</span></div>
        </div>
        <div style="position: relative;padding-top: 35px;"><img src="/assets/img/65%20(1).svg" style="position: absolute;left: 0;top: 0;width: 20%;"><img src="/assets/img/Intersection%205.svg" style="position: absolute;top: 25vh;right: 0;width: 25%;">
            <div class="container">
                <div class="row">
                    @foreach($Result as $product)
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3" style="margin-bottom: 15px;">
                        <div class="text-center">
                        <a href="/produit/{{$product->slug_name}}">
                            <img class="img-fluid" src="{{asset('storage/' . $product->thumbnail->file)}}" style="border: 5px solid #ffffff;margin-bottom: 15px;">
                        </a>
                            <p class="text-center" style="font-size: 12px;line-height: 16px;margin-bottom: 0;">
                            <?php $i=1; $x=count((array)$product->categorys); ?>
                            @foreach($product->categorys as $category)
                                <a href="/boutique/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                            @endforeach
                            </p>
                            <span class="text-center" style="display: block;margin-bottom: 5px;">
                                @for($i = 0; $i < intval($product->stars);$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star.svg" style="margin-right: 3px;width: 16px;">
                                @endfor
                                @for($i = 0; $i < (5-intval($product->stars));$i++)
                                    <img src="/assets/img/Icon%20ionic-ios-star-outline.svg" style="margin-right: 3px;width: 16px;">
                                @endfor
                            </span>
                            <p class="text-center" style="font-size: 12px;line-height: 19px;margin-bottom: 5px;    min-height: 38px;">{{$product->name}}</p>
                            <p class="text-center" style="margin-bottom: 10px;color: #E74C3C;font-weight: bold;">{{$product->price}} Dh</p>
                            <ul class="list-inline">
                            @foreach($product->photos as $photo)
                                <li class="list-inline-item"><img src="{{asset('storage/' . $photo->file)}}" style="width: 30px;height: 30px;"></li>
                            @endforeach
                            </ul>
                            <a class="btn btn-primary text-uppercase btn-add-to-carte" data-id="{{$product->id}}" role="button" style="margin: auto;border: none;border-radius: 0;font-size: 9px;color: rgb(255,255,255);"><i class="fa fa-cart-plus"></i>&nbsp;Ajouter au panier</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row" style="margin-top: 35px;margin-bottom: 65px;">
                    <div class="col text-center">
                        {{$Result->render()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('inc.footer')