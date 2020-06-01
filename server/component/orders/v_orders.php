<div class="container-fluid">
    <?php $this->print_nav(); ?>
    <div class="card mb-3">
        <div class="card-header">
            Pflanznep&auml;ckli Abos
        </div>
        <div class="card-body">
            <table id="orders" class="table table-hover table-sm small" >
                <thead>
                    <tr>
                        <?php $this->print_packet_headers(); ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $this->print_packet_orders(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php $this->print_footer(); ?>
</div>
