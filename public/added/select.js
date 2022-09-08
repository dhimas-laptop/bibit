$('#jenis').on("change", function () {
    const kelompok = $('#jenis option:selected').val();
    
    if (kelompok == "kelompok") {
        $('.kelompok').show();
        $('#tutup').hide();
    } else {
        $('.kelompok').hide();
        $('#tutup').show();
    }
});

 $(document).ready(function() { 
    $('.add').click(function() { 
        var html = $('.copy').html();
        $('.after').append(html);
    });

    $("body").on("click",".remove",function(){ 
        $(this).parents(".form-group").remove();
    });

});


