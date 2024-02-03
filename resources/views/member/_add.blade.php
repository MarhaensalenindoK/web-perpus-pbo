<div class="modal" id="add-member" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="member-add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <Label for="name" class="form-label">Nama</Label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ketik nama" value="{{old('name')}}" required>
                    </div>
                    <div class="pt-2">
                        <Label for="email" class="form-label">Email</Label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ketik email" required>
                    </div>
                    <div class="pt-2">
                        <Label for="date" class="form-label">Tanggal Daftar</Label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>