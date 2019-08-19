<div class="container-fluid">
    <?php $this->print_nav(); ?>
    <div class="row my-3">
        <div class="col">
            <div id="impression-form" class="card">
                <div class="card-header">
                    Impressionen Bearbeiten
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?php $this->print_impressions(); ?>
                            <?php $this->print_position_form('positions-impressions'); ?>
                        </div>
                        <div class="col-8">
                            <?php $this->print_impression_alert($this->item_imp['update']); ?>
                            <?php $this->print_impression_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div id="impression-content-form" class="card">
                <div class="card-header">
                    Der Inhalt der Aktiven Impression Bearbeiten
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <?php $this->print_content(); ?>
                            <?php $this->print_position_form('positions-impressions_content'); ?>
                        </div>
                        <div class="col-8">
                            <?php $this->print_impression_alert($this->item_cont['update']); ?>
                            <?php $this->print_impression_content_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->print_footer(); ?>
</div>
