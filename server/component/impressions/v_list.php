<div id="<?php echo $id; ?>" class="list-group nested-sortable">
    <button type="button" data-toggle="modal" data-target="#<?php echo $id."-modal"; ?>" class="ignore-sortable btn btn-secondary rounded-0"><em>Neues Element</em></button>
    <?php $this->print_list_items($items, $active_id); ?>
</div>
<?php $this->print_modal($id."-modal"); ?>
