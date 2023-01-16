var idd = $('#idd').val();
/**
 * Created by PC-ALERTEFONCIER on 30/08/2022.
 */
var x = $('#idx').val();
var y = $('#idy').val();
var stylep = new ol.style.Style({

    stroke: new ol.style.Stroke({
        color: '#f2252d',
        width: 2
    })
});
var partest = new ol.layer.Vector({
    source: new ol.source.Vector({
        renderMode: 'image',
        url: 'dataservitude/par.php?id='+idd,
format: new ol.format.GeoJSON()
}),
style:stylep

});



var rome = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat([x,y]))

});

rome.setStyle(new ol.style.Style({
    image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({

        crossOrigin: 'anonymous',
        src: 'src/dot2.png'
    }))
}));
var vectorSource = new ol.source.Vector({
    features: [rome]
});


var vectorLayer = new ol.layer.Vector({
    renderMode: 'image',
    source: vectorSource
});


var istanbul = ol.proj.fromLonLat([x,y]);
var view = new ol.View({
    center: istanbul,
    zoom: 14,
    minZoom: 13,
    maxZoom: 20
});

var map = new ol.Map({
    controls: ol.control.defaults().extend([
        // new ol.control.ScaleLine(),
        new ol.control.OverviewMap()

    ]),
    target: 'map',
    layers: [partest],
    loadTilesWhileAnimating: true,
    view: view
});
// layers: [mos,autre,hbt,vrd,pv],
//var scaleline2 =  new ol.control.ScaleLine({className: 'ol-scale-line', target: document.getElementById('scale-line')});
var scaleline = new ol.control.ScaleLine();
map.addControl(scaleline);


