$(document).ready(function(){
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