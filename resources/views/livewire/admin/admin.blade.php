@section('title')
Dashboard
@endsection

<div>
    <div class="mdc-layout-grid">
        @can('view dashboard')
        <div class="mdc-layout-grid__inner">

            @include('admin.dashboard.overview-card', ['key' => 'one', "label" => "Earning", "value" =>
            $totalEarning, "logo" => "attach_money", "tooltip" => "this month", "type" => "success"])

            @include('admin.dashboard.overview-card', ['key' => 'two', "label" => "Order delivered", "value" =>
            $totalOrder, "logo" => "check_circle", "tooltip" => "this month", "type" => "primary"])

            @include('admin.dashboard.overview-card', ['key' => 'third', "label" => "User cancel order", "value" =>
            $userCancelOrder, "logo" => "error", "tooltip" => "this month", "type" => "danger"])

            @include('admin.dashboard.overview-card', ['key' => 'third', "label" => "Pending payment", "value" =>
            $pendingPayment, "logo" => "warning", "tooltip" => "this month", "type" => "warning"])

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-2 mb-sm-0">Earning Statistics</h4>
                    </div>
                    <div class="chart-container mt-4">
                        <canvas id="earningChart" height="260"></canvas>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet">
                <div class="mdc-card">
                    <div class="d-flex d-lg-block d-xl-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Order Statistics</h4>
                        </div>
                        <div id="sales-legend" class="d-flex flex-wrap"></div>
                    </div>
                    <div class="chart-container mt-4">
                        <canvas id="chart-sales" height="260"></canvas>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card bg-success text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="font-weight-normal">Verified Users</h3>
                    </div>
                    <div class="mdc-layout-grid__inner align-items-center">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                            <div>
                                <h2 class="font-weight-normal mt-3 mb-0">{{ $totalUser }}</h2>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                            <canvas id="users-chart" height="90"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card bg-info text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="font-weight-normal">Product</h3>
                    </div>
                    <div class="mdc-layout-grid__inner align-items-center">
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                            <div>
                                <h2 class="font-weight-normal mt-3 mb-0">{{ $item }}</h2>
                            </div>
                        </div>
                        <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                            <canvas id="items-chart" height="90"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @else
        <p class="welcome-dashboard"> Welcome to dashboard</p>
        @endcan
    </div>
</div>

@can('view dashboard')
@section('extra-js')
<!-- Plugin js for this page-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.1/Chart.bundle.min.js" integrity="sha512-wVoQ4GYEbly/PY7wENb0GlmInwzciyNOYJdtmmHn7wJ7M/c0Y3QlsaG/NGYIENR+HD9C+3+KRLwXn8G+PED9/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- End plugin js for this page-->

<script>
    const ovrvLabels = [
        @foreach($months as $month)
        "{{ $month }}"
        , @endforeach
    ];
    const ovrvEarning = [
        @foreach($earnings as $earning)
        "{{ $earning }}"
        , @endforeach
    ];
    const ovrvOrders = [
        @foreach($orders as $order)
        "{{ $order }}"
        , @endforeach
    ];
    const ovrvDeliveredOrder = [
        @foreach($deliveredOrders as $deliveredOrder)
        "{{ $deliveredOrder }}"
        , @endforeach
    ];
    const ovrvCanceledOrder = [
        @foreach($canceledOrders as $canceledOrder)
        "{{ $canceledOrder }}"
        , @endforeach
    ];
    const ovrvUser = [
        @foreach($users as $user)
        "{{ $user }}"
        , @endforeach
    ];
    const ovrvItem = [
        @foreach($items as $item)
        "{{ $item }}"
        , @endforeach
    ];

    (function($) {
        "use strict";
        $(function() {
            //Earning Chart
            if ($("#earningChart").length) {
                var revenueChartCanvas = $("#earningChart").get(0).getContext("2d");
                // console.log(ovrvEarning);
                var revenueChart = new Chart(revenueChartCanvas, {
                    type: 'line'
                    , data: {
                        labels: ovrvLabels
                        , datasets: [{
                            data: ovrvEarning
                            , backgroundColor: "transparent"
                            , borderColor: "rgba(0, 128, 0, 0.75)"
                            , borderWidth: 3
                            , pointStyle: "circle"
                            , pointRadius: 5
                            , pointBorderColor: "rgba(0, 128, 0, 1)"
                            , pointBackgroundColor: "rgba(0, 128, 0, 0.6)"
                        , }]
                    }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: false
                        , scales: {
                            yAxes: [{
                                gridLines: {
                                    drawBorder: false
                                    , zeroLineColor: "rgba(0, 0, 0, 0.09)"
                                    , color: "rgba(0, 0, 0, 0.09)"
                                }
                                , ticks: {
                                    fontColor: '#bababa'
                                }
                            }]
                            , xAxes: [{
                                ticks: {
                                    fontColor: '#bababa'
                                    , beginAtZero: false
                                }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                }
                                , barPercentage: 0.5
                            }]
                        }
                        , legend: {
                            display: false
                        }
                    }
                });
            }

            //Sales Chart
            if ($("#chart-sales").length) {
                var salesChartCanvas = $("#chart-sales").get(0).getContext("2d");
                var gradient1 = salesChartCanvas.createLinearGradient(0, 0, 0, 230);
                gradient1.addColorStop(0, "#ffc107");
                gradient1.addColorStop(1, "rgba(255, 255, 255, 0)");

                var gradient2 = salesChartCanvas.createLinearGradient(0, 0, 0, 160);
                gradient2.addColorStop(0, "#1bbd88");
                gradient2.addColorStop(1, "rgba(255, 255, 255, 0)");

                var gradient3 = salesChartCanvas.createLinearGradient(0, 0, 0, 255);
                gradient3.addColorStop(0, "#ff420f");
                gradient3.addColorStop(1, "rgba(255, 255, 255, 0)");

                var salesChart = new Chart(salesChartCanvas, {
                    type: "line"
                    , data: {
                        labels: ovrvLabels
                        , datasets: [{
                                data: ovrvOrders
                                , backgroundColor: gradient1
                                , borderColor: ["#ffc107"]
                                , borderWidth: 3
                                , pointBorderColor: "#ffc107"
                                , pointBorderWidth: 8
                                , pointHoverBorderWidth: 9
                                , pointRadius: 1
                                , fill: "origin"
                            , }
                            , {
                                data: ovrvDeliveredOrder
                                , backgroundColor: gradient2
                                , borderColor: ["#00b67a"]
                                , borderWidth: 3
                                , pointBorderColor: "#00b67a"
                                , pointBorderWidth: 8
                                , pointHoverBorderWidth: 9
                                , pointRadius: 1
                                , fill: "origin"
                            , }
                            , {
                                data: ovrvCanceledOrder
                                , backgroundColor: gradient3
                                , borderColor: ["#ff420f"]
                                , borderWidth: 3
                                , pointBorderColor: "#ff420f"
                                , pointBorderWidth: 8
                                , pointHoverBorderWidth: 9
                                , pointRadius: 1
                                , fill: "origin"
                            , }
                        , ]
                    , }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: true
                        , plugins: {
                            filler: {
                                propagate: false
                            , }
                        , }
                        , scales: {
                            xAxes: [{
                                ticks: {
                                    fontColor: "#bababa"
                                , }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                , }
                            , }, ]
                            , yAxes: [{
                                ticks: {
                                    fontColor: "#bababa"
                                    , stepSize: 100
                                , }
                                , gridLines: {
                                    drawBorder: false
                                    , color: "rgba(101, 103, 119, 0.21)"
                                    , zeroLineColor: "rgba(101, 103, 119, 0.21)"
                                , }
                            , }, ]
                        , }
                        , legend: {
                            display: false
                        , }
                        , tooltips: {
                            enabled: true
                        , }
                        , elements: {
                            line: {
                                tension: 0
                            , }
                        , }
                        , legendCallback: function(chart) {
                            var text = [];
                            text.push("<div>");
                            text.push('<div class="d-flex align-items-center">');
                            text.push(
                                '<span class="bullet-rounded border-0 p-1" style="background-color: ' +
                                chart.data.datasets[0].borderColor[0] +
                                ' "></span>'
                            );
                            text.push(
                                '<p class="tx-12 text-muted mb-0 ml-2">Order</p>'
                            );
                            text.push("</div>");
                            text.push('<div class="d-flex align-items-center">');
                            text.push(
                                '<span class="bullet-rounded border-0 p-1" style="background-color: ' +
                                chart.data.datasets[1].borderColor[0] +
                                ' "></span>'
                            );
                            text.push(
                                '<p class="tx-12 text-muted mb-0 ml-2">Delivered</p>'
                            );
                            text.push("</div>");
                            text.push('<div class="d-flex align-items-center">');
                            text.push(
                                '<span class="bullet-rounded border-0 p-1" style="background-color: ' +
                                chart.data.datasets[2].borderColor[0] +
                                ' "></span>'
                            );
                            text.push(
                                '<p class="tx-12 text-muted mb-0 ml-2">Canceled</p>'
                            );
                            text.push("</div>");
                            text.push("</div>");
                            return text.join("");
                        }
                    , }
                , });
                document.getElementById(
                    "sales-legend"
                ).innerHTML = salesChart.generateLegend();
            }

            //Users Chart
            if ($("#users-chart").length) {
                var impressionsChartCanvas = $("#users-chart")
                    .get(0)
                    .getContext("2d");
                var impressionChart = new Chart(impressionsChartCanvas, {
                    type: "line"
                    , data: {
                        labels: ovrvLabels
                        , datasets: [{
                            data: ovrvUser
                            , fill: false
                            , borderColor: ["#ffffff"]
                            , borderWidth: 1
                            , pointBorderColor: "#ffffff"
                            , pointBorderWidth: 5
                            , pointRadius: [1, 0, 0, 0, 0, 0, 0, 0, 1]
                            , label: "online"
                        , }, ]
                    , }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: true
                        , layout: {
                            padding: {
                                left: 0
                                , right: 10
                                , top: 0
                                , bottom: 0
                            , }
                        , }
                        , plugins: {
                            filler: {
                                propagate: false
                            , }
                        , }
                        , scales: {
                            xAxes: [{
                                ticks: {
                                    display: false
                                    , fontColor: "#6c7293"
                                , }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                    , color: "rgba(101, 103, 119, 0.21)"
                                , }
                            , }, ]
                            , yAxes: [{
                                ticks: {
                                    display: false
                                    , fontColor: "#6c7293"
                                , }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                    , color: "rgba(101, 103, 119, 0.21)"
                                , }
                            , }, ]
                        , }
                        , legend: {
                            display: false
                        , }
                        , tooltips: {
                            enabled: true
                        , }
                        , elements: {
                            line: {
                                tension: 0
                            , }
                        , }
                    , }
                , });
            }

            //Items Chart
            if ($("#items-chart").length) {
                var trafficChartCanvas = $("#items-chart")
                    .get(0)
                    .getContext("2d");
                var trafficChart = new Chart(trafficChartCanvas, {
                    type: "line"
                    , data: {
                        labels: ovrvLabels
                        , datasets: [{
                            data: ovrvItem
                            , fill: false
                            , borderColor: ["#ffffff"]
                            , borderWidth: 1
                            , pointBorderColor: "#ffffff"
                            , pointBorderWidth: 5
                            , pointRadius: [1, 0, 0, 0, 0, 0, 0, 0, 1]
                            , label: "online"
                        , }, ]
                    , }
                    , options: {
                        responsive: true
                        , maintainAspectRatio: true
                        , layout: {
                            padding: {
                                left: 0
                                , right: 10
                                , top: 0
                                , bottom: 0
                            , }
                        , }
                        , plugins: {
                            filler: {
                                propagate: false
                            , }
                        , }
                        , scales: {
                            xAxes: [{
                                ticks: {
                                    display: false
                                    , fontColor: "#6c7293"
                                , }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                    , color: "rgba(101, 103, 119, 0.21)"
                                , }
                            , }, ]
                            , yAxes: [{
                                ticks: {
                                    display: false
                                    , fontColor: "#6c7293"
                                , }
                                , gridLines: {
                                    display: false
                                    , drawBorder: false
                                    , color: "rgba(101, 103, 119, 0.21)"
                                , }
                            , }, ]
                        , }
                        , legend: {
                            display: false
                        , }
                        , tooltips: {
                            enabled: true
                        , }
                        , elements: {
                            line: {
                                tension: 0
                            , }
                        , }
                    , }
                , });
            }
        });
    })(jQuery);

</script>
@endsection
@endcan
