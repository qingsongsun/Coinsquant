@extends('Back.index')
@section('main')
  <div class="box-body">
    <div class="btn-group-vertical">
      <button type="button" class="btn btn-info" onclick="add(0)">新增产品</button>

    </div>
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>产品名称</th>
        <th>产品分类</th>
        <th>添加时间</th>
        <th>操作</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $v1)
      <tr>

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

  </script>
  @endsection