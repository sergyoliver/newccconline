var map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Group({
            title: 'Base maps',
            fold: 'open',
            layers: [
                new ol.layer.Group({
                    title: 'Water color with labels',
                    type: 'base',
                    combine: true,
                    visible: false,
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.Stamen({
                                layer: 'watercolor'
                            })
                        }),
                        new ol.layer.Tile({
                            source: new ol.source.Stamen({
                                layer: 'terrain-labels'
                            })
                        })
                    ]
                }),
                new ol.layer.Tile({
                    title: 'Water color',
                    type: 'base',
                    visible: false,
                    source: new ol.source.Stamen({
                        layer: 'watercolor'
                    })
                }),
                new ol.layer.Tile({
                    title: 'Bing Map',
                    type: 'base',
                    visible: false,
                    source: new ol.source.BingMaps({
                        key:"ApEfFvagPjoPJoz54DnQXtH6NlEjCgDWX6nfUroWYMxZO3YmyVuBgZINKqmh6bG_",
                        imagerySet:'AerialWithLabels'
                    })
                }),
                new ol.layer.Tile({
                    title: 'OSM',
                    type: 'base',
                    visible: true,
                    source: new ol.source.OSM()
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
    }),
    controls:[]
});