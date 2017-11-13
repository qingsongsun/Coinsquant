@extends('frontend.layout')

@section('content')
    <div class="p-gray-bg m-login">
        <div class="p-wrap-narrow">
            <div class="m-form-wrap">
                <h3 class="form-head">身份认证</h3>
                <input type="text" class="form-input" placeholder="你的真实姓名" id="user_name">
                <input type="text" class="form-input" placeholder="你的身份证号" id="user_no">
                <input type="text" class="form-input" placeholder="手机号码" id="user_phone">
                <div class="clearfix">
                    <input type="text" class="form-small-input" placeholder="验证码" id="code">
                    <div class="verify-btn">获取验证码</div>
                </div>
                <div class="checkbox-wrap">
                    <span class="p-checkbox">
                            <input type="checkbox" id="checkbox" class="checkbox-input" hidden>
                            <label class="checkbox-inner" for="checkbox"></label>
                    </span>
                    <span>已满18岁以上，并且同意用户协议和隐私政策</span>
                </div>
                <div class="p-btn">身份认证</div>
                <div class="form-desc-text">
                    <div class="p-blue declare-btn">foreign user&gt;</div>
                </div>
            </div>
        </div>

        <div class="user-auth-declare">
            <h3 class="declare-title">认责申明</h3>
            <div class="declare-content">不进行实名认证, 后果自负</div>
        </div>
    </div>

    <script>
        $(function () {

            var timer = null;
            $('.verify-btn').click(function () {
                var user_name   = $('#user_name').val();
                var user_no     = $('#user_no').val();
                var user_phone  = $('#user_phone').val();
                var s = check(user_name,user_no,user_phone,0,0);
                if(s != 404){
                    $.post('/api/code',{user_phone:user_phone},function (obj) {
                        if(obj.code == 200){
                            layer.msg('短信发送成功');
                        }
                    });
                    if (timer) {
                        return;
                    }

                    var count = 60;
                    $this = $(this);
                    $this.addClass('gray').text(count + '秒后重新获取');
                    timer = setInterval(function () {
                        count--;
                        $this.text(count + '秒后重新获取');
                        if (count <= 0) {
                            $this.text('获取验证码');

                            clearInterval(timer);
                            $this.removeClass('gray')
                        }
                    }, 1000);
                }
            });

            $('.p-btn').click(function () {
                var user_name   = $('#user_name').val();
                var user_no     = $('#user_no').val();
                var user_phone  = $('#user_phone').val();
                var code        = $('#code').val();
                var checked       = $("input[type='checkbox']").is(':checked');
                var s = check(user_name,user_no,user_phone,code,1,checked);
                if(s != 404){
                    $.post('/api/phoneCheck',{user_name:user_name,user_no:user_no,user_phone:user_phone,code:code},function (obj) {
                        if(obj.code == 200){
                            layer.msg(obj.msg);
                            setTimeout(function () {
                                location.href = '/user';
                            },1000);
                        }else{
                            layer.msg(obj.msg,{icon:2});
                        }

                    })
                }
            });


            $('.declare-btn').click(function () {
                layer.open({
                    type: 1,
                    title: false,
                    btn: ['确认', '取消'],
                    time: 0,
                    closeBtn: 0,
                    area: '500px',
                    shadeClose: true,
                    content: $('.user-auth-declare'),

                    yes: function (index, layero) {
                        //确认后确认实名制  外国人
                        $.post('/api/foreign',function (obj) {
                            if(obj.code == 200){
                                layer.msg('Authentication Through !');
                                setTimeout(function () {
                                    location.href = '/user';
                                },1000)
                            }else{
                                layer.msg('Already Passed !')
                            }
                        })
                    },
                    btn2: function (index, layero) {

                    },
                });
            });


            function check(user_name,user_no,user_phone,code,type,check) {
                if(user_name=="" || user_no=="" || user_phone == ""){
                    layer.msg('请填写完整信息');
                    return 404;
                }else{
                    if(user_no.length >= 15 && user_no.length <= 18){
                        if(user_no.length == 18){
                            if(!(/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/).test(user_no)){
                                layer.msg('请填写正确的身份证号');
                                return 404;
                            }
                        }else if(user_no.length == 15){
                            if(!(/^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}[0-9Xx]$/.test(user_no))){
                                layer.msg('请填写正确的身份证号');
                                return 404;
                            }
                        }

                        if(!(/^1[34578]\d{9}$/.test(user_phone))){
                            layer.msg('请填写正确的手机号');
                            return 404;
                        }
                    }else{
                        layer.msg('请填写正确的身份证号');
                        return 404;
                    }
                }

                if(type == 1){
                    if(code == ""){
                        layer.msg('请填写验证码');
                        return 404;
                    }
                    if(check == false){
                        layer.msg('请同意协议');
                        return 404;
                    }
                }
            }
        });

    </script>
@endsection