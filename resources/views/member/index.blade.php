@extends('layouts')

@section('content')

@section('page-name', 'member')

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
                        <h1 class="h3 mb-0 text-gray-800">Anggota</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="pb-2 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-member">
                                                Tambah Anggota
                                            </button>
                                        </div>
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Tanggal Daftar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($members)
                                                @foreach($members as $member)
                                                <tr>
                                                    <td>{{($loop->iteration - 1) + ($members->perPage() * ($members->currentPage() - 1)) + 1}}</td>
                                                    <td>{{$member->name}}</td>
                                                    <td>{{$member->email}}</td>
                                                    <td>{{$member->registration_date}}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-member">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-member">
                                                            Hapus
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <td colspan="5" style="text-align: center;">Data Kosong</td>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer py-3">
                                    <ul class="pagination m-0">
                                        @if ($members->currentPage() > 1)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $members->previousPageUrl() }}" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @endif

                                        @for ($i = 1; $i <= $members->lastPage(); $i++)
                                            <li class="page-item {{ ($i == $members->currentPage()) ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $members->url($i) }}">{{ $i }}</a>
                                            </li>
                                            @endfor

                                            @if ($members->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $members->nextPageUrl() }}" aria-label="Next">
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

    @include('member._add')
    @include('member._update')
    @include('member._delete')
</body>
@endsection

@push('script')
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush