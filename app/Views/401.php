<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>401</title>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width:100%;">
      <div class="card-body">
        <div class="card-title">
          <h3>401 - Unauthorized</h3>
          <p><?= session()->getFlashdata('error'); ?></p>
          <a href="<?= site_url(); ?>" class="btn btn-primary">Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>