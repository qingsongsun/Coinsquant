@php
    $lang = isset($lang) ? $lang : 'cn';
    $home = isset($home) ? $home : false;
@endphp

<div class="header-place-pc @if($home) home @endif">
    <div class="m-header-pc">
        <div class="container header-top">
            <a href="/">
                <img src="{{imgurl('color-logo.png')}}" alt="" id="logo">
            </a>
            {{--pc头部登陆--}}
            <div class="m-pc-header-login">
                @if($user == "")
                    <div class="header-not-login">
                        <a href="/login">
                            <button class="border">登陆</button>
                        </a>
                        <a href="/register">
                            <button>注册</button>
                        </a>
                    </div>
                @else
                    <div class="header-has-login">
                        <span class="user-name">{{ $user->user_name }}<i class="p-icon icon-arrow-down"></i></span>
                        <div class="login-float">
                            <div class="float-top">

                                <div class="user-name">

                                    {{ $user->user_name }}

                                </div>
                            </div>
                            <a href="/user">
                                <button class="border">参与认购</button>
                            </a>
                            <a href="/email-auth">
                                <a href="/change-pwd/coinlbhchage/method"><button class="border">修改密码</button></a>
                            </a>
                            <button class="login_out">退出登录</button>
                        </div>
                    </div>
                @endif
            </div>


            {{--登陆end--}}
        </div>

        <div class="nav-bar">
            <div class="container">
                <ul class="row">
                    <li class="nav-item"><a href="/#anchor-1" class="nav-link">首页</a></li>
                    <li class="nav-item"><a href="/#anchor-2" class="nav-link">项目</a></li>
                    <li class="nav-item"><a href="/#anchor-3" class="nav-link">ICO</a></li>
                    <li class="nav-item"><a href="/#anchor-4" class="nav-link">平台</a></li>
                    <li class="nav-item"><a href="/#anchor-6" class="nav-link">团队</a></li>
                    <li class="nav-item"><a href="/#anchor-7" class="nav-link">动态</a></li>
                    <li class="nav-item"><a href="/#anchor-8" class="nav-link">媒体</a></li>
                    <li class="nav-item"><a href="/#anchor-9" class="nav-link">联系我们</a></li>
                    {{--<li class="nav-item">--}}
                    {{--<a href="/cn" class="lang-tab-link @if($lang == 'cn') active @endif">CN</a>--}}
                    {{--/--}}
                    {{--<a href="/en" class="lang-tab-link @if($lang == 'en') active @endif">EN</a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="header-place-mobile">
    <div class="m-header-mobile">
        <div class="mobile-nav-top clearfix">
            <a href="/">
                <img src="{{imgurl('mobile-logo.png')}}" class="mobile-logo">
            </a>
            <div class="mobile-nav-btn">
                <div class="nav-btn-inner">
                    <div class="line"></div>
                </div>
            </div>
            {{--<div class="lang-btn">--}}
            {{--<a href="/cn" class="lang-tab-link @if($lang == 'cn') active @endif">CN</a>--}}
            {{--/--}}
            {{--<a href="/en" class="lang-tab-link @if($lang == 'en') active @endif">EN</a>--}}
            {{--</div>--}}
        </div>


        <div class="mobile-nav-bar">
            <ul class="clearfix">
                <li class="nav-item"><a href="/#anchor-1" class="nav-link">首页</a></li>
                <li class="nav-item"><a href="/#anchor-2" class="nav-link">项目</a></li>
                <li class="nav-item"><a href="/#anchor-video" class="nav-link">视频</a></li>
                <li class="nav-item"><a href="/#anchor-3" class="nav-link">ICO</a></li>
                <li class="nav-item"><a href="/#anchor-4" class="nav-link">平台</a></li>
                <li class="nav-item"><a href="/#anchor-6" class="nav-link">团队</a></li>
                <li class="nav-item"><a href="/#anchor-7" class="nav-link">动态</a></li>
                <li class="nav-item"><a href="/#anchor-8" class="nav-link">媒体</a></li>
                <li class="nav-item"><a href="/#anchor-9" class="nav-link">联系我们</a></li>
            </ul>
            {{--手机头部登陆--}}
            <div class="m-mobile-header-login">
                @if($user == "")
                    <div class="button-wrap">
                        <a href="/login">
                            <button class="border">登陆</button>
                        </a>
                        <a href="/register">
                            <button>注册</button>
                        </a>
                    </div>
                @else
                    <div class="button-wrap">
                        <a href="/user">
                            <button class="border">参与认购</button>
                        </a>
                        <a href="/email-auth">
                            <a href="/change-pwd/coinlbhchage/method"><button class="border">修改密码</button></a>
                        </a>
                        <button class="login_out">退出登录</button>
                    </div>
                    <span class="user-name">{{ $user->user_name }}</span>
                @endif
            </div>
            {{--登陆end--}}
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.login_out').click(function () {
            $.post('/api/login_out', function (obj) {
                layer.msg('退出成功');
                setTimeout(function () {
                    location.href = '/';
                }, 1000)
            })
        });

        $("a.nav-link").click(function () {
            var id = $(this).attr("href").replace('/', '');

            $("html, body").animate({
                scrollTop: $(id).offset().top - 100 + "px"
            }, {
                duration: 500,
                easing: "swing"
            });

            // 点击后移动端收缩
            $('.mobile-nav-btn').removeClass('active');
            $('.mobile-nav-bar').slideUp();

            return false;
        });

        // 移动端点击按钮切换导航
        $('.mobile-nav-btn').click(function () {
            var $this = $(this);

            if ($this.is('.active')) {
                $this.removeClass('active');
                $('.mobile-nav-bar').slideUp();
            } else {
                $this.addClass('active');
                $('.mobile-nav-bar').slideDown();
            }
        });

        $('.drop-down').click(function () {
            $("html, body").animate({
                scrollTop: $(window).height() + "px"
            }, {
                duration: 500,
                easing: "swing"
            });
        });

        // 导航栏伸缩
        var headerInit = function () {
            var scrollTop = $(window).scrollTop();
            var screenH = $(window).height();
            var limit = 0;
            var $headerPc = $('.m-header-pc');
            var $logo = $('#logo');

            if ($('.header-place-pc').is('.home')) {
                limit = screenH;
            }

            if (scrollTop > limit) {
                $headerPc.css('position', 'fixed');
                $logo.addClass('shrink');
            } else {
                $headerPc.css('position', 'absolute');
                $logo.removeClass('shrink');
            }
        };

        headerInit();
        $(window).on('scroll', function () {
            headerInit();
        });
    });
</script>