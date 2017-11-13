<!doctype html>
<html lang="cn_zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title or 'CoinsQuant量化币' }}</title>
    <script>
        (function (doc, win) {
            var docEle = doc.documentElement,
                evt = 'onorientationchange' in window ? 'orientationchange' : 'resize',

                fn = function () {
                    var width = docEle.clientWidth;

                    if (width > 1000) {
                        width && (docEle.style.fontSize = 192 + 'px');
                    } else if (width > 750) {
                        width && (docEle.style.fontSize = 150 + 'px');
                    } else {
                        width && (docEle.style.fontSize = 120 + 'px');
                    }
                };
            win.addEventListener(evt, fn, false);
            doc.addEventListener('DOMContentLoaded', fn, false);
        })(document, window);
    </script>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{--todo google--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <script src="//cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/js/layer/layer.js"></script>
    <script src="{{mix('/js/app.js')}}"></script>
    <script>
        layer.config({
            time: 3000,
        });
    </script>
</head>
<body>
@section('header')
    @include('frontend.components.header')
@show


@section('content')
@show

@include('frontend.components.footer')
</body>
</html>