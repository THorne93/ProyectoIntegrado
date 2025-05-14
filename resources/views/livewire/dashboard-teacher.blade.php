<div class="grid grid-cols-3 place-items-center">
    @foreach ($studentStats as $index => $student)
        <div
            class="place-self-center flex flex-col items-center p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border dark:border-gray-700">
            <div class="flex items-center gap-6 mb-2">
                <h5 class="text-lg font-extrabold text-gray-900 dark:text-gray-100">{{ $student['name'] }}</h5>
                <a wire:click="goToStatistics({{ $student['id'] }})"
                    class="p-2 cursor-pointer rounded-md bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" viewBox="0 0 448 512"
                        fill="currentColor">
                        <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License -->
                        <path
                            d="M160 80c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 352c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-352zM0 272c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48L0 272zM368 96l32 0c26.5 0 48 21.5 48 48l0 288c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48z" />
                    </svg>
                </a>
            </div>


            @if (count($student['scores']) === 0)
                <p>No records available</p>
            @else
                <canvas id="chart-{{ $index }}" height="300"></canvas>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ctx = document.getElementById('chart-{{ $index }}').getContext('2d');
                        const studentScores = {!! json_encode($student['scores']) !!};
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode(array_column($student['scores'], 'record_date')) !!},
                                datasets: [{
                                    label: 'Score %',
                                    data: {!! json_encode(array_column($student['scores'], 'percent')) !!},
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    fill: true,
                                    tension: 0.4,
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        callbacks: {
                                            title: function (tooltipItems) {
                                                const index = tooltipItems[0].dataIndex;
                                                return studentScores[index].title; // exercise name
                                            },
                                            label: function (tooltipItem) {
                                                const index = tooltipItem.dataIndex;
                                                return `Score: ${studentScores[index].score}`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Date'
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        max: 100,
                                        title: {
                                            display: true,
                                            text: 'Score %'
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>
            @endif
        </div>
    @endforeach
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection