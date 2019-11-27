$(document).ready(function(){
    $("input[name=product_search], input[name=category_search], input[name=city_search]").keyup(function() {
        // $(".service-parent").each(function( index ) {
        //     console.log( index + ": " + $( this ).text() );
        // });
        var product_search  = $('input[name=product_search]').val().toLowerCase()
        var category_search = $('input[name=category_search]').val().toLowerCase()
        var city_search     = $('input[name=city_search]').val().toLowerCase()

        $(".service-parent").each(function( index ) {
            // alert(category_search)
            // alert($( this ).attr('data-category').toLowerCase().indexOf(category_search))
            // return false;
            if (
                $( this ).attr('data-name').toLowerCase().indexOf(product_search) < 0 || 
                $( this ).attr('data-category').toLowerCase().indexOf(category_search) < 0 || 
                $( this ).attr('data-city').toLowerCase().indexOf(city_search) < 0
            ){
                $( this ).addClass('hide');
            }else{
                $( this ).removeClass('hide');
            }
        });
    });

    $('#city_id').change(function(){
        var request = $.ajax({
            url: "/api/cities/" + $(this).val(),
            method: "GET",
            dataType: "json"
        });
        
        request.done(function( msg ) {
            var html = "";
            $.each(msg.city.data.categories.data, function( index, value ) {
                html += '<option value="'+value.id+'">'+value.name+'</option>';
            });
            $('#category_id').html(html);
        });
        
        request.fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        });
    })
})