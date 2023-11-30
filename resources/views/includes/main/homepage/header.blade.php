<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="FCP" />

    <meta name="description" content="THE FORMIDABLE CORPORATE PARTNERS">
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>{{$page_title?? 'FCP'}}</title>
    <!-- Stylesheets & Fonts -->
    <link href="{{asset('main/css/plugins.css')}}" rel="stylesheet">
    <link href="{{asset('main/css/style.css')}}" rel="stylesheet">
</head>
