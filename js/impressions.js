$(document).ready(function() {
    new Sortable(document.getElementById('list-impressions'), {
        ghostClass: 'list-group-item-success',
        filter: ".ignore-sortable",
    });
    new Sortable(document.getElementById('list-content'), {
        ghostClass: 'list-group-item-success',
        filter: ".ignore-sortable",
    });
});
