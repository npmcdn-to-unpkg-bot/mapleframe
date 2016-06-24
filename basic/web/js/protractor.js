exports.config = {
    seleniumAddress: 'http://localhost:4444/wd/hub',
    baseUrl: 'http://mapleframe.ru/site/angular',
    capabilities: {
        'browserName': 'chrome'
    },
    onPrepare: function() {},
    onCleanUp: function() {},
    specs: ['example.js'],
    rootElement: '[ng-app]',
    jasmineNodeOpts: {
        showColors: true
    },
    plugins: [{
	    package: 'protractor-console',
	    logLevels: ['severe']
  	}],
};