@extends('layouts.master')
        <link href="{{asset('/img/logo.png')}}" rel="icon">
<nav class="navbar navbar-expand-lg " style="background: linear-gradient(to left, #3f0081, #aab1e5);">
 

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 
      <ul class="navbar-nav mr-auto">
        
      </ul>
 
      {{-- <span class="navbar-text mr-3">
        Silahkan login atau daftar akun
      </span> --}}
 
      <a href="/login" class="btn btn--light "style="color: aliceblue">Login</a>
      <a href="/register" class="ml-3 mr-4 btn btn--light" style="color: aliceblue">Daftar</a>
 
    </div>
 
</nav>

@section('judul')
    <h1 class="text-dark pt-4">Daftar Buku</h1>
@endsection

@section('content')

    <form class="navbar-search mb-3" action="/buku" method="GET">
        <div class="input-group">
            <input type="search" name="search" class="form-control bg-light border-1 small" placeholder="Cari Judul Buku"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="card container-fluid mb-3">

        <div class="row d-flex flex-wrap justify-content-center">

            @forelse ($buku as $item)
                <div class="col-auto my-2" style="width:18rem;">
                    <div class="card mx-2 my-2" style="min-height:28rem;">
                        @if ($item->gambar != null)
                            <img class="card-img-top" style="max-height:720px;" src="{{ asset('/images/' . $item->gambar) }}">
                        @else
                            <img class="card-img-top" style="height:1280px;" src="{{ asset('/images/noImage.jpg') }}">
                        @endif
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="detai-buku">
                                <h5 class="card-title text-dark" style="text-align: center"><a
                                        href="/buku/{{ $item->id }}"style="text-decoration: none; font-size:1rem;font-weight:bold;">
                                        {{ $item->judul }}</a></h5>
                                <p class = "cart-text m-0">Kode Buku : {{ $item->kode_buku }}</p>
                                <p class="card-text m-0">Pengarang : <a href="/buku/{{ $item->id }}"
                                        style="text-decoration: none;">{{ $item->pengarang }}</a></p>
                                <p class="card-text m-0">Kategori : </p>
                                <p class="text-primary">
                                    @foreach ($item->kategori_buku as $kategori )
                                    {{ $kategori->nama, }},
                                    @endforeach
                            </p>
                                <p class="card-text m-0">Status : {{$item->status  }}</p>
                            </div>
                       
                                <div class="button-area">
                                    {{-- <button class="btn-sm btn-info px-2"><a href="/buku/{{ $item->id }}"
                                            style="text-decoration: none; color:white;">Detail</a></button> --}}
                                    {{-- <button class="btn-sm btn-warning px-2"><a href="/buku/{{ $item->id }}/edit"
                                            style="text-decoration: none;color:white">Edit</a></button> --}}
                                    {{-- <button class="btn-sm btn-danger px-3"><a data-toggle="modal"
                                            data-target="#DeleteModal{{ $item->id }}">Delete</a></button> --}}
                                </div>
                       
                                <div class="button-area">
                                    <button class="btn-sm btn-info px-2"> <a href="/buku/{{ $item->id }}"
                                    style="text-decoration: none; color:white;">Detail</a></button>
                                    <button class="btn-sm btn-danger px-4"><a a href="/peminjaman/create"
                                    style="text-decoration: none; color:white;">Pinjam Buku</a></button>
                                </div>
                            

                            <!--Delete Modal -->
                            <div class="modal fade" id="DeleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="ModalLabelDelete" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabelDelete">Ohh No!</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin untuk menghapus?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <form action="/buku/{{ $item->id }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-outline-danger px-4" type="submit"
                                                    value="delete">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="text-primary mt-3">Tidak ada buku</h1>
            @endforelse

        </div>

        <div class="d-flex justify-content-between mx-2 my-2">
            <p class="text-primary my-2">Menampilkan {{ $buku->currentPage() }} dari {{ $buku->lastPage() }} Halaman</p>

            {{ $buku->links() }}
        </div>

    </div>
@endsection
