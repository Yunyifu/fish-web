var Address = {
    init : function(opt) {
        opt = $.extend( {
            province : $( '#province' ),
            city : $( '#city' ),
            region : $( '#region' ),
            api : apiUrl + '/v1/region/'
        }, opt );

        opt.city.on( 'change', function() {
            var city = $( this ).val();
            $.get( opt.api + 'region/' + city, function(rtn) {
                opt.region.empty();
                $.each( rtn.data, function(index, data) {
                    $( '<option value="' + data.id + '">' + data.region_name + '</option>' ).appendTo( opt.region );
                } );
                if( opt.region.attr( 'data-val' ) ) {
                    opt.region.val( opt.region.attr( 'data-val' ) );
                    opt.region.removeAttr( 'data-val' );
                }
            }, 'json' );
        } );

        opt.province.on( 'change', function() {
            var prov = $( this ).val();
            $.get( opt.api + 'city/' + prov, function(rtn) {
                opt.city.empty();
                $.each( rtn.data, function(index, data) {
                    $( '<option value="' + data.id + '">' + data.region_name + '</option>' ).appendTo( opt.city );
                } );
                if( opt.city.attr( 'data-val' ) ) {
                    opt.city.val( opt.city.attr( 'data-val' ) );
                    opt.city.removeAttr( 'data-val' );
                }
                opt.city.trigger( 'change' );
            }, 'json' );
        } );

        $.get( opt.api + 'province', function(rtn) {
            opt.province.empty();
            $.each( rtn.data, function(index, data) {
                $( '<option value="' + data.id + '">' + data.region_name + '</option>' ).appendTo( opt.province );
            } );
            if( opt.province.attr( 'data-val' ) ) {
                opt.province.val( opt.province.attr( 'data-val' ) );
                opt.province.removeAttr( 'data-val' );
            }
            opt.province.trigger( 'change' );
        }, 'json' );
    }
}