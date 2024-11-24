/*************************************************************************************/
// -->Template Name: Bootstrap Press Admin
// -->Author: Themedesigner
// -->Email: niravjoshi87@gmail.com
// -->File: datatable_advanced_init
/*************************************************************************************/

//=============================================//
//    File export                              //
//=============================================//















$('#file_export').DataTable({
    dom: 'Bflrtip',

    buttons: [
        {
            extend: 'print',
            text: 'طباعة',
            title:"طلبات الاستقدام",

            customize: function ( win ) {
                $(win.document.body).css('direction', 'rtl');

                $(win.document.body)
                    .css( 'font-size', '10pt' )
                    .prepend(
                        '<img src="https://www.rawafdnajd.sa/public/uploads/all/JCPBAUETuvcBfdMAhh9jjkqAp9L5g08SCTscSLPO.svg" style=" position:absolute; top:10px; left:0px;" width="140px" height="50px"/>'
                    );

                $(win.document.body).find( 'table tr:first' )
                    .addClass( 'compact' )
                    .css( {'background-color':'#145e4e',
                        'color': 'white',});
            }
        },
        {
            extend: 'excel',
            text: 'اكسيل',
            title:"طلبات الاستقدام",

        }
    ],
    "pageLength": 10,
    "paging": true
});
$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-primary mr-1');

//==================================================//
//  Show / hide columns dynamically                 //
//==================================================//

