@extends('Back.index')
@section('main')
  <div class="box-body">
    <table id="example2" class="table table-bordered table-hover">
      <thead>
      <tr>
        <th>ID</th>
        <th>昵称</th>
        <th>邮箱</th>
        <th>内容</th>
        <th>反馈时间</th>
      </tr>
      </thead>
      <tbody>
      @foreach($data as $v1)
      <tr>
        <td>{{ $v1->id }}</td>
        <td>{{ $v1->nickname }}</td>
        <td>{{ $v1->email }}</td>
        <td>{{ $v1->content }}</td>
        <td>{{ $v1->create_time }}</td>
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