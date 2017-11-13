@extends('Back.index')
@section('main')
  <div class="box-body">
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>会员名称</th>
        <th>会员比特币账号</th>
        <th>是否身份验证</th>
        <th>添加时间</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $v1)
      <tr>
        <td>{{ $v1->id }}</td>
        <td>{{ $v1->user_name }}</td>
        <td>{{ $v1->user_unique_btc }}</td>
        <td>
          @if($v1->user_real_name == "")
            未认证
            @else
            已认证
          @endif
        </td>
        <td>{{ $v1->create_time }}</td>
        <td>
          <div class="tools">
            <i class="fa fa-edit" onclick="edit({{ $v1->id }})"></i>
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


    /*分类编辑*/
    function edit(id){
//      layer_open('分类编辑','/back/product/edit?id='+id,660,440)
        layer.msg('开发中')
    }


  </script>
  @endsection