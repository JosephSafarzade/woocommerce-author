jQuery(document).ready(function(){


    wooa_init_select2_inputs();


});



function wooa_init_select2_inputs(){

    if( $(".wooa-admin-input-select").length < 1 ){

        return;

    }

    $(".wooa-admin-input-select").select2();

}