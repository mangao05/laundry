<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css'/>

    @yield('style')
    <style>

        .letter-spacing{
                letter-spacing: 1px;
            }
            body{
                background-image:url('image/login_bg1.png');
                background-position:center;
                background-size: cover;
            }
            .input-group.md-form.form-sm.form-1 input{
                border: 1px solid #bdbdbd;
                border-top-right-radius: 0.25rem;
                border-bottom-right-radius: 0.25rem;
            }
            .input-group.md-form.form-sm.form-2 input {
                border: 1px solid #bdbdbd;
                border-top-left-radius: 0.25rem;
                border-bottom-left-radius: 0.25rem;
            }
            .input-group.md-form.form-sm.form-2 input.red-border  {
                border: 1px solid #0080ff;
            }
            .input-group.md-form.form-sm.form-2 input.lime-border  {
                border: 1px solid #0080ff;
            }
            .input-group.md-form.form-sm.form-2 input.amber-border  {
                border: 1px solid #0080ff;
            }
            .btn-rounded{
                border-radius: 30px; !important;
            }
    </style>
</head>
<body>
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js'></script> --}}

</body>
</html>
