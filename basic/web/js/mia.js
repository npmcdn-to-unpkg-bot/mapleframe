"use strict";

var width = document.body.offsetWidth;

var uncompleted_path = 0; // appears if animation stopped
var active_index = 0; // Next expected active page
var raf = null; // R_equest A_nimation F_ragment
var animation_active = false;
const BASE_ANIMATION_DURATION = 250;

var navi_MC = {
    html_collection: navi.querySelectorAll('.Mia_navi__elem'),
    clear_active_condition: function() {
        for( var i = 0; i < this.html_collection.length; i = i + 1 ) {
            this.html_collection[i].classList.remove('active');
        }
    }
};

navi.addEventListener('click', function(e) {
    if(e.target.classList.contains('Mia_navi__elem')) {
        if(!e.target.classList.contains('emblem')) {
            cancelAnimationFrame( raf );
            var current_index = Number( e.target.getAttribute('data-index') ), expected_length_path = 0;
            animation_active = (current_index === active_index) ? !animation_active : true ;
            if( animation_active ) {
                uncompleted_path = (active_index * width) - wrapper.scrollLeft;
                expected_length_path = ((current_index - active_index) * width) + uncompleted_path;
                if( expected_length_path !== 0 ) {
                    active_index = current_index;
                    navi_MC.clear_active_condition();
                    e.target.classList.add('active');
                    var start_scroll_position = wrapper.scrollLeft;
                    var duration = dinamic_duration( width, expected_length_path );
                    
                    mapleAnimateProcessor({
                        duration: duration,
                        draw: function( progress ) {
                            var parh = ~~(start_scroll_position + (expected_length_path * progress));
                            wrapper.scrollLeft = parh;
                        },
                        timing: linear
                    }, function(){
                        animation_active = false;
                        content_loading();
                        console.warn('animation is complete', raf);
                    });
                    
                }
            }
        }
    }
    
    function dinamic_duration(width, path_length) {
        return Math.abs(path_length) < width 
            ? ~~(Math.abs(path_length / width) * BASE_ANIMATION_DURATION) 
            : BASE_ANIMATION_DURATION;
    }

});

/*
window.onmessage = function(e) {
    console.log('window.onmessage :: ', e.data);
}

var worker = null;
var local_worker = new window.Worker('/js/local.worker.js');

local_worker.addEventListener('message', function(e) {
    console.warn( performance.now() );
    console.log( 'Это глобальный поток. Обработанные данные получены.' );
});

_piw.addEventListener('click', function(e) {
    console.warn( performance.now() );
    console.log( 'Локальный поток, прием. Нужны данные.' );
    local_worker.postMessage('[Данные]');
    e.preventDefault();
});*/

var flag = true;
function content_loading() {
    console.log( "active_index :: ", active_index );
}

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
        var progress = options.timing( timeFraction );
        options.draw( progress );
        if (timeFraction < 1) {
            raf = requestAnimationFrame( animate );
        } else {
            callback && callback.constructor === Function && callback();
        }
    }
}