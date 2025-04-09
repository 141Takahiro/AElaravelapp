<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'ANAHEIM ELECTRONICS')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'MS salePage')">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'ANAHEIM ELECTRONICS')">
    <meta property="og:description" content="@yield('description', 'ANAHEIM ELECTRONICS MS販売サイト')">
    <meta property="og:site_name" content="@yield('name', 'ANAHEIM ELECTRONICS')">
    <link href="{{ asset('layout.css') }}" rel="stylesheet">
    @yield('index.css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div class="wrapper">
<header>
    <div class="header-container">
        <img src="{{ asset('storage/photos/AElogo.jpg') }}" id="logo">
        <div id="text">
            <h1 id="philosophy"><span id="philosophy-text">FROM U.C.00 スプーンから宇宙戦艦まで</span></h1>
            <h2 id="greeting">ようこそ、{{ Auth::user()->name }}さん</h2>
        </div>
    </div>
    <nav>
        <ul id="menu">
            <li><a href="http://localhost:8000/AE">Mobile Suit</a></li>
            <li>Mobile Armor</li>
            <li>Battleship</li>
            <li><a href="/cart">Go to Cart</a></li>
        </ul>
    </nav>
</header>

<main class="mainscontent">
    @yield('maincontent')
</main>

<aside class="subcontent">
    @yield('subcontent')
</aside>

<footer>
    U.C.0079 M.Hue Carbine
</footer>
</div>
