<div class=" h-screen w-full p-6 pb-28">
    <div class="grid grid-cols-3 place-items-center">
        @foreach ($studentStats as $index => $student)
            <div
                class="place-self-center flex flex-col items-center p-6 my-4 bg-white rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <h5 class="text-lg font-extrabold text-gray-900 dark:text-gray-100">{{ $student['name'] }}</h5>

                @if(count($student['scores']) === 0)
                    <p>No records available</p>
                @else
                    <canvas id="chart-{{ $index }}" height="300"></canvas>
                @endif
            </div>
        @endforeach
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            window.studentScoresData = @json(
                collect($studentStats)->map(fn($s) => $s['scores'])->toArray()
            );

            let charts = [];

            function createCharts() {
                // Destroy old charts if any
                charts.forEach(chart => chart.destroy());
                charts = [];

                document.querySelectorAll('canvas[id^="chart-"]').forEach((canvas, idx) => {
                    const ctx = canvas.getContext('2d');
                    const scores = window.studentScoresData[idx] || [];
                    if (!scores.length) return;

                    const chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: scores.map(s => s.record_date),
                            datasets: [{
                                label: 'Score %',
                                data: scores.map(s => s.percent),
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true,
                                tension: 0.4,
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    callbacks: {
                                        title: (items) => scores[items[0].dataIndex].title,
                                        label: (item) => `Score: ${scores[item.dataIndex].score}`
                                    }
                                }
                            },
                            scales: {
                                x: { title: { display: true, text: 'Date' } },
                                y: { beginAtZero: true, max: 100, title: { display: true, text: 'Score %' } }
                            }
                        }
                    });

                    charts.push(chart);
                });
            }

            document.addEventListener('livewire:navigated', () => {
                createCharts();
            });

            Livewire.hook('message.processed', (message, component) => {
                // Recreate charts after every Livewire update
                createCharts();
            });
        </script>
    @endpush

</div>