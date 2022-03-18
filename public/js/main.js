$(document).ready( () => {

    // Récupérer le container pour les formulaires des étapes
    let containerEtapes = $('.container-etapes');

    // créer le bouton d'ajout des étapes
    let addNewEtape = $('<a href="#">Ajouter une nouvelle étape</a>');

    // Ajoute le bouton au container
    containerEtapes.append(addNewEtape);

    // Numéroter les panels pour qu'ils soient tous différents
    // ici je crée un attribut data-index dans ma div containerPhotos.
    // cela me permet de récupérer ensuite le nombre de 'card-photo' (formulaire) dans mon container
    containerEtapes.data('index', containerEtapes.find('.card-photo').length);

    // fonction qui permet d'ajouter dynamiquement le formulaire d'ajout de photo au DOM
    function addNewForm() {
        // récupération des informations du formulaire via le prototype
        let prototype = containerEtapes.data('prototype');
        // console.log(prototype);

        // Je crée une variable index qui récupère le nombre de card photo dans mon container
        let index = containerEtapes.data('index');

        // Créer le formulaire grace au prototype
        let newForm = prototype;

        // on définit ici l'index du formulaire qui est créé
        newForm = newForm.replace(/__name__/g, index);

        // on fait l'incrémentation de l'index
        containerEtapes.data('index', index+1);

        // je crée une nouvelle card qui va contenir notre formulaire
        let card = $('<div class="card-photo"></div>');

        // Ajout du formulaire à la card
        card.append(newForm);

        // ici on ajoute pour chaque card (chaque formulaire) un bouton de suppression
        addRemoveButton(card);

        // enfin on ajoute la card avec le formulaire au DOM
        addNewEtape.before(card);
    }

    // addNewForm();

    // on capte le click du bouton 'Ajouter une photo'
    addNewEtape.click(function (e) {
        // on doit stopper l'action par défaut
        e.preventDefault();

        // on appelle la fonction addNewForm pour créer un formulaire à chaque click
        addNewForm();
    })

    function addRemoveButton(card){
        // création du bouton remove
        let removeButton = $('<a href="#">Supprimer l\'étape</a>');

        // j'ajoute le bouton de suppression à la card passée en paramètre
        card.append(removeButton);

        // A chaque click de mon bouton de suppression je souhaite supprimer la card qui a pour class '.card-photo'
        removeButton.click(function (e) {
            e.preventDefault();
            // je récupère le parent de mon bouton qui a pour class '.card-photo'
            // j'utilise slideUp pour faire un effet de style et je lui dit que je souhaite supprimer la card en question
            // $(e.target).parents('.card-photo').slideUp(500, function () {
            //     $(this).remove();
            // })
            $(card).slideUp(500, function () { 
                $(this).remove();
            })

        })
    }

    containerEtapes.find('.card-photo').each(function () { 
        addRemoveButton($(this)) 
    });


} )