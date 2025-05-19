<div class="w-6/7 grid grid-cols-2 gap-4 mx-auto justify-items-center items-start overflow-y-auto">

    <div
        class="place-self-center flex flex-row flex-1 px-4 gap-8 h-72 w-full bg-white border border-black rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col justify-center items-center w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 448 512">
                <path fill="#1274b4"
                    d="M160 80c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 352c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-352zM0 272c0-26.5 21.5-48 48-48l32 0c26.5 0 48 21.5 48 48l0 160c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48L0 272zM368 96l32 0c26.5 0 48 21.5 48 48l0 288c0 26.5-21.5 48-48 48l-32 0c-26.5 0-48-21.5-48-48l0-288c0-26.5 21.5-48 48-48z" />
            </svg>
            <h3 class="text-center mt-2 font-bold">General Information</h3>
        </div>
        <div class="flex-1 my-auto items-center">
            <p><strong>Active users:</strong> {{ $stats['currentUsers'] }}</p>
            <p><strong>Daily users:</strong> {{ $stats['dailyUsers'] }}</p>
            <p><strong>Exercises done per user:</strong> {{ $stats['avgPerUser'] }}</p>
            <p><strong>Exercises completed:</strong> {{ $stats['exercisesDone'] }}</p>
            <p><strong>Most active hour:</strong>
                {{ Carbon\Carbon::createFromTime($stats['mostActiveHour'])->format('g A') }}</p>
            <p><strong>Total time spent:</strong>
                {{ (floor($stats['totalTime'] / (30 * 86400)) ? floor($stats['totalTime'] / (30 * 86400)) . 'mo ' : '') .
                    (floor(($stats['totalTime'] % (30 * 86400)) / 86400)
                        ? floor(($stats['totalTime'] % (30 * 86400)) / 86400) . 'd '
                        : '') .
                    (floor((($stats['totalTime'] % (30 * 86400)) % 86400) / 3600)
                        ? floor((($stats['totalTime'] % (30 * 86400)) % 86400) / 3600) . 'h '
                        : '') .
                    floor(((($stats['totalTime'] % (30 * 86400)) % 86400) % 3600) / 60) .
                    'm' }}
            </p>

        </div>
    </div>
    <div
        class="place-self-center flex flex-row flex-1 px-4 gap-8 h-72 w-full bg-white border border-black rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col justify-center items-center w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20" viewBox="0 0 640 512">
                <path fill="#1274b4"
                    d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
            </svg>
            <h3 class="text-center mt-2 font-bold">Users</h3>
            <a href="{{ route('admin.users') }}">
                <button type="button"
                    class="text-gray-900 bg-white border border-black focus:outline-none hover:bg-yellow-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    Manage
                </button></a>
        </div>
        <div class="flex-1 my-auto items-center">
            <p><strong>Total users:</strong> {{ $stats['totalUsers'] }}</p>
            <p>
                <strong>Students:</strong> {{ $stats['roleBreakdown']['Student'] ?? 0 }} |
                <strong>Teachers:</strong> {{ $stats['roleBreakdown']['Teacher'] ?? 0 }} |
                <strong>Admins:</strong> {{ $stats['roleBreakdown']['Admin'] ?? 0 }}
            </p>
            <p><strong>New users this week:</strong> {{ $stats['weeklyUsers'] }}</p>
            <p><strong>User growth this week:</strong> {{ $stats['userGrowthPercentage'] }}%</p>
            <h3><strong>Most Active Users This Week:</strong></h3>

            <ul>
                @foreach ($stats['mostActiveUsers'] as $index => $user)
                    <li>
                        @if ($index === 0)
                            🥇
                        @elseif ($index === 1)
                            🥈
                        @elseif ($index === 2)
                            🥉
                        @endif
                        {{ $user->name }} - {{ $user->activity_count }} activities
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
    <div
        class="place-self-center flex flex-row flex-1 px-4 gap-8 h-72 w-full bg-white rounded-lg border border-black shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col justify-center items-center w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 576 512">
                <path fill="#1274b4"
                    d="M249.6 471.5c10.8 3.8 22.4-4.1 22.4-15.5l0-377.4c0-4.2-1.6-8.4-5-11C247.4 52 202.4 32 144 32C93.5 32 46.3 45.3 18.1 56.1C6.8 60.5 0 71.7 0 83.8L0 454.1c0 11.9 12.8 20.2 24.1 16.5C55.6 460.1 105.5 448 144 448c33.9 0 79 14 105.6 23.5zm76.8 0C353 462 398.1 448 432 448c38.5 0 88.4 12.1 119.9 22.6c11.3 3.8 24.1-4.6 24.1-16.5l0-370.3c0-12.1-6.8-23.3-18.1-27.6C529.7 45.3 482.5 32 432 32c-58.4 0-103.4 20-123 35.6c-3.3 2.6-5 6.8-5 11L304 456c0 11.4 11.7 19.3 22.4 15.5z" />
            </svg>
            <h3 class="text-center my-2 font-bold">Exercises</h3>
            <a href="{{ route('admin.exercises') }}">
                <button type="button"
                    class="text-gray-900 bg-white border border-black focus:outline-none hover:bg-yellow-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    Manage
                </button></a>
        </div>
        <div class="flex-1 my-auto items-center">
            <p>
                <strong>Nº Part 1 exercises:</strong> 
                <span title="New this week: {{ $stats['countWeekPart1'] }}"
                    style="cursor: help; font-weight: bold; font-size: 16px; color: black; margin-left: 4px;">{{ $stats['countPart1'] }}</span>
            </p>
            <p>
                <strong>Nº Part 2 exercises:</strong> 
                <span title="New this week: {{ $stats['countWeekPart2'] }}"
                    style="cursor: help; font-weight: bold; font-size: 16px; color: black; margin-left: 4px;">{{ $stats['countPart2'] }}</span>
            </p>
            <p>
                <strong>Nº Part 3 exercises:</strong> 
                <span title="New this week: {{ $stats['countWeekPart3'] }}"
                    style="cursor: help; font-weight: bold; font-size: 16px; color: black; margin-left: 4px;">{{ $stats['countPart3'] }}</span>
            </p>
            <p>
                <strong>Nº Part 4 exercises:</strong> 
                <span title="New this week: {{ $stats['countWeekPart4'] }}"
                    style="cursor: help; font-weight: bold; font-size: 16px; color: black; margin-left: 4px;">{{ $stats['countPart4'] }}</span>
            </p>

            <p>
                <strong>Avg Part 1 Score:</strong>
                <span
                    style="color:   {{ $stats['avgPart1Score'] < 4 ? 'red' : ($stats['avgPart1Score'] < 6 ? 'orange' : 'green') }}; ">
                    {{ $stats['avgPart1Score'] }}
                </span>
            </p>
            <p>
                <strong>Avg Part 2 Score:</strong>
                <span
                    style="color:  {{ $stats['avgPart2Score'] < 4 ? 'red' : ($stats['avgPart2Score'] < 6 ? 'orange' : 'green') }}; ">
                    {{ $stats['avgPart2Score'] }}
                </span>
            </p>
            <p>
                <strong>Avg Part 3 Score:</strong>
                <span
                    style="color:  {{ $stats['avgPart3Score'] < 4 ? 'red' : ($stats['avgPart3Score'] < 6 ? 'orange' : 'green') }}; ">
                    {{ $stats['avgPart3Score'] }}
                </span>
            </p>
            <p>
                <strong>Avg Part 4 Score:</strong>
                <span
                    style="color:  {{ $stats['avgPart4Score'] < 6 ? 'red' : ($stats['avgPart4Score'] < 9 ? 'orange' : 'green') }}; ">
                    {{ $stats['avgPart4Score'] }}
                </span>
            </p>


        </div>
    </div>
    <div
        class="place-self-center flex flex-row flex-1 px-4 gap-8 h-72 w-full bg-white rounded-lg border border-black shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col justify-center items-center w-1/3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" viewBox="0 0 640 512">
                <path fill="#1274b4"
                    d="M337.8 5.4C327-1.8 313-1.8 302.2 5.4L166.3 96 48 96C21.5 96 0 117.5 0 144L0 464c0 26.5 21.5 48 48 48l208 0 0-96c0-35.3 28.7-64 64-64s64 28.7 64 64l0 96 208 0c26.5 0 48-21.5 48-48l0-320c0-26.5-21.5-48-48-48L473.7 96 337.8 5.4zM96 192l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM96 320l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64c0-8.8 7.2-16 16-16zm400 16c0-8.8 7.2-16 16-16l32 0c8.8 0 16 7.2 16 16l0 64c0 8.8-7.2 16-16 16l-32 0c-8.8 0-16-7.2-16-16l0-64zM232 176a88 88 0 1 1 176 0 88 88 0 1 1 -176 0zm88-48c-8.8 0-16 7.2-16 16l0 32c0 8.8 7.2 16 16 16l32 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-16 0 0-16c0-8.8-7.2-16-16-16z" />
            </svg>
            <h3 class="text-center my-2 font-bold">Schools</h3>
            <a href="{{ route('admin.schools') }}">
                <button type="button"
                    class="text-gray-900 bg-white border border-black focus:outline-none hover:bg-yellow-200 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-transparent dark:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                    Manage
                </button>
            </a>
        </div>
        <div class="flex-1 my-auto items-center ">
            <p><strong>Total schools:</strong> {{ $stats['totalSchools'] }}</p>
            <p><strong>New schools this week:</strong> {{ $stats['weeklySchools'] }}</p>
            <p><strong>Average school size:</strong> {{ $stats['usersPerSchool'] }}</p>
            <p><strong>School growth this week:</strong> {{ $stats['schoolGrowth'] }}%</p>
            <p><strong>Most active school this week:</strong> {{ $stats['mostActiveSchool']}}</p>

        </div>
    </div>
</div>
