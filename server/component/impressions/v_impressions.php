<div class="container-fluid">
    <?php $this->print_nav(); ?>
    <div id="impression-form" class="card mt-3">
        <div class="card-header">
            Impressionen Bearbeiten
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <?php $this->print_impressions(); ?>
                </div>
                <div class="col-8">
                    <?php $this->print_impression_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <div id="impression-content-form" class="card my-3">
        <div class="card-header">
            Der Inhalt der Aktiven Impression Bearbeiten
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <?php $this->print_content(); ?>
                </div>
                <div class="col-8">
                    <?php $this->print_impression_content_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->print_footer(); ?>
</div>
