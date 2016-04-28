(function () {
    "use strict";
    
    fr_1.addEventListener('transitionend', function(e) {
        console.warn('transitionend', e);
    });

    var token = document.querySelector('meta[name="csrf-token"]');

    var checked = [];
    var inputs_checkbox = document.querySelectorAll('.fr_1_ch');
    table_layout.addEventListener('change', function (e) {
        
        var value = e.target.value,
            position = checked.indexOf(value),
            condition = e.target.checked;

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
             e.target.parentNode.parentNode.classList.toggle('active', condition);
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
        table_layout.classList.add('load');
        request_list(function () {
            table_layout.classList.remove('load');
            fr_1_tbody.appendChild(html_fragment());
        });
    }, false);
    
    fr_1_btn_add.addEventListener('click', function (e) {
        console.warn('fr_1_btn_add');
    }, false);
    
    /*
    frame_from_cancel.addEventListener('click', function(e) {
        qf_fG_15.classList.remove('show');
    });
    */
    
    fr_1_btn_edit.addEventListener('click', function (e) {
        var item = find_data_item();
        var access_fields = ['name', 'description', 'path'];
        qf_fG_15.classList.add('show');
        var form = compile_form();
        for (var prop in item) {
            if (~access_fields.indexOf(prop)) {
                form.appendChild(compile_input(item[prop]));
            }
        }
        form.appendChild(compile_btns());
        form_container.appendChild(form);
        console.warn('fr_1_btn_edit', item);
    }, false);

    function html_fragment(arr) {
        var frames = JSON.parse(window.sessionStorage.getItem('mi_frames')),
            docfragment = document.createDocumentFragment();
        inputs_checkbox = [];
        frames.forEach(function (item, index) {
            var compile_row = compile_html_row(item);
            inputs_checkbox.push(compile_row.querySelector('input'));
            docfragment.appendChild(compile_row);
        });
        return docfragment;
    }
    
    function find_data_item() {
        var result = null;
        if (checked.length === 1) {
            var frames = JSON.parse(window.sessionStorage.getItem('mi_frames')), id = checked[0];
            frames.forEach(function (item) {
                if (item.id === id) {
                    result = item;
                }
            });
        }
        return result;
    }
    
    function compile_btns() {
        var container = document.createElement('div');
        container.classList.add('Mi_element_layout', 'Mi_btnGroup', 'Mi_submitGroup');
        container.setAttribute('style', 'margin-top:40px;padding:0;margin-bottom:0;');
        container.innerHTML = [
            '<input action="submit" class="Mi_btn" value="create" type="submit">',
            '<button action="reset" class="Mi_btn" id="frame_from_reset">reset</button>',
            '<button action="cancel" class="Mi_btn" id="frame_from_cancel">cancel</button>'
        ].join('');
        return container;
    }
    
    function compile_form() {
        var container = document.createElement('div');
        container.classList.add('Mi_form', 'Gi_no_padding');
        container.id = 'frame_form';
        console.log('compile_form :: ', container);
        
        container.addEventListener('click', function (e) {
            var action = e.target.getAttribute('action');
            console.warn(action);
            switch (action) {
                case 'submit':
                    
                    break;
                case 'reset':
                    
                    break;
                case 'cancel':
                    qf_fG_15.classList.remove('show');
                    break;
            }

        }, false);
        
        return container;
        
    }
    
    function compile_input(value) {
        var container = document.createElement('div');
        container.classList.add('Mi_element_layout', 'Gi_no_padding');
        container.innerHTML = [
            '<div class="Mi_input_layout">',
            '<div class="Mi_input_clear"></div>',
            '<input value="' + value + '" class="Mi_input Mi_input_text" autocomplete="off" id="frame_name" name="frame_name" type="text">',
            '</div>',
            '<label class="Mi_label" for="frame_name">frame_name</label>',
        ].join('');
        return container;
    }

    function compile_html_row(row_data) {
        var row = document.createElement('tr'),
            raw_inner_html = [
                '<td class="Mi_table__cell">',
                '<input value="' + row_data.id + '" class="fr_1_ch Gi_tac" type="checkbox" />',
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