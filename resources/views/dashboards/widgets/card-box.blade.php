{{-- Card Box Widget --}}
<div class="row">
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>
    
    <div class="col-xs-12">
        {{-- Card Box Inventory --}}
        <div class="info-box bg-black">
            <span class="info-box-icon bg-black">
                <i class="ion ion-android-laptop"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Web Visitor</span>
                <span class="info-box-number">Visitors Count: {{ count($visitors) }}</span>
                <span class="info-box-number">Visitors Hits: {{ $visitors->sum('hits') }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        {{-- Card Box Inventory --}}
        <div class="info-box bg-black">
            <span class="info-box-icon bg-black">
                <i class="ion ion-ios-lightbulb-outline"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Inventory</span>
                <span class="info-box-number">{{ $stockAmount }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        {{-- Card Box Order --}}
        <div class="info-box bg-black">
            <span class="info-box-icon">
                <i class="ion ion-ios-pricetag-outline"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Order</span>
                <span class="info-box-number">{{ $orderAmount }}</span>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6 col-xs-12">
        {{-- Card Box Staff --}}
        <div class="info-box bg-black">
            <span class="info-box-icon">
                <i class="ion ion-ios-person"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Staff</span>
                <span class="info-box-number">{{ $staffAmount }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        {{-- Card Box Member --}}
        <div class="info-box bg-black">
            <span class="info-box-icon">
                <i class="ion ion-ios-people-outline"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <span class="info-box-number">{{ $userAmount }}</span>
            </div>
        </div>
    </div>
</div>