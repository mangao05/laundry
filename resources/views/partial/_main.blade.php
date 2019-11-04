{{--  <!-- Content Wrapper. Contains page content -->  --}}
<div class="content-wrapper">
  {{--  <!-- Content Header (Page header) -->  --}}
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1 class="m-0 text-dark text-uppercase">Naotech Laundy Solution (Point Of Sale)</h1>
        </div>
        {{--  <!-- /.col -->  --}}
        {{--  <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">POS</li>
          </ol>
        </div>  --}}
        {{--  <!-- /.col -->  --}}
      </div>
      {{--  <!-- /.row -->  --}}
    </div>
    {{--  <!-- /.container-fluid -->  --}}
  </div>
  {{--  <!-- /.content-header -->  --}}

  {{--  <!-- Main content -->  --}}
  <div class="content">
    <div class="container-fluid">
        <router-view></router-view>
      {{--  <!-- /.row -->  --}}
    </div>
    {{--  <!-- /.container-fluid -->  --}}
  </div>
  {{--  <!-- /.content -->  --}}
</div>
{{--  <!-- /.content-wrapper -->  --}}
