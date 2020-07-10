@extends('layouts.app')
@section('title','Index Transaksi')
@section('namePage','Transaksi')
@section('content1')
@if (auth()->user()->level == "Admin")
    <a href="/transaksi/tambah" class="btn btn-sm btn-neutral"><i class="ni ni-fat-add mt-1"></i> Tambah Data</a>
@endif
@endsection
@section('content')

<div class="card">
<div class="table-responsive shadow mt-4">
    <table class="table align-items-center table-flush" id="datatable">
      <thead class="thead-light">
        <tr>
          <th scope="col">Kode Transaksi</th>
          <th scope="col">Nama Anggota</th>
          <th scope="col">Judul Buku</th>
          <th scope="col">Tanggal Pinjam</th>
          <th scope="col">Tanggal Kembali</th>
          <th scope="col">Status</th>
          @if (auth()->user()->level == "Admin")
            <th scope="col">Aksi</th>    
          @endif
        </tr>
      </thead>
      @foreach($data_transaksi as $transaksi)
      <tbody class="list">
        <tr>
            <td>{{$transaksi->kode_transaksi}}</td>
            <td>{{$transaksi->anggota->nama}}</td>
            <td>{{$transaksi->buku->judul}}</td>
            <td>{{date('d-m-yy',strtotime($transaksi->tanggal_pinjam))}}</td>
            <td>{{date('d-m-yy',strtotime($transaksi->tanggal_kembali))}}</td>
            <td>
                @if($transaksi->status == "Pinjam")
                    <span class="badge" style="background-color: #ffc107; color: #212529;">{{$transaksi->status}}</span>
                @else
                    <span class="badge" style="background-color: #28a745; color:#fff">{{$transaksi->status}}</span>
                @endif
            </td>
            @if (auth()->user()->level == "Admin")
              <td>
                @if($transaksi->status == "Kembali")
                    <form action="/transaksi/{{$transaksi->id}}/hapus" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-danger" style="border:none;">Hapus</button>
                    </form>
                @else
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Aksi
                    </button>
                    <div class="dropdown-menu">
                        <form action="/transaksi/{{$transaksi->id}}/ubah" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">
                            <button type="submit" class="dropdown-item" style="border:none;">Sudah Kembali</button>
                        </form>
                        <form action="/transaksi/{{$transaksi->id}}/hapus" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="dropdown-item" style="border:none;">Hapus</button>
                        </form>
                    </div>
                  </div>
                @endif
              </td>  
            @endif
        </tr>
      </tbody>
      @endforeach
    </table>
  </div>
</div>
@endsection