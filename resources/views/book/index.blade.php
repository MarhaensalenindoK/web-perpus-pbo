@extends('layouts')

@section('content')

@section('page-name', 'book')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('_sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Buku</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Buku</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="pb-2 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-book">
                                                Tambah Buku
                                            </button>
                                        </div>
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Judul</th>
                                                    <th>Penulis</th>
                                                    <th>Penerbit</th>
                                                    <th>Tahun Terbit</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($books)
                                                @foreach($books as $book)
                                                <tr>
                                                    <td>{{($loop->iteration - 1) + ($books->perPage() * ($books->currentPage() - 1)) + 1}}</td>
                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->author->name}}</td>
                                                    <td>{{$book->publisher}}</td>
                                                    <td>{{$book->publication_year}}</td>
                                                    <td>
                                                        @if($book->status == 'available')
                                                        <span class="badge bg-primary text-white">Tersedia</span>
                                                        @else
                                                        <span class="badge bg-danger text-white">Tidak Tersedia</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-book">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-book">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <td colspan="7" style="text-align: center;">Data Kosong</td>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer py-3">
                                    <ul class="pagination m-0">
                                        @if ($books->currentPage() > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @endif

                                        @for ($i = 1; $i <= $books->lastPage(); $i++)
                                            <li class="page-item {{ ($i == $books->currentPage()) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                                            </li>
                                            @endfor

                                            @if ($books->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                            @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('book._add')
    @include('book._update')
    @include('book._delete')
</body>
@endsection

@push('script')
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush