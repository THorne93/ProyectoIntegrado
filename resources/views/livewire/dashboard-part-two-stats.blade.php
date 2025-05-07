@if(sizeof($stats) > 0)

<div wire:ignore>
    <canvas id="partTwoChart"></canvas>
</div>

@script
<script>
    console.log("Livewire script is running...");

    let scoresData = @json($stats);
    scoresData = scoresData.reverse();


    console.log("Scores Data:", scoresData);

    if (!scoresData || scoresData.length === 0) {
        console.warn("No data available for Chart.js");
        return;
    }

    let labels = scoresData.map(item => new Date(item.record_date).toLocaleDateString());
    let scores = scoresData.map(item => item.score);

    // Function to calculate the linear regression coefficients (slope 'm' and intercept 'b')
    function linearRegression(x, y) {
        let n = x.length;
        let sumX = x.reduce((sum, val) => sum + val, 0);
        let sumY = y.reduce((sum, val) => sum + val, 0);
        let sumXY = x.reduce((sum, val, idx) => sum + (val * y[idx]), 0);
        let sumX2 = x.reduce((sum, val) => sum + (val * val), 0);

        let m = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
        let b = (sumY - m * sumX) / n;

        return { m, b };
    }

    // Convert the labels (dates) into numeric x values (e.g., number of days since the first date)
    let xValues = scoresData.map((item, idx) => idx); // Simple indexing (0, 1, 2, ...)
    let yValues = scores;

    // Calculate the linear regression line (m and b)
    let { m, b } = linearRegression(xValues, yValues);

    // Generate the regression line data
    let trendLineData = xValues.map(x => m * x + b);

    const ctx = document.getElementById("partTwoChart")?.getContext("2d");

    if (ctx) {
        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Score",
                        data: scores,
                        backgroundColor: "rgba(75, 192, 192, 0.3)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.2
                    },
                    {
                        label: "Trend Line",
                        data: trendLineData,
                        borderColor: "rgba(255, 99, 132, 1)", // Trend line color (Red)
                        borderWidth: 2,
                        fill: false,
                        tension: 0, // Straight line (no curve)
                        pointRadius: 0, // No points displayed on the trend line
                        borderDash: [5, 5] // Dotted line style
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { 
                        display: false // Hide the legend (key)
                    },
                    title: { 
                        display: true, 
                        text: "Part 2" 
                    }
                },
                scales: {
                    x: {
                        title: { display: false, text: "Date" },
                        ticks: {
                            display: false,  // Hide the x-axis ticks (dates)
                        }
                    },
                    y: {
                        title: { display: true, text: "Score" },
                        beginAtZero: true,
                        suggestedMax: 8,
                        min: 0
                    }
                }
            }
        });
    } else {
        console.error("Canvas element not found");
    }
</script>
@endscript
@else
    <div class="h-[160px] flex items-center justify-center">
        <h3 class="text-gray-600 text-lg">You haven't done any exercises yet!</h3>
    </div>
@endif
