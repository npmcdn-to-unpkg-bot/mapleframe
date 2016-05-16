"use strict";

var btn = document.getElementById('btn1');
btn.addEventListener('click', function (e) {
    e.preventDefault();
    var promise = new Promise(function (resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://mapleframe.ru/site/test.html', true);
        xhr.addEventListener('load', function (e) {
            switch(xhr.status) {
                case 200:
                    resolve(xhr.response);
                    break;
                case 404:
                    reject(new Error("Not found"));
                    break;
                case 500:
                    reject(new Error("500"));
                    break;
            }
        });
        xhr.addEventListener('error', function () {
            reject(new Error("Network Error"));
        });
        xhr.send();
    });
    
    promise
        .then(JSON.parse, function(e){ console.log(e); })
        .then(function(response){console.log("response", response);});
   
    
});

