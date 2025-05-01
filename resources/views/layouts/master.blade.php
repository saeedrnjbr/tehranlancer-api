<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('/favicon.png') }}">
    @vite(['resources/css/app.css'])
    <link type="text/css" rel="stylesheet" href="{{ asset('/persian-datepicker/dist/css/persian-datepicker.min.css') }}" />
</head>

<body dir="rtl" x-data="{ 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{ 'dark text-bodydark bg-boxdark-2': darkMode === true }">
    @yield('content')
    <script defer src="{{ asset('bundle.js') }}"></script>
    <script src="{{ asset('/jquery.min.js') }}"></script>
    <script src="{{ asset('/ckeditor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/persian-date/dist/persian-date.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/persian-datepicker/dist/js/persian-datepicker.min.js') }}"></script>
    <script>
        ClassicEditor.create(document.getElementById("about_editor"))
        ClassicEditor.create(document.getElementById("favorites_editor"))
        ClassicEditor.create(document.getElementById("skills_editor"))

        $(".persianDatepicker").pDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false,
            initialValueType: 'persian',
            isRTL: true,
            initialValue: false,
            persianDigit: false
        });

    </script>
</body>

</html>
