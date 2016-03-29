<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Example project">
        <meta name="author" content="Joe Doherty">
        <link rel="favicon.ico" type="image/x-icon"/>
        {{ stylesheet_link('css/app.css') }}
        {{ stylesheet_link('css/foundation-flex.css') }}
        {{ stylesheet_link('css/foundation-icons/foundation-icons.css') }}
        {{ get_title() }}
    </head>
    <body>
        {{ content() }}
        {{ javascript_include('js/vendor/jquery.min.js') }}
        {{ javascript_include('js/vendor/what-input.js') }}
        {{ javascript_include('js/foundation.min.js') }}
        {{ javascript_include('js/app.js') }}
    </body>
</html>