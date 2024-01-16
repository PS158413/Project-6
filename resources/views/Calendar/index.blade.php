<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    @vite('resources/css/app.css')
</head>

<body>


    <div id="calendar"></div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: '08:00:00',
                slotMaxTime: '20:00:00',
                timeZone: 'Europe/Amsterdam',
                locale: 'nl',
                allDaySlot: false,
                events: <?php echo json_encode($events ?? []); ?>,
                customButtons: {
                    createAppointmentButton: {
                        text: 'Afwezigheid',
                        click: function() {
                            window.location.href = '{{ route("create") }}';
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next,createAppointmentButton',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Vandaag',
                    week: 'Week',
                    day: 'Vandaag',
                },
                eventClick: function(info) {
                    var eventId = info.event.id;
                    var editUrl = '{{ route("edit", ":id") }}'.replace(':id', eventId);
                    window.location.href = editUrl;
                },
            });

            calendar.render();

        });


    </script>




</body>

</html>
