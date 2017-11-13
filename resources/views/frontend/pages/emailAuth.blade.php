@extends('frontend.layout')

@section('content')

    <div class="p-gray-bg m-login">
        <div class="p-wrap-narrow">
            <div class="m-form-wrap">
                <h3 class="form-head">找回密码</h3>
                <input type="text" class="form-input" placeholder="已验证邮箱">
                <div class="clearfix find-pwd-code" check="0">
                    <input type="text" class="form-small-input" placeholder="图片验证" name="captcha">
                    {{--<img src="{{imgurl('verify-img.png')}}" alt="" class="verify-img">--}}
                    <img src="{{ URL('/login/captcha/1') }}" alt="" id="captcha" class="verify-img">
                    <div class="captcha">
                        <span>换一张</span>
                    </div>
                </div>
                <div class="p-btn" id="p-no-code">发送邮件</div>
            </div>
        </div>
    </div>
    <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $('#p-no-code').click(function () {
            var mail = $('.form-input').val();
            var captcha = $('.form-small-input').val();
            if($('.clearfix').attr('check') == 1){
                if(captcha == ""){
                    layer.msg('请输入验证码',{icon:2});
                    return false;
                }
            }
            if($('.form-input').val() == ""){
                layer.msg('请填写邮箱信息')
            }else{
                var  ip= returnCitySN["cip"];
                $.post('/api/mail',{user_mail:mail,type:1,ip:ip,captcha:captcha},function (obj) {
                    var hash = {
                        'qq.com': 'http://mail.qq.com',
                        'gmail.com': 'http://mail.google.com',
                        'sina.com': 'http://mail.sina.com.cn',
                        '163.com': 'http://mail.163.com',
                        '126.com': 'http://mail.126.com',
                        'yeah.net': 'http://www.yeah.net/',
                        'sohu.com': 'http://mail.sohu.com/',
                        'tom.com': 'http://mail.tom.com/',
                        'sogou.com': 'http://mail.sogou.com/',
                        '139.com': 'http://mail.10086.cn/',
                        'hotmail.com': 'http://www.hotmail.com',
                        'live.com': 'http://login.live.com/',
                        'live.cn': 'http://login.live.cn/',
                        'live.com.cn': 'http://login.live.com.cn',
                        '189.com': 'http://webmail16.189.cn/webmail/',
                        'yahoo.com.cn': 'http://mail.cn.yahoo.com/',
                        'yahoo.cn': 'http://mail.cn.yahoo.com/',
                        'eyou.com': 'http://www.eyou.com/',
                        '21cn.com': 'http://mail.21cn.com/',
                        '188.com': 'http://www.188.com/',
                        'foxmail.com': 'http://www.foxmail.com',
                        'outlook.com': 'http://www.outlook.com'
                    };
                    var _mail = mail.split('@')[1];    //获取邮箱域
                    for (var j in hash){
                        if(j == _mail){
                            var href = hash[_mail];    //替换登陆链接
                        }
                    }
                    if(obj.code == 200){
                        layer.alert('已向你的邮箱<a href="'+href+'" class="p-blue">'+mail+'<a>发送验证邮件，请及时验证', {icon: 6});
                    }else if(obj.code == 402){
                            layer.msg("该邮箱暂未注册",{icon:2});
                        $('.clearfix').removeClass('find-pwd-code');
                        $('.clearfix').attr('check',1);
                    }else if(obj.code == 405){
                        layer.msg(obj.msg,{icon:2});
                        $url = "{{ URL('/login/captcha') }}";
                        $url = $url + "/" + Math.random();
                        $('#captcha').attr('src',$url);
                    }else{
                        layer.msg(obj.msg,{icon:2})
                    }
                })
            }
        });

        $('.captcha').click(function () {
            $url = "{{ URL('/login/captcha') }}";
            $url = $url + "/" + Math.random();
            $('#captcha').attr('src',$url);
        });
    </script>
@endsection