$('#mainform').button(function() {
    $('#formdata_container').show();
    $('#formdata').html($(this).serialize());
    return false;
});

$('#enableselect').click(function() {
    $('#mainform input[name=animal]')
        .attr("disabled", true);
    
    $('#animal-select')
        .attr('disabled', false)
    	.attr('name', 'animal');
    
    $('#enableselect').hide();
    return false;
});