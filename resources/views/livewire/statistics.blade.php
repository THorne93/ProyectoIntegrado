<div class="h-screen w-full p-6 pb-28 overflow-y-scroll scrollBarThin">
<h3 class="text-base lg:text-2xl font-bold tracking-tight pb-1 dark:text-white text-center w-full p-1 mb-3">
           Statistics for @if (Auth::user()->role == 'Student')
            {{ Auth::user()->name . ' ' . Auth::user()->surname }}
        @else
            {{ $student->name . ' ' . $student->surname }}
           
           @endif 
        </h3>
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

        <div wire:ignore id="chart-container">
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

                    const observer = new ResizeObserver(() => {
                        myChart.resize();
                    });
                    observer.observe(document.getElementById('chart-container'));

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
                        console.log(filteredData.map(d => d.part));
                        myChart.options.scales.y.max = filteredData.some(item => item.part == 4) ? 12 : 8;
                        myChart.options.scales.y.min = 0;
                        myChart.update();
                        console.log(filteredData);
                    }

                    myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                    label: 'Score',
                                    type: 'line',
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
    <div class="bg-white border w-4/5 border-gray-300 rounded-lg shadow-sm mx-auto">
        <div class="flex  gap-4 items-start my-4 min-h-48">

            {{-- PARTS + SUMMARY/BUTTON BLOCK --}}
            <div class="w-2/5 p-4">
                {{-- 1. Part Selector --}}
                <label class="block mb-2 ps-3 text-sm font-semibold text-gray-700">Select Parts</label>
                <ul class="items-center w-full text-sm font-medium text-gray-900 rounded-lg sm:flex gap-1">
                    @foreach ([1, 2, 3, 4] as $part)
                        <li class="sm:w-1/4 w-full">
                            <div class="flex items-center ps-3">
                                <input type="checkbox" id="part-checkbox-{{ $part }}"
                                    value="{{ $part }}" wire:model.live="selectedParts"
                                    class="w-5 h-5 text-blue-600">
                                <label for="part-checkbox-{{ $part }}"
                                    class="py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 whitespace-nowrap">
                                    Part {{ $part }}
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>

                {{-- Summary + PDF button (below parts) --}}
                <div class="mt-4 ps-3 text-sm text-gray-700">
                <button wire:click='getPrediction' @if (empty($detailedStats)) disabled @endif
                        class="px-4 py-2 border rounded transition-colors @if (empty($detailedStats)) bg-gray-200 text-gray-400 cursor-not-allowed border-gray-300
                        @else
                            bg-gray-300 text-black hover:bg-gray-400 border-gray-400 cursor-pointer @endif">
                            Predictor <span style=" background: #eee; color: #333; padding: 2px 4px; border-radius: 4px;">BETA</span> </button>
                            <button wire:click='printPDF' @if (empty($detailedStats)) disabled @endif
                        class="px-4 py-2 border rounded transition-colors @if (empty($detailedStats)) bg-gray-200 text-gray-400 cursor-not-allowed border-gray-300
                        @else
                            bg-gray-300 text-black hover:bg-gray-400 border-gray-400 cursor-pointer @endif">
                        Print PDF </button>
                        </div>

            </div>

            {{-- The rest of the options --}}
            <div class="w-1/5 my-4">
                {{-- 2. Stats Mode Selector --}}
                <label class="block mb-2 text-sm font-semibold text-gray-700">Select Exercises</label>
                <ul class="items-center text-sm font-medium text-gray-900 rounded-lg sm:flex">
                    <li class="w-full">
                        <div class="flex items-center ps-3">
                            <input id="radio-all" wire:model.live='detailedStatsSelect' type="radio" value="all"
                                name="list-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label for="radio-all"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">All</label>
                        </div>
                    </li>
                    <li class="w-full">
                        <div class="flex items-center ps-3">
                            <input id="radio-custom" wire:model.live='detailedStatsSelect' type="radio" value="custom"
                                name="list-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                            <label for="radio-custom"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Custom</label>
                        </div>
                    </li>
                </ul>
                <div class="mt-4 text-sm text-gray-700">

                </div>
            </div>

            <div class="w-1/5 mt-4">
                {{-- 3. Exercise Selector --}}
                <label class="block mb-2 text-sm font-semibold text-gray-700">Custom Exercises</label>
                <x-select multiselect :searchable="true" :small="true" :disabled="!($detailedStatsSelect === 'custom' && $detailedListExercises && $detailedListExercises->isNotEmpty())" option-label="name"
                    option-value="id" wire:model.live="detailedSelectedExercises" :options="$detailedListExercises
                        ?->map(fn($s) => ['id' => $s->id, 'name' => $s->title])
                        ->toArray() ?? []"
                    class="text-black rounded-md shadow-sm border-gray-300 focus:border-primary-500 focus:ring focus:ring-primary-200 dark:bg-white dark:text-black"
                    option-class="hover:bg-primary-100 hover:text-black"
                    option-selected-class="bg-primary-200 text-black font-semibold"
                    option-empty-class="text-gray-400 italic px-2 py-1" />
            </div>

            <div class="mt-4 w-1/12">
                {{-- 4. Result Limit Selector --}}
                <label class="block mb-2 text-sm font-semibold text-gray-700">Nº Results</label>
                <select wire:model.live="detailedStatsLimit"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">30</option>
                    <option selected value="0">All</option>
                </select>
            </div>

            <div class="mt-4 pe-4">
                {{-- 5. Go Button --}}
                <label class="block mb-2 text-sm font-semibold text-gray-700">Action</label>
                @php
                    $isDisabled =
                        empty($selectedParts) ||
                        ($detailedStatsSelect === null ||
                            ($detailedStatsSelect === 'custom' && empty($detailedSelectedExercises)));
                @endphp
                <button wire:click="getDetailedStats"
                    class="flex-grow px-4 py-2 border rounded transition-colors
            {{ $isDisabled ? 'bg-gray-200 text-gray-400 cursor-not-allowed border-gray-300' : 'bg-gray-300 text-black hover:bg-gray-400 border-gray-400 cursor-pointer' }}"
                    @if ($isDisabled) disabled @endif>
                    Go
                </button>
            </div>

        </div>
        @if ($prediction)
<div class="px-4 pb-3">
<p class="ps-3">{!! $prediction !!}</p>
</div>

@endif
    </div>


    @if ($detailedStats)
        <div class="grid grid-cols-1 md:grid-cols-2  gap-4 py-4 w-4/5 mx-auto">
            @foreach ($detailedStats as $key => $stat)
                <div>

                    <h2 class="text-xl px-6 py-2 bg-gray-50 font-bold dark:text-white">{{ $key }} - Part
                        {{ $stat[0]->part }}
                    </h2>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 rounded-lg dark:text-gray-400 mb-6">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700 text-xs text-gray-700 dark:text-gray-400 uppercase">
                                <th scope="col" class="px-6 py-3">Date</th>
                                <th scope="col" class="px-6 py-3">Time taken</th>
                                <th scope="col" class="px-6 py-3">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stat as $record)
                                <tr
                                    class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-900 even:dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-2">
                                        {{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y h:i A') }}</td>
                                    <td class="px-6 py-2">
                                        {{ str_pad(floor($record->time / 60), 2, '0', STR_PAD_LEFT) }}:{{ str_pad($record->time % 60, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-2">{{ $record->score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach

        </div>
    @endif
</div>
