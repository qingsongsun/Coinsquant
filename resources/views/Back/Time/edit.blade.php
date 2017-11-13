<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="{{ URL::asset('layui/css/layui.css') }}"  media="all">
  <link rel="stylesheet" href="{{ URL::asset('css/admin.css') }}"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>


<div class="layui-form time_form">
  <input type="hidden" id="id" value="{{ $data->id }}">
  <div class="layui-form-item">

    <label class="layui-form-label">上限数量</label>
    <div class="layui-input-block">
      <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" value="{{ $data->btc_count }}" class="layui-input" id="btc_count">
    </div>
    <label class="layui-form-label">基本数量</label>
    <div class="layui-input-block">
      <input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入标题" value="{{ $data->btc_basic_count }}" class="layui-input" id="btc_basic_count">
    </div>
  </div>
  {{--<div class="layui-form-item">--}}
    {{----}}
  {{--</div>--}}

  <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">开始时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="start_time" placeholder="yyyy-MM-dd HH:mm:ss" value="{{ date('Y-m-d H:i:s',$data->start_time) }}">
      </div>
    </div>
    <div class="layui-inline">
      <label class="layui-form-label">结束时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="stop_time" placeholder="yyyy-MM-dd HH:mm:ss" value="{{ date('Y-m-d H:i:s',$data->stop_time) }}">
      </div>
    </div>
  </div>

  <button class="layui-btn layui-btn-normal">保存</button>
</div>

<script src="{{ URL::asset('layui/layui.all.js') }}"></script>
<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
  $('.layui-btn').click(function () {
      $.post('/back/time/save',{start_time:$('#start_time').val(),stop_time:$('#stop_time').val(),
          btc_count:$('#btc_count').val(),'_token':"{{ csrf_token() }}",id:$('#id').val(),btc_basic_count:$('#btc_basic_count').val()},function (obj) {
          if(obj.code == 200){
              layer.msg(obj.msg,{icon:1});
          }
      });
  });

    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //常规用法
        laydate.render({
            elem: '#start_time'
            ,type: 'datetime'
        });
        //常规用法
        laydate.render({
            elem: '#stop_time'
            ,type: 'datetime'
        });

    });
</script>

</body>
</html>