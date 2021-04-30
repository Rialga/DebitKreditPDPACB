@extends('layouts.main')
@extends('layouts.sidebar')

@section('content')


<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-10">
          <h1>Transaksi</h1>
        </div>

        <div class="col-sm-2">

            <a class="btn btn-block btn-success"  href="{{ url('transaksi/add') }}" style="float:right;"> Add Transaksi </a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Info Saldo</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th style="width: 60px">ID</th>
                            <th>Nama</th>
                            <th>Saldo</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if($saldo->count() > 0)
                            @foreach ($saldo as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>Rp. {{ number_format($row->saldo) }}</td>

                                </tr>
                            @endforeach

                            @else
                                <tr>
                                    <td colspan="4" style="text-align: center"> Data Transaksi Kosong </td>
                                </tr>

                            @endif


                        </tbody>
                      </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
                <!-- /.card-footer-->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Transaksi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">No</th>
                        <th style="width: 60px">ID</th>
                        <th>Nominal</th>
                        <th>Jenis</th>
                        <th>Tanggal</th>
                        <th style="width: 60px">Aksi</th>


                      </tr>
                    </thead>
                    <tbody>
                        @if($data->count() > 0)
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_saldo }}</td>
                                <td>Rp. {{ number_format($item->nominal) }}</td>
                                @if ($item->jenis == 1)
                                <td> Debet </td>
                                @else
                                <td> Kredit </td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ url('transaksi/edit/'.$item->id) }}" class="btn btn-block btn-warning"> <i class="fas fa-edit"></i></a>
                                    <a href="{{ url('transaksi/delete/'.$item->id) }}" class="btn btn-block btn-danger"> <i class="fas fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach

                        @else
                            <tr>
                                <td colspan="6" style="text-align: center"> Data Transaksi Kosong </td>
                            </tr>

                        @endif


                    </tbody>
                  </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>


@endsection
