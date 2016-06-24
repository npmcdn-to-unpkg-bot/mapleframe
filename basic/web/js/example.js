// spec.js
describe('Protractor Demo App', function () {

    browser.get('http://mapleframe.ru/site/angular');

    /*it('should have a title', function () {
        expect(browser.getTitle()).toEqual('Super Calculator');
    });*/

    it('Получить значение поля name объекта person', function() {
        element(by.partialLinkText('Qw1')).isPresent().then(function(a) {

        });
    });

    it('Получить значение поля name объекта person', function() {
        var span2 = element(by.binding('person.email')).getText().then(function(name) {
            expect(name).toBe('Foo@mail.ru');
        });
    });

    it('Получить значение поля name объекта person', function() {
        var span2 = element(by.binding('person.email')).getText().then(function(name) {
            expect(name).toBe('Foo@mail.ru');
        });
    });

    /*
    it('Получить значение поля бла бла бла', function() {
        var qwerty = element(by.partialLinkText('Qwe'));
        expect( qwerty.getText() ).toBe('Qwe');
    });
    */

    /*
    it('should show off bindings', function () {
        var containerElm = element(by.css('div[ng-controller="AppCore"]'));
        var nameBindings = containerElm.all(by.binding('name'));
        expect(nameBindings.count()).toBe(5);
        nameBindings.each(function (elem) {
            expect(elem.getText()).toEqual('Max Karl Ernst Ludwig Planck (April 23, 1858 – October 4, 1947)');
        });
    });
    */

});