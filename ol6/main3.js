window.onload = init;
function init(){
    const attributionControl = new ol.control.Attribution({
        collapsible: true
    });
    const map = new ol.Map({
        view: new ol.View({
            center: [-446171.65428536216,598460.424970302],
            zoom: 12,
            maxZoom: 30,
            minZoom: 11
        }),

        target: 'js-map',
        controls: ol.control.defaults({attribution: false}).extend([attributionControl])
    });
    const fillStyle = new ol.style.Fill({
        color: [40, 119, 247, 1]
    });

    // Style for lines
    const strokeStyle = new ol.style.Stroke({
        color: [30, 30, 31, 1],
        width: 1.2
        //lineCap: 'square',
        //: 'bevel',
        //lineDash: [3, 3]
    });

    const styleforet = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#0b8f13",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#fff',
            width: 0,
            lineCap: 'square',
            //: 'bevel',
            lineDash: [3, 3]
        })
    });



    const openstreetmap = new ol.layer.Tile({
        source: new ol.source.OSM(),
        visible: true,
        title: 'OSM'
    });
    const circleStyle = new ol.style.Circle({
        fill: new ol.style.Fill({
            color: [245, 49, 5, 1]
        }),
        radius: 7,
        stroke: strokeStyle
    });
    const datafiche = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/pointfiche.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Personnes enrolées',
        style: new ol.style.Style({
            fill: fillStyle,
            stroke: strokeStyle,
            image: circleStyle
        })
    });
    const foret = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/foret.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Forêt Classées',
        style: styleforet
    });
    // Base Layer Group
    const baseLayerGroup = new ol.layer.Group({
        layers: [foret]
    });
    map.addLayer(baseLayerGroup);

    /// interraction click
    const popupContainerElement = document.getElementById('popup-content');
    const popup = new ol.Overlay({
        element: popupContainerElement,
        positioning: 'top-right'
    });

    map.addOverlay(popup);
    const overlayFeatureName = document.getElementById('feature-name');
    const overlayFeatureAdditionInfo = document.getElementById('feature-additional-info');

    var select2 = new ol.interaction.Select({
        layers: [datafiche],
        condition:ol.events.condition.pointermove
    });
    map.on('click', function(evt) {

        //overlayLayer.setPosition(undefined);
        map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){

            console.log(feature.get('nomag'));
            let  clickedCoordinate = evt.coordinate;
            let agent = feature.get('nomag');
            let nomenr = feature.get('nomenr');
            let datecrea = feature.get('datecrea');


            // let clickedCoordinate = e.coordinate;
            // let clickedFeatureName = feature.get('name');
            //  let clickedFeatureAdditionInfo = feature.get('additionalinfo');
            if(agent && nomenr != undefined) {
                /**/

                // overlayFeatureName.innerHTML = agent;
                // overlayFeatureAdditionInfo.innerHTML = nomenr+' enregistré le : '+datecrea;
                popupContainerElement.innerHTML='<div class="alert alert-success" > <button type="button" class="close" data-dismiss="alert" aria-hidden="true">× </button>'
                    +'<h4 class="text-white" id="feature-name">'+agent+'</h4> <p >'+nomenr+' enregistré le : '+datecrea+'</p> </div>';
                popup.setPosition(clickedCoordinate);
            }
        });
        /* const clickedCoordinate = e.coordinate;
         popup.setPosition(undefined);
         popup.setPosition(clickedCoordinate);
         popupContainerElement.innerHTML = clickedCoordinate;*/
    })


}

