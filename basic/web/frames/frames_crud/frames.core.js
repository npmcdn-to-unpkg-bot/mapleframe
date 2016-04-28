(function () {
    "use strict";

    var token = document.querySelector('meta[name="csrf-token"]');

    var checked = [];
    var inputs_checkbox = document.querySelectorAll('.fr_1_ch');
    table_layout.addEventListener('change', function (e) {
        
        var value = e.target.value,
            position = checked.indexOf(value),
            condition = e.target.checked;
        
        e.target.parentNode.parentNode.classList.toggle('active', condition);
        if (value === 'all') {
            for (var i = 0; i < inputs_checkbox.length; i = i + 1) {
                var item = inputs_checkbox[i];
                item.checked = condition;
                item.parentNode.parentNode.classList.toggle('active', condition);
                if (condition) {
                    checked.push(item.value);
                }
            }
            if (condition === false) {
                checked = [];
            }
        } else {
            (~position) ? checked.splice(position, 1) : checked.push(e.target.value);
            fr_1_all.checked = (checked.length === inputs_checkbox.length);
        }
        qw_di_Qw();
    });

    function qw_di_Qw() {
        switch (checked.length) {
            case 0:
                fr_1_btn_edit.setAttribute('disabled', 'disabled');
                fr_1_btn_delete.setAttribute('disabled', 'disabled');
                break;
            case 1:
                fr_1_btn_edit.removeAttribute('disabled');
                fr_1_btn_delete.removeAttribute('disabled');
                break;
            default:
                fr_1_btn_edit.setAttribute('disabled', 'disabled');
                fr_1_btn_delete.removeAttribute('disabled');
                break;
        }
    }

    fr_1_btn_data.addEventListener('click', function (e) {
        console.warn('fr_1_btn_data');
        table_layout.classList.add('load');
        request_list(function () {
            table_layout.classList.remove('load');
            fr_1_tbody.appendChild(html_fragment());
        });
    }, false);
    fr_1_btn_add.addEventListener('click', function (e) {
        console.warn('fr_1_btn_add');
    }, false);
    fr_1_btn_edit.addEventListener('click', function (e) {
        console.warn('fr_1_btn_edit');
    }, false);

    function html_fragment(arr) {
        var frames = JSON.parse(window.sessionStorage.getItem('mi_frames')),
            docfragment = document.createDocumentFragment();
        frames.forEach(function (item, index) {
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
        request.addEventListener('readystatechange', function (e) {
            if (request.readyState === 3) {
                console.log('3. ', request.responseText);
            }
            if (request.readyState === 4 && request.status === 200) {
                console.log('4. ');
                window.sessionStorage.setItem('mi_frames', request.responseText);
                if (callback && callback.constructor === Function) {
                    callback();
                }
            }
        }, false);
        request.addEventListener('error', function (e) {
            console.error(request.responseText);
        });
        request.addEventListener('timeout', function (e) {
            console.warn('timeout');
        });
        request.open('POST', 'http://mapleframe.ru/site/frames.html');
        request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        request.setRequestHeader("X-CSRF-TOKEN", token.content);
        request.send();
    }
})();