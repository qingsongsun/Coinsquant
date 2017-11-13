@extends('Back.index')
@section('main')
  <div class="box-body">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-info" onclick="add(0)">新增账号</button>

    </div>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>账号</th>
        <th>是否分配</th>
        <th>添加时间</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $v1)
      <tr>
        <td>{{ $v1->account }}</td>
        <td>

          @if($v1->is_use)
              已分配
            @else
              暂未分配
          @endif
        </td>
        <td>{{ $v1->create_time }}</td>
        <td>
          <div class="tools">
            {{--<i class="fa fa-edit" onclick="edit({{ $v1->id }})"></i>--}}

            <i class="fa fa-trash-o" onclick="del( '{{$v1->id}}','{{ $v1->account }}',this )"></i>
          </div>

        </td>
      </tr>
        @endforeach
      </tbody>

    </table>
  </div>

@endsection

@section('js')
  <script>
    $(function () {
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });

    /*删除分类*/
    function del(id,account,td){
      layer.confirm('是否删除账号:'+account,{title:'删除提示',btn:['是','否']},function(){
        $.post('/back/coin/del',{id:id,_token:'{{ csrf_token()}}'},function(obj){
          if(obj == 200){
            layer.msg('删除账号：'+"【"+account+"】"+' 成功!',{time:2000});
            setTimeout(function(){
              location.reload();
            },2000);
          }
        })
      })
    }

    /*分类编辑*/
    function edit(id){
      layer_open('分类编辑','/back/product/edit?id='+id,660,440)
    }

    function add() {
        layer.prompt({title: '输入账号，并确认', formType: 3}, function(account, index){
            $.post('/back/coin/save',{'_token':'{{ csrf_token() }}',account:account},function (obj) {
                layer.close(index);
                if(obj == 200){
                    layer.msg('保存成功',{icon:1,time:1000});
                    setTimeout(function () {
                        location.reload()
                    },1000)
                }

            })
        });
    }

  </script>
  @endsection