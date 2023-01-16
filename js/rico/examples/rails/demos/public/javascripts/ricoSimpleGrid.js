/**
  *  (c) 2005-2007 Richard Cowin (http://openrico.org)
  *  (c) 2005-2007 Matt Brown (http://dowdybrown.com)
  *
  *  Rico is licensed under the Apache License, Version 2.0 (the "License"); you may not use this
  *  file except in compliance with the License. You may obtain a copy of the License at
  *   http://www.apache.org/licenses/LICENSE-2.0
  **/


if(typeof Rico=='undefined') throw("SimpleGrid requires the Rico JavaScript framework");
if(typeof RicoUtil=='undefined') throw("SimpleGrid requires the RicoUtil Library");
if(typeof RicoTranslate=='undefined') throw("SimpleGrid requires the RicoTranslate Library");

Rico.SimpleGrid = Class.create();

Rico.SimpleGrid.prototype = {

  initialize: function( tableId, menu, options ) {
    Object.extend(this, new Rico.GridCommon);
    this.baseInit(tableId);
    Rico.setDebugArea(tableId+"_debugmsgs");    // if used, this should be a textarea
    Object.extend(this.options, options || {});
    this.tableId = tableId;
    this.createDivs();
    this.hdrTabs=new Array(2);
    for (var i=0; i<2; i++) {
      this.tabs[i]=$(tableId+'_tab'+i);
      this.hdrTabs[i]=$(tableId+'_tab'+i+'h');
      if (i==0) this.tabs[i].style.position='absolute';
      if (i==0) this.tabs[i].style.left='0px';
      this.hdrTabs[i].style.position='absolute';
      this.hdrTabs[i].style.top='0px';
      this.hdrTabs[i].style.zIndex=1;
      this.thead[i]=this.hdrTabs[i];
      this.tbody[i]=this.tabs[i];
      this.headerColCnt = this.getColumnInfo(this.hdrTabs[i].rows);
      if (i==0) this.options.frozenColumns=this.headerColCnt;
    }
    if (this.headerColCnt==0) {
      alert('ERROR: no columns found in "'+this.tableId+'"');
      return;
    }
    this.hdrHt=Math.max(RicoUtil.nan2zero(this.hdrTabs[0].offsetHeight),this.hdrTabs[1].offsetHeight);
    for (var i=0; i<2; i++)
      if (i==0) this.tabs[i].style.top=this.hdrHt+'px';
    this.createColumnArray();
    this.pageSize=this.columns[0].dataColDiv.childNodes.length;
    this.sizeDivs();
    if (menu) this.attachMenuEvents(menu);
    this.scrollEventFunc=this.handleScroll.bindAsEventListener(this);
    this.pluginScroll();
    if (this.options.windowResize)
      Event.observe(window,"resize", this.sizeDivs.bindAsEventListener(this), false);
  },

  sizeDivs: function() {
    if (this.outerDiv.offsetParent.style.display=='none') return;
    this.baseSizeDivs();
    var maxHt=Math.max(this.options.maxHt || this.availHt(), 50);
    var totHt=Math.min(this.hdrHt+this.dataHt, maxHt);
    Rico.writeDebugMsg('sizeDivs '+this.tableId+': hdrHt='+this.hdrHt+' dataHt='+this.dataHt);
    this.dataHt=totHt-this.hdrHt;
    if (this.scrWi>0) this.dataHt+=this.options.scrollBarWidth;
    this.scrollDiv.style.height=this.dataHt+'px';
    var divAdjust=2;
    this.innerDiv.style.width=(this.scrWi-this.options.scrollBarWidth+divAdjust)+'px';
    this.innerDiv.style.height=this.hdrHt+'px';
    totHt+=divAdjust;
    this.resizeDiv.style.height=this.frozenTabs.style.height=totHt+'px';
    this.outerDiv.style.height=(totHt+this.options.scrollBarWidth)+'px';
    this.setHorizontalScroll();
  }

};

Object.extend(Rico.TableColumn.prototype, {

initialize: function(grid,colIdx,hdrInfo,tabIdx) {
  this.baseInit(grid,colIdx,hdrInfo,tabIdx);
}

});

Rico.includeLoaded('ricoSimpleGrid.js');
