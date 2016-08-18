// JavaScript Document

function adminCE(idseccion){

	if (document.getElementById("hisection").value!='STATIC'){

		document.getElementById("hisection").value='STATIC';

		document.getElementById("prmsection").value=idseccion;

		document.getElementById("frmgral").action="admin.seccion.estatica.php";

		document.getElementById("frmgral").submit();

	}else{

		document.getElementById("ifcontenido").src="admin.static.section.php?id="+idseccion+"&opc=UPD";

	}

}



function adminA(idseccion,idtab){

	if (document.getElementById("hisection").value!='STATIC'){

		document.getElementById("hisection").value='STATIC';

		document.getElementById("prmsection").value=idtab;

      document.getElementById("id_seccion").value=idseccion;

		document.getElementById("frmgral").action="admin.secciones.tabs.php";

		document.getElementById("frmgral").submit();

	}else{

		document.getElementById("ifcontenido").src="admin.section.php?id_seccion="+idseccion+"&id="+idtab+"&opc=UPD";

	}

}



function adminSI(idseccion){

	document.getElementById("hisection").value='INF';

	document.getElementById("prmsection").value=idseccion;

	document.getElementById("frmgral").action="admin.seccion.informativa.php";

	document.getElementById("frmgral").submit();

}



function adminTABS(idseccion){

	document.getElementById("hisection").value='INF';

	document.getElementById("prmsection").value='TABS';

   document.getElementById("id_seccion").value=idseccion;

	document.getElementById("frmgral").action="admin.seccion.informativa.php";

	document.getElementById("frmgral").submit();

}



function adminGA(idseccion){

	document.getElementById("hisection").value='INF';

	document.getElementById("prmsection").value=idseccion;

	document.getElementById("frmgral").action="admin.seccion.galeria.php";

	document.getElementById("frmgral").submit();

}





function adminSD(){

	document.getElementById("hisection").value='DIN';

	document.getElementById("frmgral").action="admin.seccion.dinamica.php";

	document.getElementById("frmgral").submit();

}



function adminADM(){

	document.getElementById("hisection").value='USR';

	document.getElementById("frmgral").action="admin.seccion.admusr.php";

	document.getElementById("frmgral").submit();

}



function adminSeccion(idseccion,valorseccion,linkto){

	document.getElementById("hisection").value=idseccion;

	document.getElementById("prmsection").value=valorseccion;

	document.getElementById("frmgral").action=linkto;

	document.getElementById("frmgral").submit();

}

String.prototype.endsWith = function(s) {

   var reg = new RegExp(s + "$");

   return reg.test(this);

}



String.prototype.startsWith = function(s) {

   var reg = new RegExp("^" + s);

   return reg.test(this);

}



String.prototype.replaceAll = function(from, to) {

   var str = this;

   while(str.indexOf(from)>=0) {

      str = str.replace(from, to);

   }

   return str;

}



String.prototype.trim = function() {

   return this.replace(/^\s+|\s+$/g,"");

}



Array.prototype.has = function(v){

   for (i=0; i<this.length; i++){

      if (this[i]==v) return true;

   }

   return false;

}

function url_valido(texto) {

   /*

   Caracteres válidos:

      #$%&  (35-38)

      -./   (45-47)

      0-9   (48-57)

      :     (58)

      =     (61)

      ?@    (63-64)

      A-Z   (65-90)

      _     (95)

      a-z   (97-122)

   */

   var ban = true;

   for (i=0; i<texto.length; i++) {

      if (texto.charCodeAt(i)<35 || (texto.charCodeAt(i)>38 && texto.charCodeAt(i)<45) || (texto.charCodeAt(i)>58 && texto.charCodeAt(i)<61) || texto.charCodeAt(i)==62 || (texto.charCodeAt(i)>90 && texto.charCodeAt(i)<95) || texto.charCodeAt(i)==96 || texto.charCodeAt(i)>122) ban = false;

   }

   return ban;

}

/* Banners */



/*

Copyright (c) Copyright (c) 2007, Carl S. Yestrau All rights reserved.

Code licensed under the BSD License: http://www.featureblend.com/license.txt

Version: 1.0.3

*/

var FlashDetect=new function(){var self=this;self["installed"]=false;self["raw"]="";self["major"]=-1;self["minor"]=-1;self["revision"]=-1;self["revisionStr"]="";var activeXDetectRules=[{"name":"ShockwaveFlash.ShockwaveFlash.7","version":function(obj){return getActiveXVersion(obj);}},{"name":"ShockwaveFlash.ShockwaveFlash.6","version":function(obj){var version="6,0,21";try{obj["AllowScriptAccess"]="always";version=getActiveXVersion(obj);}catch(err){};return version;}},{"name":"ShockwaveFlash.ShockwaveFlash","version":function(obj){return getActiveXVersion(obj);}}];var getActiveXVersion=function(activeXObj){var version=-1;try{version=activeXObj.GetVariable("$version");}catch(err){};return version;};var getActiveXObject=function(name){var obj=-1;try{obj=new ActiveXObject(name);}catch(err){};return obj;};var parseActiveXVersion=function(str){var versionArray=str["split"](",");return {"raw":str,"major":parseInt(versionArray[0]["split"](" ")[1],10),"minor":parseInt(versionArray[1],10),"revision":parseInt(versionArray[2],10),"revisionStr":versionArray[2]};};var parseStandardVersion=function(str){var descParts=str["split"](/ +/);var majorMinor=descParts[2]["split"](/\./);var revisionStr=descParts[3];return {"raw":str,"major":parseInt(majorMinor[0],10),"minor":parseInt(majorMinor[1],10),"revisionStr":revisionStr,"revision":parseRevisionStrToInt(revisionStr)};};var parseRevisionStrToInt=function(str){return parseInt(str["replace"](/[a-zA-Z]/g,""),10)||self["revision"];};self["majorAtLeast"]=function(version){return self["major"]>=version;};self["FlashDetect"]=function(){if(navigator["plugins"]&&navigator["plugins"]["length"]>0){var type="application/x-shockwave-flash";var mimeTypes=navigator["mimeTypes"];if(mimeTypes&&mimeTypes[type]&&mimeTypes[type]["enabledPlugin"]&&mimeTypes[type]["enabledPlugin"]["description"]){var version=mimeTypes[type]["enabledPlugin"]["description"];var versionObj=parseStandardVersion(version);self["raw"]=versionObj["raw"];self["major"]=versionObj["major"];self["minor"]=versionObj["minor"];self["revisionStr"]=versionObj["revisionStr"];self["revision"]=versionObj["revision"];self["installed"]=true;};}else{if(navigator["appVersion"]["indexOf"]("Mac")==-1&&window["execScript"]){var version=-1;for(var i=0;i<activeXDetectRules["length"]&&version==-1;i++){var obj=getActiveXObject(activeXDetectRules[i]["name"]);if(typeof obj=="object"){self["installed"]=true;version=activeXDetectRules[i]["version"](obj);if(version!=-1){var versionObj=parseActiveXVersion(version);self["raw"]=versionObj["raw"];self["major"]=versionObj["major"];self["minor"]=versionObj["minor"];self["revision"]=versionObj["revision"];self["revisionStr"]=versionObj["revisionStr"];};};};};};}();};FlashDetect["release"]="1.0.3";



var showFlash = FlashDetect.installed;



function banner(swf,w,h,img,texto,liga) {

   liga = liga || {};

   liga.href = liga.href || "";

   liga.target = liga.target || "_self";

   liga.width = liga.width || 0;

   liga.height = liga.height || 0;

   liga.params = liga.params || "";

   var a = "";

   var _a = "";

   if (liga.href!="") {

      a = "<a href=\""+liga.href+"\"";

      if (liga.target=="_self" || liga.target=="_blank") a = a+" target=\""+liga.target+"\"";

      else {

         liga.target = "popup(this.href,'',"+liga.width+","+liga.height+",'"+liga.params+"');";

         a = a+" onClick=\""+liga.target+"return false;\"";

      }

      a = a + ">";

      _a = "</a>";

   }

   var str = "";

   var noFlash = "";

   if (img!="") noFlash = a+"<img src='"+img+"' width="+w+" height="+h+" alt='"+texto+"' title='"+texto+"' border=0>"+_a;

   else {

      noFlash = noFlash + "<div style='text-align:center;width:"+w+"px;background-color:#FFFFFF;padding:0px;border:1px solid #808080;'>";

      noFlash = noFlash + "<table cellpadding=5 cellspacing=0 style='width:"+w+"px;height:"+h+"px;'><tr><td align=center>";

      noFlash = noFlash + a+texto+_a;

      noFlash = noFlash + "<p><a href='http://www.macromedia.com/go/getflashplayer' target='_blank'>Descargar Flash Viewer</a></p>";

      noFlash = noFlash + "</td></tr></table>";

      noFlash = noFlash + "</div>";

   }

   if (showFlash) {

      str = str + "<div style='position:relative;width:"+w+"px;height:"+h+"px;'>";

      str = str + "<div style='position:absolute;top:0px;left:0px;z-index:1;'>"+a+"<img src='http://www.yucatan.gob.mx/images/1.gif' alt='"+texto+"' title='"+texto+"' width="+w+" height="+h+" border=0>"+_a+"</div>";

      str = str + "<div><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width="+w+" height="+h+">";

      str = str + "<param name='movie' value='"+swf+"'>";

      str = str + "<param name='quality' value='high'>";

      str = str + "<param name='wmode' value='transparent'>";

      str = str + "<embed src='"+swf+"' width="+w+" height="+h+" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent'></embed></object></div>";

      str = str + "</div>";

   } else str = noFlash;

   return str;

}



function insertSWF(swf,w,h,html) {

   var str = "";

   var noFlash = "";

   noFlash = noFlash + "<div style='text-align:center;width:"+w+";background-color:#FFFFFF;padding:0px;border:1px solid #808080;'>";

   noFlash = noFlash + "<table cellpadding=5 cellspacing=0 style='width:"+w+"px;height:"+h+"px;'><tr><td align=center>";

   noFlash = noFlash + html;

   noFlash = noFlash + "<p><a href='http://www.macromedia.com/go/getflashplayer' target='_blank'>Descargar Flash Viewer</a></p>";

   noFlash = noFlash + "</td></tr></table>";

   noFlash = noFlash + "</div>";

   if (showFlash) {

      str = str + "<div><object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0' width="+w+" height="+h+">";

      str = str + "<param name='movie' value='"+swf+"'>";

      str = str + "<param name='quality' value='high'>";

      str = str + "<param name='wmode' value='transparent'>";

      str = str + "<embed src='"+swf+"' width="+w+" height="+h+" quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent'></embed></object></div>";

   } else str = noFlash;

   return str;

}



function popup(URL,winName,w,h,features) {

   var x = (screen.width-w)/2;

   var y = (screen.height-h)/2;

   features = "top="+y+",left="+x+",width="+w+",height="+h+","+features;

   pop = window.open(URL,winName,features);

   return pop;

}



function subir(forma,num) {

   var ant = document.getElementById("td_"+(num-1));

   var act = document.getElementById("td_"+num);

   var temp = ant.innerHTML;

   ant.innerHTML = act.innerHTML;

   act.innerHTML = temp;

   var temp1 = forma.orden[num-1].value;

   forma.orden[num-1].value = forma.orden[num].value;

   forma.orden[num].value = temp1;

}



function bajar(forma,num) {

   var act = document.getElementById("td_"+num);

   var sig = document.getElementById("td_"+(num+1));

   var temp = act.innerHTML;

   act.innerHTML = sig.innerHTML;

   sig.innerHTML = temp;

   var temp1 = forma.orden[num].value;

   forma.orden[num].value = forma.orden[num+1].value;

   forma.orden[num+1].value = temp1;

}

function subir2(forma,num) {

   var ant = document.getElementById("tdd_"+(num-1));

   var act = document.getElementById("tdd_"+num);

   var temp = ant.innerHTML;

   ant.innerHTML = act.innerHTML;

   act.innerHTML = temp;

   var temp1 = forma.orden[num-1].value;

   forma.orden[num-1].value = forma.orden[num].value;

   forma.orden[num].value = temp1;

}



function bajar2(forma,num) {

   var act = document.getElementById("tdd_"+num);

   var sig = document.getElementById("tdd_"+(num+1));

   var temp = act.innerHTML;

   act.innerHTML = sig.innerHTML;

   sig.innerHTML = temp;

   var temp1 = forma.orden[num].value;

   forma.orden[num].value = forma.orden[num+1].value;

   forma.orden[num+1].value = temp1;

}



function scrollDiv(id,total,pageSize) {

   this.id_ = document.getElementById(id);

   this.width = this.id_.scrollWidth;

   this.height = this.id_.scrollHeight;

   this.x = (document.defaultView && document.defaultView.getComputedStyle) ?

             document.defaultView.getComputedStyle(this.id_,'').getPropertyValue("left") :

             this.id_.currentStyle ? this.id_.currentStyle.left : "";

   this.y = (document.defaultView && document.defaultView.getComputedStyle) ?

             document.defaultView.getComputedStyle(this.id_,'').getPropertyValue("top") :

             this.id_.currentStyle ? this.id_.currentStyle.top : "";

   this.x = parseInt(this.x);

   this.y = parseInt(this.y);

   this.numPags = 0;

   this.pag = 1;

   this.limit = 0;

   this.contenedor = document.getElementById(id+"_contenedor");

   if (this.contenedor) {

      this.cont_width = this.contenedor.clientWidth;

      this.cont_height = this.contenedor.clientHeight;

      this.numPags = Math.ceil(this.width/this.cont_width);

      this.limit = this.cont_width-this.width;

      if (this.limit>0) this.limit = 0;

   }

   // < 1/5 >

   this.paginador = document.getElementById(id+"_paginador");

   var startNo = 1;

   var endNo = total;

   if(pageSize>total) pageSize=total;

   if (this.paginador) {

      endNo = this.pag*pageSize;

      if (endNo>total) endNo = total;

      startNo = endNo-pageSize+1;

      this.paginador.innerHTML = startNo+"-"+endNo+" / "+total;

   }

   // <<

   this.btn_ini = document.getElementById(id+"_ini");

   if (this.btn_ini) {

      this.btn_ini.onclick = function() {eval(id+".inicio();")};

   }

   // >>

   this.btn_fin = document.getElementById(id+"_fin");

   if (this.btn_fin) {

      this.btn_fin.onclick = function() {eval(id+".fin();")};

   }

   // <

   this.btn_rew = document.getElementById(id+"_rew");

   if (this.btn_rew) {

      this.btn_rew.onclick = function() {eval(id+".anterior();")};

   }

   // >

   this.btn_fwd = document.getElementById(id+"_fwd");

   if (this.btn_fwd) {

      this.btn_fwd.onclick = function() {eval(id+".siguiente();")};

   }

   this.anterior = function() {

      if (this.pag>1) this.pag--;

      this.ir(this.pag);

   }

   this.siguiente = function() {

      if (this.pag<this.numPags) this.pag++;

      this.ir(this.pag);

   }

   this.inicio = function() {

      if (this.pag>1) {

         this.pag = 1;

         this.ir(this.pag);

      }

   }

   this.fin = function() {

      if (this.pag<this.numPags) {

         this.pag = this.numPags;

         this.ir(this.pag);

      }

   }

   this.ir = function(pag) {

      px = 0-((pag-1)*this.cont_width);

      this.x = px>=this.limit ? px : this.limit;

      this.id_.style.left = this.x+"px";

      if (this.paginador) {

         endNo = pag*pageSize;

         if (endNo>total) endNo = total;

         startNo = endNo-pageSize+1;

         this.paginador.innerHTML = startNo+"-"+endNo+" / "+total;

      }

   }

}

function fecha_valida(myDayStr, myMonthStr, myYearStr) {

   myMonthStr = myMonthStr - 1;

   var myDate = new Date();

   myDate.setFullYear(myYearStr, myMonthStr, myDayStr);

   if (myDate.getMonth()!=myMonthStr) return false;

   else return true;

}



function esEntero(s) {

   var i = 0;

   var ban = true;

   for (i=0; i<s.length; i++) if (s.charCodeAt(i)<48 || s.charCodeAt(i)>57) ban = false;

   return ban;

}

function get2post(action, query) {

   if (query===undefined) query = "";

   if (query=="") {

      pos = action.indexOf('?');

      if (pos>=0) {

         query = action.substring(pos+1);

         action = action.substring(0,pos);

      }

   }

   query = query.replaceAll('?','');

   var name_ = "";

   var value_ = "";

   f = document.createElement('form');

   f.setAttribute('method','post');

   f.setAttribute('action',action);

   var params = query.split('&');

   for (i=0;i<params.length;i++) {

      pos = params[i].indexOf('=');

      if (pos>=0) {

         name_ = params[i].substring(0,pos);

         value_ = params[i].substring(pos+1);

      } else {

         name_ = params[i];

         value_ = "";

      }

      v = document.createElement('input');

      v.setAttribute('type','hidden');

      v.setAttribute('name',name_);

      v.setAttribute('value',value_);

      f.appendChild(v);

     }

   document.body.appendChild(f);

   f.submit();

}

