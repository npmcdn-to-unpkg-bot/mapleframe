(function(){
    "use strict";
    
    var token = document.querySelector('meta[name="csrf-token"]');
    
    console.info("frames.crud core script called");
    fr_1_btn_data.addEventListener('click', function(e){
        console.warn('fr_1_btn_data');
        table_layout.classList.add('load');
        request_list(function(){
            table_layout.classList.remove('load');
            fr_1_tbody.appendChild(html_fragment());
        });
    }, false);
    fr_1_btn_add.addEventListener('click', function(e){
        console.warn('fr_1_btn_add');
    }, false);
    fr_1_btn_edit.addEventListener('click', function(e){
        console.warn('fr_1_btn_edit');
    }, false);
    
    function html_fragment(arr) {
        var frames = JSON.parse( window.sessionStorage.getItem('mi_frames') ),
            docfragment = document.createDocumentFragment();
        frames.forEach(function(item, index){
            docfragment.appendChild(html_row(item));
        });
        return docfragment;
    }
    
    function html_row(row_data) {
        var row = document.createElement('tr'),
            raw_inner_html = [
                '<td class="Mi_table__cell">',
                '<input type="checkbox" />',
                '<td class="Mi_table__cell">',
                '<span>',
                row_data.name,
                '</span>',
                '</td>'
            ];
            
        row.classList.add('Mi_table__row');
        row.innerHTML = raw_inner_html.join('');
        return row;
    }
        
    function request_list(callback) {
        var request = new XMLHttpRequest();
        request.timeout = 30000;
        request.addEventListener('readystatechange', function(e){
            if( request.readyState === 3 ) {
                console.log('3. ', request.responseText);
            }
            if( request.readyState === 4 && request.status === 200 ) {
                console.log('4. ');
                window.sessionStorage.setItem('mi_frames', request.responseText);
                if( callback && callback.constructor === Function ) {
                    callback();
                }
            }
        }, false);
        request.addEventListener('error', function(e){
            console.error(request.responseText);
        });
        request.addEventListener('timeout', function(e){
            console.warn('timeout');
        });
        request.open('POST', 'http://mapleframe.ru/site/frames.html');
        request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        request.setRequestHeader("X-CSRF-TOKEN", token.content);
        request.send();
    }
})();