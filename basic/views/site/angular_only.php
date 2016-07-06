<div ng-controller="AppCore" style="padding:20px 40px;">
    <h1 class="MiG__t">Template: <?php echo __FILE__; ?></h1>

    <div>
        <div style="padding:8px;">
            Hello <input style="width:500px;padding:4px 8px;" ng-model='name'>
        </div>
        <hr/>
        <div style="padding:8px;" ng-bind="name"></div>
        <div style="padding:8px;" ng:bind="name"></div>
        <div style="padding:8px;" ng_bind="name"></div>
        <div style="padding:8px;" data-ng-bind="name"></div>
        <div style="padding:8px;" x-ng-bind="name"></div>

        <div style="padding:8px;background:rgba(255,255,255,.1);">
            <div>{{ person.name }}</div>
            <div ng-bind="person.email"></div>
        </div>
    </div>

</div>