function winPopup(id,w,h,titulo) {
   objBody = document.getElementsByTagName("body").item(0);
   this.objPopup = document.createElement("div");
   this.objPopup.setAttribute('id','popup_'+id);
   this.objPopup.style.display = 'none';
   this.objPopup.style.position = 'absolute';
   this.objPopup.style.top = '0';
   this.objPopup.style.left = '0';
   this.objPopup.style.height = 'auto';
   this.objPopup.style.zIndex = '1500';
   objBody.insertBefore(this.objPopup, objBody.firstChild);
   this.objPopup.innerHTML =  "<table width='"+(w+12)+"' border='0' align='center' cellpadding='1' cellspacing='0'><tr class='encabezado' style='background:#7B9E42; color:#ffffff;'>" + 
                              "<td style='border:1px solid #7B9E42;'><table width='98%' border='0' cellpadding='0' cellspacing='0' align='center'><tr class='encabezado'>" +
                              "<td><b><div id='titulo_"+id+"'>" + titulo + "</div></b></td>" +
                              "<td align='right'><span title='Cerrar' style='cursor:pointer;' onClick='"+id+".hide();'><b>X</b></span></td>" +
                              "</tr></table></td></tr>" +
                              "<tr class='encabezado'><td style='border:1px solid #7B9E42; background:#ffffff'><table width='"+(w+12)+"' border='0' align='center' cellpadding='5' cellspacing='0' bgcolor='#FFFFFF'><tr>" +
                              "<td align='center' height='"+h+"' id='cuerpo_"+id+"'></td>" +
                              "</tr></table></td>" +
                              "</tr></table>";
   this.objOverlay = document.getElementById("overlay");
   if(!this.objOverlay) {
      this.objOverlay = document.createElement("div");
      this.objOverlay.setAttribute('id','overlay');
      this.objOverlay.style.backgroundImage = 'url(imagen/overlay.png)';
      this.objOverlay.style.backgroundColor = 'transparent';
      this.objOverlay.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="imagen/overlay.png", sizingMethod="scale")';
      this.objOverlay.style.display = 'none';
      this.objOverlay.style.position = 'absolute';
      this.objOverlay.style.top = '0';
      this.objOverlay.style.left = '0';
      this.objOverlay.style.zIndex = '1250';
      this.objOverlay.style.width = '100%';
      objBody.insertBefore(this.objOverlay, objBody.firstChild);
   }
   this.h_ = 0;
   this.yScroll = 0;
   this.objFrame = null;
   this.w_th = 100;
   this.getPageScroll = function() {
      var yScroll;
      if (self.pageYOffset) yScroll = self.pageYOffset;
      else if (document.documentElement && document.documentElement.scrollTop) yScroll = document.documentElement.scrollTop;
      else if (document.body) yScroll = document.body.scrollTop;
      return yScroll;
   }
   this.getPageSize = function() {
      var xScroll, yScroll;
      if (window.innerHeight&&window.scrollMaxY) {
         xScroll = document.body.scrollWidth;
         yScroll = window.innerHeight + window.scrollMaxY;
      } else if (document.body.scrollHeight>document.body.offsetHeight){
         xScroll = document.body.scrollWidth;
         yScroll = document.body.scrollHeight;
      } else {
         xScroll = document.body.offsetWidth;
         yScroll = document.body.offsetHeight;
      }
      var windowWidth, windowHeight;
      if (self.innerHeight) {
         windowWidth = self.innerWidth;
         windowHeight = self.innerHeight;
      } else if (document.documentElement&&document.documentElement.clientHeight) {
         windowWidth = document.documentElement.clientWidth;
         windowHeight = document.documentElement.clientHeight;
      } else if (document.body) {
         windowWidth = document.body.clientWidth;
         windowHeight = document.body.clientHeight;
      }
      if (xScroll<windowWidth) pageWidth = windowWidth;
      else pageWidth = xScroll;
      if (yScroll<windowHeight) pageHeight = windowHeight;
      else pageHeight = yScroll;
      arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight);
      return arrayPageSize;
   }
   this.hide = function() {
      if (this.objFrame) this.objFrame.style.display = "none";
      this.objPopup.style.display = "none";
      this.objOverlay.style.display = 'none';
   }
   this.show = function() {
      this.objOverlay.style.display = 'block';
      this.objPopup.style.display = "block";
      this.h_ = document.getElementById("popup_"+id).offsetHeight;
      this.yScroll = this.getPageScroll();
      this.center();
      arrayPageSize = this.getPageSize();
      pageWidth = arrayPageSize[0];
      pageHeight = arrayPageSize[1];
      this.objOverlay.style.width = pageWidth + 'px';
      this.objOverlay.style.height = pageHeight + 'px';
      if (this.objFrame) this.objFrame.style.display = "block";
   }
   this.center = function() {
      var arrayPageSize = this.getPageSize();
      pageWidth = arrayPageSize[0];
      pageHeight = arrayPageSize[1];
      windowWidth = arrayPageSize[2];
      windowHeight = arrayPageSize[3];
      this.h_ = document.getElementById("popup_"+id).offsetHeight;
      this.objOverlay.style.width = pageWidth + 'px';
      this.objOverlay.style.height = pageHeight + 'px';
      var x = (pageWidth-w-12)/2;
      if (x<0) x = 0;
      this.objPopup.style.left = x + 'px';
      var y = (windowHeight-this.h_)/2;
      if (y<0) y = 0;
      y = y + this.yScroll;
      this.objPopup.style.top = y + 'px';
   }
   this._titulo = function(html) {
      document.getElementById("titulo_"+id).innerHTML = html;
   }
   this._popup = function(html) {
      document.getElementById("cuerpo_"+id).innerHTML = html;
   }
   this._iframe = function(url) {
      document.getElementById("cuerpo_"+id).innerHTML = "<iframe name='iframe_"+id+"' id='iframe_"+id+"' src='"+url+"' width='"+w+"' height='"+h+"' frameborder='0' scrolling='auto'></iframe>";
      this.objFrame = document.getElementById("iframe_"+id);
   }
   this._src = function(url) {
      document.getElementById("iframe_"+id).src = url;
   }
   var windowOnResize = (window.onresize) ? window.onresize : function () {};
   window.onresize = function() {
      windowOnResize();
      eval(id+".center();");
   }
}