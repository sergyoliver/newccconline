tableau = function(mois,annee)
{
   var url = './ajax/ajax_calendrier.php';
   var parametres = 'mois=' + mois + '&annee=' + annee;

		var myAjax = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: parametres,
				onComplete: remplirCalendrier
			}
		);
}
function remplirCalendrier(reponsejson) {
       //on utilise la fonction evalJSON de prototype pour parser la réponse JSON
       var data=reponsejson.responseText.evalJSON();
       //On place les liens suivants,précédents et le mois en cours
       $('link_suivant').onclick=function(){eval(data.lien_suivant) ;};
       $('link_precedent').onclick=function(){eval(data.lien_precedent);};
       $('titre').innerHTML=data.mois_en_cours;
       //Maintenant, on affiche tous les jours du calendrier
       var compteur=1;
       var id='';
       while(compteur<43){
          id=compteur.toString();
          $(id).innerHTML=data.calendrier[(compteur-1)].fill;
          compteur++;
       }




}


function showEvent(date){

   var url = './ajax/ajax_commentaires.php';
   var parametres = 'date=' + date ;

		var myAjax = new Ajax.Request(
			url,
			{
				method: 'get',
				parameters: parametres,
				onComplete: remplirCommentaires
			}
		);
}


function remplirCommentaires(reponse){
         var commentaires=reponse.responseText;
         $('Evenements').innerHTML=commentaires;
         PullDown.panel = Rico.SlidingPanel.top( $('outer_panel'), $('inner_panel'));
         PullDown.panel.toggle();
}
