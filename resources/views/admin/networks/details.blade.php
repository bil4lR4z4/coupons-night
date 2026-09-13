@extends('admin.master')

@section('title', 'Network Details')

@section('content')

<div class="container-fluid">

    <x-breadcrumb current-page-title="Network Details" />

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">

        <div>
            <h2 class="fw-bold mb-3">
                {{ $network->name }}
            </h2>

            <div class="d-flex align-items-center gap-2">

                <span
                    style="
                        width:50px;
                        height:22px;
                        background:{{ $network->color }};
                        display:inline-block;
                        border-radius:6px;
                        border:1px solid #ddd;
                    ">
                </span>

                <span class="fw-semibold">
                    {{ $network->color }}
                </span>

            </div>
        </div>

        <div>
            @if($network->status == 'enable')

                <span class="badge bg-success px-4 py-2">
                    Enable
                </span>

            @else

                <span class="badge bg-danger px-4 py-2">
                    Disable
                </span>

            @endif
        </div>

    </div>





    <!-- Statistics -->
    <div class="row g-4">

        <!-- Coupons -->
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2">
                                Total Coupons
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalCoupons }}
                            </h2>

                        </div>

                        <div
                            class="rounded-circle d-flex align-items-center justify-content-center"
                            style="
                                width:70px;
                                height:70px;
                                background:#0d6efd20;
                                color:#0d6efd;
                                font-size:28px;
                            ">

                            <i class="ti ti-ticket"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <!-- Stores -->
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2">
                                Total Stores
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalStores }}
                            </h2>

                        </div>

                        <div
                            class="rounded-circle d-flex align-items-center justify-content-center"
                            style="
                                width:70px;
                                height:70px;
                                background:#19875420;
                                color:#198754;
                                font-size:28px;
                            ">

                            <i class="ti ti-building-store"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>





        <!-- Products -->
        <div class="col-xl-4 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <p class="text-muted mb-2">
                                Total Products
                            </p>

                            <h2 class="fw-bold mb-0">
                                {{ $totalProducts }}
                            </h2>

                        </div>

                        <div
                            class="rounded-circle d-flex align-items-center justify-content-center"
                            style="
                                width:70px;
                                height:70px;
                                background:#21252920;
                                color:#212529;
                                font-size:28px;
                            ">

                            <i class="ti ti-package"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>





    <!-- Charts -->
    <div class="row mt-5 g-4">

        <!-- Bar Chart -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h4 class="fw-bold mb-1">
                        Analytics Overview
                    </h4>

                    <p class="text-muted mb-0">
                        Distribution of network resources
                    </p>

                </div>

                <div class="card-body">

                    <div id="barChart"></div>

                </div>

            </div>

        </div>





        <!-- Donut Chart -->
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h4 class="fw-bold mb-1">
                        Resource Distribution
                    </h4>

                    <p class="text-muted mb-0">
                        Percentage breakdown by category
                    </p>

                </div>

                <div class="card-body">

                    <div id="pieChart"></div>

                    <!-- Legend -->
                    <div class="d-flex justify-content-center gap-4 flex-wrap mt-4">

                        <div class="d-flex align-items-center gap-2">
                            <span style="width:14px;height:14px;background:#0d6efd;border-radius:3px;"></span>
                            <small>Coupons: {{ $totalCoupons }}</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span style="width:14px;height:14px;background:#198754;border-radius:3px;"></span>
                            <small>Stores: {{ $totalStores }}</small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <span style="width:14px;height:14px;background:#212529;border-radius:3px;"></span>
                            <small>Products: {{ $totalProducts }}</small>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection





@push('scripts')

<script src="https://d3js.org/d3.v7.min.js"></script>

<script>

const analyticsData = [

    {
        label: "Coupons",
        value: {{ $totalCoupons }},
        color: "#0d6efd"
    },

    {
        label: "Stores",
        value: {{ $totalStores }},
        color: "#198754"
    },

    {
        label: "Products",
        value: {{ $totalProducts }},
        color: "#212529"
    }

];




// ========================================
// BAR CHART
// ========================================

const width = 500;
const height = 320;

const margin = {
    top: 20,
    right: 20,
    bottom: 50,
    left: 50
};

const svg = d3.select("#barChart")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

const x = d3.scaleBand()
    .domain(analyticsData.map(d => d.label))
    .range([margin.left, width - margin.right])
    .padding(0.4);

const y = d3.scaleLinear()
    .domain([0, d3.max(analyticsData, d => d.value)])
    .nice()
    .range([height - margin.bottom, margin.top]);


// X Axis

svg.append("g")
    .attr("transform", `translate(0, ${height - margin.bottom})`)
    .call(d3.axisBottom(x));


// Y Axis

svg.append("g")
    .attr("transform", `translate(${margin.left}, 0)`)
    .call(d3.axisLeft(y));


// Bars

svg.selectAll(".bar")
    .data(analyticsData)
    .enter()
    .append("rect")
    .attr("x", d => x(d.label))
    .attr("y", d => y(d.value))
    .attr("width", x.bandwidth())
    .attr("height", d => height - margin.bottom - y(d.value))
    .attr("fill", d => d.color)
    .attr("rx", 8);


// Labels

svg.selectAll(".label")
    .data(analyticsData)
    .enter()
    .append("text")
    .text(d => d.value)
    .attr("x", d => x(d.label) + x.bandwidth() / 2)
    .attr("y", d => y(d.value) - 10)
    .attr("text-anchor", "middle")
    .style("font-size", "14px")
    .style("font-weight", "700");








// ========================================
// DONUT CHART
// ========================================

const pieWidth = 420;
const pieHeight = 420;

const radius = Math.min(pieWidth, pieHeight) / 2;

const pieSvg = d3.select("#pieChart")
    .append("svg")
    .attr("width", pieWidth)
    .attr("height", pieHeight)
    .append("g")
    .attr(
        "transform",
        `translate(${pieWidth / 2}, ${pieHeight / 2})`
    );

const pie = d3.pie()
    .value(d => d.value);

const data_ready = pie(analyticsData);

const arc = d3.arc()
    .innerRadius(90)
    .outerRadius(radius - 10);


// Draw slices

pieSvg.selectAll('path')
    .data(data_ready)
    .enter()
    .append('path')
    .attr('d', arc)
    .attr('fill', d => d.data.color)
    .style("stroke", "#fff")
    .style("stroke-width", "3px");




// ========================================
// PERCENTAGE LABELS
// ========================================

pieSvg.selectAll('.percent-label')
    .data(data_ready)
    .enter()
    .append('text')

    .attr('class', 'percent-label')

    .text(function(d) {

        const total =
            d3.sum(analyticsData.map(item => item.value));

        const percent =
            ((d.data.value / total) * 100).toFixed(1);

        return percent + "%";
    })

    .attr('transform', function(d) {

        const pos = arc.centroid(d);

        const midangle =
            d.startAngle + (d.endAngle - d.startAngle) / 2;

        pos[0] =
            radius * 0.72 * Math.cos(midangle - Math.PI / 2);

        pos[1] =
            radius * 0.72 * Math.sin(midangle - Math.PI / 2);

        return `translate(${pos})`;
    })

    .style('text-anchor', 'middle')
    .style("font-size", "14px")
    .style("font-weight", "700")
    .style("fill", "#fff");







// ========================================
// CENTER TOTAL
// ========================================

pieSvg.append("text")
    .attr("text-anchor", "middle")
    .attr("dy", "-5")
    .style("font-size", "32px")
    .style("font-weight", "700")
    .text(
        analyticsData.reduce((a, b) => a + b.value, 0)
    );

pieSvg.append("text")
    .attr("text-anchor", "middle")
    .attr("dy", "22")
    .style("font-size", "14px")
    .style("fill", "#666")
    .text("Total Items");

</script>

@endpush