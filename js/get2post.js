// JavaScript Document
String.prototype.replaceAll = function(from, to)  {
   var str = this;
   while(str.indexOf(from)>=0) {
      str = str.replace(from, to);
   }
   return str;
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