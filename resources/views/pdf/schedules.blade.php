<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Horarios semanales</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #0f172a;
            font-size: 12px;
            margin: 28px;
        }

        .header {
            background: {{ $primaryColor }};
            color: #ffffff;
            padding: 20px 22px;
            border-radius: 14px;
            margin-bottom: 24px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 6px 0;
        }

        .subtitle {
            font-size: 13px;
            margin: 0;
            opacity: 0.95;
        }

        .academy-name {
            font-size: 14px;
            margin-top: 10px;
            font-weight: bold;
        }

        .day-block {
            margin-bottom: 22px;
        }

        .day-title {
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
            background: {{ $secondaryColor }};
            padding: 9px 12px;
            border-radius: 10px 10px 0 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }

        th,
        td {
            border: 1px solid #dbe4ee;
            padding: 9px 10px;
            vertical-align: top;
        }

        th {
            background: #f8fafc;
            text-align: left;
            font-weight: bold;
            color: #334155;
        }

        td {
            background: #ffffff;
        }

        .empty {
            padding: 12px;
            border: 1px dashed #cbd5e1;
            border-top: none;
            background: #f8fafc;
            color: #64748b;
            border-radius: 0 0 10px 10px;
        }

        .footer {
            margin-top: 28px;
            font-size: 11px;
            color: #64748b;
            text-align: right;
        }

        .muted {
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="header">
        <p class="title">Horarios semanales</p>
        <p class="subtitle">
            Semana del {{ $weekStart->format('d/m/Y') }} al {{ $weekEnd->format('d/m/Y') }}
        </p>
        <p class="academy-name">{{ $academy->name }}</p>
    </div>

    @if ($selectedStyle || $selectedTeacher || $selectedDayLabel)
        <div
            style="margin-bottom: 18px; padding: 12px; background: #f8fafc; border: 1px solid #dbe4ee; border-radius: 10px;">
            <div style="font-size: 12px; font-weight: bold; margin-bottom: 6px; color: #334155;">
                Filtros aplicados
            </div>

            @if ($selectedStyle)
                <div style="font-size: 12px; margin-bottom: 4px;">
                    <strong>Estilo:</strong> {{ $selectedStyle->name }}
                </div>
            @endif

            @if ($selectedTeacher)
                <div style="font-size: 12px; margin-bottom: 4px;">
                    <strong>Profesor:</strong> {{ $selectedTeacher->name }}
                </div>
            @endif

            @if ($selectedDayLabel)
                <div style="font-size: 12px;">
                    <strong>Día:</strong> {{ $selectedDayLabel }}
                </div>
            @endif
        </div>
    @endif

    @foreach ($days as $dayKey => $dayLabel)
        @php
            $daySchedules = $schedules->get($dayKey, collect());
        @endphp

        <div class="day-block">
            <div class="day-title">{{ $dayLabel }}</div>

            @if ($daySchedules->isEmpty())
                <div class="empty">No hay clases programadas para este día.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th style="width: 18%;">Hora</th>
                            <th style="width: 22%;">Clase</th>
                            <th style="width: 25%;">Profesores</th>
                            <th style="width: 15%;">Nivel</th>
                            <th style="width: 20%;">Sala</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daySchedules as $schedule)
                            <tr>
                                <td>
                                    {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
                                </td>
                                <td>
                                    {{ $schedule->danceStyle->name }}
                                </td>
                                <td>
                                    {{ $schedule->teachers->pluck('name')->join(', ') ?: 'Sin profesores' }}
                                </td>
                                <td>
                                    {{ $schedule->level ?: 'Sin nivel' }}
                                </td>
                                <td>
                                    {{ $schedule->room ?: 'Sin sala' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endforeach

    <div class="footer">
        Documento generado el {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>
