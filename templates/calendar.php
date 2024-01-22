<?php

require_once __DIR__ . '/../infra/repositories/maintenanceRepository.php';

$maintenances = getAllMaintenance();

    $events = [];
    foreach ($maintenances as $maintenance) {
        $bgcolor = '#0dcaf0';
        $textColor = '#fff';

        if ($maintenance['id_estado'] == 4) {
            $bgcolor = '#ffc107';
            $textColor = '#000';

        } else if ($maintenance['id_estado'] == 2) {
            $bgcolor = '#198754';
        }

        $events[] = [
            'id' => $maintenance['id'],
            'title' => $maintenance['descricao'],
            'url' => '/sir/pages/secure/admin/list-manutencao.php?id=' . $maintenance['id_car'],
            'start' => $maintenance['dt_inicio'],
            'end' => $maintenance['dt_fim'],
            'backgroundColor' => $bgcolor,
            'borderColor' => $bgcolor,
            'textColor' => $textColor,
        ];
    }

?>


<div class="container mt-4">
    <div class="row">
        <div class="col">
            <div class="btn  special-border" id="calendar-backward"><i class="fa-solid fa-chevron-left"></i></div>
            <div class="btn  special-border" id="calendar-forward"><i class="fa-solid fa-chevron-right"></i></div>
            <div id='calendar'></div>
        </div>
    </div>
</div>

<style>

    body.#calendar {
        margin: 40px 10px;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js"></script>

<script>
    var calendar;

    const forward = document.getElementById('calendar-forward');

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            themeSystem: 'bootstrap5',
            contentHeight: 600,
            headerToolbar: {
                left: null,
                center: 'title',
                right: null
            },
            dayMaxEvents: true, // allow "more" link when too many events
            events: <?php echo json_encode($events); ?>,
        });

        calendar.render();
    });


    document.getElementById('calendar-forward').addEventListener('click', () => {
        if (calendar) {
            calendar.next();
        }
    });

    document.getElementById('calendar-backward').addEventListener('click', () => {
        if (calendar) {
            calendar.prev();
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.fc-toolbar-chunk')[0].append(document.getElementById('calendar-backward'));
        document.querySelectorAll('.fc-toolbar-chunk')[2].append(document.getElementById('calendar-forward'));
    })

</script>