<div id="{{ $modal_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="{{ $modal_id }}_label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ $modal_id }}_label">{!! $modal_title !!}</h3>
                <button class="btn btn-danger btn-sm" data-bs-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="section">
                {!! $modal_content !!}
                </div>
            </div>

        </div>
    </div>
</div>
