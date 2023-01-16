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
        minZoom: 4
    }),

    target: 'js-map',
    controls: ol.control.defaults({attribution: false}).extend([attributionControl])
  });
    const fillStyle = new ol.style.Fill({
        color: "#145128"
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



    const openstreetmap = new ol.layer.Tile({
        source: new ol.source.OSM(),
        visible: true,
        title: 'OSM'
    });
    const circleStyle = new ol.style.Circle({
        fill: new ol.style.Fill({
            color: "#145128"
        }),
        radius: 7,
        stroke: strokeStyle
    });
    const dataparcelle = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/parcellecoop.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Parcelles ',
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
    const parc = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/parc.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'Parc ou reserve',
        style: styleparc
    });
    const km2 = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/2km.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'buffer 2km',
        style: style2km
    });
    const km5 = new ol.layer.Vector({
        source: new  ol.source.Vector({
            url: '../data/5km.php',
            format: new ol.format.GeoJSON()
        }),
        visible: true,
        title: 'buffer 5km',
        style: style5km
    });
    // Base Layer Group
    const baseLayerGroup = new ol.layer.Group({
        layers: [km5,km2,foret,parc,dataparcelle]
    });
    map.addLayer(baseLayerGroup);

    // switcher
// Create a LayerSwitcher instance and add it to the map
    var layerSwitcher = new ol.control.LayerSwitcher({
        activationMode:'click',
        startActive:false,
        groupSelectStyle:'children'
    });
    map.addControl(layerSwitcher);
   /// interraction click




}

