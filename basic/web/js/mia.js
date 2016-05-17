"use strict";

var width = document.body.offsetWidth;
var old_width = document.body.offsetWidth;

var naviq = navi.querySelectorAll('.Mia_navi__elem');

var active_index = 0;
navi.addEventListener('click', function(e) {
    if(!e.target.classList.contains('emblem')) {
        active_index = Number( e.target.getAttribute('data-index') );
        for( var i = 0; i < naviq.length; i = i + 1 ) {
            naviq[i].classList.remove('active');
        }
        e.target.classList.add('active');
        wrapper.scrollLeft = active_index * width;
    }
});

window.addEventListener('resize', function(e) {
    width = document.body.offsetWidth;
    wrapper.scrollLeft = (width * active_index);
});


