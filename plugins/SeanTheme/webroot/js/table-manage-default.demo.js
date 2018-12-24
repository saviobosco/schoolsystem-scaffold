/*   
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 1.9.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin-v1.9/admin/
*/

var handleDataTableDefault = function() {
	"use strict";
    
    if ($('#data-table').length !== 0) {
        $('#data-table').DataTable({
            responsive: true,
            "lengthMenu": [[1000,2000, -1], [1000,2000, "All"]]
        });
    }
};

var handleDataTableCombinationSetting = function() {
    "use strict";

    if ($('#data-table-combine').length !== 0) {
        var options = {
            dom: 'lBfrtip',
            buttons: [
                { extend: 'copy', className: 'btn-sm' },
                { extend: 'csv', className: 'btn-sm' },
                { extend: 'excel', className: 'btn-sm' },
                { extend: 'pdf', className: 'btn-sm' },
                { extend: 'print', className: 'btn-sm' }
            ],
            "lengthMenu": [[1000,2000, -1], [1000,2000, "All"]],
            autoFill: true,
            colReorder: true,
            keys: true,
            rowReorder: true,
            select: true,
        };

        if ($(window).width() <= 767) {
            options.rowReorder = false;
            options.colReorder = false;
            options.autoFill = false;
        }
        $('#data-table-combine').DataTable(options);
    }
};
var TableManageDefault = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleDataTableDefault();
            handleDataTableCombinationSetting();
        }
    };
}();