<div class="modal" id="add-loan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/loan-add') }}" method="post" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <div>
                        <Label for="member_id" class="form-label">Anggota</Label>
                        <select name="member_id" id="member_id" class="form-control" required>
                            <option value="">Pilih Anggota</option>
                            @foreach($members as $member)
                            <option value="{{$member->id}}">{{$member->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2">
                        <Label for="book_id" class="form-label">Buku</Label>
                        <select name="book_id" id="book_id" class="form-control" required>
                            <option value="">Pilih Buku</option>
                            @foreach($books as $book)
                            <option value="{{$book->id}}">{{$book->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2">
                        <Label for="loan_date" class="form-label">Tanggal Pinjam</Label>
                        <input type="date" name="loan_date" id="loan_date" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>