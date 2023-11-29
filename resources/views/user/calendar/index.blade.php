@extends('layouts.main')

@section('title') Calendar @stop

@section('styles')
<style>
    #calendar {
        max-width: 1100px;
        margin: 0 auto;
    }
</style>
@stop

@section('contents')
<div id='calendar'></div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialDate: '2023-01-12',
            initialView: 'timeGridWeek',
            nowIndicator: true,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [,
                {
                    title: 'Upo',
                    start: '2023-01-07',
                    end: '2023-01-10'
                },
                {
                    groupId: 999,
                    title: 'String Beans',
                    start: '2023-01-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Pechay',
                    start: '2023-01-16T16:00:00'
                },
                {
                    title: 'Tomato',
                    start: '2023-01-11',
                    end: '2023-01-13'
                },
                {
                    title: 'Cucumber',
                    start: '2023-01-12T10:30:00',
                    end: '2023-01-12T12:30:00'
                },
                {
                    title: 'Kangkong',
                    start: '2023-01-12T12:00:00'
                },
                {
                    title: 'Dynamite',
                    start: '2023-01-12T14:30:00'
                },
                {
                    title: 'Bombay',
                    start: '2023-01-12T17:30:00'
                },
                {
                    title: 'Eggplant',
                    start: '2023-01-12T20:00:00'
                }
            ]
        });

        calendar.render();
    });
</script>
@stop