@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;">
        <div style="height: 150px;background-color: #F7F8FA;position: relative;">
            <p class="text-uppercase text-center" style="font-size: 54px;line-height: 74px;font-weight: bold;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;">@lang("Blogs")</p>
        </div>
        <div style="position: relative;"><img src="/assets/img/65%20(1).svg" style="position: absolute;left: 0;top: 0;width: 20%;"><img src="/assets/img/Intersection%205.svg" style="position: absolute;top: 25vh;right: 0;width: 25%;">
            <div style="padding-top: 35px;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center" style="margin-bottom: 45px;"><span class="text-uppercase" style="display: block;font-size: 24px;line-height: 32px;font-weight: bold;margin-bottom: 8px;">@lang("DERNIÈRE DU BLOG")</span><span class="text-uppercase">@lang("LES NOUVELLES LES PLUS FRAÎCHES ET LES PLUS EXCITANTES")</span></div>
                        <div
                            class="col-12">
                            <ul class="list-inline text-uppercase text-center" style="margin-bottom: 0;font-size: 14px;line-height: 22px;">
                                <li class="list-inline-item" style="margin-right: 15px;margin-left: 15px;"><strong><a style="color:inherit;" href="/blogs/">@lang("tout")</a></strong></li>
                                @if($categorys)
                                    @foreach($categorys as $category)
                                        <li class="list-inline-item" style="margin-right: 15px;margin-left: 15px;"><a style="color:inherit;" href="/blogs/{{$category->slug_name}}">{{$category->name}}</a></li>
                                    @endforeach
                                @endif

                            </ul>
                    </div>
                    <div class="col" style="margin-bottom: 35px;">
                        <div class="row" style="margin-top: 15px;margin-bottom: 15px;">
                            @if($posts)
                                @foreach($posts as $Post)
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                                    <div class="text-center">
                                    <a href="/article/{{$Post->slug_name}}">
                                    <img class="img-fluid" src="{{asset('storage/' . $Post->thumbnail->file)}}" alt="{{$Post->thumbnail->alt_title}}" title="{{$Post->thumbnail->name}}" description="{{$Post->thumbnail->file_desc}}" style="border: 5px solid #ffffff;width: 100%;">
                                    </a>
                                        <div style="margin-right: 10%;margin-left: 10%;border-radius: 24px 24px 0px 0px;padding: 10px 15px;height: 180px;margin-top: -90px;background: #ffffff;z-index: 1;position: relative;">
                                            <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;color: #0066FF;font-weight: bold;">
                                            <?php $i=1; $x=count((array)$Post->categorys); ?>
                                            @foreach($Post->categorys as $category)
                                                <a style="color: inherit;" href="/blogs/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                            @endforeach
                                            </p>
                                            <h1 style="font-size: 19px;font-weight: bold;margin-bottom: 5px;">{{$Post->name}}</h1>
                                            <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;">{{substr(strip_tags($Post->content),0,125)}}</p>
                                            <div>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><span style="font-size: 10px;line-height: 14px;">@lang("Par") <strong style="text-transform: uppercase;">{{$Post->user}} </strong>@lang("le")
                                                    {{substr($Post->created_at,0,10)}}</span></li>
                                                    <li class="list-inline-item"><span style="background-image: url(&quot;/assets/img/Icon%20awesome-comment.svg&quot;);width: 27px;display: block;background-size: contain;background-repeat: no-repeat;font-size: 10px;background-position: center;">{{$Post->commentsCount}}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col text-center">
                            {{$posts->render()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    @include('inc.footer')
