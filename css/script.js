$(document).ready(function() {

// JQUERY: GESTION DU CONTENU GENERE A L'AIDE D'AJAX.
    $('#content').on('click', 'li', function() {
        var idJoueur = $(this).attr('id') ;

        $.post('ajax/joueurs.php', {
            id: idJoueur
        }, function(data) {
            $("#details").html(data);
        });
    });
// FIN DE LA GESTION JQUERY DU CONTENU AJAX.



// JQUERY: GESTION DE CERTAINES PROPRIETES CSS.
    $(window).on('resize', function() {
		$("#content").css({
			"margin-top": $("header").height() + 30
		});
	});
// FIN DE LA GESTION DE PROPRIETES CSS.
	


// JQUERY: GESTION DES MENU DEROULANTS.
	$($.fn.categories = function(){
		var menus = $("#categories li ul li");
		var categories = $("#categories > li");

		menus.hide();

	categories.mouseenter(function(){   // On affiche les menus déroulants.

		$(this).find("ul").css({
			"left": $(this).position().left,
			"top": $(this).position().top + $(this).height() + 28
		});

		$(this).find("ul li").css({
			"display": "list-item",
		});

		$(this).find("ul").stop().slideDown(250);
	});

	categories.mouseleave(function(){				
		$(this).find("ul").stop().slideUp(250);  // On cache les menus déroulant.
	});

    var test;
	menus.on('click', function () {
		var idMenu = $(this).attr('id'); 
		test = idMenu;
		$.post('ajax/menus.php', {
		    idMenu: idMenu
		            
		}, function(data) {
			$('#content').html(data);				
		});

		});

		categories.on('click', function () {
			var idCtg = $(this).attr('id'); 
		      
		    if(test == null){
				$.post('ajax/categories.php', {
		        		idCtg: idCtg
		        
		    		}, function(data) {
					    $('#content').html(data);				
				    });
		        } else { 
		            test = null;
		        }
			});
		});
// FIN DE LA GESTION JQUERY DES MENU DEROULANTS.



// JQUERY: GESTION DES FORMULAIRES.
		function afficheForm(form, formSec, bouton) {
    // Objet formulaire.
    var form = {
        container: form, // Contenant. 

        // Configuration par défaut.
        config: {
            effect: 'fadeToggle'
        },

        // Pseudo constructeur
        init: function(config) {
            $.extend(this.config, config);//override de la config

            bouton.on('click', this.show);
        },

        // Méthode show: permet d'afficher le formulaire.
        show: function() {

            if (form.container.is(':hidden') && formSec.is(':hidden')) { // Si le container est caché alors on le montre, sinon ca n'a aucun sens.
                form.close.call(form.container); // Appel de la methode close.
                form.container[form.config.effect](form.config.speed);
            }

            $("#shade").css({
            	"display": "block"
            });

            form.container.css({
                "left": $(document).width()/2 - form.container.width()/2
            });
        },

        // Méthode close: permet de dissimuler/ fermer le formulaire.
        close: function() {
            var $this = $(this); // Ici, this = form.

            if ($this.find('span.close').length) return ; // Création d'une croix si nécessaire.

            $('<span class=close>X</span>')
                .prependTo(this)
                .on('click', function() { // Au clic sur la croix

                	$("#shade").css({
		            	"display": "none"
		            });

                    $this[form.config.effect](form.config.speed); // Meme effet que $this.hide() mais avec notre config.
                })
        }
    };

    form.init({
        effect:'fadeToggle', // Effet d'apparition et de disparition du formulaire.
        speed: 400 // Vitesse de l'effet cité ci-dessus.
    });
}

$(afficheForm($('#connexion'), $('#inscription'), $('#connexionB'))) ;
$(afficheForm($('#inscription'), $('#connexion'), $('#inscriptionB'))) ;
// FIN DE LA FESTION JQUERY DES FORMULAIRES.



// JQUERY: GESTION DE CREATION D'UNE REQUETE.
		function creerRequete() {
			var requete = null;
			try {
				requete=new XMLHttpRequest();
			} catch (essaimicrosoft) {
				try {
					requete = new ActiveXObject("Msxm12.XMLHTTP");
				} catch (autremicrosoft) {
					try {
						requete = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (echec) {
						requete = null ;
					}
				}
			}

			if (requete == null) {
				alert('impossible de créer l\'objet requete !');
			} else {
				return requete ;
			}
		}
// FIN DE LA GESTION JQUERY DE CREATION D'UNE REQUETE.



// JQUERY: GESTION DE SOUMISSION D'UNE INSCRIPTION.
			$('#inscription').submit(function() {
				var action = $(this).attr('action'); // Action à exécuter.
				var nom = $('#nom').val();	// Nom fourni.
				var prenom = $('#prenom').val(); // Prénom fourni.
				var login = $('#login').val(); // Login fourni.
				var mdp = $('#mdp').val(); // Mot de passe fourni.
				var mail = $('#mail').val(); // E-mail fourni.
				var adresse = $('#mail').val(); // Adresse fournie.
				var ville = $('#ville').val(); // Ville vournie
				var CP = $('#CP').val(); // Code postal fourni
				var commentaire = $('#commentaire').val(); // Commentaire.

				$('.messagesinsc').slideUp('800', function() {

					$('#inscription input[type="submit"]').hide().after('<img src="gif/ajax-loader.gif" class="loader">'); // Effet de chargement.

					// On poste les informations fournies grâce à la méthode post de JQUERY
					$.post(action, {
						nom: nom,
						prenom: prenom,
						login: login,
						mdp: mdp,
						mail:mail,
						adresse: adresse,
						ville: ville,
						CP: CP,
						commentaire: commentaire
					}, function(data) {
						$('.messagesinsc').html(data);
						$('.messagesinsc').slideDown('slow');
						$('.loader').fadeOut();
						$('#inscription input[type="submit"]').fadeIn();
					});
				});
				return false;
			});
// FIN DE LA GESTION JQUERY DE SOUMISSION D'INSCRIPTION.



// JQUERY: GESTION DE SOUMISSION D'UNE CONNEXION
		$('#connexion').submit(function() {

				var action = $(this).attr('action');
		        var code = $('#code').val();
		        
				$('.messagesCo').slideUp('800', function() {

					$('#connexion input[type="submit"]').hide().after('<img src="ajax-loader.gif" class="loader">'); // Effet de chargement.

					$.post(action, {
		                code: code
					}, function(data) {
						$('.messagesCo').html(data);
						$('.messagesCo').slideDown('slow');
						$('.loader').fadeOut();
						$('#connexion input[type="submit"]').fadeIn();
					});
				});
				return false;
		});
// FIN DE LA GESTION JQUERY DE SOUMISSION D'UNE CONNEXION.

});