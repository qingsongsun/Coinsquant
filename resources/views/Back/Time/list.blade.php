@extends('Back.index')
@section('main')
  <div class="box-body">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-info" onclick="add(0)">新增筹集</button>

    </div>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>筹集上限总数</th>
        <th>筹集基本总数</th>
        <th>开始时间</th>
        <th>结束时间</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $v1)
      <tr>
        <td>{{ $v1->id }}</td>
        <td>{{ $v1->btc_count }}</td>
        <td>{{ $v1->btc_basic_count }}</td>
        <td>{{ date('Y-m-d H:i:s',$v1->start_time) }}</td>
        <td>{{ date('Y-m-d H:i:s',$v1->stop_time) }}</td>
        <td>
          <div class="tools">
            <i class="fa fa-edit" onclick="edit({{ $v1->id }})"></i>
            |
            <i class="fa fa-trash-o" onclick="del( '{{$v1->id}}',this )"></i>
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
    function del(id){
      layer.confirm('是否删除ID为:'+id+"的数据",{title:'删除提示',btn:['是','否']},function(){
        $.post('/back/time/del',{id:id,_token:'{{ csrf_token()}}'},function(obj){
            console.log(obj);
          if(obj.code == 200){
            layer.msg('是否删除ID为：'+"【"+id+"】"+' 的数据成功!',{time:2000});
            setTimeout(function(){
              location.reload();
            },2000);
          }
        })
      })
    }

    /*分类编辑*/
    function edit(id){
      layer_open('筹集管理','/back/time/edit?id='+id,650,360)
    }

    function add(id) {
        layer_open('筹集管理','/back/time/edit?id='+id,650,360)
    }

  </script>
  @endsection