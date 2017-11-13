@php
    $base = 0.5; // 基本占比
    $progress1 = $basic; // 第一阶段完成度
    $progress2 = $final; // 第二阶段完成度
    $login = empty($user)? false :true; // 是否登录
    /*$begin = $begin;*/ // 是否开始
    $date = "$time"; // 开始或结束时间
@endphp

@extends('frontend.layout')

@section('header')
@endsection

@section('content')
    <div class="m-home">
        {{--{{ $user }}--}}
        <div class="section-top" id="anchor-1">
            <div id="particles-js"></div>

            <div class="center-text-wrap">
                <img src="{{imgurl('index-first-login.png')}}" alt="" class="center-logo">
                {{--<img src="{{imgurl('center-text.png')}}" alt="" class="big-text">--}}
                <div class="big-text">
                    <h2>CoinsQuant量化币</h2>
                    <h3>全球数字代币量化交易基石生态平台</h3>
                    <h3>ICO即将启动</h3>
                </div>
            </div>

            <div class="drop-down"></div>
        </div>

        @include('frontend.components.header', ['home'=> true])

        {{--技术--}}
        <div class="section-technology" id="anchor-2">
            <div class="container">
                <div class="section-title">
                    <h3 class="text-title">CoinsQuant量化币核心能力</h3>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-1"></div>
                            <div class="item-text">
                                <div class="item-title">量化交易API及联通交易所的 低延迟服务器(co-location)</div>
                                <div class="item-subtitle">对标上期技术, 中金技术</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-2"></div>
                            <div class="item-text">
                                <div class="item-title">数据服务：细颗粒度历史数 据和因子模型</div>
                                <div class="item-subtitle">对标Bloomberg/MSCI/万得</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-3"></div>
                            <div class="item-text">
                                <div class="item-title">指数编制推送以及对应ETF自动交易服务</div>
                                <div class="item-subtitle">对标中证指数有限公司, S&P编制指数, 同时也提供相应的ETF代客交易</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-4"></div>
                            <div class="item-text">
                                <div class="item-title">Flow Trading业务/算法交易 twap/vwap/smart routing</div>
                                <div class="item-subtitle">对标ITG, Morgan Stanley Flow Trading业务</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-5"></div>
                            <div class="item-text">
                                <div class="item-title">杠杆/融资融币交易服务</div>
                                <div class="item-subtitle">对标券商资本中介近似业务</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="tech-item">
                            <div class="p-icon icon-tech-6"></div>
                            <div class="item-text">
                                <div class="item-title">种子基金孵化和回测框架</div>
                                <div class="item-subtitle">对标Quantopian</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--视频--}}
        <div class="section-video container" id="anchor-video">
            <div class="video-wrap">
                <video preload="auto" controls id="video">
                    <source src="http://lhb.sunday.so/file/index-video-h264.mp4" type="video/mp4"/>
                </video>
                <img src="{{imgurl('video-layer.jpg')}}" alt="" class="video-layer">
            </div>

            <div class="text-wrap">
                <a href="http://lhb.sunday.so/file/coinspdf20170829.pdf" target="_blank">
                    <button class="p-btn file-name">CoinsQuant量化币白皮书下载</button>
                </a>
            </div>
        </div>

        {{--众筹--}}
        <div class="section-funding" id="anchor-3">
            <div class="container">
                <div class="section-title">
                    <h3 class="text-title">CoinsQuant量化币ICO目标筹集</h3>
                </div>
                {{--筹集模板模块--}}
                <div class="m-funding-target">
                    @if($begin)
                        <div class="row ">
                            <div class="col-xs-12 col-sm-8 fund-number">
                                <div class="fund-top-number">
                                    <span class="fund-value" data-count="{{ $btc }}"></span>
                                    <span class="fund-unit">ETH</span>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="fund-key">基础目标{{ $btc_count->btc_basic_count }}</div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="fund-key">最终目标 {{ $btc_count->btc_count }}</div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xs-6 col-sm-2 fund-number">
                                <div class="fund-value" data-count="{{ $person->count }}"></div>
                                <div class="fund-key">参与人数</div>
                            </div>

                            <div class="col-xs-6 col-sm-2 fund-number">
                                <div class="fund-value" data-count="{{ $person->time }}"></div>
                                <div class="fund-key">支持次数</div>
                            </div>
                        </div>

                        <div class="progress-base" style="margin-top: 50px">
                            <div class="progress-1" style="width: {{$progress1 * $base * 100}}%;">
                                <div class="progress-inner">@if($progress1 == 1) 基本目标已达成 @else {{$progress1 * 100}}
                                    % @endif</div>
                            </div>
                            <div class="progress-2" style="width: {{$progress2 * (1 - $base) * 100}}%;">
                                <div class="progress-inner">@if($progress2 == 1)
                                        终极目标已达成 @elseif($progress2 == 0) @else {{$progress2 * 100}}
                                        % @endif</div>
                            </div>
                        </div>

                        <div class="fund-countdown">
                            截止倒计时：
                            <span class="blue" id="day">00</span>天
                            <span class="blue" id="hour">00</span>时
                            <span class="blue" id="min">00</span>分
                            <span class="blue" id="sec">00</span>秒
                        </div>

                        <a href="/user">
                            <div class="purchase-btn">立即参与</div>
                        </a>
                    @else
                        <div class="row ">
                            <div class="col-xs-12 fund-number">

                                <div class="fund-top-number">
                                    <span class="fund-unit">基础目标 </span>
                                    <span class="fund-value" data-count="{{ $btc_count->btc_basic_count }}"></span>
                                    <span class="fund-unit">ETH</span>
                                </div>
                                <div class="fund-key">目标上限 {{ $btc_count->btc_count }}ETH</div>
                            </div>
                        </div>

                        <div class="fund-countdown">
                            开始倒计时：
                            <span class="blue" id="day">00</span>天
                            <span class="blue" id="hour">00</span>时
                            <span class="blue" id="min">00</span>分
                            <span class="blue" id="sec">00</span>秒
                        </div>

                        @if($login)
                            <a href="/user">
                                <div class="p-btn">立即参与</div>
                            </a>
                        @else
                            <a href="/login">
                                <div class="p-btn">立即参与</div>
                            </a>
                        @endif

                    @endif
                </div>
            </div>
        </div>

        {{--平台--}}
        <div class="section-platform" id="anchor-4">
            <div class="container">
                <div class="section-title">
                    <h3 class="text-title">其他参与平台</h3>
                </div>

                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/bian.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/bijiaosuo.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/bijiu.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/biter.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/biying.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/haifengteng.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/jubi.svg')}}" class="platform-item">
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-4 platform-wrap">
                        <img src="{{imgurl('media/lianhang.svg')}}" class="platform-item">
                    </div>
                </div>
            </div>
        </div>

        {{--创始人--}}
        <div class="section-founder" id="anchor-6">
            <div class="container">
                <div class="section-title">

                    <h3 class="text-title">CoinsQuant量化币团队</h3>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="founder-item">
                            <img src="{{imgurl('founder-fan.png')}}" alt="" class="founder-avatar">
                            <h3 class="founder-name">联合创始人/CTO 范鸿敏先生</h3>
                            <div class="founder-title">Co-Founder/CTO  Mr. Hongmin Fan</div>
                            <div class="founder-intro">
                                美国康奈尔大学计算机硕士，电子工程博士课程休学创业。美国大数据公司Vertica早期技术员工，被惠普收购后担任Vertica数据库引擎组技术负责人(tech
                                lead)。出走加入初创人工智能公司Nutonian后负责机器学习算法改进和大规模部署，公司被DataRobot收购。2014年用统计方法开发了以太币高频做市商策略，年化收益率超过70%；2015年开发国内商品期货量化高频策略，占该交易品种总交易量2%，年化收益率80%以上。有丰富的技术管理和量化交易实践经验。
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="founder-item">
                            <img src="{{imgurl('founder-ma.png')}}" alt="" class="founder-avatar">
                            <h3 class="founder-name">联合创始人/CEO 马学韬先生</h3>
                            <div class="founder-title">Co-Founder/CEO Mr. Xuetao Ma</div>
                            <div class="founder-intro">
                                上海交通大学控制科学与工程硕士，自动化学士。主流投资银行业8年从业经历，曾任职于中国顶尖券商国泰君安证券投资银行部、并购部、兴业证券固定收益部、并担任一级分公司负责人等重要管理职务。具有丰富的投资银行全业务领导经验，历史业绩横跨IPO、兼并收购、债务融资、资产证券化等多种投行服务品种。曾参与农业银行IPO、中石化可转债、上海汽车定向增发等大型投行业务，具备丰富的金融业务组织协调能力。擅长大中型金融机构的风控体系建设、业务架构建设。
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--动态--}}
        <div class="section-news" id="anchor-7">
            <div class="container">
                <div class="section-title">

                    <h3 class="text-title">最新动态</h3>
                </div>

                <div class="row">
                    <div class="swiper-container" id="swiper">
                        <div class="swiper-wrapper">
                            @for ($i = 0; $i < $BlogCount; $i++)
                                <div class="swiper-slide">
                                    @foreach($BlogData[$i] as $item)
                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="news-item">
                                                <div class="news-inner">
                                                    <img class="news-img" src="{{ $item->pic }}" alt="">

                                                    <div class="news-text">
                                                        <h3 class="news-title">{{ $item->title }}</h3>
                                                        <div class="news-desc">{{ $item->content }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>

        {{--媒体--}}
        <div class="section-media" id="anchor-8">
            <div class="container">
                <div class="section-title">
                    <h3 class="text-title">CoinsQuant量化币合作媒体</h3>
                </div>

                <div class="row">
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_36kr.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_8btc_cn.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_bitcoinmagazine.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_bitkan.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_coindesk_1.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_8btc_en.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_cointelegraph.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_cry.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_jiemian.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_jpm.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_lieyun.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_medium.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_newsb.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_tmt.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_touzijie.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_tuoniao.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_weiyang.svg')}}" alt="">
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-6 media-item">
                        <img src="{{imgurl('media/media_yiou.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>

        {{--联系我们--}}
        <div class="section-contact" id="anchor-9">
            <div class="container">
                <div class="section-title">
                    <h3 class="text-title">联系我们</h3>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="input-wrap nickname">
                            <input type="text" class="contact-input" placeholder="昵称" id="nickname">
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="input-wrap email">
                            <input type="text" class="contact-input" placeholder="邮箱" id="email">
                        </div>
                    </div>
                </div>
                <textarea class="contact-textarea" placeholder="请填写留言内容"></textarea>

                <div class="p-btn feedback">提交</div>
            </div>
        </div>

    </div>

    <script>
        $(function () {
            $('.feedback').click(function () {
                var nickname = $('#nickname').val();
                var email = $('#email').val();
                var content = $('.contact-textarea').val();
                var data = [
                    nickname,
                    email,
                    content,
                ];
                if (nickname == "") {
                    layer.msg('请填写您的昵称')
                } else if (email == "") {
                    layer.msg('请填写您的邮箱，方便我们与您联系')
                } else if (content == "") {
                    layer.msg('请填写您的留言');
                } else {
                    $.post('/api/feedback', {data: data}, function (obj) {
                        layer.msg(obj.msg)
                    });
                }

            });


            $('.video-layer').click(function () {
                $(this).fadeOut();
                $('#video').get(0).play();
            });

            // 数字跳动
            var countFlag = true;
            var doCount = function () {
                var windowSt = $(window).scrollTop();
                var sectionSt = $('#anchor-3').scrollTop();

                if (windowSt > sectionSt - 100 && countFlag) {
                    countFlag = false;

                    $('.fund-value').each(function () {
                        var $this = $(this),
                            countTo = $this.attr('data-count');

                        $({countNum: 0}).animate({
                            countNum: countTo
                        }, {
                            duration: 3000,
                            easing: 'linear',
                            step: function () {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function () {
                                $this.text(this.countNum);
                            }
                        });
                    });
                }
            };
            doCount();
            $(window).on('scroll', function () {
                doCount();
            });

            // 倒计时
            (function (target) {
                var timer;
                var targetDate = new Date(target);
                var res = {
                    day: 0,
                    hour: 0,
                    min: 0,
                    sec: 0,
                };

                var addZero = function (number) {
                    number = parseInt(number);

                    if (number < 0) {
                        return 0;
                    } else if (number < 10) {
                        return '0' + String(number);
                    } else {
                        return number;
                    }
                }

                var updateTime = function () {
                    var time = targetDate - new Date();
                    if (time <= 0) {
                        clearInterval(timer);
                    }

                    res.day = addZero(time / 1000 / 60 / 60 / 24);
                    res.hour = addZero(time / 1000 / 60 / 60 % 24);
                    res.min = addZero(time / 1000 / 60 % 60);
                    res.sec = addZero(time / 1000 % 60);

                    for (key in res) {
                        $('#' + key).text(res[key]);
                    }
                }

                updateTime();
                timer = setInterval(function () {
                    updateTime();
                }, 1000);
            })("{{$date}}");
        });
    </script>
@endsection