html new pregunta-------------------------------------------------------------------------------------

{% extends 'base.html.twig' %}

{% block body %}
    <div class="estilo-body">
        <h1>Gestor de preguntas</h1>
        <div class="formulario">
            {{ form_start(form) }}
                <h3>Question</h3>
                {{ form_row(form.descripcion) }}
                
                <br>
                <input type="submit" value="Create" class="bottom"/>
            {{ form_end(form) }}
        </div>
        <ul>
            <li>
                <a href="{{ path('pregunta_index') }}">Back to the list</a>
            </li>
        </ul>
    </div>
{% endblock %}

new respuesta html----------------------------------------------------------------------------------------

{% extends 'base.html.twig' %}

{% block body %}
    <h1>Respuestum creation</h1>

    
    {{ form_start(form) }}
      
            {# iterate over each existing tag and render its only field: name #}
            {{ form_row(form.descripcion) }}
            {{ form_row(form.escorrecta) }}
        
        <input type="submit" value="Create" />
    {{ form_end(form) }}

    <ul>
        <li>
            <a href="{{ path('respuesta_index') }}">Back to the list</a>
        </li>
    </ul>
{% endblock %}
{% block javascripts %}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/agregarRespuestas.js') }}" type="text/javascript"></script>
{% endblock %}

----------------------------------------------------------------------------------------------------

new de pregunta controler

public function newAction(Request $request)
    {
        $pregunta = new Pregunta();
        $form = $this->createForm('RoyalAcademyBundle\Form\PreguntaType', $pregunta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $pregunta->setExamenexamen(NULL);
            $em->persist($pregunta);
            $em->flush();
            
            $response = $this -> forward('RoyalAcademyBundle:Respuesta:new',[
                'idpregunta'=>$pregunta->getIdpregunta(),
            ]);
            return $response;
          

            return $this->redirectToRoute('pregunta_show', array('idpregunta' => $pregunta->getIdpregunta()));
        }

        return $this->render('pregunta/new.html.twig', array(
            'pregunta' => $pregunta,
            'form' => $form->createView(),
        ));
    }
---------------------------------------------------------------------------------