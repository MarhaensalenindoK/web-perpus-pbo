@extends('layouts')

@section('content')

@section('page-name', 'loan')

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
                        <h1 class="h3 mb-0 text-gray-800">Peminjaman</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Peminjaman</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="pb-2 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-loan">
                                                Tambah Peminjaman
                                            </button>
                                        </div>
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Buku</th>
                                                    <th>Anggota</th>
                                                    <th>Tanggal Pinjam</th>
                                                    <th>Tanggal Kembali</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($loans)
                                                @foreach($loans as $loan)
                                                <tr>
                                                    <td>{{($loop->iteration - 1) + ($loans->perPage() * ($loans->currentPage() - 1)) + 1}}</td>
                                                    <td>{{$loan->book->title}}</td>
                                                    <td>{{$loan->member->name}}</td>
                                                    <td>{{\Carbon\Carbon::parse($loan->loan_date)->locale('id')->isoFormat('D MMMM Y')}}</td>

                                                    @if($loan->return_date)
                                                    <td>{{\Carbon\Carbon::parse($loan->return_date)->locale('id')->isoFormat('D MMMM Y')}}</td>
                                                    @else
                                                    <td> - </td>
                                                    @endif

                                                    @if($loan->status == 'loaned')
                                                    <td>
                                                        <span class="badge bg-secondary text-white">Dipinjam</span>
                                                    </td>
                                                    @else
                                                    <td>
                                                        <span class="badge bg-primary text-white">Sudah Dikembalikan</span>
                                                    </td>
                                                    @endif

                                                    <td data-id="{{ $loan['id'] }}">
                                                        <button type="button" class="btn btn-primary edit-btn">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger destroy-btn">
                                                            Hapus
                                                        </button>
                                                        @if($loan->status == 'loaned')
                                                        <button type="button" class="btn btn-success return-btn">
                                                            Kembalikan Buku
                                                        </button>
                                                        @endif
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

    @include('loan._add')
    @include('loan._update')
    @include('loan._delete')
    @include('loan._return')
    @include('loan._status')

</body>
@endsection
@push('script')

@if(session('status'))
<script>
    $(`#modal-status`).modal(`show`)
    $(`#modal-status .modal-body`).html(`{{ session('status') }}`);
</script>
@if(session('clearStatus'))
<script>
    window.onload = function() {
        history.replaceState(null, null, window.location.href);
    }
</script>
@endif
@endif

<script>
    let loans = @json($loans);
    loans = loans.data ?? []

    $('.edit-btn').click(function(e) {
        let loanId = $(this).parent().data('id')
        let currentLoan = loans.find(loan => loan.id === loanId)

        var current = new Date(currentLoan.loan_date);

        var dateStr = current.getFullYear() + '-' + ('0' + (current.getMonth() + 1)).slice(-2) + '-' + ('0' + current.getDate()).slice(-2)

        $('#edit-loan input[name=loan_id]').val(loanId);
        $('#edit-loan input[name=current_book_id]').val(currentLoan.book_id);
        $(`#edit-loan select[name=member_id] option[value=${currentLoan.member_id}]`).prop('selected', true);
        $(`#edit-loan select[name=book_id] option[value=${currentLoan.book_id}]`).prop('selected', true);
        $('#edit-loan input[name=loan_date]').val(dateStr ?? '');

        $(`#edit-loan`).modal(`show`)
    });

    $('.destroy-btn').click(function(e) {
        let loanId = $(this).parent().data('id')
        let currentLoan = loans.find(loan => loan.id === loanId)
        $('#delete-loan input[name=loan_id]').val(loanId);
        $('#delete-loan input[name=book_id]').val(currentLoan.book_id);

        $(`#delete-loan`).modal(`show`)
    });

    $('.return-btn').click(function(e) {
        let loanId = $(this).parent().data('id')
        let currentLoan = loans.find(loan => loan.id === loanId)
        $('#return-loan input[name=loan_id]').val(loanId);
        $('#return-loan input[name=book_id]').val(currentLoan.book_id);

        $(`#return-loan`).modal(`show`)
    });
</script>

@endpush