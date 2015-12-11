
// JQUERY permettant la gestion des menus déroulants.
$($.fn.categories = function(){
	var menus = $("#categories li ul li");
	menus.hide();

	$("#content").css({
		"margin-top": $("header").height() + 50
	});

	var categories = $("#categories > li");

	categories.mouseenter(function(){   // On affiche les menus déroulants.

		//$("section").text($(this).position().top);

		$(this).find("ul").css({
			"left": $(this).position().left,
			"top": $(this).position().top + $(this).height() + 30
		});

		$(this).find("ul li").css({
			"display": "list-item",
		});

		$(this).find("ul").stop().slideDown("fast");
	});

	categories.mouseleave(function(){				
		$(this).find("ul").stop().slideUp("fast");  // On cache les menus déroulant.
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

// JQUERY permettant l'affichage d'un formulaire de connexion.
$($.fn.connexion = function() {
	$('html').addClass('js');

	//objet connexion formulaire
	var connexionForm = {
		container: $('#connexion'),//le contenant

		//configuration par défaut
		config: {
			effect: 'fadeToggle'
		},

		//pseudo constructeur
		init: function(config) {
			$.extend(this.config, config);//override de la config

            $('#connexionB').on('click', this.show);
		},

		//méthode show
		show: function() {

			if (connexionForm.container.is(':hidden') && $('#inscription').is(':hidden')) { // si le container est caché alors on le montre, sinon ca n'a aucun sens
				connexionForm.close.call(connexionForm.container); // appel de la methode close avec connexionForm.container en temps que this
				connexionForm.container[connexionForm.config.effect](connexionForm.config.speed); // c'est comme si on faisait concexionForm.container.show() sauf qu'on utilise notre ini
			}

			connexionForm.container.css({
				"left": $(document).width()/2 - connexionForm.container.width()/2 
			});
		},

		//méthode close
		close: function() {
			var $this = $(this); //ici on parle de notre objet connexionForm

			if ($this.find('span.close').length) return ; //si il y a deja une span avec une croix on se casse, sinon on va en rajouter une a chaque fois qu'on passe par la

			$('<span class=close>X</span>')
				.prependTo(this)
				.on('click', function() { // au clic sur la croix
					$this[connexionForm.config.effect](connexionForm.config.speed); //meme chose que si on faisait $this.hide() mais avec notre config
				})
		}
	};

	connexionForm.init({
		effect:'fadeToggle', // ici on peu changer en mettant l'effet que l'on veut , ca marchera tout aussi bien (slide etc)
		speed: 400 //meme chose pour la vitesse
	});
});




// JQUERY permettant de générer le formulaire d'inscription, je pense qu'il y a moyen de ne faire qu'une seule fonction en utilisant des classes, du style (.forms)
$($.fn.inscription = function() {
	$('html').addClass('js');

	var connexionForm = {
		container: $('#inscription'),

		config: {
			effect: 'fadeToggle'
		},

		init: function(config) {
			$.extend(this.config, config);

            $('#inscriptionB').on('click', this.show) ; 
		},

		show: function() {

			if (connexionForm.container.is(':hidden') && $('#connexion').is(':hidden')) {
				connexionForm.close.call(connexionForm.container);
				connexionForm.container[connexionForm.config.effect](connexionForm.config.speed);
			}

			connexionForm.container.css({
				"left": $(document).width()/2 - connexionForm.container.width()/2 
			});
		},

		close: function() {
			var $this = $(this);

			if ($this.find('span.close').length) return ;

			$('<span class=close>X</span>')
				.prependTo(this)
				.on('click', function() {
					$this[connexionForm.config.effect](connexionForm.config.speed);
				})
		}
	};

	connexionForm.init({
		effect:'fadeToggle',
		speed: 400
	});
});




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




// JQUERY permettant de soumettre une inscription.
$(document).ready(function() {

	$('#inscription').submit(function() {
		var action = $(this).attr('action');
		var nom = $('#nom').val();
		var prenom = $('#prenom').val();
		var login = $('#login').val();
		var mdp = $('#mdp').val();
		var mail = $('#mail').val();
		var adresse = $('#mail').val();
		var ville = $('#ville').val();
		var CP = $('#CP').val();
		var commentaire = $('#commentaire').val();

		$('.messagesinsc').slideUp('800', function() {

			$('#inscription input[type="submit"]').hide().after('<img src="gif/ajax-loader.gif" class="loader">');

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
});





// JQUERY permettant de soumettre une connexion.
$('#connexion').submit(function() {

		var action = $(this).attr('action');
		var login = $('#loginCo').val();
		var pass = $('#passCo').val();

		$('.messagesCo').slideUp('800', function() {

			$('#connexion input[type="submit"]').hide().after('<img src="ajax-loader.gif" class="loader">');

			$.post(action, {
				login: login,
				pass: pass
			}, function(data) {
				$('.messagesCo').html(data);
				$('.messagesCo').slideDown('slow');
				$('.loader').fadeOut();
				$('#connexion input[type="submit"]').fadeIn();
			});
		});
		return false;
	});
