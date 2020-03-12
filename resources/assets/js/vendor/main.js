$(document).ready(function () {

    'use strict';

    // ---------------------------------------------- //
    // Back To Top
    // ---------------------------------------------- //
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#goTop').fadeIn();
        } else {
            $('#goTop').fadeOut();
        }
    });
    $('#goTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 600);
        return false;
    });

    // ---------------------------------------------- //
    // Fixed Element
    // ---------------------------------------------- //
    $( window ).resize(function() {
        let rightheight = $('.right').height();
        let leftheight = $('.left').height();
        let windowheight = $(window).height();

        if (rightheight < windowheight) {
            $('#right').removeClass('is-bottomPosition');
            $('#right').addClass('is-topPosition');
        }

        if (leftheight < windowheight) {
            $('#left').removeClass('is-bottomPosition');
            $('#left').addClass('is-topPosition');
        }
    });

    // ---------------------------------------------- //
    // Select2
    // ---------------------------------------------- //
    $('.select2').select2({
        maximumSelectionLength: 3
    })

    $("[data-toggle='tooltip']").tooltip();

    // ---------------------------------------------- //
    // Show and Hide
    // ---------------------------------------------- //
    $('.button-show').click(function () {
        $('.optional').show(700);
    });

    $('.button-hide').click(function () {
        $('.optional').hide(700);
    });

    $('.button-toggle').click(function () {
        $('.optional').toggle(700);
    });

    $('.button-toggle-team').click(function () {
        $('.optional-team').toggle(500);
    });

    // ------------------------------------------------------- //
    // Search Box
    // ------------------------------------------------------ //
    $('#search').on('click', function (e) {
        e.preventDefault();
        $('.search-box').fadeIn();
    });
    $('.dismiss').on('click', function () {
        $('.search-box').fadeOut();
    });

    // ------------------------------------------------------- //
    // Adding fade effect to dropdowns
    // ------------------------------------------------------ //
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
    });
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
    });

    // ------------------------------------------------------- //
    // Show Right Side Navbar
    // ------------------------------------------------------ //
    $('#menu-close').click(function (e) {
        e.preventDefault();
        $('#sidebar-wrapper-home').toggleClass('active');
    });
    $('#menu-toggle-right').click(function (e) {
        e.preventDefault();
        $('#sidebar-wrapper-home').toggleClass('active');
    });

    // ------------------------------------------------------- //
    // Auto Height Textarea
    // ------------------------------------------------------ //
    $.each($('.textarea--autoHeight'), function () {
        var offset = this.offsetHeight - this.clientHeight;
        var resizeTextarea = function resizeTextarea(el) {
            $(el).css('height', 'auto').css('height', el.scrollHeight + offset);
        };
        $(this).on('keyup input', function () {
            resizeTextarea(this);
        }).removeAttr('data-autoresize');
    });

    // ------------------------------------------------------- //
    // Show and hiden social
    // ------------------------------------------------------ //
    $('.card__share > a').on('click', function(e){ 
        e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find( 'div' ).toggleClass( 'card__social--active' );
        $(this).toggleClass('share-expanded');
    });
});
