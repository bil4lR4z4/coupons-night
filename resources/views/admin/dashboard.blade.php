@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<!-- Font Awesome 6 (Free) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="container-fluid">
    <div>
        <h1 class="h2 mb-0 fw-bold gradient-text">Dashboard</h1>
        <p class="text-muted mt-1">Welcome back, {{ Auth::user()->name ?? 'Admin' }}! Here's what's happening today.</p>
    </div>

    <div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4 mb-5">
        <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Total Coupons</h6>
                    <h2 class="stats-card-value">{{ number_format($totalCoupons) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>

        <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Total Stores</h6>
                    <h2 class="stats-card-value">{{ number_format($totalStores) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-store"></i>
                </div>
            </div>
        </div>

        <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Total Events</h6>
                    <h2 class="stats-card-value">{{ number_format($totalEvents) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>

        <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Upcoming Events</h6>
                    <h2 class="stats-card-value">{{ number_format($upcomingEvents) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>

        <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Total Products</h6>
                    <h2 class="stats-card-value">{{ number_format($totalProducts) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>

           <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Published Stores</h6>
                    <h2 class="stats-card-value">{{ number_format($ApprovedStores) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>

           <div class=" ">
            <div class="stats-card">
                <div class="stats-card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="stats-card-info">
                    <h6 class="stats-card-label">Pending Stores</h6>
                    <h2 class="stats-card-value">{{ number_format($PendingStores) }}</h2>
                </div>
                <div class="stats-card-bg-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Graph Section -->
    <div class="row overflow-hidden">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-bar-chart-steps me-2 text-primary"></i>Analytics Overview
                        </h5>
                        <p class=" text-muted small mt-1">Distribution of all platform resources</p>
                    </div>
                    <div id="barChart"></div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="mb-0 fw-semibold">
                            <i class="bi bi-pie-chart me-2 text-success"></i>Resource Distribution
                        </h5>
                        <p class="card-subtitle text-muted small mt-1">Percentage breakdown by category</p>
                    </div>
                    <div id="pieChart"></div>
                    <div id="pieLegend" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://d3js.org/d3.v7.min.js"></script>

<script>
const data = [
    {label: "Coupons", value: {{ $totalCoupons }}, color: "#0d6efd"},
    {label: "Stores", value: {{ $totalStores }}, color: "#198754"},
    {label: "Events", value: {{ $totalEvents }}, color: "#ffc107"},
    {label: "Upcoming Events", value: {{ $upcomingEvents }}, color: "#dc3545"},
    {label: "Products", value: {{ $totalProducts }}, color: "#212529"}
];

// BAR CHART (unchanged)
const width = 500;
const height = 300;

const svg = d3.select("#barChart")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

const x = d3.scaleBand()
    .domain(data.map(d => d.label))
    .range([50, width - 20])
    .padding(0.3);

const y = d3.scaleLinear()
    .domain([0, d3.max(data, d => d.value)])
    .range([height - 50, 20]);

svg.selectAll("rect")
    .data(data)
    .enter()
    .append("rect")
    .attr("x", d => x(d.label))
    .attr("y", d => y(d.value))
    .attr("width", x.bandwidth())
    .attr("height", d => height - 50 - y(d.value))
    .attr("fill", d => d.color);

svg.append("g")
    .attr("transform", `translate(0,${height-50})`)
    .call(d3.axisBottom(x));

svg.append("g")
    .attr("transform", `translate(50,0)`)
    .call(d3.axisLeft(y));

// ========== IMPROVED PIE CHART ==========
const pieWidth = 500;
const pieHeight = 350;
const radius = Math.min(pieWidth, pieHeight) / 2.5;

// Clear previous content
d3.select("#pieChart").selectAll("*").remove();

const pieSvg = d3.select("#pieChart")
    .append("svg")
    .attr("width", pieWidth)
    .attr("height", pieHeight)
    .append("g")
    .attr("transform", `translate(${pieWidth/2.5}, ${pieHeight/2})`);

// Create gradient definitions
const defs = pieSvg.append("defs");

// Add gradients for each slice
data.forEach((d, i) => {
    const gradient = defs.append("linearGradient")
        .attr("id", `gradient${i}`)
        .attr("x1", "0%")
        .attr("y1", "0%")
        .attr("x2", "100%")
        .attr("y2", "100%");
    
    gradient.append("stop")
        .attr("offset", "0%")
        .attr("stop-color", d.color)
        .attr("stop-opacity", 0.9);
    
    gradient.append("stop")
        .attr("offset", "100%")
        .attr("stop-color", d.color)
        .attr("stop-opacity", 0.6);
});

// Create pie chart
const pie = d3.pie()
    .value(d => d.value)
    .sort(null);

const arc = d3.arc()
    .innerRadius(radius * 0.5)  // Donut style
    .outerRadius(radius)
    .cornerRadius(3);  // Rounded corners

const outerArc = d3.arc()
    .innerRadius(radius * 0.8)
    .outerRadius(radius * 0.9);

// Draw pie slices
const slices = pieSvg.selectAll("path")
    .data(pie(data))
    .enter()
    .append("path")
    .attr("d", arc)
    .attr("fill", (d, i) => `url(#gradient${i})`)
    .attr("stroke", "white")
    .attr("stroke-width", 2)
    .style("cursor", "pointer")
    .style("transition", "all 0.3s ease")
    .on("mouseover", function(event, d) {
        // Animate slice expansion
        d3.select(this)
            .transition()
            .duration(200)
            .attr("transform", `scale(1.05) translate(${arc.centroid(d)[0] * 0.05}, ${arc.centroid(d)[1] * 0.05})`);
        
        // Show tooltip
        const tooltip = d3.select("#pieChart")
            .append("div")
            .attr("class", "pie-tooltip")
            .style("position", "absolute")
            .style("background", "rgba(0,0,0,0.9)")
            .style("color", "white")
            .style("padding", "10px 15px")
            .style("border-radius", "8px")
            .style("font-size", "14px")
            .style("pointer-events", "none")
            .style("z-index", "1000")
            .style("font-weight", "500")
            .style("box-shadow", "0 4px 15px rgba(0,0,0,0.2)");
        
        const percentage = ((d.data.value / d3.sum(data, d => d.value)) * 100).toFixed(1);
        tooltip.html(`
            <strong>${d.data.label}</strong><br/>
            Value: ${d.data.value.toLocaleString()}<br/>
            Percentage: ${percentage}%
        `);
        
        tooltip.style("left", (event.pageX + 10) + "px")
            .style("top", (event.pageY - 30) + "px");
    })
    .on("mousemove", function(event) {
        d3.select(".pie-tooltip")
            .style("left", (event.pageX + 10) + "px")
            .style("top", (event.pageY - 30) + "px");
    })
    .on("mouseout", function() {
        d3.select(this)
            .transition()
            .duration(200)
            .attr("transform", "scale(1)");
        d3.select(".pie-tooltip").remove();
    });

// Add percentage labels in the center of each slice
slices.each(function(d, i) {
    const centroid = arc.centroid(d);
    const percentage = ((d.data.value / d3.sum(data, d => d.value)) * 100).toFixed(1);
    
    // Only show label if slice is large enough
    if (d.data.value / d3.sum(data, d => d.value) > 0.05) {
        pieSvg.append("text")
            .attr("transform", `translate(${centroid})`)
            .attr("text-anchor", "middle")
            .attr("dy", ".3em")
            .style("font-size", "12px")
            .style("font-weight", "bold")
            .style("fill", "white")
            .style("text-shadow", "1px 1px 1px rgba(0,0,0,0.3)")
            .style("pointer-events", "none")
            .text(`${percentage}%`);
    }
});

// Add center text (total count)
const total = d3.sum(data, d => d.value);
pieSvg.append("text")
    .attr("text-anchor", "middle")
    .attr("dy", ".3em")
    .style("font-size", "24px")
    .style("font-weight", "bold")
    .style("fill", "#333")
    .text(total.toLocaleString());

pieSvg.append("text")
    .attr("text-anchor", "middle")
    .attr("dy", "1.8em")
    .style("font-size", "11px")
    .style("fill", "#666")
    .text("Total Items");

// Add title decoration
pieSvg.append("text")
    .attr("text-anchor", "middle")
    .attr("dy", "-2em")
    .style("font-size", "14px")
    .style("fill", "#999")
    .style("font-weight", "500")
    .text("Distribution");

// Create custom legend
const legend = d3.select("#pieLegend")
    .append("div")
    .attr("class", "d-flex justify-content-center flex-wrap gap-3")
    .style("padding", "10px");

data.forEach((item, i) => {
    const legendItem = legend.append("div")
        .attr("class", "d-flex align-items-center me-3 mb-2")
        .style("cursor", "pointer")
        .on("mouseover", function() {
            // Highlight corresponding pie slice
            pieSvg.selectAll("path")
                .filter((d, idx) => idx === i)
                .transition()
                .duration(200)
                .attr("transform", "scale(1.03)")
                .attr("stroke-width", 3);
        })
        .on("mouseout", function() {
            pieSvg.selectAll("path")
                .transition()
                .duration(200)
                .attr("transform", "scale(1)")
                .attr("stroke-width", 2);
        });
    
    legendItem.append("div")
        .style("width", "16px")
        .style("height", "16px")
        .style("background", item.color)
        .style("border-radius", "4px")
        .style("margin-right", "8px");
    
    legendItem.append("span")
        .style("font-size", "13px")
        .style("font-weight", "500")
        .style("color", "#555")
        .html(`${item.label}: ${item.value.toLocaleString()}`);
});

// Add animation on load
slices.attr("opacity", 0)
    .transition()
    .duration(800)
    .attr("opacity", 1);

// Add hover effect for better UX
pieSvg.on("mouseleave", function() {
    d3.select(".pie-tooltip").remove();
});

</script>

<style>
/* Additional styling for pie chart */
#pieChart {
    position: relative;
    min-height: 350px;
}

.pie-tooltip {
    transition: all 0.2s ease;
    pointer-events: auto;
}

#pieLegend div {
    transition: all 0.2s ease;
}

#pieLegend div:hover {
    transform: translateX(5px);
}
</style>

<style>
    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        cursor: pointer;
    }

    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .stats-card-icon {
        width: 55px;
        height: 55px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
        position: relative;
        z-index: 2;
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-card-icon {
        transform: scale(1.05) rotate(5deg);
    }

    /* Card color variations */
    .stats-card:nth-child(1) .stats-card-icon { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stats-card:nth-child(2) .stats-card-icon { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
    .stats-card:nth-child(3) .stats-card-icon { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); }
    .stats-card:nth-child(4) .stats-card-icon { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%); }
    .stats-card:nth-child(5) .stats-card-icon { background: linear-gradient(135deg, #434343 0%, #000000 100%); }
    .stats-card:nth-child(6) .stats-card-icon { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }

    .stats-card-info {
        flex: 1;
        position: relative;
        z-index: 2;
    }

    .stats-card-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.5rem;
    }

    .stats-card-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1a202c;
        margin: 0;
        line-height: 1.2;
        letter-spacing: -0.02em;
    }

    .stats-card-bg-icon {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 6rem;
        opacity: 0.03;
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-card-bg-icon {
        opacity: 0.08;
        transform: scale(1.1) rotate(5deg);
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .stats-card {
            padding: 1rem;
        }
        
        .stats-card-value {
            font-size: 1.5rem;
        }
        
        .stats-card-icon {
            width: 45px;
            height: 45px;
            font-size: 1.4rem;
        }
    }

    /* Different hover animations for each card */
    .stats-card:nth-child(1):hover .stats-card-icon { background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); }
    .stats-card:nth-child(2):hover .stats-card-icon { background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%); }
    .stats-card:nth-child(3):hover .stats-card-icon { background: linear-gradient(135deg, #fda085 0%, #f6d365 100%); }
    .stats-card:nth-child(4):hover .stats-card-icon { background: linear-gradient(135deg, #f45c43 0%, #eb3349 100%); }
</style>
</style>

@endsection