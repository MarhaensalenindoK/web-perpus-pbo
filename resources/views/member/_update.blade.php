<div class="modal" id="edit-member" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/member-edit') }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="member_id">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
