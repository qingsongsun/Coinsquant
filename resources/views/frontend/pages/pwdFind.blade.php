@extends('frontend.layout')

@section('content')

    <div class="p-gray-bg m-login">
        <div class="p-wrap-narrow">
            <div class="m-form-wrap">
                <h3 class="form-head">找回密码</h3>
                <input type="text" class="form-input" id="user_mail" placeholder="已验证邮箱">
                <div class="p-btn">找回密码</div>
            </div>
        </div>
    </div>
    <script>
        $('.p-btn').click(function () {
            var mail = $('#user_mail').val();
            if( mail == ""){
                layer.msg('请填写完整信息')
            }else if(!(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(mail))){
                layer.msg('请输入正确格式的邮箱');
            }else{
                $.post('/api/find-pwd',{user_mail:mail},function (obj) {
                    if(obj.code == 200){
                        layer.msg('找回成功!已经密码改为: 123456,建议修改密码',{icon:1});
                        setTimeout(function () {
                            location.href = '/user';
                        },1500)
                    }else{
                        layer.msg(obj.msg,{icon:2})
                    }
                })
            }
        })
    </script>
@endsection