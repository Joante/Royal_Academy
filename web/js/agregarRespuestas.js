// setup an "add a respuesta" link
//configurar un enlace "agregar una respuesta"
var $addRespuestaLink = $('<a href="#" class="add_respuesta_link">Add a respuesta</a>');
var $newLinkLi = $('<li></li>').append($addRespuestaLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of respuestas
    //Get the ul that holds the collection of respuestas

   var $collectionHolder = $('ul.respuestas');
    
    // add the "add a respuesta" anchor and li to the respuestas ul
    //agregue el ancla "agregar una respuesta" y li a las respuestas ul
    $collectionHolder.append($newLinkLi);
    
    // count the current form inputs we have (e.g. 2), use that as the new
    //cuente las entradas de formulario actuales que tenemos (por ejemplo, 2), utilícelo como el nuevo
    // index when inserting a new item (e.g. 2)
    //índice al insertar un nuevo elemento (por ejemplo, 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    
    $addRespuestaLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        // evita que el enlace cree un "#" en la URL
        e.preventDefault();
        
        // add a new respuesta form (see code block below)
        //agregue un nuevo formulario de respuesta (vea el bloque de código a continuación)
        addRespuestaForm($collectionHolder, $newLinkLi);
    });
    
    
});

function addRespuestaForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    //Obtenga el prototipo de datos explicado anteriormente
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