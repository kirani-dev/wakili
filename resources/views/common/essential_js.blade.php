<script type="text/javascript">
    @if(session('force_redirect'))
        window.location.reload(true);
    @endif
    if(typeof jQuery == 'undefined'){
       window.location.reload(true);
    }
</script>
@if(session('message'))
    <div class="alert alert-{{ session('status') }}">{!! session('message') !!}</div>
@endif
<script type="text/javascript">
@if($notice = request()->session()->get('notice'))
@if($notice['type'] == 'warning')
        toastr.warning('{{ $notice['message'] }}');
    @elseif($notice['type'] == 'info')
    toastr.info('{{ $notice['message'] }}');
    @elseif($notice['type'] == 'error')
    toastr.error('{{ $notice['message'] }}');
    @elseif($notice['type'] == 'success')
    toastr.info('{{ $notice['message'] }}');
    @endif
@endif


    $(document).ready(function() {
        $(".hd-body").click(function() {
            $(".q-view").addClass("active");
        });
        $(".overlay").click(function() {
            $(".q-view").removeClass("active");
        });
    });

$('.right-bar-toggle').click(function () {
    // $('body').toggleClass("right-bar-enabled")

    let modal_content_class = $(this).attr("data-modal-class");
    $('.sidebar_content').removeClass('displayContent');
    // console.log('clicked class is ' + modal_content_class)
    $('.' + modal_content_class).addClass('displayContent');
});
</script>
