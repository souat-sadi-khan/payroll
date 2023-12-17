var DatatableSelect = function() {

    // Basic Datatable examples
    var _componentDatatableSelect = function() {
        if (!$().DataTable) {
            console.warn('Warning - datatables.min.js is not loaded.');
            return;
        }

        // Setting datatable defaults
        $.extend($.fn.dataTable.defaults, {
            autoWidth: false,
            responsive: true,
            dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
            language: {
                search: '<span>Filter:</span> _INPUT_',
                searchPlaceholder: 'Type to filter...',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                lengthMenu: '<span>Show:</span> _MENU_',
                paginate: {
                    'first': 'First',
                    'last': 'Last',
                    'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                    'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                }
            }
        });

        emran = $('.content_managment_table').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copy',
                className: 'btn btn-info'
            }, {
                extend: 'csv',
                className: 'btn btn-info'
            }, {
                extend: 'excel',
                className: 'btn btn-info'
            }, {
                extend: 'pdf',
                className: 'btn btn-info'
            }, {
                extend: 'print',
                className: 'btn btn-info'
            }],
            columnDefs: [{
                width: "100px",
                targets: [0]
            }, {
                orderable: false,
                targets: [4]
            }],

            order: [0, 'desc'],
            processing: true,
            serverSide: true,

            ajax: $('.content_managment_table').data('url'),
            columns: [
                // { data: 'checkbox', name: 'checkbox' },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'subject',
                    name: 'subject'
                }, {
                    data: 'url',
                    name: 'url'
                }, {
                    data: 'method',
                    name: 'method'
                }, {
                    data: 'ip',
                    name: 'ip'
                }, {
                    data: 'agent',
                    name: 'agent'
                }, {
                    data: 'user_id',
                    name: 'user_id'
                }
            ]

        });


    };

    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _componentDatatableSelect();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    DatatableSelect.init();
});