<?php $pager->setSurroundCount(2) ?>

<nav>
  <ul class="pagination">
    <?php if ($pager->hasPrevious()) : ?>
      <li class="page-item">
        <a href="<?= $pager->getFirst() ?>" aria-label="Pertama" class="page-link">
          <span aria-hidden="true">Pertama</span>
        </a>
      </li>
      <li class="page-item">
        <a href="<?= $pager->getPrevious() ?>" aria-label="Sebelumnya" class="page-link">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
      <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
        <a href="<?= $link['uri'] ?>" class="page-link">
          <?= $link['title'] ?>
        </a>
      </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
      <li class="page-item">
        <a href="<?= $pager->getNext() ?>" aria-label="Berikutnya" class="page-link">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <li class="page-item">
        <a href="<?= $pager->getLast() ?>" aria-label="Terakhir" class="page-link">
          <span aria-hidden="true">Terakhir</span>
        </a>
      </li>
    <?php endif ?>
  </ul>
</nav>