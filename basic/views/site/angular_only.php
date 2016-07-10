<div ng-controller="AppCore" style="padding:20px 40px;">

    <div ng-hide="isLoading" orderBy="id" ng-system></div>

    <pre style="padding:7px 14px;border:1px solid #e7e7e7;font-size: 17px;">
        {{log | json}}
    </pre>

    <!--
    <div data-qwerty="qwerty" ng-maple="directive_name">
        <div data-qwerty="qwerty" ng-maple="directive_name"></div>
    </div>
    -->

</div>