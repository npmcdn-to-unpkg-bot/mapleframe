(function () {
    "use strict";

    function Mi_crud(params) {
        this.data_checked_fields = [];
        this.params = null;
        this.frame_container = null;
        this.table = null;
        this.form_container = null;
        this.form_section = null;
        this.table_section = null;
        this.found_elements = [];
        this.table_inputs = [];
        this.crud_control_btns = {};
        this.inner_check_params(params)
            .inner_set_params(params)
            .find_frame_container()
            .find_table()
            .find_form_container()
            .find_form_section()
            .find_table_section()
            .find_crud_control_btns()
            .listen_form_container()
            .listen_table_container();
    }

    Mi_crud.prototype = Object.create(Object.prototype);
    Object.defineProperties(Mi_crud.prototype, {

        constructor: {
            value: Mi_crud
        },

        inner_check_params: {
            value: function(params) {
                return this;
            }
        },

        inner_set_params: {
            value: function(params) {
                this.params = params;
                return this;
            }
        },

        remember_toggle_this: {
            value: function(element, t) {
                var t = t || true;
                if(element) {
                    element.Mi_frame = (t) ? this : null;
                }
            }
        },

        remember_find_element: {
            value: function(element) {
                if(element) {
                    this.found_elements.push(element);
                }
            }
        },

        find_frame_container: {
            value: function() {
                var elem = document.getElementById(
                    this.params.frame_container
                );
                this.frame_container = elem;
                this.remember_toggle_this(elem, true);
                this.remember_find_element(elem);
                return this;
            }
        },

        find_form_section: {
            value: function() {
                var elem = this.query_selector('.Mi_form_section', 'frame_container', false);
                this.form_section = elem;
                this.remember_toggle_this(elem, true);
                this.remember_find_element(elem);
                return this;
            }
        },

        find_table_section: {
            value: function() {
                var elem = this.query_selector('.Mi_table_section', 'frame_container', false);
                this.table_section = elem;
                this.remember_toggle_this(elem, true);
                this.remember_find_element(elem);
                return this;
            }
        },

        find_table: {
            value: function() {
                var elem = this.query_selector('.Mi_table', 'frame_container', false);
                this.table = elem;
                this.remember_toggle_this(elem, true);
                this.remember_find_element(elem);
                return this;
            }
        },

        find_form_container: {
            value: function() {
                var elem = this.query_selector('.Mi_form_layout', 'frame_container', false);
                this.form_container = elem;
                this.remember_toggle_this(elem, true);
                this.remember_find_element(elem);
                return this;
            }
        },

        find_crud_control_btns: {
            value: function() {
                var i = 0, item = null,
                    btns = this.query_selector('.Mi_btn_hcc', 'frame_container', true);
                for(i; i < btns.length; i = i + 1) {
                    item = btns[i];
                    this.remember_toggle_this(item, true);
                    this.crud_control_btns[item.getAttribute('action')] = item;
                }
                return this;
            }
        },

        listen_table_container: {
            value: function() {
                this.table_section.addEventListener('change', function(e) {
                    var value = e.target.value,
                        position = this.Mi_frame.data_checked_fields.indexOf(value),
                        condition = e.target.checked;
                    if (value === 'all') {
                        /*for (var i = 0; i < this.Mi_frame.data_checked_fields.length; i = i + 1) {
                            var item = this.Mi_frame.data_checked_fields[i];
                            item.checked = condition;
                            item.parentNode.parentNode.classList.toggle('active', condition);
                            if (condition) {
                                this.Mi_frame.data_checked_fields.push(item.value);
                            }
                        }
                        if (condition === false) {
                            this.Mi_frame.data_checked_fields = [];
                        }*/
                    } else {
                        e.target.parentNode.parentNode.classList.toggle('active', condition);
                        (~position)
                            ? this.Mi_frame.data_checked_fields.splice(position, 1)
                            : this.Mi_frame.data_checked_fields.push(e.target.value);
                        //fr_1_all.checked = (checked.length === inputs_checkbox.length);
                    }
                    this.Mi_frame.condition_control_btns();
                });
                this.table_section.addEventListener('click', function(e) {
                    if(e.target.classList.contains('Mi_btn')) {
                        var action = e.target.getAttribute('action');
                        switch(action) {
                            case 'response':
                                this.Mi_frame.data_checked_fields = [];
                                this.Mi_frame.query_selector('tbody', 'table', false).innerHTML = '';
                                this.Mi_frame.table.parentNode.classList.add('load');
                                this.Mi_frame.request_data_frames(function(request){
                                    setTimeout(function(){
                                        request.Mi_frame.condition_control_btns();
                                        request.Mi_frame.table.parentNode.classList.remove('load');
                                        request.Mi_frame.query_selector('tbody', 'table', false).appendChild(
                                            request.Mi_frame.compile_html_fragment()
                                        );
                                    }, 500);
                                });
                                break;
                            case 'create':
                                if(this.Mi_frame.inner_isset_form()) {
                                    var item = this.Mi_frame.request_storage_clear_frame();
                                    access_fields = this.Mi_frame.request_storage_access_fields();
                                    this.Mi_frame.condition_toggle_form(true);
                                    var form = this.Mi_frame.compile_form();
                                    for (var prop in item) {
                                        if (~access_fields.indexOf(prop)) {
                                            if(prop === 'status') {
                                                form.appendChild(this.Mi_frame.compile_input_checkbox(prop, item[prop]));
                                            } else {
                                                form.appendChild(this.Mi_frame.compile_input(prop, item[prop]));
                                            }
                                        }
                                    }
                                    this.Mi_frame.form_container.appendChild(form);
                                }
                                break;
                            case 'edit':
                                if(this.Mi_frame.inner_isset_form()) {
                                    var item = this.Mi_frame.request_storage_frame(),
                                    access_fields = ['id', 'name', 'description', 'path', 'status'];
                                    this.Mi_frame.condition_toggle_form(true);
                                    var form = this.Mi_frame.compile_form();
                                    for (var prop in item) {
                                        if (~access_fields.indexOf(prop)) {
                                            if(prop === 'status') {
                                                form.appendChild(this.Mi_frame.compile_input_checkbox(prop, item[prop]));
                                            } else {
                                                form.appendChild(this.Mi_frame.compile_input(prop, item[prop]));
                                            }
                                        }
                                    }
                                    this.Mi_frame.form_container.appendChild(form);
                                }
                                break;
                            case 'delete':
                                break;
                        }
                    }
                });
            }
        },

        inner_isset_form: {
            value: function() {
                var result = this.query_selector('.Mi_form', 'form_section', false);
                return (result === null);
            }
        },

        listen_form_container: {
            value: function() {
                this.form_section.addEventListener('transitionend', function(e){
                    var form = e.target.Mi_frame.query_selector('.Mi_form', e.target, false);
                    if(e.target.classList.contains('show') === false) {
                        form.parentNode.removeChild(form);
                    }
                });
                this.form_section.addEventListener('click', function(e){
                    if(e.target.classList.contains('Mi_btn')) {
                        var action = e.target.getAttribute('action');
                        switch (action) {
                            case 'submit':
                                this.Mi_frame.request_data_submit();
                                break;
                            case 'reset':
                                break;
                            case 'cancel':
                                this.Mi_frame.condition_toggle_form(false);
                                break;
                        }
                    }
                });
                return this;
            }
        },

        condition_toggle_form: {
            value: function(condition) {
                (condition)
                    ? this.form_section.classList.add('show')
                    : this.form_section.classList.remove('show');
                return this;
            }
        },

        serialize_data_row: {
            value: function() {
                var r = {}, i = 0, item = null, field = null,
                    elems = this.query_selector('input, textarea', 'form_container', true);
                for(i = 0; i < elems.length; i = i + 1) {
                    item = elems[i];
                    field = item.getAttribute('field');
                    switch(item.type) {
                        case 'text':
                            r[field] = item.value;
                            break;
                        case 'checkbox':
                            r[field] = item.checked;
                            break;
                    }
                }
                console.log('serialize_data_row', r);
                return r;
            }
        },

        condition_control_btns: {
            value: function() {
                switch (this.data_checked_fields.length) {
                    case 0:
                        this.crud_control_btns.create.removeAttribute('disabled');
                        this.crud_control_btns.edit.setAttribute('disabled', 'disabled');
                        this.crud_control_btns.delete.setAttribute('disabled', 'disabled');
                        break;
                    case 1:
                        this.crud_control_btns.create.setAttribute('disabled', 'disabled');
                        this.crud_control_btns.edit.removeAttribute('disabled');
                        this.crud_control_btns.delete.removeAttribute('disabled');
                        break;
                    default:
                        this.crud_control_btns.create.setAttribute('disabled', 'disabled');
                        this.crud_control_btns.edit.setAttribute('disabled','disabled');
                        this.crud_control_btns.delete.removeAttribute('disabled');
                        break;
                }
            }
        },

        query_selector: {
            value: function(selector, container, all) {
                var result = null,
                    container = (container.constructor === String)
                        ? this[container]
                        : container ;
                if(arguments.length === 3) {
                    result = (all)
                        ? container.querySelectorAll(selector)
                        : container.querySelector(selector);
                } else {
                    throw new Error('query_selector, arguments length');
                }
                return result;
            }
        },

        update_row_in_table: {
            value: function(row_data) {
                var tbody = null,
                    input = null,
                    new_row = this.compile_html_row(row_data),
                    old_row = this.query_selector(
                        '.row_'.concat(row_data.id),
                        'table_section',
                        false
                    );
                if(old_row !== null) {
                    this.table_inputs = this.table_inputs.filter(function(item) {
                        return (Number(item.value) !== Number(row_data.id));
                    });
                    input = this.query_selector('input', new_row, false);
                    if(input !== null) {
                        this.table_inputs.push(input);
                        this.condition_control_btns();
                    }
                    tbody = this.query_selector('tbody', 'table', false);
                    tbody.replaceChild(
                        new_row, old_row
                    );
                }
                return this;
            }
        },

        update_property_checked_fields: {
            value: function() {
                this.data_checked_fields = [];
                return this;
            }
        },

        update_row_in_storage: {
            value: function(row_data) {
                var data = this.request_storage_get_frames();
                data = data.filter(function(item){
                    return (Number(item.id) !== Number(row_data.id));
                });
                data.push(row_data);
                this.request_storage_set_frames(data);
                return this;
            }
        },

        request_data_submit: {
            value: function(callback) {
                var request = new XMLHttpRequest();
                request.Mi_frame = this;
                request.timeout = 30000;
                request.addEventListener('readystatechange', function (e) {
                    if (request.readyState === 4 && request.status === 200) {
                        var response = JSON.parse(request.responseText), row = null;
                        if('success' in response) {
                            request.Mi_frame.update_row_in_table(response.data)
                                            .update_property_checked_fields()
                                            .update_row_in_storage(response.data);
                            request.Mi_frame.condition_toggle_form(false);
                            request.Mi_frame.condition_control_btns();
                        }
                        if('errors' in response) {
                            console.warn('errors');
                            console.log(response.errors);
                        }
                    }
                }, false);
                request.addEventListener('error', function (e) {
                    console.error(request.responseText);
                });
                request.addEventListener('timeout', function (e) {
                    console.warn('timeout');
                });
                request.open('POST', 'http://mapleframe.ru/site/frames2.html');
                request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                request.setRequestHeader("X-CSRF-TOKEN", token.content);
                request.send(
                    JSON.stringify(request.Mi_frame.serialize_data_row())
                );
            }
        },

        request_storage_access_fields: {
            value: function() {
                return ['id', 'name', 'description', 'path', 'status'];
            }
        },

        request_storage_clear_frame: {
            value: function() {
                return {
                    id: 0,
                    status: 1,
                    name: '',
                    description: '',
                    path: ''
                };
            }
        },

        request_storage_frame: {
            value: function() {
                var result = null;
                if (this.data_checked_fields.length === 1) {
                    var frames = this.request_storage_get_frames(),
                        id = this.data_checked_fields[0];
                    frames.forEach(function (item) {
                        if (Number(item.id) === Number(id)) {
                            result = item;
                        }
                    });
                }
                return result;
            }
        },

        request_data_frames: {
            value: function(callback) {
                var request = new XMLHttpRequest();
                request.Mi_frame = this;
                request.timeout = 30000;
                request.addEventListener('readystatechange', function (e) {
                    if (request.readyState === 4 && request.status === 200) {
                        window.sessionStorage.setItem('mi_frames', request.responseText);
                        if (callback && callback.constructor === Function) {
                            callback(this);
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
        },

        request_storage_get_frames: {
            value: function() {
                return JSON.parse(
                    window.sessionStorage.getItem('mi_frames')
                );
            }
        },

        request_storage_set_frames: {
            value: function(data) {
                if(data.constructor === Object || Array.isArray(data)) {
                    window.sessionStorage.setItem('mi_frames', JSON.stringify(data))
                } else {
                    throw new Error('request_storage_set_frames. Write is fail.');
                }
            }
        },

        compile_input: {
            value: function(property, value) {
                var container = document.createElement('div');
                container.classList.add('Mi_element_layout', 'Gi_no_padding');
                container.innerHTML = [
                    '<div class="Mi_input_layout">',
                    '<div class="Mi_input_clear"></div>',
                    '<input field="' + property + '" value="' + value + '" class="Mi_input Mi_input_text" autocomplete="off" id="frame_name" name="frame_name" type="text">',
                    '</div>',
                    '<label class="Mi_label" for="frame_name">' + property + '</label>',
                ].join('');
                return container;
            }
        },

        compile_input_checkbox: {
            value: function(property, value) {
                var container = compile_html_element('div', {
                    classList:['Mi_element_layout', 'Gi_no_padding']
                }),
                input_layout = compile_html_element('div', {
                    classList:['Mi_input_layout']
                }),
                clear_btn = compile_html_element('div', {
                    classList:['Mi_input_clear']
                }),
                label = compile_html_element('label', {
                    classList:['Mi_label']
                }, property),
                input = compile_html_element('input', {
                    classList:['Mi_input', 'Mi_input_text'],
                    field: property,
                    type: 'checkbox'
                });
                input.checked = (Number(value) === 1);
                console.log(input);
                input_layout.appendChild(clear_btn);
                input_layout.appendChild(input);
                input_layout.appendChild(label);
                container.appendChild(input_layout);
                return container;
            }

        },

        compile_form: {
            value: function() {
                var container = document.createElement('div');
                container.classList.add('Mi_form', 'Gi_no_padding');
                container.id = 'frame_form';
                return container;
            }
        },

        compile_html_fragment: {
            value: function() {
                var compile_row = null,
                    frames = this.request_storage_get_frames(),
                    docfragment = document.createDocumentFragment();
                frames.forEach(function (item, index) {
                    compile_row = this.compile_html_row(item);
                    this.table_inputs.push(this.query_selector('input', compile_row, false));
                    docfragment.appendChild(compile_row);
                }, this);
                return docfragment;
            }
        },

        compile_html_row: {
            value: function(row_data) {
                var row = document.createElement('tr'),
                    raw_inner_html = [
                        '<td class="Mi_table__cell Gi_tac">',
                        '<input value="' + row_data.id + '" class="fr_1_ch Gi_tac" type="checkbox" />',
                        '<td class="Mi_table__cell">',
                        '<span>' + row_data.name + '</span>',
                        '</td>'
                    ];
                row.classList.add('Mi_table__row', 'Mi_table__row_data', 'row_'.concat(row_data.id));
                row.innerHTML = raw_inner_html.join('');
                return row;
            }
        }

    });

    var exemplar = new Mi_crud({
        frame_container: 'fr_1'
    });

    var token = document.querySelector('meta[name="csrf-token"]');

    function compile_html_element(element_type, element_attrs, content) {
        var elem = document.createElement(element_type),
            content = (arguments.length === 2) ? '' : content;
        compile_attributes(elem, element_attrs);
        elem.innerHTML = content;
        return elem;
    }

    function compile_attributes(elem, attrs) {
        if(attrs.constructor === Object) {
            var prop = null;
            for(prop in attrs) {
                switch(prop) {
                    case 'classList':
                        attrs[prop].forEach(function(item){
                            elem.classList.add(item);
                        });
                        break;
                    case 'id':
                        elem.id = attrs[prop];
                        break;
                    default:
                        elem.setAttribute(prop, attrs[prop]);
                        break;
                }
            }
        } else {
            throw new Error('Compile_attributes');
        }
    }

})();