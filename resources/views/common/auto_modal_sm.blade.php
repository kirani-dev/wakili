<div class="modal modal-info" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_id }}_label">
    <div class="modal-dialog animated zoomIn animated-1x modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="zmdi zmdi-close"></i></span></button>
                <h3 class="modal-title" id="{{ $modal_id }}_label">{{ $modal_title }}</h3>
            </div>
            <div class="modal-body">
                <div class="section">
                    {!! $modal_content !!}
                </div>
            </div>
        </div>
    </div>
</div>