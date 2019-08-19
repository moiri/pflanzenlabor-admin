$(document).ready(function() {
    var $i_input = $('input[name="positions-impressions"]');
    var $i_list = $('#list-impressions');
    new Sortable(document.getElementById('list-impressions'), {
        ghostClass: 'list-group-item-success',
        filter: ".ignore-sortable",
        onSort : function(evt) {
            sort_items($i_list, $i_input);
        }
    });
    var $c_input = $('input[name="positions-impressions_content"]');
    var $c_list = $('#list-content');
    new Sortable(document.getElementById('list-content'), {
        ghostClass: 'list-group-item-success',
        filter: ".ignore-sortable",
        onSort : function(evt) {
            sort_items($c_list, $c_input);
        }
    });

    function sort_items($list, $input) {
        var order = [];
        var $span = $list.find('span.badge');
        $span.each(function(idx) {
            order[$(this).text()] = idx * 10;
        });
        $input.val(order);
    }
});
