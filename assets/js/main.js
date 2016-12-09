/**
 * Custom js for theme
 */

( function( $ ) {
	"use strict";

    var $document = $(document);

    $document.ready(function () {

        $(".scroll-down").arctic_scroll();

        $(".menu-button, .nav-cover, .nav-close").on("click", function(e){
            e.preventDefault();
            $("body").toggleClass("nav-opened nav-closed");
        });

    });

	/**
    * Navigation sub menu show and hide
    *
    * Show sub menus with an arrow click to work across all devices
    * This switches classes and changes the genericon.
    */
    /*$( '.main-navigation .page_item_has_children > a, .main-navigation .menu-item-has-children > a' ).append( '<button class="showsub-toggle" aria-expanded="false">' + menuToggleText.open + '</button>' );

    $( '.showsub-toggle' ).click( function( e ) {
            e.preventDefault();
            var $this = $( this );
            $this.toggleClass( 'sub-on' );
            $this.text( $this.text() == menuToggleText.open ? menuToggleText.close : menuToggleText.open );
            $this.parent().next( '.children, .sub-menu' ).toggleClass( 'sub-on' );
            $this.attr( 'aria-expanded', $this.attr( 'aria-expanded' ) == 'false' ? 'true' : 'false');
    } );*/

    /**
    * Close slide menu with escape key
    *
    * Adds in this functionality
    */
    $document.keyup( function( e ) {
        if ( e.keyCode === 27 && $("body").hasClass( 'nav-opened' ) ) {
            e.preventDefault();
            $("body").toggleClass("nav-opened nav-closed");
        }

        if ( e.keyCode === 9 && $("body").hasClass( 'nav-closed' ) ) {
            e.preventDefault();
            $("body").toggleClass("nav-opened nav-closed");
        }
    } );

    // Arctic Scroll by Paul Adam Davis
    // https://github.com/PaulAdamDavis/Arctic-Scroll
    $.fn.arctic_scroll = function (options) {

        var defaults = {
            elem: $(this),
            speed: 500
        },

        allOptions = $.extend(defaults, options);

        allOptions.elem.click(function (event) {
            event.preventDefault();
            var $this = $(this),
                $htmlBody = $('html, body'),
                offset = ($this.attr('data-offset')) ? $this.attr('data-offset') : false,
                position = ($this.attr('data-position')) ? $this.attr('data-position') : false,
                toMove;

            if (offset) {
                toMove = parseInt(offset);
                $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top + toMove) }, allOptions.speed);
            } else if (position) {
                toMove = parseInt(position);
                $htmlBody.stop(true, false).animate({scrollTop: toMove }, allOptions.speed);
            } else {
                $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top) }, allOptions.speed);
            }
        });
    };

} )( jQuery );