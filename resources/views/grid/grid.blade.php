<div ng-repeat="batch in content" class="container main-content">
    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-1']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-1']"              class="box-item product-box">
            @include('grid.product')
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-2']">
            @include('grid.idea')
        </div>

    </div>

    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-3']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-3']"
             class="box-item product-box">
            @include('grid.product')
        </div>
    </div>

    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-4']">
            @include('grid.idea')
        </div>

    </div>

    <div class="grid-box-3">
        <div class="box-item idea-box" ng-if="item.type == 'idea'" ng-repeat="item in batch['row-5']">
            @include('grid.idea')
        </div>

        <div ng-if="item.type == 'product'" ng-repeat="item in batch['row-5']"
             class="box-item product-box">
            @include('grid.product')
        </div>
    </div>


    <div class="grid-box-full">
        <div class="box-item idea-box box-item--featured" ng-if="item.type == 'idea'"
             ng-repeat="item in batch['row-6']">
            @include('grid.idea')
        </div>

    </div>

</div>