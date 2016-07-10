if (!('log' in window)) {
    window.log = function() {
        console.log( Number( (performance.now()).toPrecision(5) ), arguments );
    }
}
if (!('warn' in window)) {
    window.warn = function() {
        console.warn( Number( (performance.now()).toPrecision(5) ), arguments );
    }
}