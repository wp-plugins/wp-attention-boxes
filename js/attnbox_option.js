

jQuery(document).ready(function () {
 
   // Attach handler to checkbox, so that after page loads, 
   // checking/unchecking the Enable checkbox makes it
   // clear you are disabling the Box/Div via css
   // ------------------------------------------------
    jQuery("input:checkbox").click( function () {
        id = jQuery(this).attr("id");
        if (this.checked) {
            jQuery("table#group_" + id + " tr td :input").css({color:'#000000'});
            jQuery("table#group_" + id + " tr th .name_input").css({color:'#000000'});
        }
         else {
            jQuery("table#group_" + id + " tr td :input").css({color:'#808080'}); 
            jQuery("table#group_" + id + " tr th .name_input").css({color:'#808080'});


        }
    })

});

