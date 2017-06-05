$(document).on('click','.img-preview img',function(){
    var src = $(this).attr('src');
    var $img = $('<div class="img-view"><img src="' + src + '"></div>').appendTo(document.body);
    var $backdrop = $( '<div class="modal-backdrop"></div>' ).appendTo( document.body );
    $img.on('click', function() {
        $img.remove();
        $backdrop.remove();
    });
});