@include('inc.header')
    <main style="min-height: 100vh;position: relative;overflow: hidden;padding-bottom: 80px;"><img src="/assets/img/65%20(2).svg" style="position: absolute;right: 0;bottom: 0;width: 50%;">
        <div style="height: 150px;background-color: #F7F8FA;position: relative;">
            <p class="text-uppercase text-center" style="font-size: 54px;line-height: 74px;font-weight: bold;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;"><strong>à propos</strong></p>
        </div>
        <div style="margin-bottom: 35px;">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1">
                    <img src="{{asset('storage/' . $options->SiteOptions->site_logo)}}" style="width: 90%;margin-bottom: 16px;">
                    <div style="text-align: justify;">
                        {!! $options->SiteOptions->about !!}
                    </div>
                        
                    </div>
                    <div class="col-7 col-md-6 col-lg-6 col-xl-6 order-1 order-md-2 order-lg-2 order-xl-2"><img class="img-fluid" src="/assets/img/about.svg"></div>
                </div>
            </div>
        </div>
    </main>
    @include('inc.footer')