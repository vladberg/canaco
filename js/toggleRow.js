// JavaScript Document
var preview_line = "";
var preview_class = "";

function toggleRow(line, style, fields, data, active_icons, inactive_icons){
	if(preview_line == ""){
		preview_line = line;
		preview_class = style;
		document.getElementById(line).className = "";
		document.getElementById(line).className = "selected";
		for(i=0;i<data.length;i++){
			document.getElementById(fields[i]).value = data[i];	
		}
		try{
			for(i=0;i<active_icons.length;i++){
				$("#" + String(active_icons[i])).css('display','block');
			}
			for(i=0;i<inactive_icons.length;i++){
				$("#" + String(inactive_icons[i])).css('display','none');
			}
		}
		catch(error){}
	}
	else{
		if(line == preview_line && (style == 'selected' || style == 'selected offColor')){
			document.getElementById(line).className = "";
			document.getElementById(line).className = preview_class;
			preview_line = "";
			preview_class = "";
			for(i=0;i<data.length;i++){
				document.getElementById(fields[i]).value = "";	
			}
			try{
				for(i=0;i<active_icons.length;i++){
					$("#" + String(inactive_icons[i])).css('display','block');
				}
				for(i=0;i<inactive_icons.length;i++){
					$("#" + String(active_icons[i])).css('display','none');
				}
			}
			catch(error){}
		}
		else{
			document.getElementById(preview_line).className = "";
			document.getElementById(preview_line).className = preview_class;
			preview_line = line;
			preview_class = style;
			document.getElementById(line).className = "";
			document.getElementById(line).className = "selected";
			for(i=0;i<data.length;i++){
				document.getElementById(fields[i]).value = data[i];	
			}
			try{
				for(i=0;i<active_icons.length;i++){
					$("#" + String(active_icons[i])).css('display','block');
				}
				for(i=0;i<inactive_icons.length;i++){
					$("#" + String(inactive_icons[i])).css('display','none');
				}
			}
			catch(error){}
		}
	}
}
