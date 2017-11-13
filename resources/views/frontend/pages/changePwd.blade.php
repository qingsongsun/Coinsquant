@extends('frontend.layout', ['title' => '修改密码'])

@section('content')

    <div class="p-gray-bg m-login">
        <div class="p-wrap-narrow">
            <div class="m-form-wrap">
                <h3 class="form-head">修改密码</h3>
                @if($user_id == "")
                <input type="password" class="form-input" placeholder="请输入旧密码" id="oldpassword">
                <input type="password" class="form-input" placeholder="请输入新密码" id="password">
                <input type="password" class="form-input" placeholder="请再次输入新密码" id="repassword">
                    <input type="hidden" id="id" value="0">
                @else
                    <input type="password" class="form-input" placeholder="请输入新密码" id="password">
                    <input type="password" class="form-input" placeholder="请再次输入新密码" id="repassword">
                <input type="hidden" name="id" value="{{ $user_id }}" id="user_id">

                    <input type="hidden" id="oldpassword" value="HeIsNoOldPassWord">
                @endif
                <div class="p-btn">确认修改</div>
            </div>
        </div>
    </div>
    <script>
        $('.p-btn').click(function () {
            var oldpassword = $('#oldpassword').val();
            var password = $('#password').val();
            var repassword = $('#repassword').val();
            var user_id = $('#user_id').val();
            if(password=="" || repassword=="" || oldpassword == ""){
                layer.msg('请输入密码');
                return false;
            }else if(password != repassword){
                layer.msg('前后密码不一致');
            }else{
                $.post('/api/changepwd',{password:password,oldpassword:oldpassword,user_id:user_id},function (obj) {
                    if(obj.code == 200){
                        layer.msg('密码修改成功');
                        setTimeout(function () {
                            location.href = '/user';
                        },1500);
                    }else if(obj.code == 400){
                        layer.msg(obj.msg);
                        setTimeout(function () {
                            location.href = '/login';
                        },1500);
                    }else{
                        layer.msg(obj.msg)
                    }
                })
            }
        })
    </script>
@endsection