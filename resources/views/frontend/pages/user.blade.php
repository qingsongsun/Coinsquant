@php
    $base = 0.5; // 基本占比
    $progress1 = $basic; // 第一阶段完成度
    $progress2 = $final; // 第二阶段完成度
    $data = "$time";
@endphp

@extends('frontend.layout')

@section('content')
    <div class="p-gray-bg m-user">
        <div class="container">
            <div class="row user-section">
                <div class="col-xs-12 col-sm-5 user-left">
                    <img src="{{imgurl('form-login.png')}}" class="user-avatar">
                    <div class="user-name">{{ $user->user_name }}</div>
                    <input type="hidden" id="user_id" value="{{ $user->id }}">
                    {{--@if(!empty($user->user_no))--}}
                    @if(!empty($user->user_no))
                        <div class="user-auth-btn light"><i class="icon-user-id"></i>已完成实名认证</div>
                    @else
                        <a href="/user-auth">
                            <div class="user-auth-btn"><i class="icon-user-id"></i>请进行实名认证</div>
                        </a>
                    @endif

                    @if($user->is_check_mail == 1)
                        <div class="user-auth-btn light"><i class="icon-user-email"></i>已通过邮箱验证</div>
                    @else
                        <div class="user-auth-btn" id="send-auth-email"><i class="icon-user-email"></i>请进行邮箱认证</div>
                    @endif
                </div>

                <div class="col-xs-12 col-sm-7 user-right">
                    {{--api请求上限--}}
                    @if($count == 404)
                        <div class="api-error">由于当前系统查询数量过大，状态更新略有延迟，请稍后查看。</div>
                    @endif

                    {{--筹集模板模块--}}
                    <div class="m-funding-target">
                        @if($begin)
                            <div class="row ">
                                <div class="row ">
                                    <div class="col-xs-12 col-sm-8 fund-number">
                                        <div class="fund-top-number">
                                            <span class="fund-value" data-count="{{ $sum }}"></span>
                                            <span class="fund-unit">ETH</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="fund-key">基础目标 {{ $btc_count->btc_basic_count }} ETH</div>
                                            </div>

                                            <div class="col-xs-6">
                                                <div class="fund-key">目标上限 {{ $btc_count->btc_count }} ETH</div>
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

                                <div class="progress-base">
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
                                @if( $can === 0)
                                    <div class="purchase-btn gray">请先完成认证</div>
                                @else
                                    <a href="/purchase">
                                        <div class="purchase-btn">立即参与</div>
                                    </a>
                                @endif
                        @else
                            <div class="row ">
                                <div class="col-xs-12 fund-number" style="margin: auto">

                                    <div class="fund-top-number">
                                        <span class="fund-unit">基础目标</span>
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

                        @endif



                    </div>
                    <div class="user-head">量化币钱包</div>
                    <div class="user-money">
                        <div class="user-money-key">已认购量化币(CQT)</div>
                        <div class="user-money-value">
                            {{ $count }} <span class="user-money-unit">CQT</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="wallet-btn gray" id="withdraw">提币</div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="wallet-btn" onclick="location.reload()">刷新钱包余额</div>
                        </div>
                    </div>
                    <div class="wallet-tips">提示：通常认购确认需要2-10分钟，请耐心等待</div>
                </div>
            </div>

            @if($list != "")
                <div class="row user-section">
                    <div class="col-sm-12">

                        <table class="table">
                            <thead>
                            <tr>
                                <th class="user-head" colspan="6">
                                    认购记录
                                    <span class="coins-total">认购总共使用ETH: {{ $user->btc_count }}</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($list) == 0)
                                <tr>
                                    <td colspan="6" style="text-align: center;">
                                            暂无记录
                                    </td>
                                </tr>
                            @else
                                @foreach($list as $v)
                                    <tr>
                                        <td class="gray">认购时间：{{ $v->create_time }}</td>
                                        <td><i class="icon-eth"></i>使用ETH数量</td>
                                        <td class="blue">{{ $v->value }}</td>
                                        <td class="quant-key"><i class="icon-quant"></i>认购量化币数量</td>
                                        <td class="blue">{{ $v->lhb_count }}</td>
                                        <td class="blue">
                                            @if($v->status == 1)
                                                认购完成
                                                @else
                                                认购中
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(function () {
            var withdrawTips;
            $('#withdraw').hover(function () {
                withdrawTips = layer.tips('ICO结束后可提取量化币到您指定的以太坊地址，请耐心等待系统通知', '#withdraw');
            }, function () {
                layer.close(withdrawTips);
            });

            // 数字跳动
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
            })("{{ $data }}");

            $('#send-auth-email').click(function () {
                // todo 发送验证邮件api
                $.post('/api/userMail',function (obj) {
                    if(obj.code == 200){
                        layer.msg('邮箱发送成功,请及时通过验证',{icon:1});
                    }else{
                        layer.msg(obj.msg)
                    }
                })
            });
        });
    </script>
@endsection