@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;">
        <div style="background-color: #F7F8FA;position: relative;min-height: 150px;margin-bottom: 75px;">
            <div class="container">
                <div class="row" style="padding-top: 35px;margin-bottom: 50px;">
                    <div class="col-12 col-sm-12 col-sm-12 col-md-6 col-lg-5">
                        <a href="/article/{{$Post->post->slug_name}}">
                            <img class="post-in-image" src="{{asset('storage/' . $Post->thumbnail->file)}}">
                        </a>
                    </div>
                    <div class="col-md-6" style="position: relative;">
                        <h1 id="post-title">{{$Post->post->name}}</h1><span id="post-author">Par <strong style="text-transform: uppercase;">{{$Post->user}}</strong> le {{substr($Post->post->created_at,0,10)}}</span>
                        <div id="post-details"><span style="font-size: 16px;line-height: 22px;position: relative;display: inline-block;">
                        <?php $i=1; $x=count((array)$Post->categorys); ?>
                                    @foreach($Post->categorys as $category)
                                        <a href="/blogs/{{$category->slug_name}}" style="color:inherit;">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                    @endforeach
                        </span><span style="font-size: 16px;line-height: 22px;display: inline-block;margin-left: 15px;"><span style="background-image: url(&quot;/assets/img/Icon%20awesome-comment.svg&quot;);width: 15px;height: 21px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;float: left;margin-right: 5px;"></span> {{$Post->commentsCount}}</span>
                            <span
                                style="font-size: 16px;line-height: 22px;display: inline-block;margin: 5px;"><span style="width: 18px;height: 20px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;float: left;margin-right: 5px;"><i class="la la-eye" style="font-size: 16px;line-height: 23px;"></i></span> {{$Post->post->views}}</span>
                                <span
                                    style="font-size: 16px;line-height: 22px;display: inline-block;margin: 5px;">
                                    <span style="width: 18px;height: 20px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;float: left;margin-right: 5px;"><i class="fas fa-share-alt" style="font-size: 16px;line-height: 23px;"></i></span> {{$Post->post->shares}}</span>
                                    <ul
                                        class="list-inline" id="post-shear-buttons">
                                        <li class="list-inline-item text-center" style="height: 30px;width: 30px;background: #FFE600;border-radius: 25px;float: left;text-align: center;padding: 2px;"><img class="img-fluid" src="/assets/img/Icon%20feather-share-2.svg" style="width: 15px;margin: auto;"></li>
                                        <li class="list-inline-item " style="height: 30px;width: 25px;border-radius: 25px;text-align: center;float: left;">
                                            <a target="_blank" style="color: inherit;" href="https://www.facebook.com/sharer/sharer.php?u={{ $options->SiteOptions->site_url}}/article/{{$Post->post->slug_name}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore sharePost" data-id="{{$Post->post->id}}">
                                            <i class="fa fa-facebook" style="font-size: 18px;line-height: 30px;"></i></a>
                                        </li>
                                        <li class="list-inline-item" style="height: 30px;width: 25px;border-radius: 25px;text-align: center;float: left;">
                                            <a class="sharePost" data-id="{{$Post->post->id}}" target="_blank" style="color: inherit;" href="https://twitter.com/intent/tweet?text={{ $options->SiteOptions->site_url}}/article/{{$Post->post->slug_name}}">
                                            <i class="fa fa-twitter" style="font-size: 18px;line-height: 30px;"></i>
                                        </a>
                                    </li>
                                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    <div class="col">
                    {!! $Post->post->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 35px;">
            <div class="container">
                <div class="row">
                    <div class="col-12" style="margin-bottom: 54px;"><span style="display: block;font-size: 31px;line-height: 42px;font-weight: bold;background-color: #FFE600;padding: 15px;">Laissez Un Commentaire</span>
                        <form action="/article/nouveau-commentaire" method="POST" style="padding: 15px;border: 1px solid #FFE600;">
                            @csrf
                            @method('POST')
                            <input value="{{$Post->post->id}}" hidden name="id" />
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group{{ $errors->has('fullname') ? ' has-error' : '' }}">
                                        <label style="font-size: 18px;">Nom:</label>
                                        <input value="{{ Request::old('fullname') }}"  id="fullname" name="fullname" class="form-control" type="text" placeholder="Tapez votre nom..." style="font-size: 14px;padding: 30px;border: none;border-bottom: 1px solid rgb(255,230,0);border-radius: 0;background-color: #FCFCFC;"><br/>
                                        @error('fullname')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                                        <label style="font-size: 18px;">Commentaire:</label>
                                        <textarea value="{{ Request::old('comment') }}"  id="comment" name="comment"  class="form-control" style="font-size: 14px;padding: 30px;border: none;border-bottom: 1px solid rgb(255,230,0);border-radius: 0;background-color: #FCFCFC;padding-top: 15px;min-height: 150px;color:black;" placeholder="Tapez votre commentaire..."></textarea><br/>
                                        @error('comment')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                <div class="form-group"><button class="btn btn-primary text-uppercase" type="submit" style="padding: 15px;border: none;border-radius: 0;background: #ffe600;color: black;font-weight: bold;">commentez</button></div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="col-12" style="margin-bottom: 54px;">
                @if($Post->comments)
                <span style="font-size: 37px;line-height: 61px;font-weight: bold;margin-bottom: 10px;display: block;">Les commentaires:</span>
                @endif
                    <ul class="list-unstyled">
                    @foreach($Post->comments as $comment)
                        <li style="margin-bottom: 15px;">
                            <div>
                                <div class="row no-gutters">
                                    <div class="col-auto"><i class="fa fa-user-circle" style="color: #FFE600;font-size: 39px;margin-right: 15px;"></i></div>
                                    <div class="col">
                                        <div>Par <span style="font-size: 18px;font-weight: bold;line-height: 40px; text-transform: uppercase;">{{$comment->user}}</span><span style="float: right;line-height: 40px;font-size: 11px;">le {{$comment->comment->created_at}}</span></div>
                                        <p style="font-size: 14px;line-height: 20px;margin-bottom: 8px;">{!! $comment->comment->comment !!}</p>
                                            <!-- <span style="font-size: 14px;color: #0066FF;font-weight: normal;">Répondre</span> -->
                                            </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
        </div>
        <div style="margin-bottom: 30px;margin-top: 60px;">
            <div style="margin-bottom: 15px;">
                @if($RelatedPosts)
                <p class="text-center" style="font-size: 24px;line-height: 32px;font-weight: bold;margin: 0;"><strong>Plus de sujets que vous aimerez</strong><br></p>
                @endif
            </div>
            <div class="container">
                <div class="row" style="margin-top: 15px;margin-bottom: 15px;">
                    @foreach($RelatedPosts as $Post)
                        <div class="col-12 col-md-4 col-lg-4 col-xl-4" style="margin-bottom: 15px;">
                            <div class="text-center">
                            <a href="/article/{{$Post->post->slug_name}}">
                            <img class="img-fluid" src="{{asset('storage/' . $Post->thumbnail->file)}}" alt="{{$Post->thumbnail->alt_title}}" title="{{$Post->thumbnail->name}}" description="{{$Post->thumbnail->file_desc}}" style="border: 5px solid #ffffff;width: 100%;">
                            </a>
                                <div style="margin-right: 10%;margin-left: 10%;border-radius: 24px 24px 0px 0px;padding: 10px 15px;height: 180px;margin-top: -90px;background: #ffffff;z-index: 1;position: relative;">
                                    <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;color: #0066FF;font-weight: bold;">
                                    <?php $i=1; $x=count((array)$Post->categorys); ?>
                                    @foreach($Post->categorys as $category)
                                        <a href="/blogs/{{$category->slug_name}}">{{$category->name}}</a><?php if($i++<$x){echo ',';} ?>
                                    @endforeach
                                    </p>
                                    <h1 style="font-size: 19px;line-height: 17px;font-weight: bold;margin-bottom: 5px;">{{$Post->post->name}}</h1>
                                    <p style="font-size: 12px;line-height: 16px;margin-bottom: 5px;">{{substr(strip_tags($Post->post->content),0,125)}}</p>
                                    <div>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><span style="font-size: 10px;line-height: 14px;">Par <strong style="text-transform: uppercase;">{{$Post->user}} </strong>le 
                                            {{substr($Post->post->created_at,0,10)}}</span></li>
                                            <li class="list-inline-item"><span style="background-image: url(&quot;/assets/img/Icon%20awesome-comment.svg&quot;);width: 27px;display: block;background-size: contain;background-repeat: no-repeat;font-size: 10px;background-position: center;">{{$Post->commentsCount}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
    @include('inc.footer')