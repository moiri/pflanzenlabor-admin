<form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
    <input type="hidden" name="impressions_content-insert" value="<?php echo $new ? "1" : "0"; ?>">
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" name="impressions_content[name]" value="<?php echo $this->item_cont['name'] ?? ""; ?>">
        <small class="form-text text-muted">Der Name des Impressioninhalts. Dieser Name ist unwichtig und dient nur zur Referenz.</small>
    </div>
    <?php $this->print_impression_content_form_type($new); ?>
    <?php $this->print_impression_content_form_fields($new); ?>
    <button type="submit" class="btn btn-dark">Speichern</button>
</form>
