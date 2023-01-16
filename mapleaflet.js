/**
 * Created by PC-ALERTEFONCIER on 14/01/2023.
 */
    // On initialise la carte
var carte = L.map('maCarte').setView([7.66874,-5.34369], 7);

// On charge les "tuiles"
L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    // Il est toujours bien de laisser le lien vers la source des données
    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/  <a href="//openstreetmap.ci">OSM CI</a>',
    minZoom: 1,
    maxZoom: 20
}).addTo(carte);
var myIcon = L.icon({
    iconUrl: 'icon/icon2c.png',
    iconSize: [20, 20],iconAnchor: [18, 30]
});
var myIconc = L.icon({
    iconUrl: 'icon/icon2.png',
    iconSize: [20, 20],
    iconAnchor: [18, 30]

});


var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = () => {
    // La transaction est terminée ?
    if(xmlhttp.readyState == 4){
        // Si la transaction est un succès
        if(xmlhttp.status == 200){
            // On traite les données reçues
            var donnees = JSON.parse(xmlhttp.responseText);
            // On boucle sur les données (ES8)
            Object.entries(donnees.features).forEach(agence => {
                // Ici j'ai une seule agence

                if( agence[1].typep=='CAFE' ){
                var mnicon=myIcon;
            }else{
                var mnicon=myIconc;
            }

            var marker = L.marker([agence[1].lat, agence[1].lon], {icon: mnicon}).addTo(carte);
            marker.bindPopup(agence[1].codep)
        })
        }else{
            console.log(xmlhttp.statusText);
        }
    }
}

xmlhttp.open("GET", "http://localhost/ccc/cccmysql/data/parcelle.php");
xmlhttp.send(null);
