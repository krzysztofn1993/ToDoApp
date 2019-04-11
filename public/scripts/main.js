document.addEventListener("DOMContentLoaded", function(event) {

    let doneButtons = document.querySelectorAll('.tasks__done');
    
    function addStrikeThrough(event)
    {
        this.closest('li').classList.add('strikethrough');        
    }
    
    function removeStrikeThrough(event)
    {
        this.closest('li').classList.remove('strikethrough');
    }

    doneButtons.forEach(function(doneButton) {
        doneButton.addEventListener('mouseenter', addStrikeThrough.bind(doneButton));
        doneButton.addEventListener('mouseleave', removeStrikeThrough.bind(doneButton));
        doneButton.addEventListener('focus', addStrikeThrough.bind(doneButton));
        doneButton.addEventListener('blur', removeStrikeThrough.bind(doneButton));
    });
    

});