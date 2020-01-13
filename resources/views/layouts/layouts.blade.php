<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Headタグ内に足す -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vue + axios + VueRouter-->
    <script src="https://unpkg.com/vue@2.5.17"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.18.0/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue-router@3.0.1"></script>

    <!-- CSS -->
    <!-- hrefの書き方間違えると公開側でlinkがhttpになって弾かれるので注意しよう -->
    <link href="/css/main.css" rel="stylesheet" type="text/css">

    <!-- icon -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body>
    @yield('content')
</body>
</html>
