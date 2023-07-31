<!--Start Rightbar-->
<!--Start Rightbar/offcanvas-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="{{ $modalID }}" aria-labelledby="{{ \Illuminate\Support\Str::slug($modalID) }}Label">
    <div class="offcanvas-header border-bottom">
        <h5 class="m-0 font-14" id="assetsLabel">{{ $modalTitle }}</h5>
        <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @isset($isCustom)

            @yield('sidebar')
        @else
            {!! $modalBody !!}
        @endisset
    </div><!--end offcanvas-body-->
</div>
<!--end Rightbar/offcanvas-->
<!--end Rightbar-->
