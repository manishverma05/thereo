<script>
    $(document).ready(function () {
        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    let isFormSubmit = false;
    function formSubmit(status) {
        isFormSubmit = true;
        $('input[name=status]').val(status);
        document.getElementById('form').submit();
    }
    $(window).bind('beforeunload', function () {
//        if (isFormSubmit) {
//            return;
//        }
//        return 'Are you sure you want to leave?';
    });
    function updateCover(obj) {
        $('.cover_image_name').text($(obj).find('img').attr('data-name'));
        $('#cover_image_preview').attr('src', $(obj).find('img').attr('src'));
        $('input[name=cover_id]').val($(obj).find('img').attr('id'));
        $('.cover_image_detail').show();
        $('#modal-coverPopup').modal('hide');
    }
    function updateVideo(obj) {
        $('.video_attach_name').text($(obj).find('img').attr('data-name'));
        $('#video_attach_preview').attr('src', $(obj).find('img').attr('src'));
        $('input[name=video_id]').val($(obj).find('img').attr('id'));
        $('.video_attach_detail').show();
        $('#modal-videoPopup').modal('hide');
    }
    function updateMaterial(obj) {
        $('.material_name').text($(obj).find('img').attr('data-name'));
        $('#material_preview').attr('src', $(obj).find('img').attr('src'));
        $('input[name=material_id]').val($(obj).find('img').attr('id'));
        $('.material_detail').show();
        $('#modal-materialPopup').modal('hide');
    }
</script>