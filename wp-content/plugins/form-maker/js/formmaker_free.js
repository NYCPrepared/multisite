// Choices id.
j = 2;
var c;
var need_enable = true;
var a = new Array();
var plugin_url = "";
var id_ifr_editor = 500;
var count_of_filds_form = 7;
if (ajaxurl.indexOf("://") != -1) {
  var url_for_ajax = ajaxurl;
}
else {
  var url_for_ajax = location.protocol + '//' + location.host + ajaxurl;
}

function active_reset(val, id) {
	if (val) {
		document.getElementById(id+'_element_resetform_id_temp').style.display = "inline";
	}
	else {
		document.getElementById(id+'_element_resetform_id_temp').style.display = "none";
	}
}

function check_required() {
	alert('"Submit" and "Reset" buttons are disabled in back end.');
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
function change_field_name(id, x) {
	value = x.value;
	if (value == parseInt(value)) {
		alert('The name of the field cannot be a number.');
		x.value="";
		document.getElementById(id+'_elementform_id_temp').name='';
		document.getElementById(id+'_element_labelform_id_temp').innerHTML='';
		return;
	}
	if (value == id + "_elementform_id_temp") {
		alert('"Field Name" should differ from "Field Id".')
		x.value="";
	}
	else {
		document.getElementById(id+'_elementform_id_temp').name=value;
		document.getElementById(id+'_element_labelform_id_temp').innerHTML=value;
	}
}

function change_field_value(id, value) {
	document.getElementById(id+'_elementform_id_temp').value = value;
}

function chnage_icons_src(img, icon) {
  if (img.src.indexOf("hover") != -1) {
    img.src =  plugin_url+'/images/' + icon + ".png";
  }
  else {
    img.src =  plugin_url+'/images/' + icon + "_hover.png";
  }
}

function return_attributes(id) {
	attr_names = new Array();
	attr_value = new Array();
	var input = document.getElementById(id);
	if (input) {
		atr = input.attributes;
    for (i = 0; i < 30; i++) {
      if (atr[i]) {
        if (atr[i].name.indexOf("add_") == 0) {
          attr_names.push(atr[i].name.replace('add_', ''));
          attr_value.push(atr[i].value);
        }
      }
    }
	}
  return Array(attr_names, attr_value);
}

function refresh_attr(x, type) {
	switch(type) {
		case "type_text": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}
    case "type_star_rating": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_scale_rating": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_spinner": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_slider": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_range": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp0';
			id_array[1] = x + '_elementform_id_temp1';
			break;
		}

		case "type_grading": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_matrix": {
			id_array = Array();
			id_array[0] = x + '_elementform_id_temp';
			break;
		}

		case "type_name":	{
			id_array=Array();
			id_array[0]=x+'_element_firstform_id_temp';
			id_array[1]=x+'_element_lastform_id_temp';
			id_array[2]=x+'_element_titleform_id_temp';
			id_array[3]=x+'_element_middleform_id_temp';
			break;
		}
		
		case "type_address":
			
		{
			id_array=Array();
			id_array[0]=x+'_street1form_id_temp';
			id_array[1]=x+'_street2form_id_temp';
			id_array[2]=x+'_cityform_id_temp';
			id_array[3]=x+'_stateform_id_temp';
			id_array[4]=x+'_postalform_id_temp';
			id_array[5]=x+'_countryform_id_temp';
			break;
		}
		
		case "type_checkbox":
			
		{
			id_array=Array();
			for(z=0;z<50;z++)
				id_array[z]=x+'_elementform_id_temp'+z;
			break;
		}
		
		case "type_time":
			
		{
			id_array=Array();
			id_array[0]=x+'_hhform_id_temp';
			id_array[1]=x+'_mmform_id_temp';
			id_array[2]=x+'_ssform_id_temp';
			id_array[3]=x+'_am_pmform_id_temp';
			break;
		}
		case "type_date":
			
		{
			id_array=Array();
			id_array[0]=x+'_elementform_id_temp';
			id_array[1]=x+'_buttonform_id_temp';
			break;
		}
		
		case "type_date_fields":
			
		{
			id_array=Array();
			id_array[0]=x+'_dayform_id_temp';
			id_array[1]=x+'_monthform_id_temp';
			id_array[2]=x+'_yearform_id_temp';
			break;
		}
		
		case "type_captcha":
			
		{
			id_array=Array();
			id_array[0]='_wd_captchaform_id_temp';
			id_array[1]='_wd_captcha_inputform_id_temp';
			id_array[2]='_element_refreshform_id_temp';
			break;
		}
		
		case "type_recaptcha":
			
		{
			id_array=Array();
			id_array[0]='wd_recaptchaform_id_temp';
			break;
		}
		
		case "type_submit_reset":
			
		{
			id_array=Array();
			id_array[0]=x+'_element_submitform_id_temp';
			id_array[1]=x+'_element_resetform_id_temp';
			break;
		}
		
		case "type_page_break":
			
		{
			id_array=Array();
			id_array[0]='_div_between';
			break;
		}
	}
		
	for(q=0; q<id_array.length;q++)
	{
		id=id_array[q];
		var input=document.getElementById(id);
		if(input)
		{
			atr=input.attributes;
			for(i=0;i<30;i++)
				if(atr[i])
					{
						if(atr[i].name.indexOf("add_")==0)
						{
							input.removeAttribute(atr[i].name);
							i--;
						}
					}
				
			for(i=0;i<10;i++)
				if(document.getElementById("attr_name"+i))
				{
					try{input.setAttribute("add_"+document.getElementById("attr_name"+i).value, document.getElementById("attr_value"+i).value)}
					catch(err)
					{
						alert('Only letters, numbers, hyphens and underscores are allowed.');
					}
				}
		}
	}
}

function add_id_and_name(i,type)
{
	switch(type)
	{
		case 'type_text':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				
			var edit_main_td0_1 = document.createElement('td');
				edit_main_td0_1.style.cssText = "padding-top:10px";
				
			var br = document.createElement('br');
			var br1 = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Field id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("size", "50");
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("value", i+"_elementform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Field name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("size", "50");
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("value", i+"_elementform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			
			edit_main_td0_1.appendChild(field_id_text);
			edit_main_td0_1.appendChild(br1);
			edit_main_td0_1.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_tr0.appendChild(edit_main_td0_1);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
	
		case 'type_address':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				edit_main_td0.setAttribute("colspan", "2");
				
			var br = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("style", "width:350px");
				field_id_text.setAttribute("value",  i+"_street1form_id_temp, "+i+"_street2form_id_temp, "+i+"_cityform_id_temp, "+i+"_stateform_id_temp, "+i+"_postalform_id_temp, "+i+"_countryform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("style", "width:350px");
				field_name_text.setAttribute("value", i+"_street1form_id_temp, "+i+"_street2form_id_temp, "+i+"_cityform_id_temp, "+i+"_stateform_id_temp, "+i+"_postalform_id_temp, "+i+"_countryform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(field_id_text);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			edit_main_td0.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
	
		case 'type_name':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				edit_main_td0.setAttribute("colspan", "2");
				
			var br = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("style", "width:350px");
				field_id_text.setAttribute("value",  i+"_element_firstform_id_temp, "+i+"_element_lastform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("style", "width:350px");
				field_name_text.setAttribute("value", i+"_element_firstform_id_temp, "+i+"_element_lastform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(field_id_text);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			edit_main_td0.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
	
		case 'type_radio':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				edit_main_td0.setAttribute("colspan", "2");
				
			var br = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("style", "width:350px");
				field_id_text.setAttribute("value",  '');
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("style", "width:350px");
				field_name_text.setAttribute("value", '');
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(field_id_text);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			edit_main_td0.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			refresh_id_name(i, type);
			break;
		}
	
		case 'type_checkbox':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				edit_main_td0.setAttribute("colspan", "2");
				
			var br = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("style", "width:350px");
				field_id_text.setAttribute("value",  '');
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("style", "width:350px");
				field_name_text.setAttribute("value", '');
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(field_id_text);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			edit_main_td0.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			refresh_id_name(i, type);
			break;
		}
	
		case 'type_time':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
			var edit_main_td0_1 = document.createElement('td');
				edit_main_td0_1.style.cssText = "padding-top:10px";
				
			var br = document.createElement('br');
			var br1 = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("size", "50");
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("value", i+"_hhform_id_temp, "+i+"_mmform_id_temp, "+i+"_ssform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("size", "50");
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("value", i+"_hhform_id_temp, "+i+"_mmform_id_temp, "+i+"_ssform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(br1);
			edit_main_td0.appendChild(field_name);
			edit_main_td0_1.appendChild(field_id_text);
			edit_main_td0_1.appendChild(br);
			edit_main_td0_1.appendChild(field_name_text);
			
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_tr0.appendChild(edit_main_td0_1);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
	
		case 'type_date_fields':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				edit_main_td0.setAttribute("colspan", "2");
				
			var br = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("size", "50");
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("value", i+"_dayform_id_temp, "+i+"_monthform_id_temp, "+i+"_yearform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("size", "50");
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("value", i+"_dayform_id_temp, "+i+"_monthform_id_temp, "+i+"_yearform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(field_id_text);
			edit_main_td0.appendChild(br);
			edit_main_td0.appendChild(field_name);
			edit_main_td0.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
	
		case 'type_captcha':
		{
			var	edit_main_table=document.getElementById("edit_main_table");
			
			var edit_main_tr0  = document.createElement('tr');
					edit_main_tr0.setAttribute("valing", "top");
					
			var edit_main_td0 = document.createElement('td');
				edit_main_td0.style.cssText = "padding-top:10px";
				
			var edit_main_td0_1 = document.createElement('td');
				edit_main_td0_1.style.cssText = "padding-top:10px";
				
			var br = document.createElement('br');
			var br1 = document.createElement('br');
			
			var field_id = document.createElement('label');
					field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
					field_id.innerHTML = "Fields id ";
			
			
			var field_id_text = document.createElement('input');
				field_id_text.setAttribute("size", "50");
				field_id_text.setAttribute("type", "text");
				field_id_text.setAttribute("id", "field_id");
				field_id_text.setAttribute("disabled", "disabled");
				field_id_text.setAttribute("value", "wd_captcha_inputform_id_temp");
			
			var field_name = document.createElement('label');
					field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
					field_name.innerHTML = "Fields name ";
			
			var field_name_text = document.createElement('input');
				field_name_text.setAttribute("size", "50");
				field_name_text.setAttribute("type", "text");
				field_name_text.setAttribute("id", "field_name");
				field_name_text.setAttribute("disabled", "disabled");
				field_name_text.setAttribute("value", "captcha_inputform_id_temp");
				
			edit_main_td0.appendChild(field_id);
			edit_main_td0.appendChild(br1);
			edit_main_td0.appendChild(field_name);
			edit_main_td0_1.appendChild(field_id_text);
			edit_main_td0_1.appendChild(br);
			edit_main_td0_1.appendChild(field_name_text);
			edit_main_tr0.appendChild(edit_main_td0);
			edit_main_tr0.appendChild(edit_main_td0_1);
			edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
			break;
		}
    case 'type_spinner': {
      var	edit_main_table = document.getElementById("edit_main_table");
      var edit_main_tr0  = document.createElement('tr');
      edit_main_tr0.setAttribute("valing", "top");
      var edit_main_td0 = document.createElement('td');
      edit_main_td0.style.cssText = "padding-top:10px";
      var edit_main_td0_1 = document.createElement('td');
      edit_main_td0_1.style.cssText = "padding-top:10px";
      var br = document.createElement('br');
      var br1 = document.createElement('br');
      var field_id = document.createElement('label');
      field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
      field_id.innerHTML = "Field id ";
      var field_id_text = document.createElement('input');
      field_id_text.setAttribute("size", "50");
      field_id_text.setAttribute("type", "text");
      field_id_text.setAttribute("disabled", "disabled");
      field_id_text.setAttribute("value", i+"_elementform_id_temp");
      var field_name = document.createElement('label');
      field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
      field_name.innerHTML = "Field name ";
      var field_name_text = document.createElement('input');
      field_name_text.setAttribute("size", "50");
      field_name_text.setAttribute("type", "text");
      field_name_text.setAttribute("disabled", "disabled");
      field_name_text.setAttribute("value", i+"_elementform_id_temp");
      edit_main_td0.appendChild(field_id);
      edit_main_td0.appendChild(br);
      edit_main_td0.appendChild(field_name);
      edit_main_td0_1.appendChild(field_id_text);
      edit_main_td0_1.appendChild(br1);
      edit_main_td0_1.appendChild(field_name_text);
      edit_main_tr0.appendChild(edit_main_td0);
      edit_main_tr0.appendChild(edit_main_td0_1);
      edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
      break;

		}
		case 'type_slider': {
      var	edit_main_table=document.getElementById("edit_main_table");
      var edit_main_tr0  = document.createElement('tr');
      edit_main_tr0.setAttribute("valing", "top");
      var edit_main_td0 = document.createElement('td');
      edit_main_td0.style.cssText = "padding-top:10px";
      var edit_main_td0_1 = document.createElement('td');
      edit_main_td0_1.style.cssText = "padding-top:10px";
      var br = document.createElement('br');
      var br1 = document.createElement('br');
      var field_id = document.createElement('label');
      field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
      field_id.innerHTML = "Field id ";
      var field_id_text = document.createElement('input');
      field_id_text.setAttribute("size", "50");
      field_id_text.setAttribute("type", "text");
      field_id_text.setAttribute("disabled", "disabled");
      field_id_text.setAttribute("value", i+"_elementform_id_temp");
      var field_name = document.createElement('label');
      field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
      field_name.innerHTML = "Field name ";
      var field_name_text = document.createElement('input');
      field_name_text.setAttribute("size", "50");
      field_name_text.setAttribute("type", "text");
      field_name_text.setAttribute("disabled", "disabled");
      field_name_text.setAttribute("value", i+"_elementform_id_temp");
      edit_main_td0.appendChild(field_id);
      edit_main_td0.appendChild(br);
      edit_main_td0.appendChild(field_name);
      edit_main_td0_1.appendChild(field_id_text);
      edit_main_td0_1.appendChild(br1);
      edit_main_td0_1.appendChild(field_name_text);
      edit_main_tr0.appendChild(edit_main_td0);
      edit_main_tr0.appendChild(edit_main_td0_1);
      edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
      break;

		}
		case 'type_range': {
      var	edit_main_table=document.getElementById("edit_main_table");
      var edit_main_tr0  = document.createElement('tr');
      edit_main_tr0.setAttribute("valing", "top");
      var edit_main_td0 = document.createElement('td');
      edit_main_td0.style.cssText = "padding-top:10px";
      edit_main_td0.setAttribute("colspan", "2");
      var br = document.createElement('br');
      var field_id = document.createElement('label');
      field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
      field_id.innerHTML = "Fields id ";
      var field_id_text = document.createElement('input');
      field_id_text.setAttribute("type", "text");
      field_id_text.setAttribute("id", "field_id");
      field_id_text.setAttribute("disabled", "disabled");
      field_id_text.setAttribute("style", "width:350px");
      field_id_text.setAttribute("value",  '');
      var field_name = document.createElement('label');
      field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
      field_name.innerHTML = "Fields name ";
      var field_name_text = document.createElement('input');
      field_name_text.setAttribute("type", "text");
      field_name_text.setAttribute("id", "field_name");
      field_name_text.setAttribute("disabled", "disabled");
      field_name_text.setAttribute("style", "width:350px");
      field_name_text.setAttribute("value", '');
      edit_main_td0.appendChild(field_id);
      edit_main_td0.appendChild(field_id_text);
      edit_main_td0.appendChild(br);
      edit_main_td0.appendChild(field_name);
      edit_main_td0.appendChild(field_name_text);
      edit_main_tr0.appendChild(edit_main_td0);
      edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
      refresh_id_name(i, type);
      break;

		}
    case 'type_grading': {
	    var	edit_main_table=document.getElementById("edit_main_table");
      var edit_main_tr0  = document.createElement('tr');
      edit_main_tr0.setAttribute("valing", "top");
      var edit_main_td0 = document.createElement('td');
      edit_main_td0.style.cssText = "padding-top:10px";
      edit_main_td0.setAttribute("colspan", "2");
      var br = document.createElement('br');
      var field_id = document.createElement('label');
      field_id.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;  margin-right:27px";
      field_id.innerHTML = "Fields id ";
      var field_id_text = document.createElement('input');
      field_id_text.setAttribute("type", "text");
      field_id_text.setAttribute("id", "field_id");
      field_id_text.setAttribute("disabled", "disabled");
      field_id_text.setAttribute("style", "width:350px");
      field_id_text.setAttribute("value",  '');
      var field_name = document.createElement('label');
      field_name.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px; margin-right:3px";
      field_name.innerHTML = "Fields name ";
      var field_name_text = document.createElement('input');
      field_name_text.setAttribute("type", "text");
      field_name_text.setAttribute("id", "field_name");
      field_name_text.setAttribute("disabled", "disabled");
      field_name_text.setAttribute("style", "width:350px");
      field_name_text.setAttribute("value", '');
      edit_main_td0.appendChild(field_id);
      edit_main_td0.appendChild(field_id_text);
      edit_main_td0.appendChild(br);
      edit_main_td0.appendChild(field_name);
      edit_main_td0.appendChild(field_name_text);
      edit_main_tr0.appendChild(edit_main_td0);
      edit_main_table.insertBefore(edit_main_tr0,edit_main_table.childNodes[0]);		
      refresh_id_name(i, type);
      break;
		}
	}
}


function refresh_id_name(i, type) {
	switch (type) {
		case 'type_radio': {
			document.getElementById('field_id').value = '';
			for (k = 0; k < 50; k++) {
				if (document.getElementById(i+'_elementform_id_temp' + k)) {
					document.getElementById('field_id').value	+= i + '_elementform_id_temp' + k + ', ';
        }
			}
			a = document.getElementById('field_id').value.slice(0, -2);
			document.getElementById('field_id').value = a;
			document.getElementById('field_name').value	= i + '_element';

			break;
		}
		case 'type_checkbox': {
			document.getElementById('field_id').value = '';
			for (k = 0; k < 50; k++) {
				if (document.getElementById(i + '_elementform_id_temp' + k)) {	
					document.getElementById('field_id').value	+= i + '_elementform_id_temp' + k + ', ';
				}
			}
			a = document.getElementById('field_id').value.slice(0, -2);
			document.getElementById('field_id').value	= a;
			document.getElementById('field_name').value	= a;
			break;

		}
    case 'type_range': {
			document.getElementById('field_id').value = '';
			for (k = 0; k < 2; k++) {
        document.getElementById('field_id').value	+= i + '_elementform_id_temp' + k + ', ';
			}
			a = document.getElementById('field_id').value.slice(0, -2);
			document.getElementById('field_id').value	= a;
			document.getElementById('field_name').value	= a;
			break;

		}
		case 'type_grading': {
			document.getElementById('field_id').value = '';
			for (k = 0; k < 50; k++) {
				if (document.getElementById(i + '_elementform_id_temp' + k)) {
					document.getElementById('field_id').value	+= i + '_elementform_id_temp' + k + ', ';
				}
			}
			a = document.getElementById('field_id').value.slice(0, -2);
			document.getElementById('field_id').value	= a;
			document.getElementById('field_name').value	= a;
			break;
		}
	}
}



function add_attr(i, type)
{
		
	var el_attr_table=document.getElementById('attributes');
	j=parseInt(el_attr_table.lastChild.getAttribute('idi'))+1;
	w_attr_name[j]="attribute";
	w_attr_value[j]="value";
	var el_attr_tr = document.createElement('tr');
		el_attr_tr.setAttribute("id", "attr_row_"+j);
		el_attr_tr.setAttribute("idi", j);
	var el_attr_td_name = document.createElement('td');
		el_attr_td_name.style.cssText = 'width:100px';
	var el_attr_td_value = document.createElement('td');
		el_attr_td_value.style.cssText = 'width:100px';
	
	var el_attr_td_X = document.createElement('td');
	var el_attr_name = document.createElement('input');
		el_attr_name.setAttribute("type", "text");
		el_attr_name.style.cssText = "width:100px";
		el_attr_name.setAttribute("value", w_attr_name[j]);
		el_attr_name.setAttribute("id", "attr_name"+j);
		el_attr_name.setAttribute("onChange", "change_attribute_name('"+i+"', this, '"+type+"')");	
		
	var el_attr_value = document.createElement('input');
		el_attr_value.setAttribute("type", "text");
		el_attr_value.style.cssText = "width:100px";
		el_attr_value.setAttribute("value", w_attr_value[j]);
		el_attr_value.setAttribute("id", "attr_value"+j);
		el_attr_value.setAttribute("onChange", "change_attribute_value('"+i+"', "+j+", '"+type+"')");
	
	var el_attr_remove = document.createElement('img');
		el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
		el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
		el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
		el_attr_remove.setAttribute("align", 'top');
		el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", '"+type+"')");
	el_attr_table.appendChild(el_attr_tr);
	el_attr_tr.appendChild(el_attr_td_name);
	el_attr_tr.appendChild(el_attr_td_value);
	el_attr_tr.appendChild(el_attr_td_X);
	el_attr_td_name.appendChild(el_attr_name);
	el_attr_td_value.appendChild(el_attr_value);
	el_attr_td_X.appendChild(el_attr_remove);
refresh_attr(i, type);
}

function change_attribute_value(id, x, type)
{
	if(!document.getElementById("attr_name"+x).value)
	{
		alert('The name of the attribute is required.');
		return
	}
	
	if(document.getElementById("attr_name"+x).value.toLowerCase()=="style")
	{
		alert('Sorry, you cannot add a style attribute here. Use "Class name" instead.');
		return
	}
	
	refresh_attr(id, type);
}

function change_attribute_name(id, x, type)
{
	value=x.value;
	if(!value)
	{
		alert('The name of the attribute is required.');
		return;
	}
	
	if(value.toLowerCase()=="style")
	{
		alert('Sorry, you cannot add a style attribute here. Use "Class name" instead.');
		return;
	}
	
	if(value==parseInt(value))
	{
		alert('The name of the attribute cannot be a number.');
		return;
	}
	
	if(value.indexOf(" ")!=-1)
	{	
		var regExp = /\s+/g;
		value=value.replace(regExp,''); 
		x.value=value;
		alert("The name of the attribute cannot contain a space.");
		refresh_attr(id, type);
		return;
	}	
	
	refresh_attr(id, type);
	
}

function remove_attr(id, el_id,type)
{
	tr=document.getElementById("attr_row_"+id);
	tr.parentNode.removeChild(tr);
	refresh_attr(el_id, type);
}

function change_attributes(id, attr)
{
	
var div = document.createElement('div');
var element=document.getElementById(id);
	element.setAttribute(attr, '');
}

function add_button(i)
{
	edit_main_td4=document.getElementById('buttons');
	if(edit_main_td4.lastChild)
		j=parseInt(edit_main_td4.lastChild.getAttribute("idi"))+1;
	else
		j=1;
	var table_button = document.createElement('table');
	
	table_button.setAttribute("width", "100%");
	table_button.setAttribute("border", "0");
	table_button.setAttribute("id", "button_opt"+j);
	table_button.setAttribute("idi", j);
	var tr_button = document.createElement('tr');
	var tr_hr = document.createElement('tr');
	
	var td_button = document.createElement('td');
	var td_X = document.createElement('td');
	var td_hr = document.createElement('td');
	td_hr.setAttribute("colspan", "3");
	
	tr_hr.appendChild(td_hr);
	tr_button.appendChild(td_button);
	tr_button.appendChild(td_X);
	table_button.appendChild(tr_hr);
	table_button.appendChild(tr_button);
	
	var br1 = document.createElement('br');
	
	var hr = document.createElement('hr');
	
	hr.setAttribute("id", "br"+j);
	
	
	
	
	var el_title_label = document.createElement('label');
	
		el_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		
		el_title_label.innerHTML = "Button name";
	
	var el_title = document.createElement('input');
	
		el_title.setAttribute("id", "el_title"+j);
		
		el_title.setAttribute("type", "text");
	
		el_title.setAttribute("value", "Button");
		
		el_title.style.cssText =   "width:100px; margin-left:43px; padding:0; border-width: 1px";
		
		el_title.setAttribute("onKeyUp", "change_label('"+i+"_elementform_id_temp"+j+"', this.value);");
	
	
	
	var el_func_label = document.createElement('label');
	
		el_func_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		
		el_func_label.innerHTML = "OnClick function";
	
	var el_func = document.createElement('input');
	
		el_func.setAttribute("id", "el_func"+j);
		
		el_func.setAttribute("type", "text");
		
		el_func.setAttribute("value", "");
		
		el_func.style.cssText =   "width:100px; margin-left:20px;; padding:0; border-width: 1px";
		
		el_func.setAttribute("onKeyUp", "change_func('"+i+"_elementform_id_temp"+j+"', this.value);");
	
	var el_choices_remove = document.createElement('img');
	
		el_choices_remove.setAttribute("id", "el_button"+j+"_remove");
		
		el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
		
		el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
		
		el_choices_remove.setAttribute("align", 'top');
		
		el_choices_remove.setAttribute("onClick", "remove_button("+j+","+i+")");
	
	
	
	td_hr.appendChild(hr);
	
	td_button.appendChild(el_title_label);
	
	td_button.appendChild(el_title);
	td_button.appendChild(br1);
	td_button.appendChild(el_func_label);
	
	td_button.appendChild(el_func);
	td_X.appendChild(el_choices_remove);
	edit_main_td4.appendChild(table_button);
	
	element='button';	type='button'; 
	
	td2=document.getElementById(i+"_element_sectionform_id_temp");
	
	var adding = document.createElement(element);
			adding.setAttribute("type", type);
			adding.setAttribute("id", i+"_elementform_id_temp"+j);
			adding.setAttribute("name", i+"_elementform_id_temp"+j);
			adding.setAttribute("value", "Button");
			adding.innerHTML =  "Button";
			adding.setAttribute("onclick", "");
			
			
	td2.appendChild(adding);
	
refresh_attr(i,'type_checkbox');
}

function remove_button(j,i)
{
	table=document.getElementById('button_opt'+j);
	button=document.getElementById(i+'_elementform_id_temp'+j);
	table.parentNode.removeChild(table);
	button.parentNode.removeChild(button);
}

function change_date_format(value, id)
{
	input_p=document.getElementById(id+'_buttonform_id_temp');
		input_p.setAttribute("onclick", "return showCalendar('"+id+"_elementform_id_temp' , '"+value+"')");
		input_p.setAttribute("format", value);
}

function set_send(id)
{	
if(document.getElementById(id).value=="yes")
	document.getElementById(id).setAttribute("value", "no")
else
	document.getElementById(id).setAttribute("value", "yes")
}

function change_class(x, id) {
	if(document.getElementById(id+'_label_sectionform_id_temp'))
	document.getElementById(id+'_label_sectionform_id_temp').setAttribute("class",x);
	if(document.getElementById(id+'_element_sectionform_id_temp'))
	document.getElementById(id+'_element_sectionform_id_temp').setAttribute("class",x);
}

function set_required(id)
{	
	if(document.getElementById(id+"form_id_temp").value=="yes")
	{
		document.getElementById(id+"form_id_temp").setAttribute("value", "no");
		document.getElementById(id+"_elementform_id_temp").innerHTML="";
	}	
	else
	{
		document.getElementById(id+"form_id_temp").setAttribute("value", "yes")
		document.getElementById(id+"_elementform_id_temp").innerHTML=" *";
	}
}

function disable_fields(id, field) {	
	var div = document.getElementById(id + "_div_address");		
	if (field) {
		if (document.getElementById("el_"+field).checked==true) {
			document.getElementById(id+"_disable_fieldsform_id_temp").setAttribute(field, "yes");
    }
		else {
			document.getElementById(id+"_disable_fieldsform_id_temp").setAttribute(field, "no");
    }
	}
  div.innerHTML = '';
  var hidden_labels = new Array();
  var address_fields = ['street1','street2','city','state','postal','country']
  var left_right = 0;
  for (l = 0; l < 6; l++) {
    if (document.getElementById(id+'_disable_fieldsform_id_temp').getAttribute(address_fields[l])=='no') {
      if (address_fields[l]=='street1' || address_fields[l]=='street2') {
        var street = document.createElement('input');
        street.setAttribute("type", 'text');
        street.style.cssText = "width:100%";
        street.setAttribute("id", id+"_"+address_fields[l]+"form_id_temp");
        street.setAttribute("name", (parseInt(id)+l)+"_"+address_fields[l]+"form_id_temp");
        street.setAttribute("onChange", "change_value('"+id+"_"+address_fields[l]+"form_id_temp')");
        var street_label = document.createElement('label');
        street_label.setAttribute("class", "mini_label");	
        street_label.setAttribute("id", id+"_mini_label_"+address_fields[l]);
        street_label.style.cssText = "display:block;";
        street_label.innerHTML=document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
        w_mini_labels[l] = document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
        var span_addres = document.createElement('span');
        span_addres.style.cssText = "float:left; width:100%;  padding-bottom: 8px; display:block";	
        span_addres.appendChild(street);
        span_addres.appendChild(street_label);
        div.appendChild(span_addres);				
      }
      else {
        left_right++;
        if (address_fields[l] != 'country') {
          var field = document.createElement('input');
          field.setAttribute("type", 'text');
          field.style.cssText = "width:100%";
          field.setAttribute("id", id+"_"+address_fields[l]+"form_id_temp");
          field.setAttribute("name", (parseInt(id)+l)+"_"+address_fields[l]+"form_id_temp");
          field.setAttribute("onChange", "change_value('"+id+"_"+address_fields[l]+"form_id_temp')");
          var field_label = document.createElement('label');
          field_label.setAttribute("class", "mini_label");		
          field_label.setAttribute("id", id+"_mini_label_"+address_fields[l]);
          field_label.style.cssText = "display:block;";
          field_label.innerHTML=document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
          w_mini_labels[l] = document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
        }
        else {
          var field = document.createElement('select');
          field.setAttribute("type", 'text');
          field.style.cssText = "width:100%";
          field.setAttribute("id", id+"_countryform_id_temp");
          field.setAttribute("name", (parseInt(id)+l)+"_countryform_id_temp");
          field.setAttribute("onChange", "change_value('"+id+"_countryform_id_temp')");
          var field_label = document.createElement('label');
          field_label.setAttribute("class", "mini_label");	
          field_label.setAttribute("id", id+"_mini_label_country");
          field_label.style.cssText = "display:block;";
          field_label.innerHTML=document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
          w_mini_labels[l] = document.getElementById('el_'+address_fields[l]+"_label").innerHTML;
          var option_ = document.createElement('option');
          option_.setAttribute("value", "");
          option_.innerHTML = "";
          field.appendChild(option_);
          coutries=["Afghanistan","Albania",	"Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros","Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepa","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"];	
          for (r = 0; r < coutries.length; r++) {
            var option_ = document.createElement('option');
            option_.setAttribute("value", coutries[r]);
            option_.innerHTML=coutries[r];
            field.appendChild(option_);
          }
        }
        if (left_right % 2 != 0) {
          var span_addres = document.createElement('span');
          span_addres.style.cssText = "float:left; width:48%; padding-bottom: 8px;";
        }
        else {
          var span_addres = document.createElement('span');
          span_addres.style.cssText = "float:right; width:48%; padding-bottom: 8px;";
        }
        span_addres.appendChild(field);
        span_addres.appendChild(field_label);
        div.appendChild(span_addres);
      }
    }
    else {
      var hidden_field = document.createElement('input');
      hidden_field.setAttribute("type", 'hidden');
      hidden_field.setAttribute("id", id+"_"+address_fields[l]+"form_id_temp");
      hidden_field.setAttribute("value", document.getElementById("el_"+address_fields[l]+"_label").innerHTML);
      hidden_field.setAttribute("id_for_label", parseInt(id)+l); 
      hidden_labels.push(hidden_field);
    }
    for (k = 0; k < hidden_labels.length; k++) {
      div.appendChild(hidden_labels[k]);
    }
	}
  jQuery(document).ready(function() {
    jQuery("label#"+id+"_mini_label_street1").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var street1 = "<input type='text' class='street1' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(street1);					
        jQuery("input.street1").focus();		
        jQuery("input.street1").blur(function() {	
          var value = jQuery(this).val();			
          jQuery("#"+id+"_mini_label_street1").text(value);		
          document.getElementById('el_street1_label').innerHTML=	value;	
        });		
      }	
    });
    jQuery("label#"+id+"_mini_label_street2").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var street2 = "<input type='text' class='street2'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(street2);					
        jQuery("input.street2").focus();		
        jQuery("input.street2").blur(function() {	
          var value = jQuery(this).val();			
          jQuery("#"+id+"_mini_label_street2").text(value);
          document.getElementById('el_street2_label').innerHTML=	value;		
        });		
      }	
    });
    jQuery("label#"+id+"_mini_label_city").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var city = "<input type='text' class='city'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(city);			
        jQuery("input.city").focus();				
        jQuery("input.city").blur(function() {			
          var value = jQuery(this).val();		
          jQuery("#"+id+"_mini_label_city").text(value);	
          document.getElementById('el_city_label').innerHTML=	value;		
        });
      }
    });
    jQuery("label#"+id+"_mini_label_state").click(function() {		
      if (jQuery(this).children('input').length == 0) {	
        var state = "<input type='text' class='state'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(state);		
        jQuery("input.state").focus();		
        jQuery("input.state").blur(function() {		
          var value = jQuery(this).val();			
          jQuery("#"+id+"_mini_label_state").text(value);
          document.getElementById('el_state_label').innerHTML=	value;		
        });	
      }
    });
    jQuery("label#"+id+"_mini_label_postal").click(function() {
      if (jQuery(this).children('input').length == 0) {			
        var postal = "<input type='text' class='postal'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(postal);			
        jQuery("input.postal").focus();			
        jQuery("input.postal").blur(function() {			
          var value = jQuery(this).val();		
          jQuery("#"+id+"_mini_label_postal").text(value);	
          document.getElementById('el_postal_label').innerHTML=	value;		
        });	
      }
    });	
    jQuery("label#"+id+"_mini_label_country").click(function() {
      if (jQuery(this).children('input').length == 0) {		
        var country = "<input type='text' class='country'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(country);
        jQuery("input.country").focus();
        jQuery("input.country").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+id+"_mini_label_country").text(value);
          document.getElementById('el_country_label').innerHTML = value;
        });
      }
    });
	});
}

function set_unique(id)
{	
	if(document.getElementById(id).value=="yes")
	{
		document.getElementById(id).setAttribute("value", "no");
	}	
	else
	{
		document.getElementById(id).setAttribute("value", "yes")
	}
}

function set_randomize(id)
{	
	if(document.getElementById(id).value=="yes")
	{
		document.getElementById(id).setAttribute("value", "no");
	}	
	else
	{
		document.getElementById(id).setAttribute("value", "yes")
	}
}
function show_other_input(num)
{
		for(k=0;k<50;k++)
			if(	document.getElementById(num+"_elementform_id_temp"+k)) 
				if(	document.getElementById(num+"_elementform_id_temp"+k).getAttribute('other')) 
					if(	document.getElementById(num+"_elementform_id_temp"+k).getAttribute('other')==1)
					{
						element_other=document.getElementById(num+"_elementform_id_temp"+k);
						break;
					}



	parent=element_other.parentNode;

	var br = document.createElement('br');
		br.setAttribute("id", num+"_other_brform_id_temp");
		
	var el_other = document.createElement('input');
		el_other.setAttribute("id", num+"_other_inputform_id_temp");
		el_other.setAttribute("name", num+"_other_inputform_id_temp");
		el_other.setAttribute("type", "text");
		el_other.setAttribute("class", "other_input");
	parent.appendChild(br);
	parent.appendChild(el_other);

}

function set_allow_other(num, type) {
	if (document.getElementById(num+'_allow_otherform_id_temp').value == "yes") {
		document.getElementById(num+'_allow_otherform_id_temp').setAttribute("value", "no");
		for (k = 0; k < 50; k++) {
			if (document.getElementById("el_choices" + k)) {
				if (document.getElementById("el_choices" + k).getAttribute('other')) {
					if (document.getElementById("el_choices" + k).getAttribute('other') == 1) {
						remove_choise(k, num, type);
						break;
					}
        }
      }
    }
	}
	else {
		document.getElementById(num+'_allow_otherform_id_temp').setAttribute("value", "yes");
		j++;
    var choices_td = document.getElementById('choices');
    var br = document.createElement('br');
    br.setAttribute("id", "br"+j);
    var el_choices = document.createElement('input');
    el_choices.setAttribute("id", "el_choices"+j);
    el_choices.setAttribute("type", "text");
    el_choices.setAttribute("value", "other");
    el_choices.setAttribute("other", "1");
    el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
    el_choices.setAttribute("onKeyUp", "change_label('"+num+"_label_element"+j+"', this.value); change_in_value('"+num+"_elementform_id_temp"+j+"', this.value)");
    var el_choices_remove = document.createElement('img');
    el_choices_remove.setAttribute("id", "el_choices"+j+"_remove");
    el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
    el_choices_remove.style.cssText =  'cursor:pointer;vertical-align:middle; margin:3px; display:none';
    el_choices_remove.setAttribute("align", 'top');
    el_choices_remove.setAttribute("onClick", "remove_choise('"+j+"','"+num+"','"+type+"')");
    choices_td.appendChild(br);
    choices_td.appendChild(el_choices);
    choices_td.appendChild(el_choices_remove);
    if (type == 'checkbox') {
      refresh_attr(num, 'type_checkbox');
    }
    if (type == 'radio') {
			refresh_attr(num, 'type_radio');
    }
    refresh_rowcol(num, type);
	}
}

function flow_hor(id)
{
	tbody=document.getElementById(id+'_table_little');
	td_array= new Array();
	n=tbody.childNodes.length;
	for(k=0; k<n;k++)
		td_array[k]=tbody.childNodes[k].childNodes[0];
		
	for(k=0; k<n;k++)
		tbody.removeChild(tbody.childNodes[0]);
		
	var tr = document.createElement('tr');
           	tr.setAttribute("id", id+"_hor");
			
	tbody.appendChild(tr);
	for(k=0; k<n;k++)
		tr.appendChild(td_array[k]);
}

function flow_ver(id)
{	
	tbody=document.getElementById(id+'_table_little');
	tr=document.getElementById(id+'_hor');
	td_array= new Array();
	n=tr.childNodes.length;
	
	for(k=0; k<n;k++)
		td_array[k]=tr.childNodes[k];
			
	tbody.removeChild(tr);
	
	for(k=0; k<n;k++)
	{      	
		var tr_little = document.createElement('tr');
			tr_little.setAttribute("id", id+"_element_tr"+td_array[k].getAttribute("idi"));
		tr_little.appendChild(td_array[k]);
		tbody.appendChild(tr_little);
	}			
}

function check_isnum_3_10(e)
{
	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 51 || chCode1 > 57))
        return false
	else if((document.getElementById('captcha_digit').value+(chCode1-48))>9)
        return false;
	return true;
}

function set_sel_am_pm(select_)
{
	if(select_.options[0].selected) 
	{
		select_.options[0].setAttribute("selected", "selected");
		select_.options[1].removeAttribute("selected");
	}
	else
	{
		select_.options[1].setAttribute("selected", "selected");
		select_.options[0].removeAttribute("selected");
	}

}

function change_captcha_digit(digit)
{
	captcha=document.getElementById('_wd_captchaform_id_temp');
	if(document.getElementById('captcha_digit').value)
	{	
		captcha.setAttribute("digit", digit);
	
		captcha.setAttribute("src", url_for_ajax+"?action=formmakerwdcaptcha"+"&digit="+digit+"&i=form_id_temp");
		document.getElementById('_wd_captcha_inputform_id_temp').style.width=(document.getElementById('captcha_digit').value*10+15)+"px";
	}
	else
	{
		captcha.setAttribute("digit", "6");
		captcha.setAttribute("src", url_for_ajax+"?action=formmakerwdcaptcha"+"&digit=6"+"&i=form_id_temp");
		document.getElementById('_wd_captcha_inputform_id_temp').style.width=(6*10+15)+"px";
	}
}

function second_no(id)
{	
	time_box=document.getElementById(id+'_tr_time1');
	text_box=document.getElementById(id+'_tr_time2');
	second_box=document.getElementById(id+'_td_time_input3');
	second_text=document.getElementById(id+'_td_time_label3');
	document.getElementById(id+'_td_time_input2').parentNode.removeChild(document.getElementById(id+'_td_time_input2').nextSibling);
	time_box.removeChild(second_box);
	text_box.removeChild(second_text.previousSibling);
	text_box.removeChild(second_text);
	
}

function second_yes(id, w_ss)
{	
	time_box=document.getElementById(id+'_tr_time1');
	text_box=document.getElementById(id+'_tr_time2');
	
	var td_time_input2_ket = document.createElement('td');
           	td_time_input2_ket.setAttribute("align", "center");
	var td_time_input3 = document.createElement('td');
           	td_time_input3.setAttribute("id", id+"_td_time_input3");
			
      	var td_time_label2_ket = document.createElement('td');
	
      	var td_time_label3 = document.createElement('td');
           	td_time_label3.setAttribute("id", id+"_td_time_label3");

	var mm_ = document.createElement('span');
        mm_.setAttribute("class", 'wdform_colon');
		mm_.style.cssText = "font-style:bold; vertical-align:middle";
		mm_.innerHTML="&nbsp;:&nbsp;";
	td_time_input2_ket.appendChild(mm_);
		
	var ss = document.createElement('input');

           	ss.setAttribute("type", 'text');
           	ss.setAttribute("value", w_ss);
		
           	ss.setAttribute("class", "time_box");
		ss.setAttribute("id", id+"_ssform_id_temp");
		ss.setAttribute("name", id+"_ssform_id_temp");
		ss.setAttribute("onKeyPress", "return check_second(event, '"+id+"_ssform_id_temp')");
		ss.setAttribute("onKeyUp", "change_second(event, '"+id+"_ssform_id_temp')");
		ss.setAttribute("onBlur", "add_0('"+id+"_ssform_id_temp')");
	var ss_label = document.createElement('label');
           	ss_label.setAttribute("class", "mini_label");
		ss_label.innerHTML="SS";

	td_time_input3.appendChild(ss);
	td_time_label3.appendChild(ss_label);
	
	if(document.getElementById(id+'_am_pm_select'))
	{
		select_=document.getElementById(id+"_am_pm_select");
		select_text=document.getElementById(id+"_am_pm_label");
		
		time_box.insertBefore(td_time_input3, select_);
		time_box.insertBefore(td_time_input2_ket, td_time_input3);
		
		text_box.insertBefore(td_time_label3, select_text);
		text_box.insertBefore(td_time_label2_ket, td_time_label3);
	}
	else
	{
	time_box.appendChild(td_time_input2_ket);
	time_box.appendChild(td_time_input3);
	text_box.appendChild(td_time_label2_ket);
	text_box.appendChild(td_time_label3);
	}
  refresh_attr(id, 'type_time');
  jQuery(document).ready(function() {
		jQuery("label#"+id+"_mini_label_ss").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var ss = "<input type='text' class='ss' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(ss);
        jQuery("input.ss").focus();
        jQuery("input.ss").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+id+"_mini_label_ss").text(value);
        });
      }
    });
	});
}

function check_isnum_interval(e, id, from, to) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
    return false;
  }
  val = "" + document.getElementById(id).value+String.fromCharCode(chCode1);
	if (val.length > 2) {
    return false;
  }
  if (val == '00') {
    return false;
  }
  if ((val<from) || (val>to)) {
    return false;
  }
  return true;
}

function check_isnum_point(e) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 == 46) {
    return true;
  }
	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
    return false;
  }
  return true;
}

function check_isnum(e) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
    return false;
  }
	return true;
}

function check_isnum_or_minus(e) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 != 45 ) {
    if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
      return false;
    }
	}
	return true;
}

function change_w_style(id, w)
{
	if(document.getElementById(id))
	document.getElementById(id).style.width=w+"px";
}

function change_w_label(id, w)
{
	if(document.getElementById(id))
	document.getElementById(id).innerHTML=w;
}

function change_h_style(id, h)
{
	document.getElementById(id).style.height=h+"px";
}

function change_w(id, w)
{
	document.getElementById(id).setAttribute("width", w)
}

function change_h(id, h)
{
	document.getElementById(id).setAttribute("height", h);
}

function change_key(value, attribute)
{
	document.getElementById('wd_recaptchaform_id_temp').setAttribute(attribute, value);
}

function captcha_refresh(id)
{	
	srcArr=document.getElementById(id+"form_id_temp").src.split("&r=");
	document.getElementById(id+"form_id_temp").src=srcArr[0]+'&r='+Math.floor(Math.random()*100);
	document.getElementById(id+"_inputform_id_temp").value='';
}

function up_row(id)
{
	form=document.getElementById(id).parentNode;
	k=0;
	
	while(form.childNodes[k])
	{
		if(form.childNodes[k].getAttribute("id"))
			if(id==form.childNodes[k].getAttribute("id"))
				break;
		k++;
	}
	
	if(k!=0)
	{
		up=form.childNodes[k-1];
		down=form.childNodes[k];
		form.removeChild(down);
		form.insertBefore(down, up);
		return;
	}
	
		///////////en depqum yerb section breaka
	form_view_elemet		=form.parentNode.parentNode.parentNode.parentNode;
	
	current_tr		=form.parentNode.parentNode.parentNode;
	
	if(current_tr.previousSibling)
	if(current_tr.previousSibling.nodeType==3)
	{
		if(current_tr.previousSibling.previousSibling.getAttribute('type'))
		{
			current_tr.previousSibling.previousSibling.previousSibling.previousSibling.firstChild.firstChild.firstChild.appendChild(document.getElementById(id));
			return;
		}
	}
	else
	{
		if(current_tr.previousSibling.getAttribute('type'))
		{
			current_tr.previousSibling.previousSibling.firstChild.firstChild.firstChild.appendChild(document.getElementById(id));
			return;
		}
	}
	
				
			///////////pagei mej
			page_up(id);
}

function down_row(id)
{
	form=document.getElementById(id).parentNode;
	l=form.childNodes.length;
	k=0;
	while(form.childNodes[k])
	{
	if(id==form.childNodes[k].id)
		break;
	k++;
	}

	if(k!=l-1)
	{
	///////////ira mej
		up=form.childNodes[k];
		down=form.childNodes[k+2];
		form.removeChild(up);
		
		if(!down)
			down=null;

			form.insertBefore(up, down);
			return;
	}
	///////////en depqum yerb section breaka
	form_view_elemet		=form.parentNode.parentNode.parentNode.parentNode;
	
	current_tr		=form.parentNode.parentNode.parentNode;
	
	if(current_tr.nextSibling.nodeType==3)
	{
		if(current_tr.nextSibling.nextSibling.getAttribute('type'))
		{
			current_tr.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.firstChild.firstChild.appendChild(document.getElementById(id));
			return;
		}
	}
	else
	{
		if(current_tr.nextSibling.getAttribute('type'))
		{
			current_tr.nextSibling.nextSibling.firstChild.firstChild.firstChild.appendChild(document.getElementById(id));
			return;
		}
	}
	
				
			///////////pagei mej
	page_down(id);

}

function right_row(id)
{
	tr=document.getElementById(id);
	table_big=tr.parentNode.parentNode;
	td_big=tr.parentNode.parentNode.parentNode;
	if(table_big.nextSibling!=null)
	{
		td_next=table_big.nextSibling;
		td_next.firstChild.appendChild(tr);
	
	}
	else
	{
		
	    var new_td = document.createElement('td');
		new_td.setAttribute("valign", "top");
		
	    var new_table = document.createElement('table');
			new_table.setAttribute("class", "wdform_table2");
	    var new_tbody = document.createElement('tbody');
	
	   // tr_big.appendChild(new_td);
	
	    td_big.appendChild(new_table);
	
	    new_table.appendChild(new_tbody);
	
	    new_tbody.appendChild(tr);
	    
	}
	
	if(table_big.firstChild.firstChild==null)
		td_big.removeChild(table_big);
	
}

function left_row(id)
{
	tr=document.getElementById(id);
	td_big=tr.parentNode.parentNode.parentNode;
	table_big=tr.parentNode.parentNode;
	if(table_big.previousSibling!=null)
	{
		
		table_previous=table_big.previousSibling;
		table_previous.firstChild.appendChild(tr);
		
	if(table_big.firstChild.firstChild==null)
		td_big.removeChild(table_big);
	}
	
}

function page_up(id)
{
	form=document.getElementById(id).parentNode;
	
			form_view_elemet		=form.parentNode.parentNode.parentNode.parentNode;
			form_view_elemet_copy	=form.parentNode.parentNode.parentNode.parentNode;
			
			table=form_view_elemet.parentNode;
			
			//alert(table);
			
			while(table)
			{
				table=table.previousSibling;	
				while(table)
				{
					if(table.tagName=="TABLE")
						break;
					else
						table=table.previousSibling;
				}
				
				if(!table)
				{
					alert('Unable to move');
					return;
				}
				form_maker_remove_spaces(table);
				if(jQuery(table.firstChild).is(":visible"))
					break;
									
			}
		
		
			n=table.firstChild.childNodes.length;
			
			table.firstChild.childNodes[n-2].firstChild.firstChild.firstChild.appendChild(document.getElementById(id));
		
		/*	glob_n=form_view_elemet_copy.firstChild.firstChild.childNodes.length;
			for(i=0; i<glob_n; i++)
			{
				if(table.firstChild.firstChild.childNodes[i])
				{
					to_add=table.firstChild.firstChild.childNodes[i];
					to_add.firstChild.firstChild.appendChild(document.getElementById(id));
				}
				else
				{
					to_add=table.firstChild.firstChild.firstChild;
					to_add.firstChild.firstChild.appendChild(document.getElementById(id));
				}
			}*/
		
		
			refresh_pages(id);



	

}

function page_down(id)
{
	form=document.getElementById(id).parentNode;
	
			form_view_elemet		=form.parentNode.parentNode.parentNode.parentNode;
			form_view_elemet_copy	=form.parentNode.parentNode.parentNode.parentNode;
			
			table=form_view_elemet.parentNode;
			
			while(table)
			{			
				table=table.nextSibling;	
				
				while(table)
				{
					if(table.tagName=="TABLE")
						break;
					else
						table=table.nextSibling;
				}
							
				if(!table)
				{
					alert('Unable to move');
					return;
				}
					
				if(jQuery(table.firstChild).is(":visible"))
					break;									
			}
		
			n=table.firstChild.childNodes.length;
			
			table.firstChild.firstChild.firstChild.firstChild.firstChild.insertBefore(document.getElementById(id), table.firstChild.firstChild.firstChild.firstChild.firstChild.firstChild);
			refresh_pages(id);

}



function Disable() {
  select_ = document.getElementById('sel_el_pos');
  select_.setAttribute("disabled", "disabled");
  select_.innerHTML = "";
}

/**
 * Remove witespaces from childNodes.
 */
function form_maker_remove_spaces(parent) {
  if (!parent) {
    parent = document;
  }
  var children = parent.childNodes;
  for (var i = children.length - 1; i >= 0; i--) {
    var child = children[i];
    if (child.nodeType == 3) {
      if (child.data.match(/^\s+$/)) {
        parent.removeChild(child);
      }
    }
    else {
      form_maker_remove_spaces(child);
    }
  }
}

function Enable() {
  var pos = document.getElementsByName("el_pos");
  pos[0].setAttribute("checked", "checked");
  select_ = document.getElementById('sel_el_pos');
  select_.innerHTML = "";
  for (k = 1; k <= form_view_max; k++) {
    if (document.getElementById('form_id_tempform_view'+k)) {
      form_view_element = document.getElementById('form_id_tempform_view' + k);
      form_maker_remove_spaces(form_view_element);
      n=form_view_element.childNodes.length-2;
      for (z = 0; z <= n; z++) {
        if (!form_view_element.childNodes[z].id) {
          GLOBAL_tr = form_view_element.childNodes[z];
          for (x = 0; x < GLOBAL_tr.firstChild.childNodes.length; x++) {
            table = GLOBAL_tr.firstChild.childNodes[x];
            tbody = table.firstChild;
            for (y = 0; y < tbody.childNodes.length; y++) {
              tr = tbody.childNodes[y];
              var option = document.createElement('option');
              option.setAttribute("id", tr.id + "_sel_el_pos");
              option.setAttribute("value", tr.id);
              option.innerHTML = document.getElementById( tr.id + '_element_labelform_id_temp').innerHTML;
              select_.appendChild(option);
            }
          }
        }
      }
    }
  }
  select_.removeAttribute("disabled");
}

function all_labels() {
	labels=new Array();
	for(k=1;k<=form_view_max;k++)
		if(document.getElementById('form_id_tempform_view'+k))
		{
			form_view_element=document.getElementById('form_id_tempform_view'+k);
      form_maker_remove_spaces(form_view_element);
			n=form_view_element.childNodes.length-2;
			for(z=0;z<=n;z++)
			{
					if(!form_view_element.childNodes[z].id)
					{
						GLOBAL_tr=form_view_element.childNodes[z];
						
						for (x=0; x < GLOBAL_tr.firstChild.childNodes.length; x++)
						{
							table=GLOBAL_tr.firstChild.childNodes[x];
							tbody=table.firstChild;
							for (y=0; y < tbody.childNodes.length; y++)
							{
								tr=tbody.childNodes[y];
								labels.push( document.getElementById(tr.id+'_element_labelform_id_temp').innerHTML);
							}
						}
					}
			}
		}
	
	return labels;
}

function set_checked(id,j)
{
	checking=document.getElementById(id+"_elementform_id_temp"+j);
	if(checking.checked)
		checking.setAttribute("checked", "checked");
	if(!checking.checked)
	{
		checking.removeAttribute("checked");
		if(checking.getAttribute('other'))
			if(checking.getAttribute('other')==1)
			{
				if(document.getElementById(id+"_other_inputform_id_temp"))
				{
					document.getElementById(id+"_other_inputform_id_temp").parentNode.removeChild(document.getElementById(id+"_other_brform_id_temp"));
					document.getElementById(id+"_other_inputform_id_temp").parentNode.removeChild(document.getElementById(id+"_other_inputform_id_temp"));
				}
				return false;
			}
	}
	return true;
}

function set_default(id, j)
{
	for(k=0; k<100; k++)
		if(document.getElementById(id+"_elementform_id_temp"+k))
			if(!document.getElementById(id+"_elementform_id_temp"+k).checked)
				document.getElementById(id+"_elementform_id_temp"+k).removeAttribute("checked");
			else
				document.getElementById(id+"_elementform_id_temp"+j).setAttribute("checked", "checked");
	
	if(document.getElementById(id+"_other_inputform_id_temp"))
	{
		document.getElementById(id+"_other_inputform_id_temp").parentNode.removeChild(document.getElementById(id+"_other_brform_id_temp"));
		document.getElementById(id+"_other_inputform_id_temp").parentNode.removeChild(document.getElementById(id+"_other_inputform_id_temp"));
	}
}

function set_select(select_)
{
	for (p = select_.length - 1; p>=0; p--) 
	    if (select_.options[p].selected) 
		select_.options[p].setAttribute("selected", "selected");
	    else
  		select_.options[p].removeAttribute("selected");
}

function add_0(id)
{
	input=document.getElementById(id);
	if(input.value.length==1)
	{
		input.value='0'+input.value;
		input.setAttribute("value", input.value);
	}
}

function change_hour(ev, id, hour_interval)
{
	if(check_hour(ev, id, hour_interval))
	{
		input=document.getElementById(id);
		input.setAttribute("value", input.value);
	}
}

function change_minute(ev, id)
{
	if(check_minute(ev, id))
	{
		input=document.getElementById(id);
		input.setAttribute("value", input.value);
	}
}

function change_second(ev, id)
{
	if(check_second(ev, id))
	{
		input=document.getElementById(id);
		input.setAttribute("value", input.value);
	}
}

function check_hour(e, id, hour_interval)
{
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
	hour=""+document.getElementById(id).value+String.fromCharCode(chCode1);

	hour=parseFloat(hour);
	if((hour<0) || (hour>hour_interval))
        	return false;
	return true;
} 

function check_minute(e, id)
{	
		
	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
	minute=""+document.getElementById(id).value+String.fromCharCode(chCode1);

	minute=parseFloat(minute);
	if((minute<0) || (minute>59))
        	return false;
	return true;
} 

function check_second(e, id)
{	
		
	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
	second=""+document.getElementById(id).value+String.fromCharCode(chCode1);

	second=parseFloat(second);
	if((second<0) || (second>59))
        	return false;
	return true;
} 

function change_day(ev, id)
{
	if(check_day(ev, id))
	{
		input=document.getElementById(id);
		input.setAttribute("value", input.value);
	}
}

function change_month(ev, id)
{
	if(check_month(ev, id))
	{
		input=document.getElementById(id);
		input.setAttribute("value", input.value);
	}
}

function change_year(id)
{
	year=document.getElementById(id).value;
	
	from=parseFloat(document.getElementById(id).getAttribute('from'));
	to=parseFloat(document.getElementById(id).getAttribute('to'));
	
	year=parseFloat(year);
	
	if((year>=from) && (year<=to))
		document.getElementById(id).setAttribute("value", year);
	else
		document.getElementById(id).setAttribute("value", '');
}

function check_day(e, id)
{	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
	day=""+document.getElementById(id).value+String.fromCharCode(chCode1);

	if(day.length>2)
        	return false;
			
	if(day=='00')
        	return false;
			
	day=parseFloat(day);
	if((day<0) || (day>31))
        	return false;
	return true;
} 

function check_month(e, id)
{	
		
	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
	month=""+document.getElementById(id).value+String.fromCharCode(chCode1);
	
	if(month.length>2)
        	return false;
			
	if(month=='00')
        	return false;
			
	month=parseFloat(month);
	if((month<0) || (month>12))
        	return false;
	return true;
} 

function check_year2(id)
{
	year=document.getElementById(id).value;
	
	from=parseFloat(document.getElementById(id).getAttribute('from'));
	
	year=parseFloat(year);
	
	if(year<from)
	{
		document.getElementById(id).value='';
		alert('The value of "year" is not valid.');
	}
}

function check_year1(e, id)
{	
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;

	year=""+document.getElementById(id).value+String.fromCharCode(chCode1);
	
	to=parseFloat(document.getElementById(id).getAttribute('to'));
	
	year=parseFloat(year);
	
	if(year>to)
        	return false;
	return true;
} 

function label_top(num)
{	
	table=document.getElementById(num+'_elemet_tableform_id_temp');
	td1=document.getElementById(num+'_label_sectionform_id_temp');
	td2=document.getElementById(num+'_element_sectionform_id_temp');
    var table_t = document.createElement('tbody');
    var new_td1 = document.createElement('td');
    	new_td1 = td1;
    var new_td2 = document.createElement('td');
    	new_td2 = td2;
    var tr1 = document.createElement('tr');
    var tr2 = document.createElement('tr');
	//table.innerHTML=" ";
 while (table.firstChild)
      table.removeChild(table.firstChild);
    tr1.appendChild(new_td1);
    tr2.appendChild(new_td2);
    table_t.appendChild(tr1);
    table_t.appendChild(tr2);
    table.appendChild(table_t);
}

function label_left(num)
{
	table=document.getElementById(num+'_elemet_tableform_id_temp');
	td1=document.getElementById(num+'_label_sectionform_id_temp');
	td2=document.getElementById(num+'_element_sectionform_id_temp');
       var table_t = document.createElement('tbody');
    var new_td1 = document.createElement('td');
    	new_td1 = td1;
    var new_td2 = document.createElement('td');
    	new_td2 = td2;
    var tr = document.createElement('tr');
	//table.innerHTML=" ";
 while (table.firstChild)
      table.removeChild(table.firstChild);
    tr.appendChild(new_td1);
    tr.appendChild(new_td2);
    table_t.appendChild(tr);
    table.appendChild(table_t);
}

function delete_value(id)
{
	ofontStyle=document.getElementById(id).className;
	if(ofontStyle=="input_deactive")
	{
		document.getElementById(id).value="";
		destroyChildren(document.getElementById(id));
		document.getElementById(id).setAttribute("class", "input_active");
		document.getElementById(id).className='input_active';
	}
}

function return_value(id)
{
	input=document.getElementById(id);
	if(input.value=="")
	{
		input.value=input.title;
		input.className='input_deactive';
		input.setAttribute("class", 'input_deactive');
	}
}

function change_value(id)
{
	input=document.getElementById(id);
	 
	tag=input.tagName;
	if(tag=="TEXTAREA")
	{
// destroyChildren(input)
	input.innerHTML=input.value;
	}
	else
	input.setAttribute("value", input.value);

}

function change_input_value(first_value, id)
{	
	input=document.getElementById(id);
	input.title=first_value;
	
if( window.getComputedStyle ) 
{
  ofontStyle = window.getComputedStyle(input,null).fontStyle;
} else if( input.currentStyle ) {
  ofontStyle = input.currentStyle.fontStyle;
}
	if(ofontStyle=="italic")
	{	
		input.value=first_value;
		input.setAttribute("value", first_value);
	}
}

function change_file_value(destination, id, prefix , postfix )
{	
	if(typeof(prefix)=='undefined') {prefix=''; postfix=''};
	input=document.getElementById(id);
	input.value=prefix+destination+postfix;
	input.setAttribute("value", prefix+destination+postfix);
	
}

function close_window() {
  if (need_enable) {
    enable();
  }
  need_enable = true;
  document.getElementById('edit_table').innerHTML = "";
  document.getElementById('show_table').innerHTML = "";
  document.getElementById('main_editor').style.display = "none";
  if (document.getElementsByTagName("iframe")[id_ifr_editor]) {
    ifr_id = document.getElementsByTagName("iframe")[id_ifr_editor].id;
    ifr = getIFrameDocument(ifr_id);
    ifr.body.innerHTML = "";
  }
  document.getElementById('form_maker_editor').value = "";
  document.getElementById('editing_id').value = "";
  document.getElementById('element_type').value = "";
	alltypes = Array('customHTML', 'text', 'checkbox', 'radio', 'time_and_date', 'select', 'file_upload', 'captcha', 'map', 'button', 'page_break', 'section_break', 'survey');
  for (x = 0; x < 13; x++) {
    if (alltypes[x] != 'file_upload' && alltypes[x] != 'map')
      document.getElementById('img_' + alltypes[x]).parentNode.style.backgroundColor = '';
  }
}

function change_label(id, label) {
  document.getElementById(id).innerHTML = label;
  document.getElementById(id).value = label;
}

function change_label_1(id, label) {
  document.getElementById(id).value = label;
}

function change_func(id, label) {
  document.getElementById(id).setAttribute("onclick", label);
}

function change_in_value(id, label)
{
	document.getElementById(id).setAttribute("value", label);
}

function change_size(size, num)
{
	document.getElementById(num+'_elementform_id_temp').style.width=size+'px';
	if(document.getElementById(num+'_element_input'))
		document.getElementById(num+'_element_input').style.width=size+'px';
	switch(size)
	{
		case '111':
		{
			document.getElementById(num+'_elementform_id_temp').setAttribute("rows", "2"); break;
		}
		case '222':
		{
			document.getElementById(num+'_elementform_id_temp').setAttribute("rows", "4");break;
		}
		case '444':
		{
			document.getElementById(num+'_elementform_id_temp').setAttribute("rows", "8");break;
		}
	}
}

function add_choise(type, num) {
	j++;
	if (type=='radio' || type=='checkbox') {
		var choices_td = document.getElementById('choices');
		var br = document.createElement('br');
		br.setAttribute("id", "br"+j);
		var el_choices = document.createElement('input');
		el_choices.setAttribute("id", "el_choices"+j);
		el_choices.setAttribute("type", "text");
		el_choices.setAttribute("value", "");
		el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
		el_choices.setAttribute("onKeyUp", "change_label('"+num+"_label_element"+j+"', this.value); change_in_value('"+num+"_elementform_id_temp"+j+"', this.value)");
		var el_choices_remove = document.createElement('img');
    el_choices_remove.setAttribute("id", "el_choices"+j+"_remove");
    el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
    el_choices_remove.style.cssText =  'cursor:pointer;vertical-align:middle; margin:3px';
    el_choices_remove.setAttribute("align", 'top');
    el_choices_remove.setAttribute("onClick", "remove_choise('"+j+"','"+num+"','"+type+"')");
    choices_td.appendChild(br);
    choices_td.appendChild(el_choices);
    choices_td.appendChild(el_choices_remove);
		refresh_rowcol(num, type);
		if (type=='checkbox') {
			refresh_id_name(num, 'type_checkbox');
      refresh_attr(num, 'type_checkbox');
		}
		if (type == 'radio') {
			refresh_id_name(num, 'type_radio');
      refresh_attr(num, 'type_radio');
		}
	}
	if (type == 'select') {
		var select_ = document.getElementById(num+'_elementform_id_temp');
		var option = document.createElement('option');
    option.setAttribute("id", num+"_option"+j);
    select_.appendChild(option);
		var choices_td= document.getElementById('choices');
		var br = document.createElement('br');
		br.setAttribute("id", "br"+j);
		var el_choices = document.createElement('input');
    el_choices.setAttribute("id", "el_option"+j);
    el_choices.setAttribute("type", "text");
    el_choices.setAttribute("value", "");
    el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
    el_choices.setAttribute("onKeyUp", "change_label('"+num+"_option"+j+"', this.value)");
		var el_choices_remove = document.createElement('img');
    el_choices_remove.setAttribute("id", "el_option"+j+"_remove");
    el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
    el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
    el_choices_remove.setAttribute("align", 'top');
    el_choices_remove.setAttribute("onClick", "remove_option('"+j+"','"+num+"')");
		var el_choices_dis = document.createElement('input');
    el_choices_dis.setAttribute("type", 'checkbox');
    el_choices_dis.setAttribute("id", "el_option"+j+"_dis");
    el_choices_dis.setAttribute("onClick", "dis_option('"+num+"_option"+j+"', this.checked)");
    el_choices_dis.style.cssText = "vertical-align: middle; margin-left:24px; margin-right:24px;";
    choices_td.appendChild(br);
    choices_td.appendChild(el_choices);
    choices_td.appendChild(el_choices_dis);
    choices_td.appendChild(el_choices_remove);
  }
}

function refresh_rowcol(num, type) {
  if (document.getElementById('edit_for_rowcol').value) {
    document.getElementById(num+'_rowcol_numform_id_temp').value = document.getElementById('edit_for_rowcol').value;
    var table = document.getElementById(num+'_table_little');
    table.removeAttribute("for_hor");
		table.innerHTML = "";
    var choeices = 0;
    if (document.getElementById('edit_for_flow_vertical').checked == true) {
      var columns = document.getElementById('edit_for_rowcol').value;
      for (i = 0; i <= 100; i++) {
        if (document.getElementById('el_choices' + i)) {
          choeices++;
        }
      }
      element = 'input';
      rows = parseInt((choeices + 1) / columns);
      var gago = 0;
			var vaxo = 1;
			var tr_row = document.createElement('tr');
  		tr_row.setAttribute("id", num+"_element_tr0");
			for (i=0;i<=100;i++)	{
				if (document.getElementById('el_choices'+i)) {									
					if (gago >= columns) {
            gago=0;
            var tr_row = document.createElement('tr');
            tr_row.setAttribute("id", num+"_element_tr"+vaxo);	
            vaxo++;
					}
          var td = document.createElement('td');
          td.setAttribute("valign", "top");
          td.setAttribute("id", num+"_td_little"+i);
          td.setAttribute("idi", i);
							var adding = document.createElement(element);
							adding.setAttribute("type", type);
							adding.setAttribute("value", document.getElementById("el_choices"+i).value);
							adding.setAttribute("id", num+"_elementform_id_temp"+i);
							if(type=='checkbox')
							{
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onclick", "if(set_checked('"+num+"','"+i+"','form_id_temp')) show_other_input('"+num+"','form_id_temp');");
								}
								else
									adding.setAttribute("onclick", "set_checked('"+num+"','"+i+"','form_id_temp')");
		
									adding.setAttribute("name", num+"_elementform_id_temp"+i);
							}
								
							if(type=='radio')
							{
							adding.setAttribute("name", num+"_elementform_id_temp");
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp'); show_other_input('"+num+"','form_id_temp');");
									
								}
								else
								adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp')");
							}
							
							
							
							var label_adding = document.createElement('label');
								label_adding.setAttribute("id", num+"_label_element"+i);
								label_adding.setAttribute("class", "ch_rad_label");
								label_adding.setAttribute("for",num+"_elementform_id_temp"+i);
								label_adding.innerHTML=document.getElementById("el_choices"+i).value;
								
								td.appendChild(adding);
								td.appendChild(label_adding);
								
							tr_row.appendChild(td);	
							table.appendChild(tr_row);	
					
					
					gago++;
					
			
				}
			

			
			}

			
		  }

	else{

			var rows = document.getElementById('edit_for_rowcol').value;

			for(i=0;i<=100;i++)	
			{
				if(document.getElementById('el_choices'+i))
				choeices++;
			} 

			element='input';
			columns = parseInt((choeices+1)/rows);

			
			var gago=0;
			var vaxo=0;
			for(i=0;i<=100;i++)	
			{
				if(document.getElementById('el_choices'+i))
				{
			
					if(gago < rows)
					{
						var tr_row = document.createElement('tr');
							tr_row.setAttribute("id", num+"_element_tr"+i);
							
					}
					  
							var td = document.createElement('td');
								td.setAttribute("valign", "top");
								td.setAttribute("id", num+"_td_little"+i);
								td.setAttribute("idi", i);
							
							
							var adding = document.createElement(element);
							adding.setAttribute("type", type);
							adding.setAttribute("value", document.getElementById("el_choices"+i).value);
							adding.setAttribute("id", num+"_elementform_id_temp"+i);
							if(type=='checkbox')
							{
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onclick", "if(set_checked('"+num+"','"+i+"','form_id_temp')) show_other_input('"+num+"','form_id_temp');");
								}
								else
									adding.setAttribute("onclick", "set_checked('"+num+"','"+i+"','form_id_temp')");
		
									adding.setAttribute("name", num+"_elementform_id_temp"+i);
							}
								
							if(type=='radio')
							{
							adding.setAttribute("name", num+"_elementform_id_temp");
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp'); show_other_input('"+num+"','form_id_temp')");
									
								}
								else
								adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp')");
							}
							
							var label_adding = document.createElement('label');
								label_adding.setAttribute("id", num+"_label_element"+i);
								label_adding.setAttribute("class", "ch_rad_label");
								label_adding.setAttribute("for",num+"_elementform_id_temp"+i);
								label_adding.innerHTML=document.getElementById("el_choices"+i).value;
								td.appendChild(adding);
								td.appendChild(label_adding);
						
						
							if(gago < rows)
							{
							tr_row.appendChild(td);	
							table.appendChild(tr_row);
							}
							else
							{
							if(vaxo==rows)
							vaxo=0;
							tr_row = document.getElementById(num+'_table_little').childNodes[vaxo];
							tr_row.appendChild(td);	
							vaxo++;
							}					
								
							
							gago++;
						
					
					
					
			
				}
			

			
			}
			table.setAttribute("for_hor", num+"_hor");
		}
	}
else
{
document.getElementById(num+'_rowcol_numform_id_temp').value = '';

	var table = document.getElementById(num+'_table_little');
		table.innerHTML="";
	
	var tr0 = document.createElement('tr');
		tr0.setAttribute("id", num+"_hor");
		
		
		for(i=0;i<=100;i++)	
			{
				if(document.getElementById('el_choices'+i))
				{
		
		element='input';
	
	  if(document.getElementById('edit_for_flow_vertical').checked==true)
	  {
		var tr = document.createElement('tr');
			tr.setAttribute("id", num+"_element_tr"+i);
		var td = document.createElement('td');
			td.setAttribute("valign", "top");
			td.setAttribute("id", num+"_td_little"+i);
			td.setAttribute("idi", i);
		
		var adding = document.createElement(element);
		adding.setAttribute("type", type);
		adding.setAttribute("value", document.getElementById("el_choices"+i).value);
		adding.setAttribute("id", num+"_elementform_id_temp"+i);
		if(type=='checkbox')
							{
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onclick", "if(set_checked('"+num+"','"+i+"','form_id_temp')) show_other_input('"+num+"','form_id_temp');");
								}
								else
									adding.setAttribute("onclick", "set_checked('"+num+"','"+i+"','form_id_temp')");
		
									adding.setAttribute("name", num+"_elementform_id_temp"+i);
							}
								
							if(type=='radio')
							{
							adding.setAttribute("name", num+"_elementform_id_temp");
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp'); show_other_input('"+num+"','form_id_temp')");
									
								}
								else
								adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp')");
							}
		
		
		var label_adding = document.createElement('label');
			label_adding.setAttribute("id", num+"_label_element"+i);
			label_adding.setAttribute("class", "ch_rad_label");
			label_adding.setAttribute("for",num+"_elementform_id_temp"+i);
			label_adding.innerHTML=document.getElementById("el_choices"+i).value;
		    td.appendChild(adding);
		    td.appendChild(label_adding);
		    tr.appendChild(td);
			table.appendChild(tr);
			}
			
		else
		{
			var td = document.createElement('td');
				td.setAttribute("valign", "top");
				td.setAttribute("id", num+"_td_little"+i);
				td.setAttribute("idi", i);
			
			var adding = document.createElement(element);
				adding.setAttribute("type", type);
				adding.setAttribute("value", document.getElementById("el_choices"+i).value);
				adding.setAttribute("id", num+"_elementform_id_temp"+i);
			
						if(type=='checkbox')
							{
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onclick", "if(set_checked('"+num+"','"+i+"','form_id_temp')) show_other_input('"+num+"','form_id_temp');");
								}
								else
									adding.setAttribute("onclick", "set_checked('"+num+"','"+i+"','form_id_temp')");
		
									adding.setAttribute("name", num+"_elementform_id_temp"+i);
							}
								
							if(type=='radio')
							{
							adding.setAttribute("name", num+"_elementform_id_temp");
								if(document.getElementById(num+"_allow_otherform_id_temp").value=="yes" && document.getElementById("el_choices"+i).getAttribute('other')=='1')
								{
									adding.setAttribute("other", "1");
									adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp'); show_other_input('"+num+"','form_id_temp')");	
								}
								else
								adding.setAttribute("onClick", "set_default('"+num+"','"+i+"','form_id_temp')");
							}
			
			
			var label_adding = document.createElement('label');
				label_adding.setAttribute("id", num+"_label_element"+i);
				label_adding.setAttribute("class", "ch_rad_label");
				label_adding.setAttribute("for",num+"_elementform_id_temp"+i);
				label_adding.innerHTML=document.getElementById("el_choices"+i).value;
				
				td.appendChild(adding);
				td.appendChild(label_adding);
				tr0.appendChild(td);
				table.appendChild(tr0);
		}
		    }
		}
}
}

function remove_choise(id, num, type) {
  var choices_td= document.getElementById('choices');
  var el_choices = document.getElementById('el_choices'+id);
  var el_choices_remove = document.getElementById('el_choices'+id+'_remove');
  var br = document.getElementById('br'+id);
  choices_td.removeChild(el_choices);
  choices_td.removeChild(el_choices_remove);
  choices_td.removeChild(br);
  refresh_rowcol(num, type);
  refresh_id_name(num, document.getElementById(num+'_typeform_id_temp').value );
}

function add_grading_items(num){
	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_items"+i))
		 {
			break;
		 }
	}	

	 m=i+1;
  
	var choices_td= document.getElementById("items");
	
		var br = document.createElement('br');
		br.setAttribute("id", "britems"+m);
		var el_choices = document.createElement('input');
		el_choices.setAttribute("id", "el_items"+m);
		el_choices.setAttribute("type", "text");
		el_choices.setAttribute("value", "");
		el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
		el_choices.setAttribute("onKeyUp", "change_label('"+num+"_label_elementform_id_temp"+m+"', this.value); change_in_value('"+num+"_label_elementform_id_temp"+m+"', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_items"+m+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_choices_remove.style.cssText =  'cursor:pointer;vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_grading_items('"+m+"','"+num+"')");
	
	    choices_td.appendChild(br);
	    choices_td.appendChild(el_choices);
	    choices_td.appendChild(el_choices_remove);
	
	
refresh_grading_items(num);
refresh_id_name(num, 'type_grading');

}

function sum_grading_values(a,b){} 

function refresh_grading_items(num){

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_items"+i))
		 {
			break;
		 }
	}	
	 m=i;

	
var div = document.getElementById(num+'_elementform_id_temp');
	div.innerHTML='';
    

for(i=0;i<=m;i++)
{

	if(document.getElementById("el_items"+i))
	{
	
		var div_grading = document.createElement('div');
			div_grading.setAttribute("id", num+"_element_div"+i);
			div_grading.setAttribute("class", "grading");
	
		
		var input_item = document.createElement('input');
				input_item.setAttribute("id", num+"_elementform_id_temp"+i);
				input_item.setAttribute("name", num+"_elementform_id_temp"+i);
				input_item.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
				input_item.setAttribute("value", "");					
                input_item.setAttribute("size", "5");					
				input_item.setAttribute("onKeyUp", "sum_grading_values("+num+",'form_id_temp')");
				input_item.setAttribute("onChange", "sum_grading_values("+num+",'form_id_temp')");
				
		var label_item = document.createElement('label');
				label_item.setAttribute("id", num+"_label_elementform_id_temp"+i);
				label_item.setAttribute("class", "ch_rad_label");
				//label_item.setAttribute("for",num+"_elementform_id_temp"+i);	
				label_item.innerHTML = document.getElementById("el_items"+i).value;	
	  

		div_grading.appendChild(input_item);	
		div_grading.appendChild(label_item);
		div.appendChild(div_grading);
		
	}   
	
}
        var div_total = document.createElement('div');
			div_total.setAttribute("id", num+"_element_total_divform_id_temp");
			div_total.setAttribute("class", "grading_div");
		var Total = document.createTextNode("Total:");	
		var Seperator = document.createTextNode("/");	
		
		var span_total = document.createElement('span');
			span_total.setAttribute("id", num+"_total_elementform_id_temp");
			span_total.setAttribute("name", num+"_total_elementform_id_temp");
			span_total.innerHTML = document.getElementById(num+'_grading_totalform_id_temp').value;
		
		var span_gum = document.createElement('span');
			span_gum.setAttribute("id", num+"_sum_elementform_id_temp");	
			span_gum.setAttribute("name", num+"_sum_elementform_id_temp");	
			span_gum.innerHTML = 0;
 		 
		var span_of_text = document.createElement('span');
			span_of_text.setAttribute("id", num+"_text_elementform_id_temp");	
			span_of_text.setAttribute("name", num+"_text_elementform_id_temp");	
			span_of_text.innerHTML = "";
		 
	    div_total.appendChild(Total);
		div_total.appendChild(span_gum);
		div_total.appendChild(Seperator);
		div_total.appendChild(span_total);
		div_total.appendChild(span_of_text);
        div.appendChild(div_total);
                   
}

function remove_grading_items(id, num){
		var choices_td= document.getElementById("items");
		
		var el_choices = document.getElementById('el_items'+id);
		var el_choices_remove = document.getElementById('el_items'+id+'_remove');
		var br = document.getElementById('britems'+id);
		
		choices_td.removeChild(el_choices);
		choices_td.removeChild(el_choices_remove);
		choices_td.removeChild(br);

refresh_grading_items(num);
refresh_id_name(num, 'type_grading');
}




function add_to_matrix(type, num){
	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_rows"+i))
		 {
			break;
		 }
	}	
if(type=="rows")
{
	 m=i+1;
} 
else
	 m=i;

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_columns"+i))
		 {
			break;
		 }
	}	
if(type=="columns")
{
	 n=i+1;
} 
else
n=i;
	
	 
 
	var choices_td= document.getElementById(type);
	if(type=="rows")
	{
		var br = document.createElement('br');
		br.setAttribute("id", "br"+type+m);
		var el_choices = document.createElement('input');
		el_choices.setAttribute("id", "el_"+type+m);
		el_choices.setAttribute("type", "text");
		el_choices.setAttribute("value", "");
		el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
		el_choices.setAttribute("onKeyUp", "change_label('"+num+"_label_elementform_id_temp"+m+"_0', this.value); change_in_value('"+num+"_label_elementform_id_temp"+m+"_0', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_"+type+m+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_choices_remove.style.cssText =  'cursor:pointer;vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_rowcols('"+m+"','"+num+"','"+type+"')");
	
	    choices_td.appendChild(br);
	    choices_td.appendChild(el_choices);
	    choices_td.appendChild(el_choices_remove);
	}
	else
	{
		var br = document.createElement('br');
			br.setAttribute("id", "br"+type+n);
		var el_choices = document.createElement('input');
			el_choices.setAttribute("id", "el_"+type+n);
			el_choices.setAttribute("type", "text");
			el_choices.setAttribute("value", "");
			el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_choices.setAttribute("onKeyUp", "change_label('"+num+"_label_elementform_id_temp"+"0_"+n+"', this.value); change_in_value('"+num+"_label_elementform_id_temp"+"0_"+n+"', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_"+type+n+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_choices_remove.style.cssText =  'cursor:pointer;vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_rowcols('"+n+"','"+num+"','"+type+"')");
	
			choices_td.appendChild(br);
			choices_td.appendChild(el_choices);
			choices_td.appendChild(el_choices_remove);

	}	
refresh_matrix(num);


}


function refresh_matrix(num){

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_rows"+i))
		 {
			break;
		 }
	}	
	 m=i;

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_columns"+i))
		 {
			break;
		 }
	}	
	n=i;
	
	



var table = document.getElementById(num+'_table_little');
	table.innerHTML='';

	
		var tr0 = document.createElement('tr');
			tr0.setAttribute("id", num+"_element_tr0");
		
		table.appendChild(tr0);
		
		var td0 = document.createElement('td');
			td0.setAttribute("id", num+"_element_td0_0");		
			td0.innerHTML="";		
		tr0.appendChild(td0);


		for(k=1;k<=n;k++)
		{
			if(document.getElementById("el_columns"+k))
			{
			
				var td = document.createElement('td');
					td.setAttribute("id", num+"_element_td0_"+k);	
					td.setAttribute("class", "matrix_");

					
				var label_column = document.createElement('label');
						label_column.setAttribute("id", num+"_label_elementform_id_temp"+"0_"+k);
						label_column.setAttribute("name", num+"_label_elementform_id_temp"+"0_"+k);
						label_column.setAttribute("class", "ch_rad_label");
						label_column.setAttribute("for",num+"_elementform_id_temp"+k);	
						label_column.innerHTML=document.getElementById("el_columns"+k).value;	
                
			
						
						td.appendChild(label_column);
							
						tr0.appendChild(td);
						
						
			}
		}
		
                    

for(i=1;i<=m;i++)
{

	if(document.getElementById("el_rows"+i))
	{
		var tr = document.createElement('tr');
			tr.setAttribute("id", num+"_element_tr"+i);
		var td0 = document.createElement('td');
			td0.setAttribute("id", num+"_element_td"+i+"_0");		
			td0.setAttribute("class", "matrix_");	
			
		var label_row = document.createElement('label');
				label_row.setAttribute("id", num+"_label_elementform_id_temp"+i+"_0");
				label_row.setAttribute("class", "ch_rad_label");
				label_row.setAttribute("for",num+"_elementform_id_temp"+i);	
				label_row.innerHTML=document.getElementById("el_rows"+i).value;	
		
       

		
		td0.appendChild(label_row);	
		tr.appendChild(td0);
		
		table.appendChild(tr);
		
		for(k=1;k<=n;k++)
		{
			if(document.getElementById("el_columns"+k))
			{
				
				var td = document.createElement('td');
					td.setAttribute("id", num+"_element_td"+i+"_"+k);	
					td.style.cssText =   "text-align:center";

										
					

							
		if(document.getElementById("edit_for_select_input_type").value=="select"){
					var select_yes_no = document.createElement('select');
					    select_yes_no.setAttribute("id", num+"_select_yes_noform_id_temp"+i+"_"+k);
						select_yes_no.setAttribute("name", num+"_select_yes_noform_id_temp"+i+"_"+k);
					var option_yes_no1 = document.createElement('option');
						option_yes_no1.setAttribute("value", "");
                    Nothing = document.createTextNode(" ");
					
					var option_yes_no2 = document.createElement('option');
						option_yes_no2.setAttribute("value", "yes");
                    Yes = document.createTextNode("Yes");
					
					var option_yes_no3 = document.createElement('option');
						option_yes_no3.setAttribute("value", "no");
                    No = document.createTextNode("No");
                
				        option_yes_no1.appendChild(Nothing);
					    option_yes_no2.appendChild(Yes);
					    option_yes_no3.appendChild(No);
                        select_yes_no.appendChild(option_yes_no1);
					    select_yes_no.appendChild(option_yes_no2);
					    select_yes_no.appendChild(option_yes_no3);
					    td.appendChild(select_yes_no);
					}			
					else{		
					var input_of_matrix = document.createElement('input');
							input_of_matrix.setAttribute("id", num+"_input_elementform_id_temp"+i+"_"+k);
							input_of_matrix.setAttribute("align", "center"); 
							input_of_matrix.setAttribute("size", "14"); 							
							
							input_of_matrix.setAttribute("type", document.getElementById("edit_for_select_input_type").value);	
									
						
                    if(document.getElementById("edit_for_select_input_type").value=="radio"){
					   input_of_matrix.setAttribute("name", num+"_input_elementform_id_temp"+i);
					   input_of_matrix.setAttribute("value", i+"_"+k);
					   }
					else {
					    if(document.getElementById("edit_for_select_input_type").value=="checkbox"){
                          input_of_matrix.setAttribute("name", num+"_input_elementform_id_temp"+i+"_"+k);
                          input_of_matrix.setAttribute("value", 1);
					    }
					    else{
					      input_of_matrix.setAttribute("name", num+"_input_elementform_id_temp"+i+"_"+k);
                          input_of_matrix.setAttribute("value", '');
					    }
					}
							td.appendChild(input_of_matrix);
							
							}
						
								
				tr.appendChild(td);
			}
		}
	}   
}
               
}

function remove_rowcols(id, num, type)
{
		var choices_td= document.getElementById(type);
		
		var el_choices = document.getElementById('el_'+type+id);
		var el_choices_remove = document.getElementById('el_'+type+id+'_remove');
		var br = document.getElementById('br'+type+id);
		
		choices_td.removeChild(el_choices);
		choices_td.removeChild(el_choices_remove);
		choices_td.removeChild(br);

refresh_matrix(num);
}

function remove_option(id, num) {
  var select_ = document.getElementById(num+'_elementform_id_temp');
  var option = document.getElementById(num+'_option'+id);
  select_.removeChild(option);
  var choices_td= document.getElementById('choices');
  var el_choices = document.getElementById('el_option'+id);
  var el_choices_dis = document.getElementById('el_option'+id+'_dis');
  var el_choices_remove = document.getElementById('el_option'+id+'_remove');
  var br = document.getElementById('br'+id);
  choices_td.removeChild(el_choices);
  choices_td.removeChild(el_choices_dis);
  choices_td.removeChild(el_choices_remove);
  choices_td.removeChild(br);
}

function getIFrameDocument(aID) { 
  var rv = null;
  // If contentDocument exists, W3C compliant (Mozilla).
  if (document.getElementById(aID).contentDocument) {
    rv = document.getElementById(aID).contentDocument; 
  }
  else {
    // IE.
    rv = document.frames[aID].document;
  } 
  return rv; 
}

function delete_last_child() {
  if (document.getElementsByTagName("iframe")[id_ifr_editor]) {
    ifr_id = document.getElementsByTagName("iframe")[id_ifr_editor].id;
    ifr = getIFrameDocument(ifr_id);
    ifr.body.innerHTML = "";
  }
	document.getElementById('main_editor').style.display = "none";
	document.getElementById('form_maker_editor').value = "";
	if (document.getElementById('show_table').lastChild) {
		var del1 = document.getElementById('show_table').lastChild;
		var del2 = document.getElementById('edit_table').lastChild;
		var main1 = document.getElementById('show_table');
		var main2 = document.getElementById('edit_table');
		main1.removeChild(del1);
		main2.removeChild(del2);
	}
}

function format_12(num, am_or_pm, w_hh, w_mm, w_ss) {
  tr_time1 = document.getElementById(num+'_tr_time1')
  tr_time2 = document.getElementById(num+'_tr_time2')
  var td1 = document.createElement('td');
  td1.setAttribute("id", num+"_am_pm_select");
  td1.setAttribute("class", "td_am_pm_select");
  var td2 = document.createElement('td');
  td2.setAttribute("id", num+"_am_pm_label");
  td2.setAttribute("class", "td_am_pm_select");
  var am_pm_select = document.createElement('select');
  am_pm_select.setAttribute("class", "am_pm_select");
  am_pm_select.setAttribute("name",  num+"_am_pmform_id_temp");
  am_pm_select.setAttribute("id",  num+"_am_pmform_id_temp");
  am_pm_select.setAttribute("onchange", "set_sel_am_pm(this)");
  var am_option = document.createElement('option');
  am_option.setAttribute("value", "am");
  am_option.innerHTML = "AM";
  var pm_option = document.createElement('option');
  pm_option.setAttribute("value", "pm");
  pm_option.innerHTML = "PM";
  if (am_or_pm == "pm") {
    pm_option.setAttribute("selected", "selected");
  }
  else {
    am_option.setAttribute("selected", "selected");
  }
  var am_pm_label = document.createElement('label');
  am_pm_label.setAttribute("class", "mini_label");
  am_pm_label.setAttribute("id", num+"_mini_label_am_pm");
  am_pm_label.innerHTML=w_mini_labels[3];
  am_pm_select.appendChild(am_option);
  am_pm_select.appendChild(pm_option);
  td1.appendChild(am_pm_select);
  td2.appendChild(am_pm_label);
  tr_time1.appendChild(td1);
  tr_time2.appendChild(td2);
  document.getElementById(num+'_hhform_id_temp').setAttribute("onKeyPress", "return check_hour(event, '"+num+"_hhform_id_temp',"+"'12'"+")");
  document.getElementById(num+'_hhform_id_temp').value=w_hh;
  document.getElementById(num+'_mmform_id_temp').value=w_mm;
  if (document.getElementById(num + '_ssform_id_temp')) {
    document.getElementById(num+'_ssform_id_temp').value = w_ss;
  }
  refresh_attr(num, 'type_time');
  jQuery(document).ready(function() {
    jQuery("label#"+num+"_mini_label_am_pm").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var am_pm = "<input type='text' class='am_pm' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(am_pm);				
        jQuery("input.am_pm").focus();
        jQuery("input.am_pm").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+num+"_mini_label_am_pm").text(value);
        });
      }	
    });		
	});	
}

function format_24(num) {
  tr_time1 = document.getElementById(num+'_tr_time1')
  td1 = document.getElementById(num+'_am_pm_select')
  tr_time2 = document.getElementById(num+'_tr_time2')
  td2 = document.getElementById(num+'_am_pm_label')
  tr_time1.removeChild(td1);
  tr_time2.removeChild(td2);
  document.getElementById(num+'_hhform_id_temp').setAttribute("onKeyPress", "return check_hour(event, '"+num+"_hhform_id_temp', '23')");
  document.getElementById(num+'_hhform_id_temp').value="";
  document.getElementById(num+'_mmform_id_temp').value="";
  if (document.getElementById(num + '_ssform_id_temp')) {
    document.getElementById(num + '_ssform_id_temp').value = "";
  }
}

function format_extended(num) {
  w_size=document.getElementById(num+'_element_firstform_id_temp').style.width;
  tr_name1 = document.getElementById(num+'_tr_name1');
  tr_name2 = document.getElementById(num+'_tr_name2');
  var td_name_input1 = document.createElement('td');
  td_name_input1.setAttribute("id", num+"_td_name_input_title");
  var td_name_input4 = document.createElement('td');
  td_name_input4.setAttribute("id", num+"_td_name_input_middle");
  var td_name_label1 = document.createElement('td');
  td_name_label1.setAttribute("id", num+"_td_name_label_title");
  td_name_label1.setAttribute("align", "left");
  var td_name_label4 = document.createElement('td');
  td_name_label4.setAttribute("id", num+"_td_name_label_middle");
  td_name_label4.setAttribute("align", "left");
  var title = document.createElement('input');
  title.setAttribute("type", 'text');
  title.setAttribute("class", "input_deactive");
  title.style.cssText = "margin: 0px 10px 0px 0px; padding: 0px; width:40px";
  title.setAttribute("id", num+"_element_titleform_id_temp");
  title.setAttribute("name", num+"_element_titleform_id_temp");
  title.setAttribute("value", '');
  title.setAttribute("title", '');
  title.setAttribute("onFocus", 'delete_value("'+num+'_element_titleform_id_temp")');
  title.setAttribute("onBlur", 'return_value("'+num+'_element_titleform_id_temp")');
  title.setAttribute("onChange", "change_value('"+num+"_element_titleform_id_temp')");
  var title_label = document.createElement('label');
  title_label.setAttribute("class", "mini_label");
  title_label.setAttribute("id", num+"_mini_label_title");
  title_label.innerHTML= w_mini_labels[0];
  var middle = document.createElement('input');
  middle.setAttribute("type", 'text');
  middle.setAttribute("class", "input_deactive");
  middle.style.cssText = "padding: 0px; width:"+w_size;
  middle.setAttribute("id", num+"_element_middleform_id_temp");
  middle.setAttribute("name", num+"_element_middleform_id_temp");
  middle.setAttribute("value", '');
  middle.setAttribute("title", '');
  middle.setAttribute("onFocus", 'delete_value("'+num+'_element_middleform_id_temp")');
  middle.setAttribute("onBlur", 'return_value("'+num+'_element_middleform_id_temp")');
  middle.setAttribute("onChange", "change_value('"+num+"_element_middleform_id_temp')");
  var middle_label = document.createElement('label');
  middle_label.setAttribute("class", "mini_label");
  middle_label.setAttribute("id", num+"_mini_label_middle");
  middle_label.innerHTML=w_mini_labels[3];
  first_input = document.getElementById(num+'_td_name_input_first');
  last_input = document.getElementById(num+'_td_name_input_last');
  first_label = document.getElementById(num+'_td_name_label_first');
  last_label = document.getElementById(num+'_td_name_label_last');
  td_name_input1.appendChild(title);
  td_name_input4.appendChild(middle);
  tr_name1.insertBefore(td_name_input1, first_input);
  tr_name1.insertBefore(td_name_input4, null);
  td_name_label1.appendChild(title_label);
  td_name_label4.appendChild(middle_label);
  tr_name2.insertBefore(td_name_label1, first_label);
  tr_name2.insertBefore(td_name_label4, null);
  var gic1 = document.createTextNode("-");
  var gic2 = document.createTextNode("-");
  var el_first_value_title = document.createElement('input');
  el_first_value_title.setAttribute("id", "el_first_value_title");
  el_first_value_title.setAttribute("type", "text");
  el_first_value_title.setAttribute("value", '');
  el_first_value_title.style.cssText = "width:50px; margin-left:4px; margin-right:4px";
  el_first_value_title.setAttribute("onKeyUp", "change_input_value(this.value,'"+num+"_element_titleform_id_temp')");
  var el_first_value_middle = document.createElement('input');
  el_first_value_middle.setAttribute("id", "el_first_value_middle");
  el_first_value_middle.setAttribute("type", "text");
  el_first_value_middle.setAttribute("value", '');
  el_first_value_middle.style.cssText = "width:100px; margin-left:4px";
  el_first_value_middle.setAttribute("onKeyUp", "change_input_value(this.value,'"+num+"_element_middleform_id_temp')");
  el_first_value_first = document.getElementById('el_first_value_first');
  parent=el_first_value_first.parentNode;
  parent.insertBefore(gic1, el_first_value_first);
  parent.insertBefore(el_first_value_title, gic1);
  parent.appendChild(gic2);
  parent.appendChild(el_first_value_middle);
  refresh_attr(num, 'type_name');
  jQuery(document).ready(function() {
    jQuery("label#"+num+"_mini_label_title").click(function() {
      if (jQuery(this).children('input').length == 0) {				
        var title = "<input type='text' class='title' size='10' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(title);				
        jQuery("input.title").focus();
        jQuery("input.title").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+num+"_mini_label_title").text(value);
        });
      }
    });
    jQuery("label#"+num+"_mini_label_middle").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var middle = "<input type='text' class='middle'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(middle);
        jQuery("input.middle").focus();
        jQuery("input.middle").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+num+"_mini_label_middle").text(value);
        });
      }
    });
	});
}

function format_normal(num) {
  tr_name1 = document.getElementById(num + '_tr_name1');
  tr_name2 = document.getElementById(num + '_tr_name2');
  td_name_input1 = document.getElementById(num + '_td_name_input_title');
  td_name_input4 = document.getElementById(num + '_td_name_input_middle');
  td_name_label1 = document.getElementById(num + '_td_name_label_title');
  td_name_label4 =document.getElementById(num + '_td_name_label_middle');		
  tr_name1.removeChild(td_name_input1);
  tr_name1.removeChild(td_name_input4);
  tr_name2.removeChild(td_name_label1);
  tr_name2.removeChild(td_name_label4);
  el_first_value_first = document.getElementById('el_first_value_first');
  parent = el_first_value_first.parentNode;
  parent.removeChild( document.getElementById('el_first_value_title').nextSibling);
  parent.removeChild( document.getElementById('el_first_value_title'));
  parent.removeChild( document.getElementById('el_first_value_middle').previousSibling);
  parent.removeChild( document.getElementById('el_first_value_middle'));
}

function type_section_break(i, w_editor) {
  var pos=document.getElementsByName("el_pos");
  pos[0].setAttribute("disabled", "disabled");
  pos[1].setAttribute("disabled", "disabled");
  pos[2].setAttribute("disabled", "disabled");
	var sel_el_pos=document.getElementById("sel_el_pos");
  sel_el_pos.setAttribute("disabled", "disabled");
  document.getElementById("element_type").value="type_section_break";
	delete_last_child();
  // Edit table.
	oElement = document.getElementById('table_editor');
	var iReturnTop = 0;
	var iReturnLeft = 0;
	while (oElement != null) {
    iReturnTop += oElement.offsetTop;
    iReturnLeft += oElement.offsetLeft;
    oElement = oElement.offsetParent;
  }
  document.getElementById('main_editor').style.display="block";
  document.getElementById('main_editor').style.left=iReturnLeft + 195 + "px";
  document.getElementById('main_editor').style.top=iReturnTop + 70 + "px";
  if (document.getElementById('form_maker_editor').style.display == "none") {
    ifr_id = document.getElementsByTagName("iframe")[id_ifr_editor].id;
    ifr = getIFrameDocument(ifr_id);
    ifr.body.innerHTML = w_editor;
  }
  else {
    document.getElementById('form_maker_editor').value = w_editor;
  }
  element = 'div';
  var div = document.createElement('div');
  div.setAttribute("id", "main_div");
  var main_td = document.getElementById('show_table');
  main_td.appendChild(div);
  var div = document.createElement('div');
  div.style.width = "600px";
  document.getElementById('edit_table').appendChild(div);				
}

function type_editor(i, w_editor){

    document.getElementById("element_type").value="type_editor";
	delete_last_child();
// edit table	
	oElement=document.getElementById('table_editor');
	var iReturnTop = 0;
	var iReturnLeft = 0;
	while( oElement != null ) 
	{
	iReturnTop += oElement.offsetTop;
	iReturnLeft += oElement.offsetLeft;
	oElement = oElement.offsetParent;
	}
	
		document.getElementById('main_editor').style.display="block";
		document.getElementById('main_editor').style.left=iReturnLeft+195+"px";
		document.getElementById('main_editor').style.top=iReturnTop+70+"px";
		
		
		
		if(document.getElementById('form_maker_editor').style.display=="none")
		{
			ifr_id=document.getElementsByTagName("iframe")[id_ifr_editor].id;
			ifr=getIFrameDocument(ifr_id);
			ifr.body.innerHTML=w_editor;
		}
		else
		{
			document.getElementById('form_maker_editor').value=w_editor;
		}
		
			element='div';
	
		
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");		
      	var main_td  = document.getElementById('show_table');
      	main_td.appendChild(div);
		
     	var div = document.createElement('div');
      	    div.style.width="600px";				
		document.getElementById('edit_table').appendChild(div);
		
		
}

function type_submit_reset(i, w_submit_title , w_reset_title , w_class, w_act, w_attr_name, w_attr_value){

    document.getElementById("element_type").value="type_submit_reset";
    
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_submit_title_label = document.createElement('label');
	                el_submit_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_submit_title_label.innerHTML = "Submit button label";
	
	var el_submit_title_textarea = document.createElement('input');
                el_submit_title_textarea.setAttribute("id", "edit_for_title");
                el_submit_title_textarea.setAttribute("type", "text");
                el_submit_title_textarea.style.cssText = "width:160px";
                el_submit_title_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_submitform_id_temp', this.value)");
		el_submit_title_textarea.value = w_submit_title;
	var el_submit_func_label = document.createElement('label');
	                el_submit_func_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_submit_func_label.innerHTML = "Submit function";
	var el_submit_func_textarea = document.createElement('input');
                el_submit_func_textarea.setAttribute("type", "text");
                el_submit_func_textarea.setAttribute("disabled", "disabled");
                el_submit_func_textarea.style.cssText = "width:160px";
		el_submit_func_textarea.value = "check_required('submit', 'form_id_temp')";

	var el_reset_title_label = document.createElement('label');
	                el_reset_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_reset_title_label.innerHTML = "Reset button label";
	
	var el_reset_title_textarea = document.createElement('input');
                el_reset_title_textarea.setAttribute("id", "edit_for_title");
                el_reset_title_textarea.setAttribute("type", "text");
                el_reset_title_textarea.style.cssText = "width:160px";
                el_reset_title_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_resetform_id_temp', this.value)");
		el_reset_title_textarea.value = w_reset_title;
	
	
	var el_reset_active = document.createElement('input');
                el_reset_active.setAttribute("type", "checkbox");
                el_reset_active.style.cssText = "";
				el_reset_active.setAttribute("onClick", "active_reset(this.checked, "+i+")");
	if(w_act)
				el_reset_active.setAttribute("checked", "checked");

				
	var el_reset_active_label = document.createElement('label');
	                el_reset_active_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
					el_reset_active_label.innerHTML = "Display Reset button";
	
	
	
	
	var el_reset_func_label = document.createElement('label');
	                el_reset_func_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_reset_func_label.innerHTML = "Reset function";
	var el_reset_func_textarea = document.createElement('input');
                el_reset_func_textarea.setAttribute("type", "text");
                el_reset_func_textarea.setAttribute("disabled", "disabled");
                el_reset_func_textarea.style.cssText = "width:160px";
		el_reset_func_textarea.value = "check_required('reset')";

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_submit_reset')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_submit_reset')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_submit_reset')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_submit_reset')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var hr = document.createElement('hr');
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	var br7 = document.createElement('br');
	var br8 = document.createElement('br');
	var br9 = document.createElement('br');
	edit_main_td1.appendChild(el_submit_title_label);
	edit_main_td1.appendChild(br7);
	edit_main_td1.appendChild(el_submit_func_label);
	edit_main_td1_1.appendChild(el_submit_title_textarea);
	edit_main_td1_1.appendChild(br1);
	edit_main_td1_1.appendChild(el_submit_func_textarea);
	
	
	edit_main_td2.appendChild(el_reset_active_label);
	edit_main_td2.appendChild(br5);
	edit_main_td2.appendChild(el_reset_title_label);
	edit_main_td2.appendChild(br8);
	edit_main_td2.appendChild(el_reset_func_label);
	edit_main_td2_1.appendChild(el_reset_active);
	edit_main_td2_1.appendChild(br9);
	edit_main_td2_1.appendChild(el_reset_title_textarea);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_reset_func_textarea);

	edit_main_td3.appendChild(el_style_label);
	edit_main_td3_1.appendChild(el_style_textarea);
	
	edit_main_td4.appendChild(el_attr_label);
	edit_main_td4.appendChild(el_attr_add);
	edit_main_td4.appendChild(br3);
	edit_main_td4.appendChild(el_attr_table);
	edit_main_td4.setAttribute("colspan", "2");

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);

	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
//	edit_main_table.appendChild(edit_main_tr5);
//	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='button';	type1='button';   	type2='button'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_submit_reset");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding_submit = document.createElement(element);
		    adding_submit.setAttribute("type", type1);
		
			adding_submit.setAttribute("class", "button_submit");
			
			adding_submit.setAttribute("id", i+"_element_submitform_id_temp");
			adding_submit.setAttribute("value", w_submit_title);
			adding_submit.innerHTML=w_submit_title;
			adding_submit.setAttribute("onClick", "check_required('submit', 'form_id_temp');");

	var adding_reset = document.createElement(element);
		    adding_reset.setAttribute("type", type2);
		
			adding_reset.setAttribute("class", "button_reset");
			if(!w_act)
				adding_reset.style.display="none";
				
			adding_reset.setAttribute("id", i+"_element_resetform_id_temp");
			adding_reset.setAttribute("value", w_reset_title );
			adding_reset.setAttribute("onClick", "check_required('reset');");
			adding_reset.innerHTML=w_reset_title;

     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
		td1.style.cssText = 'display:none';
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.style.cssText = 'display:none';
			label.innerHTML = "type_submit_reset_"+i;
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_submit);
      	td2.appendChild(adding_reset);
	
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
change_class(w_class, i);
refresh_attr(i, 'type_submit_reset');
}

function type_hidden(i, w_name, w_value, w_attr_name, w_attr_value){

    document.getElementById("element_type").value="type_hidden";
    
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
	var el_field_id_label = document.createElement('label');
	                el_field_id_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_field_id_label.innerHTML = "Field Id";
	
	var el_field_id_input= document.createElement('input');
                el_field_id_input.setAttribute("type", "text");
                el_field_id_input.setAttribute("disabled", "disabled");
                el_field_id_input.setAttribute("value", i+"_elementform_id_temp");
                el_field_id_input.style.cssText = "margin-left: 41px; width:160px";

	var el_field_name_label = document.createElement('label');
	                el_field_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_field_name_label.innerHTML = "Field Name";
	
	var el_field_name_input= document.createElement('input');
                el_field_name_input.setAttribute("type", "text");
		
                el_field_name_input.setAttribute("value", w_name);
                el_field_name_input.style.cssText = "margin-left: 16px; width:160px";
                el_field_name_input.setAttribute("onChange", "change_field_name('"+i+"', this)");

	var el_field_value_label = document.createElement('label');
	                el_field_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_field_value_label.innerHTML = "Field Value";
	
	var el_field_value_input= document.createElement('input');
                el_field_value_input.setAttribute("type", "text");
                el_field_value_input.setAttribute("value", w_value);
                el_field_value_input.style.cssText = "margin-left: 16px; width:160px";
                el_field_value_input.setAttribute("onKeyUp", "change_field_value('"+i+"', this.value)");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var hr = document.createElement('hr');
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	edit_main_td1.appendChild(el_field_id_label);
	edit_main_td1.appendChild(el_field_id_input);
	edit_main_td2.appendChild(el_field_name_label);
	edit_main_td2.appendChild(el_field_name_input);
	edit_main_td3.appendChild(el_field_value_label);
	edit_main_td3.appendChild(el_field_value_input);
	edit_main_td4.appendChild(el_attr_label);
	edit_main_td4.appendChild(el_attr_add);
	edit_main_td4.appendChild(br3);
	edit_main_td4.appendChild(el_attr_table);
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);

	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
//	edit_main_table.appendChild(edit_main_tr5);
//	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='input';	type='hidden';  
	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_hidden");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding = document.createElement(element);
            adding.setAttribute("type", type);
            adding.setAttribute("value", w_value);
            adding.setAttribute("id", i+"_elementform_id_temp");
            adding.setAttribute("name", w_name);

     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
           	table.setAttribute("cellpadding", '0');
           	table.setAttribute("cellspacing", '0');
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
		td1.style.cssText = 'display:none';
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.style.cssText = 'display:none';
			label.innerHTML = w_name;
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td2.appendChild(adding);
      	td2.appendChild(adding_type);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
refresh_attr(i, 'type_text');
}

function type_button(i, w_title , w_func , w_class, w_attr_name, w_attr_value){
	document.getElementById("element_type").value="type_button";
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.setAttribute("id", "buttons");
		edit_main_td4.setAttribute("colspan", "2");
	
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
				
	var el_choices_add_label = document.createElement('label');
				el_choices_add_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_choices_add_label.innerHTML = "Add a new button&nbsp;";
	var el_choices_add = document.createElement('img');
                el_choices_add.setAttribute("id", "el_choices_add");
           	el_choices_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_choices_add.style.cssText = 'cursor:pointer;';
            	el_choices_add.setAttribute("title", 'add');
                el_choices_add.setAttribute("onClick", "add_button("+i+")");
	
				
	var el_attr_label = document.createElement('label');
				el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
				el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_checkbox')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_style_label);
	edit_main_td1_1.appendChild(el_style_textarea);
	edit_main_td2.appendChild(el_attr_label);
	edit_main_td2.appendChild(el_attr_add);
	edit_main_td2.appendChild(br3);
	edit_main_td2.appendChild(el_attr_table);
	edit_main_td2.setAttribute("colspan", "2");
	
	edit_main_td3.appendChild(el_choices_add_label);
	edit_main_td3_1.appendChild(el_choices_add);
	
	n=w_title.length;
	for(j=0; j<n; j++)
	{	
		var table_button = document.createElement('table');
			table_button.setAttribute("width", "100%");
			table_button.setAttribute("border", "0");
			table_button.setAttribute("id", "button_opt"+j);
			table_button.setAttribute("idi", j+1);
		var tr_button = document.createElement('tr');
		var tr_hr = document.createElement('tr');
		
		var td_button = document.createElement('td');
		var td_X = document.createElement('td');
		var td_hr = document.createElement('td');
		    td_hr.setAttribute("colspan", "3");
		tr_hr.appendChild(td_hr);
		tr_button.appendChild(td_button);
		tr_button.appendChild(td_X);
		table_button.appendChild(tr_hr);
		table_button.appendChild(tr_button);
		
		var br1 = document.createElement('br');
		
		var hr = document.createElement('hr');
		hr.setAttribute("id", "br"+j);


		var el_title_label = document.createElement('label');
	
			el_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
	
			el_title_label.innerHTML = "Button name";
		
		var el_title = document.createElement('input');
			el_title.setAttribute("id", "el_title"+j);
			el_title.setAttribute("type", "text");
			el_title.setAttribute("value", w_title[j]);
			el_title.style.cssText =   "width:100px;  margin-left:43px;  padding:0; border-width: 1px";
			el_title.setAttribute("onKeyUp", "change_label('"+i+"_elementform_id_temp"+j+"', this.value);");
	
		var el_func_label = document.createElement('label');
	
			el_func_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
	
			el_func_label.innerHTML = "OnClick function";
		
		var el_func = document.createElement('input');
			el_func.setAttribute("id", "el_func"+j);
			el_func.setAttribute("type", "text");
			el_func.setAttribute("value", w_func[j]);
			el_func.style.cssText =   "width:100px;  margin-left:20px;  padding:0; border-width: 1px";
			el_func.setAttribute("onKeyUp", "change_func('"+i+"_elementform_id_temp"+j+"', this.value);");
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_button"+j+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_button("+j+","+i+")");
			
		td_hr.appendChild(hr);
		td_button.appendChild(el_title_label);
		td_button.appendChild(el_title);
		td_button.appendChild(br1);
		td_button.appendChild(el_func_label);
		td_button.appendChild(el_func);
		td_X.appendChild(el_choices_remove);
		edit_main_td4.appendChild(table_button);
	
	}

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);

	edit_main_table.appendChild(edit_main_tr1);

	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr2);
//	edit_main_table.appendChild(edit_main_tr5);
//	edit_main_table.appendChild(edit_main_tr6);

	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='button';	type='button'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_button");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
    var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", i+"_elemet_tableform_id_temp");
	
    var tr = document.createElement('tr');
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
		td1.style.cssText = 'display:none';
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
	//	table_little -@ sarqaca tbody table_little darela table_little_t
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = "button_"+i;
			label.style.cssText = 'display:none';
	    
	n=w_title.length;
	for(j=0; j<n; j++)
	{      	
	
		var adding = document.createElement(element);
				adding.setAttribute("type", type);
				adding.setAttribute("id", i+"_elementform_id_temp"+j);
				adding.setAttribute("name", i+"_elementform_id_temp"+j);
				adding.setAttribute("value", w_title[j]);
				adding.innerHTML = w_title[j];
				adding.setAttribute("onclick", w_func[j]);
				
				
		td2.appendChild(adding);
	}			
      	var main_td  = document.getElementById('show_table');
	
      	td1.appendChild(label);
      
        td2.appendChild(adding_type);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
change_class(w_class, i);
refresh_attr(i, 'type_checkbox');
}

function type_text(i, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value) {

 	element_ids=[ 'option1', 'option2'];
    document.getElementById("element_type").value="type_text";
    
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
			
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');

                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		 	 
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");

	var el_first_value_label = document.createElement('label');
	        el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty ";
	
	var el_first_value_input = document.createElement('input');
                el_first_value_input.setAttribute("id", "el_first_value_input");
                el_first_value_input.setAttribute("type", "text");
                el_first_value_input.setAttribute("value", w_title);
                el_first_value_input.style.cssText = "width:200px;";
                el_first_value_input.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_elementform_id_temp')");
	
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
                el_required.setAttribute("checked", "checked");
			
	
	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
				
				
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Deactive Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", "input_deactive");
				el_style_textarea.setAttribute("disabled", "disabled");
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_style_label2 = document.createElement('label');
	    el_style_label2.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label2.innerHTML = "Active Class name";
	
	var el_style_textarea2 = document.createElement('input');
                el_style_textarea2.setAttribute("id", "element_style");
				el_style_textarea2.setAttribute("type", "text");
				el_style_textarea2.setAttribute("value", "input_active");
				el_style_textarea2.setAttribute("disabled", "disabled");
                el_style_textarea2.style.cssText = "width:200px;";
                el_style_textarea2.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2.appendChild(br1);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_size);
	
	edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4_1.appendChild(el_first_value_input);
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td9.appendChild(el_style_label2);
	edit_main_td9_1.appendChild(el_style_textarea2);
	
	
	
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	edit_main_td8.appendChild(el_unique_label);
	edit_main_td8_1.appendChild(el_unique);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table

	element='input';	type='text'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_text");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
			
	var adding = document.createElement(element);
            adding.setAttribute("type", type);
		
		if(w_title==w_first_val)
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_deactive");
		}
		else
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_active");
		}
			adding.setAttribute("id", i+"_elementform_id_temp");
			adding.setAttribute("name", i+"_elementform_id_temp");
			adding.setAttribute("value", w_first_val);
			adding.setAttribute("title", w_title);
			adding.setAttribute("onFocus", 'delete_value("'+i+'_elementform_id_temp")');
			adding.setAttribute("onBlur", 'return_value("'+i+'_elementform_id_temp")');
			adding.setAttribute("onChange", 'change_value("'+i+'_elementform_id_temp")');
			
	 
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
      	td2.appendChild(adding_unique);
      	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_number(i, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value) {

 	element_ids=[ 'option1', 'option2'];
    document.getElementById("element_type").value="type_number";
    
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
				el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');

                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		   
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum_point(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");

	var el_first_value_label = document.createElement('label');
	        el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty ";
	
	var el_first_value_input = document.createElement('input');
                el_first_value_input.setAttribute("id", "el_first_value_input");
                el_first_value_input.setAttribute("type", "text");
                el_first_value_input.setAttribute("value", w_title);
                el_first_value_input.style.cssText = "width:200px;";
                el_first_value_input.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_elementform_id_temp')");
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
                el_required.setAttribute("checked", "checked");
	
	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
							
	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_size);
	
	edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4_1.appendChild(el_first_value_input);
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
				
	edit_main_td8.appendChild(el_unique_label);
	edit_main_td8_1.appendChild(el_unique);
	
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table

	element='input';	type='text'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_number");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
			
			
	var adding = document.createElement(element);
            adding.setAttribute("type", type);
		
		if(w_title==w_first_val)
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_deactive");
		}
		else
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_active");
		}
			adding.setAttribute("id", i+"_elementform_id_temp");
			adding.setAttribute("name", i+"_elementform_id_temp");
			adding.setAttribute("value", w_first_val);
			adding.setAttribute("title", w_title);
			adding.setAttribute("onKeyPress", "return check_isnum_point(event)");
			adding.setAttribute("onFocus", 'delete_value("'+i+'_elementform_id_temp")');
			adding.setAttribute("onBlur", 'return_value("'+i+'_elementform_id_temp")');
			adding.setAttribute("onChange", 'change_value("'+i+'_elementform_id_temp")');
			
	 
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
      	td2.appendChild(adding_unique);
      	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_password(i, w_field_label, w_field_label_pos, w_size, w_required, w_unique, w_class, w_attr_name, w_attr_value) {

    document.getElementById("element_type").value="type_password";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
		        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		   
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
			
	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_size);
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td7.appendChild(el_unique_label);
	edit_main_td7_1.appendChild(el_unique);

	edit_main_td6.appendChild(el_attr_label);
	edit_main_td6.appendChild(el_attr_add);
	edit_main_td6.appendChild(br3);
	edit_main_td6.appendChild(el_attr_table);
	edit_main_td6.setAttribute("colspan", "2");

	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');

//show table

	element='input';	type='password'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_password");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");

	var adding = document.createElement(element);
			adding.setAttribute("type", type);
			adding.setAttribute("id", i+"_elementform_id_temp");
			adding.setAttribute("name", i+"_elementform_id_temp");
			adding.style.cssText = "width:"+w_size+"px;";
		
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
		
	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      
	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
       	td2.appendChild(adding_unique);
     	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
		
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_textarea(i, w_field_label, w_field_label_pos, w_size_w, w_size_h, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value){
    
	document.getElementById("element_type").value="type_textarea";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";

	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
		
	var el_size_w = document.createElement('input');
		   el_size_w.setAttribute("id", "edit_for_input_size");
		   el_size_w.setAttribute("type", "text");
		   el_size_w.setAttribute("value", w_size_w);
		   el_size_w.style.cssText = "margin-right:2px; width: 60px";
		   el_size_w.setAttribute("name", "edit_for_size");
		   el_size_w.setAttribute("onKeyPress", "return check_isnum(event)");
           el_size_w.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");
		   
		X = document.createTextNode("x");
		
	var el_size_h = document.createElement('input');
		   el_size_h.setAttribute("id", "edit_for_input_size");
		   el_size_h.setAttribute("type", "text");
		   el_size_h.setAttribute("value", w_size_h);
		   el_size_h.style.cssText = "margin-left:2px;  width:60px";
			el_size_h.setAttribute("name", "edit_for_size");
			el_size_h.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size_h.setAttribute("onKeyUp", "change_h_style('"+i+"_elementform_id_temp', this.value)");
	var el_first_value_label = document.createElement('label');
	        el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty";
	
	var el_first_value_input = document.createElement('input');
                el_first_value_input.setAttribute("id", "el_first_value_input");
                el_first_value_input.setAttribute("type", "text");
                el_first_value_input.setAttribute("value", w_title);
                el_first_value_input.style.cssText = "width:200px;";
                el_first_value_input.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_elementform_id_temp')");
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			    el_required.setAttribute("checked", "checked");
		
	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
		
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	
	edit_main_td3_1.appendChild(el_size_w);
	edit_main_td3_1.appendChild(X);
	edit_main_td3_1.appendChild(el_size_h);
	
	edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4_1.appendChild(el_first_value_input);
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_unique_label);
	edit_main_td8_1.appendChild(el_unique);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");

	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');

//show table

	element='textarea';
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_textarea");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
			
	var div = document.createElement('div');
      	div.setAttribute("id", "main_div");
			
		var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	var adding = document.createElement(element);
		if(w_title==w_first_val)
		{
			adding.style.cssText = "width:"+w_size_w+"px; height:"+w_size_h+"px;";
			adding.setAttribute("class", "input_deactive");
		}
		else
		{
			adding.style.cssText = "width:"+w_size_w+"px; height:"+w_size_h+"px;";
			adding.setAttribute("class", "input_active");
		}
		adding.setAttribute("id", i+"_elementform_id_temp");
		adding.setAttribute("name", i+"_elementform_id_temp");
		adding.setAttribute("title", w_title);
		adding.setAttribute("value",w_first_val);
		adding.setAttribute("onFocus", "delete_value('"+i+"_elementform_id_temp')");
		adding.setAttribute("onBlur", "return_value('"+i+"_elementform_id_temp')");
		adding.setAttribute("onChange", "change_value('"+i+"_elementform_id_temp')");
		adding.innerHTML=w_first_val;
		
			
		var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
      	td2.appendChild(adding_type);
	
      	td2.appendChild(adding_required);
      	td2.appendChild(adding_unique);
      	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_phone(i, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_mini_labels, w_required, w_unique, w_class, w_attr_name, w_attr_value) {
	document.getElementById("element_type").value = "type_phone";
	delete_last_child();
  // edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
		
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
		
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			    el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			    el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
				
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
			el_size.setAttribute("id", "edit_for_input_size");
			el_size.setAttribute("type", "text");
			el_size.setAttribute("value", w_size);		
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_element_lastform_id_temp', this.value);");

	var gic = document.createTextNode("-");

	var el_first_value_label = document.createElement('label');
	    el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty ";
	
	var el_first_value_area = document.createElement('input');
                el_first_value_area.setAttribute("id", "el_first_value_area");
                el_first_value_area.setAttribute("type", "text");
                el_first_value_area.setAttribute("value", w_title[0]);
                el_first_value_area.style.cssText = "width:50px; margin-right:4px";
                el_first_value_area.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_element_firstform_id_temp')");

	var el_first_value_phone = document.createElement('input');
                el_first_value_phone.setAttribute("id", "el_first_value_phone");
                el_first_value_phone.setAttribute("type", "text");
                el_first_value_phone.setAttribute("value", w_title[1]);
                el_first_value_phone.style.cssText = "width:100px; margin-left:4px";
                el_first_value_phone.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_element_lastform_id_temp')");


	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
                el_required.setAttribute("checked", "checked");	

	var el_unique_label = document.createElement('label');
				el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	            el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
				el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_name')");
				
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
				el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_name')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_name')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_name')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_first_value_label);
	edit_main_td3_1.appendChild(el_first_value_area);
	edit_main_td3_1.appendChild(gic);
	edit_main_td3_1.appendChild(el_first_value_phone);

	edit_main_td7.appendChild(el_size_label);
	edit_main_td7_1.appendChild(el_size);

  edit_main_td4.appendChild(el_style_label);
  edit_main_td4_1.appendChild(el_style_textarea);

	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_unique_label);
	edit_main_td8_1.appendChild(el_unique);
	
	edit_main_td6.appendChild(el_attr_label);
	edit_main_td6.appendChild(el_attr_add);
	edit_main_td6.appendChild(br3);
	edit_main_td6.appendChild(el_attr_table);
	edit_main_td6.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_name');

//show table

	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_phone");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
	    
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
        var div_for_editable_labels = document.createElement('div');
        div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
      	edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");
        div_for_editable_labels.appendChild(edit_labels);

      	var tr = document.createElement('tr');
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var table_name = document.createElement('table');
           	table_name.setAttribute("id", i+"_table_name");
           	table_name.setAttribute("cellpadding", '0');
           	table_name.setAttribute("cellspacing", '0');
			
      	var tr_name1 = document.createElement('tr');
           	tr_name1.setAttribute("id", i+"_tr_name1");
			
      	var tr_name2 = document.createElement('tr');
           	tr_name2.setAttribute("id", i+"_tr_name2");
			
      	var td_name_input1 = document.createElement('td');
           	td_name_input1.setAttribute("id", i+"_td_name_input_first");
			
      	var td_name_input2 = document.createElement('td');
           	td_name_input2.setAttribute("id", i+"_td_name_input_last");
		
      	var td_name_label1 = document.createElement('td');
           	td_name_label1.setAttribute("id", i+"_td_name_label_first");
           	td_name_label1.setAttribute("align", "left");
			
      	var td_name_label2 = document.createElement('td');
           	td_name_label2.setAttribute("id", i+"_td_name_label_last");
           	td_name_label2.setAttribute("align", "left");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      
	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";	
			
	var first = document.createElement('input');
        first.setAttribute("type", 'text');
		
		if(w_title[0]==w_first_val[0])
			first.setAttribute("class", "input_deactive");
		else
			first.setAttribute("class", "input_active");
		
	    first.style.cssText = "width:50px";
	    first.setAttribute("id", i+"_element_firstform_id_temp");
	    first.setAttribute("name", i+"_element_firstform_id_temp");
		first.setAttribute("value", w_first_val[0]);
		first.setAttribute("title", w_title[0]);
		first.setAttribute("onFocus", 'delete_value("'+i+'_element_firstform_id_temp")');
		first.setAttribute("onBlur", 'return_value("'+i+'_element_firstform_id_temp")');
	    first.setAttribute("onChange", "change_value('"+i+"_element_firstform_id_temp')");
		first.setAttribute("onKeyPress", "return check_isnum(event)");
		
	var gic = document.createElement('span');
	    gic.setAttribute("class", "wdform_line");
		gic.style.cssText = "margin: 0px 4px 0px 4px; padding: 0px;";
		gic.innerHTML = "-";	

	var first_label = document.createElement('label');
	    first_label.setAttribute("class", "mini_label");
	    first_label.setAttribute("id", i+"_mini_label_area_code");
	    first_label.innerHTML= w_mini_labels[0];
			
	var last = document.createElement('input');
        last.setAttribute("type", 'text');
		
 		if(w_title[1]==w_first_val[1])
			last.setAttribute("class", "input_deactive");
		else
			last.setAttribute("class", "input_active");
			
	    last.style.cssText = "width:"+w_size+"px";
		last.setAttribute("id", i+"_element_lastform_id_temp");
	   	last.setAttribute("name", i+"_element_lastform_id_temp");
		last.setAttribute("value", w_first_val[1]);
		last.setAttribute("title", w_title[1]);
		last.setAttribute("onFocus", 'delete_value("'+i+'_element_lastform_id_temp")');
		last.setAttribute("onBlur", 'return_value("'+i+'_element_lastform_id_temp")');
		last.setAttribute("onChange", "change_value('"+i+"_element_lastform_id_temp')");
		last.setAttribute("onKeyPress", "return check_isnum(event)");

	var last_label = document.createElement('label');
		last_label.setAttribute("class", "mini_label");
		last_label.setAttribute("id", i+"_mini_label_phone_number");
		last_label.innerHTML=w_mini_labels[1];
			
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
		
      	td_name_input1.appendChild(first);
      	td_name_input1.appendChild(gic);
      	td_name_input2.appendChild(last);
      	tr_name1.appendChild(td_name_input1);
      	tr_name1.appendChild(td_name_input2);
		
      	td_name_label1.appendChild(first_label);
      	td_name_label2.appendChild(last_label);
      	tr_name2.appendChild(td_name_label1);
      	tr_name2.appendChild(td_name_label2);
      	table_name.appendChild(tr_name1);
      	table_name.appendChild(tr_name2);
		
       	td2.appendChild(adding_type);
       	td2.appendChild(adding_required);
       	td2.appendChild(adding_unique);
    	td2.appendChild(table_name);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
        div.appendChild(div_for_editable_labels);
      	main_td.appendChild(div);
		
	if (w_field_label_pos == "top") {
    label_top(i);
  }
  change_class(w_class, i);
  refresh_attr(i, 'type_name');
  jQuery(document).ready(function() {
    jQuery("label#"+i+"_mini_label_area_code").click(function() {
    if (jQuery(this).children('input').length == 0) {
      var area_code = "<input type='text' class='area_code' size='10' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
      jQuery(this).html(area_code);
      jQuery("input.area_code").focus();
      jQuery("input.area_code").blur(function() {
        var value = jQuery(this).val();
        jQuery("#"+i+"_mini_label_area_code").text(value);
        });
      }
    });
    jQuery("label#"+i+"_mini_label_phone_number").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var phone_number = "<input type='text' class='phone_number'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(phone_number);
        jQuery("input.phone_number").focus();
        jQuery("input.phone_number").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_phone_number").text(value);
        });
      }
    });
  });
}

function change_input_range(type, id)
{
	var s='';
	if(document.getElementById('el_range_'+type+'1').value=='')
		s='0';
	else
		s=document.getElementById('el_range_'+type+'1').value;

	if(document.getElementById('el_range_'+type+'2').value!='')
		s=s+'.'+document.getElementById('el_range_'+type+'2').value;

	document.getElementById(id+'_range_'+type+'form_id_temp').value=s;
}
function explode( delimiter, string ) {	
	var emptyArray = { 0: '' };

	if ( arguments.length != 2
		|| typeof arguments[0] == 'undefined'
		|| typeof arguments[1] == 'undefined' )
	{
		return null;
	}

	if ( delimiter === ''
		|| delimiter === false
		|| delimiter === null )
	{
		return false;
	}

	if ( typeof delimiter == 'function'
		|| typeof delimiter == 'object'
		|| typeof string == 'function'
		|| typeof string == 'object' )
	{
		return emptyArray;
	}

	if ( delimiter === true ) {
		delimiter = '1';
	}

	return string.toString().split ( delimiter.toString() );
}

function type_name(i, w_field_label, w_field_label_pos, w_first_val, w_title, w_mini_labels, w_size, w_name_format, w_required, w_unique, w_class, w_attr_name, w_attr_value) {
	document.getElementById("element_type").value="type_name";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
		
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
		
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else

				el_label_position1.setAttribute("checked", "checked");

	var gic = document.createTextNode("-");

	var el_first_value_label = document.createElement('label');
	    el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty ";
	
	var el_first_value_first = document.createElement('input');
                el_first_value_first.setAttribute("id", "el_first_value_first");
                el_first_value_first.setAttribute("type", "text");
                el_first_value_first.setAttribute("value", w_title[0]);
                el_first_value_first.style.cssText = "width:80px; margin-left:4px; margin-right:4px";
                el_first_value_first.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_element_firstform_id_temp')");

	var el_first_value_last = document.createElement('input');
                el_first_value_last.setAttribute("id", "el_first_value_last");
                el_first_value_last.setAttribute("type", "text");
                el_first_value_last.setAttribute("value", w_title[1]);
                el_first_value_last.style.cssText = "width:80px; margin-left:4px; margin-right:4px";
                el_first_value_last.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_element_lastform_id_temp')");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
			el_size.setAttribute("id", "edit_for_input_size");
			el_size.setAttribute("type", "text");
			el_size.setAttribute("value", w_size);
			
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_element_firstform_id_temp', this.value); change_w_style('"+i+"_element_lastform_id_temp', this.value); change_w_style('"+i+"_element_middleform_id_temp', this.value)");


	var el_format_label = document.createElement('label');
	        el_format_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_format_label.innerHTML = "Name Format";
	
	var el_format_normal = document.createElement('input');
                el_format_normal.setAttribute("id", "el_format_normal");
                el_format_normal.setAttribute("type", "radio");
                el_format_normal.setAttribute("value", "normal");
		el_format_normal.setAttribute("name", "edit_for_name_format");
                el_format_normal.setAttribute("onchange", "format_normal("+i+")");
		el_format_normal.setAttribute("checked", "checked");
		Normal = document.createTextNode("Normal");
		
	var el_format_extended = document.createElement('input');
                el_format_extended.setAttribute("id", "el_format_extended");
                el_format_extended.setAttribute("type", "radio");
                el_format_extended.setAttribute("value", "extended");
		el_format_extended.setAttribute("name", "edit_for_name_format");
                el_format_extended.setAttribute("onchange", "format_extended("+i+")");
		Extended = document.createTextNode("Extended");
		
	if(w_name_format=="normal")
	
				el_format_normal.setAttribute("checked", "checked");
	else
				el_format_extended.setAttribute("checked", "checked");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
                el_required.setAttribute("checked", "checked");	

	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_name')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_name')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_name')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_name')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td9.appendChild(el_first_value_label);
	edit_main_td9_1.appendChild(el_first_value_first);
	edit_main_td9_1.appendChild(gic);
	edit_main_td9_1.appendChild(el_first_value_last);
	
	
	
	edit_main_td7.appendChild(el_size_label);
	edit_main_td7_1.appendChild(el_size);
	
	edit_main_td3.appendChild(el_format_label);

	edit_main_td3_1.appendChild(el_format_normal);
	edit_main_td3_1.appendChild(Normal);
	edit_main_td3_1.appendChild(br6);
	edit_main_td3_1.appendChild(el_format_extended);
	edit_main_td3_1.appendChild(Extended);
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_unique_label);
	edit_main_td8_1.appendChild(el_unique);
	
	edit_main_td6.appendChild(el_attr_label);
	edit_main_td6.appendChild(el_attr_add);
	edit_main_td6.appendChild(br3);
	edit_main_td6.appendChild(el_attr_table);
	edit_main_td6.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_name');
	
//show table

	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_name");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
	    
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
      var div_for_editable_labels = document.createElement('div');
			div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
			edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");
      div_for_editable_labels.appendChild(edit_labels);
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");

			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var table_name = document.createElement('table');
           	table_name.setAttribute("id", i+"_table_name");
           	table_name.setAttribute("cellpadding", '0');
           	table_name.setAttribute("cellspacing", '0');
			
      	var tr_name1 = document.createElement('tr');
           	tr_name1.setAttribute("id", i+"_tr_name1");
			
      	var tr_name2 = document.createElement('tr');
           	tr_name2.setAttribute("id", i+"_tr_name2");
			
      	var td_name_input1 = document.createElement('td');
           	td_name_input1.setAttribute("id", i+"_td_name_input_first");
			
      	var td_name_input2 = document.createElement('td');
           	td_name_input2.setAttribute("id", i+"_td_name_input_last");
		
      	var td_name_label1 = document.createElement('td');
           	td_name_label1.setAttribute("id", i+"_td_name_label_first");
           	td_name_label1.setAttribute("align", "left");
			
      	var td_name_label2 = document.createElement('td');
           	td_name_label2.setAttribute("id", i+"_td_name_label_last");
           	td_name_label2.setAttribute("align", "left");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      
	    
      	var label = document.createElement('span');
		label.setAttribute("id", i+"_element_labelform_id_temp");
		label.innerHTML = w_field_label;
		label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";			
	var first = document.createElement('input');
        first.setAttribute("type", 'text');
		if(w_title[0]==w_first_val[0])
			first.setAttribute("class", "input_deactive");
		else
			first.setAttribute("class", "input_active");
		
	    first.style.cssText = "margin-right: 10px; width:"+w_size+"px";
	    first.setAttribute("id", i+"_element_firstform_id_temp");
	    first.setAttribute("name", i+"_element_firstform_id_temp");
		first.setAttribute("value", w_first_val[0]);
		first.setAttribute("title", w_title[0]);
		first.setAttribute("onFocus", 'delete_value("'+i+'_element_firstform_id_temp")');
		first.setAttribute("onBlur", 'return_value("'+i+'_element_firstform_id_temp")');
	    first.setAttribute("onChange", "change_value('"+i+"_element_firstform_id_temp')");
			
	var first_label = document.createElement('label');
	    first_label.setAttribute("class", "mini_label");
	    first_label.setAttribute("id", i+"_mini_label_first");
	    first_label.innerHTML = w_mini_labels[1];
			
	var last = document.createElement('input');
        last.setAttribute("type", 'text');
		
 		if(w_title[1]==w_first_val[1])
			last.setAttribute("class", "input_deactive");
		else
			last.setAttribute("class", "input_active");
			
		last.style.cssText = "margin-right: 10px; width:"+w_size+"px";
		last.setAttribute("id", i+"_element_lastform_id_temp");
	   	last.setAttribute("name", i+"_element_lastform_id_temp");
		last.setAttribute("value", w_first_val[1]);
		last.setAttribute("title", w_title[1]);
		last.setAttribute("onFocus", 'delete_value("'+i+'_element_lastform_id_temp")');
		last.setAttribute("onBlur", 'return_value("'+i+'_element_lastform_id_temp")');
		last.setAttribute("onChange", "change_value('"+i+"_element_lastform_id_temp')");


	var last_label = document.createElement('label');
		last_label.setAttribute("class", "mini_label");
		last_label.setAttribute("id", i+"_mini_label_last");
		last_label.innerHTML= w_mini_labels[2];
			
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
		
      	td_name_input1.appendChild(first);
      	td_name_input2.appendChild(last);
      	tr_name1.appendChild(td_name_input1);
      	tr_name1.appendChild(td_name_input2);
		
      	td_name_label1.appendChild(first_label);
      	td_name_label2.appendChild(last_label);
      	tr_name2.appendChild(td_name_label1);
      	tr_name2.appendChild(td_name_label2);
      	table_name.appendChild(tr_name1);
      	table_name.appendChild(tr_name2);
		
       	td2.appendChild(adding_type);
       	td2.appendChild(adding_required);
       	td2.appendChild(adding_unique);
    	td2.appendChild(table_name);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
        div.appendChild(div_for_editable_labels);
      	main_td.appendChild(div);
		
	if(w_field_label_pos=="top")
				label_top(i);
	
	if(w_name_format=="extended")
				format_extended(i);
  change_class(w_class, i);
  refresh_attr(i, 'type_name');
  jQuery(document).ready(function() {
    jQuery("label#"+i+"_mini_label_first").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var first = "<input type='text' class='first' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(first);
        jQuery("input.first").focus();
        jQuery("input.first").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_first").text(value);
        });
      }
    });
    jQuery("label#"+i+"_mini_label_last").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var last = "<input type='text' class='last'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(last);
        jQuery("input.last").focus();
        jQuery("input.last").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_last").text(value);
        });
      }
    });
	});
}

function type_address(i, w_field_label, w_field_label_pos, w_size, w_mini_labels, w_disabled_fields, w_required, w_class, w_attr_name, w_attr_value) {
	document.getElementById("element_type").value="type_address";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
		
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
		
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else

				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Overall size(px) ";
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		   
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_div_address', this.value);");
  var el_disable_field_label = document.createElement('label');
	        el_disable_field_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_disable_field_label.innerHTML = "Disable Field(s)";
	
	
	var el_disable_address1 = document.createElement('input');
            el_disable_address1.setAttribute("id", "el_street1");
            el_disable_address1.setAttribute("type", "checkbox");
            el_disable_address1.setAttribute("value", "no");
            el_disable_address1.setAttribute("onclick", "disable_fields('"+i+"','street1')");
	if(w_disabled_fields[0]=="yes")
                el_disable_address1.setAttribute("checked", "checked");	
	
	var el_disable_address2 = document.createElement('input');
            el_disable_address2.setAttribute("id", "el_street2");
            el_disable_address2.setAttribute("type", "checkbox");
            el_disable_address2.setAttribute("value", "no");
            el_disable_address2.setAttribute("onclick", "disable_fields('"+i+"','street2')");
	if(w_disabled_fields[1]=="yes")
                el_disable_address2.setAttribute("checked", "checked");	
	
	var el_disable_city = document.createElement('input');
            el_disable_city.setAttribute("id", "el_city");
            el_disable_city.setAttribute("type", "checkbox");
            el_disable_city.setAttribute("value", "no");
            el_disable_city.setAttribute("onclick", "disable_fields('"+i+"','city')");
	if(w_disabled_fields[2]=="yes")
                el_disable_city.setAttribute("checked", "checked");	
	
	var el_disable_state = document.createElement('input');
            el_disable_state.setAttribute("id", "el_state");
            el_disable_state.setAttribute("type", "checkbox");
            el_disable_state.setAttribute("value", "no");
            el_disable_state.setAttribute("onclick", "disable_fields('"+i+"','state')");
	if(w_disabled_fields[3]=="yes")
                el_disable_state.setAttribute("checked", "checked");	
	
	var el_disable_postal = document.createElement('input');
            el_disable_postal.setAttribute("id", "el_postal");
            el_disable_postal.setAttribute("type", "checkbox");
            el_disable_postal.setAttribute("value", "no");
            el_disable_postal.setAttribute("onclick", "disable_fields('"+i+"','postal')");
	if(w_disabled_fields[4]=="yes")
                el_disable_postal.setAttribute("checked", "checked");
	
	var el_disable_country = document.createElement('input');
                el_disable_country.setAttribute("id", "el_country");
                el_disable_country.setAttribute("type", "checkbox");
                el_disable_country.setAttribute("value", "no");
                el_disable_country.setAttribute("onclick", "disable_fields('"+i+"','country')");
	if(w_disabled_fields[5]=="yes")
                el_disable_country.setAttribute("checked", "checked");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
                el_required.setAttribute("checked", "checked");	

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
				el_style_textarea.setAttribute("type", "text");
				el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_address')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_address')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_address')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_address')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
  var el_street1 = document.createTextNode(w_mini_labels[0]);
	var el_street2 = document.createTextNode(w_mini_labels[1]);
	var el_city = document.createTextNode(w_mini_labels[2]);
	var el_state = document.createTextNode(w_mini_labels[3]);
	var el_postal = document.createTextNode(w_mini_labels[4]);
	var el_country = document.createTextNode(w_mini_labels[5]);
	
	var el_street1_label = document.createElement('label');
		el_street1_label.setAttribute("id", "el_street1_label");
	
	var el_street2_label = document.createElement('label');
		el_street2_label.setAttribute("id", "el_street2_label");
	
	var el_city_label = document.createElement('label');
		el_city_label.setAttribute("id", "el_city_label");
	
	var el_state_label = document.createElement('label');
		el_state_label.setAttribute("id", "el_state_label");
	
	var el_postal_label = document.createElement('label');
		el_postal_label.setAttribute("id", "el_postal_label");
	
	var el_country_label = document.createElement('label');
		el_country_label.setAttribute("id", "el_country_label");
	
	el_street1_label.appendChild(el_street1);
	el_street2_label.appendChild(el_street2);
	el_city_label.appendChild(el_city);
	el_state_label.appendChild(el_state);
	el_postal_label.appendChild(el_postal);
	el_country_label.appendChild(el_country);
	var br_ = document.createElement('br');
	var br1_ = document.createElement('br');
	var br2_ = document.createElement('br');
	var br3_ = document.createElement('br');
	var br4_ = document.createElement('br');
	var br5_ = document.createElement('br');
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td7.appendChild(el_size_label);
	edit_main_td7_1.appendChild(el_size);
	
	/*edit_main_td3.appendChild(el_format_label);
	edit_main_td3.appendChild(br5);
	edit_main_td3.appendChild(el_format_normal);
	edit_main_td3.appendChild(Normal);
	edit_main_td3.appendChild(br6);
	edit_main_td3.appendChild(el_format_extended);
	edit_main_td3.appendChild(Extended);*/
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
  edit_main_td8.appendChild(el_disable_field_label);
	edit_main_td8_1.appendChild(el_disable_address1);
	edit_main_td8_1.appendChild(el_street1_label);
	edit_main_td8_1.appendChild(br_);
	edit_main_td8_1.appendChild(el_disable_address2);
	edit_main_td8_1.appendChild(el_street2_label);
	edit_main_td8_1.appendChild(br1_);
	edit_main_td8_1.appendChild(el_disable_city);
	edit_main_td8_1.appendChild(el_city_label);
	edit_main_td8_1.appendChild(br2_);
	edit_main_td8_1.appendChild(el_disable_state);
	edit_main_td8_1.appendChild(el_state_label);
	edit_main_td8_1.appendChild(br3_);
	edit_main_td8_1.appendChild(el_disable_postal);
	edit_main_td8_1.appendChild(el_postal_label);
	edit_main_td8_1.appendChild(br4_);
	edit_main_td8_1.appendChild(el_disable_country);
	edit_main_td8_1.appendChild(el_country_label);
	edit_main_td8_1.appendChild(br5_);
	
	edit_main_td6.appendChild(el_attr_label);
	edit_main_td6.appendChild(el_attr_add);
	edit_main_td6.appendChild(br3);
	edit_main_td6.appendChild(el_attr_table);
	edit_main_td6.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	//edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr7);
	//edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_address');

//show table

	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_address");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required= document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
  var adding_country= document.createElement("input");
  adding_country.setAttribute("type", "hidden");
  adding_country.setAttribute("name", i+"_disable_fieldsform_id_temp");
  adding_country.setAttribute("id", i+"_disable_fieldsform_id_temp");	
  adding_country.setAttribute("street1", w_disabled_fields[0]);
  adding_country.setAttribute("street2", w_disabled_fields[1]);
  adding_country.setAttribute("city", w_disabled_fields[2]);
  adding_country.setAttribute("state", w_disabled_fields[3]);
  adding_country.setAttribute("postal", w_disabled_fields[4]);
  adding_country.setAttribute("country", w_disabled_fields[5]);
	    
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
  var div_for_editable_labels = document.createElement('div');
  div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
  edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");
  div_for_editable_labels.appendChild(edit_labels);
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var div_address = document.createElement('div');
           	div_address.setAttribute("id", i+"_div_address");
			div_address.style.cssText = "width:"+w_size+"px";
		
      	var span_addres1 = document.createElement('span');
			span_addres1.style.cssText = "float:left; width:100%;  padding-bottom: 8px; display:block";
			
      	var span_addres2 = document.createElement('span');
			span_addres2.style.cssText = "float:left; width:100%;  padding-bottom: 8px; display:block";
			
      	var span_addres3_1 = document.createElement('span');
			span_addres3_1.style.cssText = "float:left; width:48%; padding-bottom: 8px;";
		
      	var span_addres3_2 = document.createElement('span');
			span_addres3_2.style.cssText = "float:right; width:48%; padding-bottom: 8px;";
		
      	var span_addres4_1 = document.createElement('span');
			span_addres4_1.style.cssText = "float:left; width:48%; padding-bottom: 8px;";
		
      	var span_addres4_2 = document.createElement('span');
			span_addres4_2.style.cssText = "float:right; width:48%; padding-bottom: 8px;";
		
	
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      
	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
		if(w_required=="yes")
			required.innerHTML = " *";	
			
	var street1 = document.createElement('input');
        street1.setAttribute("type", 'text');
	    street1.style.cssText = "width:100%";
	    street1.setAttribute("id", i+"_street1form_id_temp");
	    street1.setAttribute("name", i+"_street1form_id_temp");
	    street1.setAttribute("onChange", "change_value('"+i+"_street1form_id_temp')");
			
	var street1_label = document.createElement('label');
	    street1_label.setAttribute("class", "mini_label");
      street1_label.setAttribute("id", i+"_mini_label_street1");
	    street1_label.style.cssText = "display:block;";
	    street1_label.innerHTML=w_mini_labels[0];
			
	var street2 = document.createElement('input');
        street2.setAttribute("type", 'text');
		street2.style.cssText = "width:100%";
		street2.setAttribute("id", i+"_street2form_id_temp");
	   	street2.setAttribute("name", (parseInt(i)+1)+"_street2form_id_temp");
		street2.setAttribute("onChange", "change_value('"+i+"_street2form_id_temp')");

	var street2_label = document.createElement('label');
		street2_label.setAttribute("class", "mini_label");
    street2_label.setAttribute("id", i+"_mini_label_street2");
    street2_label.style.cssText = "display:block;";
		street2_label.innerHTML=w_mini_labels[1];
		
	var city = document.createElement('input');
        city.setAttribute("type", 'text');
		city.style.cssText = "width:100%";
		city.setAttribute("id", i+"_cityform_id_temp");
	   	city.setAttribute("name", (parseInt(i)+2)+"_cityform_id_temp");
		city.setAttribute("onChange", "change_value('"+i+"_cityform_id_temp')");

	var city_label = document.createElement('label');
		city_label.setAttribute("class", "mini_label");
    city_label.setAttribute("id", i+"_mini_label_city");
    city_label.style.cssText = "display:block;";
		city_label.innerHTML= w_mini_labels[2];
			
	var state = document.createElement('input');
        state.setAttribute("type", 'text');
		state.style.cssText = "width:100%";
		state.setAttribute("id", i+"_stateform_id_temp");
	   	state.setAttribute("name", (parseInt(i)+3)+"_stateform_id_temp");
		state.setAttribute("onChange", "change_value('"+i+"_stateform_id_temp')");

	var state_label = document.createElement('label');
		state_label.setAttribute("class", "mini_label");
    state_label.setAttribute("id", i+"_mini_label_state");
    state_label.style.cssText = "display:block;";
		state_label.innerHTML = w_mini_labels[3];
			


	var postal = document.createElement('input');
        postal.setAttribute("type", 'text');
		postal.style.cssText = "width:100%";
		postal.setAttribute("id", i+"_postalform_id_temp");
	   	postal.setAttribute("name", (parseInt(i)+4)+"_postalform_id_temp");
		postal.setAttribute("onChange", "change_value('"+i+"_postalform_id_temp')");

	var postal_label = document.createElement('label');
		postal_label.setAttribute("class", "mini_label");
    postal_label.setAttribute("id", i+"_mini_label_postal");
    postal_label.style.cssText = "display:block;";
		postal_label.innerHTML=w_mini_labels[4];
			
	var country = document.createElement('select');
        country.setAttribute("type", 'text');
		country.style.cssText = "width:100%";
		country.setAttribute("id", i+"_countryform_id_temp");
	   	country.setAttribute("name", (parseInt(i)+5)+"_countryform_id_temp");
		country.setAttribute("onChange", "change_value('"+i+"_countryform_id_temp')");

	var country_label = document.createElement('label');
		country_label.setAttribute("class", "mini_label");
    country_label.setAttribute("id", i+"_mini_label_country");
    country_label.style.cssText = "display:block;";
		country_label.innerHTML=w_mini_labels[5];
			
		
		var option_ = document.createElement('option');
			option_.setAttribute("value", "");
			option_.innerHTML="";
		country.appendChild(option_);
		
		coutries=["Afghanistan","Albania",	"Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros","Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepa","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"];	
		for(r=0;r<coutries.length;r++)
		{
		var option_ = document.createElement('option');
			option_.setAttribute("value", coutries[r]);
			option_.innerHTML=coutries[r];
		country.appendChild(option_);
		}









	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
		

      	span_addres1.appendChild(street1);
      	span_addres1.appendChild(street1_label);
		
       	span_addres2.appendChild(street2);
      	span_addres2.appendChild(street2_label);
		
    	span_addres3_1.appendChild(city);		
      	span_addres3_1.appendChild(city_label);
    	span_addres3_2.appendChild(state);		
      	span_addres3_2.appendChild(state_label);
		
		
    	span_addres4_1.appendChild(postal);		
      	span_addres4_1.appendChild(postal_label);
    	span_addres4_2.appendChild(country);		
      	span_addres4_2.appendChild(country_label);
		
		
		if(w_disabled_fields[0]=="no")
			div_address.appendChild(span_addres1);
		if(w_disabled_fields[1]=="no")
			div_address.appendChild(span_addres2);	
		if(w_disabled_fields[2]=="no")
			div_address.appendChild(span_addres3_1);	
		if(w_disabled_fields[3]=="no")
			div_address.appendChild(span_addres3_2);
		if(w_disabled_fields[4]=="no")
			div_address.appendChild(span_addres4_1);
		if(w_disabled_fields[5]=="no")		
			div_address.appendChild(span_addres4_2);
		
		
       	td2.appendChild(adding_type);
       	td2.appendChild(adding_required);
        td2.appendChild(adding_country);
        td2.appendChild(div_address);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
        div.appendChild(div_for_editable_labels);
      	main_td.appendChild(div);
		
	if(w_field_label_pos=="top")
				label_top(i);
  change_class(w_class, i);
  refresh_attr(i, 'type_address');
  jQuery(document).ready(function() {		
    jQuery("label#"+i+"_mini_label_street1").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var street1 = "<input type='text' class='street1' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(street1);		
        jQuery("input.street1").focus();
        jQuery("input.street1").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_street1").text(value);
          document.getElementById('el_street1_label').innerHTML = value;
        });
      }
    });
    jQuery("label#"+i+"_mini_label_street2").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var street2 = "<input type='text' class='street2'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(street2);
        jQuery("input.street2").focus();
        jQuery("input.street2").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_street2").text(value);
          document.getElementById('el_street2_label').innerHTML = value;
        });		
      }	
    });
    jQuery("label#"+i+"_mini_label_city").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var city = "<input type='text' class='city'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(city);
        jQuery("input.city").focus();
        jQuery("input.city").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_city").text(value);
          document.getElementById('el_city_label').innerHTML = value;
        });
      }
    });
    jQuery("label#"+i+"_mini_label_state").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var state = "<input type='text' class='state'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(state);
        jQuery("input.state").focus();
        jQuery("input.state").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_state").text(value);
          document.getElementById('el_state_label').innerHTML = value;
        });	
      }
    });
    jQuery("label#"+i+"_mini_label_postal").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var postal = "<input type='text' class='postal'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(postal);
        jQuery("input.postal").focus();
        jQuery("input.postal").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_postal").text(value);
          document.getElementById('el_postal_label').innerHTML = value;
        });
      }
    });
    jQuery("label#"+i+"_mini_label_country").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var country = "<input type='text' class='country'  style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(country);
        jQuery("input.country").focus();
        jQuery("input.country").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_country").text(value);
          document.getElementById('el_country_label').innerHTML = value;
        });	
      }	
    });
	});
}

function type_submitter_mail(i, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_send, w_required, w_unique, w_class, w_attr_name, w_attr_value){
    document.getElementById("element_type").value="type_submitter_mail";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		   
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");

	var el_first_value_label = document.createElement('label');
	        el_first_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_first_value_label.innerHTML = "Value if empty";
	
	var el_first_value_input = document.createElement('input');
                el_first_value_input.setAttribute("id", "el_first_value_input");
                el_first_value_input.setAttribute("type", "text");
                el_first_value_input.setAttribute("value", w_title);
                el_first_value_input.style.cssText = "width:150px;";
                el_first_value_input.setAttribute("onKeyUp", "change_input_value(this.value,'"+i+"_elementform_id_temp')");
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
 		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	
	
	var el_send_label = document.createElement('label');
	        el_send_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_send_label.innerHTML = "Send mail to submitter ";
	
	var el_send = document.createElement('input');
                el_send.setAttribute("id", "el_send");
                el_send.setAttribute("type", "checkbox");
                el_send.setAttribute("value", "yes");
                el_send.setAttribute("onclick", "set_send('"+i+"_sendform_id_temp')");
	if(w_send=="yes")
			
                el_send.setAttribute("checked", "checked");
	
	
	
	
	
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");

	var el_unique_label = document.createElement('label');
	    el_unique_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_unique_label.innerHTML = "Allow only unique values";
	
	var el_unique = document.createElement('input');
                el_unique.setAttribute("id", "el_send");
                el_unique.setAttribute("type", "checkbox");
                el_unique.setAttribute("value", "yes");
                el_unique.setAttribute("onclick", "set_unique('"+i+"_uniqueform_id_temp')");
	if(w_unique=="yes")
                el_unique.setAttribute("checked", "checked");
			
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_size);
	
	edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4_1.appendChild(el_first_value_input);

	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_send_label);
	edit_main_td6_1.appendChild(el_send);
	
	edit_main_td7.appendChild(el_required_label);
	edit_main_td7_1.appendChild(el_required);
	
	edit_main_td9.appendChild(el_unique_label);
	edit_main_td9_1.appendChild(el_unique);
	
	edit_main_td8.appendChild(el_attr_label);
	edit_main_td8.appendChild(el_attr_add);
	edit_main_td8.appendChild(br4);
	edit_main_td8.appendChild(el_attr_table);
	edit_main_td8.setAttribute("colspan", "2");
	
/*	edit_main_td5.appendChild(el_guidelines_label);
	edit_main_td5.appendChild(br4);
	edit_main_td5.appendChild(el_guidelines_textarea);
*/	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr8);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table

	element='input';	type='text'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_submitter_mail");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
	    
	var adding_send = document.createElement("input");
            adding_send.setAttribute("type", "hidden");
            adding_send.setAttribute("value", w_send);
            adding_send.setAttribute("name", i+"_sendform_id_temp");
            adding_send.setAttribute("id", i+"_sendform_id_temp");
			
	var adding_unique= document.createElement("input");
            adding_unique.setAttribute("type", "hidden");
            adding_unique.setAttribute("value", w_unique);
            adding_unique.setAttribute("name", i+"_uniqueform_id_temp");
            adding_unique.setAttribute("id", i+"_uniqueform_id_temp");
			
	var adding = document.createElement(element);
            adding.setAttribute("type", type);
		
		
		if(w_title==w_first_val)
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_deactive");
		}
		else
		{
			adding.style.cssText = "width:"+w_size+"px;";
			adding.setAttribute("class", "input_active");
		}
			adding.setAttribute("id", i+"_elementform_id_temp");
			adding.setAttribute("name", i+"_elementform_id_temp");
			adding.setAttribute("value", w_first_val);
			adding.setAttribute("title", w_title);
			
			adding.setAttribute("onFocus", "delete_value('"+i+"_elementform_id_temp')");
			adding.setAttribute("onBlur", "return_value('"+i+"_elementform_id_temp')");
			adding.setAttribute("onChange", "change_value('"+i+"_elementform_id_temp')");
			

     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
      	td2.appendChild(adding_send);
      	td2.appendChild(adding_unique);
      	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_checkbox(i, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other,w_allow_other_num, w_class, w_attr_name, w_attr_value) {

	document.getElementById("element_type").value="type_checkbox";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");
  var edit_main_tr10  = document.createElement('tr');
      		edit_main_tr10.setAttribute("valing", "top");
	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";

		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
      	edit_main_td4.setAttribute("id", "choices");
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
  var edit_main_td10 = document.createElement('td');
		edit_main_td10.style.cssText = "padding-top:10px";
	var edit_main_td10_1 = document.createElement('td');
		edit_main_td10_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
			
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	var el_label_flow = document.createElement('label');
			        el_label_flow.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_flow.innerHTML = "Relative Position";
	
	var el_flow_vertical = document.createElement('input');
                el_flow_vertical.setAttribute("id", "edit_for_flow_vertical");
                el_flow_vertical.setAttribute("type", "radio");
                el_flow_vertical.setAttribute("value", "ver");
                el_flow_vertical.setAttribute("name", "edit_for_flow");
                el_flow_vertical.setAttribute("onchange", "refresh_rowcol("+i+",'checkbox')");
		Vertical = document.createTextNode("Vertical");
		
	var el_flow_horizontal = document.createElement('input');
                el_flow_horizontal.setAttribute("id", "edit_for_flow_horizontal");
                el_flow_horizontal.setAttribute("type", "radio");
                el_flow_horizontal.setAttribute("value", "hor");
                el_flow_horizontal.setAttribute("name", "edit_for_flow");
                el_flow_horizontal.setAttribute("onchange", "refresh_rowcol("+i+",'checkbox')");
		Horizontal = document.createTextNode("Horizontal");
		
	if(w_flow=="hor")
				el_flow_horizontal.setAttribute("checked", "checked");
	else
				el_flow_vertical.setAttribute("checked", "checked");
  var el_rowcol_label = document.createElement('label');
	        el_rowcol_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_rowcol_label.innerHTML = "Rows/Columns";
	
	var el_rowcol_textarea = document.createElement('input');
                el_rowcol_textarea.setAttribute("id", "edit_for_rowcol");
		el_rowcol_textarea.setAttribute("type", "text");
 		el_rowcol_textarea.setAttribute("value", w_rowcol);
                el_rowcol_textarea.style.cssText = "width:200px;";
                el_rowcol_textarea.setAttribute("onChange", "refresh_rowcol('"+i+"','checkbox')");
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
 		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
		
		
				
	var el_randomize_label = document.createElement('label');
				el_randomize_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_randomize_label.innerHTML = "Randomize in frontend";
	
	var el_randomize = document.createElement('input');
                el_randomize.setAttribute("id", "el_randomize");
                el_randomize.setAttribute("type", "checkbox");
                el_randomize.setAttribute("value", "yes");
                el_randomize.setAttribute("onclick", "set_randomize('"+i+"_randomizeform_id_temp')");
	if(w_randomize=="yes")
			    el_randomize.setAttribute("checked", "checked");

	var el_allow_other_label = document.createElement('label');
				el_allow_other_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_allow_other_label.innerHTML = "Allow other";
	
	var el_allow_other = document.createElement('input');
                el_allow_other.setAttribute("id", "el_allow_other");
                el_allow_other.setAttribute("type", "checkbox");
                el_allow_other.setAttribute("value", "yes");
                el_allow_other.setAttribute("onclick", "set_allow_other('"+i+"','checkbox')");
	if(w_allow_other=="yes")
			    el_allow_other.setAttribute("checked", "checked");



		
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_checkbox')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var el_choices_label = document.createElement('label');
			        el_choices_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_choices_label.innerHTML = "Options ";
	var el_choices_add = document.createElement('img');
                el_choices_add.setAttribute("id", "el_choices_add");
           		el_choices_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_choices_add.style.cssText = 'cursor:pointer;';
            	el_choices_add.setAttribute("title", 'add');
                el_choices_add.setAttribute("onClick", "add_choise('checkbox',"+i+")");
	
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);

	edit_main_td3.appendChild(el_label_flow);
	edit_main_td3_1.appendChild(el_flow_vertical);
	edit_main_td3_1.appendChild(Vertical);
	edit_main_td3_1.appendChild(br4);
	edit_main_td3_1.appendChild(el_flow_horizontal);
	edit_main_td3_1.appendChild(Horizontal);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_randomize_label);
	edit_main_td8_1.appendChild(el_randomize);
	
	edit_main_td9.appendChild(el_allow_other_label);
	edit_main_td9_1.appendChild(el_allow_other);
  edit_main_td10.appendChild(el_rowcol_label);
	edit_main_td10_1.appendChild(el_rowcol_textarea);
	
	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_td4.appendChild(el_choices_label);
	edit_main_td4_1.appendChild(el_choices_add);
	
	n=w_choices.length;
	for(j=0; j<n; j++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "br"+j);
			
		var el_choices = document.createElement('input');
			el_choices.setAttribute("id", "el_choices"+j);
			el_choices.setAttribute("type", "text");
      if (w_allow_other == "yes" && j == w_allow_other_num) {
        el_choices.setAttribute("other", '1');
      }
			el_choices.setAttribute("value", w_choices[j]);
			el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_choices.setAttribute("onKeyUp", "change_label('"+i+"_label_element"+j+"', this.value); change_in_value('"+i+"_elementform_id_temp"+j+"', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
		if(w_allow_other=="yes" && j==w_allow_other_num)
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px; display:none';
		else			
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_choise("+j+","+i+",'checkbox')");
			
		edit_main_td4.appendChild(br);
		edit_main_td4.appendChild(el_choices);
		edit_main_td4.appendChild(el_choices_remove);
	
	}

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
  edit_main_tr10.appendChild(edit_main_td10);
	edit_main_tr10.appendChild(edit_main_td10_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr10);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='input';	type='checkbox'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_checkbox");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
 	var adding_randomize = document.createElement("input");
            adding_randomize.setAttribute("type", "hidden");
            adding_randomize.setAttribute("value", w_randomize);
            adding_randomize.setAttribute("name", i+"_randomizeform_id_temp");			
            adding_randomize.setAttribute("id", i+"_randomizeform_id_temp");
	    
	var adding_allow_other= document.createElement("input");
            adding_allow_other.setAttribute("type", "hidden");
            adding_allow_other.setAttribute("value", w_allow_other);
            adding_allow_other.setAttribute("name", i+"_allow_otherform_id_temp");			
            adding_allow_other.setAttribute("id", i+"_allow_otherform_id_temp");
	    
	var adding_allow_other_id= document.createElement("input");
            adding_allow_other_id.setAttribute("type", "hidden");
            adding_allow_other_id.setAttribute("value", w_allow_other_num);
            adding_allow_other_id.setAttribute("name", i+"_allow_other_numform_id_temp");			
            adding_allow_other_id.setAttribute("id", i+"_allow_other_numform_id_temp");
  var adding_rowcol= document.createElement("input");
            adding_rowcol.setAttribute("type", "hidden");
            adding_rowcol.setAttribute("value", w_rowcol);
            adding_rowcol.setAttribute("name", i+"_rowcol_numform_id_temp");			
            adding_rowcol.setAttribute("id", i+"_rowcol_numform_id_temp");
   var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", i+"_elemet_tableform_id_temp");
	
    var tr = document.createElement('tr');
			
    var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
	//	table_little -@ sarqaca tbody table_little darela table_little_t
	var table_little_t = document.createElement('table');
			
	var table_little = document.createElement('tbody');
           	table_little.setAttribute("id", i+"_table_little");
	table_little_t.appendChild(table_little);
	

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");

	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
  n = w_choices.length;
  aaa = false;
  var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
        td2.appendChild(adding_type);
  
        td2.appendChild(adding_required);
        td2.appendChild(adding_randomize);
       	td2.appendChild(adding_allow_other);
       	td2.appendChild(adding_allow_other_id);
        td2.appendChild(adding_rowcol);
        td2.appendChild(table_little_t);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if (w_field_label_pos == "top") {
    label_top(i);
  }
	change_class(w_class, i);
  refresh_attr(i, 'type_checkbox');
  if (aaa) {
    show_other_input(i);
  }
  refresh_rowcol(i, 'checkbox');
  add_id_and_name(i, 'type_checkbox');
}

function type_radio(i, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value ){

	document.getElementById("element_type").value="type_radio";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
			
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
			
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");
  var edit_main_tr10  = document.createElement('tr');
      		edit_main_tr10.setAttribute("valing", "top");
	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";

	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
		edit_main_td4.setAttribute("id", "choices");
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
  var edit_main_td10 = document.createElement('td');
		edit_main_td10.style.cssText = "padding-top:10px";
	var edit_main_td10_1 = document.createElement('td');
		edit_main_td10_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");

                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	var el_label_flow = document.createElement('label');
			        el_label_flow.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_flow.innerHTML = "Relative Position";

	var el_flow_vertical = document.createElement('input');
                el_flow_vertical.setAttribute("id", "edit_for_flow_vertical");
                el_flow_vertical.setAttribute("type", "radio");
                el_flow_vertical.setAttribute("value", "ver");
                el_flow_vertical.setAttribute("name", "edit_for_flow");
                el_flow_vertical.setAttribute("onchange", "refresh_rowcol("+i+",'radio')");
		Vertical = document.createTextNode("Vertical");
		
	var el_flow_horizontal = document.createElement('input');
            el_flow_horizontal.setAttribute("id", "edit_for_flow_horizontal");
            el_flow_horizontal.setAttribute("type", "radio");
            el_flow_horizontal.setAttribute("value", "hor");
            el_flow_horizontal.setAttribute("name", "edit_for_flow");
            el_flow_horizontal.setAttribute("onchange", "refresh_rowcol("+i+",'radio')");
		Horizontal = document.createTextNode("Horizontal");
		
	if(w_flow=="hor")
				el_flow_horizontal.setAttribute("checked", "checked");
	else
				el_flow_vertical.setAttribute("checked", "checked");
  var el_rowcol_label = document.createElement('label');
	        el_rowcol_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_rowcol_label.innerHTML = "Rows/Columns";
	
	var el_rowcol_textarea = document.createElement('input');
                el_rowcol_textarea.setAttribute("id", "edit_for_rowcol");
		el_rowcol_textarea.setAttribute("type", "text");
 		el_rowcol_textarea.setAttribute("value", w_rowcol);
                el_rowcol_textarea.style.cssText = "width:200px;";
                el_rowcol_textarea.setAttribute("onChange", "refresh_rowcol('"+i+"','radio')");
	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
        el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
        el_style_textarea.style.cssText = "width:200px;";
        el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");

				
	var el_randomize_label = document.createElement('label');
				el_randomize_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_randomize_label.innerHTML = "Randomize in frontend";
	
	var el_randomize = document.createElement('input');
                el_randomize.setAttribute("id", "el_randomize");
                el_randomize.setAttribute("type", "checkbox");
                el_randomize.setAttribute("value", "yes");
                el_randomize.setAttribute("onclick", "set_randomize('"+i+"_randomizeform_id_temp')");
	if(w_randomize=="yes")
			    el_randomize.setAttribute("checked", "checked");

	var el_allow_other_label = document.createElement('label');
				el_allow_other_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_allow_other_label.innerHTML = "Allow other";
	
	var el_allow_other = document.createElement('input');
                el_allow_other.setAttribute("id", "el_allow_other");
                el_allow_other.setAttribute("type", "checkbox");
                el_allow_other.setAttribute("value", "yes");
                el_allow_other.setAttribute("onclick", "set_allow_other('"+i+"','radio')");
	if(w_allow_other=="yes")
			    el_allow_other.setAttribute("checked", "checked");




	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_checkbox')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var el_choices_label = document.createElement('label');
			        el_choices_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_choices_label.innerHTML = "Options ";

	
	var el_choices_add = document.createElement('img');
                el_choices_add.setAttribute("id", "el_choices_add");
           	el_choices_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_choices_add.style.cssText = 'cursor:pointer;';
            	el_choices_add.setAttribute("title", 'add');
                el_choices_add.setAttribute("onClick", "add_choise('radio',"+i+")");
				
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	

	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_label_flow);
	edit_main_td3_1.appendChild(el_flow_vertical);
	edit_main_td3_1.appendChild(Vertical);
	edit_main_td3_1.appendChild(br4);
	edit_main_td3_1.appendChild(el_flow_horizontal);
	edit_main_td3_1.appendChild(Horizontal);

	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_randomize_label);
	edit_main_td8_1.appendChild(el_randomize);
	
	edit_main_td9.appendChild(el_allow_other_label);
	edit_main_td9_1.appendChild(el_allow_other);
	edit_main_td10.appendChild(el_rowcol_label);
	edit_main_td10_1.appendChild(el_rowcol_textarea);
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_td4.appendChild(el_choices_label);
	edit_main_td4_1.appendChild(el_choices_add);

	
	n=w_choices.length;
	for(j=0; j<n; j++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "br"+j);
			
		var el_choices = document.createElement('input');
			el_choices.setAttribute("id", "el_choices"+j);
			el_choices.setAttribute("type", "text");
      if (w_allow_other == "yes" && j == w_allow_other_num) {
        el_choices.setAttribute("other", '1');
      }
			el_choices.setAttribute("value", w_choices[j]);
			el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_choices.setAttribute("onKeyUp", "change_label('"+i+"_label_element"+j+"', this.value); change_in_value('"+i+"_elementform_id_temp"+j+"', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
		if(w_allow_other=="yes" && j==w_allow_other_num)
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px; display:none';
		else			
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_choise("+j+","+i+",'radio')");
			
		edit_main_td4.appendChild(br);
		edit_main_td4.appendChild(el_choices);
		edit_main_td4.appendChild(el_choices_remove);
	
	}


	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
  edit_main_tr10.appendChild(edit_main_td10);
	edit_main_tr10.appendChild(edit_main_td10_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
  edit_main_table.appendChild(edit_main_tr10);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='input';	type='radio'; 
		var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_radio");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
	    
	var adding_randomize = document.createElement("input");
            adding_randomize.setAttribute("type", "hidden");
            adding_randomize.setAttribute("value", w_randomize);
            adding_randomize.setAttribute("name", i+"_randomizeform_id_temp");			
            adding_randomize.setAttribute("id", i+"_randomizeform_id_temp");
	    
	var adding_allow_other= document.createElement("input");
            adding_allow_other.setAttribute("type", "hidden");
            adding_allow_other.setAttribute("value", w_allow_other);
            adding_allow_other.setAttribute("name", i+"_allow_otherform_id_temp");			
            adding_allow_other.setAttribute("id", i+"_allow_otherform_id_temp");
  var adding_rowcol= document.createElement("input");
            adding_rowcol.setAttribute("type", "hidden");
            adding_rowcol.setAttribute("value", w_rowcol);
            adding_rowcol.setAttribute("name", i+"_rowcol_numform_id_temp");			
            adding_rowcol.setAttribute("id", i+"_rowcol_numform_id_temp");
     var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
			
	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
	
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
//tbody sarqac		
		var table_little_t = document.createElement('table');
			
		var table_little = document.createElement('tbody');
           	table_little.setAttribute("id", i+"_table_little");
			
		table_little_t.appendChild(table_little);
	
      	var tr_little1 = document.createElement('tr');
	        tr_little1.setAttribute("id", i+"_element_tr1");
		
      	var tr_little2 = document.createElement('tr');
 	        tr_little2.setAttribute("id", i+"_element_tr2");
			
      	var td_little1 = document.createElement('td');
         	td_little1.setAttribute("valign", 'top');
           	td_little1.setAttribute("id", i+"_td_little1");
			
      	var td_little2 = document.createElement('td');
        	td_little2.setAttribute("valign", 'top');
           	td_little2.setAttribute("id", i+"_td_little2");
			

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	n=w_choices.length;
	aaa=false;
	
	    
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
       	td2.appendChild(adding_type);
	
       	td2.appendChild(adding_required);
       	td2.appendChild(adding_randomize);
       	td2.appendChild(adding_allow_other);
        td2.appendChild(adding_rowcol);
        td2.appendChild(table_little_t);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if (w_field_label_pos == "top") {
    label_top(i);
  }
  change_class(w_class, i);
  refresh_attr(i, 'type_checkbox');
  if (aaa) {
    show_other_input(i);
  }
  refresh_rowcol(i, 'radio');
  add_id_and_name(i, 'type_radio');

}

function type_time(i, w_field_label, w_field_label_pos, w_time_type, w_am_pm, w_sec, w_hh, w_mm, w_ss, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value) {
	
	document.getElementById("element_type").value="type_time";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_label_time_type_label = document.createElement('label');
	        el_label_time_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_time_type_label.innerHTML = "Time Format";
	
	var el_label_time_type1 = document.createElement('input');
                el_label_time_type1.setAttribute("id", "el_label_time_type1");
                el_label_time_type1.setAttribute("type", "radio");
                el_label_time_type1.setAttribute("value", "format_24");
                el_label_time_type1.setAttribute("name", "edit_for_time_type");
                el_label_time_type1.setAttribute("onchange", "format_24("+i+")");
		el_label_time_type1.setAttribute("checked", "checked");
		hour_24 = document.createTextNode("24 hour");
		
	var el_label_time_type2 = document.createElement('input');
                el_label_time_type2.setAttribute("id", "el_label_time_type2");
                el_label_time_type2.setAttribute("type", "radio");
                el_label_time_type2.setAttribute("value", "format_12");
                el_label_time_type2.setAttribute("name", "edit_for_time_type");
                el_label_time_type2.setAttribute("onchange", "format_12("+i+", 'am','', '','')");
		am_pm = document.createTextNode("12 hour");
		
	if(w_time_type=="24")
	
				el_label_time_type1.setAttribute("checked", "checked");
	else
				el_label_time_type2.setAttribute("checked", "checked");

	var el_label_second_label = document.createElement('label');
	        el_label_second_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_second_label.innerHTML = "Display Seconds";
	
	var el_second_yes = document.createElement('input');
                el_second_yes.setAttribute("id", "el_second_yes");
                el_second_yes.setAttribute("type", "radio");
                el_second_yes.setAttribute("value", "yes");
                el_second_yes.setAttribute("name", "edit_for_time_second");
                el_second_yes.setAttribute("onchange", "second_yes("+i+",'"+w_ss+"')");
		el_second_yes.setAttribute("checked", "checked");
		display_seconds = document.createTextNode("Yes");
		
	var el_second_no = document.createElement('input');
                el_second_no.setAttribute("id", "el_second_no");
                el_second_no.setAttribute("type", "radio");
                el_second_no.setAttribute("value", "no");
                el_second_no.setAttribute("name", "edit_for_time_second");
                el_second_no.setAttribute("onchange", "second_no("+i+")");
		dont_display_seconds = document.createTextNode("No");
		
	if(w_sec=="1")
	
				el_second_yes.setAttribute("checked", "checked");
	else
				el_second_no.setAttribute("checked", "checked");
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_time')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_time')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_time')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_time')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_label_time_type_label);
	edit_main_td3_1.appendChild(el_label_time_type1);
	edit_main_td3_1.appendChild(hour_24);
	edit_main_td3_1.appendChild(br6);
	edit_main_td3_1.appendChild(el_label_time_type2);
	edit_main_td3_1.appendChild(am_pm);
	
	edit_main_td4.appendChild(el_label_second_label);
	edit_main_td4_1.appendChild(el_second_yes);
	edit_main_td4_1.appendChild(display_seconds);
	edit_main_td4_1.appendChild(br4);
	edit_main_td4_1.appendChild(el_second_no);
	edit_main_td4_1.appendChild(dont_display_seconds);
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);

	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_time');
	
//show table
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_time");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
        var div_for_editable_labels = document.createElement('div');
			div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
			
      	edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");

		div_for_editable_labels.appendChild(edit_labels);
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var table_time = document.createElement('table');
           	table_time.setAttribute("id", i+"_table_time");
           	table_time.setAttribute("cellpadding", '0');
           	table_time.setAttribute("cellspacing", '0');
      	var tr_time1 = document.createElement('tr');
           	tr_time1.setAttribute("id", i+"_tr_time1");
			
      	var tr_time2 = document.createElement('tr');
           	tr_time2.setAttribute("id", i+"_tr_time2");
			
      	var td_time_input1 = document.createElement('td');
           	td_time_input1.setAttribute("id", i+"_td_time_input1");
	        td_time_input1.style.cssText ="width:32px";
		
      	var td_time_input1_ket = document.createElement('td');
           	td_time_input1_ket.setAttribute("align", "center");
		
		
		
      	var td_time_input2 = document.createElement('td');
           	td_time_input2.setAttribute("id", i+"_td_time_input2");
 	        td_time_input2.style.cssText ="width:32px";
     	var td_time_input2_ket = document.createElement('td');
           	td_time_input2_ket.setAttribute("align", "center");
		
      	var td_time_input3 = document.createElement('td');
           	td_time_input3.setAttribute("id", i+"_td_time_input3");
 	        td_time_input3.style.cssText ="width:32px";

      	var td_time_label1 = document.createElement('td');
           	td_time_label1.setAttribute("id", i+"_td_time_label1");
      	var td_time_label1_ket = document.createElement('td');
      	var td_time_label2 = document.createElement('td');
           	td_time_label2.setAttribute("id", i+"_td_time_label2");
      	var td_time_label2_ket = document.createElement('td');
      	var td_time_label3 = document.createElement('td');
           	td_time_label3.setAttribute("id", i+"_td_time_label3");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

      	var label = document.createElement('span');
		label.setAttribute("id", i+"_element_labelform_id_temp");
		label.innerHTML = w_field_label;
		label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
			
	var hh = document.createElement('input');
	hh.setAttribute("type", 'text');
	hh.setAttribute("value", w_hh);
	    hh.setAttribute("class", "time_box");
	    hh.setAttribute("id", i+"_hhform_id_temp");
	    hh.setAttribute("name", i+"_hhform_id_temp");
	    hh.setAttribute("onKeyPress", "return check_hour(event, '"+i+"_hhform_id_temp', '23')");
	    hh.setAttribute("onKeyUp", "change_hour(event, '"+i+"_hhform_id_temp','23')");
	    hh.setAttribute("onBlur", "add_0('"+i+"_hhform_id_temp')");
			
	var hh_label = document.createElement('label');
	    hh_label.setAttribute("class", "mini_label");
	    hh_label.setAttribute("id", i+"_mini_label_hh");
	    hh_label.innerHTML = w_mini_labels[0];
			
	var hh_ = document.createElement('span');
        hh_.setAttribute("class", 'wdform_colon');
	    hh_.style.cssText = "font-style:bold; vertical-align:middle";
	    hh_.innerHTML="&nbsp;:&nbsp;";
		
	var mm = document.createElement('input');
        mm.setAttribute("type", 'text');
		mm.setAttribute("value", w_mm);
		mm.setAttribute("class", "time_box");
		
		mm.setAttribute("id", i+"_mmform_id_temp");
	    	mm.setAttribute("name", i+"_mmform_id_temp");
		mm.setAttribute("onKeyPress", "return check_minute(event, '"+i+"_mmform_id_temp')");
	        mm.setAttribute("onKeyUp", "change_minute(event, '"+i+"_mmform_id_temp')");
		mm.setAttribute("onBlur", "add_0('"+i+"_mmform_id_temp')");
		
	var mm_label = document.createElement('label');
		mm_label.setAttribute("class", "mini_label");
		mm_label.setAttribute("id", i+"_mini_label_mm");
		mm_label.innerHTML = w_mini_labels[1];
			
	var mm_ = document.createElement('span');
		mm_.style.cssText = "font-style:bold; vertical-align:middle";
		mm_.innerHTML="&nbsp;:&nbsp;";
        mm_.setAttribute("class", 'wdform_colon');
		
	var ss = document.createElement('input');
           	ss.setAttribute("type", 'text');
		ss.setAttribute("value", w_ss);
		ss.setAttribute("class", "time_box");
		
		ss.setAttribute("id", i+"_ssform_id_temp");
		ss.setAttribute("name", i+"_ssform_id_temp");
		ss.setAttribute("onKeyPress", "return check_second(event, '"+i+"_ssform_id_temp')");
		ss.setAttribute("onKeyUp", "change_second(event, '"+i+"_ssform_id_temp')");
		ss.setAttribute("onBlur", "add_0('"+i+"_ssform_id_temp')");

	var ss_label = document.createElement('label');
		ss_label.setAttribute("class", "mini_label");
		ss_label.setAttribute("id", i+"_mini_label_ss");
		ss_label.innerHTML = w_mini_labels[2];
			
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
		
      	td_time_input1.appendChild(hh);
      	td_time_input1_ket.appendChild(hh_);
      	td_time_input2.appendChild(mm);
      	td_time_input2_ket.appendChild(mm_);
      	td_time_input3.appendChild(ss);
      	tr_time1.appendChild(td_time_input1);
      	tr_time1.appendChild(td_time_input1_ket);
      	tr_time1.appendChild(td_time_input2);
      	tr_time1.appendChild(td_time_input2_ket);
      	tr_time1.appendChild(td_time_input3);
		
      	td_time_label1.appendChild(hh_label);
      	td_time_label2.appendChild(mm_label);
      	td_time_label3.appendChild(ss_label);
      	tr_time2.appendChild(td_time_label1);
      	tr_time2.appendChild(td_time_label1_ket);
      	tr_time2.appendChild(td_time_label2);
      	tr_time2.appendChild(td_time_label2_ket);
      	tr_time2.appendChild(td_time_label3);
      	table_time.appendChild(tr_time1);
      	table_time.appendChild(tr_time2);
		
        td2.appendChild(adding_type);
	
        td2.appendChild(adding_required);
	td2.appendChild(table_time);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
        div.appendChild(div_for_editable_labels);
      	main_td.appendChild(div);

	if(w_field_label_pos=="top")
				label_top(i);
	if(w_time_type=="12")
				format_12(i, w_am_pm,w_hh, w_mm,w_ss);

	if (w_sec == "0") {
    second_no(i);
  }
  change_class(w_class, i);
  refresh_attr(i, 'type_time');
  jQuery(document).ready(function() {
    jQuery("label#"+i+"_mini_label_hh").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var hh = "<input type='text' class='hh' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(hh);							
        jQuery("input.hh").focus();			
        jQuery("input.hh").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_hh").text(value);
        });
      }
    });
    jQuery("label#"+i+"_mini_label_mm").click(function() {	
      if (jQuery(this).children('input').length == 0) {		
        var mm = "<input type='text' class='mm' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(mm);			
        jQuery("input.mm").focus();					
        jQuery("input.mm").blur(function() {			
          var value = jQuery(this).val();			
          jQuery("#"+i+"_mini_label_mm").text(value);	
        });
      }
    });
		jQuery("label#"+i+"_mini_label_ss").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var ss = "<input type='text' class='ss' size='4' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(ss);
        jQuery("input.ss").focus();
        jQuery("input.ss").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_mini_label_ss").text(value);
        });
      }
    });
	});
}

function type_date(i, w_field_label, w_field_label_pos, w_date, w_required, w_class, w_format, w_but_val, w_attr_name, w_attr_value) { 

	document.getElementById("element_type").value="type_date";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_format_label = document.createElement('label');
	        el_format_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_format_label.innerHTML = "Date format";
	
	var el_format_textarea = document.createElement('input');
                el_format_textarea.setAttribute("id", "date_format");
		el_format_textarea.setAttribute("type", "text");
		el_format_textarea.setAttribute("value", w_format);
                el_format_textarea.style.cssText = "width:200px;";
                el_format_textarea.setAttribute("onChange", "change_date_format(this.value,'"+i+"')");

	var el_button_value_label = document.createElement('label');
	        el_button_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_button_value_label.innerHTML = "Date Picker label";
	
	var el_button_value_textarea = document.createElement('input');
                el_button_value_textarea.setAttribute("id", "button_value");
		el_button_value_textarea.setAttribute("type", "text");
		el_button_value_textarea.setAttribute("value", w_but_val);
                el_button_value_textarea.style.cssText = "width:150px;";
                el_button_value_textarea.setAttribute("onKeyUp", "change_file_value(this.value,'"+i+"_buttonform_id_temp')");

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
		
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_date')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_date')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_date')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_date')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);

	edit_main_td3.appendChild(el_format_label);
	edit_main_td3_1.appendChild(el_format_textarea);
	
	edit_main_td4.appendChild(el_button_value_label);
	edit_main_td4_1.appendChild(el_button_value_textarea);
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br3);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_date");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var table_date = document.createElement('table');
           	table_date.setAttribute("id", i+"_table_date");
           	table_date.setAttribute("cellpadding", '0');
           	table_date.setAttribute("cellspacing", '0');
			
      	var tr_date1 = document.createElement('tr');
           	tr_date1.setAttribute("id", i+"_tr_date1");
			
      	var tr_date2 = document.createElement('tr');
           	tr_date2.setAttribute("id", i+"_tr_date2");
			
      	var td_date_input1 = document.createElement('td');
           	td_date_input1.setAttribute("id", i+"_td_date_input1");
			
      	var td_date_input2 = document.createElement('td');
           	td_date_input2.setAttribute("id", i+"_td_date_input2");
			
      	var td_date_input3 = document.createElement('td');
           	td_date_input3.setAttribute("id", i+"_td_date_input3");

      	var td_date_label1 = document.createElement('td');
           	td_date_label1.setAttribute("id", i+"_td_date_label1");
			
      	var td_date_label2 = document.createElement('td');
           	td_date_label2.setAttribute("id", i+"_td_date_label2");
			
      	var td_date_label3 = document.createElement('td');
           	td_date_label3.setAttribute("id", i+"_td_date_label3");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

      	var label = document.createElement('span');
		label.setAttribute("id", i+"_element_labelform_id_temp");
		label.innerHTML = w_field_label;
		label.setAttribute("class", "label");
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
			
	var adding = document.createElement('input');
            adding.setAttribute("type", 'text');
            adding.setAttribute("value", w_date);
            adding.setAttribute("class", 'wdform_date');
			adding.setAttribute("id", i+"_elementform_id_temp");
			adding.setAttribute("name", i+"_elementform_id_temp");
			adding.setAttribute("maxlength", "10");
			adding.setAttribute("size", "10");
			adding.setAttribute("onChange", "change_value('"+i+"_elementform_id_temp')");
		
	var adding_button = document.createElement('input');
 	    adding_button.setAttribute("id", i+"_buttonform_id_temp");
            adding_button.setAttribute("type", 'reset');
            adding_button.setAttribute("value", w_but_val);
            adding_button.setAttribute("format", w_format);
            adding_button.setAttribute("onclick", "return showCalendar('"+i+"_elementform_id_temp' ,'"+w_format+"')");
            adding_button.setAttribute("class", 'button');
	    
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required);
		
      	td2.appendChild(adding_type);
	
      	td2.appendChild(adding_required);
		td2.appendChild(adding);
		td2.appendChild(adding_button);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);

	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_date');
}

function field_to_select(id, type)
{

	switch(type)
	{
		case 'day': 
		{
			w_width=document.getElementById('edit_for_day_size').value!=''?document.getElementById('edit_for_day_size').value:30;
			w_day=document.getElementById(id+"_dayform_id_temp").value;
			document.getElementById(id+"_td_date_input1").innerHTML='';	
			
			var select_day  = document.createElement('select');
				select_day.setAttribute("id", id+'_dayform_id_temp');
				select_day.setAttribute("name", id+'_dayform_id_temp');
				select_day.setAttribute("onChange", 'set_select(this)');
				select_day.style.width=w_width+'px';
				
			var options  = document.createElement('option');
				options.setAttribute("value",'');
				options.innerHTML= '';
				select_day.appendChild(options);
				
			for(k=1; k<=31;k++)
			{
				if(k<10)
					k='0'+k;
				var options  = document.createElement('option');
					options.setAttribute("value", k);
					options.innerHTML= k;
				 if (k==w_day) 
					options.setAttribute("selected", "selected");

					select_day.appendChild(options);
					
			}

			document.getElementById(id+"_td_date_input1").appendChild(select_day);

			break;	
		}
		case 'month': 
		{ 
			w_width=document.getElementById('edit_for_month_size').value!=''?document.getElementById('edit_for_month_size').value:60;
			w_month=document.getElementById(id+"_monthform_id_temp").value;
			
			document.getElementById(id+"_td_date_input2").innerHTML='';
			
		var select_month = document.createElement('select');
				select_month.setAttribute("id", id+'_monthform_id_temp');
				select_month.setAttribute("name", id+'_monthform_id_temp');
				select_month.setAttribute("onChange", 'set_select(this)');
				select_month.style.width=w_width+'px';
				
		var options  = document.createElement('option');
				options.setAttribute("value",'');
				options.innerHTML= '';
				select_month.appendChild(options);
				
		var myMonths=new Array("<!--repstart-->January<!--repend-->","<!--repstart-->February<!--repend-->","<!--repstart-->March<!--repend-->","<!--repstart-->April<!--repend-->","<!--repstart-->May<!--repend-->","<!--repstart-->June<!--repend-->","<!--repstart-->July<!--repend-->","<!--repstart-->August<!--repend-->","<!--repstart-->September<!--repend-->","<!--repstart-->October<!--repend-->","<!--repstart-->November<!--repend-->","<!--repstart-->December<!--repend-->");
			for(k=1; k<=12;k++)
			{
				if(k<10)
					k='0'+k;
				var options  = document.createElement('option');
					options.setAttribute("value", k);
					options.innerHTML= myMonths[k-1];
				if (k==w_month) 
					options.setAttribute("selected", "selected");

					select_month.appendChild(options);
					
			}
			document.getElementById(id+"_td_date_input2").appendChild(select_month);
		break;	
		}	
		case 'year':
		{ 
			w_width=document.getElementById('edit_for_year_size').value!=''?document.getElementById('edit_for_year_size').value:60;
			w_year=document.getElementById(id+"_yearform_id_temp").value;
			
		document.getElementById(id+"_td_date_input3").innerHTML=''; 
		var select_year  = document.createElement('select');
			select_year.setAttribute("id", id+'_yearform_id_temp');
			select_year.setAttribute("name", id+'_yearform_id_temp');
			select_year.setAttribute("onChange", 'set_select(this)');
			select_year.style.width=w_width+'px';
			
		var options  = document.createElement('option');
			options.setAttribute("value",'');
			options.innerHTML= '';
			select_year.appendChild(options);
			
		from= parseInt(document.getElementById("edit_for_year_interval_from").value);
		to= parseInt(document.getElementById("edit_for_year_interval_to").value);
		for(k=to; k>=from;k--)
		{
		var options  = document.createElement('option');
			options.setAttribute("value", k);
			options.innerHTML= k;
		if (k==w_year) 
			options.setAttribute("selected", "selected");
			
			select_year.appendChild(options);
		}
		select_year.value=w_year;
		select_year.setAttribute('from',from);
		select_year.setAttribute('to',to);
		document.getElementById(id+"_td_date_input3").appendChild(select_year);
		
		break;
		}
	}
	
refresh_attr(id, 'type_date_fields');

}

function field_to_text(id, type)
{

	switch(type)
	{
		case 'day': 
		{	
			w_width=document.getElementById('edit_for_day_size').value!=''?document.getElementById('edit_for_day_size').value:30;
			w_day=document.getElementById(id+"_dayform_id_temp").value;
			document.getElementById(id+"_td_date_input1").innerHTML='';	

			var day = document.createElement('input');
			day.setAttribute("type", 'text');
			day.setAttribute("value", w_day);
			//day.setAttribute("class", "time_box");
			day.setAttribute("id", id+"_dayform_id_temp");
			day.setAttribute("name", id+"_dayform_id_temp");
			day.setAttribute("onChange", "change_value('"+ id+"_dayform_id_temp')");
			day.setAttribute("onKeyPress", "return check_day(event, '"+id+"_dayform_id_temp')");
		    day.setAttribute("onBlur", "if (this.value=='0') this.value=''; else add_0('"+id+"_dayform_id_temp')");
		
			day.style.width=w_width+'px';

			document.getElementById(id+"_td_date_input1").appendChild(day);
			break;	
		}
		case 'month': 
		{ 
			w_width=document.getElementById('edit_for_month_size').value!=''?document.getElementById('edit_for_month_size').value:60;
			w_month=document.getElementById(id+"_monthform_id_temp").value;
			
			document.getElementById(id+"_td_date_input2").innerHTML='';
			
		var month = document.createElement('input');
			month.setAttribute("type", 'text');
			month.setAttribute("value", w_month);
			//month.setAttribute("class", "time_box");
			month.setAttribute("id", id+"_monthform_id_temp");
			month.setAttribute("name", id+"_monthform_id_temp");
			month.style.width=w_width+'px';
			month.setAttribute("onKeyPress", "return check_month(event, '"+id+"_monthform_id_temp')");
			month.setAttribute("onChange", "change_value('"+id+"_monthform_id_temp')");
			month.setAttribute("onBlur", "if (this.value=='0') this.value=''; else add_0('"+id+"_monthform_id_temp')");
			/*month.setAttribute("onKeyPress", "return check_minute(event, '"+i+"_mmform_id_temp')");
			month.setAttribute("onKeyUp", "change_minute(event, '"+i+"_mmform_id_temp')");
			month.setAttribute("onBlur", "add_0('"+i+"_mmform_id_temp')");*/

			document.getElementById(id+"_td_date_input2").appendChild(month);
			break;	
		}	
		case 'year':
		{ 
			w_width=document.getElementById('edit_for_year_size').value!=''?document.getElementById('edit_for_year_size').value:60;
			w_year=document.getElementById(id+"_yearform_id_temp").value;
			
			document.getElementById(id+"_td_date_input3").innerHTML='';
			
			from= parseInt(document.getElementById("edit_for_year_interval_from").value);
			to= parseInt(document.getElementById("edit_for_year_interval_to").value);
			if((parseInt(w_year)<from) || (parseInt(w_year)>to))
				w_year='';
			var year = document.createElement('input');
			year.setAttribute("type", 'text');
			year.setAttribute("value", w_year);
			//year.setAttribute("class", "time_box");
			year.setAttribute("id", id+"_yearform_id_temp");
			year.setAttribute("name", id+"_yearform_id_temp");
			year.setAttribute("onChange", "change_year('"+id+"_yearform_id_temp')");
			year.setAttribute("onKeyPress", "return check_year1(event, '"+id+"_yearform_id_temp')");
			year.setAttribute("onBlur", "check_year2('"+id+"_yearform_id_temp')");
			year.style.width=w_width+'px';
			year.setAttribute('from',from);
			year.setAttribute('to',to);

			document.getElementById(id+"_td_date_input3").appendChild(year);

			break;
		}
	}
	refresh_attr(id, 'type_date_fields');


}

function set_divider(id, divider)
{
	document.getElementById(id+"_separator1").innerHTML=divider;
	document.getElementById(id+"_separator2").innerHTML=divider;
}

function year_interval(id)
{
	from= parseInt(document.getElementById("edit_for_year_interval_from").value);
	to= parseInt(document.getElementById("edit_for_year_interval_to").value);
	if(to-from<0)
	{	
		alert('Invalid interval of years.');
		document.getElementById("edit_for_year_interval_from").value=to;
	}
	else
	{
		if(document.getElementById(id+"_yearform_id_temp").tagName=='SELECT')
			field_to_select(id, 'year');
		else
			field_to_text(id, 'year');
	}
}

function type_date_fields(i, w_field_label, w_field_label_pos, w_day, w_month, w_year, w_day_type, w_month_type, w_year_type, w_day_label, w_month_label, w_year_label, w_day_size, w_month_size, w_year_size, w_required, w_class, w_from, w_to, w_divider, w_attr_name, w_attr_value) { 

	document.getElementById("element_type").value="type_date_fields";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");
			
	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";

	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
				
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");


	var el_fields_divider_label = document.createElement('label');
		el_fields_divider_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_fields_divider_label.innerHTML = "Fields separator";
	
	var el_fields_divider = document.createElement('input');
        el_fields_divider.setAttribute("id", "edit_for_fields_divider");
        el_fields_divider.setAttribute("type", "text");
        el_fields_divider.setAttribute("value", w_divider);
        el_fields_divider.style.cssText = "margin-left:15px; width:80px";
        el_fields_divider.setAttribute("onKeyUp", "set_divider('"+i+"', this.value)");
			
/////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// D A Y //////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
		
	var el_day_field_type_label = document.createElement('label');
				el_day_field_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_day_field_type_label.innerHTML = "Day field type";
	
	var el_day_field_type_input1 = document.createElement('input');
                el_day_field_type_input1.setAttribute("id", "el_day_field_type_text");
                el_day_field_type_input1.setAttribute("type", "radio");
                el_day_field_type_input1.setAttribute("value", "text");
                el_day_field_type_input1.setAttribute("name", "edit_for_day_field_type");
                el_day_field_type_input1.setAttribute("onchange", "field_to_text("+i+", 'day')");
		Text_1 = document.createTextNode("Input");
		
	var el_day_field_type_input2 = document.createElement('input');
                el_day_field_type_input2.setAttribute("id", "el_day_field_type_select");
                el_day_field_type_input2.setAttribute("type", "radio");
                el_day_field_type_input2.setAttribute("value", "select");
                el_day_field_type_input2.setAttribute("name", "edit_for_day_field_type");
                el_day_field_type_input2.setAttribute("onchange", "field_to_select("+i+", 'day')");
		Select_1= document.createTextNode("Select");
		
	if(w_day_type=="SELECT")
				el_day_field_type_input2.setAttribute("checked", "checked");
	else
				el_day_field_type_input1.setAttribute("checked", "checked");
		
	var el_day_field_size_label = document.createElement('label');
	    el_day_field_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_day_field_size_label.innerHTML = "Day field size(px)";
	
	var el_day_field_size_input = document.createElement('input');
        el_day_field_size_input.setAttribute("id", "edit_for_day_size");
		el_day_field_size_input.setAttribute("type", "text");
		el_day_field_size_input.setAttribute("value", w_day_size);
		el_day_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
		el_day_field_size_input.setAttribute("onKeyUp", "change_w_style('"+i+"_dayform_id_temp', this.value)");
       //el_day_field_size_input.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");
				
	/*var el_day_field_text_label = document.createElement('label');
	    el_day_field_text_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_day_field_text_label.innerHTML = "Day label";
	
	var el_day_field_text_input = document.createElement('input');
        el_day_field_text_input.setAttribute("id", "edit_for_day_text");
		el_day_field_text_input.setAttribute("type", "text");
		el_day_field_text_input.setAttribute("value", w_day_label);
		//el_day_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_day_field_text_input.setAttribute("onKeyUp", "change_w_label('"+i+"_day_label', this.value)");*/
				
				
/////////////////////////////////////////////////////////////////////////////////
//////////////////////////////// M O N T H //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
		
	var el_month_field_type_label = document.createElement('label');
				el_month_field_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_month_field_type_label.innerHTML = "Month field type";
	
	var el_month_field_type_input1 = document.createElement('input');
                el_month_field_type_input1.setAttribute("id", "el_month_field_type_text");
                el_month_field_type_input1.setAttribute("type", "radio");
                el_month_field_type_input1.setAttribute("value", "text");
                el_month_field_type_input1.setAttribute("name", "edit_for_month_field_type");
                el_month_field_type_input1.setAttribute("onchange", "field_to_text("+i+", 'month')");
		Text_2 = document.createTextNode("Input");
		
	var el_month_field_type_input2 = document.createElement('input');
                el_month_field_type_input2.setAttribute("id", "el_month_field_type_select");
                el_month_field_type_input2.setAttribute("type", "radio");
                el_month_field_type_input2.setAttribute("value", "select");
                el_month_field_type_input2.setAttribute("name", "edit_for_month_field_type");
                el_month_field_type_input2.setAttribute("onchange", "field_to_select("+i+", 'month')");
		Select_2 = document.createTextNode("Select");
		
	if(w_month_type=="SELECT")
				el_month_field_type_input2.setAttribute("checked", "checked");
	else
				el_month_field_type_input1.setAttribute("checked", "checked");
		
	var el_month_field_size_label = document.createElement('label');
	    el_month_field_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_month_field_size_label.innerHTML = "Month field size(px) ";
	
	var el_month_field_size_input = document.createElement('input');
        el_month_field_size_input.setAttribute("id", "edit_for_month_size");
		el_month_field_size_input.setAttribute("type", "text");
		el_month_field_size_input.setAttribute("value", w_month_size);
		el_month_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
		el_month_field_size_input.setAttribute("onKeyUp", "change_w_style('"+i+"_monthform_id_temp', this.value)");
				
	/*var el_month_field_text_label = document.createElement('label');
	    el_month_field_text_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_month_field_text_label.innerHTML = "Month label";
	
	var el_month_field_text_input = document.createElement('input');
        el_month_field_text_input.setAttribute("id", "edit_for_month_text");
		el_month_field_text_input.setAttribute("type", "text");
		el_month_field_text_input.setAttribute("value", w_month_label);
		//el_month_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_month_field_text_input.setAttribute("onKeyUp", "change_w_label('"+i+"_month_label', this.value)");*/
				
	


/////////////////////////////////////////////////////////////////////////////////
////////////////////////////////  Y E A R  //////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
		
	var el_year_field_type_label = document.createElement('label');
				el_year_field_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_year_field_type_label.innerHTML = "Year field type";
	
	var el_year_field_type_input1 = document.createElement('input');
                el_year_field_type_input1.setAttribute("id", "el_year_field_type_text");
                el_year_field_type_input1.setAttribute("type", "radio");
                el_year_field_type_input1.setAttribute("value", "text");
                el_year_field_type_input1.setAttribute("name", "edit_for_year_field_type");
                el_year_field_type_input1.setAttribute("onchange", "field_to_text("+i+", 'year')");
		Text_3 = document.createTextNode("Input");
		
	var el_year_field_type_input2 = document.createElement('input');
                el_year_field_type_input2.setAttribute("id", "el_year_field_type_select");
                el_year_field_type_input2.setAttribute("type", "radio");
                el_year_field_type_input2.setAttribute("value", "select");
                el_year_field_type_input2.setAttribute("name", "edit_for_year_field_type");
                el_year_field_type_input2.setAttribute("onchange", "field_to_select("+i+", 'year')");
		Select_3 = document.createTextNode("Select");
		
	if(w_year_type=="SELECT")
				el_year_field_type_input2.setAttribute("checked", "checked");
	else
				el_year_field_type_input1.setAttribute("checked", "checked");
		
	var el_year_field_interval_label = document.createElement('label');
	    el_year_field_interval_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_year_field_interval_label.innerHTML = "Year interval";
	
	var el_year_field_interval_from_input = document.createElement('input');
        el_year_field_interval_from_input.setAttribute("id", "edit_for_year_interval_from");
		el_year_field_interval_from_input.setAttribute("type", "text");
		el_year_field_interval_from_input.setAttribute("value", w_from);
		el_year_field_interval_from_input.style.cssText ="width:40px";
		el_year_field_interval_from_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_year_field_interval_from_input.setAttribute("onChange", "year_interval("+i+")");
		
	Line = document.createTextNode(" - ");
			
	var el_year_field_interval_to_input = document.createElement('input');
        el_year_field_interval_to_input.setAttribute("id", "edit_for_year_interval_to");
		el_year_field_interval_to_input.setAttribute("type", "text");
		el_year_field_interval_to_input.setAttribute("value", w_to);
		el_year_field_interval_to_input.style.cssText ="width:40px";
		el_year_field_interval_to_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_year_field_interval_to_input.setAttribute("onChange", "year_interval("+i+")");
				
	var el_year_field_size_label = document.createElement('label');
	    el_year_field_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_year_field_size_label.innerHTML = "Year field size(px)";
	
	var el_year_field_size_input = document.createElement('input');
        el_year_field_size_input.setAttribute("id", "edit_for_year_size");
		el_year_field_size_input.setAttribute("type", "text");
		el_year_field_size_input.setAttribute("value", w_year_size);
		el_year_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_year_field_size_input.setAttribute("onKeyUp", "change_w_style('"+i+"_yearform_id_temp', this.value)");
				
	/*var el_year_field_text_label = document.createElement('label');
	    el_year_field_text_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_year_field_text_label.innerHTML = "Year label";
	
	var el_year_field_text_input = document.createElement('input');
        el_year_field_text_input.setAttribute("id", "edit_for_year_text");
		el_year_field_text_input.setAttribute("type", "text");
		el_year_field_text_input.setAttribute("value", w_year_label);
		//el_year_field_size_input.setAttribute("onKeyPress", "return check_isnum(event)");
        el_year_field_text_input.setAttribute("onKeyUp", "change_w_label('"+i+"_year_label', this.value)");*/
				
				
	
///////////////////////////////
///////////////////// End /////
			
				
				
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
		
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_date_fields')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_date_fields')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_date_fields')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_date_fields')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	var br7 = document.createElement('br');
	var br8 = document.createElement('br');
	var br9 = document.createElement('br');
	var br10 = document.createElement('br');
	var br11 = document.createElement('br');
	var br12 = document.createElement('br');
	var br13 = document.createElement('br');
	var br14 = document.createElement('br');
	var br15 = document.createElement('br');
	var br16 = document.createElement('br');
	var br17 = document.createElement('br');
	var br18 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);

	edit_main_td3.appendChild(el_fields_divider_label);
	edit_main_td3_1.appendChild(el_fields_divider);
	//////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	
	
	edit_main_td4.appendChild(el_day_field_type_label);
	edit_main_td4.appendChild(br);
	edit_main_td4.appendChild(el_day_field_size_label);
	// edit_main_td4.appendChild(br1);
	// edit_main_td4.appendChild(el_day_field_text_label);
	
	edit_main_td4_1.appendChild(el_day_field_type_input1);
	edit_main_td4_1.appendChild(Text_1);
	edit_main_td4_1.appendChild(el_day_field_type_input2);
	edit_main_td4_1.appendChild(Select_1);
	edit_main_td4_1.appendChild(br4);
	edit_main_td4_1.appendChild(el_day_field_size_input);
	// edit_main_td4_1.appendChild(br5);
	// edit_main_td4_1.appendChild(el_day_field_text_input);
	
	
	edit_main_td8.appendChild(el_month_field_type_label);
	edit_main_td8.appendChild(br11);
	edit_main_td8.appendChild(el_month_field_size_label);
	// edit_main_td8.appendChild(br12);
	// edit_main_td8.appendChild(el_month_field_text_label);
	edit_main_td8_1.appendChild(el_month_field_type_input1);
	edit_main_td8_1.appendChild(Text_2);
	edit_main_td8_1.appendChild(el_month_field_type_input2);
	edit_main_td8_1.appendChild(Select_2);
	edit_main_td8_1.appendChild(br6);
	edit_main_td8_1.appendChild(el_month_field_size_input);
	// edit_main_td8_1.appendChild(br7);
	// edit_main_td8_1.appendChild(el_month_field_text_input);



	edit_main_td9.appendChild(el_year_field_type_label);
	edit_main_td9.appendChild(br13);
	edit_main_td9.appendChild(el_year_field_interval_label);
	edit_main_td9.appendChild(br14);
	edit_main_td9.appendChild(el_year_field_size_label);
	// edit_main_td9.appendChild(br15);
	// edit_main_td9.appendChild(el_year_field_text_label);
	edit_main_td9_1.appendChild(el_year_field_type_input1);
	edit_main_td9_1.appendChild(Text_3);
	edit_main_td9_1.appendChild(el_year_field_type_input2);
	edit_main_td9_1.appendChild(Select_3);
	edit_main_td9_1.appendChild(br8);
	edit_main_td9_1.appendChild(el_year_field_interval_from_input);
	edit_main_td9_1.appendChild(Line);
	edit_main_td9_1.appendChild(el_year_field_interval_to_input);
	edit_main_td9_1.appendChild(br9);
	edit_main_td9_1.appendChild(el_year_field_size_input);
	// edit_main_td9_1.appendChild(br10);
	// edit_main_td9_1.appendChild(el_year_field_text_input);
	
	
	
	//////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br3);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_date_fields');
//show table
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_date_fields");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
				var div_for_editable_labels = document.createElement('div');
			div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
			
      	edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");

		div_for_editable_labels.appendChild(edit_labels);
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
			
      	var table_date = document.createElement('table');
           	table_date.setAttribute("id", i+"_table_date");
           	table_date.setAttribute("cellpadding", '0');
           	table_date.setAttribute("cellspacing", '0');
			
      	var tr_date1 = document.createElement('tr');
           	tr_date1.setAttribute("id", i+"_tr_date1");
			
      	var tr_date2 = document.createElement('tr');
           	tr_date2.setAttribute("id", i+"_tr_date2");
			
      	var td_date_input1 = document.createElement('td');
           	td_date_input1.setAttribute("id", i+"_td_date_input1");
			
      	var td_date_separator1 = document.createElement('td');
           	td_date_separator1.setAttribute("id", i+"_td_date_separator1");
			
      	var td_date_input2 = document.createElement('td');
           	td_date_input2.setAttribute("id", i+"_td_date_input2");
			
      	var td_date_separator2 = document.createElement('td');
           	td_date_separator2.setAttribute("id", i+"_td_date_separator2");
			
      	var td_date_input3 = document.createElement('td');
           	td_date_input3.setAttribute("id", i+"_td_date_input3");

      	var td_date_label1 = document.createElement('td');
           	td_date_label1.setAttribute("id", i+"_td_date_label1");
      	var td_date_label_empty1 = document.createElement('td');
			
      	var td_date_label2 = document.createElement('td');
           	td_date_label2.setAttribute("id", i+"_td_date_label2");
      	var td_date_label_empty2 = document.createElement('td');
			
      	var td_date_label3 = document.createElement('td');
           	td_date_label3.setAttribute("id", i+"_td_date_label3");
			
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

      	var label = document.createElement('span');
		label.setAttribute("id", i+"_element_labelform_id_temp");
		label.innerHTML = w_field_label;
		label.setAttribute("class", "label");
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";


	var day = document.createElement('input');
		day.setAttribute("type", 'text');
		day.setAttribute("value", w_day);
	    //day.setAttribute("class", "time_box");
	    day.setAttribute("id", i+"_dayform_id_temp");
	    day.setAttribute("name", i+"_dayform_id_temp");
		day.setAttribute("onChange", "change_value('"+i+"_dayform_id_temp')");
		day.setAttribute("onKeyPress", "return check_day(event, '"+i+"_dayform_id_temp')");
	    day.setAttribute("onBlur", "if (this.value=='0') this.value=''; else add_0('"+i+"_dayform_id_temp')");
		day.style.width=w_day_size+'px';
	  

	  /* hh.setAttribute("onKeyPress", "return check_hour(event, '"+i+"_hhform_id_temp', '23')");
	    hh.setAttribute("onKeyUp", "change_hour(event, '"+i+"_hhform_id_temp','23')");
	    hh.setAttribute("onBlur", "add_0('"+i+"_hhform_id_temp')");*/
			
	var day_label = document.createElement('label');
	    day_label.setAttribute("class", "mini_label");
	    day_label.setAttribute("id", i+"_day_label");
	    day_label.innerHTML=w_day_label;
			
	var day_ = document.createElement('span');
	    day_.setAttribute("id", i+"_separator1");
	    day_.setAttribute("class", "wdform_separator");
	    day_.innerHTML=w_divider;
		
	var month = document.createElement('input');
        month.setAttribute("type", 'text');
		month.setAttribute("value", w_month);
		//month.setAttribute("class", "time_box");
		month.setAttribute("id", i+"_monthform_id_temp");
	    month.setAttribute("name", i+"_monthform_id_temp");
		month.style.width=w_month_size+'px';
		month.setAttribute("onKeyPress", "return check_month(event, '"+i+"_monthform_id_temp')");
		month.setAttribute("onChange", "change_value('"+i+"_monthform_id_temp')");
	    month.setAttribute("onBlur", "if (this.value=='0') this.value=''; else add_0('"+i+"_monthform_id_temp')");
		/*month.setAttribute("onKeyPress", "return check_minute(event, '"+i+"_mmform_id_temp')");
	    month.setAttribute("onKeyUp", "change_minute(event, '"+i+"_mmform_id_temp')");
		month.setAttribute("onBlur", "add_0('"+i+"_mmform_id_temp')");*/
		
	var month_label = document.createElement('label');
		month_label.setAttribute("class", "mini_label");
		month_label.setAttribute("class", "mini_label");
	    month_label.setAttribute("id", i+"_month_label");
		month_label.innerHTML=w_month_label;
			
	var month_ = document.createElement('span');
	    month_.setAttribute("id", i+"_separator2");
	    month_.setAttribute("class", "wdform_separator");
		month_.innerHTML=w_divider;
		
	var year = document.createElement('input');
        year.setAttribute("type", 'text');
        year.setAttribute("from", w_from);
        year.setAttribute("to", w_to);
		year.setAttribute("value", w_year);
		//year.setAttribute("class", "time_box");
		year.setAttribute("id", i+"_yearform_id_temp");
		year.setAttribute("name", i+"_yearform_id_temp");
		year.style.width=w_year_size+'px';
		year.setAttribute("onChange", "change_year('"+i+"_yearform_id_temp')");
		year.setAttribute("onKeyPress", "return check_year1(event, '"+i+"_yearform_id_temp')");
		year.setAttribute("onBlur", "check_year2('"+i+"_yearform_id_temp')");
		/*year.setAttribute("onKeyPress", "return check_second(event, '"+i+"_ssform_id_temp')");
		year.setAttribute("onKeyUp", "change_second('"+i+"_ssform_id_temp')");
		year.setAttribute("onBlur", "add_0('"+i+"_ssform_id_temp')");*/

	var year_label = document.createElement('label');
		year_label.setAttribute("class", "mini_label");
	    year_label.setAttribute("id", i+"_year_label");
		year_label.innerHTML=w_year_label;
			
    var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required);
		
		
		
		td_date_input1.appendChild(day);
      	td_date_separator1.appendChild(day_);
      	td_date_input2.appendChild(month);
      	td_date_separator2.appendChild(month_);
      	td_date_input3.appendChild(year);
      	tr_date1.appendChild(td_date_input1);
      	tr_date1.appendChild(td_date_separator1);
      	tr_date1.appendChild(td_date_input2);
      	tr_date1.appendChild(td_date_separator2);
      	tr_date1.appendChild(td_date_input3);
		
      	td_date_label1.appendChild(day_label);
      	td_date_label2.appendChild(month_label);
      	td_date_label3.appendChild(year_label);
      	tr_date2.appendChild(td_date_label1);
      	tr_date2.appendChild(td_date_label_empty1);
      	tr_date2.appendChild(td_date_label2);
      	tr_date2.appendChild(td_date_label_empty2);
      	tr_date2.appendChild(td_date_label3);
      	table_date.appendChild(tr_date1);
      	table_date.appendChild(tr_date2);
		
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(table_date);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
        div.appendChild(div_for_editable_labels);
      	main_td.appendChild(div);

	if(w_field_label_pos=="top")
				label_top(i);
	
	if(w_day_type=="SELECT")
			field_to_select(i, 'day');
			
	if(w_month_type=="SELECT")
			field_to_select(i, 'month');
			
	if(w_year_type=="SELECT")
			field_to_select(i, 'year');
  change_class(w_class, i);
  refresh_attr(i, 'type_date_fields');
  jQuery(document).ready(function() {	
    jQuery("label#"+i+"_day_label").click(function() {
      if (jQuery(this).children('input').length == 0) {
        var day = "<input type='text' class='day' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";
        jQuery(this).html(day);							
        jQuery("input.day").focus();			
        jQuery("input.day").blur(function() {
          var value = jQuery(this).val();
          jQuery("#"+i+"_day_label").text(value);
        });
      }
    });
    jQuery("label#"+i+"_month_label").click(function() {	
      if (jQuery(this).children('input').length == 0) {		
        var month = "<input type='text' class='month' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(month);			
        jQuery("input.month").focus();					
        jQuery("input.month").blur(function() {			
          var value = jQuery(this).val();			
          jQuery("#"+i+"_month_label").text(value);	
        });	
      }	
    });
    jQuery("label#"+i+"_year_label").click(function() {	
      if (jQuery(this).children('input').length == 0) {		
        var year = "<input type='text' class='year' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
        jQuery(this).html(year);			
        jQuery("input.year").focus();					
        jQuery("input.year").blur(function() {			
          var value = jQuery(this).val();			
          jQuery("#"+i+"_year_label").text(value);
        });
      }
    });
	});
}

function type_own_select(i, w_field_label, w_field_label_pos, w_size, w_choices, w_choices_checked, w_required, w_class, w_attr_name, w_attr_value, w_choices_disabled){
	document.getElementById("element_type").value="type_own_select";
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
		edit_main_td3.setAttribute("id", "choices");
		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
	
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
		   el_size.setAttribute("id", "edit_for_input_size");
		   el_size.setAttribute("type", "text");
		   el_size.setAttribute("value", w_size);
		   
			el_size.setAttribute("name", "edit_for_size");
			el_size.setAttribute("onKeyPress", "return check_isnum(event)");
            el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");
	
	
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var el_choices_label = document.createElement('label');
	        el_choices_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_choices_label.innerHTML = "Options";
	var el_choices_add = document.createElement('img');
                el_choices_add.setAttribute("id", "el_choices_add");
           	el_choices_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_choices_add.style.cssText = 'cursor:pointer;';
            	el_choices_add.setAttribute("title", 'add');
                el_choices_add.setAttribute("onClick", "add_choise('select',"+i+")");

  var el_choices_important = document.createElement('div');			
  el_choices_important.style.cssText = 'color:red; padding:14px';
  el_choices_important.innerHTML = 'IMPORTANT! Check the "Empty value" checkbox only if you want the option to be considered as empty.';

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
        br3.setAttribute("id", "br1");
	var br4 = document.createElement('br');
        br4.setAttribute("id", "br2");
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br3);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	edit_main_td4.appendChild(el_required_label);
	edit_main_td4_1.appendChild(el_required);
	
	edit_main_td5.appendChild(el_size_label);
	edit_main_td5_1.appendChild(el_size);
	
	edit_main_td3.appendChild(el_choices_label);
	edit_main_td3_1.appendChild(el_choices_add);
  edit_main_td3_1.appendChild(el_choices_important);

  //??????????????????
    var div_ = document.createElement('div');
    div_.style.cssText = 'border-bottom:1px dotted black; width: 248px;';
    var br = document.createElement('br');
    var el_choices_mini_label = document.createElement('b');
    el_choices_mini_label.innerHTML="Options";
    el_choices_mini_label.style.cssText='padding-right: 30px; padding-left: 30px; font-size:9px';
    var el_choices_price_mini_label = document.createElement('b');
    el_choices_price_mini_label.innerHTML="Price";
    el_choices_price_mini_label.style.cssText='padding-right: 15px; padding-left: 15px;  font-size:9px';
    var el_choices_remove_mini_label = document.createElement('b');
    el_choices_remove_mini_label.innerHTML="Empty value";
    el_choices_remove_mini_label.style.cssText='padding-right: 2px; padding-left: 2px; font-size:9px';
    var el_choices_dis_mini_label = document.createElement('b');
    el_choices_dis_mini_label.innerHTML="Delete";
    el_choices_dis_mini_label.style.cssText='padding-left: 2px; padding-right: 2px; font-size:9px';
    div_.appendChild(br);
    div_.appendChild(el_choices_mini_label);
    div_.appendChild(el_choices_remove_mini_label);
    div_.appendChild(el_choices_dis_mini_label);
    edit_main_td3.appendChild(div_);
    //??????????????????????????
	
	n=w_choices.length;
	for(j=0; j<n; j++)
	{	
		var br = document.createElement('br');
		br.setAttribute("id", "br"+j);
		var el_choices = document.createElement('input');
			el_choices.setAttribute("id", "el_option"+j);
			el_choices.setAttribute("type", "text");
			el_choices.setAttribute("value", w_choices[j]);
			el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_choices.setAttribute("onKeyUp", "change_label('"+i+"_option"+j+"', this.value)");
	
		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_option"+j+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_option("+j+","+i+")");
			
		var el_choices_dis = document.createElement('input');
			el_choices_dis.setAttribute("type", 'checkbox');
			el_choices_dis.setAttribute("title", 'Empty value');
			el_choices_dis.setAttribute("id", "el_option"+j+"_dis");
			el_choices_dis.setAttribute("onClick", "dis_option('"+i+"_option"+j+"', this.checked)");
			el_choices_dis.style.cssText ="vertical-align: middle; margin-right: 24px; margin-left: 24px;";
			if(w_choices_disabled[j])
				el_choices_dis.setAttribute("checked", "checked");
			
		edit_main_td3.appendChild(br);
		edit_main_td3.appendChild(el_choices);
		edit_main_td3.appendChild(el_choices_dis);
		edit_main_td3.appendChild(el_choices_remove);
	
	}


	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr4);
	
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_own_select");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	    
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
	    
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
			
		var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			

      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
		
	var table_little = document.createElement('table');
           	table_little.setAttribute("id", i+"_table_little");
			
      	var tr_little1 = document.createElement('tr');
	        tr_little1.setAttribute("id", i+"_element_tr1");
		
      	var tr_little2 = document.createElement('tr');
 	        tr_little2.setAttribute("id", i+"_element_tr2");
			
      	var td_little1 = document.createElement('td');
         	td_little1.setAttribute("valign", 'top');
           	td_little1.setAttribute("id", i+"_td_little1");
			
      	var td_little2 = document.createElement('td');
        	td_little2.setAttribute("valign", 'top');
           	td_little2.setAttribute("id", i+"_td_little2");
			
   
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	var select_ = document.createElement('select');
		select_.setAttribute("id", i+"_elementform_id_temp");
		select_.setAttribute("name", i+"_elementform_id_temp");
		select_.style.cssText = "width:"+w_size+"px";
		select_.setAttribute("onchange", "set_select(this)");
		
	for(j=0; j<n; j++)
	{      	
		var option = document.createElement('option');
		option.setAttribute("id", i+"_option"+j);
	if(w_choices_disabled[j])
		option.value="";
	else
		option.setAttribute("value", w_choices[j]);
		
		option.setAttribute("onselect", "set_select('"+i+"_option"+j+"')");
           	option.innerHTML = w_choices[j];
	if(w_choices_checked[j]==1)
		option.setAttribute("selected", "selected");
		select_.appendChild(option);
	}			
	
    
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
	td2.appendChild(adding_type);
	
	td2.appendChild(adding_required);
      	td2.appendChild(select_);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function dis_option(id, value) {
  if (value) {
    document.getElementById(id).value = '';
  }
  else {
    document.getElementById(id).value = document.getElementById(id).innerHTML;
  }
}

function type_star_rating(i, w_field_label, w_field_label_pos, w_field_label_col, w_star_amount, w_required, w_class, w_attr_name, w_attr_value){

    document.getElementById("element_type").value="type_star_rating";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	
				
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
	
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_star_size_label = document.createElement('label');
				el_star_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_star_size_label.innerHTML = "Star Amount ";
	
	var el_star_size_input = document.createElement('input');
                el_star_size_input.setAttribute("type", "text");		
                el_star_size_input.setAttribute("id", "edit_for_star_size");		
                el_star_size_input.setAttribute("value", w_star_amount);
                el_star_size_input.style.cssText = "width:100px;";	
				el_star_size_input.setAttribute("onKeyPress", "return check_isnum(event)");	
			   el_star_size_input.setAttribute("onKeyUp", "change_star_amount(this.value,"+i+",'form_id_temp')");
           
	
	var el_star_color_label = document.createElement('label');
	        el_star_color_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_star_color_label.innerHTML = "Star Color";
	
	var el_star_color = document.createElement('select');
                el_star_color.setAttribute("id", "edit_for_label_color");
                el_star_color.setAttribute("name", "edit_for_label_color");
               el_star_color.setAttribute("onchange", "label_color(this.value,"+i+")");
                
	var el_star_color1 = document.createElement('option');
                el_star_color1.setAttribute("id", "edit_for_label_color_yellow");
                el_star_color1.setAttribute("value", "yellow");
Yellow = document.createTextNode("Yellow");

    var el_star_color2 = document.createElement('option');
                el_star_color2.setAttribute("id", "edit_for_label_color_green");
                el_star_color2.setAttribute("value", "green");
Green = document.createTextNode("Green");

    var el_star_color3 = document.createElement('option');
                el_star_color3.setAttribute("id", "edit_for_label_color_blue");
                el_star_color3.setAttribute("value", "blue");
Blue = document.createTextNode("Blue");

    var el_star_color4 = document.createElement('option');
                el_star_color4.setAttribute("id", "edit_for_label_color_red");
                el_star_color4.setAttribute("value", "red");				
 Red = document.createTextNode("Red");              
	
	
	

		if(w_field_label_col=="yellow")
				el_star_color1.setAttribute("selected", "selected");
	else
	{
	if(w_field_label_col=="green")
				el_star_color2.setAttribute("selected", "selected");
				else{
				   if(w_field_label_col=="blue")
				    el_star_color3.setAttribute("selected", "selected");
				else{
				if(w_field_label_col=="red")
				    el_star_color4.setAttribute("selected", "selected");
				
				}
				}
}

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("disabled", "disabled");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_star_rating')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_star_rating')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_star_rating')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_star_rating')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	
	edit_main_td3.appendChild(el_star_size_label);
	edit_main_td3_1.appendChild(el_star_size_input);

    edit_main_td4.appendChild(el_star_color_label);
	
	el_star_color1.appendChild(Yellow);
	el_star_color2.appendChild(Green);
	el_star_color3.appendChild(Blue);
	el_star_color4.appendChild(Red);
	
	el_star_color.appendChild(el_star_color1);
	el_star_color.appendChild(el_star_color2);
	el_star_color.appendChild(el_star_color3);
	el_star_color.appendChild(el_star_color4);
	
	edit_main_td4_1.appendChild(el_star_color);
	
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br1);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
    edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
	
//show table

	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_star_rating");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
		
			
			
	var adding_star_amount = document.createElement("input");
           	 	adding_star_amount.setAttribute("type", "hidden");
           	 	adding_star_amount.setAttribute("value", w_star_amount);
			adding_star_amount.setAttribute("id", i+"_star_amountform_id_temp");
			adding_star_amount.setAttribute("name", i+"_star_amountform_id_temp");
			
	var adding_star_color = document.createElement("input");
            adding_star_color.setAttribute("type", "hidden");
            adding_star_color.setAttribute("value", w_field_label_col);
            adding_star_color.setAttribute("name", i+"_star_colorform_id_temp");	
            adding_star_color.setAttribute("id", i+"_star_colorform_id_temp");
			
var select_star_amount = document.createElement("input");
           	 	select_star_amount.setAttribute("type", "hidden");
           	 	select_star_amount.setAttribute("value", '');
			select_star_amount.setAttribute("id", i+"_selected_star_amountform_id_temp");
			select_star_amount.setAttribute("name", i+"_selected_star_amountform_id_temp");

			
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

		var div1 = document.createElement('div');	
           	div1.setAttribute("id", i+"_elementform_id_temp");
			div1.setAttribute("class", "wdform_star_rating");
			
		var br1 = document.createElement('br');

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(adding_star_amount);
      	td2.appendChild(adding_star_color);
		td2.appendChild(select_star_amount);
		
		
    for(var j=0;j<w_star_amount;j++){	

	
	var adding=document.createElement("img");
	    adding.setAttribute('id', i+'_star_'+j);
        adding.setAttribute('src', plugin_url+'/images/star.png');
		adding.setAttribute('onmouseover', "change_src("+j+","+i+",'form_id_temp')");
		adding.setAttribute('onmouseout', "reset_src("+j+","+i+")");
		adding.setAttribute('onclick', "select_star_rating("+j+","+i+",'form_id_temp')");
	   
	   
      	div1.appendChild(adding);
		
	}	
	
	td2.appendChild(div1);
	
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_star_rating');
}

function type_paypal_total(i, w_field_label, w_field_label_pos, w_class){

	document.getElementById("element_type").value="type_paypal_total";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
	
	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";
	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";	

	
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");

                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	
	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
        el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
        el_style_textarea.style.cssText = "width:200px;";
        el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	
		
				
	var t  = document.getElementById('edit_table');
	var br = document.createElement('br');
		

	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	
	edit_main_td3.appendChild(el_style_label);
	edit_main_td3_1.appendChild(el_style_textarea);

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	
		var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_paypal_total");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	
	
	    
     var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
			
	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
	
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
//tbody sarqac		
		

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      
	
		
	
	
		var div_paypal = document.createElement('div');
			div_paypal.setAttribute("id", i+"paypal_totalform_id_temp");
			div_paypal.setAttribute("class", "wdform_paypal_total paypal_totalform_id_temp");
	    
		var div_total = document.createElement('div');
			div_total.setAttribute("id", i+"div_totalform_id_temp");
			div_total.setAttribute("class", "div_totalform_id_temp");
			div_total.style.cssText = 'margin-bottom:10px;';
			div_total.innerHTML = '<!--repstart-->$300<!--repend-->';
		
		var div_products = document.createElement('div');
			div_products.setAttribute("id", i+"paypal_productsform_id_temp");
			div_products.setAttribute("class", "paypal_productsform_id_temp");
			div_products.style.cssText = 'border-spacing: 2px;';
		var div_product1 = document.createElement('div');
    div_product1.style.cssText = 'border-spacing: 2px;';
		div_product1.innerHTML = '<!--repstart-->product 1 $100<!--repend-->';
		
		var div_product2 = document.createElement('div');
			div_product2.style.cssText = 'border-spacing: 2px;';
			div_product2.innerHTML = '<!--repstart-->product 2 $200<!--repend-->';
		
		var div_tax = document.createElement('div');
			div_tax.style.cssText = 'border-spacing: 2px; margin-top:7px;';
			div_tax.setAttribute("id", i+"paypal_taxform_id_temp");
			div_tax.setAttribute("class", "paypal_taxform_id_temp");
			
		var input_for_total = document.createElement("input");
            input_for_total.setAttribute("type", "hidden");
            input_for_total.setAttribute("value", '');
            input_for_total.setAttribute("name", i+"_paypal_totalform_id_temp");	
			input_for_total.setAttribute("class", "input_paypal_totalform_id_temp");
		
		div_paypal.appendChild(input_for_total);
		div_products.appendChild(div_product1);
		div_products.appendChild(div_product2);
		div_paypal.appendChild(div_total);
		div_paypal.appendChild(div_products);
    div_paypal.appendChild(div_tax);
		
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      
       	td2.appendChild(adding_type);
	
       
  		td2.appendChild(div_paypal);
    	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	
change_class(w_class, i);
}





function change_src(id,a,form_id)
{
	for(var j=0;j<=id;j++)
	document.getElementById(a+'_star_'+j).src=plugin_url+'/images/star_'+document.getElementById(a+'_star_colorform_id_temp').value+".png";
}


function reset_src(id,a)
{
	for(var j=0;j<=id;j++)
	document.getElementById(a+'_star_'+j).src=plugin_url+'/images/star.png';
}

function select_star_rating(id,a,form_id)
{
}


function change_star_amount(b,a,form_id)
{
	var td=document.getElementById(a+"_element_sectionform_id_temp");
	var div=document.getElementById(a+"_elementform_id_temp");
	td.removeChild(div);

	var div1 = document.createElement('div');	
				div1.setAttribute("id", a+"_elementform_id_temp");
			
 for(var j=0;j<b;j++){	
	var adding_img=document.createElement("img");
	    adding_img.setAttribute('id', a+'_star_'+j);
        adding_img.setAttribute('src', plugin_url+'/images/star.png');
		adding_img.setAttribute('onmouseover', "change_src("+j+","+a+",'form_id_temp')");
		adding_img.setAttribute('onmouseout', "reset_src("+j+","+a+")");
	   	adding_img.setAttribute('onclick', "select_star_rating("+j+","+a+",'form_id_temp')");
		
      	div1.appendChild(adding_img);
		
	}
	
	td.appendChild(div1);
	document.getElementById(a+'_star_amountform_id_temp').value=b;
}

function label_color(b,a)
{
	document.getElementById(a+'_star_colorform_id_temp').value=b;
}

function type_scale_rating(i, w_field_label, w_field_label_pos, w_mini_labels, w_scale_amount, w_required, w_class, w_attr_name, w_attr_value){

    document.getElementById("element_type").value="type_scale_rating";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");
	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	
				
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
		
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_scale_amount_label = document.createElement('label');
				el_scale_amount_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_scale_amount_label.innerHTML = "Scale Amount ";
	
	var el_scale_amount_input = document.createElement('input');
                el_scale_amount_input.setAttribute("type", "text");		
                el_scale_amount_input.setAttribute("id", "edit_for_scale_amount");		
                el_scale_amount_input.setAttribute("value", w_scale_amount);
                el_scale_amount_input.style.cssText = "width:100px;";	
				el_scale_amount_input.setAttribute("onKeyPress", "return check_isnum(event)");	
			   el_scale_amount_input.setAttribute("onKeyUp", "change_scale_amount(this.value,"+i+",'form_id_temp')");
           
	
	
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_scale_rating')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_scale_rating')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_scale_rating')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_scale_rating')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	
	edit_main_td3.appendChild(el_scale_amount_label);
	edit_main_td3_1.appendChild(el_scale_amount_input);

	
	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	edit_main_td7.appendChild(el_required_label);
	edit_main_td7_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_attr_label);
	edit_main_td8.appendChild(el_attr_add);
	edit_main_td8.appendChild(br1);
	edit_main_td8.appendChild(el_attr_table);
	edit_main_td8.setAttribute("colspan", "2");
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	

	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
 
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr8);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//	add_id_and_name(i, 'type_scale_rating');
//show table

	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_scale_rating");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
		
			
			
	var adding_scale_amount = document.createElement("input");
           	 	adding_scale_amount.setAttribute("type", "hidden");
           	 	adding_scale_amount.setAttribute("value", w_scale_amount);
			adding_scale_amount.setAttribute("id", i+"_scale_amountform_id_temp");
			adding_scale_amount.setAttribute("name", i+"_scale_amountform_id_temp");
			

			
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
		
		var div_for_editable_labels = document.createElement('div');
			div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
			
      	edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");

		div_for_editable_labels.appendChild(edit_labels);  
		
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

		var div1 = document.createElement('div');	
           	div1.setAttribute("id", i+"_elementform_id_temp");
		
			div1.style.cssText ="float:left;";
		
		var scale_table = document.createElement('table');
           	scale_table.setAttribute("id", i+"_scale_tableform_id_temp");
			scale_table.style.cssText ="display:inline-table;";
			
			
		var scale_tr0 = document.createElement('tr');
           	scale_tr0.setAttribute("id", i+"_scale_tr1form_id_temp");
		
		var scale_tr1 = document.createElement('tr');
           	scale_tr1.setAttribute("id", i+"_scale_tr2form_id_temp");
			
	   		
		var br1 = document.createElement('br');

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
			
		
		
		var label1 = document.createElement('label');
			label1.setAttribute("class", "mini_label");	
			label1.setAttribute("id", i+"_mini_label_worst");
			label1.innerHTML= w_mini_labels[0];
			label1.style.cssText ="position:relative; top:6px; font-size:11px;";
			
		var label2 = document.createElement('label');
			label2.setAttribute("class", "mini_label");	
			label2.setAttribute("id", i+"_mini_label_best");
			label2.innerHTML= w_mini_labels[1];
			label2.style.cssText ="position:relative; top:6px; font-size:11px;";
	    
		
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(adding_scale_amount);
      	

		
		
		div1.appendChild(label1);
		scale_table.appendChild(scale_tr0);
		 
	for(var l=1;l<=w_scale_amount;l++){	   
	adding_num=document.createElement("span");
	adding_num.innerHTML = l;
	           
    adding_td =	document.createElement('td');
	adding_td.setAttribute("id", i+"_scale_td1_"+l+"form_id_temp");
	adding_td.style.cssText = 'text-align:center;';
	
	adding_td.appendChild(adding_num);
	scale_tr0.appendChild(adding_td);
	
    }	
	 
    for(var k=1;k<=w_scale_amount;k++){	

	
	var adding_radio=document.createElement("input");
	    adding_radio.setAttribute('id', i+'_scale_radioform_id_temp_'+k);
		adding_radio.setAttribute('name', i+'_scale_radioform_id_temp');
		adding_radio.setAttribute('value', k);
        adding_radio.setAttribute('type', 'radio');
		
	
    var adding_td_for_radio=document.createElement("td");
	     adding_td_for_radio.setAttribute('id', i+'_scale_td2_'+k+'form_id_temp');
       
	    adding_td_for_radio.appendChild(adding_radio);
		scale_tr1.appendChild(adding_td_for_radio);
	    scale_table.appendChild(scale_tr1);
      	div1.appendChild(scale_table);
		
	}	
	  
	    scale_table.appendChild(scale_tr1);
      	div1.appendChild(scale_table);
	    div1.appendChild(label2);
	td2.appendChild(div1);
	
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br1);
		div.appendChild(div_for_editable_labels);
		
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
				
	jQuery(document).ready(function() {	
	jQuery("label#"+i+"_mini_label_worst").click(function() {		
	if (jQuery(this).children('input').length == 0) {		

		var worst = "<input type='text' class='worst' size='6' style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";		

		jQuery(this).html(worst);		
		jQuery("input.worst").focus();		
		jQuery("input.worst").blur(function() {	

		var value = jQuery(this).val();			
		jQuery("#"+i+"_mini_label_worst").text(value);		
		});		
	}	
	});	

	
	jQuery("label#"+i+"_mini_label_best").click(function() {		

	if (jQuery(this).children('input').length == 0) {			
		var best = "<input type='text' class='best' size='6'  style='outline:none; border:none; background:none; font-size:11px;' value=\""+jQuery(this).text()+"\">";						

		jQuery(this).html(best);					

		jQuery("input.best").focus();			
		jQuery("input.best").blur(function() {		
		
		var value = jQuery(this).val();			
		jQuery("#"+i+"_mini_label_best").text(value);		
		});	
	}	
	});
	
	});			
				
				
change_class(w_class, i);
refresh_attr(i, 'type_scale_rating');


}

function change_scale_amount(b,c,form_id){
	var table=document.getElementById(c+"_scale_tableform_id_temp");
	var div=document.getElementById(c+"_elementform_id_temp");

	div.removeChild(table);

	var scale_table = document.createElement('table');
           	scale_table.setAttribute("id", c+"_scale_tableform_id_temp");
			scale_table.style.cssText ="display:inline-table;";
			
			
	   var tr0 = document.createElement('tr');
           	tr0.setAttribute("id", c+"_scale_tr1form_id_temp");
		
	   var tr1 = document.createElement('tr');
           	tr1.setAttribute("id", c+"_scale_tr2form_id_temp");
			scale_table.appendChild(tr0);
	for(var l=1;l<=b;l++){	 

		adding_num=document.createElement("span");
		adding_num.innerHTML = l;
				   
		adding_td =	document.createElement('td');
		adding_td.setAttribute("id", c+"_scale_td1_"+l+"form_id_temp");
		adding_td.style.cssText = 'text-align:center;';
		
		adding_td.appendChild(adding_num);
		tr0.appendChild(adding_td); 
		
		}	
	 
	for(var k=1;k<=b;k++){	

		
		var adding_radio=document.createElement("input");
			adding_radio.setAttribute('id', c+'_scale_radioform_id_temp_'+k);
			adding_radio.setAttribute('name', c+'_scale_radioform_id_temp');
			adding_radio.setAttribute('value', k);
			adding_radio.setAttribute('type', 'radio');
			

		var adding_td_for_radio=document.createElement("td");
			adding_td_for_radio.setAttribute('id', c+'_scale_td2_'+k+'form_id_temp');
			adding_td_for_radio.appendChild(adding_radio);
		   tr1.appendChild(adding_td_for_radio);
			
	}	
	scale_table.appendChild(tr1);
	div.insertBefore(scale_table,div.childNodes[1])
		  
	document.getElementById(c+'_scale_amountform_id_temp').value = b;
}


function type_spinner(i, w_field_label, w_field_label_pos, w_field_width, w_field_min_value, w_field_max_value, w_field_step, w_field_value, w_required, w_class, w_attr_name, w_attr_value){

   document.getElementById("element_type").value="type_spinner";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");
	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");		

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	
				
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";	  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

				
	var el_spinner_width_label = document.createElement('label');
				el_spinner_width_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_spinner_width_label.innerHTML = "Width ";
	
	var el_spinner_width_input = document.createElement('input');
                el_spinner_width_input.setAttribute("type", "text");		
                el_spinner_width_input.setAttribute("id", "edit_for_spinner_width");		
                el_spinner_width_input.setAttribute("value", w_field_width);
                el_spinner_width_input.style.cssText = "width:100px;";	
				el_spinner_width_input.setAttribute("onKeyPress", "return check_isnum(event)");	
			   el_spinner_width_input.setAttribute("onKeyUp", "change_spinner_width(this.value,"+i+",'form_id_temp')");			
				
				
				
	var el_spinner_min_value_label = document.createElement('label');
				el_spinner_min_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_spinner_min_value_label.innerHTML = "Min Value ";
	
	var el_spinner_min_value_input = document.createElement('input');
                el_spinner_min_value_input.setAttribute("type", "text");		
                el_spinner_min_value_input.setAttribute("id", "edit_for_spinner_min_value");		
                el_spinner_min_value_input.setAttribute("value", w_field_min_value);
                el_spinner_min_value_input.style.cssText = "width:100px;";	
				el_spinner_min_value_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
				el_spinner_min_value_input.setAttribute("onChange", "change_spinner_min_value(this.value,"+i+",'form_id_temp')");
			   
			   
      var el_spinner_max_value_label = document.createElement('label');
				el_spinner_max_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_spinner_max_value_label.innerHTML = "Max Value ";
	
	var el_spinner_max_value_input = document.createElement('input');
                el_spinner_max_value_input.setAttribute("type", "text");		
                el_spinner_max_value_input.setAttribute("id", "edit_for_spinner_max_value");		
                el_spinner_max_value_input.setAttribute("value", w_field_max_value);
                el_spinner_max_value_input.style.cssText = "width:100px;";	
				el_spinner_max_value_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
				el_spinner_max_value_input.setAttribute("onChange", "change_spinner_max_value(this.value,"+i+",'form_id_temp')");     
	
	var el_spinner_step_label = document.createElement('label');
	        el_spinner_step_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_spinner_step_label.innerHTML = "Step";
		
		var el_spinner_step_input = document.createElement('input');
                el_spinner_step_input.setAttribute("type", "text");		
                el_spinner_step_input.setAttribute("id", "edit_for_spinner_step");		
                el_spinner_step_input.setAttribute("value", w_field_step);
                el_spinner_step_input.style.cssText = "width:100px;";	
				el_spinner_step_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
				el_spinner_step_input.setAttribute("onChange", "change_spinner_step(this.value,"+i+",'form_id_temp')");
	


	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_spinner')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_spinner')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_spinner')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_spinner')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	
	edit_main_td3.appendChild(el_spinner_width_label);
	edit_main_td3_1.appendChild(el_spinner_width_input);
	
	edit_main_td4.appendChild(el_spinner_min_value_label);
	edit_main_td4_1.appendChild(el_spinner_min_value_input);

    edit_main_td5.appendChild(el_spinner_max_value_label);	
	edit_main_td5_1.appendChild(el_spinner_max_value_input);
	
	  edit_main_td6.appendChild(el_spinner_step_label);	
	edit_main_td6_1.appendChild(el_spinner_step_input);
	
	edit_main_td7.appendChild(el_style_label);
	edit_main_td7_1.appendChild(el_style_textarea);
	edit_main_td8.appendChild(el_required_label);
	edit_main_td8_1.appendChild(el_required);
	
	edit_main_td9.appendChild(el_attr_label);
	edit_main_td9.appendChild(el_attr_add);
	edit_main_td9.appendChild(br1);
	edit_main_td9.appendChild(el_attr_table);
	edit_main_td9.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr9.appendChild(edit_main_td9);
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
    edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr9);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_spinner');
	
//show table

	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_spinner");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
		
	var adding_width= document.createElement("input");
            adding_width.setAttribute("type", "hidden");
            adding_width.setAttribute("value", w_field_width);
            adding_width.setAttribute("name", i+"_spinner_widthform_id_temp");	
            adding_width.setAttribute("id", i+"_spinner_widthform_id_temp");		
			
	var adding_min_value = document.createElement("input");
           	 	adding_min_value.setAttribute("type", "hidden");
           	 	adding_min_value.setAttribute("value", w_field_min_value);
			adding_min_value.setAttribute("id", i+"_min_valueform_id_temp");
			adding_min_value.setAttribute("name", i+"_min_valueform_id_temp");
			
	var adding_max_value = document.createElement("input");
            adding_max_value.setAttribute("type", "hidden");
            adding_max_value.setAttribute("value", w_field_max_value);
            adding_max_value.setAttribute("name", i+"_max_valueform_id_temp");	
            adding_max_value.setAttribute("id", i+"_max_valueform_id_temp");
			
	var adding_step = document.createElement("input");
            adding_step.setAttribute("type", "hidden");
            adding_step.setAttribute("value", w_field_step);
            adding_step.setAttribute("name", i+"_stepform_id_temp");	
            adding_step.setAttribute("id", i+"_stepform_id_temp");


		
   var adding_spinner_input = document.createElement("input");
            adding_spinner_input.setAttribute("type", "");
            adding_spinner_input.setAttribute("value",'');
			adding_spinner_input.style.cssText="width:"+w_field_width+"px"; 
            adding_spinner_input.setAttribute("name", i+"_elementform_id_temp");	
            adding_spinner_input.setAttribute("id", i+"_elementform_id_temp");
			adding_spinner_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
			
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

     
			
		  var br1 = document.createElement('br');

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(adding_width);
		td2.appendChild(adding_min_value);
      	td2.appendChild(adding_max_value);
		td2.appendChild(adding_step);
	    
	
		td2.appendChild(adding_spinner_input);
		
		
 	
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_spinner');

jQuery( "#"+i+"_elementform_id_temp" ).spinner();

 var spinner = jQuery( "#"+i+"_elementform_id_temp" ).spinner();


spinner.spinner( "value", w_field_value );
jQuery( "#"+i+"_elementform_id_temp" ).spinner({ min: w_field_min_value});    
jQuery( "#"+i+"_elementform_id_temp" ).spinner({ max: w_field_max_value});
jQuery( "#"+i+"_elementform_id_temp" ).spinner({ step: w_field_step});
}


function change_spinner_width(a,b,form_id){
document.getElementById( b+"_elementform_id_temp" ).style.cssText="width:"+a+"px";
document.getElementById( b+"_spinner_widthform_id_temp" ).value=a;
}


function change_spinner_max_value(a,b,form_id){
jQuery( "#"+b+"_elementform_id_temp" ).spinner({ max: a});
document.getElementById( b+"_max_valueform_id_temp" ).value=a;
}

function change_spinner_min_value(a,b,form_id){
jQuery( "#"+b+"_elementform_id_temp" ).spinner({ min: a});
document.getElementById( b+"_min_valueform_id_temp" ).value=a;

}

function change_spinner_step(a,b,form_id){
jQuery( "#"+b+"_elementform_id_temp" ).spinner({ step: a});
document.getElementById( b+"_stepform_id_temp" ).value=a;
}



function type_slider(i, w_field_label, w_field_label_pos,  w_field_width, w_field_min_value, w_field_max_value, w_field_value, w_required, w_class, w_attr_name, w_attr_value){

  document.getElementById("element_type").value="type_slider";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
	var edit_main_tr8  = document.createElement('tr');
      	edit_main_tr8.setAttribute("valing", "top");
	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	
				
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
		
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
				
				
	var el_slider_size_label = document.createElement('label');
	        el_slider_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_slider_size_label.innerHTML = "Width";			
				
    var el_slider_size_input = document.createElement('input');
                el_slider_size_input.setAttribute("type", "text");		
                el_slider_size_input.setAttribute("id", "edit_for_slider_width");		
                el_slider_size_input.setAttribute("value", w_field_width);
                el_slider_size_input.style.cssText = "width:100px;";	
				el_slider_size_input.setAttribute("onKeyPress", "return check_isnum(event)");	
			   el_slider_size_input.setAttribute("onKeyUp", "change_slider_width(this.value,"+i+",'form_id_temp')");
	
	var el_slider_min_value_label = document.createElement('label');
				el_slider_min_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_slider_min_value_label.innerHTML = "Min Value ";
	
	var el_slider_min_value_input = document.createElement('input');
                el_slider_min_value_input.setAttribute("type", "text");		
                el_slider_min_value_input.setAttribute("id", "edit_for_slider_min_value");		
                el_slider_min_value_input.setAttribute("value", w_field_min_value);
                el_slider_min_value_input.style.cssText = "width:100px;";	
				el_slider_min_value_input.setAttribute("onKeyPress", "return check_isnum(event)");	
				el_slider_min_value_input.setAttribute("onKeyUp", "change_slider_min_or_max_value(this.value,"+i+",'form_id_temp','min')");
			   el_slider_min_value_input.setAttribute("onChange", "change_slider_min_value(this.value,"+i+",'form_id_temp')");
           
		   
	var el_slider_max_value_label = document.createElement('label');
				el_slider_max_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_slider_max_value_label.innerHTML = "Max Value ";
	
	var el_slider_max_value_input = document.createElement('input');
                el_slider_max_value_input.setAttribute("type", "text");		
                el_slider_max_value_input.setAttribute("id", "edit_for_slider_max_value");		
                el_slider_max_value_input.setAttribute("value", w_field_max_value);
                el_slider_max_value_input.style.cssText = "width:100px;";	
				el_slider_max_value_input.setAttribute("onKeyPress", "return check_isnum(event)");	
				el_slider_max_value_input.setAttribute("onKeyUp", "change_slider_min_or_max_value(this.value,"+i+",'form_id_temp','max')");
			   el_slider_max_value_input.setAttribute("onChange", "change_slider_max_value(this.value,"+i+",'form_id_temp')");
           
	

	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_slider')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_slider')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_slider')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_slider')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_slider_size_label);	
	edit_main_td3_1.appendChild(el_slider_size_input);
	
	edit_main_td4.appendChild(el_slider_min_value_label);
	edit_main_td4_1.appendChild(el_slider_min_value_input);
	
	
	edit_main_td5.appendChild(el_slider_max_value_label);
	edit_main_td5_1.appendChild(el_slider_max_value_input);

    
	
	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	edit_main_td7.appendChild(el_required_label);
	edit_main_td7_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_attr_label);
	edit_main_td8.appendChild(el_attr_add);
	edit_main_td8.appendChild(br1);
	edit_main_td8.appendChild(el_attr_table);
	edit_main_td8.setAttribute("colspan", "2");
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
    edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr8);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_slider');
	
//show table

	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_slider");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
		
	var adding_slider_min_value = document.createElement("input");
           	 	adding_slider_min_value.setAttribute("type", "hidden");
           	 	adding_slider_min_value.setAttribute("value", w_field_min_value);
			adding_slider_min_value.setAttribute("id", i+"_slider_min_valueform_id_temp");
			adding_slider_min_value.setAttribute("name", i+"_slider_min_valueform_id_temp");		
			
	var adding_slider_max_value = document.createElement("input");
           	 	adding_slider_max_value.setAttribute("type", "hidden");
           	 	adding_slider_max_value.setAttribute("value", w_field_max_value);
			adding_slider_max_value.setAttribute("id", i+"_slider_max_valueform_id_temp");
			adding_slider_max_value.setAttribute("name", i+"_slider_max_valueform_id_temp");
			
			
	var adding_slider_value = document.createElement("input");
           	 	adding_slider_value.setAttribute("type", "hidden");
           	 	adding_slider_value.setAttribute("value", w_field_value);
			adding_slider_value.setAttribute("id", i+"_slider_valueform_id_temp");
			adding_slider_value.setAttribute("name", i+"_slider_valueform_id_temp");

			
	var adding_slider_width = document.createElement("input");
            adding_slider_width.setAttribute("type", "hidden");
            adding_slider_width.setAttribute("value", w_field_width);
            adding_slider_width.setAttribute("name", i+"_slider_widthform_id_temp");	
            adding_slider_width.setAttribute("id", i+"_slider_widthform_id_temp");
			
    var adding_slider_div = document.createElement("div");
			adding_slider_div.style.cssText="width:"+w_field_width+"px"; 
            adding_slider_div.setAttribute("name", i+"_elementform_id_temp");	
            adding_slider_div.setAttribute("id", i+"_elementform_id_temp");

	

			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
			
		var slider_table = document.createElement('table');
           	slider_table.setAttribute("id", i+"_slider_tableform_id_temp");	
			
		var slider_tr1 = document.createElement('tr');	
		var slider_tr2 = document.createElement('tr');	
		
	    var slider_td1 = document.createElement('td');
         	slider_td1.setAttribute("colspan", '3');
           	slider_td1.setAttribute("id", i+"_slider_td1form_id_temp");
			
        var slider_td2 = document.createElement('td');
         	  slider_td2.setAttribute("align", 'left');
           	slider_td2.setAttribute("id", i+"_slider_td2form_id_temp");
           	slider_td2.setAttribute("style", "text-align:left");
				
			
		var slider_td3 = document.createElement('td');
            slider_td3.setAttribute("align", 'right');
           	slider_td3.setAttribute("id", i+"_slider_td3form_id_temp");
            slider_td3.setAttribute("style", "text-align:right");
			
		var slider_td4 = document.createElement('td');
            slider_td4.setAttribute("align", 'right');
           	slider_td4.setAttribute("id", i+"_slider_td4form_id_temp");
            slider_td4.setAttribute("style", "text-align:right");
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      
			
		  var br1 = document.createElement('br');

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(adding_slider_width);
	    td2.appendChild(adding_slider_min_value);
		td2.appendChild(adding_slider_max_value); 
		td2.appendChild(adding_slider_value); 
		
        var slider_min = document.createElement('span');
			slider_min.setAttribute("id", i+"_element_minform_id_temp");
			slider_min.innerHTML = w_field_min_value;
			slider_min.setAttribute("class", "label");
			
		var slider_max = document.createElement('span');
			slider_max.setAttribute("id", i+"_element_maxform_id_temp");
			slider_max.innerHTML = w_field_max_value;
			slider_max.setAttribute("class", "label");
		
        var slider_value = document.createElement('span');
			slider_value.setAttribute("id", i+"_element_valueform_id_temp");
			slider_value.innerHTML = w_field_value;
			slider_value.setAttribute("class", "label");		
	
	
		slider_td1.appendChild(adding_slider_div);
		slider_tr1.appendChild(slider_td1);
		slider_table.appendChild(slider_tr1);
		
		
		slider_td2.appendChild(slider_min);
        slider_tr2.appendChild(slider_td2);
	    slider_table.appendChild(slider_tr2);
		
		
		slider_td3.appendChild(slider_value);
        slider_tr2.appendChild(slider_td3);
	    slider_table.appendChild(slider_tr2);
		
		slider_td4.appendChild(slider_max);
        slider_tr2.appendChild(slider_td4);
	    slider_table.appendChild(slider_tr2);
		
		td2.appendChild(slider_table);
		
		
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_slider');
jQuery("#"+i+"_elementform_id_temp")[0].slide = null;

jQuery(function() {
	jQuery( "#"+i+"_elementform_id_temp").slider({
		range: "min",
		value: eval(w_field_value),
		min: eval(w_field_min_value),
		max: eval(w_field_max_value),
		slide: function( event, ui ) {
		document.getElementById( i+"_element_valueform_id_temp" ).innerHTML = "" + ui.value ;
		document.getElementById( i+"_slider_valueform_id_temp" ).value = "" + ui.value; 	
		}
	});
	
	
});


}


function change_slider_min_or_max_value(a,b,form_id, min_or_max){ 
document.getElementById( b+"_element_"+min_or_max+"form_id_temp" ).innerHTML=a;
}


function change_slider_width(a,b,form_id){
document.getElementById( b+"_elementform_id_temp" ).style.cssText="width:"+a+"px";
document.getElementById( b+"_slider_widthform_id_temp" ).value=a;

}

function change_slider_min_value(a,b,form_id){
document.getElementById( b+"_slider_min_valueform_id_temp" ).value=a;
document.getElementById(b+"_slider_valueform_id_temp" ).value = a;
if(a > document.getElementById( b+"_element_valueform_id_temp" ).innerHTML){
document.getElementById( b+"_element_valueform_id_temp" ).innerHTML = a;

	jQuery( "#"+b+"_elementform_id_temp").slider({
			min: eval(a),
		slide: function( event, ui ) {
		document.getElementById(b+"_element_valueform_id_temp").innerHTML = "" + ui.value ;
		document.getElementById(b+"_slider_valueform_id_temp" ).value = "" + ui.value;
		}
	});

}
else{

jQuery( "#"+b+"_elementform_id_temp").slider({
		min: eval(a),
		slide: function( event, ui ) {
		document.getElementById(b+"_element_valueform_id_temp" ).innerHTML = "" + ui.value ;
		document.getElementById(b+"_slider_valueform_id_temp" ).value = "" + ui.value;	
		}
	});

}

}

function change_slider_max_value(a,b,form_id){
document.getElementById( b+"_slider_max_valueform_id_temp" ).value=a;

if(a < parseInt(document.getElementById( b+"_slider_valueform_id_temp" ).value)){

document.getElementById( b+"_element_valueform_id_temp" ).innerHTML = a;
document.getElementById(b+"_slider_valueform_id_temp" ).value = a;
	jQuery( "#"+b+"_elementform_id_temp").slider({
		min: eval(document.getElementById(b+"_slider_min_valueform_id_temp" ).value),
		max: eval(a),
		value: eval(document.getElementById(b+"_slider_valueform_id_temp" ).value),
		slide: function( event, ui ) {
		document.getElementById(b+"_element_valueform_id_temp" ).innerHTML = "" + ui.value ;
		document.getElementById(b+"_slider_valueform_id_temp" ).value = "" + ui.value;	
		}
	});
}
else{

jQuery( "#"+b+"_elementform_id_temp").slider({
        min: eval(document.getElementById(b+"_slider_min_valueform_id_temp" ).value),
		max: eval(a),
		value: eval(document.getElementById(b+"_slider_valueform_id_temp" ).value),
		slide: function( event, ui ) {
		document.getElementById(b+"_element_valueform_id_temp" ).innerHTML = "" + ui.value ;
		document.getElementById(b+"_slider_valueform_id_temp" ).value = "" + ui.value;	
		}
	});

}
}



function type_range(i, w_field_label, w_field_label_pos, w_field_range_width, w_field_range_step, w_field_value1, w_field_value2, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value){

   document.getElementById("element_type").value="type_range";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");	
    var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");				
	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	
				
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";	  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";	 	
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
    var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";	 
    var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	
	var el_label_label = document.createElement('label');
	                el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

				
	var el_range_width_label = document.createElement('label');
				el_range_width_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_range_width_label.innerHTML = "Width ";
	
	var el_range_width_input = document.createElement('input');
                el_range_width_input.setAttribute("type", "text");		
                el_range_width_input.setAttribute("id", "edit_for_spinner_width");		
                el_range_width_input.setAttribute("value", w_field_range_width);
                el_range_width_input.style.cssText = "width:100px;";	
				el_range_width_input.setAttribute("onKeyPress", "return check_isnum(event)");	
			    el_range_width_input.setAttribute("onKeyUp", "change_range_width(this.value,"+i+",'form_id_temp')");			
				

	var el_range_step_label = document.createElement('label');
	        el_range_step_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_range_step_label.innerHTML = "Step";
		
		var el_range_step_input = document.createElement('input');
                el_range_step_input.setAttribute("type", "text");		
                el_range_step_input.setAttribute("id", "edit_for_spinner_step");		
                el_range_step_input.setAttribute("value", w_field_range_step);
                el_range_step_input.style.cssText = "width:100px;";	
				el_range_step_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
			    el_range_step_input.setAttribute("onChange", "change_range_step(this.value,"+i+",'form_id_temp')");
	
    
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
			
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_range')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_range')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_range')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_range')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	
	edit_main_td3.appendChild(el_range_width_label);
	edit_main_td3_1.appendChild(el_range_width_input);
	
	edit_main_td4.appendChild(el_range_step_label);	
	edit_main_td4_1.appendChild(el_range_step_input);
	
	
	
	edit_main_td5.appendChild(el_style_label);
	edit_main_td5_1.appendChild(el_style_textarea);
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br1);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	
	
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
    edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	

	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_range');
	
//show table

	
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_range");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
		
	var adding_width= document.createElement("input");
            adding_width.setAttribute("type", "hidden");
            adding_width.setAttribute("value", w_field_range_width);
            adding_width.setAttribute("name", i+"_range_widthform_id_temp");	
            adding_width.setAttribute("id", i+"_range_widthform_id_temp");		
			
		
	var adding_step = document.createElement("input");
            adding_step.setAttribute("type", "hidden");
            adding_step.setAttribute("value", w_field_range_step);
            adding_step.setAttribute("name", i+"_range_stepform_id_temp");	
            adding_step.setAttribute("id", i+"_range_stepform_id_temp");

	  
		
    var adding_range_input_from = document.createElement("input");
            adding_range_input_from.setAttribute("type", "");
            adding_range_input_from.setAttribute("value",'');
			adding_range_input_from.style.cssText="width:"+w_field_range_width+"px"; 
            adding_range_input_from.setAttribute("name", i+"_elementform_id_temp0");	
            adding_range_input_from.setAttribute("id", i+"_elementform_id_temp0");
			adding_range_input_from.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
			
    var adding_range_input_to = document.createElement("input");
            adding_range_input_to.setAttribute("type", "");
            adding_range_input_to.setAttribute("value",'');
			adding_range_input_to.style.cssText="width:"+w_field_range_width+"px"; 
            adding_range_input_to.setAttribute("name", i+"_elementform_id_temp1");	
            adding_range_input_to.setAttribute("id", i+"_elementform_id_temp1");
			adding_range_input_to.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
			
	var adding_range_label_from = document.createElement("label");
          
      adding_range_label_from.setAttribute("class", "mini_label");
			adding_range_label_from.setAttribute("id", i+"_mini_label_from");
			adding_range_label_from.innerHTML=w_mini_labels[0];
          	
			

	var adding_range_label_to = document.createElement("label");
         
		  adding_range_label_to.setAttribute("class", "mini_label");	
			adding_range_label_to.setAttribute("id", i+"_mini_label_to");
			adding_range_label_to.innerHTML=w_mini_labels[1];
          	
          
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
		
		var div_for_editable_labels = document.createElement('div');
			div_for_editable_labels.setAttribute("style", "margin-left:4px; color:red;");
			
      	edit_labels = document.createTextNode("The labels of the fields are editable. Please, click the label to edit.");

		div_for_editable_labels.appendChild(edit_labels);  
		
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

		var table_little = document.createElement('table');
           	table_little.setAttribute("id", i+"_elemet_table_littleform_id_temp");
			
      	var tr1 = document.createElement('tr');
		var tr2 = document.createElement('tr');
			
      	var td1_1 = document.createElement('td');
         	td1_1.setAttribute("valign", 'middle');
         	td1_1.setAttribute("align", 'left');
          
			
		var td1_2 = document.createElement('td');
         	td1_2.setAttribute("valign", 'middle');
         	td1_2.setAttribute("align", 'left');
           
			
      	var td2_1 = document.createElement('td');
        	td2_1.setAttribute("valign", 'top');
         	td2_1.setAttribute("align", 'left');
           
		var td2_2 = document.createElement('td');
        	td2_2.setAttribute("valign", 'top');
         	td2_2.setAttribute("align", 'left');
           	
		  var br1 = document.createElement('br');

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td1.appendChild(required );
      	td2.appendChild(adding_type);
      	td2.appendChild(adding_required);
		td2.appendChild(adding_width);
		td2.appendChild(adding_step);
	    
		td1_1.appendChild(adding_range_input_from);
		td1_2.appendChild(adding_range_input_to);
		td2_1.appendChild(adding_range_label_from);
		td2_2.appendChild(adding_range_label_to);
 	
	    tr1.appendChild(td1_1);
		tr1.appendChild(td1_2);
		tr2.appendChild(td2_1);
		tr2.appendChild(td2_2);
		
		table_little.appendChild(tr1);
		table_little.appendChild(tr2);
		
		td2.appendChild(table_little);
		
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br1);
		div.appendChild(div_for_editable_labels);
	
      	main_td.appendChild(div);
	if (w_field_label_pos=="top") {
    label_top(i);
  }
  change_class(w_class, i);
  refresh_attr(i, 'type_range');

  var spinner1 = jQuery( "#"+i+"_elementform_id_temp0" ).spinner();
  spinner1.spinner( "value", w_field_value1 );
  jQuery( "#"+i+"_elementform_id_temp0" ).spinner({ step: w_field_range_step});

  var spinner2 = jQuery( "#"+i+"_elementform_id_temp1" ).spinner();
  spinner2.spinner( "value", w_field_value2 );
  jQuery( "#"+i+"_elementform_id_temp1" ).spinner({ step: w_field_range_step});

jQuery(document).ready(function() {	
	jQuery("label#"+i+"_mini_label_from").click(function() {
		if (jQuery(this).children('input').length == 0) {				
			var form = "<input type='text' class='form' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
				jQuery(this).html(form);							
				jQuery("input.form").focus();			
				jQuery("input.form").blur(function() {
			var value = jQuery(this).val();
		jQuery("#"+i+"_mini_label_from").text(value);
		});
	}
	});

	jQuery("label#"+i+"_mini_label_to").click(function() {
	if (jQuery(this).children('input').length == 0) {		
		var to = "<input type='text' class='to' size='8' style='outline:none; border:none; background:none;' value=\""+jQuery(this).text()+"\">";	
			jQuery(this).html(to);			
			jQuery("input.to").focus();					
			jQuery("input.to").blur(function() {			
			var value = jQuery(this).val();			
			jQuery("#"+i+"_mini_label_to").text(value);
		});
	}
	});
	});
}


function change_range_width(a,b,form_id){
document.getElementById( b+"_elementform_id_temp0" ).style.cssText="width:"+a+"px";
document.getElementById( b+"_elementform_id_temp1" ).style.cssText="width:"+a+"px";
document.getElementById( b+"_range_widthform_id_temp" ).value=a;
}

function change_range_step(a,b,form_id){
jQuery( "#"+b+"_elementform_id_temp0" ).spinner({ step: a});
jQuery( "#"+b+"_elementform_id_temp1" ).spinner({ step: a});
document.getElementById( b+"_range_stepform_id_temp" ).value=a;


}


function type_grading(i, w_field_label, w_field_label_pos, w_items, w_total, w_required, w_class, w_attr_name, w_attr_value) {

	document.getElementById("element_type").value="type_grading";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

    var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
		
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px ";

		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px; vertical-align:top" ; 	
		edit_main_td4.setAttribute("id", "items");
		
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px; vertical-align:top";
     
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
		edit_main_td5.setAttribute("id", "columns");
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px;  ";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px;  ";
	
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
		
		
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
			
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	var el_total_label = document.createElement('label');
	        el_total_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_total_label.innerHTML = "Total";
	
	var el_total_input = document.createElement('input');
                el_total_input.setAttribute("id", "element_total");
		        el_total_input.setAttribute("type", "text");
 	           	el_total_input.setAttribute("value", w_total);
                el_total_input.style.cssText = "width:200px;";
				el_total_input.setAttribute("onKeyPress", "return check_isnum_or_minus(event)");
                el_total_input.setAttribute("onKeyUp", "change_total(this.value,'"+i+"')");
	
	
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
 		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
				
				

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
		
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_grading')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_grading')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_grading')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_grading')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var el_items_label = document.createElement('label');
			        el_items_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_items_label.innerHTML = "Items ";
	var el_items_add = document.createElement('img');
                el_items_add.setAttribute("id", "el_items_add");
           		el_items_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_items_add.style.cssText = 'cursor:pointer;';
            	el_items_add.setAttribute("title", 'add');
                el_items_add.setAttribute("onClick", "add_grading_items("+i+")");
				
		
	
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);

    edit_main_td3.appendChild(el_total_label);
	edit_main_td3_1.appendChild(el_total_input);
		
	edit_main_td4.appendChild(el_items_label);
	edit_main_td4_1.appendChild(el_items_add);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	

	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	

	
	n=w_items.length;
	for(k=0; k<n; k++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "britems"+k);
			
		var el_items = document.createElement('input');
			el_items.setAttribute("id", "el_items"+k);
			el_items.setAttribute("type", "text");
			el_items.setAttribute("value", w_items[k]);
			el_items.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_items.setAttribute("onKeyUp", "change_label('"+i+"_label_elementform_id_temp"+k+"', this.value); change_in_value('"+i+"_label_elementform_id_temp"+k+"', this.value)");
	
		var el_items_remove = document.createElement('img');
			el_items_remove.setAttribute("id", "el_items"+k+"_remove");
			el_items_remove.setAttribute("src", plugin_url+'/images/delete.png');		
			el_items_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_items_remove.setAttribute("align", 'top');
			el_items_remove.setAttribute("onClick", "remove_grading_items("+k+","+i+")");
			
		edit_main_td4.appendChild(br);
		edit_main_td4.appendChild(el_items);
		edit_main_td4.appendChild(el_items_remove);
	
	}
	


	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
    edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);

		
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);

	
	edit_div.appendChild(edit_main_table);
	t.appendChild(edit_div);
	
//show table

	element='input';	type='grading'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_grading");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
 	var adding_total = document.createElement("input");
            adding_total.setAttribute("type", "hidden");
            adding_total.setAttribute("value", w_total);
            adding_total.setAttribute("name", i+"_grading_totalform_id_temp");
            adding_total.setAttribute("id", i+"_grading_totalform_id_temp");
	    
   var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", i+"_elemet_tableform_id_temp");
	    
	
    var tr = document.createElement('tr');
			
    var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');

	var div_grading = document.createElement('div');
	    div_grading.setAttribute("id", i+"_elementform_id_temp");

 
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");

	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
        td2.appendChild(adding_type);
        td2.appendChild(adding_required);
	    td2.appendChild(adding_total);
      
		td2.appendChild(div_grading);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	
		
	if(w_field_label_pos=="top")
				label_top(i);
				
	
change_class(w_class, i);
refresh_attr(i, 'type_grading');
refresh_grading_items(i);
add_id_and_name(i, 'type_grading');
}

function change_total(value,id){
document.getElementById(id+"_grading_totalform_id_temp").value = value;
document.getElementById(id+"_total_elementform_id_temp").innerHTML = value;
}



function type_matrix(i, w_field_label, w_field_label_pos, w_field_input_type, w_rows, w_columns, w_required, w_class, w_attr_name, w_attr_value) {

	document.getElementById("element_type").value="type_matrix";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black; padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
		
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px ";

		
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px" ; 	
		edit_main_td4.setAttribute("id", "rows");
		
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px; vertical-align:top";
     
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
		edit_main_td5.setAttribute("id", "columns");
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px;  vertical-align:top ";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
			
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
				
	


var el_input_type_label = document.createElement('label');
	        el_input_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_input_type_label.innerHTML = "Input Type";
	
	var el_input_type = document.createElement('select');
                el_input_type.setAttribute("id", "edit_for_select_input_type");
                el_input_type.setAttribute("name", "edit_for_select_input_type");
               el_input_type.setAttribute("onchange", "change_input_type("+i+",this.value); refresh_matrix("+i+")");
                
	var el_input_type1 = document.createElement('option');
                el_input_type1.setAttribute("id", "edit_for_input_type_radio");
                el_input_type1.setAttribute("value", "radio");
Radio_Button = document.createTextNode("Radio Button");

    var el_input_type2 = document.createElement('option');
                el_input_type2.setAttribute("id", "edit_for_input_type_checkbox");
                el_input_type2.setAttribute("value", "checkbox");
Check_Box = document.createTextNode("Check Box");

    var el_input_type3 = document.createElement('option');
                el_input_type3.setAttribute("id", "edit_for_input_type_text");
                el_input_type3.setAttribute("value", "text");
Text_Box= document.createTextNode("Text Box");

    var el_input_type4 = document.createElement('option');
                el_input_type4.setAttribute("id", "edit_for_input_type_select");
                el_input_type4.setAttribute("value", "select");				
Drop_Down = document.createTextNode("Drop Down");              
	
	
	

		if(w_field_input_type=="radio")
				el_input_type1.setAttribute("selected", "selected");
	else
	{
	if(w_field_input_type=="checkbox")
				el_input_type2.setAttribute("selected", "selected");
				else{
				   if(w_field_input_type=="text")
				    el_input_type3.setAttribute("selected", "selected");
				else{
				if(w_field_input_type=="select")
				    el_input_type4.setAttribute("selected", "selected");
				
				}
				}
}


		
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
 		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
				
				

	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
		

		
	
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_matrix')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_matrix')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_matrix')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_matrix')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var el_rows_label = document.createElement('label');
			        el_rows_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_rows_label.innerHTML = "Rows ";
	var el_rows_add = document.createElement('img');
                el_rows_add.setAttribute("id", "el_rows_add");
           		el_rows_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_rows_add.style.cssText = 'cursor:pointer;';
            	el_rows_add.setAttribute("title", 'add');
                el_rows_add.setAttribute("onClick", "add_to_matrix('rows',  "+i+")");
				
	var el_columns_label = document.createElement('label');
			        el_columns_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_columns_label.innerHTML = "Columns ";
	var el_columns_add = document.createElement('img');
                el_columns_add.setAttribute("id", "el_columns_add");
           		el_columns_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_columns_add.style.cssText = 'cursor:pointer;';
            	el_columns_add.setAttribute("title", 'add');
                el_columns_add.setAttribute("onClick", "add_to_matrix('columns',  "+i+")");			
	
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);


	
    edit_main_td3.appendChild(el_input_type_label);
	
	el_input_type1.appendChild(Radio_Button);
	el_input_type2.appendChild(Check_Box);
	el_input_type3.appendChild(Text_Box);
	el_input_type4.appendChild(Drop_Down);
	
	el_input_type.appendChild(el_input_type1);
	el_input_type.appendChild(el_input_type2);
	el_input_type.appendChild(el_input_type3);
	el_input_type.appendChild(el_input_type4);
	
	edit_main_td3_1.appendChild(el_input_type);
	
	
	edit_main_td4.appendChild(el_rows_label);
	edit_main_td4_1.appendChild(el_rows_add);
	
	edit_main_td5.appendChild(el_columns_label);
	edit_main_td5_1.appendChild(el_columns_add);
	
	edit_main_td6.appendChild(el_required_label);
	edit_main_td6_1.appendChild(el_required);
	

	edit_main_td7.appendChild(el_style_label);
	edit_main_td7_1.appendChild(el_style_textarea);
	
	edit_main_td8.appendChild(el_attr_label);
	edit_main_td8.appendChild(el_attr_add);
	edit_main_td8.appendChild(br6);
	edit_main_td8.appendChild(el_attr_table);
	edit_main_td8.setAttribute("colspan", "2");
	

	
	n=w_rows.length;
	for(k=1; k<n; k++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "brrows"+k);
			
		var el_rows = document.createElement('input');
			el_rows.setAttribute("id", "el_rows"+k);
			el_rows.setAttribute("type", "text");
			el_rows.setAttribute("value", w_rows[k]);
			el_rows.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_rows.setAttribute("onKeyUp", "change_label('"+i+"_label_elementform_id_temp"+k+"_0', this.value); change_in_value('"+i+"_label_elementform_id_temp"+k+"_0', this.value)");
	
		var el_rows_remove = document.createElement('img');
			el_rows_remove.setAttribute("id", "el_rows"+k+"_remove");
			el_rows_remove.setAttribute("src", plugin_url+'/images/delete.png');		
			el_rows_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_rows_remove.setAttribute("align", 'top');
			el_rows_remove.setAttribute("onClick", "remove_rowcols("+k+","+i+",'rows')");
			
		edit_main_td4.appendChild(br);
		edit_main_td4.appendChild(el_rows);
		edit_main_td4.appendChild(el_rows_remove);
	
	}
	
	
	m=w_columns.length;
	for(k=1; k<m; k++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "brcolumns"+k);
			
		var el_columns = document.createElement('input');
			el_columns.setAttribute("id", "el_columns"+k);
			el_columns.setAttribute("type", "text");
			el_columns.setAttribute("value", w_columns[k]);
			el_columns.style.cssText ="width:100px; margin:0; padding:0; border-width: 1px";
			el_columns.setAttribute("onKeyUp", "change_label('"+i+"_label_elementform_id_temp0_"+k+"', this.value); change_in_value('"+i+"_label_elementform_id_temp0_"+k+"', this.value)");
	
		var el_columns_remove = document.createElement('img');
			el_columns_remove.setAttribute("id", "el_columns"+k+"_remove");
			el_columns_remove.setAttribute("src", plugin_url+'/images/delete.png');		
			el_columns_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_columns_remove.setAttribute("align", 'top');
			el_columns_remove.setAttribute("onClick", "remove_rowcols("+k+","+i+",'columns')");
			
		edit_main_td5.appendChild(br);
		edit_main_td5.appendChild(el_columns);
		edit_main_td5.appendChild(el_columns_remove);
	
	}

	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
    edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);	
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	
	
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr8);
	
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='input';	type='matrix'; 
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_matrix");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
 	var adding_input_type = document.createElement("input");
            adding_input_type.setAttribute("type", "hidden");
            adding_input_type.setAttribute("value", w_field_input_type);
            adding_input_type.setAttribute("name", i+"_input_typeform_id_temp");
            adding_input_type.setAttribute("id", i+"_input_typeform_id_temp");
	    
   var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", i+"_elemet_tableform_id_temp");
	    
	
    var tr = document.createElement('tr');
			
    var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
	//	table_little -@ sarqaca tbody table_little darela table_little_t
	var table_little_t = document.createElement('table');
	    table_little_t.setAttribute("id", i+"_elementform_id_temp");
	 	//table_little_t.setAttribute("border", "1");

	
		
	var table_little = document.createElement('tbody');
           	table_little.setAttribute("id", i+"_table_little");
	
	
	table_little_t.appendChild(table_little);
	

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");

	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
        td2.appendChild(adding_type);
  
        td2.appendChild(adding_required);
	    td2.appendChild(adding_input_type);
      
		td2.appendChild(table_little_t);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	
		
	if(w_field_label_pos=="top")
				label_top(i);
				
	
change_class(w_class, i);
refresh_attr(i, 'type_matrix');
refresh_matrix(i);
}

function change_input_type(id, value){
	document.getElementById(id+"_input_typeform_id_temp").value = value;
}

function type_paypal_shipping(i, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_price, w_choices_checked, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value,  w_property, w_property_type, w_property_values ){

	document.getElementById("element_type").value="type_paypal_shipping";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px; padding:10px; padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");
			
	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");
			
	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_tr9  = document.createElement('tr');
      		edit_main_tr9.setAttribute("valing", "top");

	var edit_main_tr10  = document.createElement('tr');
      		edit_main_tr10.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";

	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
		edit_main_td4.setAttribute("id", "choices");
		
		
	var edit_main_td10 = document.createElement('td');
		edit_main_td10.style.cssText = "padding-top:10px";
	var edit_main_td10_1 = document.createElement('td');
		edit_main_td10_1.style.cssText = "padding-top:10px";

	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td9 = document.createElement('td');
		edit_main_td9.style.cssText = "padding-top:10px";
	var edit_main_td9_1 = document.createElement('td');
		edit_main_td9_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
				el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");

                el_label_position2.setAttribute("value", "top");
	

                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	var el_label_flow = document.createElement('label');
			        el_label_flow.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_flow.innerHTML = "Relative Position";

	var el_flow_vertical = document.createElement('input');
                el_flow_vertical.setAttribute("id", "edit_for_flow_vertical");
                el_flow_vertical.setAttribute("type", "radio");
                el_flow_vertical.setAttribute("value", "ver");
                el_flow_vertical.setAttribute("name", "edit_for_flow");
                el_flow_vertical.setAttribute("onchange", "flow_ver("+i+")");
		Vertical = document.createTextNode("Vertical");
		
	var el_flow_horizontal = document.createElement('input');
            el_flow_horizontal.setAttribute("id", "edit_for_flow_horizontal");
            el_flow_horizontal.setAttribute("type", "radio");
            el_flow_horizontal.setAttribute("value", "hor");
            el_flow_horizontal.setAttribute("name", "edit_for_flow");
            el_flow_horizontal.setAttribute("onchange", "flow_hor("+i+")");
		Horizontal = document.createTextNode("Horizontal");
		
	if(w_flow=="hor")
				el_flow_horizontal.setAttribute("checked", "checked");
	else
				el_flow_vertical.setAttribute("checked", "checked");
				
	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
        el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
        el_style_textarea.style.cssText = "width:200px;";
        el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");

				
	var el_randomize_label = document.createElement('label');
				el_randomize_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_randomize_label.innerHTML = "Randomize in frontend";
	
	var el_randomize = document.createElement('input');
                el_randomize.setAttribute("id", "el_randomize");
                el_randomize.setAttribute("type", "checkbox");
                el_randomize.setAttribute("value", "yes");
                el_randomize.setAttribute("onclick", "set_randomize('"+i+"_randomizeform_id_temp')");
	if(w_randomize=="yes")
			    el_randomize.setAttribute("checked", "checked");

	var el_allow_other_label = document.createElement('label');
				el_allow_other_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_allow_other_label.innerHTML = "Allow other";
	
	var el_allow_other = document.createElement('input');
                el_allow_other.setAttribute("id", "el_allow_other");
                el_allow_other.setAttribute("type", "checkbox");
                el_allow_other.setAttribute("value", "yes");
                el_allow_other.setAttribute("onclick", "set_allow_other('"+i+"','radio')");
	if(w_allow_other=="yes")
			    el_allow_other.setAttribute("checked", "checked");

	var el_product_option_label = document.createElement('label');
	    el_product_option_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px;";
		el_product_option_label.innerHTML = "Product properties";
	
	var el_product_option_add_a = document.createElement('a');
		// el_product_option_add_a.setAttribute("rel", "{handler: 'iframe', size: {x: 650, y: 375}}"	);
		// el_product_option_add_a.setAttribute("href","index.php?option=com_formmaker&task=product_option&field_id="+i+"&tmpl=component");
		// el_product_option_add_a.setAttribute("class","modal");
    el_product_option_add_a.setAttribute("href", url_for_ajax + "?action=product_option&field_id=" + i + "&url_for_ajax=" + url_for_ajax + "&TB_iframe=1");
		el_product_option_add_a.setAttribute("class","thickbox-preview11");

	var el_product_option_add_img = document.createElement('img');
		el_product_option_add_img.setAttribute("src", plugin_url+'/images/add.png');
		
	var el_product_option_add_ul = document.createElement('ul');
		el_product_option_add_ul.setAttribute("id", 'option_ul');
		el_product_option_add_ul.style.cssText="list-style-type: none; padding:0px"
				
				
	el_product_option_add_a.appendChild(el_product_option_add_img);
	

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_checkbox')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var el_choices_label = document.createElement('label');
			        el_choices_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_choices_label.innerHTML = "Options ";

	
	var el_choices_add = document.createElement('img');
                el_choices_add.setAttribute("id", "el_choices_add");
           	el_choices_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_choices_add.style.cssText = 'cursor:pointer;';
            	el_choices_add.setAttribute("title", 'add');
                el_choices_add.setAttribute("onClick", "add_choise_price('radio',"+i+")");
				
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	

	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_label_flow);
	edit_main_td3_1.appendChild(el_flow_vertical);
	edit_main_td3_1.appendChild(Vertical);
	edit_main_td3_1.appendChild(br4);
	edit_main_td3_1.appendChild(el_flow_horizontal);
	edit_main_td3_1.appendChild(Horizontal);

	edit_main_td6.appendChild(el_style_label);
	edit_main_td6_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	
	edit_main_td8.appendChild(el_randomize_label);
	edit_main_td8_1.appendChild(el_randomize);
	
	edit_main_td9.appendChild(el_allow_other_label);
	edit_main_td9_1.appendChild(el_allow_other);
	
	edit_main_td10.appendChild(el_product_option_label);
	edit_main_td10.appendChild(el_product_option_add_ul);
	edit_main_td10_1.appendChild(el_product_option_add_a);
	
	edit_main_td7.appendChild(el_attr_label);
	edit_main_td7.appendChild(el_attr_add);
	edit_main_td7.appendChild(br6);
	edit_main_td7.appendChild(el_attr_table);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_td4.appendChild(el_choices_label);
	edit_main_td4_1.appendChild(el_choices_add);

			var div_ = document.createElement('div');
			div_.style.cssText = 'border-bottom:1px dotted black; width: 187px;';
		var br = document.createElement('br');
		
		var el_choices_mini_label = document.createElement('b');
			el_choices_mini_label.innerHTML="Shipping type";
			el_choices_mini_label.style.cssText='padding-right: 15px; padding-left: 15px; font-size:9px';
			
		var el_choices_price_mini_label = document.createElement('b');
			el_choices_price_mini_label.innerHTML="Price";
			el_choices_price_mini_label.style.cssText='padding-right: 15px; padding-left: 15px;  font-size:9px';
	
		var el_choices_remove_mini_label = document.createElement('b');
			el_choices_remove_mini_label.innerHTML="Empty value";
			el_choices_remove_mini_label.style.cssText='padding-right: 2px; padding-left: 2px; font-size:9px';
			
		var el_choices_dis_mini_label = document.createElement('b');
			el_choices_dis_mini_label.innerHTML="Delete";
			el_choices_dis_mini_label.style.cssText='padding-left: 2px; padding-right: 2px; font-size:9px';
			
		div_.appendChild(br);
		div_.appendChild(el_choices_mini_label);
		div_.appendChild(el_choices_price_mini_label);
		div_.appendChild(el_choices_dis_mini_label);
		edit_main_td4.appendChild(div_);


	n=w_choices.length;
	for(j=0; j<n; j++)
	{	
		var br = document.createElement('br');
			br.setAttribute("id", "br"+j);
			
		var el_choices = document.createElement('input');
			el_choices.setAttribute("id", "el_choices"+j);
			el_choices.setAttribute("type", "text");
			el_choices.setAttribute("value", w_choices[j]);
			el_choices.style.cssText =   "width:100px; margin:0; padding:0; border-width: 1px";
			el_choices.setAttribute("onKeyUp", "change_label('"+i+"_label_element"+j+"', this.value); change_label_1('"+i+"_elementlabel_form_id_temp"+j+"', this.value); ");
	
		var el_choices_price = document.createElement('input');
			el_choices_price.setAttribute("id", "el_option_price"+j);
			el_choices_price.setAttribute("type", "text");
			el_choices_price.setAttribute("value", w_choices_price[j]);
			el_choices_price.style.cssText =   "width:50px; margin:1px; padding:0; border-width: 1px";
		if(w_allow_other=="yes" && j==w_allow_other_num)
			el_choices_price.style.display = 'none';
			el_choices_price.setAttribute("onKeyUp", "change_value_price('"+i+"_elementform_id_temp"+j+"', this.value)");
			el_choices_price.setAttribute("onKeyPress", "return check_isnum_point(event)");

		var el_choices_remove = document.createElement('img');
			el_choices_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_choices_remove.setAttribute("src", plugin_url+'/images/delete.png');
		if(w_allow_other=="yes" && j==w_allow_other_num)
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px; display:none';
		else			
			el_choices_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_choices_remove.setAttribute("align", 'top');
			el_choices_remove.setAttribute("onClick", "remove_choise_price("+j+","+i+")");
			
		edit_main_td4.appendChild(br);
		edit_main_td4.appendChild(el_choices);
		edit_main_td4.appendChild(el_choices_price);
		edit_main_td4.appendChild(el_choices_remove);
	
	}


	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_tr8.style.display="none";
	edit_main_tr9.appendChild(edit_main_td9);
	edit_main_tr9.appendChild(edit_main_td9_1);
	edit_main_tr9.style.display="none";
	edit_main_tr10.appendChild(edit_main_td10);
	edit_main_tr10.appendChild(edit_main_td10_1);
	edit_main_tr10.style.display="none";
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr9);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr10);
	edit_main_table.appendChild(edit_main_tr7);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='input';	type='radio'; 
		var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_paypal_shipping");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
	    
	var adding_randomize = document.createElement("input");
            adding_randomize.setAttribute("type", "hidden");
            adding_randomize.setAttribute("value", w_randomize);
            adding_randomize.setAttribute("name", i+"_randomizeform_id_temp");			
            adding_randomize.setAttribute("id", i+"_randomizeform_id_temp");
	    
	var adding_allow_other= document.createElement("input");
            adding_allow_other.setAttribute("type", "hidden");
            adding_allow_other.setAttribute("value", w_allow_other);
            adding_allow_other.setAttribute("name", i+"_allow_otherform_id_temp");			
            adding_allow_other.setAttribute("id", i+"_allow_otherform_id_temp");
	    
     var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
			
	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
	
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
//tbody sarqac		
		var table_little_t = document.createElement('table');
			
		var table_little = document.createElement('tbody');
           	table_little.setAttribute("id", i+"_table_little");
			
		table_little_t.appendChild(table_little);
	
      	var tr_little1 = document.createElement('tr');
	        tr_little1.setAttribute("id", i+"_element_tr1");
		
      	var tr_little2 = document.createElement('tr');
 	        tr_little2.setAttribute("id", i+"_element_tr2");
			
      	var td_little1 = document.createElement('td');
         	td_little1.setAttribute("valign", 'top');
           	td_little1.setAttribute("id", i+"_td_little1");
			
      	var td_little2 = document.createElement('td');
        	td_little2.setAttribute("valign", 'top');
           	td_little2.setAttribute("id", i+"_td_little2");
			

	    
      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	n=w_choices.length;
	aaa=false;
	for(j=0; j<n; j++)
	{      	
		var tr_little = document.createElement('tr');
			tr_little.setAttribute("id", i+"_element_tr"+j);
				
		var td_little = document.createElement('td');
			td_little.setAttribute("valign", 'top');
			td_little.setAttribute("id", i+"_td_little"+j);
			td_little.setAttribute("idi", j);
	
		var adding = document.createElement(element);
				adding.setAttribute("type", type);
				adding.setAttribute("id", i+"_elementform_id_temp"+j);
				adding.setAttribute("name", i+"_elementform_id_temp");
				adding.setAttribute("value", w_choices_price[j]);
			if(w_allow_other=="yes" && j==w_allow_other_num)
			{
				adding.setAttribute("other", "1");
				adding.setAttribute("onclick", "set_default('"+i+"','"+j+"','form_id_temp'); show_other_input('"+i+"','form_id_temp');");
			}
			else
				adding.setAttribute("onclick", "set_default('"+i+"','"+j+"','form_id_temp')");
			
		if(w_choices_checked[j]=='1')
		{
			adding.setAttribute("checked", "checked");
		}		
				
				
		var label_adding = document.createElement('label');
				label_adding.setAttribute("id", i+"_label_element"+j);
				label_adding.setAttribute("class","ch_rad_label");
				label_adding.setAttribute("for",i+"_elementform_id_temp"+j);
				label_adding.innerHTML = w_choices[j];
				
		var adding_ch_label = document.createElement('input');
				adding_ch_label.setAttribute("type", "hidden");
				adding_ch_label.setAttribute("id", i+"_elementlabel_form_id_temp"+j);
				adding_ch_label.setAttribute("name", i+"_elementform_id_temp"+j+"_label");
				adding_ch_label.setAttribute("value", w_choices[j]);
				
				
		td_little.appendChild(adding);
		td_little.appendChild(label_adding);
		td_little.appendChild(adding_ch_label);
		tr_little.appendChild(td_little);
		table_little.appendChild(tr_little);
			
		if(w_choices_checked[j]=='1')
			if(w_allow_other=="yes" && j==w_allow_other_num)
				aaa=true;
	}			
	
		var div_ = document.createElement('div');
			div_.setAttribute("id", i+"_divform_id_temp");
	    
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
       	td2.appendChild(adding_type);
	
       	td2.appendChild(adding_required);
       	td2.appendChild(adding_randomize);
       	td2.appendChild(adding_allow_other);
		td2.appendChild(table_little_t);
  		td2.appendChild(div_);
    	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	add_id_and_name(i, 'type_radio');

		if(w_field_label_pos=="top")
					label_top(i);
		
		if(w_flow=="hor")
				
				flow_hor(i);
/////////////////////////////////////////////////
form_maker_open_in_popup(11);
// form_maker_open_in_popup(20);
change_class(w_class, i);
refresh_attr(i, 'type_checkbox');
if(aaa)
{
	show_other_input(i);
}

add_properties(i, w_property, w_property_values, w_property_type);

}

function type_country(i, w_field_label, w_countries, w_field_label_pos, w_size, w_required, w_class, w_attr_name, w_attr_value) {

	document.getElementById("element_type").value="type_country";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
		  
	var el_label_label = document.createElement('label');
			        el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px;";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
				el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
			        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                

                el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
		el_label_position1.setAttribute("checked", "checked");
		Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
	


                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
		Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
	
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");
	
	var el_size_label = document.createElement('label');
	        el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Field size(px) ";
	var el_size = document.createElement('input');
		el_size.setAttribute("id", "edit_for_input_size");

		el_size.setAttribute("type", "text");
		el_size.setAttribute("value", w_size);
		
		el_size.setAttribute("name", "edit_for_size");
		el_size.setAttribute("onKeyPress", "return check_isnum(event)");
		el_size.setAttribute("onKeyUp", "change_w_style('"+i+"_elementform_id_temp', this.value)");
		
	var el_edit_list = document.createElement('a');
	  el_edit_list.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px; font-style:italic; cursor:pointer";
		el_edit_list.innerHTML = "Edit country list";
		el_edit_list.setAttribute("href", url_for_ajax + "?action=fromeditcountryinpopup&field_id="+i+"&TB_iframe=1");
		el_edit_list.setAttribute("class","thickbox-preview11");
		
	var el_style_label = document.createElement('label');
	        el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
                el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
                el_style_textarea.style.cssText = "width:200px;";
                el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");
	var el_required_label = document.createElement('label');
	        el_required_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_required_label.innerHTML = "Required";
	
	var el_required = document.createElement('input');
                el_required.setAttribute("id", "el_send");
                el_required.setAttribute("type", "checkbox");
                el_required.setAttribute("value", "yes");
                el_required.setAttribute("onclick", "set_required('"+i+"_required')");
	if(w_required=="yes")
			
                el_required.setAttribute("checked", "checked");
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_text')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_text')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_text')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_text')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
		br3.setAttribute("id", "br1");
	var br4 = document.createElement('br');
		br4.setAttribute("id", "br2");
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_size);
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	edit_main_td5.appendChild(el_required_label);
	edit_main_td5_1.appendChild(el_required);
	edit_main_td6.appendChild(el_attr_label);
	edit_main_td6.appendChild(el_attr_add);
	edit_main_td6.appendChild(br3);
	edit_main_td6.appendChild(el_attr_table);
	edit_main_td6.setAttribute("colspan", "2");
	
	edit_main_td7.appendChild(el_edit_list);
	edit_main_td7.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_main_table.appendChild(edit_main_tr6);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table
	var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_country");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");
	var adding_required = document.createElement("input");
            adding_required.setAttribute("type", "hidden");
            adding_required.setAttribute("value", w_required);
            adding_required.setAttribute("name", i+"_requiredform_id_temp");
			
            adding_required.setAttribute("id", i+"_requiredform_id_temp");
			
     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
			
		var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'middle');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'middle');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
		
	var table_little = document.createElement('table');
           	table_little.setAttribute("id", i+"_table_little");
			
      	var tr_little1 = document.createElement('tr');
	        tr_little1.setAttribute("id", i+"_element_tr1");
		
      	var tr_little2 = document.createElement('tr');
 	        tr_little2.setAttribute("id", i+"_element_tr2");
			
      	var td_little1 = document.createElement('td');
         	td_little1.setAttribute("valign", 'top');
           	td_little1.setAttribute("id", i+"_td_little1");
			
      	var td_little2 = document.createElement('td');
        	td_little2.setAttribute("valign", 'top');
           	td_little2.setAttribute("id", i+"_td_little2");
			

      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var required = document.createElement('span');
			required.setAttribute("id", i+"_required_elementform_id_temp");
			required.innerHTML = "";
			required.setAttribute("class", "required");
	if(w_required=="yes")
			required.innerHTML = " *";
	var select_ = document.createElement('select');
		select_.setAttribute("id", i+"_elementform_id_temp");
		select_.setAttribute("name", i+"_elementform_id_temp");
		select_.style.cssText = "width:"+w_size+"px";
		
		
		for(r=0;r<w_countries.length;r++)
		{
		var option_ = document.createElement('option');
			option_.setAttribute("value", w_countries[r]);
			option_.innerHTML=w_countries[r];
		select_.appendChild(option_);
		}
      	var main_td  = document.getElementById('show_table');
	
      
      	td1.appendChild(label);
      	td1.appendChild(required);
	td2.appendChild(adding_type);
	
	td2.appendChild(adding_required);
      	td2.appendChild(select_);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	
	if(w_field_label_pos=="top")
				label_top(i);
var thickDims, tbWidth, tbHeight;
jQuery(document).ready(function($) {

        thickDims = function() {
                var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;

                w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
                h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;

                if ( tbWindow.size() ) {
                        tbWindow.width(w).height(h);
                        jQuery('#TB_iframeContent').width(w).height(h - 27);
                        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
                        if ( typeof document.body.style.maxWidth != 'undefined' )
                                tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
                }
        };

        thickDims();
        jQuery(window).resize( function() { thickDims() } );

        jQuery('a.thickbox-preview11').click( function() {
                tb_click.call(this);

                var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;

                if ( tbWidth = href.match(/&tbWidth=[0-9]+/) )
                        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbWidth = jQuery(window).width() - 120;

                if ( tbHeight = href.match(/&tbHeight=[0-9]+/) )
                        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
                else
                        tbHeight = jQuery(window).height() - 120;

                if ( alink.length ) {
                        url = alink.attr('href') || '';
                        text = alink.attr('title') || '';
                        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
                } else {
                        text = jQuery(this).attr('title') || '';
                        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
                }

                jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
                jQuery('#TB_closeAjaxWindow').css({'float':'left'});
                jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);

                jQuery('#TB_iframeContent').width('100%');
                thickDims();

                return false;
        } );
});
change_class(w_class, i);
refresh_attr(i, 'type_text');
}

function type_recaptcha(i,w_field_label, w_field_label_pos, w_public, w_private, w_theme, w_class, w_attr_name, w_attr_value){
    document.getElementById("element_type").value="type_recaptcha";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_tr7  = document.createElement('tr');
      		edit_main_tr7.setAttribute("valing", "top");

	var edit_main_tr8  = document.createElement('tr');
      		edit_main_tr8.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td7 = document.createElement('td');
		edit_main_td7.style.cssText = "padding-top:10px";
	var edit_main_td7_1 = document.createElement('td');
		edit_main_td7_1.style.cssText = "padding-top:10px";
		  
	var edit_main_td8 = document.createElement('td');
		edit_main_td8.style.cssText = "padding-top:10px";
	var edit_main_td8_1 = document.createElement('td');
		edit_main_td8_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	    el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
                el_label_textarea.setAttribute("id", "edit_for_label");
                el_label_textarea.setAttribute("rows", "4");
                el_label_textarea.style.cssText = "width:200px";
                el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	        el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
                el_label_position1.setAttribute("id", "edit_for_label_position_top");
                el_label_position1.setAttribute("type", "radio");
                el_label_position1.setAttribute("value", "left");
                
		el_label_position1.setAttribute("name", "edit_for_label_position");
                el_label_position1.setAttribute("onchange", "label_left("+i+")");
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
                el_label_position2.setAttribute("id", "edit_for_label_position_left");
                el_label_position2.setAttribute("type", "radio");
                el_label_position2.setAttribute("value", "top");
		
                el_label_position2.setAttribute("name", "edit_for_label_position");
                el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
				el_label_position2.setAttribute("checked", "checked");
	else
				el_label_position1.setAttribute("checked", "checked");

	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
        el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
        el_style_textarea.style.cssText = "width:200px;";
        el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_public_label = document.createElement('label');
	    el_public_label.style.cssText ="color:#BA0D0D; font-weight:bold; font-size: 13px;text-decoration:underline";
		el_public_label.innerHTML = "Public key";
	
	var el_public_textarea = document.createElement('input');
        el_public_textarea.setAttribute("id", "public_key");
		el_public_textarea.setAttribute("type", "text");
		el_public_textarea.setAttribute("value", w_public);
        el_public_textarea.style.cssText = "width:200px;";
        el_public_textarea.setAttribute("onChange", "change_key(this.value, 'public_key')");


	var el_private_label = document.createElement('label');
	    el_private_label.style.cssText ="color:#BA0D0D; font-weight:bold; font-size: 13px; text-decoration:underline";
		el_private_label.innerHTML = "Private key";
	
	var el_private_textarea = document.createElement('input');
        el_private_textarea.setAttribute("id", "private_key");
		el_private_textarea.setAttribute("type", "text");
		el_private_textarea.setAttribute("value", w_private);
        el_private_textarea.style.cssText = "width:200px;";
        el_private_textarea.setAttribute("onChange", "change_key(this.value, 'private_key')");


	var el_theme_label = document.createElement('label');
	    el_theme_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_theme_label.innerHTML = "Recaptcha Theme";
	
	var el_theme_select = document.createElement('select');
        el_theme_select.style.cssText = "width:100px;";
        el_theme_select.setAttribute("onChange", "change_key(this.value, 'theme')");
		
	var el_theme_option1 = document.createElement('option');
		el_theme_option1.value="red";
		el_theme_option1.innerHTML="Red";
		
	var el_theme_option2= document.createElement('option');
		el_theme_option2.value="white";
		el_theme_option2.innerHTML="White";
		
	var el_theme_option3= document.createElement('option');
		el_theme_option3.value="blackglass";
		el_theme_option3.innerHTML="Blackglass";
	
	var el_theme_option4= document.createElement('option');
		el_theme_option4.value="clean";
		el_theme_option4.innerHTML="Clean";
	
	el_theme_select.appendChild(el_theme_option1);
	el_theme_select.appendChild(el_theme_option2);
	el_theme_select.appendChild(el_theme_option3);
	el_theme_select.appendChild(el_theme_option4);
	
	el_theme_select.value=w_theme;
	
		
		
		

	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_recaptcha')");
	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_recaptcha')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_recaptcha')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_recaptcha')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	
	edit_main_td6.appendChild(el_public_label);
	edit_main_td6_1.appendChild(el_public_textarea);
	
	edit_main_td7.appendChild(el_private_label);
	edit_main_td7_1.appendChild(el_private_textarea);
	
	edit_main_td8.appendChild(el_theme_label);
	edit_main_td8_1.appendChild(el_theme_select);
	
	edit_main_td5.appendChild(el_attr_label);
	edit_main_td5.appendChild(el_attr_add);
	edit_main_td5.appendChild(br3);
	edit_main_td5.appendChild(el_attr_table);
	edit_main_td5.setAttribute("colspan", "2");

	/*edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4.appendChild(br3);
	edit_main_td4.appendChild(el_first_value_input);*/
	
/*	edit_main_td5.appendChild(el_guidelines_label);
	edit_main_td5.appendChild(br4);
	edit_main_td5.appendChild(el_guidelines_textarea);
*/	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_tr6.appendChild(edit_main_td6);
	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr7.appendChild(edit_main_td7);
	edit_main_tr7.appendChild(edit_main_td7_1);
	edit_main_tr8.appendChild(edit_main_td8);
	edit_main_tr8.appendChild(edit_main_td8_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
//	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr6);
	edit_main_table.appendChild(edit_main_tr7);
	edit_main_table.appendChild(edit_main_tr8);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_text');
	
//show table

	element='img';	type='captcha'; 
		var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_recaptcha");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");

		var adding = document.createElement('div');
      	    adding.setAttribute("id", "wd_recaptchaform_id_temp");
      	    adding.setAttribute("public_key", w_public);
      	    adding.setAttribute("private_key", w_private);
      	    adding.setAttribute("theme", w_theme);
			
		var adding_text = document.createElement('span');
			adding_text.style.color="red";
			adding_text.style.fontStyle="italic";
			adding_text.innerHTML="Recaptcha don't display in back end";
			
		adding.appendChild(adding_text);
		
		var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
		
	
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td2.appendChild(adding_type);
      	td2.appendChild(adding);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_recaptcha');
}

function type_captcha(i,w_field_label, w_field_label_pos, w_digit, w_class, w_attr_name, w_attr_value){
    document.getElementById("element_type").value="type_captcha";

	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border-top:1px dotted black;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      	edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";	
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
		
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
	var el_label_label = document.createElement('label');
	    el_label_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_label.innerHTML = "Field label";
	
	var el_label_textarea = document.createElement('textarea');
        el_label_textarea.setAttribute("id", "edit_for_label");
        el_label_textarea.setAttribute("rows", "4");
        el_label_textarea.style.cssText = "width:200px";
        el_label_textarea.setAttribute("onKeyUp", "change_label('"+i+"_element_labelform_id_temp', this.value)");
		el_label_textarea.innerHTML = w_field_label;
		
	var el_label_position_label = document.createElement('label');
	    el_label_position_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_label_position_label.innerHTML = "Field label position";
	
	var el_label_position1 = document.createElement('input');
        el_label_position1.setAttribute("id", "edit_for_label_position_top");
        el_label_position1.setAttribute("type", "radio");
        el_label_position1.setAttribute("value", "left");
        
		el_label_position1.setAttribute("name", "edit_for_label_position");
        el_label_position1.setAttribute("onchange", "label_left("+i+")");
		
	Left = document.createTextNode("Left");
		
	var el_label_position2 = document.createElement('input');
        el_label_position2.setAttribute("id", "edit_for_label_position_left");
        el_label_position2.setAttribute("type", "radio");
        el_label_position2.setAttribute("value", "top");
		
        el_label_position2.setAttribute("name", "edit_for_label_position");
        el_label_position2.setAttribute("onchange", "label_top("+i+")");
	Top = document.createTextNode("Top");
		
	if(w_field_label_pos=="top")
		el_label_position2.setAttribute("checked", "checked");
	else
		el_label_position1.setAttribute("checked", "checked");

	var el_size_label = document.createElement('label');
	    el_size_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_size_label.innerHTML = "Captcha size";
	
	var el_captcha_digit = document.createElement('input');
        el_captcha_digit.setAttribute("id", "captcha_digit");
        el_captcha_digit.setAttribute("type", "text");
        el_captcha_digit.setAttribute("value", w_digit);
		el_captcha_digit.setAttribute("name", "captcha_digit");
 		el_captcha_digit.setAttribute("onKeyPress", "return check_isnum_3_10(event)");
        el_captcha_digit.setAttribute("onKeyUp", "change_captcha_digit(this.value, '"+i+"')");
	    el_captcha_digit.style.cssText ="margin-right:18px";

	Digits = document.createTextNode("Digits (3 - 9)");
	
	var el_style_label = document.createElement('label');
	    el_style_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_style_label.innerHTML = "Class name";
	
	var el_style_textarea = document.createElement('input');
        el_style_textarea.setAttribute("id", "element_style");
		el_style_textarea.setAttribute("type", "text");
		el_style_textarea.setAttribute("value", w_class);
        el_style_textarea.style.cssText = "width:200px;";
        el_style_textarea.setAttribute("onChange", "change_class(this.value,'"+i+"')");

	var el_attr_label = document.createElement('label');
	    el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_attr_label.innerHTML = "Additional Attributes";
		
	var el_attr_add = document.createElement('img');
        el_attr_add.setAttribute("id", "el_choices_add");
        el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
        el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
        el_attr_add.setAttribute("title", 'add');
        el_attr_add.setAttribute("onClick", "add_attr("+i+", 'type_captcha')");
		
	var el_attr_table = document.createElement('table');
        el_attr_table.setAttribute("id", 'attributes');
        el_attr_table.setAttribute("border", '0');
        el_attr_table.style.cssText = 'margin-left:0px';
		
	var el_attr_tr_label = document.createElement('tr');
        el_attr_tr_label.setAttribute("idi", '0');
		
	var el_attr_td_name_label = document.createElement('th');
        el_attr_td_name_label.style.cssText = 'width:100px';
		
	var el_attr_td_value_label = document.createElement('th');
        el_attr_td_value_label.style.cssText = 'width:100px';
		
	var el_attr_td_X_label = document.createElement('th');
        el_attr_td_X_label.style.cssText = 'width:10px';
		
	var el_attr_name_label = document.createElement('label');
	    el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
		el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	    el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
		el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_captcha')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_captcha')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_captcha')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}
		
	var t  = document.getElementById('edit_table');
	
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_label_label);
	edit_main_td1_1.appendChild(el_label_textarea);

	edit_main_td2.appendChild(el_label_position_label);
	edit_main_td2_1.appendChild(el_label_position1);
	edit_main_td2_1.appendChild(Left);
	edit_main_td2_1.appendChild(br2);
	edit_main_td2_1.appendChild(el_label_position2);
	edit_main_td2_1.appendChild(Top);
	
	edit_main_td3.appendChild(el_size_label);
	edit_main_td3_1.appendChild(el_captcha_digit);
	edit_main_td3_1.appendChild(Digits);
	
	edit_main_td4.appendChild(el_style_label);
	edit_main_td4_1.appendChild(el_style_textarea);
	
	edit_main_td5.appendChild(el_attr_label);
	edit_main_td5.appendChild(el_attr_add);
	edit_main_td5.appendChild(br3);
	edit_main_td5.appendChild(el_attr_table);
	edit_main_td5.setAttribute("colspan", "2");

	/*edit_main_td4.appendChild(el_first_value_label);
	edit_main_td4.appendChild(br3);
	edit_main_td4.appendChild(el_first_value_input);*/
	
/*	edit_main_td5.appendChild(el_guidelines_label);
	edit_main_td5.appendChild(br4);
	edit_main_td5.appendChild(el_guidelines_textarea);
*/	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr5.appendChild(edit_main_td5);
	edit_main_tr5.appendChild(edit_main_td5_1);
	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr2);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr5);
	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	add_id_and_name(i, 'type_captcha');
	
//show table

	element='img';	type='captcha'; 
		var adding_type = document.createElement("input");
            adding_type.setAttribute("type", "hidden");
            adding_type.setAttribute("value", "type_captcha");
            adding_type.setAttribute("name", i+"_typeform_id_temp");
            adding_type.setAttribute("id", i+"_typeform_id_temp");


	var adding = document.createElement(element);
           	adding.setAttribute("type", type);
           	adding.setAttribute("digit", w_digit);
           	adding.setAttribute("src", url_for_ajax+"?action=formmakerwdcaptcha"+"&digit="+w_digit+"&i=form_id_temp");
			adding.setAttribute("id", "_wd_captchaform_id_temp");
			adding.setAttribute("class", "captcha_img");
			adding.setAttribute("onClick", "captcha_refresh('_wd_captcha','form_id_temp')");
			
   
		
	var refresh_captcha = document.createElement("div");
          //refresh_captcha.setAttribute("src", plugin_url+"/images/refresh.png");
			refresh_captcha.setAttribute("class", "captcha_refresh");
			refresh_captcha.setAttribute("id", "_element_refreshform_id_temp");
			refresh_captcha.setAttribute("onClick", "captcha_refresh('_wd_captcha','form_id_temp')");

	var input_captcha = document.createElement("input");
           	input_captcha.setAttribute("type", "text");
			input_captcha.style.cssText = "width:"+(w_digit*10+15)+"px;";
			input_captcha.setAttribute("class", "captcha_input");
			input_captcha.setAttribute("id", "_wd_captcha_inputform_id_temp");
			input_captcha.setAttribute("name", "captcha_input");

     	var div = document.createElement('div');
      	    div.setAttribute("id", "main_div");
					
      	var table = document.createElement('table');
           	table.setAttribute("id", i+"_elemet_tableform_id_temp");
			
      	var tr = document.createElement('tr');
			
      	var td1 = document.createElement('td');
         	td1.setAttribute("valign", 'top');
         	td1.setAttribute("align", 'left');
           	td1.setAttribute("id", i+"_label_sectionform_id_temp");
			
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", i+"_element_sectionform_id_temp");
		
	var captcha_table = document.createElement('table');
	
      	var captcha_tr1 = document.createElement('tr');
      	var captcha_tr2 = document.createElement('tr');

      	var captcha_td1 = document.createElement('td');
		captcha_td1.setAttribute("valign", 'middle');

      	var captcha_td2 = document.createElement('td');
  		captcha_td2.setAttribute("valign", 'middle');
    	var captcha_td3 = document.createElement('td');
	
	captcha_table.appendChild(captcha_tr1);
      	captcha_table.appendChild(captcha_tr2);
      	captcha_tr1.appendChild(captcha_td1);
      	captcha_tr1.appendChild(captcha_td2);
      	captcha_tr2.appendChild(captcha_td3);
	
      	captcha_td1.appendChild(adding);
      	captcha_td2.appendChild(refresh_captcha);
      	captcha_td3.appendChild(input_captcha);

	
	
	
      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
      

      	var label = document.createElement('span');
			label.setAttribute("id", i+"_element_labelform_id_temp");
			label.innerHTML = w_field_label;
			label.setAttribute("class", "label");
	    
      	var main_td  = document.getElementById('show_table');
      
      	td1.appendChild(label);
      	td2.appendChild(adding_type);
      	td2.appendChild(captcha_table);
      	tr.appendChild(td1);
      	tr.appendChild(td2);
      	table.appendChild(tr);
      
      	div.appendChild(table);
      	div.appendChild(br3);
      	main_td.appendChild(div);
	if(w_field_label_pos=="top")
				label_top(i);
change_class(w_class, i);
refresh_attr(i, 'type_captcha');
}

//////////////////////////////////////////////
///////////  type_page_break   //////////////////
///////////////////////////////////////////////
	
function type_page_navigation(w_type, w_show_title, w_show_numbers, w_attr_name, w_attr_value)
{
  if (need_enable) {
    enable2();
  }
	document.getElementById("element_type").value="type_page_navigation";
	delete_last_child();
  // edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border:0px;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";
	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
	edit_main_td6.setAttribute("colspan", "2");
		  
		  
	var el_pagination_opt_label = document.createElement('label');
			el_pagination_opt_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_pagination_opt_label.innerHTML = "Pagination Options";
		
	var el_pagination_steps = document.createElement('input');
			el_pagination_steps.setAttribute("id", "el_pagination_steps");
			el_pagination_steps.setAttribute("type", "radio");
			el_pagination_steps.setAttribute("name", "el_pagination");
			el_pagination_steps.setAttribute("value", "steps");
			el_pagination_steps.style.cssText =   "margin-left:20px;  padding:0; border-width: 1px";
            el_pagination_steps.setAttribute("onclick", "pagination_type('steps')");
		Steps = document.createTextNode("Steps");
			
	var el_pagination_percentage = document.createElement('input');
			el_pagination_percentage.setAttribute("id", "el_pagination_percentage");
			el_pagination_percentage.setAttribute("type", "radio");
			el_pagination_percentage.setAttribute("name", "el_pagination");
			el_pagination_percentage.setAttribute("value", "percentage");
			el_pagination_percentage.style.cssText =   "margin-left:20px;  padding:0; border-width: 1px";
            el_pagination_percentage.setAttribute("onclick", "pagination_type('percentage')");
		Percentage = document.createTextNode("Percentage");
		
	var el_pagination_none = document.createElement('input');
			el_pagination_none.setAttribute("id", "el_pagination_none");
			el_pagination_none.setAttribute("type", "radio");
			el_pagination_none.setAttribute("name", "el_pagination");
			el_pagination_none.setAttribute("value", "none");
			el_pagination_none.style.cssText =   "margin-left:20px;  padding:0; border-width: 1px";
            el_pagination_none.setAttribute("onclick", "pagination_type('none')");
		 No_Context = document.createTextNode(" No Context");
		
	if(w_type=='steps')
		el_pagination_steps.setAttribute("checked","checked");
	else
		if(w_type=='percentage')
			el_pagination_percentage.setAttribute("checked","checked");
		else
			el_pagination_none.setAttribute("checked","checked");
				
	var el_show_title_label = document.createElement('label');
			el_show_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_show_title_label.innerHTML = "Show Page Titles in Progress Bar";
		
	var el_show_title_input = document.createElement('input');
			el_show_title_input.setAttribute("id", "el_show_title_input");
			el_show_title_input.setAttribute("type", "checkbox");
			el_show_title_input.setAttribute("onClick", "show_title_pagebreak();");
			
	if(w_show_title)
		el_show_title_input.setAttribute("checked","checked");
		
	var el_show_numbers_label = document.createElement('label');
			el_show_numbers_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_show_numbers_label.innerHTML = "Show Page Numbers in Footer";
		
	var el_show_numbers_input = document.createElement('input');
			el_show_numbers_input.setAttribute("id", "el_show_numbers_input");
			el_show_numbers_input.setAttribute("type", "checkbox");
			el_show_numbers_input.setAttribute("onClick", "show_numbers_pagebreak();");
			
	if(w_show_numbers)
		el_show_numbers_input.setAttribute("checked","checked");
		
	var el_pagination_class_label = document.createElement('label');
	        el_pagination_class_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_pagination_class_label.innerHTML = "Pagination Class name";
	
	var el_pagination_class_input = document.createElement('input');
            el_pagination_class_input.setAttribute("id", "next_element_style");
			el_pagination_class_input.setAttribute("type", "text");
			el_pagination_class_input.setAttribute("value", "");
            el_pagination_class_input.style.cssText = "width:100px; margin-left:20px";
            el_pagination_class_input.setAttribute("onChange", "change_pagebreak_class(this.value, 'next')");		
		


	var el_page_titles_label = document.createElement('label');
	        el_page_titles_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_page_titles_label.innerHTML = "Pages Title";
			
	edit_main_td6.appendChild(el_page_titles_label);
	w_pages=[];	
	k=0;
	for(j=1; j<=form_view_max; j++)
	{
		if(document.getElementById('form_id_tempform_view'+j))
		{
			k++;
			var br_temp = document.createElement('br');
			var el_page_title_input= document.createElement('input');
			el_page_title_input.setAttribute("type", "text");
			el_page_title_input.style.cssText = "width:100px";
			if(document.getElementById('form_id_tempform_view'+j).getAttribute('page_title')==null)
				el_page_title_input.setAttribute("value", "Untitled Page");
			else
				el_page_title_input.setAttribute("value", document.getElementById('form_id_tempform_view'+j).getAttribute('page_title'));
			
			el_page_title_input.setAttribute("id", "page_title_"+j);
			el_page_title_input.setAttribute("onKeyUp", "set_page_title(this.value,'"+j+"')");
			if(document.getElementById('form_id_tempform_view'+j).getAttribute('page_title'))
				w_pages[j]=document.getElementById('form_id_tempform_view'+j).getAttribute('page_title');
			else
				w_pages[j]="Untitled Page"
				
			page_num=document.createTextNode(k+'. ');
			
			edit_main_td6.appendChild(br_temp);
			edit_main_td6.appendChild(page_num);
			edit_main_td6.appendChild(el_page_title_input);

		}
	
	}	




		
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr( 'type_checkbox')");

	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var hr = document.createElement('hr');
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	
	edit_main_td1.appendChild(el_pagination_opt_label);
	edit_main_td1.appendChild(br4);
	edit_main_td1.appendChild(el_pagination_steps);
	edit_main_td1.appendChild(Steps);
	edit_main_td1.appendChild(br6);
	edit_main_td1.appendChild(el_pagination_percentage);
	edit_main_td1.appendChild(Percentage);
	edit_main_td1.appendChild(br5);
	edit_main_td1.appendChild(el_pagination_none);
	edit_main_td1.appendChild(No_Context);
	edit_main_td1.setAttribute("colspan", "2");
	
	edit_main_td3.appendChild(el_show_title_label);
	edit_main_td3_1.appendChild(el_show_title_input);
	
	edit_main_td4.appendChild(el_show_numbers_label);
	edit_main_td4_1.appendChild(el_show_numbers_input);
/*	edit_main_td2.appendChild(el_attr_label);
	edit_main_td2.appendChild(el_attr_add);
	edit_main_td2.appendChild(br3);
	edit_main_td2.appendChild(el_attr_table);*/
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr2.appendChild(edit_main_td2);
	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr6.appendChild(edit_main_td6);

	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr6);
//	edit_main_table.appendChild(edit_main_tr2);

	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

    var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", "_elemet_tableform_id_temp");
		table.setAttribute("width", "90%");
	
    var tr = document.createElement('tr');
	
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", "_element_sectionform_id_temp");
			td2.setAttribute("width", "100%");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
	//	table_little -@ sarqaca tbody table_little darela table_little_t
			
		var pages_div = document.createElement('div');
				pages_div.setAttribute("align","left");
				pages_div.setAttribute("id","pages_div");
				pages_div.style.width='100%';
				pages_div.innerHTML="";
		
		
		var numbers_div = document.createElement('div');
				numbers_div.setAttribute("align","center");
				numbers_div.setAttribute("id","numbers_div");
				numbers_div.style.width='100%';
				numbers_div.style.paddingTop='100px';
				numbers_div.innerHTML="";
		
		
				
		td2.appendChild(pages_div);
		td2.appendChild(numbers_div);
      	var main_td  = document.getElementById('show_table');
	
      
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
		
	if(w_type=='steps')
		make_page_steps(w_pages);
	else
		if(w_type=='percentage')
			make_page_percentage(w_pages);
		else
			make_page_none(w_pages);
			
	if(w_show_numbers)
		show_numbers_pagebreak();
		


//refresh_attr(i, 'type_checkbox');
}

function set_page_title(title, id)
{
	document.getElementById("form_id_tempform_view"+id).setAttribute('page_title',title);
	show_title_pagebreak();
}

function show_numbers_pagebreak()
{
	document.getElementById("numbers_div").innerHTML="";
	if(document.getElementById("el_show_numbers_input").checked)
	{
		k=0;
		for(j=1; j<=form_view_max; j++)
		{
			if(document.getElementById('form_id_tempform_view'+j))
			{
				k++;		
				if(j==form_view)
					page_number=k;
			}
		}
		
		var cur = document.createElement('span');
			cur.setAttribute("class", "page_numbersform_id_temp");
			cur.innerHTML=page_number+'/'+k;
			
		document.getElementById("numbers_div").appendChild(cur);
	}
}

function refresh_page_numbers()
{
	k=0;
	if(document.getElementById('pages').getAttribute('show_numbers')=='true')
		for(j=1; j<=form_view_max; j++)
		{
			if(document.getElementById('page_numbersform_id_temp'+j))
			{
				k++;		
			}
		}
		
	cur_num=0;
	
		for(j=1; j<=form_view_max; j++)
		{
			if(document.getElementById('page_numbersform_id_temp'+j))
			{
				cur_num++;		
		
				document.getElementById("page_numbersform_id_temp"+j).innerHTML='';
				
				if(document.getElementById('pages').getAttribute('show_numbers')=='true')
				{
					var cur = document.createElement('span');
						cur.setAttribute("class", "page_numbersform_id_temp");
						cur.innerHTML=cur_num+'/'+k;
						
					document.getElementById("page_numbersform_id_temp"+j).appendChild(cur);
				}
			}
		}

}

function pagination_type(type)
{
	document.getElementById("pages_div").innerHTML="";
	w_pages=[];	
	k=0;
	for(j=1; j<=form_view_max; j++)
	{
		if(document.getElementById('form_id_tempform_view'+j))
		{
			k++;
			if(document.getElementById('form_id_tempform_view'+j).getAttribute('page_title'))
				w_pages[j]=document.getElementById('form_id_tempform_view'+j).getAttribute('page_title');
			else
				w_pages[j]="none";
		}
		
	}	


	if(type=='steps')
		make_page_steps(w_pages);
	else
		if(type=='percentage')
			make_page_percentage(w_pages);
		else
			make_page_none();
			

}

function show_title_pagebreak()
{
	document.getElementById("pages_div").innerHTML="";

if(document.getElementById("el_pagination_steps").checked)
	pagination_type('steps');
else
	if(document.getElementById("el_pagination_percentage").checked)
		pagination_type('percentage');
}
function make_page_steps(w_pages)
{
	document.getElementById("pages_div").innerHTML="";
	show_title=document.getElementById('el_show_title_input').checked;
	k=0;
	for(j=1; j<=form_view_max; j++)
	{	
		if(w_pages[j])
			{
			k++;
			if(w_pages[j]=="none")	
				w_pages[j]='';	
			page_number = document.createElement('span');
			
			if(j==form_view)
				page_number.setAttribute('class',"page_active");
			else
				page_number.setAttribute('class',"page_deactive");
			if(show_title)
			{
				page_number.innerHTML=w_pages[j];
			}
			else
				page_number.innerHTML=k;
			
			document.getElementById("pages_div").appendChild(page_number);
		}
	}
	
}

function make_page_percentage(w_pages)
{
	document.getElementById("pages_div").innerHTML="";
	show_title=document.getElementById('el_show_title_input').checked;
	
    var div_parent = document.createElement('div');
       	div_parent.setAttribute("class", "page_percentage_deactive");

    var div = document.createElement('div');
       	div.setAttribute("id", "div_percentage");
       	div.setAttribute("class", "page_percentage_active");
		
	var b = document.createElement('b');
       	b.style.margin='3px 7px 3px 3px';
		//b.style.vertical-align='middle';
	div.appendChild(b);
	
	k=0;
	cur_page_title='';
	for(j=1; j<=form_view_max; j++)
	{	
		if(w_pages[j])
			{
			k++;
				
			if(w_pages[j]=="none")	
				w_pages[j]='';	
			if(j==form_view)
			{
				if(show_title)
				{ 
					var cur_page_title = document.createElement('span');
					if(k==1)
						cur_page_title.style.paddingLeft="30px";
					else
						cur_page_title.style.paddingLeft="5px";
						cur_page_title.innerHTML=w_pages[j];
				}
				page_number=k;

			}
		}
	}
	b.innerHTML=Math.round(((page_number-1)/k)*100)+'%';
	div.style.width=((page_number-1)/k)*100+'%';
	div_parent.appendChild(div);
	if(cur_page_title)
		div_parent.appendChild(cur_page_title);
	document.getElementById("pages_div").appendChild(div_parent);

	
}
function make_page_none()
{
	document.getElementById("pages_div").innerHTML="";
}


function type_page_break(i,w_page_title, w_title , w_type , w_class, w_check, w_attr_name, w_attr_value){
	
	
	
	var pos=document.getElementsByName("el_pos");
		pos[0].setAttribute("disabled", "disabled");
		pos[1].setAttribute("disabled", "disabled");
		pos[2].setAttribute("disabled", "disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.setAttribute("disabled", "disabled");

	
	document.getElementById("element_type").value="type_page_break";
	delete_last_child();
// edit table	
	var edit_div  = document.createElement('div');
		edit_div.setAttribute("id", "edit_div");
		edit_div.setAttribute("style", "border:0px;padding:10px;  padding-top:0px; padding-bottom:0px; margin-top:10px;");
		
	var edit_main_table  = document.createElement('table');
		edit_main_table.setAttribute("id", "edit_main_table");
		edit_main_table.setAttribute("cellpadding", "0");
		edit_main_table.setAttribute("cellspacing", "0");
		
	var edit_main_tr1  = document.createElement('tr');
      		edit_main_tr1.setAttribute("valing", "top");
		
	var edit_main_tr2  = document.createElement('tr');
      		edit_main_tr2.setAttribute("valing", "top");
		
	var edit_main_tr3  = document.createElement('tr');
      		edit_main_tr3.setAttribute("valing", "top");
		
	var edit_main_tr4  = document.createElement('tr');
      		edit_main_tr4.setAttribute("valing", "top");
		
	var edit_main_tr5  = document.createElement('tr');
      		edit_main_tr5.setAttribute("valing", "top");
			
	var edit_main_tr6  = document.createElement('tr');
      		edit_main_tr6.setAttribute("valing", "top");

	var edit_main_td1 = document.createElement('td');
		edit_main_td1.style.cssText = "padding-top:10px";	
	var edit_main_td1_1 = document.createElement('td');
		edit_main_td1_1.style.cssText = "padding-top:10px";		
	var edit_main_td2 = document.createElement('td');
		edit_main_td2.style.cssText = "padding-top:10px";
	var edit_main_td2_1 = document.createElement('td');
		edit_main_td2_1.style.cssText = "padding-top:10px";

	var edit_main_td3 = document.createElement('td');
		edit_main_td3.style.cssText = "padding-top:10px";
	var edit_main_td3_1 = document.createElement('td');
		edit_main_td3_1.style.cssText = "padding-top:10px";

	var edit_main_td4 = document.createElement('td');
		edit_main_td4.style.cssText = "padding-top:10px";
	var edit_main_td4_1 = document.createElement('td');
		edit_main_td4_1.style.cssText = "padding-top:10px";
	var edit_main_td5 = document.createElement('td');
		edit_main_td5.style.cssText = "padding-top:10px";
	var edit_main_td5_1 = document.createElement('td');
		edit_main_td5_1.style.cssText = "padding-top:10px";
				
	var edit_main_td6 = document.createElement('td');
		edit_main_td6.style.cssText = "padding-top:10px";
	var edit_main_td6_1 = document.createElement('td');
		edit_main_td6_1.style.cssText = "padding-top:10px";
		  
		  
	var el_page_title_label = document.createElement('label');
			el_page_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_page_title_label.innerHTML = "Page Title";
		
	var el_page_title_input = document.createElement('input');
			el_page_title_input.setAttribute("id", "el_page_title_input");
			el_page_title_input.setAttribute("type", "text");
			el_page_title_input.setAttribute("name", "el_page_title_input");
			el_page_title_input.setAttribute("value", w_page_title);
			el_page_title_input.style.cssText =   "padding:0; border-width: 1px";
            el_page_title_input.setAttribute("onKeyup", "pagebreak_title_change(this.value,'"+i+"')");
		  
		  
		  
		  
		  
		  
		  
	var el_type_next_label = document.createElement('label');
			el_type_next_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_type_next_label.innerHTML = "Next Type";
		
	var el_type_next_button = document.createElement('input');
			el_type_next_button.setAttribute("id", "el_type_next_button");
			el_type_next_button.setAttribute("type", "radio");
			el_type_next_button.setAttribute("name", "el_type_next");
			el_type_next_button.setAttribute("value", "button");
			el_type_next_button.style.cssText =   "padding:0; border-width: 1px";
            el_type_next_button.setAttribute("onclick", "pagebreak_type_change('next','button')");
		Button_next = document.createTextNode("Button");
			
	var el_type_next_text = document.createElement('input');
			el_type_next_text.setAttribute("id", "el_type_next_text");
			el_type_next_text.setAttribute("type", "radio");
			el_type_next_text.setAttribute("name", "el_type_next");
			el_type_next_text.setAttribute("value", "text");
			el_type_next_text.style.cssText =   " padding:0; border-width: 1px";
            el_type_next_text.setAttribute("onclick", "pagebreak_type_change('next','text')");
		Text_next = document.createTextNode("Text");
		
	var el_type_next_img = document.createElement('input');
			el_type_next_img.setAttribute("id", "el_type_next_img");
			el_type_next_img.setAttribute("type", "radio");
			el_type_next_img.setAttribute("name", "el_type_next");
			el_type_next_img.setAttribute("value", "img");
			el_type_next_img.style.cssText =   "padding:0; border-width: 1px";
            el_type_next_img.setAttribute("onclick", "pagebreak_type_change('next','img')");
		Image_next = document.createTextNode("Image");
		
	if(w_type[0]=='button')
		el_type_next_button.setAttribute("checked","checked");
	else
		if(w_type[0]=='text')
			el_type_next_text.setAttribute("checked","checked");
		else
			el_type_next_img.setAttribute("checked","checked");
				
	var el_title_next_label = document.createElement('label');
			el_title_next_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_title_next_label.setAttribute("id", "next_label");
			el_title_next_label.innerHTML = "Next name";
		
	var el_title_next = document.createElement('input');
			el_title_next.setAttribute("id", "el_title_next");
			el_title_next.setAttribute("type", "text");
			el_title_next.setAttribute("value", w_title[0]);
			el_title_next.style.cssText =   "width:150px;   padding:0; border-width: 1px";
			el_title_next.setAttribute("onKeyUp", "change_pagebreak_label( this.value, 'next');");
			el_title_next.setAttribute("onChange", "change_pagebreak_label( this.value, 'next');");
			
	var el_style_next_label = document.createElement('label');
	        el_style_next_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_next_label.innerHTML = "Next Class name";
	
	var el_style_next_textarea = document.createElement('input');
            el_style_next_textarea.setAttribute("id", "next_element_style");
			el_style_next_textarea.setAttribute("type", "text");
			el_style_next_textarea.setAttribute("value", w_class[0]);
            el_style_next_textarea.style.cssText = "width:100px; ";
            el_style_next_textarea.setAttribute("onChange", "change_pagebreak_class(this.value, 'next')");

	var el_check_next_label = document.createElement('label');
			el_check_next_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_check_next_label.innerHTML = "Check the required fields";
		
	var el_check_next_input = document.createElement('input');
			el_check_next_input.setAttribute("id", "el_check_next_input");
			el_check_next_input.setAttribute("type", "checkbox");
			el_check_next_input.setAttribute("onClick", "set_checkable('next');");
			
	if(w_check[0]=="true")
		el_check_next_input.setAttribute("checked","checked");
		

			
			
			
			
			
				
	var el_type_previous_label = document.createElement('label');
			el_type_previous_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_type_previous_label.innerHTML = "Previous Type";
		
	var el_type_previous_button = document.createElement('input');
			el_type_previous_button.setAttribute("id", "el_type_previous_button");
			el_type_previous_button.setAttribute("type", "radio");
			el_type_previous_button.setAttribute("name", "el_type_previous");
			el_type_previous_button.setAttribute("value", "button");
			el_type_previous_button.style.cssText =   " padding:0; border-width: 1px";
            el_type_previous_button.setAttribute("onclick", "pagebreak_type_change('previous','button')");
		Button_previous = document.createTextNode("Button");
			
	var el_type_previous_text = document.createElement('input');
			el_type_previous_text.setAttribute("id", "el_type_previous_text");
			el_type_previous_text.setAttribute("type", "radio");
			el_type_previous_text.setAttribute("name", "el_type_previous");
			el_type_previous_text.setAttribute("value", "text");
			el_type_previous_text.style.cssText =   " padding:0; border-width: 1px";
            el_type_previous_text.setAttribute("onclick", "pagebreak_type_change('previous','text')");
		Text_previous = document.createTextNode("Text");
		
	var el_type_previous_img = document.createElement('input');
			el_type_previous_img.setAttribute("id", "el_type_previous_img");
			el_type_previous_img.setAttribute("type", "radio");
			el_type_previous_img.setAttribute("name", "el_type_previous");
			el_type_previous_img.setAttribute("value", "img");
			el_type_previous_img.style.cssText =   "  padding:0; border-width: 1px";
            el_type_previous_img.setAttribute("onclick", "pagebreak_type_change('previous','img')");
		Image_previous = document.createTextNode("Image");
		
	if(w_type[1]=='button')
		el_type_previous_button.setAttribute("checked","checked");
	else
		if(w_type[1]=='text')
			el_type_previous_text.setAttribute("checked","checked");
		else
			el_type_previous_img.setAttribute("checked","checked");
				
	var el_title_previous_label = document.createElement('label');
			el_title_previous_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_title_previous_label.setAttribute("id", "previous_label");
			el_title_previous_label.innerHTML = "Previous name";
		
	var el_title_previous = document.createElement('input');
			el_title_previous.setAttribute("id", "el_title_previous");
			el_title_previous.setAttribute("type", "text");
			el_title_previous.setAttribute("value", w_title[1]);
			el_title_previous.style.cssText =   "width:150px; padding:0; border-width: 1px";
			el_title_previous.setAttribute("onKeyUp", "change_pagebreak_label( this.value, 'previous');");
			el_title_previous.setAttribute("onChange", "change_pagebreak_label( this.value, 'previous');");
			
	var el_style_previous_label = document.createElement('label');
	        el_style_previous_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_style_previous_label.innerHTML = "Previous Class name";
	
	var el_style_previous_textarea = document.createElement('input');
            el_style_previous_textarea.setAttribute("id", "previous_element_style");
			el_style_previous_textarea.setAttribute("type", "text");
			el_style_previous_textarea.setAttribute("value", w_class[1]);
            el_style_previous_textarea.style.cssText = "width:100px;";
            el_style_previous_textarea.setAttribute("onChange", "change_pagebreak_class(this.value, 'previous')");

	var el_check_previous_label = document.createElement('label');
			el_check_previous_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_check_previous_label.innerHTML = "Check the required fields";
		
	var el_check_previous_input = document.createElement('input');
			el_check_previous_input.setAttribute("id", "el_check_previous_input");
			el_check_previous_input.setAttribute("type", "checkbox");
			el_check_previous_input.setAttribute("onClick", "set_checkable('previous');");
			
	if(w_check[1]=="true")
		el_check_previous_input.setAttribute("checked","checked");
		

			
			
			
			
			
			
			

			
	var el_attr_label = document.createElement('label');
	                el_attr_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
			el_attr_label.innerHTML = "Additional Attributes";
	var el_attr_add = document.createElement('img');
                el_attr_add.setAttribute("id", "el_choices_add");
           	el_attr_add.setAttribute("src", plugin_url+'/images/add.png');
            	el_attr_add.style.cssText = 'cursor:pointer; margin-left:68px';
            	el_attr_add.setAttribute("title", 'add');
                el_attr_add.setAttribute("onClick", "add_attr( 'type_checkbox')");

	var el_attr_table = document.createElement('table');
                el_attr_table.setAttribute("id", 'attributes');
                el_attr_table.setAttribute("border", '0');
        	el_attr_table.style.cssText = 'margin-left:0px';
	var el_attr_tr_label = document.createElement('tr');
                el_attr_tr_label.setAttribute("idi", '0');
	var el_attr_td_name_label = document.createElement('th');
            	el_attr_td_name_label.style.cssText = 'width:100px';
	var el_attr_td_value_label = document.createElement('th');
            	el_attr_td_value_label.style.cssText = 'width:100px';
	var el_attr_td_X_label = document.createElement('th');
            	el_attr_td_X_label.style.cssText = 'width:10px';
	var el_attr_name_label = document.createElement('label');
	                el_attr_name_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_name_label.innerHTML = "Name";
			
	var el_attr_value_label = document.createElement('label');
	                el_attr_value_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 11px";
			el_attr_value_label.innerHTML = "Value";
			
	el_attr_table.appendChild(el_attr_tr_label);
	el_attr_tr_label.appendChild(el_attr_td_name_label);
	el_attr_tr_label.appendChild(el_attr_td_value_label);
	el_attr_tr_label.appendChild(el_attr_td_X_label);
	el_attr_td_name_label.appendChild(el_attr_name_label);
	el_attr_td_value_label.appendChild(el_attr_value_label);
	
	n=w_attr_name.length;
	for(j=1; j<=n; j++)
	{	
		var el_attr_tr = document.createElement('tr');
			el_attr_tr.setAttribute("id", "attr_row_"+j);
			el_attr_tr.setAttribute("idi", j);
		var el_attr_td_name = document.createElement('td');
			el_attr_td_name.style.cssText = 'width:100px';
		var el_attr_td_value = document.createElement('td');
			el_attr_td_value.style.cssText = 'width:100px';
		
		var el_attr_td_X = document.createElement('td');
		var el_attr_name = document.createElement('input');
	
			el_attr_name.setAttribute("type", "text");
	
			el_attr_name.style.cssText = "width:100px";
			el_attr_name.setAttribute("value", w_attr_name[j-1]);
			el_attr_name.setAttribute("id", "attr_name"+j);
			el_attr_name.setAttribute("onChange", "change_attribute_name("+i+", this, 'type_checkbox')");
			
		var el_attr_value = document.createElement('input');
	
			el_attr_value.setAttribute("type", "text");
	
			el_attr_value.style.cssText = "width:100px";
			el_attr_value.setAttribute("value", w_attr_value[j-1]);
			el_attr_value.setAttribute("id", "attr_value"+j);
			el_attr_value.setAttribute("onChange", "change_attribute_value("+i+", "+j+", 'type_checkbox')");
	
		var el_attr_remove = document.createElement('img');
			el_attr_remove.setAttribute("id", "el_choices"+j+"_remove");
			el_attr_remove.setAttribute("src", plugin_url+'/images/delete.png');
			el_attr_remove.style.cssText = 'cursor:pointer; vertical-align:middle; margin:3px';
			el_attr_remove.setAttribute("align", 'top');
			el_attr_remove.setAttribute("onClick", "remove_attr("+j+", "+i+", 'type_checkbox')");
		el_attr_table.appendChild(el_attr_tr);
		el_attr_tr.appendChild(el_attr_td_name);
		el_attr_tr.appendChild(el_attr_td_value);
		el_attr_tr.appendChild(el_attr_td_X);
		el_attr_td_name.appendChild(el_attr_name);
		el_attr_td_value.appendChild(el_attr_value);
		el_attr_td_X.appendChild(el_attr_remove);
		
	}

	var t  = document.getElementById('edit_table');
	
	var hr = document.createElement('hr');
	var br = document.createElement('br');
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	var br7 = document.createElement('br');
	var br8= document.createElement('br');
	var br9= document.createElement('br');
	var br10= document.createElement('br');
	var br11= document.createElement('br');
	var br12= document.createElement('br');
	var br13= document.createElement('br');
	var br14= document.createElement('br');
	var br20= document.createElement('br');
	var br21= document.createElement('br');
	var br22= document.createElement('br');
	var br233= document.createElement('br');
	
	edit_main_td1.appendChild(el_page_title_label);
	edit_main_td1_1.appendChild(el_page_title_input);
	
	edit_main_td3.appendChild(el_type_next_label);
	edit_main_td3.appendChild(br10);
	edit_main_td3.appendChild(el_title_next_label);
	edit_main_td3.appendChild(br11);
	edit_main_td3.appendChild(el_style_next_label);
	edit_main_td3.appendChild(br12);
	edit_main_td3.appendChild(el_check_next_label);
	edit_main_td3_1.appendChild(el_type_next_button);
	edit_main_td3_1.appendChild(Button_next);
	edit_main_td3_1.appendChild(el_type_next_text);
	edit_main_td3_1.appendChild(Text_next);
	edit_main_td3_1.appendChild(el_type_next_img);
	edit_main_td3_1.appendChild(Image_next);
	edit_main_td3_1.appendChild(br);
	edit_main_td3_1.appendChild(el_title_next);
	edit_main_td3_1.appendChild(br4);
	edit_main_td3_1.appendChild(el_style_next_textarea);
	edit_main_td3_1.appendChild(br7);
	edit_main_td3_1.appendChild(el_check_next_input);
	
	//edit_main_td5.appendChild(hr);
	
	edit_main_td4.appendChild(el_type_previous_label);
	edit_main_td4.appendChild(br20);
	edit_main_td4.appendChild(el_title_previous_label);
	edit_main_td4.appendChild(br21);
	edit_main_td4.appendChild(el_style_previous_label);
	edit_main_td4.appendChild(br22);
	edit_main_td4.appendChild(el_check_previous_label);
	
	edit_main_td4_1.appendChild(el_type_previous_button);
	edit_main_td4_1.appendChild(Button_previous);
	edit_main_td4_1.appendChild(el_type_previous_text);
	edit_main_td4_1.appendChild(Text_previous);
	edit_main_td4_1.appendChild(el_type_previous_img);
	edit_main_td4_1.appendChild(Image_previous);
	edit_main_td4_1.appendChild(br233);
	edit_main_td4_1.appendChild(el_title_previous);
	edit_main_td4_1.appendChild(br5);
	edit_main_td4_1.appendChild(el_style_previous_textarea);
	edit_main_td4_1.appendChild(br8);
	edit_main_td4_1.appendChild(el_check_previous_input);
	
	
	
	edit_main_td2.appendChild(el_attr_label);
	edit_main_td2.appendChild(el_attr_add);
	edit_main_td2.appendChild(br3);
	edit_main_td2.appendChild(el_attr_table);
	edit_main_td2.setAttribute("colspan", "2");
	
	edit_main_tr1.appendChild(edit_main_td1);
	edit_main_tr1.appendChild(edit_main_td1_1);
	edit_main_tr2.appendChild(edit_main_td2);
//	edit_main_tr2.appendChild(edit_main_td2_1);
	edit_main_tr3.appendChild(edit_main_td3);
	edit_main_tr3.appendChild(edit_main_td3_1);
	edit_main_tr4.appendChild(edit_main_td4);
	edit_main_tr4.appendChild(edit_main_td4_1);
	edit_main_tr6.appendChild(edit_main_td6);
//	edit_main_tr6.appendChild(edit_main_td6_1);
	edit_main_tr5.appendChild(edit_main_td5);
//	edit_main_tr5.appendChild(edit_main_td5_1);

	edit_main_table.appendChild(edit_main_tr1);
	edit_main_table.appendChild(edit_main_tr3);
	edit_main_table.appendChild(edit_main_tr4);
	edit_main_table.appendChild(edit_main_tr2);

	edit_div.appendChild(edit_main_table);
	
	t.appendChild(edit_div);
	
//show table

	element='button';	type='button'; 
    var div = document.createElement('div');
       	div.setAttribute("id", "main_div");
//tbody sarqac
		
		
	var table = document.createElement('table');
		table.setAttribute("id", "_elemet_tableform_id_temp");
	
    var tr = document.createElement('tr');
	
      	var td2 = document.createElement('td');
        	td2.setAttribute("valign", 'top');
         	td2.setAttribute("align", 'left');
           	td2.setAttribute("id", "_element_sectionform_id_temp");

      	var br1 = document.createElement('br');
      	var br2 = document.createElement('br');
     	var br3 = document.createElement('br');
      	var br4 = document.createElement('br');
	//	table_little -@ sarqaca tbody table_little darela table_little_t
			
		var adding_next = document.createElement('div');
				adding_next.setAttribute("align","right");
				adding_next.setAttribute("id","_element_section_next");
	    
		var adding_next_button =  make_pagebreak_button('next',w_title[0],w_type[0], w_class[0] , 0)	;
			
		adding_next.appendChild(adding_next_button);
		
		var adding_previous = document.createElement('div');
				adding_previous.setAttribute("align","left");
				adding_previous.setAttribute("id","_element_section_previous");
	    
		var adding_previous_button =  make_pagebreak_button('previous',w_title[1],w_type[1], w_class[1] , 0)	;
				
		adding_previous.appendChild(adding_previous_button);
		
		var div_fields = document.createElement('div');
				div_fields.setAttribute("align","center");
				div_fields.setAttribute("style","border:2px solid blue;padding:20px; margin:20px");
				div_fields.innerHTML='FIELDS';
		
		
		var div_page_title = document.createElement('div');
				div_page_title.innerHTML=w_page_title+'<br/><br/>';
				div_page_title.setAttribute("id", "div_page_title");
				div_page_title.setAttribute("align","center");
		
		var div_between = document.createElement('div');
				div_between.setAttribute("page_title", w_page_title);
				div_between.setAttribute("next_type", w_type[0]);
				div_between.setAttribute("next_title", w_title[0]);
				div_between.setAttribute("next_class", w_class[0]);
				div_between.setAttribute("next_checkable", w_check[0]);
				div_between.setAttribute("previous_type", w_type[1]);
				div_between.setAttribute("previous_title", w_title[1]);
				div_between.setAttribute("previous_class", w_class[1]);
				div_between.setAttribute("previous_checkable", w_check[1]);
				div_between.setAttribute("align","center");
				div_between.setAttribute("id", "_div_between");
				div_between.innerHTML="--------------------------------------<br />P A G E B R E A K<br />--------------------------------------"
				
		td2.appendChild(div_page_title);
		td2.appendChild(div_fields);
		td2.appendChild(adding_next);
		td2.appendChild(div_between);
		td2.appendChild(adding_previous);
      	var main_td  = document.getElementById('show_table');
	
      
      	tr.appendChild(td2);
      	table.appendChild(tr);
      

      	div.appendChild(table);
      	div.appendChild(br1);
      	main_td.appendChild(div);
refresh_attr(i, 'type_page_break');
}

function set_checkable(type)
{
	document.getElementById("_div_between").setAttribute(type+'_checkable',document.getElementById("el_check_"+type+"_input").checked);
}

function pagebreak_title_change(val)
{
	document.getElementById("_div_between").setAttribute('page_title',val);
	document.getElementById("div_page_title").innerHTML=val+'<br/><br/>';
}

function change_pagebreak_class(val, type)
{
	document.getElementById("page_"+type+'_0').setAttribute('class', val);
	document.getElementById("_div_between").setAttribute(type+'_class',val);
}

function change_pagebreak_label(val, type)
{
button_type=document.getElementById("_div_between").getAttribute(type+'_type');
if(button_type!="img")
{
	document.getElementById("page_"+type+'_0').value=val;
	document.getElementById("page_"+type+'_0').innerHTML=val;
}
else
{
	document.getElementById("page_"+type+'_0').src=val;
}
	document.getElementById("_div_between").setAttribute(type+'_title',val);

}

function pagebreak_type_change( pagebreak_type, button_type)
{
document.getElementById("_div_between").setAttribute(pagebreak_type+'_type',button_type);
	switch(button_type)
	{
		case 'button': 
		{ 
			document.getElementById("_div_between").setAttribute(pagebreak_type+'_title', pagebreak_type);
			
			var el_title_label = document.createElement('label');
				el_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_title_label.setAttribute('id', pagebreak_type+"_label");
				el_title_label.setAttribute('type', "button");
				el_title_label.innerHTML = pagebreak_type+" "+ button_type+" name";
			
			document.getElementById(pagebreak_type+"_label").parentNode.replaceChild(el_title_label, document.getElementById(pagebreak_type+"_label"));
			
			document.getElementById("el_title_"+pagebreak_type).value=pagebreak_type;
			
			var element = document.createElement('button');
				element.setAttribute('id', "page_"+pagebreak_type+'_0');
				element.setAttribute('class', document.getElementById("_div_between").getAttribute(pagebreak_type+'_class'));
				element.style.cursor="pointer";
				element.innerHTML=pagebreak_type;
				
			
			document.getElementById("_element_section_"+pagebreak_type).replaceChild(element, document.getElementById("page_"+pagebreak_type+'_0'));
			
			break;
		}
		case 'text': {	

			document.getElementById("_div_between").setAttribute(pagebreak_type+'_title', pagebreak_type);
		
			var el_title_label = document.createElement('label');
				el_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_title_label.setAttribute('id', pagebreak_type+"_label");
				el_title_label.innerHTML = pagebreak_type+" "+ button_type+" name";

			document.getElementById(pagebreak_type+"_label").parentNode.replaceChild(el_title_label, document.getElementById(pagebreak_type+"_label"));
			
			document.getElementById("el_title_"+pagebreak_type).value=pagebreak_type;
			
			var element = document.createElement('span');
				element.setAttribute('id', "page_"+pagebreak_type+'_0');
				element.setAttribute('class', document.getElementById("_div_between").getAttribute(pagebreak_type+'_class'));
				element.style.cursor="pointer";
				element.innerHTML=pagebreak_type;

			document.getElementById("_element_section_"+pagebreak_type).replaceChild(element, document.getElementById("page_"+pagebreak_type+'_0'));
			
			  break;
		}
		case 'img':{ 			
		
		document.getElementById("_div_between").setAttribute(pagebreak_type+'_title', plugin_url+'/images/'+pagebreak_type+'.png');
			
		var el_title_label = document.createElement('label');
				el_title_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
				el_title_label.setAttribute('id', pagebreak_type+"_label");
				el_title_label.innerHTML = pagebreak_type+" "+ button_type+" src";

			document.getElementById(pagebreak_type+"_label").parentNode.replaceChild(el_title_label, document.getElementById(pagebreak_type+"_label"));
			
			document.getElementById("el_title_"+pagebreak_type).value=plugin_url+'/images/'+pagebreak_type+'.png';
			
			var element = document.createElement('img');
				element.setAttribute('id', "page_"+pagebreak_type+'_0');
				element.setAttribute('class', document.getElementById("_div_between").getAttribute(pagebreak_type+'_class'));
				element.style.cursor="pointer";
				element.src=plugin_url+'/images/'+pagebreak_type+'.png';
				
			document.getElementById("_element_section_"+pagebreak_type).replaceChild(element, document.getElementById("page_"+pagebreak_type+'_0'));
			
			  break;
		}

}
}

function addRow(b) {
	if (document.getElementById('show_table').innerHTML) {
    document.getElementById('show_table').innerHTML = "";
    document.getElementById('edit_table').innerHTML = "";
  }
	alltypes = Array('customHTML','text','checkbox','radio','time_and_date','select','file_upload','captcha','map','button','page_break','section_break', 'survey');
  for (x = 0; x < 13; x++) {
    if (alltypes[x] != 'file_upload' && alltypes[x] != 'map')
      document.getElementById('img_'+alltypes[x]).parentNode.style.backgroundColor = '';
  }
  document.getElementById('img_' + b).parentNode.style.backgroundColor = '#FE6400';
	switch(b) {
		case 'customHTML': { el_editor();  break;}
		case 'text': { el_text();  break;}
		case 'checkbox':{ el_checkbox(); break;}
		case 'radio':{ el_radio(); break;}
		case 'time_and_date':{ el_time_and_date(); break; }
		case 'select':{ el_select(); break; }
		case 'file_upload':{ el_file_upload(); break; }
		case 'captcha':{ el_captcha(); break; }
		case 'map':{ alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.'); break; }
		case 'button':{ el_button(); break; }
		case 'page_break':{ el_page_break(); break; }
		case 'section_break':{ el_section_break(); break; }
    case 'survey':{ el_survey(); break; }
  }
  var pos = document.getElementsByName("el_pos");
  pos[0].checked = "checked";
}

function el_survey()
{

	
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	

//edit table
	var td  = document.getElementById('edit_table');
	//type select		
	var el_type_label = document.createElement('label');
	
	el_type_label.style.cssText = "color: #00aeef; font-weight: bold; font-size: 13px";
	//el_type_label.setAttribute("style" , "color: #00aeef; font-weight: bold; font-size: 13px", 0 );
	el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	td.appendChild(el_type_label);

	var el_type_star_rating = document.createElement('input');
                el_type_star_rating.setAttribute("id", "el_type_star_rating");
                el_type_star_rating.setAttribute("type", "radio");
				el_type_star_rating.style.cssText = "margin-left:15px";
                el_type_star_rating.setAttribute("value", "star_rating");
                el_type_star_rating.setAttribute("name", "el_type");
                el_type_star_rating.setAttribute("onclick", "go_to_type_star_rating('"+new_id+"')");
		el_type_star_rating.setAttribute("checked", "checked");
		Star_Rating = document.createTextNode("Star Rating");
		
	var el_type_scale_rating = document.createElement('input');
                el_type_scale_rating.setAttribute("id", "el_type_scale_rating");
                el_type_scale_rating.setAttribute("type", "radio");
				el_type_scale_rating.style.cssText = "margin-left:15px";
                el_type_scale_rating.setAttribute("value", "scale_rating");
                el_type_scale_rating.setAttribute("name", "el_type");
                el_type_scale_rating.setAttribute("onclick", "go_to_type_scale_rating('"+new_id+"')");
		Scale_Rating = document.createTextNode("Scale Rating");	
		
	var el_type_spinner = document.createElement('input');
                el_type_spinner.setAttribute("id", "el_type_spinner");
                el_type_spinner.setAttribute("type", "radio");
				el_type_spinner.style.cssText = "margin-left:15px";
                el_type_spinner.setAttribute("value", "spinner");
                el_type_spinner.setAttribute("name", "el_type");
                el_type_spinner.setAttribute("onclick", "go_to_type_spinner('"+new_id+"')");
		Spinner = document.createTextNode("Spinner");
    
	var el_type_slider = document.createElement('input');
                el_type_slider.setAttribute("id", "el_type_slider");
                el_type_slider.setAttribute("type", "radio");
				el_type_slider.style.cssText = "margin-left:15px";
                el_type_slider.setAttribute("value", "slider");
                el_type_slider.setAttribute("name", "el_type");
                el_type_slider.setAttribute("onclick", "go_to_type_slider('"+new_id+"')");
		Slider = document.createTextNode("Slider");
	
    var el_type_range = document.createElement('input');
                el_type_range.setAttribute("id", "el_type_range");
                el_type_range.setAttribute("type", "radio");
				el_type_range.style.cssText = "margin-left:15px";
                el_type_range.setAttribute("value", "range");
                el_type_range.setAttribute("name", "el_type");
                el_type_range.setAttribute("onclick", "go_to_type_range('"+new_id+"')");
		Range = document.createTextNode("Range");		
		
	 var el_type_grading = document.createElement('input');
                el_type_grading.setAttribute("id", "el_type_grading");
                el_type_grading.setAttribute("type", "radio");
				el_type_grading.style.cssText = "margin-left:15px";
                el_type_grading.setAttribute("value", "grading");
                el_type_grading.setAttribute("name", "el_type");
                el_type_grading.setAttribute("onclick", "go_to_type_grading('"+new_id+"')");
		Grading = document.createTextNode("Grading");			
	
	var el_type_matrix = document.createElement('input');
                el_type_matrix.setAttribute("id", "el_type_matrix");
                el_type_matrix.setAttribute("type", "radio");
				el_type_matrix.style.cssText = "margin-left:15px";
                el_type_matrix.setAttribute("value", "matrix");
                el_type_matrix.setAttribute("name", "el_type");
                el_type_matrix.setAttribute("onclick", "go_to_type_matrix('"+new_id+"')");
		Matrix = document.createTextNode("Matrix");
	
	
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	var br7 = document.createElement('br');



	td.appendChild(br1);
	td.appendChild(el_type_star_rating);
	td.appendChild(Star_Rating);
	td.appendChild(br2);
	td.appendChild(el_type_scale_rating);
	td.appendChild(Scale_Rating);
	td.appendChild(br3);
	td.appendChild(el_type_spinner);
	td.appendChild(Spinner);
	td.appendChild(br4);
	td.appendChild(el_type_slider);
	td.appendChild(Slider);
	td.appendChild(br5);
	td.appendChild(el_type_range);
	td.appendChild(Range);
	td.appendChild(br6);
	td.appendChild(el_type_grading);
	td.appendChild(Grading);
	td.appendChild(br7);
	td.appendChild(el_type_matrix);
	td.appendChild(Matrix);
	
	
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
			
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");
			
	go_to_type_star_rating(new_id);
		
	type_star_rating(new_id,'Star Rating:', 'left', 'yellow', '5', 'no', 'wdform_star_rating',w_attr_name, w_attr_value);			
}

function go_to_type_star_rating(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_star_rating(new_id,'Star Rating:', 'left', 'yellow', '5', 'no', 'wdform_star_rating', w_attr_name, w_attr_value);			
}


function go_to_type_scale_rating(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	w_mini_labels=['Worst', 'Best'];
	type_scale_rating(new_id,'Scale Rating:', 'left', w_mini_labels, '5', 'no','wdform_scale_rating',w_attr_name, w_attr_value);			
}

function go_to_type_spinner(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
type_spinner(new_id,'Spinner:', 'left', '50', '', '', '1', '', 'no','',w_attr_name, w_attr_value);			

}

function go_to_type_slider(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
type_slider(new_id,'Slider:', 'left', '200', '0', '100', '0', 'no','',w_attr_name, w_attr_value);				
}

function go_to_type_range(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
  w_mini_labels = ['From', 'To'];
  type_range (new_id,'Range:', 'left', '30', '1' , '', '', w_mini_labels, 'no','',w_attr_name, w_attr_value);			

}

function go_to_type_grading(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	w_items = ['item1','item2','item3'];

type_grading(new_id,'Grading:', 'left', w_items, '100', 'no','wdform_grading',w_attr_name, w_attr_value);			

}

function go_to_type_matrix(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	
	w_rows = ['','row1','row2'];
	w_columns = ['','column1','column2'];
  type_matrix(new_id,'Matrix:', 'left', 'radio', w_rows, w_columns, 'no','wdform_matrix',w_attr_name, w_attr_value);				
}

function el_section_break() {
  if (document.getElementById("editing_id").value) {
		new_id = document.getElementById("editing_id").value;
  }
	else {
		new_id = gen;
  }
	var pos = document.getElementsByName("el_pos");
	pos[0].removeAttribute("disabled");
	pos[1].removeAttribute("disabled");
	pos[2].removeAttribute("disabled");
	var sel_el_pos = document.getElementById("sel_el_pos");
	sel_el_pos.removeAttribute("disabled", "disabled");
	type_section_break(new_id,'<hr/>');
}

function el_button() {
  if (document.getElementById("editing_id").value) {
    new_id=document.getElementById("editing_id").value;
  }
  else {
    new_id = gen;
  }
	


//edit table
	var td  = document.getElementById('edit_table');
	//type select		
	var el_type_label = document.createElement('label');
	
	el_type_label.style.cssText = "color: #00aeef; font-weight: bold; font-size: 13px";
	el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	td.appendChild(el_type_label);
	var el_type_radio_submit_reset = document.createElement('input');
                el_type_radio_submit_reset.setAttribute("type", "radio");
		el_type_radio_submit_reset.style.cssText = "margin-left:15px";
                el_type_radio_submit_reset.setAttribute("name", "el_type");
                el_type_radio_submit_reset.setAttribute("onclick", "go_to_type_submit_reset('"+new_id+"')");
		el_type_radio_submit_reset.setAttribute("checked", "checked");
		Submit_and_Reset = document.createTextNode("Submit and Reset");
		
	var el_type_radio_custom = document.createElement('input');
                el_type_radio_custom.setAttribute("type", "radio");
		el_type_radio_custom.style.cssText = "margin-left:15px";
               
	       el_type_radio_custom.setAttribute("name", "el_type");
                el_type_radio_custom.setAttribute("onclick", "go_to_type_button('"+new_id+"')");
		Custom = document.createTextNode("Custom");
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	

	td.appendChild(br1);
	td.appendChild(el_type_radio_submit_reset);
	td.appendChild(Submit_and_Reset);
	td.appendChild(br2);
	td.appendChild(el_type_radio_custom);
	td.appendChild(Custom);

	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");


	go_to_type_submit_reset(new_id);
	
}

function go_to_type_hidden(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_hidden(new_id,'', '', '', w_attr_name, w_attr_value);
}

function go_to_type_submit_reset(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_submit_reset(new_id,'Submit', 'Reset', '', true, w_attr_name, w_attr_value);
}

function el_editor()
{
	if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	

	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

	type_editor(new_id,'');
}

function el_text()
{
	
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	

//edit table
	var td  = document.getElementById('edit_table');
	//type select		
	var el_type_label = document.createElement('label');
	
	el_type_label.style.cssText = "color: #00aeef; font-weight: bold; font-size: 13px";
	//el_type_label.setAttribute("style" , "color: #00aeef; font-weight: bold; font-size: 13px", 0 );
	el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	td.appendChild(el_type_label);

	var el_type_radio_text = document.createElement('input');
                el_type_radio_text.setAttribute("id", "el_type_radio_text");
                el_type_radio_text.setAttribute("type", "radio");
				el_type_radio_text.style.cssText = "margin-left:15px";
                el_type_radio_text.setAttribute("value", "text");
                el_type_radio_text.setAttribute("name", "el_type");
                el_type_radio_text.setAttribute("onclick", "go_to_type_text('"+new_id+"')");
		el_type_radio_text.setAttribute("checked", "checked");
		Text = document.createTextNode("Simple text");
		
	var el_type_radio_password = document.createElement('input');
                el_type_radio_password.setAttribute("id", "el_type_radio_password");
                el_type_radio_password.setAttribute("type", "radio");
				el_type_radio_password.style.cssText = "margin-left:15px";
                el_type_radio_password.setAttribute("value", "password");
                el_type_radio_password.setAttribute("name", "el_type");
                el_type_radio_password.setAttribute("onclick", "go_to_type_password('"+new_id+"')");
		Password = document.createTextNode("Password");

	var el_type_radio_textarea = document.createElement('input');
                el_type_radio_textarea.setAttribute("id", "el_type_radio_textarea");
                el_type_radio_textarea.setAttribute("type", "radio");
				el_type_radio_textarea.style.cssText = "margin-left:15px";
                el_type_radio_textarea.setAttribute("value", "textarea");
                el_type_radio_textarea.setAttribute("name", "el_type");
                el_type_radio_textarea.setAttribute("onclick", "go_to_type_textarea('"+new_id+"')");
		Textarea = document.createTextNode("Text area");
		
	var el_type_radio_name = document.createElement('input');
                el_type_radio_name.setAttribute("id", "el_type_radio_name");
                el_type_radio_name.setAttribute("type", "radio");
				el_type_radio_name.style.cssText = "margin-left:15px";
                el_type_radio_name.setAttribute("value", "name");
                el_type_radio_name.setAttribute("name", "el_type");
                el_type_radio_name.setAttribute("onclick", "go_to_type_name('"+new_id+"')");
		Name = document.createTextNode("Name");
		
	var el_type_radio_submitter_mail= document.createElement('input');
                el_type_radio_submitter_mail.setAttribute("id", "el_type_radio_submitter_mail");
                el_type_radio_submitter_mail.setAttribute("type", "radio");
				el_type_radio_submitter_mail.style.cssText = "margin-left:15px";
                el_type_radio_submitter_mail.setAttribute("value", "submitter_mail");
                el_type_radio_submitter_mail.setAttribute("name", "el_type");
                el_type_radio_submitter_mail.setAttribute("onclick", "go_to_type_submitter_mail('"+new_id+"')");
		Submitter_mail = document.createTextNode("E-mail");

	var el_type_radio_number= document.createElement('input');
                el_type_radio_number.setAttribute("id", "el_type_radio_number");
                el_type_radio_number.setAttribute("type", "radio");
				el_type_radio_number.style.cssText = "margin-left:15px";
                el_type_radio_number.setAttribute("value", "number");
                el_type_radio_number.setAttribute("name", "el_type");
                el_type_radio_number.setAttribute("onclick", "go_to_type_number('"+new_id+"')");
		Number = document.createTextNode("Number");


	var el_type_radio_phone= document.createElement('input');
                el_type_radio_phone.setAttribute("id", "el_type_radio_phone");
                el_type_radio_phone.setAttribute("type", "radio");
				el_type_radio_phone.style.cssText = "margin-left:15px";
                el_type_radio_phone.setAttribute("value", "phone");
                el_type_radio_phone.setAttribute("name", "el_type");
                el_type_radio_phone.setAttribute("onclick", "go_to_type_phone('"+new_id+"')");
		Phone = document.createTextNode("Phone");

	var el_type_radio_hidden = document.createElement('input');
                el_type_radio_hidden.setAttribute("type", "radio");
				el_type_radio_hidden.style.cssText = "margin-left:15px";
                el_type_radio_hidden.setAttribute("name", "el_type");
                el_type_radio_hidden.setAttribute("onclick", "go_to_type_hidden('"+new_id+"')");
		Hidden = document.createTextNode("Hidden field");
		
var el_type_radio_address = document.createElement('input');
                el_type_radio_address.setAttribute("id", "el_type_radio_address");
                el_type_radio_address.setAttribute("type", "radio");
				el_type_radio_address.style.cssText = "margin-left:15px";
                el_type_radio_address.setAttribute("value", "address");
                el_type_radio_address.setAttribute("name", "el_type");
                el_type_radio_address.setAttribute("onchange", "go_to_type_address('"+new_id+"')");
		Address = document.createTextNode("Address");
	
var el_type_radio_mark_map = document.createElement('input');
                el_type_radio_mark_map.setAttribute("id", "el_type_radio_mark_map");
                el_type_radio_mark_map.setAttribute("type", "radio");
				el_type_radio_mark_map.style.cssText = "margin-left:15px";
                el_type_radio_mark_map.setAttribute("value", "mark_map");
                el_type_radio_mark_map.setAttribute("name", "el_type");
                el_type_radio_mark_map.setAttribute("onmousedown", "alert('This field type is disabled in free version. If you need this functionality, you need to buy the commercial version.'); return false;");
		Mark_map = document.createTextNode("Address(mark on map)");
	
	
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	var br4 = document.createElement('br');
	var br5 = document.createElement('br');
	var br6 = document.createElement('br');
	var br7 = document.createElement('br');
	var br8 = document.createElement('br');
	var br9 = document.createElement('br');
	var br10 = document.createElement('br');
	

	td.appendChild(br1);
	td.appendChild(el_type_radio_text);
	td.appendChild(Text);
	td.appendChild(br2);
	td.appendChild(el_type_radio_password);
	td.appendChild(Password);
	td.appendChild(br3);
	td.appendChild(el_type_radio_textarea);
	td.appendChild(Textarea);
	td.appendChild(br4);
	td.appendChild(el_type_radio_name);
	td.appendChild(Name);
	td.appendChild(br5);
	td.appendChild(el_type_radio_address);
	td.appendChild(Address);
	td.appendChild(br10);
	td.appendChild(el_type_radio_mark_map);
	td.appendChild(Mark_map);
	td.appendChild(br9);
	td.appendChild(el_type_radio_submitter_mail);
	td.appendChild(Submitter_mail);
	td.appendChild(br6);
	td.appendChild(el_type_radio_number);
	td.appendChild(Number);
	td.appendChild(br7);
	td.appendChild(el_type_radio_phone);
	td.appendChild(Phone);
	td.appendChild(br8);
	td.appendChild(el_type_radio_hidden);
	td.appendChild(Hidden);
	
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

			
	go_to_type_text(new_id);
	
}

function go_to_type_text(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_text(new_id,'Text:', 'left', '200', '', '', 'no', 'no', '',w_attr_name, w_attr_value);
}

function go_to_type_number(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_number(new_id,'Number:', 'left', '200', '', '', 'no', 'no', '',w_attr_name, w_attr_value);
}

function go_to_type_password(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_password(new_id,'Password:', 'left', '200', 'no', 'no', 'wdform_input',w_attr_name, w_attr_value);
}

function go_to_type_textarea(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_textarea(new_id,'Textarea:', 'left', '200', '100', '','', 'no', 'no', '',w_attr_name, w_attr_value)
}

function go_to_type_name(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
 	w_first_val=['',''];
 	w_title=['',''];
  w_mini_labels=['Title','First','Last','Middle'];
	type_name(new_id,'Name:', 'left', w_first_val, w_title, w_mini_labels, '100', 'normal', 'no', 'no', '',w_attr_name, w_attr_value)
}
	
function go_to_type_address(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
  w_mini_labels=['Street Address', 'Street Address Line 2', 'City', 'State / Province / Region', 'Postal / Zip Code', 'Country',];
	w_disabled_fields=['no', 'no', 'no', 'no', 'no', 'no'];
	type_address(new_id,'Address:', 'left', '300', w_mini_labels, w_disabled_fields, 'no', 'wdform_address', w_attr_name, w_attr_value)
}

function go_to_type_phone(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
 	w_first_val=['',''];
 	w_title=['',''];
  w_mini_labels = ['Area Code','Phone Number'];
	type_phone(new_id,'Phone:', 'left', '135', w_first_val, w_title, w_mini_labels, 'no', 'no', '',w_attr_name, w_attr_value)
}

function go_to_type_submitter_mail(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_submitter_mail(new_id,'E-mail:', 'left', '200', '', '', 'no', 'no', '', w_attr_name, w_attr_value);
}

function go_to_type_time(new_id)
{
	
 	w_attr_name=[];
 	w_attr_value=[];
	w_mini_labels = ['HH','MM','SS', 'AM/PM'];
	type_time(new_id, 'Time:', 'left', '24', '0', '1','','','', w_mini_labels, 'no', '',w_attr_name, w_attr_value);
	
}

function go_to_type_date(new_id)
{
	
 	w_attr_name=[];
 	w_attr_value=[];
	
	type_date(new_id, 'Date:', 'left', '', 'no', '', '%Y-%m-%d', '...',w_attr_name, w_attr_value);
}

function go_to_type_date_fields(new_id)
{
	
 	w_attr_name=[];
 	w_attr_value=[];
  var current_date = new Date();
	w_to = current_date.getFullYear();
	type_date_fields(new_id, 'Date:', 'left', '', '', '', 'SELECT', 'SELECT', 'SELECT', 'day', 'month', 'year', '45', '60', '60', 'no', 'wdform_date_fields', '1901', w_to, '&nbsp;/&nbsp;', w_attr_name, w_attr_value);
}

function go_to_type_button(new_id)
{
 	w_title=[ "Button"];
 	w_func=[""];
	
 	w_attr_name=[];
 	w_attr_value=[];
	
	type_button(new_id, w_title, w_func, 'wdform_button',w_attr_name, w_attr_value);
}

function el_checkbox()
{
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	


	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");


 	w_choices=[ "option 1", "option 2"];
 	w_choices_checked=["0", "0"];
	
 	w_attr_name=[];
 	w_attr_value=[];
	type_checkbox(new_id,'Checkbox:', 'left', 'ver', w_choices, w_choices_checked, '1', 'no', 'no', '0', '',w_attr_name, w_attr_value);
}

function el_radio()
{
	
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");


 	w_choices=[ "option 1", "option 2"];
 	w_choices_checked=["0", "0"];
	
 	w_attr_name=[];
 	w_attr_value=[];
	
	type_radio(new_id,'Radio:', 'left', 'ver', w_choices, w_choices_checked, '1', 'no', 'no', '0', '',w_attr_name, w_attr_value);
}

function el_time_and_date()
{
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	
	
//edit table

	//type select		
	var el_type_label = document.createElement('label');
                el_type_label.style.cssText = "color:#00aeef; font-weight:bold; font-size: 13px";
		el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	
	var el_type_radio_time = document.createElement('input');
                el_type_radio_time.setAttribute("id", "el_type_radio_time");
                el_type_radio_time.setAttribute("type", "radio");
                el_type_radio_time.setAttribute("value", "time");
                el_type_radio_time.style.cssText = "margin-left:15px";
                el_type_radio_time.setAttribute("name", "el_type_radio_time");
                el_type_radio_time.setAttribute("onclick", "go_to_type_time('"+new_id+"')");
		Time_ = document.createTextNode("Time");

	var el_type_radio_date = document.createElement('input');
                el_type_radio_date.setAttribute("id", "el_type_radio_date");
                el_type_radio_date.setAttribute("type", "radio");
                el_type_radio_date.setAttribute("value", "date");
                el_type_radio_date.style.cssText = "margin-left:15px";
                el_type_radio_date.setAttribute("name", "el_type_radio_time");
                el_type_radio_date.setAttribute("onclick", "go_to_type_date('"+new_id+"')");
				el_type_radio_date.setAttribute("checked", "checked");

		Date_ = document.createTextNode("Date (Single fileld with a picker)");
		
	var el_type_radio_date_fields = document.createElement('input');
                el_type_radio_date_fields.setAttribute("id", "el_type_radio_date_fields");
                el_type_radio_date_fields.setAttribute("type", "radio");
                el_type_radio_date_fields.setAttribute("value", "date_fields");
                el_type_radio_date_fields.style.cssText = "margin-left:15px";
                el_type_radio_date_fields.setAttribute("name", "el_type_radio_time");
                el_type_radio_date_fields.setAttribute("onclick", "go_to_type_date_fields('"+new_id+"')");
			
		Date_fields_ = document.createTextNode("Date (3 separate fields)");

	var td  = document.getElementById('edit_table');
	
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	
	td.appendChild(el_type_label);
	td.appendChild(br1);
	td.appendChild(el_type_radio_date);
	td.appendChild(Date_);
	td.appendChild(br2);
	td.appendChild(el_type_radio_date_fields);
	td.appendChild(Date_fields_);
	td.appendChild(br3);
	td.appendChild(el_type_radio_time);
	td.appendChild(Time_);
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

	
	go_to_type_date(new_id);
	
}

function go_to_type_own_select(new_id)
{
 	w_choices=[ "Select value", "option 1", "option 2"];
 	w_choices_checked=["1", "0", "0"];
	w_choices_disabled=[true, false, false];
 	w_attr_name=[];
 	w_attr_value=[];
	type_own_select(new_id, 'Select:', 'left', '200',w_choices, w_choices_checked, 'no','wdform_select',w_attr_name, w_attr_value, w_choices_disabled);
}

function go_to_type_country(new_id)
{
 	w_countries=["","Afghanistan","Albania",	"Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Central African Republic","Chad","Chile","China","Colombi","Comoros","Congo (Brazzaville)","Congo","Costa Rica","Cote d'Ivoire","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor Timur)","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland","France","Gabon","Gambia, The","Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Korea, North","Korea, South","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Morocco","Mozambique","Myanmar","Namibia","Nauru","Nepa","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"];	
	w_attr_name=[];
 	w_attr_value=[];
	type_country(new_id,'Country:', w_countries, 'left', '200', 'no', 'wdform_select',w_attr_name, w_attr_value);
}

function el_select()
{
//edit table
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	

	//type select		
	var el_type_label = document.createElement('label');
                el_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	
	var el_type_radio_own_select = document.createElement('input');
                el_type_radio_own_select.setAttribute("id", "el_type_radio_own_select");
                el_type_radio_own_select.setAttribute("type", "radio");
                el_type_radio_own_select.setAttribute("value", "own_select");
                el_type_radio_own_select.style.cssText = "margin-left:15px";
                el_type_radio_own_select.setAttribute("name", "el_type_radio_select");
                el_type_radio_own_select.setAttribute("onclick", "go_to_type_own_select('"+new_id+"')");
		el_type_radio_own_select.setAttribute("checked", "checked");
		Own_select = document.createTextNode("Custom Select");
		
	var el_type_radio_country = document.createElement('input');
                el_type_radio_country.setAttribute("id", "el_type_radio_country");
                el_type_radio_country.setAttribute("type", "radio");
                el_type_radio_country.setAttribute("value", "country");
                el_type_radio_country.style.cssText = "margin-left:15px";
                el_type_radio_country.setAttribute("name", "el_type_radio_select");
                el_type_radio_country.setAttribute("onclick", "go_to_type_country('"+new_id+"')");
		Country = document.createTextNode("Country List");

	var td  = document.getElementById('edit_table');
	
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	
	td.appendChild(el_type_label);
	td.appendChild(br1);
	td.appendChild(el_type_radio_own_select);
	td.appendChild(Own_select);
	td.appendChild(br2);
	td.appendChild(el_type_radio_country);
	td.appendChild(Country);
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

	
	go_to_type_own_select(new_id);
}

function el_file_upload()
{
//edit table
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

	
 	w_attr_name=[];
 	w_attr_value=[];
}

function el_captcha()
{
//edit table
if(document.getElementById("editing_id").value)
	new_id=document.getElementById("editing_id").value;
else
	new_id=gen;
	
	if(document.getElementById('_wd_captchaform_id_temp'))
	{
		alert("The captcha already has been created.");
		return;
	}
	
	if(document.getElementById('wd_recaptchaform_id_temp'))
	{
		alert("The captcha already has been created.");
		return;
	}
	
	var el_type_label = document.createElement('label');
                el_type_label.style.cssText ="color:#00aeef; font-weight:bold; font-size: 13px";
		el_type_label.innerHTML = "<br />&nbsp;&nbsp;Field type";
	
	var el_type_radio_captcha = document.createElement('input');
                el_type_radio_captcha.setAttribute("id", "el_type_captcha");
                el_type_radio_captcha.setAttribute("type", "radio");
                el_type_radio_captcha.setAttribute("value", "captcha");
                el_type_radio_captcha.style.cssText = "margin-left:15px";
                el_type_radio_captcha.setAttribute("name", "el_type_captcha");
                el_type_radio_captcha.setAttribute("onclick", "go_to_type_captcha('"+new_id+"')");
		el_type_radio_captcha.setAttribute("checked", "checked");
		Captcha = document.createTextNode("Simple Captcha");
		
	var el_type_radio_recaptcha = document.createElement('input');
                el_type_radio_recaptcha.setAttribute("id", "el_type_radio_recaptcha");
                el_type_radio_recaptcha.setAttribute("type", "radio");
                el_type_radio_recaptcha.setAttribute("value", "recaptcha");
                el_type_radio_recaptcha.style.cssText = "margin-left:15px";
                el_type_radio_recaptcha.setAttribute("name", "el_type_captcha");
                el_type_radio_recaptcha.setAttribute("onclick", "go_to_type_recaptcha('"+new_id+"')");
		Recaptcha_text = document.createTextNode("Recaptcha");

	var td  = document.getElementById('edit_table');
	
	var br1 = document.createElement('br');
	var br2 = document.createElement('br');
	var br3 = document.createElement('br');
	
	td.appendChild(el_type_label);
	td.appendChild(br1);
	td.appendChild(el_type_radio_captcha);
	td.appendChild(Captcha);
	
	
	//Recaptchan anjatac
	
	td.appendChild(br2);
	td.appendChild(el_type_radio_recaptcha);
	td.appendChild(Recaptcha_text);
	
	
	var pos=document.getElementsByName("el_pos");
			pos[0].removeAttribute("disabled");
			pos[1].removeAttribute("disabled");
			pos[2].removeAttribute("disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.removeAttribute("disabled", "disabled");

	
 	w_attr_name=[];
 	w_attr_value=[];
	go_to_type_captcha(new_id);
}

function go_to_type_captcha(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_captcha(new_id,'Word Verification:', 'left', '6','',w_attr_name, w_attr_value);
}

function go_to_type_recaptcha(new_id)
{
 	w_attr_name=[];
 	w_attr_value=[];
	type_recaptcha(new_id,'Recaptcha Word Verification:', 'left', '', '', 'red', '',w_attr_name, w_attr_value);
}



///////////////////////////////////////////////
///////////  el_page_break   //////////////////
///////////////////////////////////////////////

function el_page_break()
{
		for(t=form_view_max; t>0; t--)
		{
			if(document.getElementById('form_id_tempform_view'+t))
			{
					last_view=t;
					break;
			}
		}
	if(document.getElementById('form_id_tempform_view'+t).getAttribute('page_title'))
		w_page_title=document.getElementById('form_id_tempform_view'+t).getAttribute('page_title');
	else
		w_page_title='Untitled Page';
	
	w_title	=[ "Next","Previous"];
 	w_type	=["button","button"];
 	w_class	=["wdform_page_button","wdform_page_button"];
 	w_check	=['false', 'false'];
	
 	w_attr_name=[];
 	w_attr_value=[];
	
	type_page_break("0",w_page_title , w_title, w_type, w_class, w_check, w_attr_name, w_attr_value);
}
function el_page_navigation()
{
	
	w_type=document.getElementById('pages').getAttribute('type');
	w_show_numbers=false;
	w_show_title=false;

	if(document.getElementById('pages').getAttribute('show_numbers')=="true")
		w_show_numbers=true;
	
	if(document.getElementById('pages').getAttribute('show_title')=="true")
		w_show_title=true;
	
 	w_attr_name=[];
 	w_attr_value=[];
	
	type_page_navigation( w_type, w_show_title , w_show_numbers , w_attr_name, w_attr_value);
}

function remove_section_break(id)
{
	var tr = document.getElementById(id);
	is3=false;
	if(tr.nextSibling.nodeType==3)
	{
			move=tr.nextSibling.nextSibling.firstChild;
			to=tr.previousSibling.previousSibling.firstChild;
			is3=true;
	}
	else
	{
			move=tr.nextSibling.firstChild;
			to=tr.previousSibling.firstChild;
	}
	
	
	l=move.childNodes.length;
	for(k=0;k<l;k++)
	{
		if(to.childNodes[k])
		{
			while(move.childNodes[k].firstChild.firstChild)
				to.childNodes[k].firstChild.appendChild(move.childNodes[k].firstChild.firstChild);
		}
		else
		
		to.appendChild(move.childNodes[k]);			
	}
	
	if(is3)
	{
		tr.parentNode.removeChild(tr.nextSibling);
		tr.parentNode.removeChild(tr.nextSibling);
	}
	else
		tr.parentNode.removeChild(tr.nextSibling);
		
	tr.parentNode.removeChild(tr);
	
}

function remove_row(id)
{
	var tr = document.getElementById(id);
	tr.parentNode.removeChild(tr);
	
}

function destroyChildren(node)
{
  while (node.firstChild)
      node.removeChild(node.firstChild);
}

function make_pagebreak_button(next_or_previous,title,type, class_ ,id)
{
	switch(type)
	{
		case 'button': 
		{ 
		
			var element = document.createElement('button');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('type', "button");
				element.setAttribute('class', class_);
				element.style.cursor="pointer";
				element.innerHTML=title;
				
			return element;
			
			break;
		}
		case 'text': {	
			
			var element = document.createElement('span');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('class', class_);
				element.style.cursor="pointer";
				element.innerHTML=title;
				
			return element;
			
			break;
		}
		case 'img':{ 			
		
			var element = document.createElement('img');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('class', class_);
				element.style.cursor="pointer";
				element.src=title;
				
			return element;
			
			break;
		}
	}
}

function show_or_hide(id)
{
	if(!jQuery("#form_id_tempform_view"+id).is(":visible")) {
		show_form_view(id);
		jQuery("#show_page_img_"+id).attr("onmouseover", "chnage_icons_src(this,'minus')");
		jQuery("#show_page_img_"+id).attr("onmouseout", "chnage_icons_src(this,'minus')");
	}
	else {
		hide_form_view(id);
		jQuery("#show_page_img_"+id).attr("onmouseover", "chnage_icons_src(this,'plus')");
		jQuery("#show_page_img_"+id).attr("onmouseout", "chnage_icons_src(this,'plus')");
	}
}

function show_form_view(id)
{
	document.getElementById("form_id_tempform_view_img"+id).childNodes[0].childNodes[0].removeAttribute("width", "100%");
	document.getElementById("form_id_tempform_view_img"+id).style.backgroundColor="";
	document.getElementById("form_id_tempform_view_img"+id).childNodes[0].childNodes[0].style.display="none";
	document.getElementById("show_page_img_"+id).src=plugin_url+'/images/minus.png';

jQuery("#form_id_tempform_view"+id).show('medium')

}

function hide_form_view(id) {
  form_maker_remove_spaces(document.getElementById("form_id_tempform_view_img" + id));
jQuery("#form_id_tempform_view"+id).hide('medium', function() {
	document.getElementById("form_id_tempform_view_img"+id).childNodes[0].childNodes[0].setAttribute("width", "100%");
	document.getElementById("form_id_tempform_view_img"+id).childNodes[0].childNodes[0].innerHTML=document.getElementById("form_id_tempform_view"+id).getAttribute('page_title');
	document.getElementById("form_id_tempform_view_img"+id).childNodes[0].childNodes[0].removeAttribute('style');
	document.getElementById("form_id_tempform_view_img"+id).style.backgroundColor="#F0F0F0";
	document.getElementById("show_page_img_"+id).src=plugin_url+'/images/plus.png';
  });

}

function generate_buttons(id)
{

	form_view_elemet=document.getElementById("form_id_tempform_view"+id);

	if(form_view_elemet.parentNode.previousSibling)
	{
		if(form_view_elemet.parentNode.previousSibling.tagName=="TABLE")
			table=true;
		else
			if(form_view_elemet.parentNode.previousSibling.previousSibling)
				if(form_view_elemet.parentNode.previousSibling.previousSibling.tagName=="TABLE")
					table=true;
				else
					table=false;
			else
				table=false;
				
		if(table)
		{
			/*if(!table.firstChild.tagName)
				table.removeChild(table.firstChild);*/

			if(form_view_elemet.getAttribute('previous_title'))
				{
						previous_title	= form_view_elemet.getAttribute('previous_title');
						previous_type	= form_view_elemet.getAttribute('previous_type');
						previous_class	= form_view_elemet.getAttribute('previous_class');
				}
					else
					{
						previous_title	= "Previous";
						previous_type	= "button";
						previous_class	= "";
					}
			next_or_previous="previous";

			previous=make_pagebreak_button(next_or_previous, previous_title, previous_type, previous_class, id);
			var td = document.createElement("td");
				td.setAttribute("valign", "middle");
				td.setAttribute("align", "left");
			
			td.appendChild(previous);
			page_nav.appendChild(td);
		}
	}


	var td = document.createElement("td");
		td.setAttribute("id", "page_numbersform_id_temp"+id);
		td.setAttribute("width", "100%");
		td.setAttribute("valign", "middle");
		td.setAttribute("align", "center");
	page_nav.appendChild(td);



	if(form_view_elemet.parentNode.nextSibling)
	{
		if(form_view_elemet.parentNode.nextSibling.tagName=="TABLE")
			table=true;
		else
			if(form_view_elemet.parentNode.nextSibling.nextSibling)
			{
				if(form_view_elemet.parentNode.nextSibling.nextSibling.tagName=="TABLE")
					table=true;
				else
					table=false;
			}
			else
				table=false;
				
		if(table)
		{
			if(form_view_elemet.getAttribute('previous_title')){
						next_title	=form_view_elemet.getAttribute('next_title');
						next_type	=form_view_elemet.getAttribute('next_type');
						next_class	=form_view_elemet.getAttribute('next_class');
					}
					else
					{
						next_title	= "Next";
						next_type	= "button";
						next_class	= "";
					}
		
			next_or_previous="next";
		
			next=make_pagebreak_button(next_or_previous,next_title,next_type,next_class, id);
			var td = document.createElement("td");
				td.setAttribute("valign", "middle");
				td.setAttribute("align", "right");
			
			td.appendChild(next);
			page_nav.appendChild(td);
		}
	}

}

function generate_page_nav(id)
{
form_view=id;
document.getElementById('form_id_tempform_view'+id).parentNode.style.borderWidth="1px";
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
for(t=1; t<=form_view_max; t++)
	if(document.getElementById('form_id_tempform_view'+t))
	{
		page_nav=document.getElementById("form_id_temppage_nav"+t);
		destroyChildren(page_nav);
		generate_buttons(t);
	}

generate_page_bar();
refresh_page_numbers();

////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

function remove_page(id)
{	
	if(confirm('Do you want to delete the page?'))
	{
		refresh_pages_without_deleting(id);
	}
}

function remove_page_all(id)
{
	if(confirm('Do you want to delete the all fields in this page?'))
	{
		form_view_elemet=document.getElementById("form_id_tempform_view"+id);

		form_view_count=0;
			
		for(i=1; i<=30; i++)
		{
			if(document.getElementById('form_id_tempform_view'+i))
			{
				form_view_count++;
			}
		}

	
		if(form_view_count==1)
		{
	 
			form_view_elemet.innerHTML='';
			
			tbody=form_view_elemet;		
				
			tr=document.createElement('tr');
				tr.setAttribute('class','wdform_tr1');
			td=document.createElement('td');
				td.setAttribute('class','wdform_td1');
				
				
			tr_page_nav=document.createElement('tr');
				tr_page_nav.setAttribute('valign','top');
				tr_page_nav.setAttribute('class','wdform_footer');
				
			td_page_nav=document.createElement('td');
				td_page_nav.setAttribute('colspan','100');
				
			table_min_page_nav=document.createElement('table');
				table_min_page_nav.setAttribute('width','100%');
				
			tbody_min_page_nav=document.createElement('tbody');
			tr_min_page_nav=document.createElement('tr');
				tr_min_page_nav.setAttribute('id','form_id_temppage_nav'+form_view);
				
			table_min=document.createElement('table');
				table_min.setAttribute('class','wdform_table2');
			tbody_min=document.createElement('tbody');
				tbody_min.setAttribute('class','wdform_tbody2');
				
			table_min.appendChild(tbody_min);
			td.appendChild(table_min);
			tr.appendChild(td);
			tbody_min_page_nav.appendChild(tr_min_page_nav);
			table_min_page_nav.appendChild(tbody_min_page_nav);
			td_page_nav.appendChild(table_min_page_nav);
			tr_page_nav.appendChild(td_page_nav);
			tbody.appendChild(tr);
			tbody.appendChild(tr_page_nav);
			
		return;
		}
		

	
		form_view_table=form_view_elemet.parentNode;
		document.getElementById("take").removeChild(form_view_table);
		refresh_pages(id);
	}
}

function refresh_pages(id)
{
	temp=1;
	form_view_count=0;
	destroyChildren(document.getElementById("pages"));

	for(i=1; i<=30; i++)
	{
		if(document.getElementById('form_id_tempform_view'+i))
		{
			form_view_count++;
		}
	}

	if(form_view_count>1)
	{
		for(i=1; i<=30; i++)
		{
			if(document.getElementById('form_id_tempform_view'+i))
			{
				page_number = document.createElement('span');
				page_number.setAttribute('id','page_'+i);
				page_number.setAttribute('class','page_deactive');
				page_number.innerHTML=(temp);
				temp++;
				document.getElementById("pages").appendChild(page_number);
			}
		}
	}
	
	else
	{
		destroyChildren(document.getElementById("edit_page_navigation"));
		for(i=1; i<=30; i++)
		{
			if(document.getElementById('form_id_tempform_view'+i))
			{
				document.getElementById('form_id_tempform_view'+i).parentNode.style.borderWidth="0px";
				document.getElementById('form_id_tempform_view'+i).style.display="block";
				document.getElementById("form_id_temppage_nav"+i).innerHTML="";
        form_maker_remove_spaces(document.getElementById("form_id_tempform_view_img" + i));
				document.getElementById("form_id_tempform_view_img"+i).childNodes[0].childNodes[0].removeAttribute("width", "100%");
				document.getElementById("form_id_tempform_view_img"+i).style.backgroundColor="";
				document.getElementById("form_id_tempform_view_img"+i).childNodes[0].childNodes[0].style.display="none";
				document.getElementById("show_page_img_"+i).src=plugin_url+'/images/minus.png';
				form_view=i;
				return;
			}
		}	
	}
	
	for(i=parseInt(id)+1; i<=30; i++)
		if(document.getElementById('form_id_tempform_view'+i))
		{
			generate_page_nav(i);
			return;
		}
		
	for(i=parseInt(id)-1; i>0; i--)
		if(document.getElementById('form_id_tempform_view'+i))
		{
			generate_page_nav(i);
			return;
		}
	
}


function refresh_pages_without_deleting(id)
{
	form_view_elemet=document.getElementById("form_id_tempform_view"+id);
	
	
	form_view_count=0;
	for(i=1; i<=30; i++)
	{
		if(document.getElementById('form_id_tempform_view'+i))
		{
			form_view_count++;
		}
	}


	
	if(form_view_count==1)
	{
	
		form_view_elemet.innerHTML='';
 
		tbody=form_view_elemet;		
			
		tr=document.createElement('tr');
			tr.setAttribute('class','wdform_tr1');
		td=document.createElement('td');
			td.setAttribute('class','wdform_td1');
			
			
		tr_page_nav=document.createElement('tr');
			tr_page_nav.setAttribute('valign','top');
			tr_page_nav.setAttribute('class','wdform_footer');
			
		td_page_nav=document.createElement('td');
			td_page_nav.setAttribute('colspan','100');
			
		table_min_page_nav=document.createElement('table');
			table_min_page_nav.setAttribute('width','100%');
			
		tbody_min_page_nav=document.createElement('tbody');
		tr_min_page_nav=document.createElement('tr');
			tr_min_page_nav.setAttribute('id','form_id_temppage_nav'+form_view);
			
		table_min=document.createElement('table');
			table_min.setAttribute('class','wdform_table2');
		tbody_min=document.createElement('tbody');
			tbody_min.setAttribute('class','wdform_tbody2');
			
		table_min.appendChild(tbody_min);
		td.appendChild(table_min);
		tr.appendChild(td);
		tbody_min_page_nav.appendChild(tr_min_page_nav);
		table_min_page_nav.appendChild(tbody_min_page_nav);
		td_page_nav.appendChild(table_min_page_nav);
		tr_page_nav.appendChild(td_page_nav);
		tbody.appendChild(tr);
		tbody.appendChild(tr_page_nav);
		
	return;
	}
	
	table=form_view_elemet.parentNode.previousSibling;
	
	while(table)
	{
		if(table.tagName=="TABLE")
			break;
		else
			table=table.previousSibling;
	}
	
	if(!table)
	{
		table=form_view_elemet.parentNode.nextSibling;
		while(table)
		{
			if(table.tagName=="TABLE")
				break;
			else
				table=table.nextSibling;
		}

	}
	
	////////////////////////////////////////////////////
	
	
			i=gen;
			gen++;
			
			var tr = document.createElement('tr');
				tr.setAttribute("id", i);
				tr.setAttribute("class", "wdform_tr_section_break");
				tr.setAttribute("type", "type_section_break");
				
				
			var select_ = document.getElementById('sel_el_pos');
			var option = document.createElement('option');
				option.setAttribute("id", i+"_sel_el_pos");
				option.setAttribute("value", i);
				option.innerHTML="custom_"+i;
				
			table_form_view=table.firstChild;

			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_section_break("'+i+'")');
					img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//					img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
					
///////////////////////////////////////////////////////////////////////////////////////////////
			var in_editor = document.createElement("td");
					in_editor.setAttribute("id", i+"_element_sectionform_id_temp");
         			in_editor.setAttribute("align", 'left');
					in_editor.setAttribute("valign", "top");
					in_editor.setAttribute("colspan", "100");
					in_editor.setAttribute('class', 'toolbar_padding');
					
				in_editor.innerHTML="<hr/>";
			
			
			
			var label = document.createElement('span');
					label.setAttribute("id", i+"_element_labelform_id_temp");
					label.innerHTML = "custom_"+i;
					label.style.cssText = 'display:none';
					
			td_EDIT.appendChild(label);
			tr.appendChild(in_editor);

			tr.appendChild(td_X);
			tr.appendChild(td_EDIT);
			tr.appendChild(td_DUBLICATE);

			
				beforeTr=table_form_view.lastChild;
				table_form_view.insertBefore(tr, beforeTr);
		

	

	while(form_view_elemet.childNodes[1])
	{
		beforeTr=table_form_view.lastChild;
		table_form_view.insertBefore(form_view_elemet.firstChild, beforeTr);
	}
	
	
		form_view_table=form_view_elemet.parentNode;
		document.getElementById("take").removeChild(form_view_table);
		refresh_pages(id);
}


function make_page_steps_front()
{
	destroyChildren(document.getElementById("pages"));
	show_title=document.getElementById('el_show_title_input').checked;
	k=0;
	for(j=1; j<=form_view_max; j++)
	{	
		if(document.getElementById('form_id_tempform_view'+j))
			{
			if(document.getElementById('form_id_tempform_view'+j).getAttribute('page_title'))
				w_pages=document.getElementById('form_id_tempform_view'+j).getAttribute('page_title');
			else
				w_pages=""
			k++;
			
			page_number = document.createElement('span');
			page_number.setAttribute('id','page_'+j);
			page_number.setAttribute('onClick','generate_page_nav("'+j+'")');
			if(j==form_view)
				page_number.setAttribute('class',"page_active");
			else
				page_number.setAttribute('class',"page_deactive");
			if(show_title)
			{
				page_number.innerHTML=w_pages;
			}
			else
				page_number.innerHTML=k;
			
			document.getElementById("pages").appendChild(page_number);
		}
	}

}

function make_page_percentage_front()
{
	destroyChildren(document.getElementById("pages"));
	show_title=document.getElementById('el_show_title_input').checked;
	
    var div_parent = document.createElement('div');
       	div_parent.setAttribute("class", "page_percentage_deactive");

    var div = document.createElement('div');
       	div.setAttribute("id", "div_percentage");
       	div.setAttribute("class", "page_percentage_active");
		
	var b = document.createElement('b');
       	b.style.margin='3px 7px 3px 3px';
		//b.style.vertical-align='middle';
	div.appendChild(b);
	
	k=0;
	cur_page_title='';
	for(j=1; j<=form_view_max; j++)
	{	
		if(document.getElementById('form_id_tempform_view'+j))
			{
			if(document.getElementById('form_id_tempform_view'+j).getAttribute('page_title'))
				w_pages=document.getElementById('form_id_tempform_view'+j).getAttribute('page_title');
			else
				w_pages=""
			k++;
				
			if(j==form_view)
			{
				if(show_title)
				{ 
					var cur_page_title = document.createElement('span');
					if(k==1)
						cur_page_title.style.paddingLeft="30px";
					else
						cur_page_title.style.paddingLeft="5px";
						cur_page_title.innerHTML=w_pages;
				}
				page_number=k;

			}
		}
	}
	b.innerHTML=Math.round(((page_number-1)/k)*100)+'%';
	div.style.width=((page_number-1)/k)*100+'%';
	div_parent.appendChild(div);
	if(cur_page_title)
		div_parent.appendChild(cur_page_title);
	document.getElementById("pages").appendChild(div_parent);

	
}
function make_page_none_front()
{
	document.getElementById("pages").innerHTML="--------------------------------------------<br> NO PAGE BAR <br>--------------------------------------------";
}

function generate_page_bar() {
  need_enable = false;
  el_page_navigation();
  add(0);
  need_enable = true;
}

function remove_add_(id)
{
			attr_name= new Array();
			attr_value= new Array();
			var input = document.getElementById(id); 
			atr=input.attributes;
			for(v=0;v<30;v++)
				if(atr[v] )
				{
					if(atr[v].name.indexOf("add_")==0)
					{
						attr_name.push(atr[v].name.replace('add_',''));
						attr_value.push(atr[v].value);
						input.removeAttribute(atr[v].name);
						v--;
					}
				}
			for(v=0;v<attr_name.length; v++)
			{
				input.setAttribute(attr_name[v],attr_value[v])
			}
}

function cont_elements() {
  cp2 = 0;

  var zzzxxx = document.getElementsByClassName('wdform_table1').length;
  for (t = 1; t < 100; t++)
    if (document.getElementById(t))
      cp2++;
  return cp2 + zzzxxx;
}

function add(key) {
   if (document.getElementById('editing_id').value == "")
    if (key == 0) {
      var wen_limit_is_page_break = document.getElementsByClassName('wdform_table1').length;
      kz6 = cont_elements();

      if (document.getElementById("element_type").value == "type_page_navigation")
        askofeny = 1;
      else
        askofeny = 0;
      if (kz6 > (count_of_filds_form + askofeny)) {
        alert("The free version is limited up to 7 fields to add. If you need this functionality, you need to buy the commercial version.");
        return;
      }
      else {
        if (count_of_filds_form > 7) {
          alert("The free version is limited up to 7 fields to add. If you need this functionality, you need to buy the commercial version.");
          return;
        }
      }
    }
  if(document.getElementById("element_type").value=="type_grading")
	{

	for(k=100;k>0;k--)
	{
		 if(document.getElementById("el_items"+k))
		 {
			break;
		 }
	}	
	 m=k;


	var items_input="";
	
	for(i=0;i<=m;i++){
	if(document.getElementById("el_items"+i)){
	items_input = items_input+document.getElementById("el_items"+i).value+":";	
	}
	}
	
	items_input += document.getElementById("element_total").value;
	
	if(document.getElementById('editing_id').value)
		id=document.getElementById('editing_id').value;
	else
		id=gen;

  
   var hidden_input_item = document.createElement('input');
						hidden_input_item.setAttribute("id", id+"_hidden_itemform_id_temp");
						hidden_input_item.setAttribute("name", id+"_hidden_itemform_id_temp");
						hidden_input_item.setAttribute("type", "hidden");
						hidden_input_item.setAttribute("value", items_input);	
						
	
  var td_for_hidden = document.getElementById(id+"_element_sectionform_id_temp");								
						
	td_for_hidden.appendChild(hidden_input_item);

	}
	
	
	if(document.getElementById("element_type").value=="type_matrix")
	{
	

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_rows"+i))
		 {
			break;
		 }
	}	
	 m=i;

	for(i=100;i>0;i--)
	{
		 if(document.getElementById("el_columns"+i))
		 {
			break;
		 }
	}	
	n=i;
	var row_input="";
	var column_input="";
	var row_num="";
	var column_num="";
	
	for(i=1;i<=m;i++)
	{
		if(document.getElementById("el_rows"+i))
		{
			row_input = row_input+document.getElementById("el_rows"+i).value+"***";	
			row_num += i+',';
		}
	}
	
	for(i=1;i<=n;i++)
	{
		if(document.getElementById("el_columns"+i))
		{
			column_input= column_input+document.getElementById("el_columns"+i).value+"***";	
			column_num += i+',';
		}
	}
	
	
	if(document.getElementById('editing_id').value)
	id=document.getElementById('editing_id').value;
	else
	id=gen;

   
   var td_for_hidden = document.getElementById(id+"_element_sectionform_id_temp");

   var hidden_input_row = document.createElement('input');
						hidden_input_row.setAttribute("id", id+"_hidden_rowform_id_temp");
						hidden_input_row.setAttribute("name", id+"_hidden_rowform_id_temp");
						hidden_input_row.setAttribute("type", "hidden");
						hidden_input_row.setAttribute("value", row_input);	
	
	var hidden_ids_row = document.createElement('input');
						hidden_ids_row.setAttribute("id", id+"_row_idsform_id_temp");
						hidden_ids_row.setAttribute("name", id+"_row_idsform_id_temp");
						hidden_ids_row.setAttribute("type", "hidden");
						hidden_ids_row.setAttribute("value", row_num);	
				
	var hidden_input_column = document.createElement('input');
						hidden_input_column.setAttribute("id", id+"_hidden_columnform_id_temp");
						hidden_input_column.setAttribute("name", id+"_hidden_columnform_id_temp");
						hidden_input_column.setAttribute("type", "hidden");
						hidden_input_column.setAttribute("value", column_input);

    var hidden_ids_column = document.createElement('input');
						hidden_ids_column.setAttribute("id", id+"_column_idsform_id_temp");
						hidden_ids_column.setAttribute("name", id+"_column_idsform_id_temp");
						hidden_ids_column.setAttribute("type", "hidden");
						hidden_ids_column.setAttribute("value", column_num);								
						
	td_for_hidden.appendChild(hidden_input_row);
	td_for_hidden.appendChild(hidden_ids_row);
	td_for_hidden.appendChild(hidden_input_column);
	td_for_hidden.appendChild(hidden_ids_column);
	
	
	}
	if(document.getElementById("element_type").value=="type_section_break")
	{
		form_view=0;
		for(t=form_view_max; t>0; t--)
		{
			if(document.getElementById('form_id_tempform_view'+t))
				if(jQuery("#form_id_tempform_view"+t).is(":visible"))
				{
					form_view=t;
          form_maker_remove_spaces(document.getElementById('form_id_tempform_view' + form_view));
					break;
				}
		}
	
		if(form_view==0)
		{	alert("The pages are closed");
			return;
		}
		
		if(document.getElementById('editing_id').value)
		{
			i=document.getElementById('editing_id').value;		
			document.getElementById('editing_id').value="";
			tr=document.getElementById(i);
			destroyChildren(tr);
			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_section_break("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//				img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//				img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//				img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
		
			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
      ///////////////////////////////////////////////////////////////////////////////////////////////
			var in_editor = document.createElement("td");
					in_editor.setAttribute("id", i+"_element_sectionform_id_temp");
         			in_editor.setAttribute("align", 'left');
					in_editor.setAttribute("valign", "top");
					in_editor.setAttribute("colspan", "100");
					in_editor.setAttribute('class', 'toolbar_padding');
					
	
		if(document.getElementById('form_maker_editor').style.display=="none")
		{
				ifr_id=document.getElementsByTagName("iframe")[id_ifr_editor].id;
				ifr=getIFrameDocument(ifr_id);
				in_editor.innerHTML=ifr.body.innerHTML;
		}
		else
		{
				in_editor.innerHTML=document.getElementById('form_maker_editor').value;
		}
			
			var label = document.createElement('span');
					label.setAttribute("id", i+"_element_labelform_id_temp");
					label.innerHTML = "custom_"+i;
					label.style.cssText = 'display:none';
					
			td_EDIT.appendChild(label);
			tr.appendChild(in_editor);
			tr.appendChild(td_X);
			tr.appendChild(td_EDIT);
			tr.appendChild(td_DUBLICATE);
			j=2;
		}
		else
		{
			i=gen;
			gen++;
			
			var tr = document.createElement('tr');
				tr.setAttribute("id", i);
				tr.setAttribute("class", "wdform_tr_section_break");
				tr.setAttribute("type", "type_section_break");
				
				
			var select_ = document.getElementById('sel_el_pos');
			var option = document.createElement('option');
				option.setAttribute("id", i+"_sel_el_pos");
				option.setAttribute("value", i);
				option.innerHTML="custom_"+i;
				
			table=document.getElementById('form_id_tempform_view'+form_view);

			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_section_break("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//				img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//				img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//				img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
					
			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
///////////////////////////////////////////////////////////////////////////////////////////////
			var in_editor = document.createElement("td");
					in_editor.setAttribute("id", i+"_element_sectionform_id_temp");
         			in_editor.setAttribute("align", 'left');
					in_editor.setAttribute("valign", "top");
					in_editor.setAttribute("colspan", "100");
					in_editor.setAttribute('class', 'toolbar_padding');
					


		if(document.getElementById('form_maker_editor').style.display=="none")
		{
				ifr_id=document.getElementsByTagName("iframe")[id_ifr_editor].id;
				ifr=getIFrameDocument(ifr_id)
				in_editor.innerHTML=ifr.body.innerHTML;
		}
		else
		{
				in_editor.innerHTML=document.getElementById('form_maker_editor').value;
		}
			
			
			
			var label = document.createElement('span');
					label.setAttribute("id", i+"_element_labelform_id_temp");
					label.innerHTML = "custom_"+i;
					label.style.cssText = 'display:none';
					
			td_EDIT.appendChild(label);
			tr.appendChild(in_editor);

			tr.appendChild(td_X);
			tr.appendChild(td_EDIT);
			tr.appendChild(td_DUBLICATE);

			
				beforeTr=table.lastChild;
				table.insertBefore(tr, beforeTr);
				
		tr=document.createElement('tr');
			tr.setAttribute('class','wdform_tr1');
		td=document.createElement('td');
			td.setAttribute('class','wdform_td1');
		table_min=document.createElement('table');
			table_min.setAttribute('class','wdform_table2');
		tbody_min=document.createElement('tbody');
			tbody_min.setAttribute('class','wdform_tbody2');
		
		table_min.appendChild(tbody_min);
		td.appendChild(table_min);
		tr.appendChild(td);
		
				beforeTr=table.lastChild;
				table.insertBefore(tr, beforeTr);
				
			j=2;
			
						

		
		}

	close_window();
	return;
	}

	
	if(document.getElementById("element_type").value=="type_page_navigation")
	{
		document.getElementById("pages").setAttribute('show_title',document.getElementById("el_show_title_input").checked);
		document.getElementById("pages").setAttribute('show_numbers',document.getElementById("el_show_numbers_input").checked);
	
		if(document.getElementById("el_pagination_steps").checked)
			{
				document.getElementById("pages").setAttribute('type','steps');
				make_page_steps_front();
			}
		else
			if(document.getElementById("el_pagination_percentage").checked)
			{
				document.getElementById("pages").setAttribute('type','percentage');
				make_page_percentage_front();
			}
			else
			{
				document.getElementById("pages").setAttribute('type','none');
				make_page_none_front();
			}
		
		refresh_page_numbers();
		close_window() ;
		
		return;

	}

	if(document.getElementById("element_type").value=="type_page_break")
	{
		
		
		
		if(document.getElementById("editing_id").value)
		{	
			i=document.getElementById("editing_id").value;
			form_view_element	=document.getElementById('form_id_tempform_view'+i);
			page_title			=document.getElementById('_div_between').getAttribute('page_title');
			next_title			=document.getElementById('_div_between').getAttribute('next_title');
			next_type			=document.getElementById('_div_between').getAttribute('next_type');
			next_class			=document.getElementById('_div_between').getAttribute('next_class');
			next_checkable		=document.getElementById('_div_between').getAttribute('next_checkable');
			previous_title		=document.getElementById('_div_between').getAttribute('previous_title');
			previous_type		=document.getElementById('_div_between').getAttribute('previous_type');
			previous_class		=document.getElementById('_div_between').getAttribute('previous_class');
			previous_checkable	=document.getElementById('_div_between').getAttribute('previous_checkable');
			form_view_element.setAttribute('next_title',next_title);
			form_view_element.setAttribute('next_type',next_type);
			form_view_element.setAttribute('next_class',next_class);
			form_view_element.setAttribute('next_checkable',next_checkable);
			form_view_element.setAttribute('previous_title',previous_title);
			form_view_element.setAttribute('previous_type',previous_type);
			form_view_element.setAttribute('previous_class',previous_class);
			form_view_element.setAttribute('previous_checkable',previous_checkable);
			form_view_element.setAttribute('page_title',page_title);
			
			var input = document.getElementById('_div_between'); 
			atr=input.attributes;
			for(v=0;v<30;v++)
				if(atr[v] )
				{
					if(atr[v].name.indexOf("add_")==0)
					{
						form_view_element.setAttribute(atr[v].name,atr[v].value);
					}
				}
				
			if(form_view_count!=1)
				generate_page_nav(form_view);
			
			close_window() ;
			return;
		}
		else
		{	

			for(t=form_view_max; t>0; t--)
			{
				if(document.getElementById('form_id_tempform_view'+t))
				{
						form_view=t;
						break;
				}
			}
		
		
		

			if(form_view_count==1)
			{
				
				var img_EDIT = document.createElement("img");
						img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
						img_EDIT.setAttribute("title", "Edit the pagination options");
						img_EDIT.style.cssText = "margin-left:40px; cursor:pointer";
						img_EDIT.setAttribute("onclick", 'el_page_navigation()');
            img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
            img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
						
				var td_EDIT = document.getElementById("edit_page_navigation");
						td_EDIT.appendChild(img_EDIT);
				
				document.getElementById('page_navigation').appendChild(td_EDIT);

			}
		
		old_to_gen=form_view;
		
		form_view_max++;
		form_view_count++;
		form_view=form_view_max;
		
		table=document.createElement('table');
			table.setAttribute('cellpadding','4');
			table.setAttribute('cellspacing','0');
			table.setAttribute('class','wdform_table1');
			table.style.cssText = "border-top:1px solid black";
 
 
		tbody=document.createElement('tbody');
			tbody.setAttribute('id','form_id_tempform_view'+form_view);
			tbody.setAttribute('page_title','Untitled Page');
			tbody.setAttribute('class','wdform_tbody1');
			
		tbody_img=document.createElement('tbody');
			tbody_img.setAttribute('id','form_id_tempform_view_img'+form_view);
			tbody_img.style.cssText = "float:right";
			
		tr_img=document.createElement('tr');
			tr_img.setAttribute('valign','middle');
		td_title=document.createElement('td');
			td_title.setAttribute('width','0%');
		td_img=document.createElement('td');
			td_img.setAttribute('align','right');
			
		var	img=document.createElement('img');
			img.setAttribute('src',plugin_url+'/images/minus.png');
			img.setAttribute('title','Show or hide the page');
			img.setAttribute("class", "page_toolbar");
			img.setAttribute('id','show_page_img_'+form_view);
			img.setAttribute('onClick','show_or_hide("'+form_view+'")');
      img.setAttribute("onmouseover", 'chnage_icons_src(this,"minus")');
			img.setAttribute("onmouseout", 'chnage_icons_src(this,"minus")');

			
		var img_X = document.createElement("img");
			img_X.setAttribute("src", plugin_url+"/images/page_delete.png");
			img_X.setAttribute('title','Delete the page');
			img_X.setAttribute("class", "page_toolbar");
			img_X.setAttribute("onclick", 'remove_page("'+form_view+'")');
      img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"page_delete")');
			img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"page_delete")');
					
		var td_X = document.createElement("td");
			td_X.appendChild(img_X);
			
		var img_X_all = document.createElement("img");
			img_X_all.setAttribute("src", plugin_url+"/images/page_delete_all.png");
			img_X_all.setAttribute('title','Delete the page with fields');
			img_X_all.setAttribute("class", "page_toolbar");
			img_X_all.setAttribute("onclick", 'remove_page_all("'+form_view+'")');
      img_X_all.setAttribute("onmouseover", 'chnage_icons_src(this,"page_delete_all")');
			img_X_all.setAttribute("onmouseout", 'chnage_icons_src(this,"page_delete_all")');
					
		var td_X_all = document.createElement("td");
			td_X_all.appendChild(img_X_all);
			
		var img_EDIT = document.createElement("img");
			img_EDIT.setAttribute("src", plugin_url+"/images/page_edit.png");
			img_EDIT.setAttribute('title','Edit the page');
			img_EDIT.setAttribute("class", "page_toolbar");
			img_EDIT.setAttribute("onclick", 'edit_page_break("'+form_view+'")');
      img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"page_edit")');
			img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"page_edit")');
					
		var td_EDIT = document.createElement("td");
			td_EDIT.appendChild(img_EDIT);			
			
		td_img.appendChild(img);
		tr_img.appendChild(td_title);
		tr_img.appendChild(td_img);
		tr_img.appendChild(td_X);
		tr_img.appendChild(td_X_all);
		tr_img.appendChild(td_EDIT);
		tbody_img.appendChild(tr_img);
			
			
		tr=document.createElement('tr');
			tr.setAttribute('class','wdform_tr1');
		td=document.createElement('td');
			td.setAttribute('class','wdform_td1');
			
			
		tr_page_nav=document.createElement('tr');
			tr_page_nav.setAttribute('valign','top');
			tr_page_nav.setAttribute('class','wdform_footer');
			
		td_page_nav=document.createElement('td');
			td_page_nav.setAttribute('colspan','100');
			
		table_min_page_nav=document.createElement('table');
			table_min_page_nav.setAttribute('width','100%');
			
		tbody_min_page_nav=document.createElement('tbody');
		tr_min_page_nav=document.createElement('tr');
			tr_min_page_nav.setAttribute('id','form_id_temppage_nav'+form_view);
			
		table_min=document.createElement('table');
			table_min.setAttribute('class','wdform_table2');
		tbody_min=document.createElement('tbody');
			tbody_min.setAttribute('class','wdform_tbody2');
			
		table_min.appendChild(tbody_min);
		td.appendChild(table_min);
		tr.appendChild(td);
		tbody_min_page_nav.appendChild(tr_min_page_nav);
		table_min_page_nav.appendChild(tbody_min_page_nav);
		td_page_nav.appendChild(table_min_page_nav);
		tr_page_nav.appendChild(td_page_nav);
		tbody.appendChild(tr);
		tbody.appendChild(tr_page_nav);
		table.appendChild(tbody);
		table.appendChild(tbody_img);
		
		document.getElementById('take').appendChild(table);
		
		
		
		
		
		
		
	
		form_view_element	=document.getElementById('form_id_tempform_view'+form_view);
		page_title			=document.getElementById('_div_between').getAttribute('page_title');
		next_title			=document.getElementById('_div_between').getAttribute('next_title');
		next_type			=document.getElementById('_div_between').getAttribute('next_type');
		next_class			=document.getElementById('_div_between').getAttribute('next_class');
		next_checkable		=document.getElementById('_div_between').getAttribute('next_checkable');
		previous_title		=document.getElementById('_div_between').getAttribute('previous_title');
		previous_type		=document.getElementById('_div_between').getAttribute('previous_type');
		previous_class		=document.getElementById('_div_between').getAttribute('previous_class');
		previous_checkable	=document.getElementById('_div_between').getAttribute('previous_checkable');
		form_view_element.setAttribute('next_title',next_title);
		form_view_element.setAttribute('next_type',next_type);
		form_view_element.setAttribute('next_class',next_class);
		form_view_element.setAttribute('next_checkable',next_checkable);
		form_view_element.setAttribute('previous_title',previous_title);
		form_view_element.setAttribute('previous_type',previous_type);
		form_view_element.setAttribute('previous_class',previous_class);
		form_view_element.setAttribute('previous_checkable',previous_checkable);
		form_view_element.setAttribute('page_title',page_title);
			
		
		var input = document.getElementById('_div_between'); 
		atr=input.attributes;
		
		for(v=0;v<30;v++)
			if(atr[v] )
			{
				if(atr[v].name.indexOf("add_")==0)
				{
					form_view_element.setAttribute(atr[v].name,atr[v].value);
				}
			}
			
	if(form_view_count==2)
	{
		generate_page_nav(form_view);
		generate_page_nav(old_to_gen);
	/*	show_form_view(form_view);
		show_form_view(old_to_gen);*/
	}
	else
		generate_page_nav(form_view);

		close_window() ;

		return;
		
		}  
		
	}
	
	form_view=0;
	for(t=form_view_max; t>0; t--)
	{
		if(document.getElementById('form_id_tempform_view'+t))
			if(jQuery("#form_id_tempform_view"+t).is(":visible"))
			{
				form_view=t;
				break;
			}
	}

	if(form_view==0)
	{	alert("The pages are closed");
		return;
	}

	
	if(document.getElementById('main_editor').style.display=="block")
	{
		if(document.getElementById('editing_id').value)
		{
			i=document.getElementById('editing_id').value;		
			document.getElementById('editing_id').value="";
			tr=document.getElementById(i);
			destroyChildren(tr);
			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_row("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
			var img_RIGHT = document.createElement("img");
					img_RIGHT.setAttribute("src", plugin_url+"/images/right.png");
					img_RIGHT.setAttribute("title", "Move the field to the right");
//					img_RIGHT.setAttribute("height", "17");
					img_RIGHT.style.cssText = "cursor:pointer";
					img_RIGHT.setAttribute("onclick", 'right_row("'+i+'")');
          img_RIGHT.setAttribute("onmouseover", 'chnage_icons_src(this,"right")');
					img_RIGHT.setAttribute("onmouseout", 'chnage_icons_src(this,"right")');
					
			var td_RIGHT = document.createElement("td");
					td_RIGHT.setAttribute("id", "right_"+i);
					td_RIGHT.setAttribute("valign", "middle");
					td_RIGHT.setAttribute("class", "element_toolbar");
					td_RIGHT.appendChild(img_RIGHT);
					
			var img_LEFT = document.createElement("img");
					img_LEFT.setAttribute("src", plugin_url+"/images/left.png");
					img_LEFT.setAttribute("title", "Move the field to the left");
//					img_LEFT.setAttribute("height", "17");
					img_LEFT.style.cssText = "margin:2px;cursor:pointer";
					img_LEFT.setAttribute("onclick", 'left_row("'+i+'")');
          img_LEFT.setAttribute("onmouseover", 'chnage_icons_src(this,"left")');
					img_LEFT.setAttribute("onmouseout", 'chnage_icons_src(this,"left")');
					
			var td_LEFT = document.createElement("td");
					td_LEFT.setAttribute("id", "left_"+i);
					td_LEFT.setAttribute("valign", "middle");
					td_LEFT.setAttribute("class", "element_toolbar");
					td_LEFT.appendChild(img_LEFT);
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//					img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
		
			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
///////////////////////////////////////////////////////////////////////////////////////////////
			var in_editor = document.createElement("td");
					in_editor.setAttribute("id", i+"_element_sectionform_id_temp");
         			in_editor.setAttribute("align", 'left');
					in_editor.setAttribute("valign", "top");
					in_editor.setAttribute("colspan", "2");
					in_editor.setAttribute('class', 'toolbar_padding');
					

		if(document.getElementById('form_maker_editor').style.display=="none")
		{
				ifr_id=document.getElementsByTagName("iframe")[id_ifr_editor].id;
				ifr=getIFrameDocument(ifr_id);
				in_editor.innerHTML=ifr.body.innerHTML;
		}
		else
		{
				in_editor.innerHTML=document.getElementById('form_maker_editor').value;
		}
			
			var label = document.createElement('span');
					label.setAttribute("id", i+"_element_labelform_id_temp");
					label.innerHTML = "custom_"+i;
					label.style.cssText = 'display:none';
					
			td_EDIT.appendChild(label);
			tr.appendChild(in_editor);
			tr.appendChild(td_X);
			tr.appendChild(td_LEFT);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tr.appendChild(td_RIGHT);
			tr.appendChild(td_EDIT);
			tr.appendChild(td_DUBLICATE);
			tr.appendChild(td_PAGEUP);
			tr.appendChild(td_PAGEDOWN);
			j=2;
			;
		}
		else
		{
			i=gen;
			gen++;
			
			var tr = document.createElement('tr');
				tr.setAttribute("id", i);
				tr.setAttribute("type", "type_editor");
				
				
			var select_ = document.getElementById('sel_el_pos');
			var option = document.createElement('option');
				option.setAttribute("id", i+"_sel_el_pos");
				option.setAttribute("value", i);
				option.innerHTML="custom_"+i;
				
			l=document.getElementById('form_id_tempform_view'+form_view).childNodes.length;
			if(document.getElementById('form_id_tempform_view'+form_view).firstChild.nodeType==3)
			{
				table=document.getElementById('form_id_tempform_view'+form_view).childNodes[l-3].childNodes[1].childNodes[1].childNodes[1];
			}
			else
			{
				table=document.getElementById('form_id_tempform_view'+form_view).childNodes[l-2].firstChild.firstChild.firstChild;
			}

			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_row("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
			var img_RIGHT = document.createElement("img");
					img_RIGHT.setAttribute("src", plugin_url+"/images/right.png");
					img_RIGHT.setAttribute("title", "Move the field to the right");
//					img_RIGHT.setAttribute("height", "17");
					img_RIGHT.style.cssText = "cursor:pointer";
					img_RIGHT.setAttribute("onclick", 'right_row("'+i+'")');
          img_RIGHT.setAttribute("onmouseover", 'chnage_icons_src(this,"right")');
					img_RIGHT.setAttribute("onmouseout", 'chnage_icons_src(this,"right")');
					
			var td_RIGHT = document.createElement("td");
					td_RIGHT.setAttribute("id", "right_"+i);
					td_RIGHT.setAttribute("valign", "middle");
					td_RIGHT.setAttribute("class", "element_toolbar");
					td_RIGHT.appendChild(img_RIGHT);
					
			var img_LEFT = document.createElement("img");
					img_LEFT.setAttribute("src", plugin_url+"/images/left.png");
					img_LEFT.setAttribute("title", "Move the field to the left");
//					img_LEFT.setAttribute("height", "17");
					img_LEFT.style.cssText = "margin:2px;cursor:pointer";
					img_LEFT.setAttribute("onclick", 'left_row("'+i+'")');
          img_LEFT.setAttribute("onmouseover", 'chnage_icons_src(this,"left")');
					img_LEFT.setAttribute("onmouseout", 'chnage_icons_src(this,"left")');
					
			var td_LEFT = document.createElement("td");
					td_LEFT.setAttribute("id", "left_"+i);
					td_LEFT.setAttribute("valign", "middle");
					td_LEFT.setAttribute("class", "element_toolbar");
					td_LEFT.appendChild(img_LEFT);
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//					img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
					
			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
///////////////////////////////////////////////////////////////////////////////////////////////
			var in_editor = document.createElement("td");
					in_editor.setAttribute("id", i+"_element_sectionform_id_temp");
         			in_editor.setAttribute("align", 'left');
					in_editor.setAttribute("valign", "top");
					in_editor.setAttribute("colspan", "2");
					in_editor.setAttribute('class', 'toolbar_padding');
					


		if(document.getElementById('form_maker_editor').style.display=="none")
		{
				ifr_id=document.getElementsByTagName("iframe")[id_ifr_editor].id;
				ifr=getIFrameDocument(ifr_id)
				in_editor.innerHTML=ifr.body.innerHTML;
		}
		else
		{
				in_editor.innerHTML=document.getElementById('form_maker_editor').value;
		}
			
			
			
			var label = document.createElement('span');
					label.setAttribute("id", i+"_element_labelform_id_temp");
					label.innerHTML = "custom_"+i;
					label.style.cssText = 'display:none';
					
			td_EDIT.appendChild(label);
			tr.appendChild(in_editor);

			tr.appendChild(td_X);
			tr.appendChild(td_LEFT);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tr.appendChild(td_RIGHT);
			tr.appendChild(td_EDIT);
			tr.appendChild(td_DUBLICATE);
			tr.appendChild(td_PAGEUP);
			tr.appendChild(td_PAGEDOWN);

			if(document.getElementById('pos_end').checked)
			{
				table.appendChild(tr);
			}
			if(document.getElementById('pos_begin').checked)
			{	
				table.insertBefore(tr, table.firstChild);
			}
			if(document.getElementById('pos_before').checked)
			{
				beforeTr=document.getElementById(document.getElementById('sel_el_pos').value);
				table=beforeTr.parentNode;
				beforeOption=document.getElementById(document.getElementById('sel_el_pos').value+'_sel_el_pos');
				table.insertBefore(tr, beforeTr);
				select_.insertBefore(option, beforeOption);
			}
			j=2;
			;
		
		}

	close_window();
	}


	else
	if(document.getElementById('show_table').innerHTML)
	{
		
		if(document.getElementById('editing_id').value)
			i=document.getElementById('editing_id').value;		
		else
			i=gen;
			
		type=document.getElementById("element_type").value;
		if(type=="type_hidden")
		{
			if(document.getElementById(i+'_elementform_id_temp').name=="")
			{
				alert("The name of the field is required.");
				return;
			}
		}
		
		if(type=="type_map")
		{
			if_gmap_updateMap(i);
		}
		
		if(type=="type_mark_map")
		{
			if_gmap_updateMap(i);
		}
	
		if(document.getElementById(i+'_element_labelform_id_temp').innerHTML)
		{

		if(document.getElementById('editing_id').value)
		{
			Disable();
			i=document.getElementById('editing_id').value;		
			in_lab=false;
			labels_array=new Array();
			for(w=0; w<gen;w++)
			{	
				if(w!=i)
				if(document.getElementById(w+'_element_labelform_id_temp'))
					labels_array.push(document.getElementById(w+'_element_labelform_id_temp').innerHTML);
			}			
	
			for(t=0; t<labels_array.length;t++)
			{	
			if(document.getElementById(i+'_element_labelform_id_temp').innerHTML==labels_array[t])
				{
					in_lab=true;
					break;
				}
			}
			if(in_lab)
			{
				alert('Sorry, the labels must be unique.');
				return;
			}
			else
			{
	
	
	
	
				document.getElementById('editing_id').value="";
	
				tr=document.getElementById(i);
	
				destroyChildren(tr);
				tr.setAttribute('type', type);
			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_row("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
			var img_RIGHT = document.createElement("img");
					img_RIGHT.setAttribute("src", plugin_url+"/images/right.png");
					img_RIGHT.setAttribute("title", "Move the field to the right");
//					img_RIGHT.setAttribute("height", "17");
					img_RIGHT.style.cssText = "cursor:pointer";
					img_RIGHT.setAttribute("onclick", 'right_row("'+i+'")');
          img_RIGHT.setAttribute("onmouseover", 'chnage_icons_src(this,"right")');
					img_RIGHT.setAttribute("onmouseout", 'chnage_icons_src(this,"right")');
					
			var td_RIGHT = document.createElement("td");
					td_RIGHT.setAttribute("id", "right_"+i);
					td_RIGHT.setAttribute("valign", "middle");
					td_RIGHT.setAttribute("class", "element_toolbar");
					td_RIGHT.appendChild(img_RIGHT);
					
			var img_LEFT = document.createElement("img");
					img_LEFT.setAttribute("src", plugin_url+"/images/left.png");
					img_LEFT.setAttribute("title", "Move the field to the left");
//					img_LEFT.setAttribute("height", "17");
					img_LEFT.style.cssText = "margin:2px;cursor:pointer";
					img_LEFT.setAttribute("onclick", 'left_row("'+i+'")');
          img_LEFT.setAttribute("onmouseover", 'chnage_icons_src(this,"left")');
					img_LEFT.setAttribute("onmouseout", 'chnage_icons_src(this,"left")');
					
			var td_LEFT = document.createElement("td");
					td_LEFT.setAttribute("id", "left_"+i);
					td_LEFT.setAttribute("valign", "middle");
					td_LEFT.setAttribute("class", "element_toolbar");
					td_LEFT.appendChild(img_LEFT);
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//					img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);
					
			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
	///////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
				if(document.getElementById('edit_for_label_position_top'))
	
					if(document.getElementById('edit_for_label_position_top').checked)
	
					{
						var add1 = document.getElementById(i+'_label_sectionform_id_temp');
						var add2 = document.getElementById(i+'_element_sectionform_id_temp');
							add2.className +=" toolbar_padding";
							//add2.setAttribute('class', 'toolbar_padding');
						tr.appendChild(add1);
						tr.appendChild(add2);
	
					}
	
					else	
	
					{
	
						var td1 = document.createElement('td');
							td1.setAttribute("colspan", "2");
							td1.setAttribute("id", i+'_label_and_element_sectionform_id_temp');
							td1.setAttribute('class', 'toolbar_padding');
						var add = document.getElementById(i+'_elemet_tableform_id_temp');
						
							td1.appendChild(add);
							tr.appendChild(td1);
	
					}
	
				else
	
					{
						var td1 = document.createElement('td');
							td1.setAttribute("colspan", "2");
							td1.setAttribute('class', 'toolbar_padding');
							td1.setAttribute("id", i+'_label_and_element_sectionform_id_temp');
		
						var add = document.getElementById(i+'_elemet_tableform_id_temp');
		
								
		
						td1.appendChild(add);
		
						tr.appendChild(td1);
	
					}
	
	
	
				tr.appendChild(td_X);
	
				tr.appendChild(td_LEFT);
				tr.appendChild(td_UP);
	
				tr.appendChild(td_DOWN);
				tr.appendChild(td_RIGHT);
	
				tr.appendChild(td_EDIT);
				if(type!="type_captcha" && type!="type_recaptcha")
				{
					tr.appendChild(td_DUBLICATE);
				}
				else			
				{
					td_DUBLICATE.removeChild(img_DUBLICATE);
					tr.appendChild(td_DUBLICATE);
				}
				tr.appendChild(td_PAGEUP);
				tr.appendChild(td_PAGEDOWN);
	
				j=2;
	
				close_window() ;
				
			call(i,key);
			}
		}
		else
		{	
		i=gen;
		in_lab=false;
		labels_array=new Array();
		for(w=0; w<gen;w++)
		{	
			if(document.getElementById(w+'_element_labelform_id_temp'))
				labels_array.push(document.getElementById(w+'_element_labelform_id_temp').innerHTML);
		}			
		for(t=0; t<labels_array.length;t++)
		{	
		if(document.getElementById(i+'_element_labelform_id_temp').innerHTML==labels_array[t])
			{
				in_lab=true;
				break;
			}
		}
		if(in_lab)
		{
			alert('Sorry, the labels must be unique.');
			return
		}
		else
		{
			
			if(type=="type_address")
				gen=gen+6;
			else
				gen++;			
				
			l=document.getElementById('form_id_tempform_view'+form_view).childNodes.length;
			if(document.getElementById('form_id_tempform_view'+form_view).firstChild.nodeType==3)
			{
				table=document.getElementById('form_id_tempform_view'+form_view).childNodes[l-3].childNodes[1].childNodes[1].childNodes[1];
			}
			else
			{
				table=document.getElementById('form_id_tempform_view'+form_view).childNodes[l-2].firstChild.firstChild.firstChild;
			}
					
			var tr = document.createElement('tr');
				tr.setAttribute("id", i);
				tr.setAttribute("type", type);

		
			var select_ = document.getElementById('sel_el_pos');
			var option = document.createElement('option');
				option.setAttribute("id", i+"_sel_el_pos");
				option.setAttribute("value", i);
				option.innerHTML=document.getElementById(i+'_element_labelform_id_temp').innerHTML;

			var img_X = document.createElement("img");
					img_X.setAttribute("src", plugin_url+"/images/delete_el.png");
					// img_X.setAttribute("height", "20");
					img_X.setAttribute("title", "Remove the field");
					img_X.style.cssText = "cursor:pointer; margin:2px";
					img_X.setAttribute("onclick", 'remove_row("'+i+'")');
          img_X.setAttribute("onmouseover", 'chnage_icons_src(this,"delete_el")');
					img_X.setAttribute("onmouseout", 'chnage_icons_src(this,"delete_el")');
					
			var td_X = document.createElement("td");
					td_X.setAttribute("id", "X_"+i);
					td_X.setAttribute("valign", "middle");
					td_X.setAttribute("align", "right");
					td_X.setAttribute("class", "element_toolbar");
					td_X.appendChild(img_X);
//image pah@
			var img_UP = document.createElement("img");
					img_UP.setAttribute("src", plugin_url+"/images/up.png");
					img_UP.setAttribute("title", "Move the field up");
//					img_UP.setAttribute("height", "17");
					img_UP.style.cssText = "cursor:pointer";
					img_UP.setAttribute("onclick", 'up_row("'+i+'")');
          img_UP.setAttribute("onmouseover", 'chnage_icons_src(this,"up")');
					img_UP.setAttribute("onmouseout", 'chnage_icons_src(this,"up")');
					
			var td_UP = document.createElement("td");
					td_UP.setAttribute("id", "up_"+i);
					td_UP.setAttribute("valign", "middle");
					td_UP.setAttribute("class", "element_toolbar");
					td_UP.appendChild(img_UP);
					
			var img_DOWN = document.createElement("img");
					img_DOWN.setAttribute("src", plugin_url+"/images/down.png");
					img_DOWN.setAttribute("title", "Move the field down");
//					img_DOWN.setAttribute("height", "17");
					img_DOWN.style.cssText = "margin:2px;cursor:pointer";
					img_DOWN.setAttribute("onclick", 'down_row("'+i+'")');
          img_DOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"down")');
					img_DOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"down")');
					
			var td_DOWN = document.createElement("td");
					td_DOWN.setAttribute("id", "down_"+i);
					td_DOWN.setAttribute("valign", "middle");
					td_DOWN.setAttribute("class", "element_toolbar");
					td_DOWN.appendChild(img_DOWN);
					
			var img_RIGHT = document.createElement("img");
					img_RIGHT.setAttribute("src", plugin_url+"/images/right.png");
					img_RIGHT.setAttribute("title", "Move the field to the right");
//					img_RIGHT.setAttribute("height", "17");
					img_RIGHT.style.cssText = "cursor:pointer";
					img_RIGHT.setAttribute("onclick", 'right_row("'+i+'")');
          img_RIGHT.setAttribute("onmouseover", 'chnage_icons_src(this,"right")');
					img_RIGHT.setAttribute("onmouseout", 'chnage_icons_src(this,"right")');
					
			var td_RIGHT = document.createElement("td");
					td_RIGHT.setAttribute("id", "right_"+i);
					td_RIGHT.setAttribute("valign", "middle");
					td_RIGHT.setAttribute("class", "element_toolbar");
					td_RIGHT.appendChild(img_RIGHT);
					
			var img_LEFT = document.createElement("img");
					img_LEFT.setAttribute("src", plugin_url+"/images/left.png");
					img_LEFT.setAttribute("title", "Move the field to the left");
//					img_LEFT.setAttribute("height", "17");
					img_LEFT.style.cssText = "margin:2px;cursor:pointer";
					img_LEFT.setAttribute("onclick", 'left_row("'+i+'")');
          img_LEFT.setAttribute("onmouseover", 'chnage_icons_src(this,"left")');
					img_LEFT.setAttribute("onmouseout", 'chnage_icons_src(this,"left")');
					
			var td_LEFT = document.createElement("td");
					td_LEFT.setAttribute("id", "left_"+i);
					td_LEFT.setAttribute("valign", "middle");
					td_LEFT.setAttribute("class", "element_toolbar");
					td_LEFT.appendChild(img_LEFT);
					
			var img_EDIT = document.createElement("img");
					img_EDIT.setAttribute("src", plugin_url+"/images/edit.png");
					img_EDIT.setAttribute("title", "Edit the field");
//					img_EDIT.setAttribute("height", "17");
					img_EDIT.style.cssText = "margin:2px;cursor:pointer";
					img_EDIT.setAttribute("onclick", 'edit("'+i+'")');
          img_EDIT.setAttribute("onmouseover", 'chnage_icons_src(this,"edit")');
					img_EDIT.setAttribute("onmouseout", 'chnage_icons_src(this,"edit")');
					
			var td_EDIT = document.createElement("td");
					td_EDIT.setAttribute("id", "edit_"+i);
					td_EDIT.setAttribute("valign", "middle");
					td_EDIT.setAttribute("class", "element_toolbar");
					td_EDIT.appendChild(img_EDIT);
		
			var img_DUBLICATE = document.createElement("img");
					img_DUBLICATE.setAttribute("src", plugin_url+"/images/dublicate.png");
					img_DUBLICATE.setAttribute("title", "Duplicate the field");
					img_DUBLICATE.style.cssText = "margin:2px;cursor:pointer";
					img_DUBLICATE.setAttribute("onclick", 'dublicate("'+i+'")');
          img_DUBLICATE.setAttribute("onmouseover", 'chnage_icons_src(this,"dublicate")');
					img_DUBLICATE.setAttribute("onmouseout", 'chnage_icons_src(this,"dublicate")');
					
			var td_DUBLICATE = document.createElement("td");
					td_DUBLICATE.setAttribute("id", "dublicate_"+i);
					td_DUBLICATE.setAttribute("valign", "middle");
					td_DUBLICATE.setAttribute("class", "element_toolbar");
					td_DUBLICATE.appendChild(img_DUBLICATE);

			var img_PAGEUP = document.createElement("img");
					img_PAGEUP.setAttribute("src", plugin_url+"/images/page_up.png");
					img_PAGEUP.setAttribute("title", "Move the field to the upper page");
					img_PAGEUP.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEUP.setAttribute("onclick", 'page_up("'+i+'")');
          img_PAGEUP.setAttribute("onmouseover", 'chnage_icons_src(this,"page_up")');
					img_PAGEUP.setAttribute("onmouseout", 'chnage_icons_src(this,"page_up")');
					
			var td_PAGEDOWN = document.createElement("td");
					td_PAGEDOWN.setAttribute("id", "page_up_"+i);
					td_PAGEDOWN.setAttribute("valign", "middle");
					td_PAGEDOWN.setAttribute("class", "element_toolbar");
					td_PAGEDOWN.appendChild(img_PAGEUP);
					
			var img_PAGEDOWN = document.createElement("img");
					img_PAGEDOWN.setAttribute("src", plugin_url+"/images/page_down.png");
					img_PAGEDOWN.setAttribute("title", "Move the field to the lower  page");
					img_PAGEDOWN.style.cssText = "margin:2px;cursor:pointer";
					img_PAGEDOWN.setAttribute("onclick", 'page_down("'+i+'")');
          img_PAGEDOWN.setAttribute("onmouseover", 'chnage_icons_src(this,"page_down")');
					img_PAGEDOWN.setAttribute("onmouseout", 'chnage_icons_src(this,"page_down")');
					
			var td_PAGEUP = document.createElement("td");
					td_PAGEUP.setAttribute("id", "dublicate_"+i);
					td_PAGEUP.setAttribute("valign", "middle");
					td_PAGEUP.setAttribute("class", "element_toolbar");
					td_PAGEUP.appendChild(img_PAGEDOWN);
///////////////////////////////////////////////////////////////////////////////////////////////

			
			if(document.getElementById('edit_for_label_position_top'))
				if(document.getElementById('edit_for_label_position_top').checked)
				{
					var add1 = document.getElementById(i+'_label_sectionform_id_temp');
					var add2 = document.getElementById(i+'_element_sectionform_id_temp');
							add2.className +=" toolbar_padding";
						
						tr.appendChild(add1);
						tr.appendChild(add2);
				}
				else	
				{
					
					var td1 = document.createElement('td');
						td1.setAttribute("colspan", "2");
						td1.setAttribute("id", i+'_label_and_element_sectionform_id_temp');
						td1.setAttribute('class', 'toolbar_padding');
					var add = document.getElementById(i+'_elemet_tableform_id_temp');
							
						td1.appendChild(add);
						tr.appendChild(td1);
				}
			else	
			{
				var td1 = document.createElement('td');
					td1.setAttribute("colspan", "2");
					td1.setAttribute("id", i+'_label_and_element_sectionform_id_temp');
					td1.setAttribute('class', 'toolbar_padding');
				var add = document.getElementById(i+'_elemet_tableform_id_temp');
						
					td1.appendChild(add);
					tr.appendChild(td1);
			}
			tr.appendChild(td_X);
			tr.appendChild(td_LEFT);
			tr.appendChild(td_UP);
			tr.appendChild(td_DOWN);
			tr.appendChild(td_RIGHT);
			tr.appendChild(td_EDIT);
			
			if(type!="type_captcha" && type!="type_recaptcha")
			{
				tr.appendChild(td_DUBLICATE);
			}
			else			
			{
				td_DUBLICATE.removeChild(img_DUBLICATE);
				tr.appendChild(td_DUBLICATE);
			}
			
			tr.appendChild(td_PAGEUP);
			tr.appendChild(td_PAGEDOWN);
			
			if(document.getElementById('pos_end').checked)
			{
				table.appendChild(tr);
			}
			if(document.getElementById('pos_begin').checked)
			{	
				table.insertBefore(tr, table.firstChild);
			}
			if(document.getElementById('pos_before').checked)
			{
				beforeTr=document.getElementById(document.getElementById('sel_el_pos').value);
				table=beforeTr.parentNode;
				beforeOption=document.getElementById(document.getElementById('sel_el_pos').value+'_sel_el_pos');
				table.insertBefore(tr, beforeTr);
				select_.insertBefore(option, beforeOption);
			}
			j=2;
			close_window() ;
			;
		call(i,key);
		
		}
	}	
	}
		else
		{
			alert("The field label is required.");
			return;
		}
	
/*	undo_redo.push(document.getElementById('take').innerHTML);
	undo_redo_num++;*/
	}			
	else alert("Please select an element to add.");

}

function call(i,key) {
  need_enable = false;
  if (key==0) {
    edit(i);
    add('1');
  }
  need_enable = true;
}

function edit_page_break(id)
{
		enable2();
		
	document.getElementById('editing_id').value=id;

		form_view_element	=document.getElementById('form_id_tempform_view'+id);
		page_title			=form_view_element.getAttribute('page_title');
		if(form_view_element.getAttribute('next_title'))
		{
			next_title			=form_view_element.getAttribute('next_title');
			next_type			=form_view_element.getAttribute('next_type');
			next_class			=form_view_element.getAttribute('next_class');
			next_checkable		=form_view_element.getAttribute('next_checkable');
			previous_title		=form_view_element.getAttribute('previous_title');
			previous_type		=form_view_element.getAttribute('previous_type');
			previous_class		=form_view_element.getAttribute('previous_class');
			previous_checkable	=form_view_element.getAttribute('previous_checkable');
			w_title	=[ next_title, previous_title];
			w_type	=[next_type,previous_type];
			w_class	=[next_class,previous_class];
			w_check	=[next_checkable,previous_checkable];
		}
		else
		{
			w_title	=[ "Next","Previous"];
			w_type	=["button","button"];
			w_class	=["",""];
			w_check	=['true', 'true'];
		}
		
	
	
	//atrs=return_attributes('form_id_tempform_view'+id);
	w_attr_name=[];
	w_attr_value=[];
	type_page_break(id, page_title , w_title, w_type, w_class, w_check, w_attr_name, w_attr_value);

}

function edit(id) {
  if (need_enable) {
    enable2();
  }
	document.getElementById('editing_id').value=id;
	type=document.getElementById(id).getAttribute('type');
	
	
	//////////////////////////////parameter take
	k=0;
	
	w_choices=new Array();	
	w_choices_checked=new Array();
	w_choices_disabled=new Array();
	w_allow_other_num = 0;
  w_property = new Array();	
	w_property_type = new Array();	
	w_property_values = new Array();
	w_choices_price = new Array();
	t = 0;
	/////////shat handipox
	
	if(document.getElementById(id+'_element_labelform_id_temp').innerHTML)
		w_field_label=document.getElementById(id+'_element_labelform_id_temp').innerHTML;
		
	if(document.getElementById(id+'_label_and_element_sectionform_id_temp'))
		w_field_label_pos="top";
	else
		w_field_label_pos="left";
		
	if(document.getElementById(id+"_elementform_id_temp"))
	{
		s=document.getElementById(id+"_elementform_id_temp").style.width;
		 w_size=s.substring(0,s.length-2);
	}
	
	if(document.getElementById(id+"_requiredform_id_temp"))
	  	w_required=document.getElementById(id+"_requiredform_id_temp").value;
		
	if(document.getElementById(id+"_uniqueform_id_temp"))
	  	w_unique=document.getElementById(id+"_uniqueform_id_temp").value;
		
	if(document.getElementById(id+'_label_sectionform_id_temp'))
	{
		w_class=document.getElementById(id+'_label_sectionform_id_temp').getAttribute("class");
		if(!w_class)
			w_class="";
	}
		

	switch(type)
		{
			case 'type_editor':
			{
				w_editor=document.getElementById(id+"_element_sectionform_id_temp").innerHTML;
				type_editor(id, w_editor); break;
			}
			case 'type_section_break':
			{
				w_editor=document.getElementById(id+"_element_sectionform_id_temp").innerHTML;
				type_section_break(id, w_editor); break;
			}
			case 'type_text':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_text(id, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value); break;
			}
			case 'type_number':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_number(id, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value); break;
			}
			case 'type_password':
			{
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_password(id, w_field_label, w_field_label_pos, w_size, w_required, w_unique, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_textarea':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				s=document.getElementById(id+"_elementform_id_temp").style.height;
				w_size_h=s.substring(0,s.length-2);

				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_textarea(id, w_field_label, w_field_label_pos, w_size, w_size_h, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_phone':
			{
				w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value];
				w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title];
				s=document.getElementById(id+"_element_lastform_id_temp").style.width;
				w_size=s.substring(0,s.length-2);
				w_mini_labels= [document.getElementById(id+"_mini_label_area_code").innerHTML, document.getElementById(id+"_mini_label_phone_number").innerHTML];
				atrs=return_attributes(id+'_element_firstform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_phone(id, w_field_label, w_field_label_pos, w_size,  w_first_val, w_title, w_mini_labels, w_required, w_unique, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_name':
			{
				if(document.getElementById(id+'_element_middleform_id_temp'))
					w_name_format="extended";
				else
					w_name_format="normal";
        if (w_name_format == "normal") {
          w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value];
          w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title];
        }
        else {
          w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value, document.getElementById(id+"_element_titleform_id_temp").value, document.getElementById(id+"_element_middleform_id_temp").value];
          w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title, document.getElementById(id+"_element_titleform_id_temp").title,
          document.getElementById(id+"_element_middleform_id_temp").title];
        }
        if(document.getElementById(id+"_mini_label_title"))
				w_mini_title = document.getElementById(id+"_mini_label_title").innerHTML;
				else
				w_mini_title = "Title";
				
				
				
				if(document.getElementById(id+"_mini_label_middle"))
				w_mini_middle = document.getElementById(id+"_mini_label_middle").innerHTML;
				else
				w_mini_middle = "Middle";
				
				w_mini_labels = [w_mini_title, document.getElementById(id+"_mini_label_first").innerHTML,document.getElementById(id+"_mini_label_last").innerHTML, w_mini_middle];
				s=document.getElementById(id+"_element_firstform_id_temp").style.width;
				w_size=s.substring(0,s.length-2);
				atrs=return_attributes(id+'_element_firstform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_name(id, w_field_label, w_field_label_pos,w_first_val, w_title, w_mini_labels, w_size, w_name_format, w_required, w_unique, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_address':
			{
				s=document.getElementById(id+"_div_address").style.width;
				w_size=s.substring(0,s.length-2);
        if(document.getElementById(id+"_mini_label_street1")) {
					w_street1= document.getElementById(id+"_mini_label_street1").innerHTML;
        }
				else {
          if (document.getElementById(id+"_street1form_id_temp")) {
            w_street1 = document.getElementById(id+"_street1form_id_temp").value;
          }
          else {
            w_street1 = '';
          }
        }
				if (document.getElementById(id+"_mini_label_street2")) {
					w_street2= document.getElementById(id+"_mini_label_street2").innerHTML;
        }
				else {
          if (document.getElementById(id+"_street2form_id_temp")) {
            w_street2 = document.getElementById(id+"_street2form_id_temp").value;
          }
          else {
            w_street2 = '';
          }
        }
					
				if (document.getElementById(id+"_mini_label_city")) {
					w_city= document.getElementById(id+"_mini_label_city").innerHTML;
        }
				else {
          if (document.getElementById(id+"_cityform_id_temp")) {
            w_city = document.getElementById(id+"_cityform_id_temp").value;
          }
          else {
            w_city = '';
          }
        }

				if (document.getElementById(id+"_mini_label_state")) {
					w_state= document.getElementById(id+"_mini_label_state").innerHTML;
        }
				else {
          if (document.getElementById(id+"_stateform_id_temp")) {
            w_state = document.getElementById(id+"_stateform_id_temp").value;
          }
          else {
            w_state = '';
          }
        }
				if (document.getElementById(id+"_mini_label_postal")) {
					w_postal= document.getElementById(id+"_mini_label_postal").innerHTML;
        }
				else {
          if (document.getElementById(id+"_postalform_id_temp")) {
            w_postal = document.getElementById(id+"_postalform_id_temp").value;
          }
          else {
            w_postal = '';
          }
        }
					
				if (document.getElementById(id+"_mini_label_country")) {
					w_country= document.getElementById(id+"_mini_label_country").innerHTML;
        }
				else {
          if (document.getElementById(id+"_countryform_id_temp")) {
            w_country = document.getElementById(id+"_countryform_id_temp").value;
          }
          else {
            w_country = '';
          }
        }			
					
				w_mini_labels=[w_street1, w_street2, w_city, w_state, w_postal, w_country];

				
				var disabled_input = document.getElementById(id+"_disable_fieldsform_id_temp");
				
					w_street1_dis= disabled_input.getAttribute('street1');
					w_street2_dis= disabled_input.getAttribute('street2');
					w_city_dis= disabled_input.getAttribute('city');
					w_state_dis= disabled_input.getAttribute('state');
					w_postal_dis= disabled_input.getAttribute('postal');
					w_country_dis= disabled_input.getAttribute('country');
				
						
				w_disabled_fields=[w_street1_dis, w_street2_dis, w_city_dis, w_state_dis, w_postal_dis, w_country_dis];

				atrs=return_attributes(id+'_street1form_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_address(id, w_field_label, w_field_label_pos, w_size, w_mini_labels, w_disabled_fields, w_required, w_class, w_attr_name, w_attr_value);
        disable_fields(id);
        break;
			}

			case 'type_submitter_mail':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				w_send=document.getElementById(id+"_sendform_id_temp").value;
		
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_submitter_mail(id, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_send, w_required, w_unique, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_checkbox': {
				w_randomize=document.getElementById(id+"_randomizeform_id_temp").value;
				w_allow_other=document.getElementById(id+"_allow_otherform_id_temp").value;
		
				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other'))
							if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other')=='1')
								w_allow_other_num=t;
						w_choices[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_choices_checked[t]=document.getElementById(id+"_elementform_id_temp"+k).checked;
						t++;
						v=k;
					}
          if(document.getElementById(id+"_rowcol_numform_id_temp").value)	
				{
				
                if(document.getElementById(id+'_table_little').getAttribute('for_hor'))
					w_flow="hor"	
				else
					w_flow="ver";				
				w_rowcol = 	document.getElementById(id+"_rowcol_numform_id_temp").value;
				}
				else
				{
				if(document.getElementById(id+'_hor'))
					w_flow="hor"	
				else
					w_flow="ver";
				
				w_rowcol = '';
				}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_checkbox(id, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_radio': {
        w_randomize=document.getElementById(id+"_randomizeform_id_temp").value;
				w_allow_other=document.getElementById(id+"_allow_otherform_id_temp").value;

				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other'))
							if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other')=='1')
								w_allow_other_num=t;
						w_choices[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_choices_checked[t]=document.getElementById(id+"_elementform_id_temp"+k).checked;
						t++;
						v=k;
					}
          if(document.getElementById(id+"_rowcol_numform_id_temp").value)	
				{
				
                if(document.getElementById(id+'_table_little').getAttribute('for_hor'))
					w_flow="hor"	
				else
					w_flow="ver";				
				w_rowcol = 	document.getElementById(id+"_rowcol_numform_id_temp").value;
				}
				else
				{
				if(document.getElementById(id+'_hor'))
					w_flow="hor"	
				else
					w_flow="ver";
				
				w_rowcol = '';
				}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_radio(id, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_star_rating':
			{
				w_star_amount  = document.getElementById(id+"_star_amountform_id_temp").value;
				w_field_label_col  = document.getElementById(id+"_star_colorform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_star_rating(id, w_field_label, w_field_label_pos, w_field_label_col, w_star_amount, w_required, w_class, w_attr_name, w_attr_value) ; break;
			}
			
			case 'type_scale_rating':
			{
				w_mini_labels  =[document.getElementById(id+"_mini_label_worst").innerHTML,document.getElementById(id+"_mini_label_best").innerHTML];	
			
				w_scale_amount = document.getElementById(id+"_scale_amountform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_scale_rating(id, w_field_label, w_field_label_pos, w_mini_labels,  w_scale_amount, w_required, w_class, w_attr_name, w_attr_value) ; break;
			}
			
			case 'type_spinner':
			{
				w_field_min_value  = document.getElementById(id+"_min_valueform_id_temp").value;
				w_field_max_value  = document.getElementById(id+"_max_valueform_id_temp").value;
				w_field_width  = document.getElementById(id+"_spinner_widthform_id_temp").value;
				w_field_step = document.getElementById(id+"_stepform_id_temp").value;
				w_field_value  = document.getElementById(id+"_elementform_id_temp").getAttribute("aria-valuenow");
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_spinner(id, w_field_label, w_field_label_pos, w_field_width, w_field_min_value, w_field_max_value, w_field_step, w_field_value, w_required, w_class, w_attr_name, w_attr_value) ; break;
			
			
			}
			
			case 'type_slider':
			{
				w_field_min_value  = document.getElementById(id+"_slider_min_valueform_id_temp").value;
				w_field_max_value  = document.getElementById(id+"_slider_max_valueform_id_temp").value;
				w_field_width  = document.getElementById(id+"_slider_widthform_id_temp").value;
				w_field_value  = document.getElementById(id+"_slider_valueform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_slider(id, w_field_label, w_field_label_pos,  w_field_width, w_field_min_value, w_field_max_value, w_field_value, w_required, w_class, w_attr_name, w_attr_value); break;
			}
			
			case 'type_range':
			{
				
				w_field_range_width  = document.getElementById(id+"_range_widthform_id_temp").value;
				w_field_range_step = document.getElementById(id+"_range_stepform_id_temp").value;
				
				w_field_value1  = document.getElementById(id+"_elementform_id_temp0").getAttribute("aria-valuenow");
				w_field_value2  = document.getElementById(id+"_elementform_id_temp1").getAttribute("aria-valuenow");
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_mini_labels = [document.getElementById(id+"_mini_label_from").innerHTML,document.getElementById(id+"_mini_label_to").innerHTML];
				type_range(id, w_field_label, w_field_label_pos, w_field_range_width, w_field_range_step, w_field_value1, w_field_value2, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value) ;  break;
			
			}
			case 'type_grading':
			{
			
				w_total = document.getElementById(id+"_grading_totalform_id_temp").value;
				w_items=[];
				
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp"+k))
					{
						
						w_items.push(document.getElementById(id+"_label_elementform_id_temp"+k).innerHTML);
						
					}
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_grading(id, w_field_label, w_field_label_pos, w_items, w_total, w_required, w_class, w_attr_name, w_attr_value) ; refresh_grading_items(id); break;
			
			
			}
			case 'type_matrix':
			{	
                w_rows=[];
				w_rows[0]="";
				for(k=1;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp"+k+"_0"))
					{
						
						w_rows.push(document.getElementById(id+"_label_elementform_id_temp"+k+"_0").innerHTML);
						
					}
			
			    w_columns=[];
				w_columns[0]="";
				for(k=1;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp0_"+k))
					{
						
						w_columns.push(document.getElementById(id+"_label_elementform_id_temp0_"+k).innerHTML);
						
					}
					
			w_field_input_type = document.getElementById(id+"_input_typeform_id_temp").value;		
					
			atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
			type_matrix(id, w_field_label, w_field_label_pos, w_field_input_type, w_rows, w_columns, w_required, w_class, w_attr_name, w_attr_value); refresh_matrix(id); break; 
			
			
			}
			case 'type_time':
			{	
				atrs=return_attributes(id+'_hhform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_hh=document.getElementById(id+'_hhform_id_temp').value;
				w_mm=document.getElementById(id+'_mmform_id_temp').value;
				if(document.getElementById(id+'_ssform_id_temp'))
				{
					w_ss=document.getElementById(id+'_ssform_id_temp').value;
					w_sec="1";
				}
				else
				{
					w_ss="";
					w_sec="0";
				}
				if(document.getElementById(id+'_am_pm_select'))
				{
					w_am_pm=document.getElementById(id+'_am_pmform_id_temp').value;
					w_time_type="12";
          w_mini_labels = [document.getElementById(id+'_mini_label_hh').innerHTML, document.getElementById(id+'_mini_label_mm').innerHTML, document.getElementById(id+'_mini_label_ss').innerHTML, document.getElementById(id+'_mini_label_am_pm').innerHTML];
				}
				else
				{
					w_am_pm=0;
					w_time_type="24";
          w_mini_labels = [document.getElementById(id+'_mini_label_hh').innerHTML, document.getElementById(id+'_mini_label_mm').innerHTML, document.getElementById(id+'_mini_label_ss').innerHTML,'AM/PM'];
				}
				type_time(id, w_field_label, w_field_label_pos, w_time_type, w_am_pm, w_sec, w_hh, w_mm, w_ss, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value); break;
			}
			case 'type_date':
			{	
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_date=document.getElementById(id+'_elementform_id_temp').value;
				w_format=document.getElementById(id+'_buttonform_id_temp').getAttribute("format");
				w_but_val=document.getElementById(id+'_buttonform_id_temp').value;
				type_date(id, w_field_label, w_field_label_pos, w_date, w_required, w_class, w_format, w_but_val, w_attr_name, w_attr_value); break;
			}
			case 'type_date_fields':
			{	
				atrs			=return_attributes(id+'_dayform_id_temp');
				w_attr_name		=atrs[0];
				w_attr_value	=atrs[1];
				w_day			=document.getElementById(id+'_dayform_id_temp').value;
				w_month			=document.getElementById(id+'_monthform_id_temp').value;
				w_year			=document.getElementById(id+'_yearform_id_temp').value;
				w_day_type		=document.getElementById(id+'_dayform_id_temp').tagName;
				w_month_type	=document.getElementById(id+'_monthform_id_temp').tagName;
				w_year_type		=document.getElementById(id+'_yearform_id_temp').tagName;
				w_day_label		=document.getElementById(id+'_day_label').innerHTML;
				w_month_label	=document.getElementById(id+'_month_label').innerHTML;
				w_year_label	=document.getElementById(id+'_year_label').innerHTML;
				
				s				=document.getElementById(id+'_dayform_id_temp').style.width;
				w_day_size		=s.substring(0,s.length-2);
				
				s				=document.getElementById(id+'_monthform_id_temp').style.width;
				w_month_size	=s.substring(0,s.length-2);
				
				s				=document.getElementById(id+'_yearform_id_temp').style.width;
				w_year_size		=s.substring(0,s.length-2);
				
				// if (w_year_type=='SELECT') {
        if (document.getElementById(id + '_yearform_id_temp').getAttribute('from') && document.getElementById(id + '_yearform_id_temp').getAttribute('to')) {
					w_from = document.getElementById(id+'_yearform_id_temp').getAttribute('from');
					w_to = document.getElementById(id+'_yearform_id_temp').getAttribute('to');
				}
				else {
					w_from = '1901';
				  var current_date = new Date();
					w_to = current_date.getFullYear();
				}
				w_divider		=document.getElementById(id+'_separator1').innerHTML;
				type_date_fields(id, w_field_label, w_field_label_pos, w_day, w_month, w_year, w_day_type, w_month_type, w_year_type, w_day_label, w_month_label, w_year_label, w_day_size, w_month_size, w_year_size, w_required, w_class, w_from, w_to, w_divider, w_attr_name, w_attr_value); break;
			}
			case 'type_own_select':
			{	
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_option"+k))
					{
						w_choices[t]=document.getElementById(id+"_option"+k).innerHTML;
						w_choices_checked[t]=document.getElementById(id+"_option"+k).selected;
						if(document.getElementById(id+"_option"+k).value=="")
							w_choices_disabled[t]=true;
						else
							w_choices_disabled[t]=false;
						t++;
					}
					
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_own_select(id, w_field_label, w_field_label_pos, w_size, w_choices, w_choices_checked, w_required, w_class, w_attr_name, w_attr_value, w_choices_disabled); break;
			}
			case 'type_country':
			{	
				w_countries=[];

				select_=document.getElementById(id+'_elementform_id_temp');
				n=select_.childNodes.length;
				for(i=0; i<n; i++)
				{
					w_countries.push(select_.childNodes[i].value);
				}

				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_country(id, w_field_label, w_countries, w_field_label_pos, w_size, w_required, w_class,  w_attr_name, w_attr_value); break;
			}
			case 'type_captcha':
			{
				w_digit=document.getElementById("_wd_captchaform_id_temp").getAttribute("digit");
				atrs=return_attributes('_wd_captchaform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_captcha(id, w_field_label, w_field_label_pos, w_digit, w_class,  w_attr_name, w_attr_value); break;
			}
			case 'type_recaptcha':
			{
				w_public  = document.getElementById("wd_recaptchaform_id_temp").getAttribute("public_key");
				w_private  = document.getElementById("wd_recaptchaform_id_temp").getAttribute("private_key");
				w_theme  = document.getElementById("wd_recaptchaform_id_temp").getAttribute("theme");
				
				atrs=return_attributes('wd_recaptchaform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_recaptcha(id, w_field_label, w_field_label_pos, w_public, w_private, w_theme, w_class,  w_attr_name, w_attr_value); break;
			}
			case 'type_submit_reset':
			{
				atrs=return_attributes(id+'_element_submitform_id_temp');
				w_act=!(document.getElementById(id+"_element_resetform_id_temp").style.display=="none");
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_submit_title = document.getElementById(id+"_element_submitform_id_temp").value;
				w_reset_title  = document.getElementById(id+"_element_resetform_id_temp").value;
				type_submit_reset(id, w_submit_title , w_reset_title , w_class, w_act, w_attr_name, w_attr_value); break;
			}

			case 'type_button':
			{
				w_title	=new Array();	
			
				w_func	=new Array();
				t=0;
				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						w_title[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_func[t]=document.getElementById(id+"_elementform_id_temp"+k).getAttribute("onclick");
						t++;
						v=k;
					}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_button (id, w_title , w_func , w_class,w_attr_name, w_attr_value); break;
			}
			case 'type_hidden':
			{
				w_value  = document.getElementById(id+"_elementform_id_temp").value;
				w_name  = document.getElementById(id+"_elementform_id_temp").name;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_hidden (id, w_name, w_value , w_attr_name, w_attr_value); break;
			}

		}
	
		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	var pos=document.getElementsByName("el_pos");
		pos[0].setAttribute("disabled", "disabled");
		pos[1].setAttribute("disabled", "disabled");
		pos[2].setAttribute("disabled", "disabled");
		
	var sel_el_pos=document.getElementById("sel_el_pos");
		sel_el_pos.setAttribute("disabled", "disabled");

  // form_maker_edit_in_popup(11);
}

function dublicate(id) {
	type=document.getElementById(id).getAttribute('type');
	//////////////////////////////parameter take
	if(document.getElementById(id+'_element_labelform_id_temp').innerHTML)
		w_field_label=document.getElementById(id+'_element_labelform_id_temp').innerHTML;
	labels=all_labels();
	m=0;
	t=true;
	if(type!="type_section_break")
	{
	while(t)
	{	
		m++;
		for(k=0; k<labels.length; k++)
		{
			t=true;
			if(labels[k]==w_field_label+'('+m+')')
				break;
			t=false;
		}	
	}
	w_field_label=w_field_label+'('+m+')';
	}
	k=0;
	
	w_choices=new Array();	
	w_choices_checked=new Array();
	w_choices_disabled=new Array();
	w_allow_other_num = 0;
  w_property = new Array();
	w_property_type = new Array();
	w_property_values = new Array();
	w_choices_price = new Array();
	t = 0;
	if(document.getElementById(id+'_label_and_element_sectionform_id_temp'))
		w_field_label_pos="top";
	else
		w_field_label_pos="left";
		
	if(document.getElementById(id+"_elementform_id_temp"))
	{
		s=document.getElementById(id+"_elementform_id_temp").style.width;
		 w_size=s.substring(0,s.length-2);
	}
	
	if(document.getElementById(id+"_requiredform_id_temp"))
	  	w_required=document.getElementById(id+"_requiredform_id_temp").value;
		
	if(document.getElementById(id+"_uniqueform_id_temp"))
	  	w_unique=document.getElementById(id+"_uniqueform_id_temp").value;
		
	if(document.getElementById(id+'_label_sectionform_id_temp'))
	{
		w_class=document.getElementById(id+'_label_sectionform_id_temp').getAttribute("class");
		if(!w_class)
			w_class="";
	}
		

	switch(type)
		{
			case 'type_editor':
			{
				w_editor=document.getElementById(id+"_element_sectionform_id_temp").innerHTML;
				// type_editor(gen, w_editor); add(0); break;
				type_editor(gen, w_editor);  break;
			}
			case 'type_section_break':
			{
				w_editor=document.getElementById(id+"_element_sectionform_id_temp").innerHTML;
				// type_section_break(gen, w_editor); add(0); break;
				type_section_break(gen, w_editor);  break;
			}
			case 'type_text':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_text(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value); add(0); break;
				type_text(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value);break;
			}
			case 'type_number':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_number(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value); add(0); break;
				type_number(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_required, w_unique, w_class,  w_attr_name, w_attr_value);break;
			}
			case 'type_password':
			{
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_password(gen, w_field_label, w_field_label_pos, w_size, w_required, w_unique, w_class, w_attr_name, w_attr_value); add(0); break;
				type_password(gen, w_field_label, w_field_label_pos, w_size, w_required, w_unique, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_textarea':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				s=document.getElementById(id+"_elementform_id_temp").style.height;
				w_size_h=s.substring(0,s.length-2);

				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_textarea(gen, w_field_label, w_field_label_pos, w_size, w_size_h, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value); add(0); break;
				type_textarea(gen, w_field_label, w_field_label_pos, w_size, w_size_h, w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_phone':
			{
				w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value];
				w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title];
				s=document.getElementById(id+"_element_lastform_id_temp").style.width;
				w_size=s.substring(0,s.length-2);
				w_mini_labels= [document.getElementById(id+"_mini_label_area_code").innerHTML, document.getElementById(id+"_mini_label_phone_number").innerHTML];
				atrs=return_attributes(id+'_element_firstform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_phone(gen, w_field_label, w_field_label_pos, w_size,  w_first_val, w_title, w_required, w_unique, w_class, w_attr_name, w_attr_value); add(0); break;
				type_phone(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_mini_labels, w_required, w_unique, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_name':
			{
				if(document.getElementById(id+'_element_middleform_id_temp'))
					w_name_format="extended";
				else
					w_name_format="normal";
        if (w_name_format == "normal") {
          w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value];
          w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title];
        }
        else {
          w_first_val=[document.getElementById(id+"_element_firstform_id_temp").value, document.getElementById(id+"_element_lastform_id_temp").value, document.getElementById(id+"_element_titleform_id_temp").value, document.getElementById(id+"_element_middleform_id_temp").value];
          w_title=[document.getElementById(id+"_element_firstform_id_temp").title, document.getElementById(id+"_element_lastform_id_temp").title, document.getElementById(id+"_element_titleform_id_temp").title,
          document.getElementById(id+"_element_middleform_id_temp").title];
        }
				if(document.getElementById(id+"_mini_label_title"))
				w_mini_title = document.getElementById(id+"_mini_label_title").innerHTML;
				else
				w_mini_title = "Title";
				
				if(document.getElementById(id+"_mini_label_middle"))
				w_mini_middle = document.getElementById(id+"_mini_label_middle").innerHTML;
				else
				w_mini_middle = "Middle";
				
				w_mini_labels = [ w_mini_title, document.getElementById(id+"_mini_label_first").innerHTML,document.getElementById(id+"_mini_label_last").innerHTML, w_mini_middle];
				s=document.getElementById(id+"_element_firstform_id_temp").style.width;
				w_size=s.substring(0,s.length-2);
				atrs=return_attributes(id+'_element_firstform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_name(gen, w_field_label, w_field_label_pos, w_first_val, w_title, w_size, w_name_format, w_required, w_unique, w_class, w_attr_name, w_attr_value); add(0); break;
				type_name(gen, w_field_label, w_field_label_pos, w_first_val, w_title, w_mini_labels, w_size, w_name_format, w_required, w_unique, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_address':
			{
				s=document.getElementById(id+"_div_address").style.width;
				w_size=s.substring(0,s.length-2);
        if(document.getElementById(id+"_mini_label_street1")) {
					w_street1= document.getElementById(id+"_mini_label_street1").innerHTML;
        }
				else {
          if (document.getElementById(id+"_street1form_id_temp")) {
            w_street1 = document.getElementById(id+"_street1form_id_temp").value;
          }
          else {
            w_street1 = '';
          }
        }
				if (document.getElementById(id+"_mini_label_street2")) {
					w_street2= document.getElementById(id+"_mini_label_street2").innerHTML;
        }
				else {
          if (document.getElementById(id+"_street2form_id_temp")) {
            w_street2 = document.getElementById(id+"_street2form_id_temp").value;
          }
          else {
            w_street2 = '';
          }
        }
					
				if (document.getElementById(id+"_mini_label_city")) {
					w_city= document.getElementById(id+"_mini_label_city").innerHTML;
        }
				else {
          if (document.getElementById(id+"_cityform_id_temp")) {
            w_city = document.getElementById(id+"_cityform_id_temp").value;
          }
          else {
            w_city = '';
          }
        }

				if (document.getElementById(id+"_mini_label_state")) {
					w_state= document.getElementById(id+"_mini_label_state").innerHTML;
        }
				else {
          if (document.getElementById(id+"_stateform_id_temp")) {
            w_state = document.getElementById(id+"_stateform_id_temp").value;
          }
          else {
            w_state = '';
          }
        }
				if (document.getElementById(id+"_mini_label_postal")) {
					w_postal= document.getElementById(id+"_mini_label_postal").innerHTML;
        }
				else {
          if (document.getElementById(id+"_postalform_id_temp")) {
            w_postal = document.getElementById(id+"_postalform_id_temp").value;
          }
          else {
            w_postal = '';
          }
        }
					
				if (document.getElementById(id+"_mini_label_country")) {
					w_country= document.getElementById(id+"_mini_label_country").innerHTML;
        }
				else {
          if (document.getElementById(id+"_countryform_id_temp")) {
            w_country = document.getElementById(id+"_countryform_id_temp").value;
          }
          else {
            w_country = '';
          }
        }				
					
				w_mini_labels=[w_street1, w_street2, w_city, w_state, w_postal, w_country];
				var disabled_input = document.getElementById(id+"_disable_fieldsform_id_temp");
					w_street1_dis= disabled_input.getAttribute('street1');
					w_street2_dis= disabled_input.getAttribute('street2');
					w_city_dis= disabled_input.getAttribute('city');
					w_state_dis= disabled_input.getAttribute('state');
					w_postal_dis= disabled_input.getAttribute('postal');
					w_country_dis= disabled_input.getAttribute('country');
				w_disabled_fields=[w_street1_dis, w_street2_dis, w_city_dis, w_state_dis, w_postal_dis, w_country_dis];
				atrs=return_attributes(id+'_street1form_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_address(gen, w_field_label, w_field_label_pos, w_size, w_required, w_class, w_attr_name, w_attr_value); add(0); break;
				type_address(gen, w_field_label, w_field_label_pos, w_size, w_mini_labels, w_disabled_fields, w_required, w_class, w_attr_name, w_attr_value);
        disable_fields(id);
        break;
			}

			case 'type_submitter_mail':
			{
				w_first_val=document.getElementById(id+"_elementform_id_temp").value;
				w_title=document.getElementById(id+"_elementform_id_temp").title;
				w_send=document.getElementById(id+"_sendform_id_temp").value;
		
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_submitter_mail(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_send, w_required, w_unique, w_class, w_attr_name, w_attr_value); add(0); break;
				type_submitter_mail(gen, w_field_label, w_field_label_pos, w_size, w_first_val, w_title, w_send, w_required, w_unique, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_checkbox':
			{	
				w_randomize=document.getElementById(id+"_randomizeform_id_temp").value;
				w_allow_other=document.getElementById(id+"_allow_otherform_id_temp").value;
		
				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other'))
							if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other')=='1')
								w_allow_other_num=t;
						w_choices[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_choices_checked[t]=document.getElementById(id+"_elementform_id_temp"+k).checked;
						t++;
						v=k;
					}
          if(document.getElementById(id+"_rowcol_numform_id_temp").value)	
				{
						
			 if(document.getElementById(id+'_table_little').getAttribute('for_hor'))
					w_flow="hor"	
				else
					w_flow="ver";				
				w_rowcol = 	document.getElementById(id+"_rowcol_numform_id_temp").value;
				}
				else
				{
				if(document.getElementById(id+'_hor'))
					w_flow="hor"	
				else
					w_flow="ver";
				
				w_rowcol = '';
				}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_checkbox(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value); add(0); break;
				type_checkbox(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_radio':
			{	
				w_randomize=document.getElementById(id+"_randomizeform_id_temp").value;
				w_allow_other=document.getElementById(id+"_allow_otherform_id_temp").value;

				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other'))
							if(document.getElementById(id+"_elementform_id_temp"+k).getAttribute('other')=='1')
								w_allow_other_num=t;
						w_choices[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_choices_checked[t]=document.getElementById(id+"_elementform_id_temp"+k).checked;
						t++;
						v=k;
					}
          if(document.getElementById(id+"_rowcol_numform_id_temp").value)	
				{
				
                if(document.getElementById(id+'_table_little').getAttribute('for_hor'))
					w_flow="hor"	
				else
					w_flow="ver";				
				w_rowcol = 	document.getElementById(id+"_rowcol_numform_id_temp").value;
				}
				else
				{
				if(document.getElementById(id+'_hor'))
					w_flow="hor"	
				else
					w_flow="ver";
				
				w_rowcol = '';
				}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_radio(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value); add(0); break;
				type_radio(gen, w_field_label, w_field_label_pos, w_flow, w_choices, w_choices_checked, w_rowcol, w_required, w_randomize, w_allow_other, w_allow_other_num, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_star_rating':
			{
				w_star_amount  = document.getElementById(id+"_star_amountform_id_temp").value;
				w_field_label_col  = document.getElementById(id+"_star_colorform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_star_rating(gen, w_field_label, w_field_label_pos, w_field_label_col, w_star_amount, w_required, w_class, w_attr_name, w_attr_value) ; break;
			}
			
			case 'type_scale_rating':
			{
				w_mini_labels  =[document.getElementById(id+"_mini_label_worst").innerHTML,document.getElementById(id+"_mini_label_best").innerHTML];	
				w_scale_amount = document.getElementById(id+"_scale_amountform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_scale_rating(gen, w_field_label, w_field_label_pos, w_mini_labels, w_scale_amount, w_required, w_class, w_attr_name, w_attr_value) ; break;
			}
		
			case 'type_spinner':
			{
				w_field_min_value  = document.getElementById(id+"_min_valueform_id_temp").value;
				w_field_max_value  = document.getElementById(id+"_max_valueform_id_temp").value;
				w_field_width  = document.getElementById(id+"_spinner_widthform_id_temp").value;
				w_field_step = document.getElementById(id+"_stepform_id_temp").value;
				w_field_value  = document.getElementById(id+"_elementform_id_temp").getAttribute("aria-valuenow");
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_spinner(gen, w_field_label, w_field_label_pos, w_field_width, w_field_min_value, w_field_max_value, w_field_step, w_field_value, w_required, w_class, w_attr_name, w_attr_value) ; break;
			
			
			}
			case 'type_slider':
			{
				w_field_min_value  = document.getElementById(id+"_slider_min_valueform_id_temp").value;
				w_field_max_value  = document.getElementById(id+"_slider_max_valueform_id_temp").value;
				w_field_width  = document.getElementById(id+"_slider_widthform_id_temp").value;
				w_field_value  = document.getElementById(id+"_slider_valueform_id_temp").value;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_slider(gen, w_field_label, w_field_label_pos,  w_field_width, w_field_min_value, w_field_max_value, w_field_value, w_required, w_class, w_attr_name, w_attr_value);  break;
			}
			
			case 'type_range':
			{
				
				w_field_range_width  = document.getElementById(id+"_range_widthform_id_temp").value;
				w_field_range_step = document.getElementById(id+"_range_stepform_id_temp").value;
				
				w_field_value1  = document.getElementById(id+"_elementform_id_temp0").getAttribute("aria-valuenow");
				w_field_value2  = document.getElementById(id+"_elementform_id_temp1").getAttribute("aria-valuenow");
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_mini_labels = [document.getElementById(id+"_mini_label_from").innerHTML,document.getElementById(id+"_mini_label_to").innerHTML];
				type_range(gen, w_field_label, w_field_label_pos, w_field_range_width, w_field_range_step, w_field_value1, w_field_value2, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value) ; break;
			
			
			}
			case 'type_grading':
			{
				
				
				w_total = document.getElementById(id+"_grading_totalform_id_temp").value;
				w_items=[];
				
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp"+k))
					{
						
						w_items.push(document.getElementById(id+"_label_elementform_id_temp"+k).innerHTML);
						
					}
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				
				type_grading(gen, w_field_label, w_field_label_pos, w_items, w_total, w_required, w_class, w_attr_name, w_attr_value) ; refresh_grading_items(gen);  break;
			
			
			}
			case 'type_matrix':
			{	
                w_rows=[];
				w_rows[0]="";
				for(k=1;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp"+k+"_0"))
					{
						
						w_rows.push(document.getElementById(id+"_label_elementform_id_temp"+k+"_0").innerHTML);
						
					}
			
			    w_columns=[];
				w_columns[0]="";
				for(k=1;k<100;k++)
					if(document.getElementById(id+"_label_elementform_id_temp0_"+k))
					{
						
						w_columns.push(document.getElementById(id+"_label_elementform_id_temp0_"+k).innerHTML);
						
					}
					
			w_field_input_type = document.getElementById(id+"_input_typeform_id_temp").value;		
					
			atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
			type_matrix(gen, w_field_label, w_field_label_pos, w_field_input_type, w_rows, w_columns, w_required, w_class, w_attr_name, w_attr_value); refresh_matrix(gen);   break; 
			
			
			}
			case 'type_time':
			{	
				atrs=return_attributes(id+'_hhform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_hh=document.getElementById(id+'_hhform_id_temp').value;
				w_mm=document.getElementById(id+'_mmform_id_temp').value;
				if(document.getElementById(id+'_ssform_id_temp'))
				{
					w_ss=document.getElementById(id+'_ssform_id_temp').value;
					w_sec="1";
				}
				else
				{
					w_ss="";
					w_sec="0";
				}
				if(document.getElementById(id+'_am_pm_select'))
				{
					w_am_pm=document.getElementById(id+'_am_pmform_id_temp').value;
					w_time_type="12";
          w_mini_labels = [document.getElementById(id+'_mini_label_hh').innerHTML, document.getElementById(id+'_mini_label_mm').innerHTML, document.getElementById(id+'_mini_label_ss').innerHTML, document.getElementById(id+'_mini_label_am_pm').innerHTML];
				}
				else
				{
					w_am_pm=0;
					w_time_type="24";
          w_mini_labels = [document.getElementById(id+'_mini_label_hh').innerHTML, document.getElementById(id+'_mini_label_mm').innerHTML, document.getElementById(id+'_mini_label_ss').innerHTML, 'AM/PM'];
				}
				// type_time(gen, w_field_label, w_field_label_pos, w_time_type, w_am_pm, w_sec, w_hh, w_mm, w_ss, w_required, w_class, w_attr_name, w_attr_value); add(0); break;
				type_time(gen, w_field_label, w_field_label_pos, w_time_type, w_am_pm, w_sec, w_hh, w_mm, w_ss, w_mini_labels, w_required, w_class, w_attr_name, w_attr_value);break;
			}
			case 'type_date':
			{	
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_date=document.getElementById(id+'_elementform_id_temp').value;
				w_format=document.getElementById(id+'_buttonform_id_temp').getAttribute("format");
				w_but_val=document.getElementById(id+'_buttonform_id_temp').value;
				// type_date(gen, w_field_label, w_field_label_pos, w_date, w_required, w_class, w_format, w_but_val, w_attr_name, w_attr_value); add(0); break;
				type_date(gen, w_field_label, w_field_label_pos, w_date, w_required, w_class, w_format, w_but_val, w_attr_name, w_attr_value);break;
			}
			case 'type_date_fields':
			{	
				atrs			=return_attributes(id+'_dayform_id_temp');
				w_attr_name		=atrs[0];
				w_attr_value	=atrs[1];
				w_day			=document.getElementById(id+'_dayform_id_temp').value;
				w_month			=document.getElementById(id+'_monthform_id_temp').value;
				w_year			=document.getElementById(id+'_yearform_id_temp').value;
				w_day_type		=document.getElementById(id+'_dayform_id_temp').tagName;
				w_month_type	=document.getElementById(id+'_monthform_id_temp').tagName;
				w_year_type		=document.getElementById(id+'_yearform_id_temp').tagName;
				w_day_label		=document.getElementById(id+'_day_label').innerHTML;
				w_month_label	=document.getElementById(id+'_month_label').innerHTML;
				w_year_label	=document.getElementById(id+'_year_label').innerHTML;
				
				s				=document.getElementById(id+'_dayform_id_temp').style.width;
				w_day_size		=s.substring(0,s.length-2);
				
				s				=document.getElementById(id+'_monthform_id_temp').style.width;
				w_month_size	=s.substring(0,s.length-2);
				
				s				=document.getElementById(id+'_yearform_id_temp').style.width;
				w_year_size		=s.substring(0,s.length-2);
				
				// if(w_year_type=='SELECT') {
        if (document.getElementById(id + '_yearform_id_temp').getAttribute('from') && document.getElementById(id + '_yearform_id_temp').getAttribute('to')) {
					w_from = document.getElementById(id+'_yearform_id_temp').getAttribute('from');
					w_to = document.getElementById(id+'_yearform_id_temp').getAttribute('to');
				}
				else {
					w_from = '1901';
					var current_date = new Date();
					w_to = current_date.getFullYear();
				}
				w_divider		=document.getElementById(id+'_separator1').innerHTML;
				// type_date_fields(gen, w_field_label, w_field_label_pos, w_day, w_month, w_year, w_day_type, w_month_type, w_year_type, w_day_label, w_month_label, w_year_label, w_day_size, w_month_size, w_year_size, w_required, w_class, w_from, w_to, w_divider, w_attr_name, w_attr_value); add(0); break;
				type_date_fields(gen, w_field_label, w_field_label_pos, w_day, w_month, w_year, w_day_type, w_month_type, w_year_type, w_day_label, w_month_label, w_year_label, w_day_size, w_month_size, w_year_size, w_required, w_class, w_from, w_to, w_divider, w_attr_name, w_attr_value);break;
			}
			case 'type_own_select':
			{	
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_option"+k))
					{
						w_choices[t]=document.getElementById(id+"_option"+k).innerHTML;
						w_choices_checked[t]=document.getElementById(id+"_option"+k).selected;
						if(document.getElementById(id+"_option"+k).value=="")
							w_choices_disabled[t]=true;
						else
							w_choices_disabled[t]=false;
						t++;
					}
					
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_own_select(gen, w_field_label, w_field_label_pos, w_size, w_choices, w_choices_checked, w_required, w_class, w_attr_name, w_attr_value, w_choices_disabled); add(0); break;
				type_own_select(gen, w_field_label, w_field_label_pos, w_size, w_choices, w_choices_checked, w_required, w_class, w_attr_name, w_attr_value, w_choices_disabled);break;
			}
			case 'type_country':
			{	
				w_countries=[];

				select_=document.getElementById(id+'_elementform_id_temp');
				n=select_.childNodes.length;
				for(i=0; i<n; i++)
				{
					w_countries.push(select_.childNodes[i].value);
				}

				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_country(gen, w_field_label, w_countries, w_field_label_pos, w_size, w_required, w_class,  w_attr_name, w_attr_value); add(0); break;
				type_country(gen, w_field_label, w_countries, w_field_label_pos, w_size, w_required, w_class,  w_attr_name, w_attr_value);break;
			}
			case 'type_submit_reset':
			{
				atrs=return_attributes(id+'_element_submitform_id_temp');
				w_act=!(document.getElementById(id+"_element_resetform_id_temp").style.display=="none");
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				w_submit_title = document.getElementById(id+"_element_submitform_id_temp").value;
				w_reset_title  = document.getElementById(id+"_element_resetform_id_temp").value;
				// type_submit_reset(gen, w_submit_title , w_reset_title , w_class, w_act, w_attr_name, w_attr_value); add(0); break;
				type_submit_reset(gen, w_submit_title , w_reset_title , w_class, w_act, w_attr_name, w_attr_value);break;
			}

			case 'type_button':
			{
				w_title	=new Array();	
			
				w_func	=new Array();
				t=0;
				v=0;
				for(k=0;k<100;k++)
					if(document.getElementById(id+"_elementform_id_temp"+k))
					{
						w_title[t]=document.getElementById(id+"_elementform_id_temp"+k).value;
						w_func[t]=document.getElementById(id+"_elementform_id_temp"+k).getAttribute("onclick");
						t++;
						v=k;
					}
				atrs=return_attributes(id+'_elementform_id_temp'+v);
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				// type_button (gen, w_title , w_func , w_class,w_attr_name, w_attr_value); add(0); break;
				type_button (gen, w_title , w_func , w_class,w_attr_name, w_attr_value);break;
			}
			case 'type_hidden':
			{
				w_value  = document.getElementById(id+"_elementform_id_temp").value;
				w_name  = document.getElementById(id+"_elementform_id_temp").name;
				
				atrs=return_attributes(id+'_elementform_id_temp');
				w_attr_name=atrs[0];
				w_attr_value=atrs[1];
				type_hidden (gen, w_name, w_value , w_attr_name, w_attr_value); break;
			}

		}
    need_enable = false;
		add(0);
		need_enable = true;		
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
}

function form_maker_open_in_popup(id) {
  var thickDims, tbWidth, tbHeight;
  jQuery(document).ready(function($) {
    thickDims = function() {
      var tbWindow = jQuery('#TB_window'), H = jQuery(window).height(), W = jQuery(window).width(), w, h;
      w = (tbWidth && tbWidth < W - 90) ? tbWidth : W - 40;
      h = (tbHeight && tbHeight < H - 60) ? tbHeight : H - 40;
      if (tbWindow.size()) {
        tbWindow.width(w).height(h);
        jQuery('#TB_iframeContent').width(w).height(h - 27);
        tbWindow.css({'margin-left': '-' + parseInt((w / 2),10) + 'px'});
        if (typeof document.body.style.maxWidth != 'undefined') {
          tbWindow.css({'top':(H-h)/2,'margin-top':'0'});
        }
      }
    };
    thickDims();
    jQuery(window).resize( function() { thickDims() } );
    jQuery('a.thickbox-preview' + id).click( function() {
      tb_click.call(this);
      var alink = jQuery(this).parents('.available-theme').find('.activatelink'), link = '', href = jQuery(this).attr('href'), url, text;
      if (tbWidth = href.match(/&tbWidth=[0-9]+/)) {
        tbWidth = parseInt(tbWidth[0].replace(/[^0-9]+/g, ''), 10);
      }
      else {
        tbWidth = jQuery(window).width() - 120;
      }
      if (tbHeight = href.match(/&tbHeight=[0-9]+/)) {
        tbHeight = parseInt(tbHeight[0].replace(/[^0-9]+/g, ''), 10);
      }
      else {
        tbHeight = jQuery(window).height() - 120;
      }
      if (alink.length) {
        url = alink.attr('href') || '';
        text = alink.attr('title') || '';
        link = '&nbsp; <a href="' + url + '" target="_top" class="tb-theme-preview-link">' + text + '</a>';
      }
      else {
        text = jQuery(this).attr('title') || '';
        link = '&nbsp; <span class="tb-theme-preview-link">' + text + '</span>';
      }
      jQuery('#TB_title').css({'background-color':'#222','color':'#dfdfdf'});
      jQuery('#TB_closeAjaxWindow').css({'float':'left'});
      jQuery('#TB_ajaxWindowTitle').css({'float':'right'}).html(link);
      jQuery('#TB_iframeContent').width('100%');
      thickDims();
      return false;
    });
  });
}
