
let fonts;

fetch( huskycatControls.googleFonts ).then( ( response ) => {

  return response.json();

}).then( ( list ) => {

    fonts =  list;

    jQuery( document ).ready(function($) {

        $( '.huskycat-control.typography' ).trigger( 'fonts.ready' );

    });

} );



jQuery( document ).ready(function($) {

    // select 2 dropdowns

    $( ".customize-control-select2" ).select2({
        width: "100%"
    });

    // typography control

    // rely on json fonts file
    
    $( ".huskycat-control.typography" ).on( 'fonts.ready',  function() {
        
        let that                =   $( this ),
            currentFontFamily   =   that.find( '.family__select' ).val(),
            currentFont         =   ( fonts ? fonts[ currentFontFamily ] : null );
        
        // show recommended only fonts
        that.find( '.family__recommend' ).on( 'change', function() {

            let allFonts  =   $( this ).parents( '.huskycat-control.typography' ).find( 'optgroup.all' );

            if( this.checked ) {

                allFonts.attr({ disabled : "disabled" });

            } else {

                allFonts.removeAttr( "disabled" );

            }

        });

        /* family changes */
        that.find( ".family__select" ).on( "change",function() { 

            currentFontFamily   =   $( this ).val();
            currentFont         =   fonts[ currentFontFamily ];

            if( !currentFont || !currentFont.variants ) { return; }
        
            let styleSelect   =   that.find( ".style__select--dynamic" );

            styleSelect.empty();
            styleSelect.removeAttr( 'disabled' );


            for( const style in currentFont.variants ) {

                $( `<option value="${ style }" ${ style == 'normal' ? 'selected' : '' }>${ style }</option>` ).appendTo( styleSelect );

            }

            styleSelect.trigger( 'change' );
        
        });

        /* style changes */
        that.find( ".style__select--dynamic" ).on( 'change', function() {

            let 
            style           =   $( this ).val(),
            weightSelect    =   that.find( ".weight__select--dynamic" ),
            previousValue   =   weightSelect.val();   


            $( weightSelect ).empty();
            weightSelect.removeAttr( 'disabled' );


            if( currentFont && currentFont.variants && currentFont.variants[ style ] ) {

                let weights     =   currentFont.variants[ style ],
                    selected    =   ( weights.hasOwnProperty( previousValue ) ? previousValue : 400 );
                
                for( const weight in weights ) {

                    $( `<option value="${ weight }" ${ weight == selected ? 'selected' : '' }>${ weight }</option>` ).appendTo( weightSelect );

                }

            }

            weightSelect.trigger( 'change' );

        });


    });

    
    $( ".huskycat-control.typography" ).each( function() {
        
        let that                =   $( this );

        /* font size input */
        that.find( '.size__hero' ).on( "input", function() {

            let mainInput   =   $( this ).parents( '.size' ).find( '.size__input' );

            mainInput.val( $( this ).val() );
            mainInput.trigger( 'change' );

        } );

        that.find( '.size__input' ).on( 'input', function() {

            let secondaryInput  =   $( this ).parents( '.size' ).find( '.size__hero' );
            
            secondaryInput.val( $( this ).val() );
            secondaryInput.trigger( 'change' );


        });


        /* letter-spacing input */
        that.find( '.letter-spacing__hero' ).on( "input", function() {

            let mainInput  =   $( this ).parents( '.letter-spacing' ).find( '.letter-spacing__input' );

            mainInput.val( $( this ).val() );
            mainInput.trigger( 'change' );
 
        } );

        that.find( '.letter-spacing__input' ).on( 'input', function() {

            let secondaryInput  =   $( this ).parents( '.letter-spacing' ).find( '.letter-spacing__hero' );

            secondaryInput.val( $( this ).val() );
            secondaryInput.trigger( 'change' );

        });

        /* line-height input */
        that.find( '.line-height__hero' ).on( "input", function() {

            let mainInput   =   $( this ).parents( '.line-height' ).find( '.line-height__input' );
            
            mainInput.val( $( this ).val() );
            mainInput.trigger( 'change' );
    
        } );

        that.find( '.line-height__input' ).on( 'input', function() {

            let secondaryInput  =   $( this ).parents( '.line-height' ).find( '.line-height__hero' );

            secondaryInput.val( $( this ).val() );
            secondaryInput.trigger( 'change' );


        });

    });
    
});

