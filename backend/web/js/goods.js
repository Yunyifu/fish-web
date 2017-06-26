var Category = {
    init : function() {
        ImgUploader.init( {
            maxImgs : 1,
            type : 2,
            $container : $( '.goods-img-container' ),
            $input : $( '#goods_img' ),
            $error : $( '.goods-img-error' )
        } );
    }
};
Category.init();