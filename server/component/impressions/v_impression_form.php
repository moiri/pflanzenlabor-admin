<form action="<?php $_SERVER['REQUEST_URI']; ?>" method="post">
    <input type="hidden" name="impressions-insert" value="<?php echo $new ? "1" : "0"; ?>">
    <div class="form-group">
        <label>id_class</label>
        <select class="form-control" name="impressions[id_class]">
            <option value="null">-- keine Verlinkung --</option>
            <?php $this->print_class_selection($new); ?>
        </select>
        <small class="form-text text-muted">Die <code>ID</code> des Kurses zu welchem diese Impression verlinkt ist.</small>
    </div>
    <div class="form-group">
        <label>title</label>
        <input type="text" class="form-control" name="impressions[title]" value="<?php echo $new ? "" : $this->item_imp['title'] ?? ""; ?>">
        <small class="form-text text-muted">Der Titel der Impression. Falls dies leer gelassen wird, wird der Name des verlinkten Kurses verwendet.</small>
    </div>
    <div class="form-group">
        <label>subtitle</label>
        <input type="text" class="form-control" name="impressions[subtitle]" value="<?php echo $new ? "" : $this->item_imp['subtitle'] ?? ""; ?>">
        <small class="form-text text-muted">Der Untertitel der Impression. Falls dies leer gelassen wird, wird der Untertitel des verlinkten Kurses verwendet.</small>
    </div>
    <div class="form-group">
        <label>description</label>
        <textarea class="form-control md" name="impressions[description]" rows="5"><?php echo $new ? "" : $this->item_imp['description'] ?? ""; ?></textarea>
        <small class="form-text text-muted">Der Beschrieb der Impression. Hier kann <a href="https://www.markdownguide.org/basic-syntax" target="_blank">Markdown</a> Syntax verwendet werden.</small>
    </div>
    <button type="submit" class="btn btn-dark">Speichern</button>
</form>
