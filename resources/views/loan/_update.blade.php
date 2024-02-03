<div class="modal" id="edit-loan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="loan-edit" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <Label for="member_id" class="form-label">Anggota</Label>
                        <select name="member_id" id="member_id" class="form-control">
                            <option value="">Pilih Anggota</option>
                            @foreach($members as $member)
                            <option value="{{$member->id}}">{{$member->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2">
                        <Label for="book_id" class="form-label">Buku</Label>
                        <select name="book_id" id="book_id" class="form-control">
                            <option value="">Pilih Buku</option>
                            @foreach($books as $book)
                            <option value="{{$book->id}}">{{$book->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-2">
                        <Label for="loan_date" class="form-label">Tanggal Pinjam</Label>
                        <input type="date" name="loan_date" id="loan_date" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>