@extends('layouts')

@section('content')

@section('page-name', 'author')

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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-author">
                            Tambah Pengarang
                        </button>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                        @forelse ($authors as $author)
                            <div class="col">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            {{ $author->name ?? '' }}
                                        </h6>
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink"
                                            data-id="{{ $author->id }}"
                                            >
                                                <div class="dropdown-header">Menu:</div>
                                                <a class="dropdown-item edit-btn" href="javascript:void(0)"
                                                >Edit</a>
                                                <a class="dropdown-item text-danger destroy-btn" href="javascript:void(0)">
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <p class="">
                                            {{ $author->biography ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col">Belum ada pengarang yang dibuat</div>
                        @endforelse
                    </div>

                    <div class="card-footer py-3">
                        <ul class="pagination m-0">
                            @if ($authors->currentPage() > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $authors->previousPageUrl() }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @endif

                            @for ($i = 1; $i <= $authors->lastPage(); $i++)
                            <li class="page-item {{ ($i == $authors->currentPage()) ? 'active' : '' }}">
                                <a class="page-link" href="{{ $authors->url($i) }}">{{ $i }}</a>
                            </li>
                            @endfor

                            @if ($authors->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $authors->nextPageUrl() }}" aria-label="Next">
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

    @include('author._add')
    @include('author._update')
    @include('author._delete')
    @include('author._status')
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
    let authors = @json($authors);
    authors = authors.data ?? []

    $('.edit-btn').click(function (e) {
        let authorId = $(this).parent().data('id')
        let currentAuthor = authors.find(book => book.id === authorId)

        $('#edit-author input[name=author_id]').val(authorId);
        $('#edit-author input[name=name]').val(currentAuthor.name ?? '');
        $('#edit-author textarea[name=biography]').val(currentAuthor.biography ?? '');

        $(`#edit-author`).modal(`show`)
    });

    $('.destroy-btn').click(function (e) {
        let authorId = $(this).parent().data('id')
        let currentAuthor = authors.find(author => author.id === authorId)

        $('#delete-author input[name=author_id]').val(authorId);
        $('#delete-author .detail-author').html(currentAuthor.name);

        $(`#delete-author`).modal(`show`)
    });
</script>
@endpush
