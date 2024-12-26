<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="d-flex justify-content-between border-bottom py-2">
    <h3 class="pb-2 mb-0">Tambah Data Pegawai</h3>
    <a href="/pegawai" class="btn btn-dark">Kembali</a>
  </div>
  <div class="pt-3">
    <form action="/pegawai/store" method="post" enctype="multipart/form-data">
      <?= csrf_field(); ?>
      <div class="mb-3">
        <label for="" class="form-label">Nama Pegawai:</label>
        <input type="text" class="form-control <?= isset(session('errors')['nama_pegawai']) ? 'is-invalid' : ''; ?>" name="nama_pegawai" value="<?= old('nama_pegawai'); ?>">
        <div class="invalid-feedback">
          <?= session('errors.nama_pegawai') ?? ''; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Alamat:</label>
        <input type="text" class="form-control <?= isset(session('errors')['alamat']) ? 'is-invalid' : ''; ?>" name="alamat" value="<?= old('alamat'); ?>">
        <div class="invalid-feedback">
          <?= session('errors.alamat') ?? ''; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">No. Telepon:</label>
        <input type="text" class="form-control <?= isset(session('errors')['telepon']) ? 'is-invalid' : ''; ?>" name="telepon" value="<?= old('telepon'); ?>">
        <div class="invalid-feedback">
          <?= session('errors.telepon') ?? ''; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Jabatan:</label>
        <select name="jabatan_id" id="" class="form-control <?= isset(session('errors')['jabatan_id']) ? 'is-invalid' : ''; ?>">
          <?php foreach ($jabatan as $j) { ?>
            <option value="<?= $j->id; ?>" <?= ($j->id == old('jabatan_id')) ? 'selected' : ''; ?>><?= $j->nama_jabatan; ?></option>
          <?php } ?>
        </select>
        <div class="invalid-feedback">
          <?= session('errors.jabatan_id') ?? ''; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Foto Pegawai:</label>
        <input type="file" name="file_foto" class="form-control <?= isset(session('errors')['file_foto']) ? 'is-invalid' : ''; ?>">
        <div class="invalid-feedback">
          <?= session('errors.file_foto') ?? ''; ?>
        </div>
      </div>
      <button type="submit" class="btn btn-dark">Simpan</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>