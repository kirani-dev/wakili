<div class="modal modal-info" id="{{ $modal_id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_id }}_label">
    <div class="modal-dialog animated zoomIn animated-3x modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ $modal_id }}_label">{!! $modal_title !!}</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="section">
                    {!! $modal_content !!}
                </div>
            </div>
        </div>
    </div>
</div>
