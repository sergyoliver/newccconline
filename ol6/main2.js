window.onload = init;
function init(){
    const map = new ol.Map({
        view: new ol.View({
            center: [-483051.7061619691,634264.1323247494],
            zoom: 3,
            maxZoom: 14,
            minZoom: 2,
            rotation: 0.5
        }),
        layers: [
            new ol.layer.Tile({
                source: new ol.source.OSM()
            })
        ],
        target: 'js-map',
        keyboardEventTarget: document
    })

    const popupContainerElement = document.getElementById('popup-coordinates');
    const popup = new ol.Overlay({
        element: popupContainerElement,
        positioning: 'top-right'
    })

    map.addOverlay(popup);

    map.on('click', function(e){
        const clickedCoordinate = e.coordinate;
        popup.setPosition(undefined);
        popup.setPosition(clickedCoordinate);
        popupContainerElement.innerHTML = clickedCoordinate;
    })

    // DragRotate Interaction
    const dragRotateInteraction = new ol.interaction.DragRotate({
        condition: ol.events.condition.altKeyOnly
    })
    map.addInteraction(dragRotateInteraction)

    // Draw Interaction
    const drawInteraction = new ol.interaction.Draw({
        type: 'Polygon',
        freehand: true
    })
    map.addInteraction(drawInteraction);

    drawInteraction.on('drawend', function(e){
        let parser = new ol.format.GeoJSON();
        let drawnFeatures = parser.writeFeatures([e.feature]);
        console.log(drawnFeatures);
    })
}


