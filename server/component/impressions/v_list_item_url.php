<a href="<?php echo $url; ?>" class="py-1 px-2 list-group-item list-group-item-action <?php echo $active; ?>">
    <?php echo $name; ?>
    <span class="badge badge-secondary float-right ml-1"><?php echo $idx; ?></span>
    <?php $this->print_list_item_code($code); ?>
</a>
