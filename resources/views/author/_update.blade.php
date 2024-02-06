<div class="modal" id="edit-author" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Pengarang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('author-edit') }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">

                        <input type="hidden" name="author_id">
                        <div>
                            <Label for="name" class="form-label">Nama</Label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ketik nama" value="{{old('name')}}" required>
                        </div>
                        <div class="pt-2">
                            <Label for="biography" class="form-label">Biografi</Label>
                            <textarea name="biography" id="biography" class="form-control" placeholder="Ketik biografi"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
            </form>
        </div>
    </div>
</div>
