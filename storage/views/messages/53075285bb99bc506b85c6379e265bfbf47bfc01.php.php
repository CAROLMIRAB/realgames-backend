<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        <!-- Previous Page Link -->
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled"><span>&laquo;</span></li>
        <?php else: ?>
            <li><a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">&laquo;</a></li>
        <?php endif; ?>

        <!-- Next Page Link -->
        <?php if($paginator->hasMorePages()): ?>
            <li><a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">&raquo;</a></li>
        <?php else: ?>
            <li class="disabled"><span>&raquo;</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
