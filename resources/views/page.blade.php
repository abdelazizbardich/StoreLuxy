@include('inc.header')
<div style="height: 150px;background-color: #F7F8FA;position: relative;">
    <p class="text-uppercase text-center" style="font-size: 54px;line-height: 74px;font-weight: bold;position: absolute;left: 0;right: 0;top: 0;bottom: 0;margin: auto;height: fit-content;width: fit-content;"><strong>@lang($title)</strong></p>
</div>
<div style="margin-bottom: 35px; ">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 py-5 mb-5">
                {!! $content !!}
            </div>
        </div>
    </div>
</div>
@include('inc.footer')
