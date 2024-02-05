<div class="modal" id="delete-author" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Pengarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/author-destroy') }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="author_id">
                    <p>Apa Anda yakin akan menghapus data Pengarang <span class="detail-author text-bold"></span>?</p>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
