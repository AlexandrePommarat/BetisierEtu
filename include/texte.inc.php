<div id="texte">
	<?php
	if (!empty($_GET["page"])){
		$page=$_GET["page"];}
		else
		{$page=0;
		}
		switch ($page) {
			//
			// Personnes
			//

			case 0:
			// inclure ici la page accueil photo
			include_once('pages/accueil.inc.php');
			break;
			case 1:
			// inclure ici la page insertion nouvelle personne
			include("pages/ajouterPersonne.inc.php");
			break;

			case 2:
			// inclure ici la page liste des personnes
			include_once('pages/listerPersonnes.inc.php');
			break;
			case 3:
			// inclure ici la page modification des personnes
			include("pages/ModifierPersonneSelect.inc.php");
			break;
			case 4:
			// inclure ici la page suppression personnes
			include_once('pages/supprimerPersonne.inc.php');
			break;
			//
			// Citations
			//
			case 5:
			// inclure ici la page ajouter citations
			include("pages/ajouterCitation.inc.php");
			break;

			case 6:
			// inclure ici la page liste des citations
			include("pages/listerCitation.inc.php");
			break;
			//
			// Villes
			//
			case 7:
			include("pages/rechercherCitations.inc.php");
			break;

			case 8:
			// inclure ici la page lister  ville
			include("pages/listerVilles.inc.php");
			break;

			//

			//
			case 9:
			include("pages/connexion.inc.php");
			break;
			case 10:
			include("pages/confirmationVille.inc.php");
			break;

			case 11:
			include("pages/deconnexion.inc.php");
			break;

			case 12:
			include("pages/detailPersonne.inc.php");
			break;


			case 14:
			include("pages/ajouterSalarie.inc.php");
			break;

			case 15:
			include("pages/ajouterEtudiant.inc.php");
			break;

			case 16:
			include("pages/noterCitations.inc.php");
			break;

			case 17:

			include("pages/ajouterVille.inc.php");
			break;
			case 18:

			include("pages/validerCitations.inc.php");
			break;
			case 19:

			include("pages/supprimerCitations.inc.php");
			break;
			case 20:

			include("pages/modifierVilles.inc.php");
			break;
			case 21:

			include("pages/supprimerVilles.inc.php");
			break;
			case 22:

			include("pages/confirmationValidation.inc.php");
			break;
			case 23:

			include("pages/confirmationSuppressionVille.inc.php");
			break;

			case 24:
			include("pages/confirmationSuppressionCitation.inc.php");
			break;

			case 25:
			include("pages/confirmationSuppressionPersonne.inc.php");
			break;

			case 26:
			include("pages/ModifierPersonne.inc.php");
			break;

			case 27:
			include("pages/ModifierSalarie.inc.php");
			break;

			case 28:
			include("pages/ModifierEtudiant.inc.php");
			break;
			default : 	include_once('pages/accueil.inc.php');

		}
		?>
	</div>
