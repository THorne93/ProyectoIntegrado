<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Statistics PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            /* smaller base font */
            color: #333;
            margin: 20px;
        }

        h1 {
            font-size: 14px;
            margin-bottom: 15px;
        }

        h2 {
            background-color: #f2f2f2;
            padding: 4px 8px;
            /* reduced padding */
            margin-bottom: 6px;
            font-size: 12px;
            /* smaller heading */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            /* tighter spacing between tables */
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 3px 6px;
            /* tighter padding */
            text-align: left;
            font-size: 9px;
            /* smaller cell text */
        }

        thead {
            background-color: #eee;
        }
    </style>

</head>

<body>
    <h1>Statistics for {{ $user->name . ' ' . $user->surname }}. Dated
        {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h1>

        <h3 style="color: orange;">Prediction (BETA) {!! $prediction !!}</h3>
    <div class="grid-container">
        @foreach ($detailedStats as $key => $stat)
            <div class="table-wrapper">
                <h2>{{ $key }} - Part {{ $stat[0]->part }}</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time Taken (m:s)</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stat as $record)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y h:i A') }}</td>
                                <td>
                                    {{ str_pad(floor($record->time / 60), 2, '0', STR_PAD_LEFT) }}:
                                    {{ str_pad($record->time % 60, 2, '0', STR_PAD_LEFT) }}
                                </td>
                                <td>{{ $record->score }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</body>

</html>
