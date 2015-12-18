<?php 

	function calendar($month, $year, $displayYear = false){
		#Variables utiles {

		// Réglage des paramètre d'affichage en Français
		setlocale(LC_ALL, 'fr_FR.utf8');

		// Les jours de la semaine
		$semaine = array('L', 'M', 'M', 'J', 'V', 'S', 'D');

		// Le premier jour du mois courant sous forme de timestamp
		$date = mktime(0,0,0, $month, 1, $year) ;

		// Jour actuel
		$today = date('d');

		// Nom du mois et année
		$nom_mois = strftime($displayYear ? "%B %Y" : "%B", $date) ;

		// Numéro du premier jour du mois (1:lundi, 7 dimanche)
		$premier_jour_mois = date('N', $date);

		// Nombre de jours dans le mois
		$nombre_jours_mois = date('t', $date);

	# }




	#Création de la première ligne du calendrier contenant le mois ainsi que l'année courants {
		$html = "<table class='calendar'><tr class='month'><th colspan='7'>".$nom_mois."</th></tr>";
	# }

	#Création de la seconde ligne du calendrier contenant les jours de la semaine {
		$html .= "<tr class='week'>";
				
		for($i = 0; $i < sizeof($semaine); $i++) {		
			$html .= "<th>".$semaine[$i]."</th>";
		}

		$html .= "</tr>";
	# }

	#Création du corps du calendrier {
		$html .= "<tr>";

		#Création de case vide dans le cas ou le premier jour du mois n'est pas un lundi.
		$i = 1;

		while($i < $premier_jour_mois){
			$html .= "<td class='vide'>";
			$i++;
		}

		#Remplissage des cases du calendrier avec les jours du mois et récupération de $i.
		$class = "";

		for($j = 1; $j <= $nombre_jours_mois; $j++, $i++){

			#Gestion du saut de ligne.
			if(($i % 7 == 1) && ($i != 1)){
				$html .= "<tr>";
			}
			
			if(($i % 7 == 6) || ($i % 7 == 0)){
				$class = " class='weekend'";
			} else {
				$class = "";
			}

			if($j == $today && $month == date('m') && $year == date('Y')) {
				$html .= "<td id='today'>".$j."</td>";				
			} else {
				$html .= "<td{$class}>".$j."</td>";
			}
		}
		$i--;
		
	# }

	#Création de cases vides à la suite du remplissage du calendrier, si nécessaire et fin du calendrier {
		while($i % 7 > 0){
			$html .= "<td class='vide'>";
			$i++;
		}

		$html .= "</tr></table>";
	# }

		return $html;
	}