$(document).ready(function () {
    $("#tabla_usuarios").dataTable({
                                       pagingType   : "full_numbers",
                                       dom         :"<'content'" +
                                                    "   <'t_top'"+
                                                    "       <'row justify-content-between align-items-end'" +
                                                    "           <'col-auto'f>" +
                                                    "           <'col-auto'l>" +
                                                    "       >" +
                                                    "       <'row mb-2'" +
                                                    "            <'col-12'i>" +
                                                    "       >" +
                                                    "   >" +
                                                    "   <'row dt-table-wrapper justify-content-between'" +
                                                    "       <'col-12'rt>" +
                                                    "   >" +
                                                    "   <'t_top'"+
                                                    "       <'row justify-content-center'" +
                                                    "           <'col-auto'p>" +
                                                    "       >" +
                                                    "   >" +
                                                    ">",
                                       language: {
                                           "sProcessing":     $("#loading-tmp").html(),
                                           "sLengthMenu":     "Mostrar: _MENU_",
                                           "sZeroRecords":    "<h5 class=\"no_results\">No se encontraron resultados</h5>",
                                           "sEmptyTable":     $("#empty-tmp").html(),
                                           "sInfo":           "<span>_TOTAL_ Registros (registros del _START_ al _END_)</span>",
                                           "sInfoEmpty":      "Sin Registros",
                                           "sInfoFiltered":   "<i>(filtrado de un total de _MAX_ registros)</i>",
                                           "sInfoPostFix":    "",
                                           "sSearch":         "Buscar: ",
                                           "sUrl":            "",
                                           "sInfoThousands":  ",",
                                           "sLoadingRecords": $("#loading-tmp").html(),
                                           "oPaginate": {
                                               "sFirst":    "<i class=\"fas fa-angle-double-left \"></i>",
                                               "sLast":     "<i class=\"fas fa-angle-double-right \"></i>",
                                               "sNext":     "<i class=\"fas fa-angle-right \"></i>",
                                               "sPrevious": "<i class=\"fas fa-angle-left \"></i>"
                                           },
                                           "oAria": {
                                               "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                               "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                           }
                                       }
                                   });
});