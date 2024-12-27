<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="my-3 p-3 bg-body rounded shadow-sm">
  <div class="d-flex justify-content-between border-bottom py-2">
    <h3 class="pb-2 mb-0">Data Pegawai</h3>
    <a href="/pegawai/create" class="btn btn-dark">Tambah Data</a>
  </div>
  <div class="pt-3">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Pegawai</th>
          <th>Alamat</th>
          <th>Telepon</th>
          <th>Jabatan</th>
          <th width="220">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pegawai as $key => $row) { ?>
          <tr>
            <td><?= ($pager->getCurrentPage('default') - 1) * 10 + $key + 1; ?></td>
            <td><?= $row->nama_pegawai; ?></td>
            <td><?= $row->alamat; ?></td>
            <td><?= $row->telepon; ?></td>
            <td><?= $row->nama_jabatan; ?></td>
            <td>
              <form action="/pegawai/delete/<?= $row->id; ?>" method="post" class="form-hapus">
                <a href="/pegawai/show/<?= $row->id; ?>" class="btn btn-info">Detail</a>
                <a href="/pegawai/edit/<?= $row->id; ?>" class="btn btn-warning">Edit</a>
                <?= csrf_field(); ?>

                <?php if (session()->get('role') == 'admin'): ?>
                  <button type="button" class="btn btn-danger" onclick="konfirmasi(this)">Hapus</button>
                <?php endif; ?>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <nav>
      <?= $pager->links('default', 'bs5'); ?>
    </nav>

  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('custom_js'); ?>
<script>
  <?php if (session()->getFlashdata('swal_icon')): ?>
    Swal.fire({
      title: "<?= session()->getFlashdata('swal_title'); ?>",
      text: "<?= session()->getFlashdata('swal_text'); ?>",
      icon: "<?= session()->getFlashdata('swal_icon'); ?>"
    });
  <?php endif; ?>

  function konfirmasi(button) {
    const form = button.closest('.form-hapus');
    Swal.fire({
      title: "Aapakah anda yakin?",
      text: "Menghapus data tidak dapat dibatalkan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, hapus saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  }
</script>
<?= $this->endSection(); ?>