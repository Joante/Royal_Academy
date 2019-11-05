// setup an "add a respuesta" link
var $addRespuestaLink = $('<a href="#" class="add_respuesta_link">Add a respuesta</a>');
var $newLinkLi = $('<li></li>').append($addRespuestaLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of respuestas
   var $collectionHolder = $('ul.respuestas');
    
    // add the "add a respuesta" anchor and li to the respuestas ul
    $collectionHolder.append($newLinkLi);
    
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    
    $addRespuestaLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();
        
        // add a new respuesta form (see code block below)
        addRespuestaForm($collectionHolder, $newLinkLi);
    });
    
    
});

function addRespuestaForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a respuesta" link li
    var $newFormLi = $('<li></li>').append(newForm);
    
    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-respuesta">x</a>');
    
    $newLinkLi.before($newFormLi);
    
    // handle the removal, just for this example
    $('.remove-respuesta').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
}