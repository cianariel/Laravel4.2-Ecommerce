
    <div class="grid-box-3">
        <div ng-if="item.type == 'idea'" ng-repeat="item in content['row-1']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in content['row-1']" class="box-item product-box">
            @include('grid.product')
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in content['row-2']">
            @include('grid.idea')
        </div>

    </div>

    <div class="grid-box-3">
        <div ng-if="item.type == 'idea'" ng-repeat="item in content['row-1']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in content['row-1']" class="box-item product-box">
            @include('grid.product')
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in content['row-4']">
            @include('grid.idea')
        </div>

    </div>

    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in content['row-5']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in content['row-5']" class="box-item product-box">
            @include('grid.product')
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'" ng-repeat="item in content['row-6']">
            @include('grid.idea')
        </div>

    </div>

