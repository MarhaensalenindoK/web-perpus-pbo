<div class="modal" id="return-loan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kembalikan Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/loan-return') }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="loan_id">
                <input type="hidden" name="book_id">
                <div class="modal-body">
                    <p>Apa Anda yakin akan mengubah status peminjaman buku?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kembalikan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>