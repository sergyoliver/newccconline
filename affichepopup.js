/**
 * Created by PC-ALERTEFONCIER on 09/09/2022.
 */


// popup
var container = document.getElementById('popup');
var content = document.getElementById('popup-content');
var closer = document.getElementById('popup-closer');

var popup = new ol.Overlay({
    element:container,
    autoPan:true,
    autoPanAnimation:{
        duration:250
    }
});
map.addOverlay(popup);

closer.onclick=function () {
    popup.setPosition(undefined);
    closer.blur();
    return false;
};
var select2 = new ol.interaction.Select({
    layers: [parc],
    condition:ol.events.condition.pointermove
});
map.on('singleclick', function (evt) {
    //  console.log('je suis');
    if (finfoFlag){

        content.innerHTML='';
        var view = map.getView();
        var resolution =  view.getResolution();
        /* var url = parc.getSource().getFeatureInfoUrl(evt.coordinate,resolution,'EPSG:3857',{
         'INFO_FORMAT':'application/json',
         'propertyName':'libparc,typeparc'
         });*/
        map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
            var  clickedCoordinate = evt.coordinate;
            var remarque = feature.get('typeparc');
            var solution1 = feature.get('libparc');

            if (remarque) {


                content.innerHTML = '<h3> Catégorie: </h3><p>' +remarque.toUpperCase() + '</p><br><h3>Description: </h3><p>' + solution1.toUpperCase() + '</p>';
                popup.setPosition(clickedCoordinate);

            } else {
                popup.setPosition(undefined);
            }
        })

    }


});

// add zoom
var zoomInInteraction = new ol.interaction.DragBox();
zoomInInteraction.on('boxend',function () {
    var zominExtent = zoomInInteraction.getGeometry().getExtent();
    map.getView().fit(zominExtent);
});
var zin =  document.createElement('button');
zin.innerHTML='<img src="icon/zoomin.png" style="width:20px;height:20px; filter:brightness(0)"> ';
zin.className='accueilbtn';
zin.id='homebuttoni';

var zinElement = document.createElement('div');
zinElement.className='homebutton';
zinElement.appendChild(zin);

var zinControl = new ol.control.Control({
    element : zinElement
});
var zinFlag = false;
zin.addEventListener("click",function () {
    zin.classList.toggle('clicked');
    zinFlag=!zinFlag;

    if(zinFlag){
        document.getElementById('map').style.cursor='zoom-in';
        map.addInteraction(zoomInInteraction);

    }else{
        map.removeInteraction(zoomInInteraction);
        document.getElementById('map').style.cursor='default';
    }
});

map.addControl(zinControl);

// zoom out
var zoomoutInteraction = new ol.interaction.DragBox();
zoomoutInteraction.on('boxend',function () {
    var zomoutExtent = zoomoutInteraction.getGeometry().getExtent();
    map.getView().setCenter(ol.extent.getCenter(zomoutExtent));
    map.setZoom(map.getView()-1);
});
var zout =  document.createElement('button');
zout.innerHTML='<img src="icon/zoomout.png" style="width:20px;height:20px; filter:brightness(0)"> ';
zout.className='accueilbtn';
zout.id='homebutton1';

var zoutElement = document.createElement('div');
zoutElement.className='homebutton';
zoutElement.appendChild(zout);

var zoutControl = new ol.control.Control({
    element : zoutElement
});
var zoutFlag = false;
zout.addEventListener("click",function () {
    zout.classList.toggle('clicked');
    zoutFlag=!zoutFlag;

    if(zoutFlag){
        document.getElementById('map').style.cursor='zoom-out';
        map.addInteraction(zoomoutInteraction);

    }else{
        map.removeInteraction(zoomoutInteraction);
        document.getElementById('map').style.cursor='default';
    }
});

map.addControl(zoutControl);

// map.addInteraction(select2);


/// gestion des requetes
var datadb =  document.createElement('button');
datadb.innerHTML='<img src="icon/datadb.png" style="width:20px;height:20px; filter:brightness(0)"> ';
datadb.className='accueilbtn';
datadb.id='homebuttoni';

var zinElement = document.createElement('div');
zinElement.className='homebutton';
zinElement.appendChild(zin);

var zinControl = new ol.control.Control({
    element : zinElement
});
var zinFlag = false;
zin.addEventListener("click",function () {
    zin.classList.toggle('clicked');
    zinFlag=!zinFlag;

    if(zinFlag){
        document.getElementById('map').style.cursor='zoom-in';
        map.addInteraction(zoomInInteraction);

    }else{
        map.removeInteraction(zoomInInteraction);
        document.getElementById('map').style.cursor='default';
    }
});

map.addControl(zinControl);