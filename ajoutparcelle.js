(function () {
    // Create a group for overlays. Add the group to the map when it's created
    // but add the overlay layers later
    var overlayGroup = new ol.layer.Group({
        title: 'Overlays',
        layers: []
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

    const styleparcelle = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#ffb80e",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#ff0b16',
            width: 0,
            lineCap: 'square',
            //: 'bevel',
            lineDash: [3, 3]
        })
    });
    const styleparc = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#0b8f13",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#800b11',
            width: 3,
            lineCap: 'square',
            //: 'bevel',
            lineDash: [1, 1]
        })
    });
    const style2km = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#72cf44",
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
    const style5km = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#b3e310",
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
 const stylem = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#ff811d",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#fff',
            width: 0,
            lineCap: 'square',
            //: 'bevel',
            lineDash: [3, 3]
        }),

         image: new ol.style.Icon({
             anchor: [0.5, 46],
             anchorXUnits: 'fraction',
             anchorYUnits: 'pixels',
             src: 'icon/icon2.png'
         })


    });
 const stylemc = new ol.style.Style({
        fill:new ol.style.Fill({
            color: "#ff811d",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#fff',
            width: 0,
            lineCap: 'square',
            //: 'bevel',
            lineDash: [3, 3]
        }),

         image: new ol.style.Icon({
             anchor: [0.5, 46],
             anchorXUnits: 'fraction',
             anchorYUnits: 'pixels',
             src: 'icon/icon2c.png'
         })


    });


    const fillStyle = new ol.style.Fill({
        color: "#145128"
    });


    // Create a map containing two group layers
    var map = new ol.Map({
        target: 'map',
        layers: [
            new ol.layer.Group({
                title: 'Base maps',
                fold: 'open',
                layers: [
                    new ol.layer.Tile({
                        title: 'Open StreetMap',
                        type: 'base',
                        visible: true,
                        source: new ol.source.OSM()
                    })
                ]
            }),
            overlayGroup
        ],
        view: new ol.View({
            center: ol.proj.transform([-5.43247,7.66874], 'EPSG:4326', 'EPSG:3857'),
            zoom: 7,
            maxZoom: 30,
            minZoom: 4
        })

    });




    var parcelle = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: 'data/parcelle.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Parcelle',
        style: function(feature) {
           // console.log(feature);
            switch (feature.get('typep')) {
                case 'CAFE' : {
                    return stylemc;
                    break;
                }
                case 'CACAO' : {
                    return stylem;
                    break;
                }
            }
        }
    });
    overlayGroup.getLayers().push(parcelle);



// bing
   /* const tilebing = new ol.layer.Tile({
        source: new ol.source.BingMaps({
            key:"ApEfFvagPjoPJoz54DnQXtH6NlEjCgDWX6nfUroWYMxZO3YmyVuBgZINKqmh6bG_",
            imagerySet:'Aerial'
        }),
        visible: true
    });*/
 //   map.addLayer(tilebing);
 /*   overlayGroup.getLayers().push(
        new ol.layer.Image({
            title: 'Countries',
            minResolution: 500,
            maxResolution: 5000,
            source: new ol.source.ImageArcGISRest({
                ratio: 1,
                params: { LAYERS: 'show:0' },
                url:
                    'http://sampleserver1.arcgisonline.com/ArcGIS/rest/services/Louisville/LOJIC_LandRecords_Louisville/MapServer'
            })
        })
    );

    parcelle.getSource().on('addfeature', function () {
        map.getView().fit(
            parcelle.getSource().getExtent(),
            {
                duration: 1590,
                size: map.getSize(),
                maxZoom: 10
            }
        );
    });*/
 /// afficher coordonnées au passage du curseur
    var mouseposition = new ol.control.MousePosition({
        projection:'EPSG : 4326',
        className:'mousePosition',
        CoordinateFormat: function (coordinate) {
        return ol.coordinate.format(coordinate,'{y},{x}',6);
        }
    });
    map.addControl(mouseposition);

    /// ajout echelle perso
    var scalecontrol = new ol.control.ScaleLine({
        bar:true,
        text:true
    });
    map.addControl(scalecontrol);




   // map.addControl(layerSwitcher);

    const popupContainerElement = document.getElementById('popup-content');
    const popup = new ol.Overlay({
        element: popupContainerElement,
        positioning: 'top-right'
    });

    map.addOverlay(popup);
    const overlayFeatureName = document.getElementById('feature-name');
    const overlayFeatureAdditionInfo = document.getElementById('feature-additional-info');

    var select2 = new ol.interaction.Select({
        layers: [parcelle],
        condition:ol.events.condition.pointermove
    });
    map.on('pointermove', function(evt) {
    console.log('test');
        //overlayLayer.setPosition(undefined);
        map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){

            console.log(feature);
            var  clickedCoordinate = evt.coordinate;

            var codep = feature.get('codep');
            var nompar = feature.get('nomp');
            var variete = feature.get('variete');
            var superficie = feature.get('superficie');
            var nomp = feature.get('nom_prod');
            var typep = feature.get('typep');
            var dep = feature.get('dep');
            // let clickedCoordinate = e.coordinate;
            // let clickedFeatureName = feature.get('name');
            //  let clickedFeatureAdditionInfo = feature.get('additionalinfo');
            if(nompar) {
                /**/

                // overlayFeatureName.innerHTML = agent;
                // overlayFeatureAdditionInfo.innerHTML = nomenr+' enregistré le : '+datecrea;
                popupContainerElement.innerHTML='<div class="alert alert-danger"  > <button type="button" class="close" data-dismiss="alert" aria-hidden="true">× </button>'
                    +'<h4 class="text-white" id="feature-name">'+dep+'</h4> <p style="font-weight: bold"> Site : '+nompar+'('+codep+')</p><p> Plantation de  : '+typep+'(' + variete +') a une superficie : '+superficie
                    +'</p> <p> Appartient à '+ nomp +'</p> </div>';
                popup.setPosition(clickedCoordinate);
            }
        });
        /* const clickedCoordinate = e.coordinate;
         popup.setPosition(undefined);
         popup.setPosition(clickedCoordinate);
         popupContainerElement.innerHTML = clickedCoordinate;*/
    });
})();
