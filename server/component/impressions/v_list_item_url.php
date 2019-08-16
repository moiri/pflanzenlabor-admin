<a href="<?php echo $url; ?>" class="list-group-item list-group-item-action <?php echo $active; ?>">
    <span class="badge badge-secondary"><?php echo $idx; ?></span>
    <?php echo $name; ?>
    <?php $this->print_list_item_code($code); ?>
</a>
