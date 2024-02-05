<div class="modal" id="edit-book" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/book-edit') }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="book_id">
                <div class="modal-body">
                    <div>
                        <Label for="title" class="form-label">Judul</Label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Ketik judul" value="{{old('title')}}" required>
                    </div>
                    <div class="pt-2">
                        <Label for="author_id" class="form-label">Pengarang</Label>
                        <select name="author_id" id="author_id" class="form-control">
                            <option value="">Pilih Pengarang</option>
                            @foreach($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2">
                        <Label for="publisher" class="form-label">Penerbit</Label>
                        <input type="text" name="publisher" id="publisher" class="form-control" placeholder="Ketik penerbit" value="{{old('publisher')}}" required>
                    </div>
                    <div class="pt-2">
                        <Label for="publication_year" class="form-label">Tahun Terbit</Label>
                        <input type="number" name="publication_year" id="publication_year" class="form-control" placeholder="Ketik tahun terbit" min="1900" max="2099" step="1" value="2024" required>
                    </div>
                    <div class="pt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status1" value="available" checked>
                            <label class="form-check-label" for="status1">
                                Tersedia
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="status2" value="unavailable">
                            <label class="form-check-label" for="status2">
                                Tidak Tersedia
                            </label>
                        </div>
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
