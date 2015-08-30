/*---[ Details ]---------------------------------------
Global Javascript Scripts
Author: Adrian Galvez G.
Contact: lab@dremasengineering.com
version: #0.25
-------------------------------------------------------*/

/**
 * Google Charts
 */

 if (document.body.classList.contains('logged-in')) {
    google.load("visualization", "1", {
        packages: ["corechart"]
    });
}


/**
 * Show date running
 */

 update = function() {
    var time = moment().locale('es').format('dddd, MMMM DD YYYY, HH:mm:ss');
    var d = $('#metas').data('date');
    var metas = moment(d, "DD-MM-YYYY, h:mm").startOf('hour').locale('es').fromNow();

    $('#time').html(time);
    $('#metas').html(metas);
}


/**
 * Twitter Args
 */

 twitter_feed_args = function() {

    $('#tweetfeed').twittie({
        username: 'Forbes_Mexico',
        hashtag: 'ForoForbes',
        dateFormat: '%b. %d, %Y',
        template: '<figure>{{avatar}}</figure><article><small class="date">{{date}} - {{screen_name}} </small> {{tweet}}</article>',
        count: 10,
        apiPath: '/assets/themes/forbesmx/inc/scripts/vendor/twitter/api/tweet.php',
    });



}

/**
 * Picturefill
 */

 picturefill({
    reevaluate: true
});


/**
 * Share Script
 */
 function shareme(shareElement, shareElementMobile) {

    $(shareElement).each(function(i) {
        $(this).sharrre({
            share: {
                facebook: true,
                twitter: true,
                pinterest: true,
                linkedin: true,
            },
            template: '<ul class="box"><li> <h2>{total}<small>Compartido</small> </h2> </li><li id="facebook"><i class="fa fa-facebook"></i></li><li id="twitter"><i class="fa fa-twitter"></i></li><li id="box-plus"><i class="fa fa-plus"></i> <ul class="box-plus"> <li id="googleplus"><i class="fa fa-google-plus"></i></li><li id="linkedin"><i class="fa fa-linkedin"></i></li><li id="pinterest"><i class="fa fa-pinterest"></i></li></ul></li></ul>',
            enableHover: false,
            enableTracking: true,
            buttons: {
                googlePlus: {},
                facebook: {
                    layout: 'button',
                    send: true
                },
                twitter: {
                    via: 'Forbes_Mexico',
                },
                linkedin: {},
                pinterest: {}
            },
            url: 'http://code.google.com',
            render: function(api, options) {
                $(api.element).on('click', '#twitter', function() {
                    api.openPopup('twitter');
                    return false;

                });
                $(api.element).on('click', '#facebook', function() {
                    api.openPopup('facebook');
                    return false;

                });
                $(api.element).on('click', '#googleplus', function() {
                    api.openPopup('googlePlus');
                    return false;

                });

                $(api.element).on('click', '#pinterest', function() {
                    api.openPopup('pinterest');
                    return false;

                });

                $(api.element).on('click', '#box-plus', function() {
                    $('.box-plus').toggleClass('checked');
                    return false;

                });

                $(api.element).on('click', '#linkedin', function() {
                    api.openPopup('linkedin');
                    return false;
                });

                var logged = $('body').hasClass('logged-in');
                if (logged) {
                    var data = new google.visualization.DataTable();
                    data.addColumn('string', 'Social network');
                    data.addColumn('number', 'Sharing');
                    data.addRows(5);
                    data.setValue(0, 0, 'Google Plus');
                    data.setValue(0, 1, options.count.googlePlus);
                    data.setValue(1, 0, 'Facebook');
                    data.setValue(1, 1, options.count.facebook);
                    data.setValue(2, 0, 'Twitter');
                    data.setValue(2, 1, options.count.twitter);
                    data.setValue(3, 0, 'Linkedin');
                    data.setValue(3, 1, options.count.linkedin);
                    data.setValue(4, 0, 'Pinterest');
                    data.setValue(4, 1, options.count.pinterest);

                    //console.log(options.count);
                    //
                    var opt = {
                        title: 'Total: ' + options.total,
                        backgroundColor: '#FFFFFF',
                        colors: ['#dd4b39', '#3b5998', '#00aced', '#007bb6', '#cb2027'],
                        width: '450px',
                        height: '450px'
                    }

                    var chart = new google.visualization.PieChart(document.getElementById('pie'));
                    chart.draw(data, opt);
                }
            }
        });


});




/*-------------
   Menu
   --------------- */



/* Start jQuery Document Load
-------------------------------------------------------*/

jQuery(function($) {

    setInterval(update, 1000);




    /*----------------------------------------------------
    Loop New
    ----------------------------------------------------*/

    /*----------------------------------------------------
    Get Twitter Feed
    ----------------------------------------------------*/


    //twitter_feed_args();

    /*----------------------------------------------------
    Share Things
    ----------------------------------------------------*/

    shareme('#shareme');


    /*---------------------------------------------------
      Opciones select menu
      ---------------------------------------------------*/
      $('li[data-option]').bind('change', function() {
        var url = $(this).attr('data-value');
        if (url) {
            window.location.href = url;
        }
        return false;
    });




    /*--------------------------------------------------------
     Sliders
     ---------------------------------------------------------*/

    //latest news carousel


    owl.owlCarousel({
        loop: false,
        lazyLoad: true,
        margin: 32,
        smartSpeed: 450,
        responsiveClass: true,
        navContainer: '.newsArrows',
        navText: ['<i class=\"fa fa-angle-left\"></i>', '<i class=\"fa fa-angle-right\"></i>'],
        animateOut: 'fadeInLeft',
        animateIn: 'fadeInRight',
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            645: {
                items: 3,
                nav: true,
            },
            960: {
                items: 4,
                nav: true,
            }
        }
    });



    /*--------------------------------------------------------
     Colaborators tooltip
     ---------------------------------------------------------*/

     $('.tooltip-author').each(function() {
        var colaborator = $(this).find('.colaborator');
        var identificator = $(colaborator).attr('id');
        var imageid = $(this).find('footer').find('a').attr('id');
        var img = $('#' + imageid).find('img').attr('src');

        $('#networks' + identificator).click(function() {
            return false;
        });

        $('#networks' + identificator).tooltipster({
            content: $('#autor-' + identificator),
            maxWidth: 350,
            position: 'top',
            theme: 'tooltipster-light',
            positionTracker: true,
            multiple: true,
            touchDevices: true,
            contentAsHTML: true,
            interactive: true
        });



    });



    });




    /*------------------------------------------------------
Magic
------------------------------------------------------*/



openGallery = function(){
    $('.gallery-link').on('click', function () {
        $(this).next().magnificPopup('open');
    });

    $('.gallery').each(function() {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            gallery: {
                enabled: true,
                navigateByImgClick: true
            },
            fixedContentPos: false
        });
    });
};

openGallery();

});