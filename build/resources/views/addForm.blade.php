@extends('layouts.main')
@extends('layouts.sidebar')

@section('content')


<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-10">
          <h1>Tambah Transaksi</h1>
        </div>

        <div class="col-sm-2">

            <a  href="{{ url('transaksi/') }}" style="float:right;"> kembali </a>
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
              <h3 class="card-title">Tambah Transaksi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">


                <form action="{{ url('transaksi/create') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">

                        <select class="custom-select" name="idSaldo" required>
                          <option value="">Pilih ID Saldo</option>
                          @foreach ($data as $item)
                            <option value="{{ $item->id }}"> {{ $item->id }} ({{ $item->nama }})</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                      <input type="number" class="form-control" placeholder="nominal" name="nominal" required>
                    </div>


                    <div class="input-group mb-3">
                        <select class="custom-select" name="jenis" required>
                          <option value="">Pilih Jenis Transaksi</option>

                          <option value="1">Debet</option>
                          <option value="2">Kredet</option>

                        </select>
                    </div>

                    <div class="row">
                      <div class="col-10">

                      </div>
                      <!-- /.col -->
                      <div class="col-2">
                        <button type="submit" class="btn btn-primary btn-block" style="float: right">Simpan</button>
                      </div>
                      <!-- /.col -->
                    </div>
                  </form>



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
