<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="shortcut icon" href="{{ url('public/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('public/assets/css/responsive.css') }}">
</head>
<body>
    <div class="main-wrapper">
        <div class="main_sub_wrapper">

            @include('includes.sidebar')

            <div class="right_section">
                @include('includes.header')

                <div class="rignt_section_bottom">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    {{-- ✅ This will load custom page scripts --}}
    @stack('scripts')
</body>
</html>
