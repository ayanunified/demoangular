(function () {
    'use strict';
    app.directive('responsiveTabsDirective', function () {
        return {
            scope:{},
            templateUrl: 'views/responsiveTabs.template.html',
            controller: 'responsiveTabsController'
        };
    });
})();