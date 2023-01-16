<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OpenStreetMap</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <!-- CSS -->
    <style>
        body{
            margin:0
        }
        #maCarte{
            height: 100vh;
        }
    </style>
</head>
<body>
<div id="maCarte"></div>

<!-- Fichiers Javascript -->
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>
<script>
    // On initialise la carte
    var carte = L.map('maCarte').setView([6.4701,-5.34369], 7);

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
                    // On crée un marqueur pour l'agence

               /// L.marker([50.505, 30.57], {icon: myIcon}).addTo(map);
                    if(agence[1].typep=='CAFE'){
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
</script>
</body>
</html>