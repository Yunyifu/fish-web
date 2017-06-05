var FileUploader = {
    init : function(opt) {
        opt = $.extend( {
            ele : $( '.goods-img' ),
            exts : 'image/jpeg,image/png,image/gif',
            maxSize : 0.5,
            param : 'file',
            api : "/upload/index",
            data : {},
            callback : $.noop
        }, opt );
        var self = this;
        opt.ele.dropzone( {
            paramName : opt.param,
            url : opt.api,
            acceptedFiles : opt.exts,
            parallelUploads : 1,
            maxFilesize : opt.maxSize,
            previewsContainer : '',
            init : function() {
                var $ele = $( this.element );
                this.on( 'addedfile', function(file) {
                    // alert( "Added file: " + file.name );
                } );
                this.on( 'sending', function(file, xhr, formData) {
                    for ( var prop in opt.data) {
                        formData.append( prop, opt.data[prop] );
                    }
                    console.log( formData );
                } );
                this.on( 'success', function(file, result) {
                    opt.callback && opt.callback( result, this );
                } );
                this.on( 'error', function(file, error) {
                    alert( error );
                } );
            }
        } );
    }
};

var ImgPreviewContainer = {
    init : function($container, imgs, maxImgs) {
        for (var i = 0; i < imgs.length; i++) {
            $( this.renderImg( imgs[i] ) ).appendTo( $container );
        }
        var $uploader = $( '<div class="uploader"><span class="glyphicon glyphicon-plus"></span></div>' ).appendTo( $container );
        if( maxImgs && imgs.length >= maxImgs ) {
            $uploader.hide();
        }
        $container.data( 'maxImgs', maxImgs );
    },
    addImg : function($container, img) {
        var maxImgs = $container.data( 'maxImgs' );
        var $uploader = $container.find( '.uploader' );
        $( this.renderImg( img ) ).insertBefore( $uploader );
        if( maxImgs && $container.find( '.img-preview' ).length >= maxImgs ) {
            $uploader.hide();
        }
    },
    removeImg : function($container, $img) {
        $img.remove();
        $container.find( '.uploader' ).show();
    },
    renderImg : function(img) {
        return '<div class="img-preview"><button class="b-left" title="左移"><span aria-hidden="true">&lt;</span></button><button class="b-right" title="右移"><span aria-hidden="true">&gt;</span></button><button class="close"><span aria-hidden="true">×</span></button>' + '<img src="' + img + '"></div>';
    }
};

var ImgUploader = {
    init : function(opt) {
        // {maxImgs, type, $container, $input, $error, maxSize, exts, imgPrefix}
        opt = $.extend( {
            exts : 'image/jpeg,image/png,image/gif',
            maxSize : 0.5,
            imgPrefix: imgUrl
        }, opt );

        var freshHiddenVal = function() {
            var imgs = [];
            opt.$container.find( '.img-preview img' ).each( function() {
                imgs.push( $( this ).attr( 'src' ).substr( opt.imgPrefix.length ) );
            } );
            opt.$input.val( imgs.join( '||' ) );
        };

        var imgs = opt.$input.val() ? opt.$input.val().split( '||' ) : [];
        $.each( imgs, function(index, img) {
            imgs[index] = opt.imgPrefix + img;
        } );

        ImgPreviewContainer.init( opt.$container, imgs, opt.maxImgs );

        opt.$container.on( 'click', '.close', function() {
            ImgPreviewContainer.removeImg( opt.$container, $( this ).parent() );
            freshHiddenVal();
            return false;
        } );
        
        opt.$container.on( 'click', '.b-left', function() {
            var $img = $(this).parent();
            $img.insertBefore($img.prev('.img-preview'));
            freshHiddenVal();
            return false;
        } );
        
        opt.$container.on( 'click', '.b-right', function() {
            var $img = $(this).parent();
            $img.insertAfter($img.next('.img-preview'));
            freshHiddenVal();
            return false;
        } );

        FileUploader.init( {
            ele : opt.$container.find( '.uploader span' ),
            exts : opt.exts,
            maxSize : opt.maxSize,
            data : {
                'type' : opt.type,
                '_csrf' : $( 'input[name="_csrf"]' ).val(),
            },
            callback : function(data) {
                if( data.url ) {
                    ImgPreviewContainer.addImg( opt.$container, opt.imgPrefix + data.url );
                    opt.$error.hide();
                    freshHiddenVal();
                } else {
                    alert( data.error );
                }
            }
        } );
    },
};