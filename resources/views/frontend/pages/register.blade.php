@extends('frontend.layout')

@section('content')
    <div class="p-gray-bg m-register">
        <div class="p-wrap-middle">
            <div class="row">
                <div class="col-sm-6 col-xs-12 m-form-wrap">
                    <h3 class="form-head">注册</h3>
                    <input type="text" class="form-input" placeholder="会员名称" id="user_name">
                    <input type="text" class="form-input" placeholder="邮箱" id="user_mail">
                    <input type="password" class="form-input" placeholder="输入你的密码" id="user_pwd">
                    <input type="password" class="form-input" placeholder="再次输入你的密码" id="user_pwd1">
                    <div class="checkbox-wrap">
                        <span class="p-checkbox">
                            <input type="checkbox" id="checkbox" class="checkbox-input" hidden>
                            <label class="checkbox-inner" for="checkbox"></label>
                        </span>
                        <span>已满18岁以上，并且同意用户协议和隐私政策</span>
                    </div>
                    <div class="p-btn">注册</div>
                    <div class="form-desc-text">
                        已有账号？
                        <a href="/login" class="p-blue">登录&gt;</a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 form-icon">
                    <img src="{{imgurl('form-login.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var flag = 0;
            $('#user_name').blur(function () {
                if(this.value == ""){
                    layer.msg('会员名称不能为空',{icon:2});
                    flag = 1;
                }else{
                    $.post('/api/registerCheck',{value:this.value,type:1},function (obj) {
                        if(obj.code == 404){
                            layer.msg('该用户名已被注册',{icon:2});
                            flag = 2;
                        }else{
                            flag = 0;
                        }
                    });
                }
            });

            $('#user_mail').blur(function () {
                if(this.value == ""){
                    layer.msg('邮箱不能为空',{icon:2});
                    flag = 3;
                }else if(!(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(this.value))){
                    layer.msg('请输入正确格式的邮箱',{icon:2});
                    flag = 5;
                }else{
                    $.post('/api/registerCheck',{value:this.value,type:2},function (obj) {
                        if(obj.code == 404){
                            layer.msg('该邮箱已被注册',{icon:2});
                            flag = 4;
                        }else{
                            flag = 0;
                        }
                    });
                }
            });

            $('.p-btn').click(function () {
               if(flag == 1){
                   layer.msg('会员名称不能为空',{icon:2});
               }else if(flag == 2){
                   layer.msg('该用户名已被注册',{icon:2});
               }else if(flag == 3){
                   layer.msg('邮箱不能为空',{icon:2});
               }else if(flag == 4){
                   layer.msg('该邮箱已被注册',{icon:2});
               }else if(flag ==5 ){
                   layer.msg('请输入正确格式的邮箱',{icon:2});
               }else{
                   var user_name   = $('#user_name').val();
                   var user_mail   = $('#user_mail').val();
                   var user_pwd    = $('#user_pwd').val();
                   var user_pwd1   = $('#user_pwd1').val();
                   if(user_name == "" || user_mail == "" || user_pwd == "" || user_pwd1 == ""){
                       layer.msg('请填写完整的信息',{icon:2});
                   }else{
                       if(user_pwd != user_pwd1){
                           layer.msg('前后密码不一致',{icon:2})
                       }else{
                           if(($('#checkbox').is(':checked') == false)){
                               layer.msg('请同意用户协议和隐私政策',{icon:2})
                           }else{
                               $.post('/api/register',{user_name:user_name,user_mail:user_mail,user_pwd:user_pwd},function (obj) {
                                   console.log(obj.code);
                                   if(obj.code == 200){
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
                                       var _mail = user_mail.split('@')[1];    //获取邮箱域
                                       for (var j in hash){
                                           if(j == _mail){
                                               var href = hash[_mail];    //替换登陆链接
                                           }
                                       }

                                       layer.alert('已向你的邮箱<a href="'+href+'" class="p-blue">'+user_mail+'<a>发送验证邮件，请及时验证', {icon: 6});
                                       setTimeout(function () {
                                           location.href = '/user';
                                       },1500)
                                   }else{
                                       layer.msg(obj.msg,{icon:2});
                                   }
                               });
                           }
                       }
                   }
               }

            });
        });

    </script>
@endsection