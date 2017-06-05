/**
 * Created by Administrator on 2017/5/11 0011.
 */
var Category = {
    init : function() {
        ImgUploader.init( {
            maxImgs : 1,
            type : 1,
            $container : $( '.banner-img-container' ),
            $input : $( '#banner_img' ),
            $error : $( '.banner-img-error' )
        } );
    }
};
Category.init();