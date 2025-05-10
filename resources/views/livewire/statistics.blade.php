<div class="h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
    <div class="flex gap-4 items-end mx-auto w-4/5">
        <!-- Selects with individual labels -->
        <div class="flex flex-col gap-2 w-3/4">
            <div class="flex gap-4">
                <div class="flex flex-col flex-1 gap-1">
                    <label for="partSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Part</label>
                    <select id="partSelect"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="null" disabled hidden selected>Choose part...</option>
                        <option value="1">Part 1</option>
                        <option value="2">Part 2</option>
                        <option value="3">Part 3</option>
                        <option value="4">Part 4</option>
                    </select>
                </div>
                <div class="flex flex-col flex-1 gap-1">
                    <label for="exSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Exercise</label>
                    <select id="exSelect"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all">All</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Radio buttons with label and Go button -->
        <div class="flex flex-col gap-2 flex-grow">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Select moving average</label>
            <ul class="flex items-center text-sm font-medium text-gray-900  w-full">
                <li class="w-1/3">
                    <div class="flex items-center">
                        <input id="avg10" type="checkbox" value="10" checked
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500">
                        <label for="avg10" class="ms-2">10</label>
                    </div>
                </li>
                <li class="w-1/3">
                    <div class="flex items-center">
                        <input id="avg20" type="checkbox" value="20"checked
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500">
                        <label for="avg20" class="ms-2">20</label>
                    </div>
                </li>
                <li class="w-1/3">
                    <div class="flex items-center">
                        <input id="avg50" type="checkbox" value="50" checked"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-2 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500">
                        <label for="avg50" class="ms-2">50</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <div class="mx-auto w-4/5 my-4 p-6 bg-white">

        <div wire:ignore>
            <canvas id="myChart"></canvas>
        </div>

        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const partSelect = document.getElementById("partSelect");
                    const exerciseSelect = document.getElementById("exSelect");
                    const avg10 = document.getElementById("avg10");
                    const avg20 = document.getElementById("avg20");
                    const avg50 = document.getElementById("avg50");

                    const data = @json($stats); // Assuming $data is passed from the controller
                    let myChart;

                    if (!data || data.length === 0) {
                        console.log("No data available for the chart.");
                        return;
                    }

                    const ctx = document.getElementById('myChart').getContext('2d');

                    function movingAverage(data, windowSize) {
                        let result = [];
                        for (let i = 0; i < data.length; i++) {
                            const window = data.slice(Math.max(i - windowSize + 1, 0), i + 1);
                            const avg = window.reduce((sum, value) => sum + value, 0) / window.length;
                            result.push(avg);
                        }
                        return result;
                    }

                    function linearRegression(x, y) {
                        const n = x.length;
                        const sumX = x.reduce((a, b) => a + b, 0);
                        const sumY = y.reduce((a, b) => a + b, 0);
                        const sumXY = x.reduce((sum, xi, i) => sum + xi * y[i], 0);
                        const sumX2 = x.reduce((sum, xi) => sum + xi * xi, 0);

                        const slope = (n * sumXY - sumX * sumY) / (n * sumX2 - sumX * sumX);
                        const intercept = (sumY - slope * sumX) / n;

                        return {
                            slope,
                            intercept
                        };
                    }

                    function calculateTrendLine(x, slope, intercept) {
                        return x.map(xi => slope * xi + intercept);
                    }

                    function updateExerciseOptions(selectedPart) {
                        console.log("Part changed to:", selectedPart); // ✅ Console log
                        const filteredData = data.filter(item => String(item.part) === String(selectedPart));
                        const uniqueExercises = [...new Map(filteredData.map(item => [item.title, {
                            id: item.id,
                            title: item.title
                        }])).values()];
                        exerciseSelect.innerHTML = "";
                        const defaultOption = document.createElement("option");
                        defaultOption.value = "all";
                        defaultOption.textContent = "All";
                        exerciseSelect.appendChild(defaultOption);
                        uniqueExercises.forEach(exercise => {
                            const option = document.createElement("option");
                            option.value = exercise.title;
                            option.textContent = exercise.title;
                            exerciseSelect.appendChild(option);
                        });
                    }

                    function updateChart() {
                        const selectedPart = partSelect.value;
                        const selectedExercise = exerciseSelect.value;
                        const filteredData = data.filter(item => {
                            return String(item.part) === String(selectedPart) &&
                                (selectedExercise === "all" || item.title === selectedExercise);
                        });

                        const labels = filteredData.map(item => {
                            const date = new Date(item.record_date);
                            return `${date.getDate().toString().padStart(2, '0')}/${
                        (date.getMonth() + 1).toString().padStart(2, '0')
                    }/${date.getFullYear()}`;
                        });
                        const scores = filteredData.map(item => Number(item.score));
                        const maxScore = Math.max(...scores);
                        const recommendedMax = Math.max(...scores);
                        const avg10Data = movingAverage(scores, 10);
                        const avg20Data = movingAverage(scores, 20);
                        const avg50Data = movingAverage(scores, 50);

                        // Generate trend line
                        const xValues = Array.from({
                            length: scores.length
                        }, (_, i) => i); // simple index as x-axis
                        const {
                            slope,
                            intercept
                        } = linearRegression(xValues, scores);
                        const trendLine = calculateTrendLine(xValues, slope, intercept);

                        myChart.data.labels = labels;
                        myChart.data.datasets[0].data = scores;
                        myChart.data.datasets[1].data = avg10Data;
                        myChart.data.datasets[2].data = avg20Data;
                        myChart.data.datasets[3].data = avg50Data;
                        myChart.data.datasets[4] = {
                            label: 'Trend Line',
                            data: trendLine,
                            borderColor: 'rgba(0, 123, 255, 1)',
                            backgroundColor: 'rgba(0, 123, 255, 0.2)',
                            pointStyle: 'line',
                            fill: false
                        };
                        myChart.options.scales.y.max = recommendedMax;
                        myChart.options.scales.y.suggestedMax = recommendedMax + 1;
                        myChart.update();
                        console.log(filteredData);
                    }

                    myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                    label: 'Score',
                                    data: [],
                                    borderColor: 'rgba(0, 209, 2, 1)',
                                    backgroundColor: 'rgba(0, 209, 2, 0.2)',
                                    pointRadius: 1,
                                    fill: true,
                                    fillColor: 'rgba(0, 209, 2, 0.2)',
                                },
                                {
                                    label: '50-Period Average',
                                    data: [],
                                    borderColor: 'rgba(255, 159, 64, 1)',
                                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                    borderDash: [5, 5],
                                    hidden: !avg50.checked
                                },
                                {
                                    label: '10-Period Average',
                                    data: [],
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderDash: [5, 5],
                                    hidden: !avg10.checked
                                },
                                {
                                    label: '20-Period Average',
                                    data: [],
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderDash: [5, 5],
                                    hidden: !avg20.checked
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            },
                            layout: {
                                padding: {
                                    top: 10,
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Time'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Score'
                                    },
                                    beginAtZero: true,
                                    max: 8
                                }
                            }
                        }
                    });

                    // Event Listeners ✅
                    partSelect.addEventListener("change", () => {
                        updateExerciseOptions(partSelect.value);
                        updateChart();
                    });

                    exerciseSelect.addEventListener("change", updateChart);

                    avg50.addEventListener("change", () => {
                        myChart.getDatasetMeta(1).hidden = !avg50.checked;
                        myChart.update();
                    });

                    avg10.addEventListener("change", () => {
                        myChart.getDatasetMeta(2).hidden = !avg10.checked;
                        myChart.update();
                    });

                    avg20.addEventListener("change", () => {
                        myChart.getDatasetMeta(3).hidden = !avg20.checked;
                        myChart.update();
                    });

                    // Initialize chart
                    updateExerciseOptions(partSelect.value);
                    updateChart();
                });
            </script>
        @endpush


    </div>
    <div class="flex my-4 gap-4 items-end mx-auto w-3/4">
        <h5 class="text-base lg:text-xl font-bold tracking-tight pb-1 dark:text-white text-center w-full">
            Detailed Stats
        </h5>
    </div>
    <div class="flex items-start my-4 gap-4 mx-auto w-4/5 bg-white border border-gray-300 rounded-lg shadow-sm">
        <div x-data="{ selectedParts: [] }" class=" p-4 w-2/5">

            <ul class="items-center w-full text-sm font-medium text-gray-900 rounded-lg sm:flex gap-1">
                @foreach ([1, 2, 3, 4] as $part)
                    <li class="sm:w-1/4 w-full">
                        <div class="flex items-center ps-3">
                            <input type="checkbox" id="part-checkbox-{{ $part }}" value="{{ $part }}"
                                wire:model.live="selectedParts" class="w-5 h-5 text-blue-600">
                            <label for="part-checkbox-{{ $part }}"
                                class="py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 whitespace-nowrap">
                                Part {{ $part }}
                            </label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <ul class="items-center w-1/5 text-sm font-medium my-4 text-gray-900 rounded-lg sm:flex ">
            <li class="w-full ">
                <div class="flex items-center ps-3">
                    <input id="horizontal-list-radio-license" wire:model.live='detailedStatsSelect' type="radio"
                        value="all" name="list-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="horizontal-list-radio-license"
                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">All
                    </label>
                </div>
            </li>
            <li class="w-full ">
                <div class="flex items-center ps-3">
                    <input id="horizontal-list-radio-id" wire:model.live='detailedStatsSelect' type="radio"
                        value="custom" name="list-radio"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                    <label for="horizontal-list-radio-id"
                        class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Custom</label>
                </div>
            </li>
        </ul>
        @if ($detailedStatsSelect === 'custom' && $detailedListExercises && $detailedListExercises->isNotEmpty())
            <div class="w-1/5 my-4">
                <x-select multiselect :searchable="true" :small="true" option-label="name" option-value="id" :options="$detailedListExercises
                    ->map(
                        fn($s) => [
                            'id' => $s->id,
                            'name' => $s->title,
                        ],
                    )
                    ->toArray()"
                    class="text-black rounded-md shadow-sm border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 dark:bg-white dark:text-black"
                    option-class="hover:bg-primary-100 hover:text-black"
                    option-selected-class="bg-primary-200 text-black font-semibold"
                    option-empty-class="text-gray-400 italic px-2 py-1" />
            </div>
        @endif

    </div>
</div>
