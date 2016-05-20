"use strick";

console.log('local worker created');

self.onmessage = function(e) {
    console.warn( performance.now() );
    console.log('Это локальный поток. Сообщение получено. Отправляю ответ.' );
    self.postMessage('Ответ на сообщение глобального потока');
}