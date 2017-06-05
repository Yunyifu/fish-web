var Category = {
    init : function() {
        ImgUploader.init( {
            maxImgs : 1,
            type : 2,
            $container : $( '.banner-img-container' ),
            $input : $( '#banner_img' ),
            $error : $( '.banner-img-error' )
        } );
    }
};
Category.init();