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
             src: 'data/icon.png'
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


 var lg =   overlayGroup.getLayers().push(
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

    var maison = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: 'data/maison.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Parc ou reserve',
        style: stylem
    });
    overlayGroup.getLayers().push(maison);
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
    );*/

    maison.getSource().on('addfeature', function () {
        map.getView().fit(
            maison.getSource().getExtent(),
            {
                duration: 1590,
                size: map.getSize(),
                maxZoom: 21
            }
        );
    });
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
})();
