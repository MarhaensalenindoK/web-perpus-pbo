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
                    <div class="pb-2 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-book">
                            Tambah Buku
                        </button>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                        @forelse ($books as $book)
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            {{ $book->title }}
                                        </h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"
                                            data-id="{{ $book->id }}"
                                            >
                                                <div class="dropdown-header">Menu:</div>
                                                <a class="dropdown-item edit-btn" href="javascript:void(0)"
                                                data-toggle="modal" data-target="#edit-book"
                                                >Edit</a>
                                                <a class="dropdown-item text-danger destroy-book" href="javascript:void(0)">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <h5>Penulis : {{ $book->author->name ?? '-' }}</h5>
                                        <p class="text-primary">Penerbit : {{ $book->publisher ?? '-' }}</p>
                                        <p>Tahun Terbit : {{ $book->publication_year }}</p>
                                        @if($book->status == 'available')
                                        <p class="badge bg-primary text-white">Tersedia</p>
                                        @else
                                        <p class="badge bg-danger text-white">Tidak Tersedia</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col">Belum ada buku yang dibuat</div>
                        @endforelse
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
    @include('book._status')
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
    let books = @json($books);
    books = books.data ?? []

    $('.edit-btn').click(function (e) {
        let bookId = $(this).parent().data('id')
        let currentBook = books.find(book => book.id === bookId)

        $('#edit-book input[name=book_id]').val(bookId);
        $('#edit-book input[name=title]').val(currentBook.title);
        $(`#edit-book select[name=author_id] option[value=${currentBook.author_id}]`).prop('selected', true);
        $('#edit-book input[name=publisher]').val(currentBook.publisher);
        $('#edit-book input[name=publication_year]').val(currentBook.publication_year);
        $(`#edit-book input[name=status][value=${currentBook.status}]`).prop('checked', true);
    });

    $('.destroy-book').click(function (e) {
        let bookId = $(this).parent().data('id')
        let currentBook = books.find(book => book.id === bookId)
        $('#delete-book input[name=book_id]').val(bookId);
        $('#delete-book .detail-book').html(currentBook.title);

        $(`#delete-book`).modal(`show`)
    });
</script>

@endpush
