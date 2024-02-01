@extends('layouts')

@section('content')

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="{{ route('export.pdf') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            Laporan Peminjaman
                        </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Books -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Buku
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$book_count}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-book fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Penulis
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$author_count}}</div>
                                        </div>
                                        <div class="col-auto">

                                            <i class="fa fa-pen fa-2x text-gray-300" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info-shadow shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Anggota
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$member_count}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Peminjaman
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$loan_count}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hand-holding fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <table class="table table-bordered" id="table-book" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Title</th>
                                                    <th>Penulis</th>
                                                    <th>Penerbit</th>
                                                    <th>Tahun Terbit</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($books)
                                                @foreach($books as $book)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
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
                                                </tr>
                                                @endforeach
                                                @else
                                                <td colspan="6" style="text-align: center;">Data Kosong</td>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota (Belum mengembalikan)</h6>
                                </div>
                                @if($loans)
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        @foreach($loans as $loan)
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="card mb-4 py-3 border-left-primary">
                                                <div class="card-header text-truncate">
                                                    Nama Peminjam : {{$loan->member->name}}
                                                </div>
                                                <div class="card-body">
                                                    Nama Buku : {{$loan->book->title}}
                                                </div>
                                                <div class="card-footer">
                                                    <b>Tanggal Peminjaman : {{ \Carbon\Carbon::parse($loan->loan_date)->locale('id')->isoFormat('D MMMM Y')}}</b>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer py-3">
                                    <ul class="pagination m-0">
                                        @if ($loans->currentPage() > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $loans->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @endif

                                        @for ($i = 1; $i <= $loans->lastPage(); $i++)
                                            <li class="page-item {{ ($i == $loans->currentPage()) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $loans->url($i) }}">{{ $i }}</a>
                                            </li>
                                            @endfor

                                            @if ($loans->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $loans->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                            @endif
                                    </ul>
                                </div>
                                @else
                                <div class="p-4 d-flex justify-content-center">
                                    <h4>Data Kosong</h4>
                                </div>
                                @endif
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

</body>
@endsection

@push('script')
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush