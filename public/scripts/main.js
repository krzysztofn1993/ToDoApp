$(document).ready(function() {
    function addStrikeThrough(event)
    {
        $(this).closest('li').addClass('strikethrough');        
    }
    
    function removeStrikeThrough(event)
    {
        $(this).closest('li').removeClass('strikethrough');
    }

    $('ul').on('mouseenter focus', '.tasks__done', addStrikeThrough);
    $('ul').on('mouseleave blur', '.tasks__done', removeStrikeThrough);        
});