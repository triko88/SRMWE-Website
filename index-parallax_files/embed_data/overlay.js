google.maps.__gjsload__('overlay', function(_){var gu=_.oa("j"),hu=_.l(),iu=function(a){a.ag=a.ag||new hu;return a.ag},ju=function(a){this.T=new _.fg(function(){var b=a.ag;if(a.getPanes()){if(a.getProjection()){if(!b.j&&a.onAdd)a.onAdd();b.j=!0;a.draw()}}else{if(b.j)if(a.onRemove)a.onRemove();else a.remove();b.j=!1}},0)},ku=function(a,b){function c(){return _.gg(e.T)}var d=iu(a),e=d.Ge;e||(e=d.Ge=new ju(a));_.C(d.V||[],_.R.removeListener);var f=d.ca=d.ca||new _.wl,g=b.__gm;f.bindTo("zoom",g);f.bindTo("offset",g);f.bindTo("center",g,"projectionCenterQ");
f.bindTo("projection",b);f.bindTo("projectionTopLeft",g);f=d.Yh=d.Yh||new gu(f);f.bindTo("zoom",g);f.bindTo("offset",g);f.bindTo("projection",b);f.bindTo("projectionTopLeft",g);a.bindTo("projection",f,"outProjection");a.bindTo("panes",g);d.V=[_.R.addListener(a,"panes_changed",c),_.R.addListener(g,"zoom_changed",c),_.R.addListener(g,"offset_changed",c),_.R.addListener(b,"projection_changed",c),_.R.addListener(g,"projectioncenterq_changed",c)];c();b instanceof _.ce&&(_.Mm(b,"Ox"),_.Om("Ox","-p",a))},
nu=function(a){if(a){var b=a.getMap(),c=a.__gmop;if(c){if(c.map==b)return;a.__gmop=null;c.ig()}if(b&&b instanceof _.ce){var d=b.__gm;d.overlayLayer?a.__gmop=new lu(b,a,d.overlayLayer):d.j.then(function(c){c=c.ya;var e=new mu(b,c);c.qa(e);d.overlayLayer=e;nu(a)})}}},lu=function(a,b,c){this.map=a;this.ma=b;this.lm=c;this.ue=!1;_.Mm(this.map,"Ox");_.Om("Ox","-p",this.ma);c.l.push(this);c.j&&ou(this,c.j);c.m.Sf()},ou=function(a,b){a.ma.get("projection")!=b&&(a.ma.bindTo("panes",a.map.__gm),a.ma.set("projection",
b))},mu=function(a,b){this.A=a;this.m=b;this.j=null;this.l=[]};_.A(gu,_.S);gu.prototype.changed=function(a){"outProjection"!=a&&(a=!!(this.get("offset")&&this.get("projectionTopLeft")&&this.get("projection")&&_.L(this.get("zoom"))),a==!this.get("outProjection")&&this.set("outProjection",a?this.j:null))};_.A(ju,_.S);lu.prototype.draw=function(){this.ue||(this.ue=!0,this.ma.onAdd&&this.ma.onAdd());this.ma.draw&&this.ma.draw()};lu.prototype.ig=function(){_.Pm("Ox","-p",this.ma);this.ma.unbindAll();this.ma.set("panes",null);this.ma.set("projection",null);_.bb(this.lm.l,this);this.ue&&(this.ue=!1,this.ma.onRemove?this.ma.onRemove():this.ma.remove())};mu.prototype.dispose=_.l();
mu.prototype.Db=function(a,b,c,d,e,f){var g=this.j=this.j||new _.bm(this.A,this.m,_.l());g.Db(a,b,c,d,e,f);a=_.ua(this.l);for(b=a.next();!b.done;b=a.next())b=b.value,ou(b,g),b.draw()};_.He("overlay",{Ng:function(a){if(a){var b=a.getMap();if(b&&b instanceof _.ce||a.__gmop)nu(a);else{b=a.getMap();var c=iu(a),d=c.El;c.El=b;d&&(c=iu(a),(d=c.ca)&&d.unbindAll(),(d=c.Yh)&&d.unbindAll(),a.unbindAll(),a.set("panes",null),a.set("projection",null),_.C(c.V,_.R.removeListener),c.V=null,c.Ge&&(c.Ge.T.Ma(),c.Ge=null),_.Pm("Ox","-p",a));b&&ku(a,b)}}},preventMapHitsFrom:function(a){_.En(a,{gb:function(a){return _.Wm(a.event)},Ia:function(a){return _.Tm(a)},$b:function(a){return _.Um(a)},Ua:function(a){return _.Um(a)},
Ka:function(a){return _.Vm(a)}}).Bc(!0)},preventMapHitsAndGesturesFrom:function(a){a.addEventListener("click",_.qd);a.addEventListener("contextmenu",_.qd);a.addEventListener("dblclick",_.qd);a.addEventListener("mousedown",_.qd);a.addEventListener("mousemove",_.qd);a.addEventListener("MSPointerDown",_.qd);a.addEventListener("pointerdown",_.qd);a.addEventListener("touchstart",_.qd);a.addEventListener("wheel",_.qd)}});});
