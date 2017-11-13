@extends('frontend.layout')

@section('content')
{{--    @include('frontend.components.header')--}}

    <div class="p-gray-bg m-login">
        <div class="p-wrap-narrow">
            <div class="m-form-wrap">
                <h3 class="form-head">登录</h3>
                <form id="data">
                    <input type="text" class="form-input" placeholder="会员名称/邮箱/手机号" name="account">
                    <input type="password" class="form-input" placeholder="输入密码" name="user_pwd">
                    <div class="clearfix">
                        <input type="text" class="form-small-input" placeholder="图片验证" name="captcha">
                        {{--<img src="{{imgurl('verify-img.png')}}" alt="" class="verify-img">--}}
                        <img src="{{ URL('/login/captcha/1') }}" alt="" id="captcha" class="verify-img">
                        <div class="captcha">
                            <span>换一张</span>
                        </div>
                    </div>
                    <div class="checkbox-wrap">
                    <span class="p-checkbox">
                            <input type="checkbox" id="checkbox" class="checkbox-input" hidden>
                            <label class="checkbox-inner" for="checkbox"></label>
                        </span>
                        <span>记住密码，方便以后在这台电脑登录</span>
                        <span class="find-pwd">找回密码</span>
                    </div>
                </form>

                <div class="p-btn" id="login">登录</div>
            </div>
        </div>
    </div>
    <script>
        $('.captcha').click(function () {
            $url = "{{ URL('/login/captcha') }}";
            $url = $url + "/" + Math.random();
            $('#captcha').attr('src',$url);
        });

        $('.find-pwd').click(function () {
            location.href = '/email-auth';
        })

        $('#login').click(function () {
            if($('.form-small-input').val() == ""){
                layer.msg('验证码不能为空');
                $url = "{{ URL('/login/captcha') }}";
                $url = $url + "/" + Math.random();
                $('#captcha').attr('src',$url);
                return false;
            }
            $.post('/api/login',$('#data').serialize(),function (obj) {
                if(obj.code == 200){
                    layer.msg(obj.msg);
                    setTimeout(function () {
                        location.href = "/user";
                    },1000);

                }else if(obj.code == 402){
                    layer.msg('验证码不正确');
                    $url = "{{ URL('/login/captcha') }}";
                    $url = $url + "/" + Math.random();
                    $('#captcha').attr('src',$url);
                }else{
                    layer.msg(obj.msg)
                }
            })
        })
    </script>
@endsection