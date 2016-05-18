"use strict";

var width = document.body.offsetWidth;
var old_width = document.body.offsetWidth;
var naviq = navi.querySelectorAll('.Mia_navi__elem');

var active_index = 0;
var raf = null;
navi.addEventListener('click', function(e) {
    if(e.target.classList.contains('Mia_navi__elem')) {
        if(!e.target.classList.contains('emblem')) {
            cancelAnimationFrame( raf );
            var uncompleted_path = (active_index * width) - wrapper.scrollLeft;        
            var current_index = Number( e.target.getAttribute('data-index') ), scroll_path = 0;
            
            if( current_index !== active_index ) {
                scroll_path = ((current_index - active_index) * width) + uncompleted_path;
                active_index = current_index;
                for( var i = 0; i < naviq.length; i = i + 1 ) {
                    naviq[i].classList.remove('active');
                }
                e.target.classList.add('active');
                var start_scroll_position = wrapper.scrollLeft;
                            
                mapleAnimateProcessor({
                    duration: 400,
                    draw: function( progress ) {
                        console.log('draw');
                        var parh = ~~(start_scroll_position + (scroll_path * progress));
                        wrapper.scrollLeft = parh;
                    },
                    timing: linear
                }, function(){
                    console.warn('animation is complete');
                });
            
            }
        }
    }
    function animmation_path( start_index, stop_index ) {
        return (stop_index - start_index) * old_width;
    }
});

function linear(timeFraction) {
    return timeFraction;
}

function quad(progress) {
    return Math.pow(progress, 2)
}

function circ(timeFraction) {
    return 1 - Math.sin(Math.acos(timeFraction))
}

function elastic(x, timeFraction) {
    return Math.pow(2, 10 * (timeFraction - 1)) * Math.cos(20 * Math.PI * x / 3 * timeFraction)
}

function back(x, timeFraction) {
    return Math.pow(timeFraction, 2) * ((x + 1) * timeFraction - x)
}

function bounce( timeFraction ) {
    for (var a = 0, b = 1, result; 1; a += b, b /= 2) {
        if ( timeFraction >= (7 - 4 * a) / 11 ) {
            return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2);
        }
    }
}

function makeEaseOut(timing) {
    return function (timeFraction) {
        return 1 - timing(1 - timeFraction);
    }
}

function elastic(x, timeFraction) {
    return Math.pow(2, 10 * (timeFraction - 1)) * Math.cos(20 * Math.PI * x / 3 * timeFraction)
}

var bounceEaseOut = makeEaseOut(bounce);
/*
wrapper.addEventListener('scroll', function(e) {
    console.log('e', e);
});*/

window.addEventListener('resize', function(e) {
    width = document.body.offsetWidth;
    wrapper.scrollLeft = (width * active_index);
});



function mapleAnimateProcessor(options, callback) {
    var start = performance.now();

    raf = requestAnimationFrame( animate );

    function animate(time) {
        var timeFraction = (time - start) / options.duration;
        if (timeFraction > 1) timeFraction = 1;
        if (timeFraction < 0) timeFraction = 0;

        //console.warn( "timeFraction :: ", ~~(timeFraction.toFixed(2) * 100), "%" );

        // текущее состояние анимации
        var progress = options.timing( timeFraction );
        //console.log( "progress", progress );
        //
        options.draw( progress );

        if (timeFraction < 1) {
            raf = requestAnimationFrame( animate );
        } else {
            callback && callback.constructor === Function && callback();
        }



    }
}

/*
mapleAnimateProcessor({
    duration: 1000,
    draw: function( x, progress ) {
        var persent = progress;
        element.style.transform = "scale(" + persent + ")";
    }.bind( null, 1 ),
    timing: function( timeFraction ) {
        var progress = 1 - timeFraction;
        return progress > 0.5 ? progress : 0.5 ;
    }
});
*/
