
/// accueil
var boutonAccueil= document.createElement('button');
boutonAccueil.innerHTML='<img src="icon/home.png" style="width:20px;height:20px; filter:brightness(0)"> ';
boutonAccueil.className='accueilbtn';

var homeElement = document.createElement('div');
homeElement.className='homebutton';
homeElement.appendChild(boutonAccueil);


var accueilControl = new ol.control.Control({
    element : homeElement
});
boutonAccueil.addEventListener("click",function () {
    location.href= 'index.php';
});
map.addControl(accueilControl);
// fin bouton accueil

/// fullscreen
var fsbutton= document.createElement('button');
fsbutton.innerHTML='<img src="icon/fullscreen.png" style="width:20px;height:20px; filter:brightness(0)"> ';
fsbutton.className='accueilbtn';

var fsElement = document.createElement('div');
fsElement.className='homebutton';
fsElement.appendChild(fsbutton);

var fsControl = new ol.control.Control({
    element : fsElement
});

fsbutton.addEventListener("click",function () {
    var mapEle = document.getElementById('map');
    if (mapEle.requestFullscreen) {
        mapEle.requestFullscreen();
    }else if(mapEle.msRequestFullscreen){
        mapEle.msRequestFullscreen();
    }else if(mapEle.mozRequestFullscreen()){
        mapEle.mozRequestFullscreen();
    }else if(mapEle.webkitRequestFullscreen){
        mapEle.webkitRequestFullscreen();
    }
});
map.addControl(fsControl);

/// information
var ffsbutton= document.createElement('button');
ffsbutton.innerHTML='<img src="icon/info.png" style="width:20px;height:20px; filter:brightness(0)"> ';
ffsbutton.className='accueilbtn';

var ffsElement = document.createElement('div');
ffsElement.className='homebutton';
ffsElement.appendChild(ffsbutton);

var ffsControl = new ol.control.Control({
    element : ffsElement
});
var finfoFlag = false;
ffsbutton.addEventListener("click",function () {
    ffsbutton.classList.toggle('clicked');
    finfoFlag=!finfoFlag;
});

map.addControl(ffsControl);

// outils de mesure

var mesurebutton= document.createElement('button');
mesurebutton.innerHTML='<img src="icon/mesure.png" style="width:20px;height:20px; filter:brightness(0)"> ';
mesurebutton.className='accueilbtn';
mesurebutton.id='homebutton';

var mesureElement = document.createElement('div');
mesureElement.className='homebutton';
mesureElement.appendChild(mesurebutton);

var mesureControl = new ol.control.Control({
    element : mesureElement
});
var mesureFlag = false;
mesurebutton.addEventListener("click",function () {
    mesurebutton.classList.toggle('clicked');
    mesureFlag=!mesureFlag;
    document.getElementById('map').style.cursor='default';
    if(mesureFlag){
        map.removeInteraction(draw);
        addinteraction('LineString');
    }else{
        map.removeInteraction(draw);
        sources.clear();
        const elements = document.getElementsByClassName('ol-tooltip ol-tooltip-static');
        while(elements.length>0) elements[0].remove();
    }
});

map.addControl(mesureControl);

var areaButton= document.createElement('button');
areaButton.innerHTML='<img src="icon/polygo.png" style="width:20px;height:20px; filter:brightness(0)"> ';
areaButton.className='accueilbtn';
areaButton.id='homebutton';

var areaElement = document.createElement('div');
areaElement.className='homebutton';
areaElement.appendChild(areaButton);

var areaControl = new ol.control.Control({
    element : areaElement
});
var areaFlag = false;
areaButton.addEventListener("click",function () {
    areaButton.classList.toggle('clicked');
    areaFlag=!areaFlag;
    document.getElementById('map').style.cursor='default';
    if(areaFlag){
        map.removeInteraction(draw);
        addinteraction('Polygon');
    }else{
        map.removeInteraction(draw);
        sources.clear();
        const elements = document.getElementsByClassName('ol-tooltip ol-tooltip-static');
        while(elements.length>0) elements[0].remove();
    }
});

map.addControl(areaControl);


/**
 @type {string}
 */
var poligonDraw = 'Cliquer pour continuer, Double-Cliquer pour terminer';
var lineDraw = 'Cliquer pour continuer, Double-Cliquer pour terminer';
var draw;

var sources =new ol.source.Vector();
var vector = new ol.layer.Vector({
    source :sources,
    style: new ol.style.Style({
        fill: new ol.style.Fill({
            color:'rgba(255,255,255,0.2)'
        }),
        stroke : new ol.style.Stroke({
            color:'#ffcc33',
            width:2
        })
    })
});
map.addLayer(vector);
function addinteraction(intType) {

    draw=new ol.interaction.Draw({
        source:sources,
        type: intType,
        style:new ol.style.Style({
            fill: new ol.style.Fill({
                color:'rgba(200,200,200,0.6)'
            }),
            stroke : new ol.style.Stroke({
                color:'rgba(0,0,0,0.5)',
                lineDash:[10,10],
                width:2
            })
        })
    });
    map.addInteraction(draw);
    createMeasureTooltip();
    createHelpTooltip();

    var sketch;
    var pointerMoveHandler= function (evt) {
        if(evt.dragging){
            return;
        }
        var helpMsg = 'Cliquer pour commencer';
        if (sketch){
            var geom = sketch.getGeometry();
        }
    };
    map.on('pointermove',pointerMoveHandler);
    draw.on('drawstart', function (evt) {
        sketch = evt.feature;
        var tooltipCoord = evt.coordinate;
        sketch.getGeometry().on('change',function (evt) {
            var geom = evt.target;
            var output;

            if (geom instanceof ol.geom.Polygon){
                output = formatArea(geom);
                tooltipCoord = geom.getInteriorPoint().getCoordinates();
            } else if(geom instanceof  ol.geom.LineString){
                output = formatLength(geom);
                tooltipCoord = geom.getLastCoordinate();
            }
            measureTooltipElement.innerHTML=output;
            measureTooltip.setPosition(tooltipCoord);
        });
    });

    draw.on('drawend',function () {
        measureTooltipElement.className='ol-tooltip ol-tooltip-static';
        measureTooltip.setOffset([0,-7]);
        sketch=null;
        measureTooltipElement=null;
        createMeasureTooltip();

    });
}

var helpTooltipElement;
var helptooltip;
function createHelpTooltip() {
    if(helpTooltipElement){
        helpTooltipElement.parentNode.removeChild(helpTooltipElement);
    }
    helpTooltipElement=document.createElement('div');
    helpTooltipElement.className='ol-tooltip hidden';
    helptooltip= new ol.Overlay({
        element:helpTooltipElement,
        offset:[15,0],
        positioning:'center-left'
    });
    map.addOverlay(helptooltip);
}
map.getViewport().addEventListener('mouseout', function () {
    // helpTooltipElement.classList.add('hidden');

});
var measureTooltipElement;
var measureTooltip;
function createMeasureTooltip() {

    if(measureTooltipElement){
        measureTooltipElement.parentNode.removeChild(measureTooltipElement);
    }
    measureTooltipElement=document.createElement('div');
    measureTooltipElement.className='ol-tooltip ol-tooltip-measure';
    measureTooltip= new ol.Overlay({
        element:measureTooltipElement,
        offset:[0,-15],
        positioning:'bottom-center'
    });
    map.addOverlay(measureTooltip);
}

var formatLength = function (line) {
    var length = ol.sphere.getLength(line);
    var output;
    if(length>100){
        output = Math.round((length/1000)*100)/100+' '+'Km';
    }else{
        output = Math.round(length*100)/100+' '+'m';
    }
    return output;
};

/// calcul superficie

var formatArea = function (polygon) {
    var area = ol.sphere.getLength(polygon);
    var output;
    if(area>10000){
        output = Math.round((area/1000000)*100)/100+' '+'Km<sup>2</sup>';
    }else{
        output = Math.round(area*100)/100+' '+'m<sup>2</sup>';
    }
    return output;
};

