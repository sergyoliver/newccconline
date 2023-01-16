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
            color: "#fff2a3",
            width: 1
        }),
        stroke:new ol.style.Stroke({
            color: '#070606',
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
                    /*  new ol.layer.Tile({
                        title: 'Satellite',
                        type: 'base',
                        visible: true,
                        source: new ol.source.XYZ({
                            attributions: ['Powered by Esri',
                                'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'
                            ],
                            attributionsCollapsible: false,
                            url: 'https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                            maxZoom: 30
                        })
                    }) ,
                     */
                   new ol.layer.Tile({
                        title: 'Bing Map',
                        type: 'base',
                        visible: true,
                        source: new ol.source.BingMaps({
                            key:"ApEfFvagPjoPJoz54DnQXtH6NlEjCgDWX6nfUroWYMxZO3YmyVuBgZINKqmh6bG_",
                            imagerySet:'AerialWithLabels'
                        })
                    })
                ]
            }),
            overlayGroup
        ],
        view: new ol.View({
            center: ol.proj.transform([-5.5128996643988,5.2512035166745], 'EPSG:4326', 'EPSG:3857'),
            zoom: 7,
            maxZoom: 30,
            minZoom: 4
        })

    });


    /// personnaliser les boutons de controls

    var km2 = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: 'data/2km.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Buffer 2km',
        style: style2km
    });
    overlayGroup.getLayers().push(km2);

    var parc = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: 'data/parc.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Parc ou reserve',
        style: styleparc
    });
    overlayGroup.getLayers().push(parc);


/**/

// Create a LayerSwitcher instance and add it to the map


// Add a layer to a pre-existing ol.layer.Group after the LayerSwitcher has
// been added to the map. The layer will appear in the list the next time
// the LayerSwitcher is shown or LayerSwitcher#renderPanel is called.


 overlayGroup.getLayers().push(
        new ol.layer.Vector({
            source: new  ol.source.Vector({
                url: 'data/foret.php',
                format: new ol.format.GeoJSON()
            }),
            visible: true,
            title: 'Forêt Classées',
            style: styleforet
        })
    );


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



// affiche popup ici

    $("#ok2").click(function(){
        var c = $('#couche').val();
        var k = $('#km').val();

        var parcelle = new ol.layer.Vector({
            source: new ol.source.Vector({
                url: 'data/parcelle.php?p='+c+'&k='+k,
                format: new ol.format.GeoJSON()
            }),
            title: 'Parcelles',
            style: styleparcelle
        });
        parcelle.getSource().on('addfeature', function () {
            map.getView().fit(
                parcelle.getSource().getExtent(),
                {
                    duration: 1590,
                    size: map.getSize(),
                    maxZoom: 21
                }
            );
        });




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
            layers: [parcelle],
            condition:ol.events.condition.pointermove
        });
        map.on('pointermove', function(evt) {

            //overlayLayer.setPosition(undefined);
            map.forEachFeatureAtPixel(evt.pixel, function(feature, layer){

                //console.log(feature.get('nomag'));
                var  clickedCoordinate = evt.coordinate;

                var agent = feature.get('nomp');
                var section = feature.get('nomsection');
                var sup = feature.get('supp');
                var genre = feature.get('genre');
                // let clickedCoordinate = e.coordinate;
                // let clickedFeatureName = feature.get('name');
                //  let clickedFeatureAdditionInfo = feature.get('additionalinfo');
                if(agent) {
                    /**/

                    // overlayFeatureName.innerHTML = agent;
                    // overlayFeatureAdditionInfo.innerHTML = nomenr+' enregistré le : '+datecrea;
                    popupContainerElement.innerHTML='<div class="alert alert-warning"  > <button type="button" class="close" data-dismiss="alert" aria-hidden="true">× </button>'
                        +'<h4 class="text-white" id="feature-name">'+agent+'</h4> <p style="font-weight: bold"> Genre : '+genre+'</p><p> de la section : '+section+' a une superficie : '+sup +'</p> </div>';
                    popup.setPosition(clickedCoordinate);
                }
            });
            /* const clickedCoordinate = e.coordinate;
             popup.setPosition(undefined);
             popup.setPosition(clickedCoordinate);
             popupContainerElement.innerHTML = clickedCoordinate;*/
        });

        map.addLayer(parcelle);
        affichetablo(c,k);
    });
function affichetablo(c,k) {
    var xhr2;
    var form_data2 = new FormData();
    form_data2.append("c", c);
    form_data2.append("k", k);

    if (window.XMLHttpRequest) xhr2 = new XMLHttpRequest();
    else if (window.ActiveXObject) xhr2 = new ActiveXObject('Microsoft.XMLHTTP');
    xhr2.open('POST', "data/listeinfoparcelle.php", true);
    xhr2.send(form_data2);
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState == 4 && xhr2.status == 200) {

            document.getElementById("retour_table").innerHTML = this.responseText;
            $('#example2').DataTable( {
                "dom": "<'row'<'col-md-6 col-xs-12'l><'col-md-6 col-xs-12'f>r><'table-responsive't><'row'<'col-md-5 col-xs-12'i><'col-md-7 col-xs-12'p>>",
                "pagingType": "full_numbers"
            } );
        }
        if (xhr2.readyState == 4 && xhr2.status != 200) {
            alert("Error : returned status code " + xhr2.status);
        }
    }
}
    //var layerSwitcher = new ol.control.LayerSwitcher();
   // map.addControl(layerSwitcher);

