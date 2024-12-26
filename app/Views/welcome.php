<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>
<?php if (session()->get('login')): ?>
  <div class="alert alert-success">
    Selamat Datang, <strong><?= session()->get('nama'); ?>.</strong>
  </div>
<?php endif; ?>
<div class="p-5 text-center bg-white rounded-3 shadow-sm">
  <h1 class="text-body-emphasis">Aplikasi CRUD Pegawai</h1>
  <p class="lead">
    Selamat datang di Aplikasi CRUD Pegawai. Aplikasi ini digunakan untuk mengelola data pegawai.
  </p>
</div>
<?= $this->endSection(); ?>