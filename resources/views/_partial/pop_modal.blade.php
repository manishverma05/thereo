<!-- Modal -->
<div class="modal fade rjvideo_model" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <video class="myvideo" id="myvideo" controls autoplay>
                    <source src="{{ $video }}" type="video/{{ $type }}">
                </video>
            </div>
        </div>
    </div>
</div>	