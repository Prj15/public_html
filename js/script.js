// Variables globales
var tri_actuel = "1"; // variable globale contenant le tri actuel
var ordre_t;

// Actions au lancement de la page
function init() {
	  // Ordres :
	  // 1 = plus petit en haut
	  // -1 = plus grand en haut
	  // on défini les tris non utilisés à 1, pour qu'ils passent à -1 au moment où on clique dessus
	ordre_t = [];
	for (var i = 1; i <= 10; i++) {
		ordre_t[i] = 1;
	}

	tableListener();
}
$(document).ready(function() {
	init();
// JQUERY: GESTION DU CONTENU GENERE A L'AIDE D'AJAX.
    $('#content').on('click', 'li', function() {
        var idJoueur = $(this).attr('id') ;

        $.post('ajax/joueurs.php', {
            id: idJoueur
        }, function(data) {
            $("#details").html(data);
        });
    });

    $('#content').on('click', 'input', function() {
        var idJoueur = $(this).attr('id').split('supprimer')[1] ; 
        console.log(idJoueur) ;

        $.post('ajax/suppression.php', {
            idJoueur: idJoueur
        }, function (data) {
            $('#reponse').html(data) ;
        });
    });
// FIN DE LA GESTION JQUERY DU CONTENU AJAX.

// JQUERY: GESTION DE CERTAINES PROPRIETES CSS.
    $(window).on('resize', function() {
		$("#content").css({
			"margin-top": $("header").height() + 30
		});

		$(".forms").css({
            "left": $(document).width()/2 - $(".forms").width()/2,
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
			"top": $(this).position().top + $(this).height() + 25
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

					$('#inscription input[type="submit"]').hide().after('<img src="../gif/ajax-loader.gif" class="loader">'); // Effet de chargement.

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

					$('#connexion input[type="submit"]').hide().after('<img src="../gif/ajax-loader.gif" class="loader">'); // Effet de chargement.

					$.post(action, {
		                code: code
					}, function(data) {
                        if (data=='OK') window.location.href ="../test.php";  
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
function refresh() {
console.log("Je ne passe jamais ici");
  xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      document.getElementById("content").innerHTML = xmlHttp.responseText;

      /* On va appeler init, mais ça remet les tris et les ordres par défaut. Donc on récupère le contenu du tri et de l'ordre actuel (avant de le perdre en passant par init). L'ordre, on sauvegarde son inverse pour le réaffecter plus tard (l'inverse car : quand on trigger le click, il le remettra tout seul dans le bon sens)
      On fait exactement la même chose pour se rappeler du bloc de commentaire qui était ouvert */
      var tri = tri_actuel;
      console.log(tri);
       if (isNumeric(tri)) { // tri sur les notes indiv
        var ordre_souvenir = ordre_t[tri_actuel] * -1;
      }
      init(); // ce batard de init nous fait perdre toutes nos données
      // heureusement, ordre_souvenir est la! Et le type de tri n'est pas non plus perdu, puisqu'il est param de la fonction dans laquelle on est :)
      tri_actuel = tri; // on réaffecte la variable globale contenant le tri;
      // On réaffecte l'ordre, selon le type de tri. Et on trigger le click!
     //if (isNumeric(tri)) { // tri sur les notes indiv
        ordre_t[tri] = ordre_souvenir;
        $("#t" + tri).trigger("click");
      //}
      // On est bons !

    }
  }
  xmlHttp.open("POST", "ajax/modif.php", true);
  xmlHttp.send();
}

function tableListener() {

	$('#content').on('click', '#userstab td',function(){
    	var idMembre = $(this).parent().attr("id");
    	var colonne = $(this).attr("class");
    	//console.log(colonne);
    	var contenuDuTdAvantChangement = $(this).html();

	    if (contenuDuTdAvantChangement.charAt(0) != '<') {
	      $(this).html("<input type='text' id='changee' value='" + contenuDuTdAvantChangement + "'>");
	      tdSurLequelOnClique = $(this);
	      $(this).find($("input"))[0].setSelectionRange(0, 10); // sélectionne le contenu de l'input. taille de 10, pour être sur (même si c'est dégueu)

	      $('#changee').focus();

	      $('#changee').keypress(function(e) {
	        if (e.keyCode == 13) {
	          $('#changee').focusout();
	        }
	      });

	      $('#changee').focusout(function() {
	        var laNouvelleValeur = $(this).val()
	        if (contenuDuTdAvantChangement != laNouvelleValeur && laNouvelleValeur.length > 0) {
	          tdSurLequelOnClique.html(laNouvelleValeur);
	        } else {
	          tdSurLequelOnClique.html(contenuDuTdAvantChangement);
	        }
	        majNote(idMembre,colonne, laNouvelleValeur);
	      });

	    }
	});

	$('#content').on('click', 'th', function(i) {

	// changement du contenu de la variable globale
		var idColTab = this.id.split("t")[1];
		tri_actuel = idColTab;

		// Suppression de la classe CSS de l'ancienne méthode de tri sélectionnée
		$(".tri_actuel").removeClass("tri_actuel");

		// Ajout de la classe CSS sur ce TH
		$(this).addClass("tri_actuel");

		ordre_t[idColTab] *= -1;

		var enfant = $(this).prevAll().length;

		if(idColTab == 1 || idColTab ==10)
				trierNombres(ordre_t[idColTab], enfant);

		else 	trierChaines(ordre_t[idColTab],enfant);

		for (var j = 1; j <=10; j++) {
			if(j != idColTab){
				ordre_t[j] = 1;
			} 
		}
	});  
}

function majNote(membre, colonne, laNouvelleValeur) {
    xmlMaj = new XMLHttpRequest();
    xmlMaj.onreadystatechange = function() {
      if (xmlMaj.readyState == 4 && xmlMaj.status == 200) {
        refresh();
      }
    }
    //xmlMaj.open();
	xmlMaj.open("POST", "ajax/modif.php", false);
	console.log("Je passe dans Maj js");
	xmlMaj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlMaj.send("idMembre= " + membre + "&modif=" + colonne + "&valeur=" + laNouvelleValeur);
  	//refresh();
}

function trierNombres(ordre, enfant) {
  var lignes = $('table tbody tr').get(); //recuperons
  console.log("lignes : " + lignes);
  lignes.sort(function(a, b) { // compare to classique
    var primo = Number($(a).children('td').eq(enfant).text());
    var deuzio = Number($(b).children('td').eq(enfant).text());

    // degage au fond du bus, valeur non numérique !
    if (primo == "") {
      return 1;
    } else if (deuzio == "") {
      return -1;
    }

    if (primo > deuzio) {
      return 1 * ordre;
    }

    if (primo < deuzio) {
      return -1 * ordre;
    }
    return 0;
  });


  var place = 1; // compteur d'itérations, pour savoir la place de la ligne dans le classement
  $.each(lignes, function(index, ligne) { // en voiture simone
    $('table').children('tbody').append(ligne);

    place++;
  });
}


function trierChaines(ordre, enfant) {

  var lignes = $('table tbody tr').get(); //recuperons

  lignes.sort(function(a, b) { // compare to classique
    var primo = $(a).children('td').eq(enfant).text().toUpperCase();
    var deuzio = $(b).children('td').eq(enfant).text().toUpperCase();

    if (primo > deuzio) {
      return -1 * ordre;
    }

    if (primo < deuzio) {
      return 1 * ordre;
    }
    return 0;
  });

  $.each(lignes, function(index, ligne) { // en voiture simone
    $('table').children('tbody').append(ligne);
  });
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}


