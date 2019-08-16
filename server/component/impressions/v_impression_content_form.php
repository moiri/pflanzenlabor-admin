<form>
    <div class="form-group">
        <label>name</label>
        <input type="text" class="form-control" value="<?php echo $this->item_cont['name']; ?>">
        <small class="form-text text-muted">Der Name des Impressioninhalts. Dieser Name ist unwichtig und dient nur zur Referenz.</small>
    </div>
    <?php $this->print_impression_content_form_fields(); ?>
    <button type="submit" class="btn btn-primary">Speichern</button>
</form>
