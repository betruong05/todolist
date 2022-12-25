'use strict';

$(function() {
    // Initialize date picker:
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        weekStart: 1
    });

    // Button events:
    $('.btn-work-edit').on('click', function() {
        let $tableRow = $(this).parents('.table-row');

        $tableRow.find('.cell-value, .cell-edit-delete').hide();
        $tableRow.find('.cell-input').show();
        $tableRow.find('.cell-save-discard').css('display', 'inline-flex');
    });

    $('.btn-work-discard').on('click', function() {
        let $tableRow = $(this).parents('.table-row');

        $tableRow.find('.cell-input, .cell-save-discard').hide();
        $tableRow.find('.cell-value').show();
        $tableRow.find('.cell-edit-delete').css('display', 'inline-flex');
    });

    $('.btn-work-delete').on('click', function() {
        if (confirm('Are you sure you want to DELETE this work?')) {
            window.location.href = $(this).data('href');
        }
    });
});