<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="d-flex justify-content-between border-bottom py-2">
    <h3 class="pb-2 mb-0">Edit Data Jabatan</h3>
    <a href="/jabatan" class="btn btn-dark">Kembali</a>
  </div>
  <div class="pt-3">
    <form action="/jabatan/update/<?= $jabatan->id; ?>" method="post">
      <?= csrf_field(); ?>
      <div class="mb-3">
        <label for="" class="form-label">Nama Jabatan:</label>
        <input type="text" class="form-control <?= isset(session('errors')['nama_jabatan']) ? 'is-invalid' : ''; ?>" name="nama_jabatan" value="<?= $jabatan->nama_jabatan; ?>">
        <div class="invalid-feedback">
          <?= session('errors.nama_jabatan') ?? ''; ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Deskripsi Jabatan:</label>
        <input type="text" class="form-control <?= isset(session('errors')['deskripsi_jabatan']) ? 'is-invalid' : ''; ?>" name="deskripsi_jabatan" value="<?= $jabatan->deskripsi_jabatan; ?>">
        <div class="invalid-feedback">
          <?= session('errors.deskripsi_jabatan') ?? ''; ?>
        </div>
      </div>
      <button type="submit" class="btn btn-dark">Update</button>
    </form>
  </div>
</div>
<?= $this->endSection(); ?>