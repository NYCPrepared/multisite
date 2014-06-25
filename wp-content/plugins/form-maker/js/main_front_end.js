F=2;//choices id
var c;
var a = new Array();
function show_other_input(num, form_id) {
  for (k=0;k<50;k++)
    if (document.getElementById(num+"_element"+form_id+k)) 
      if (document.getElementById(num+"_element"+form_id+k).getAttribute('other')) 
        if (document.getElementById(num+"_element"+form_id+k).getAttribute('other')==1) {
          var element_other = document.getElementById(num+"_element"+form_id+k);
          break;
        }
	var parent = element_other.parentNode;
	var br = document.createElement('br');
  br.setAttribute("id", num+"_other_br"+form_id);
	var el_other = document.createElement('input');
	el_other.setAttribute("id", num+"_other_input"+form_id);
	el_other.setAttribute("name", num+"_other_input"+form_id);
	el_other.setAttribute("type", "text");
	el_other.setAttribute("class", "other_input");
	parent.appendChild(br);
	parent.appendChild(el_other);
}

function set_sel_am_pm(select_) {
	if(select_.options[0].selected)	{
		select_.options[0].setAttribute("selected", "selected");
		select_.options[1].removeAttribute("selected");
	}
	else {
		select_.options[1].setAttribute("selected", "selected");
		select_.options[0].removeAttribute("selected");
	}
}

function check_isnum_point(e) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 == 46 || chCode1 == 45) {
    return true;
  }
	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
    return false;
  }
  return true;
}

function check_isnum(e)
{
   	var chCode1 = e.which || e.keyCode;
    	if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57))
        return false;
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

function captcha_refresh(id, genid)
{
	if (document.getElementById(id+genid)) {
		srcArr=document.getElementById(id+genid).src.split("&r=");
		document.getElementById(id+genid).src=srcArr[0]+'&r='+Math.floor(Math.random()*100);
		document.getElementById(id+"_input"+genid).value='';
		document.getElementById(id+genid).style.display="block";
	}
	else {
		srcArr=document.getElementById(id).src.split("&r=");
		document.getElementById(id).src=srcArr[0]+'&r='+Math.floor(Math.random()*100);
		document.getElementById(id+"_input").value='';
		document.getElementById(id).style.display="block";
	}
}

function set_checked(id,j,form_id) {
	set_total_value(id,form_id);
	
	checking=document.getElementById(id+"_element"+form_id+j);
	if(checking.getAttribute('other'))
		if(checking.getAttribute('other')==1)
			if(!checking.checked)
			{					
				if(document.getElementById(id+"_other_input"+form_id))
				{
					document.getElementById(id+"_other_input"+form_id).parentNode.removeChild(document.getElementById(id+"_other_br"+form_id));
					document.getElementById(id+"_other_input"+form_id).parentNode.removeChild(document.getElementById(id+"_other_input"+form_id));
				}
				return false;					
			}
	return true;
}

function set_select(value) {
  var value = value.id.split("_element");
  id = value[0];
  form_id = value[1];
  set_total_value(id,form_id);
}

function set_default(id, j, form_id){	

	if(document.getElementById(id+"_other_input"+form_id))
	{
		document.getElementById(id+"_other_input"+form_id).parentNode.removeChild(document.getElementById(id+"_other_br"+form_id));
		document.getElementById(id+"_other_input"+form_id).parentNode.removeChild(document.getElementById(id+"_other_input"+form_id));
	}
  set_total_value(id,form_id);
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

function change_hour(ev, id,hour_interval)
{
	if(check_hour(ev, id,hour_interval))
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

function check_isnum_interval(e, id, from, to) {
  var chCode1 = e.which || e.keyCode;
  if (chCode1 > 31 && (chCode1 < 48 || chCode1 > 57)) {
    return false;
  }
  val = "" + document.getElementById(id).value+String.fromCharCode(chCode1);
	if (val.length>2) {
    return false;
  }
  if (val == '00') {
    return false;
  }
	if ((val < from) || (val > to)) {
    return false;
  }
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

function check_year2(id, str)
{
	year=document.getElementById(id).value;
	
	from=parseFloat(document.getElementById(id).getAttribute('from'));
	
	year=parseFloat(year);
	
	if(year<from)
	{
		document.getElementById(id).value='';
	}
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

		input.setAttribute("value", input.title);
		input.className='input_deactive';
		input.setAttribute("class", 'input_deactive');

	}
}

function change_value(id) {
	input=document.getElementById(id);
	tag=input.tagName;
	if (tag == "TEXTAREA")	{
    // destroyChildren(input)
    input.innerHTML=input.value;
	}
	else {
    input.setAttribute("value", input.value);
  }
}

function change_value_for_total(id, form_id) {
  set_total_value(id, form_id);
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

function change_file_value(destination, id)
{	
	input=document.getElementById(id);
	input.setAttribute("value", destination);
}

function change_label(id, label)
{
	document.getElementById(id).innerHTML=label;
	document.getElementById(id).value=label;
}

function change_in_value(id, label)
{
	document.getElementById(id).setAttribute("value", label);
}

function destroyChildren(node)
{
  while (node.firstChild)
      node.removeChild(node.firstChild);
}

////////////////////////////////////////////
function generate_page_nav(id, form_id, form_view_count, form_view_max)
{
form_view=id;
////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
page_nav=document.getElementById(form_id+'page_nav'+id);
destroyChildren(page_nav);
form_view_elemet=document.getElementById(form_id+'form_view'+id);

display_none_form_views_all(form_id);

generate_page_bar(id, form_id, form_view_count, form_view_max);

form_view_elemet.parentNode.style.display="";

if(form_view_elemet.parentNode.previousSibling && form_view_elemet.parentNode.previousSibling.previousSibling)
{
	if(form_view_elemet.parentNode.previousSibling.tagName=="TABLE")
		table=form_view_elemet.parentNode.previousSibling;
	else
		if(form_view_elemet.parentNode.previousSibling.previousSibling.tagName=="TABLE")
			table=form_view_elemet.parentNode.previousSibling.previousSibling;
		else
			table="none";
			
	if(table!="none")
	{
		if(!table.firstChild.tagName)
			table.removeChild(table.firstChild);


		previous_title		= form_view_elemet.getAttribute('previous_title');
		previous_type		= form_view_elemet.getAttribute('previous_type');
		previous_class		= form_view_elemet.getAttribute('previous_class');
		previous_checkable	= form_view_elemet.getAttribute('previous_checkable');
	
		next_or_previous="previous";

		previous=make_pagebreak_button(next_or_previous, previous_title, previous_type, previous_class, previous_checkable, id, form_id, form_view_count, form_view_max);
		var td = document.createElement("td");
			td.setAttribute("valign", "middle");
			td.setAttribute("align", "left");
		
		td.appendChild(previous);
		page_nav.appendChild(td);
	}
}


		var td = document.createElement("td");
			td.setAttribute("id", form_id+"page_numbers"+form_view);
			td.setAttribute("width", "100%");
			td.setAttribute("valign", "middle");
			td.setAttribute("align", "center");
if(document.getElementById(form_id+'pages').getAttribute('show_numbers')=="true")
{
		k=0;
		for(j=1; j<=form_view_max; j++)
		{
			if(document.getElementById(form_id+'form_view'+j))
			{
				k++;		
				if(j==form_view)
					page_number=k;
			}
		}
		
		var cur = document.createElement('span');
			cur.setAttribute("class", "page_numbers");
			cur.innerHTML=page_number+'/'+k;
		
		td.appendChild(cur);

}
		page_nav.appendChild(td);



not_next=false;
if(form_view_elemet.parentNode.nextSibling)
{
	if(form_view_elemet.parentNode.nextSibling.tagName=="TABLE")
		table=form_view_elemet.parentNode.nextSibling;
	else
		if(form_view_elemet.parentNode.nextSibling.nextSibling)
		{
			if(form_view_elemet.parentNode.nextSibling.nextSibling.tagName=="TABLE")
				table=form_view_elemet.parentNode.nextSibling.nextSibling;
			else
				table="none";
		}
			else
				table="none";
			
	if(table!="none")
	{
		next_title		=form_view_elemet.getAttribute('next_title');
		next_type		=form_view_elemet.getAttribute('next_type');
		next_class		=form_view_elemet.getAttribute('next_class');
		next_checkable	=form_view_elemet.getAttribute('next_checkable');
	
		next_or_previous="next";
	
		next=make_pagebreak_button(next_or_previous, next_title, next_type, next_class, next_checkable, id, form_id, form_view_count, form_view_max);
		var td = document.createElement("td");
			td.setAttribute("valign", "middle");
			td.setAttribute("align", "right");
		
		td.appendChild(next);
		page_nav.appendChild(td);
	}
	else
	{
		not_next=true;
	}
}
else
{
	not_next=true;
}

	for(x=0; x<parseInt(document.getElementById('counter'+form_id).value); x++)
		if(document.getElementById(x+'_type'+form_id))
		{
			if(document.getElementById(x+'_type'+form_id).value=="type_map")
			{
				if_gmap_init(x, form_id);
				for(q=0; q<20; q++)
					if(document.getElementById(x+"_element"+form_id).getAttribute("long"+q))
					{
					
						w_long=parseFloat(document.getElementById(x+"_element"+form_id).getAttribute("long"+q));
						w_lat=parseFloat(document.getElementById(x+"_element"+form_id).getAttribute("lat"+q));
						w_info=parseFloat(document.getElementById(x+"_element"+form_id).getAttribute("info"+q));
						add_marker_on_map(x,q, w_long, w_lat, w_info, form_id,false);
					}
			}
			
			if(document.getElementById(x+'_type'+form_id).value=="type_mark_map")
			{      	
			    if(!document.getElementById(x+'_long'+form_id))
                {
					var longit = document.createElement('input');
						longit.setAttribute("type", 'hidden');
						longit.setAttribute("id", x+'_long'+form_id);
						longit.setAttribute("name",x+'_long'+form_id);

					var latit = document.createElement('input');
						latit.setAttribute("type", 'hidden');
						latit.setAttribute("id",x+'_lat'+form_id);
						latit.setAttribute("name",x+'_lat'+form_id);
									
									
					document.getElementById(x+"_element_section"+form_id).appendChild(longit);
					document.getElementById(x+"_element_section"+form_id).appendChild(latit);

					w_long=parseFloat(document.getElementById(x+"_element"+form_id).getAttribute("long0"));
					w_lat=parseFloat(document.getElementById(x+"_element"+form_id).getAttribute("lat0"));
					w_info=document.getElementById(x+"_element"+form_id).getAttribute("info0");
                }
                else
                {
                    w_long=parseFloat(document.getElementById(x+"_long"+form_id).value);
					w_lat=parseFloat(document.getElementById(x+"_lat"+form_id).value);
					w_info=document.getElementById(x+"_element"+form_id).getAttribute("info0");
                }

                longit=document.getElementById(x+'_long'+form_id);
			    latit=document.getElementById(x+'_lat'+form_id);

				if_gmap_init(x, form_id);
				
				curpoint = new google.maps.LatLng(w_lat,w_long);

				gmapdata[x].setCenter(curpoint);

				longit.value=w_long;
				latit.value=w_lat;
				add_marker_on_map(x,0, w_long, w_lat, w_info, form_id, true);
				
			}
			
			
		}

////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

function display_none_form_views_all(form_id)
{
	for(t=1; t<30; t++)
		if(document.getElementById(form_id+'form_view'+t))
			document.getElementById(form_id+'form_view'+t).parentNode.style.display="none";
}
//
function generate_page_bar(form_view, form_id, form_view_count, form_view_max)	
{	
		if(document.getElementById(form_id+'pages').getAttribute('type')=='steps')
				make_page_steps_front(form_view, form_id, form_view_count, form_view_max);
		else
			if(document.getElementById(form_id+'pages').getAttribute('type')=='percentage')
				make_page_percentage_front(form_view, form_id, form_view_count, form_view_max);
			else
				make_page_none_front(form_id);
		

		
		
		if(document.getElementById(form_id+'pages').getAttribute('type')=='show_numbers')		
		{		
			td = document.getElementById(form_id+'page_numbers'+form_view);
			if(td)	
			{	
				destroyChildren(td);
				k=0;
				for(j=1; j<=form_view_max; j++)
				{
					if(document.getElementById(form_id+'form_view'+j))
					{
						k++;		
						if(j==form_view)
							page_number=k;
					}
				}
				
				var cur = document.createElement('span');
					cur.setAttribute("class", "page_numbers");
					cur.innerHTML=page_number+'/'+k;
				
				td.appendChild(cur);
				}
		}
		else
		{	
			td = document.getElementById(form_id+'page_numbers'+form_view);
			if(td)	
			{	
				destroyChildren(document.getElementById(form_id+'page_numbers'+form_view));
			}
		}		
	}

function make_page_steps_front(form_view, form_id, form_view_count, form_view_max)
{
	destroyChildren(document.getElementById(form_id+'pages'));
	show_title			=(document.getElementById(form_id+'pages').getAttribute('show_title')=='true');
	next_checkable		=(document.getElementById(form_id+'form_view'+form_view).getAttribute('next_checkable')=='true');
	previous_checkable	=(document.getElementById(form_id+'form_view'+form_view).getAttribute('previous_checkable')=='true');
	
	k=0;
	for(j=1; j<=form_view_max; j++)
	{	
		if(document.getElementById(form_id+'form_view'+j))
			{
			if(document.getElementById(form_id+'form_view'+j).getAttribute('page_title'))
				w_pages=document.getElementById(form_id+'form_view'+j).getAttribute('page_title');
			else
				w_pages=""
			k++;
			
			page_number = document.createElement('span');
			page_number.setAttribute('id','page_'+j);
			if(j<form_view)
				if(previous_checkable)
					page_number.setAttribute('onClick','if(check('+form_view+', '+form_id+')) generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');
				else
					page_number.setAttribute('onClick','generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');
				
				
			if(j>form_view)
				if(next_checkable)
					page_number.setAttribute('onClick','if(check('+form_view+', '+form_id+')) generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');
				else			
					page_number.setAttribute('onClick','generate_page_nav("'+j+'", "'+form_id+'", "'+form_view_count+'", "'+form_view_max+'")');
			
			
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
			
			document.getElementById(form_id+'pages').appendChild(page_number);
		}
	}

}

function make_page_percentage_front(form_view, form_id, form_view_count, form_view_max)
{
	destroyChildren(document.getElementById(form_id+'pages'));
	show_title=(document.getElementById(form_id+'pages').getAttribute('show_title')=='true');
	
    var div_parent = document.createElement('div');
       	div_parent.setAttribute("class", "page_percentage_deactive");

    var div = document.createElement('div');
       	div.setAttribute("id", "div_percentage");
       	div.setAttribute("class", "page_percentage_active");
       	div.setAttribute("align", "right");
		
	var b = document.createElement('span');
       //	b.style.margin='3px 7px 3px 3px';
       	b.setAttribute("class", "wdform_percentage_text");
		//b.style.vertical-align='middle';
	div.appendChild(b);
	
	k=0;
	cur_page_title='';
	for(j=1; j<=form_view_max; j++)
	{	
		if(document.getElementById(form_id+'form_view'+j))
			{
			if(document.getElementById(form_id+'form_view'+j).getAttribute('page_title'))
				w_pages=document.getElementById(form_id+'form_view'+j).getAttribute('page_title');
			else
				w_pages=""
			k++;
				
			if(j==form_view)
			{
				if(show_title)
				{ 
					var cur_page_title = document.createElement('span');
						cur_page_title.innerHTML=w_pages;
						
					cur_page_title.innerHTML=w_pages;										
					cur_page_title.setAttribute("class", "wdform_percentage_title");
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
	document.getElementById(form_id+'pages').appendChild(div_parent);

	
}

function make_page_none_front(form_id)
{
	destroyChildren(document.getElementById(form_id+'pages'));
}

function make_pagebreak_button(next_or_previous,title,type, class_, checkable, id, form_id, form_view_count, form_view_max)
{
	switch(type)
	{
		case 'button': 
		{ 
		
			var element = document.createElement('button');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('type', "button");
				element.setAttribute('class', class_);
        element.style.cursor = "pointer";
				if(checkable=="true")
					element.setAttribute('onClick', "if(check("+id+", "+form_id+" )) page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				else
					element.setAttribute('onClick', "page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				element.innerHTML=title;
				
			return element;
			
			break;
		}
		case 'text': {	
			
			var element = document.createElement('span');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('class', class_);
        element.style.cursor="pointer";
				if(checkable=="true")
					element.setAttribute('onClick', "if(check("+id+", "+form_id+")) page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				else
					element.setAttribute('onClick', "page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				element.innerHTML=title;
				
			return element;
			
			break;
		}
		case 'img':{ 			
		
			var element = document.createElement('img');
				element.setAttribute('id', "page_"+next_or_previous+"_"+id);
				element.setAttribute('class', class_);
        element.style.cursor="pointer";
				if(checkable=="true")
					element.setAttribute('onClick', "if(check("+id+", "+form_id+")) page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				else
					element.setAttribute('onClick', "page_"+next_or_previous+"("+id+","+form_id+","+form_view_count+","+form_view_max+")");
				if(title.indexOf("http")==0)
				{
					element.src=title;
				}
				else
					element.src=JURI_ROOT+"/administrator/"+title;
				
			return element;
			
			break;
		}
	}
}

function page_previous(id, form_id, form_view_count, form_view_max)
{
	form_view_elemet=document.getElementById(form_id+'form_view'+id);
	if(form_view_elemet.parentNode.previousSibling && form_view_elemet.parentNode.previousSibling.previousSibling)
	{
	if(form_view_elemet.parentNode.previousSibling.tagName=="TABLE")
		table=form_view_elemet.parentNode.previousSibling;
	else
		table=form_view_elemet.parentNode.previousSibling.previousSibling;
	}
	if(!table.firstChild.tagName)
		table.removeChild(table.firstChild);

	generate_page_nav(table.firstChild.id.replace(form_id+'form_view', ""),form_id, form_view_count, form_view_max);
	window.scroll(0, form_maker_findPos(document.getElementById("form" + form_id)));
}

function page_next(id, form_id, form_view_count, form_view_max)
{
	form_view_elemet=document.getElementById(form_id+'form_view'+id);
	if(form_view_elemet.parentNode.nextSibling)
	{
	if(form_view_elemet.parentNode.nextSibling.tagName=="TABLE")
		table=form_view_elemet.parentNode.nextSibling;
	else
		table=form_view_elemet.parentNode.nextSibling.nextSibling;
	}
	if(!table.firstChild.tagName)
		table.removeChild(table.firstChild);

	generate_page_nav(table.firstChild.id.replace(form_id+'form_view', ""), form_id, form_view_count, form_view_max);
	window.scroll(0, form_maker_findPos(document.getElementById("form" + form_id)));
}

function form_maker_findPos(obj) {
  var curtop = 0;
  if (obj.offsetParent) {
    do {
        curtop += obj.offsetTop;
    } while (obj = obj.offsetParent);
  return [curtop];
  }
}

function randomSort(a,b) {
    return( parseInt( Math.random()*10 ) %2 );
}

function choises_randomize(id, form_id)
{
ot=-1;
j_array=new Array;
for(j=0; j<100; j++)
	if(document.getElementById(id+"_element"+form_id+j))
		{
			if(document.getElementById(id+"_element"+form_id+j).getAttribute("other"))
				if(document.getElementById(id+"_element"+form_id+j).getAttribute("other")==1)
				{	ot=j; continue;}
			j_array.push(j);
		}
j_array.sort(randomSort);


parent_=document.getElementById(id+"_element"+form_id+j_array[0]).parentNode.parentNode.parentNode;

for(j=0; j<j_array.length; j++)
	parent_.appendChild(document.getElementById(id+"_element"+form_id+j_array[j]).parentNode.parentNode);
	
if(ot!=-1)	
	parent_.appendChild(document.getElementById(id+"_element"+form_id+ot).parentNode.parentNode);

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

function getRadioCheckedValue(radio_name) {
  var id = '';
  var oRadio = document.getElementsByName(radio_name);
  for (var i = 0; i < oRadio.length; i++) {
    if (oRadio[i].checked) {
      id = oRadio[i].id;
      break;
    }
  }
  return id.replace('element', 'elementlabel_');
}
	
function getfileextension(id, form_id) 
{ 

 var fileinput = document.getElementById(id+"_element"+form_id); 
 var filename = fileinput.value; 
 if( filename.length == 0 ) 
 return true; 
 var dot = filename.lastIndexOf("."); 
 var extension = filename.substr(dot+1,filename.length); 
 var exten = document.getElementById(id+"_extension").value.replace("***extensionverj"+id+"***", "").replace("***extensionskizb"+id+"***", "");
 exten=exten.split(',');
 
 for(x=0 ; x<exten.length; x++)
 {
  exten[x]=exten[x].replace(/\./g,'');
  exten[x]=exten[x].replace(/ /g,'');
  if(extension.toLowerCase()==exten[x].toLowerCase())
  	return true;
 }
 return false; 
} 

	
function check_required(but_type, form_id)
{

	if(but_type=='reset')
	{
		if(window.before_reset)
		{
			before_reset();
		}
		window.location=REQUEST_URI;
		return;
	}
	
	if(window.before_submit)
	{
		before_submit();
	}

	n=parseInt(document.getElementById('counter'+form_id).value);
	ext_available=true;
	seted=true;
	for(i=0; i<=n; i++)
	{	
		if(seted)
		{
			if(document.getElementById(i+"_type"+form_id))
			    if(document.getElementById(i+"_required"+form_id))
				if(document.getElementById(i+"_required"+form_id).value=="yes")
				{
					type=document.getElementById(i+"_type"+form_id).value;
					switch(type)
					{
						case "type_text":
						case "type_number":
						case "type_password":
						case "type_submitter_mail":
						case "type_own_select":
						case "type_country":
							{
								if(document.getElementById(i+"_element"+form_id).value==document.getElementById(i+"_element"+form_id).title || document.getElementById(i+"_element"+form_id).value=="")
									seted=false;
									break;
							}
							
						case "type_file_upload":
							{
								if(document.getElementById(i+"_element"+form_id).value=="")
								{	
									seted=false;
									break;
								}
								ext_available=getfileextension(i,form_id);
								if(!ext_available)
									seted=false;
											
									break;
							}
							
						case "type_textarea":
							{
								if(document.getElementById(i+"_element"+form_id).innerHTML==document.getElementById(i+"_element"+form_id).title || document.getElementById(i+"_element"+form_id).innerHTML=="")
									seted=false;
									break;
							}
							
						case "type_name":
							{	
							if(document.getElementById(i+"_element_title"+form_id))
								{
									if(document.getElementById(i+"_element_title"+form_id).value=="" || document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" || document.getElementById(i+"_element_middle"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title ||   document.getElementById(i+"_element_title"+form_id).value==document.getElementById(i+"_element_title"+form_id).title || document.getElementById(i+"_element_middle"+form_id).value==document.getElementById(i+"_element_middle"+form_id).title)
										seted=false;
								}
								else
								{
									if(document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title)
										seted=false;
								}
								break;
	
							}
							
						case "type_phone":
							{	
								if(document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title)
									seted=false;
								break;
	
							}
							
						case "type_address":
							{	
								if ((document.getElementById(i+"_street1"+form_id) && document.getElementById(i+"_street1"+form_id).value=="" && jQuery("#" + i+"_street1"+form_id).attr("type") != "hidden") || (document.getElementById(i+"_city"+form_id) && document.getElementById(i+"_city"+form_id).value=="" && jQuery("#" + i+"_city"+form_id).attr("type") != "hidden") || (document.getElementById(i+"_state"+form_id) && document.getElementById(i+"_state"+form_id).value==""&& jQuery("#" + i+"_state"+form_id).attr("type") != "hidden") || (document.getElementById(i+"_postal"+form_id) && document.getElementById(i+"_postal"+form_id).value==""&& jQuery("#" + i+"_city"+form_id).attr("type") != "hidden") || (document.getElementById(i+"_postal"+form_id) && document.getElementById(i+"_country"+form_id).value==""&& jQuery("#" + i+"_country"+form_id).attr("type") != "hidden"))
									seted=false;
								break;
	
							}
						case "type_checkbox":
						case "type_radio":
							{
								is=true;
								for(j=0; j<100; j++)
									if(document.getElementById(i+"_element"+form_id+j))
										if(document.getElementById(i+"_element"+form_id+j).checked)
										{
											is=false;										
											break;
										}
								if(is)
								seted=false;
								break;
							}
            case "type_star_rating":
							{	
								if(document.getElementById(i+"_selected_star_amount"+form_id).value=="")
										seted=false;
									break;		
						    }	

								case "type_scale_rating":
							{
						
								var scale_radio_checked=false;
								for(var k=1; k<100; k++){
								if(document.getElementById(i+"_scale_radio"+form_id+"_"+k)){
								
									if(document.getElementById(i+"_scale_radio"+form_id+"_"+k).checked==true)
									scale_radio_checked=true;
								}
								}	
					
								if(scale_radio_checked==false)
										seted=false;
									break;		
						    
							}
							case "type_spinner":
							{
						
								if(!document.getElementById(i+"_element"+form_id).getAttribute('aria-valuenow'))
										seted=false;
									break;		
						    }
							case "type_slider":
							{
						
								if(document.getElementById(i+"_slider_value"+form_id).value==document.getElementById(i+"_slider_min_value"+form_id).value)
										seted=false;
									break;		
						    }
							case "type_range":
							{
						
								if(!document.getElementById(i+"_element"+form_id+"0").getAttribute('aria-valuenow') && !document.getElementById(i+"_element"+form_id+"1").getAttribute('aria-valuenow'))
										seted=false;
									break;		
						    }
								case "type_grading":
							{
						
					        var grading_input=false;
					     	for(var k=0; k<100; k++){
							if(document.getElementById(i+"_element"+form_id+k)){
							
								if(document.getElementById(i+"_element"+form_id+k).value!="")
								grading_input=true;
							}
                            }	
					
								if(grading_input==false)
										seted=false;
									break;		
						    
							}
							
							case "type_matrix":
							{
						
								if(document.getElementById(i+"_input_type"+form_id).value=='radio' || document.getElementById(i+"_input_type"+form_id).value=='checkbox')
								{
								var radio_checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j).checked==true)
									{
									
									radio_checked=true;
									}
									}
									}
								}
								if(radio_checked==false)
								seted=false;
									
								}
								else
								{
								if(document.getElementById(i+"_input_type"+form_id).value=='text')
								{
								var checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j).value!="")
									{
									checked=true;
									}
									}
									}
								}
								if(checked==false)
								seted=false;
									
								}
								else
								{
								var checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_select_yes_no"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_select_yes_no"+form_id+k+"_"+j).value!="")
									{
									checked=true;
									}
									}
									}
								}
								if(checked==false)
								seted=false;
									
								
								}
								
								}
								break;	
		
									
						    }
							
						case "type_time":
							{	
							if(document.getElementById(i+"_ss"+form_id))
								{
									if(document.getElementById(i+"_ss"+form_id).value=="" || document.getElementById(i+"_mm"+form_id).value=="" || document.getElementById(i+"_hh"+form_id).value=="")
										seted=false;
								}
								else
								{
									if(document.getElementById(i+"_mm"+form_id).value=="" || document.getElementById(i+"_hh"+form_id).value=="")
										seted=false;
								}
								break;
	
							}
							
						case "type_date":
							{	
								if(document.getElementById(i+"_element"+form_id).value=="")
									seted=false;
								break;
							}
						case "type_date_fields":
							{	
								if(document.getElementById(i+"_day"+form_id).value=="" || document.getElementById(i+"_month"+form_id).value=="" || document.getElementById(i+"_year"+form_id).value=="")
									seted=false;
								break;
							}
					}	
					
				}
				else
				{	
					type=document.getElementById(i+"_type"+form_id).value;
					if(type=="type_file_upload")
						ext_available=getfileextension(i, form_id);
							if(!ext_available)
							seted=false;
											
				}
      if (document.getElementById(i+"_type"+form_id)) {
				if (document.getElementById(i+"_type"+form_id).value == "type_grading") {
					if (parseInt(document.getElementById(i+"_sum_element"+form_id).innerHTML) > parseInt(document.getElementById(i+"_total_element"+form_id).innerHTML)) {
            alert(WDF_INVALID_GRADING + ' ' + document.getElementById(i+'_total_element'+form_id).innerHTML);
						return;
					}
				}
      }
		}
		else
		{
		
			if(!ext_available)
				{alert(WDF_FILE_TYPE_ERROR);
				break;}
			
			x=document.getElementById(i-1+'_element_label'+form_id);
			while(x.firstChild)
			{
				x=x.firstChild;
			}
			alert(ReqFieldMsg.replace('`FIELDNAME`', '"'+x.nodeValue+'" '));
			
			break;
		}
		
	}
	if(seted)
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i+"_type"+form_id))
			if(document.getElementById(i+"_type"+form_id).value=="type_submitter_mail")
				if (document.getElementById(i+"_element"+form_id).value!='' && document.getElementById(i+"_element"+form_id).value.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
				{
							alert(WDF_INVALID_EMAIL);	
							return;
				}		

	}

	if(seted)
		create_headers(form_id);
	
}

function form_maker_getElementsByAttribute(node,tag,attr,value){
  var elems = (tag=="*" && node.all) ? node.all : node.getElementsByTagName(tag),
    returnElems = new Array(),
    nValue = (typeof value!="undefined") ? new RegExp("(^|\\s)" + value + "(\\s|$)") : null,
    nAttr,
    cur;
  for (var i = 0; i < elems.length; i++) {
    cur = elems[i];
    nAttr = cur.getAttribute && cur.getAttribute(attr);
    if (typeof nAttr == "string" && nAttr.length > 0) {
      if (typeof value == "undefined" || (nValue && nValue.test(nAttr))) {
        returnElems.push(cur);
      }
    }
  }
  return returnElems;
}
	
function check(id, form_id)
{
	n=parseInt(document.getElementById("counter"+form_id).value);
	form_view_curren=document.getElementById(form_id+"form_view"+id);
	ext_available=true;
	seted=true;
	for(i=0; i<=n; i++)
	{	
		if(seted)
		{
			// if(form_view_curren.getElementById(i+"_type"+form_id))
      if (form_maker_getElementsByAttribute(form_view_curren, "*", "id", "" + i + "_type" + form_id + "") != '')
			    if(document.getElementById(i+"_required"+form_id))
				if(document.getElementById(i+"_required"+form_id).value=="yes")
				{
					type=document.getElementById(i).getAttribute("type");
					switch(type)
					{
						case "type_text":
						case "type_number":
						case "type_password":
						case "type_submitter_mail":
						case "type_own_select":
						case "type_country":
							{
								if(document.getElementById(i+"_element"+form_id).value==document.getElementById(i+"_element"+form_id).title || document.getElementById(i+"_element"+form_id).value=="")
									seted=false;
									break;
							}
							
						case "type_file_upload":
							{
								if(document.getElementById(i+"_element"+form_id).value=="")
								{	
									seted=false;
									break;
								}
								ext_available=getfileextension(i, form_id);
								if(!ext_available)
									seted=false;
											
									break;
							}
							
						case "type_textarea":
							{
								if(document.getElementById(i+"_element"+form_id).innerHTML==document.getElementById(i+"_element"+form_id).title || document.getElementById(i+"_element"+form_id).innerHTML=="")
									seted=false;
									break;
							}
							
						case "type_name":
							{	
							if(document.getElementById(i+"_element_title"+form_id))
								{
									if(document.getElementById(i+"_element_title"+form_id).value=="" || document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" || document.getElementById(i+"_element_middle"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title ||   document.getElementById(i+"_element_title"+form_id).value==document.getElementById(i+"_element_title"+form_id).title || document.getElementById(i+"_element_middle"+form_id).value==document.getElementById(i+"_element_middle"+form_id).title)
										seted=false;
								}
								else
								{
									if(document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title)
										seted=false;
								}
								break;
	
							}
							
						case "type_phone":
							{	
								if(document.getElementById(i+"_element_first"+form_id).value=="" || document.getElementById(i+"_element_last"+form_id).value=="" ||   document.getElementById(i+"_element_first"+form_id).value==document.getElementById(i+"_element_first"+form_id).title || document.getElementById(i+"_element_last"+form_id).value==document.getElementById(i+"_element_last"+form_id).title  )
									seted=false;
								break;
	
							}
							
						case "type_address":
							{	
								if ((document.getElementById(i+"_street1"+form_id) && document.getElementById(i+"_street1"+form_id).value=="") || (document.getElementById(i+"_city"+form_id) && document.getElementById(i+"_city"+form_id).value=="") || (document.getElementById(i+"_state"+form_id) && document.getElementById(i+"_state"+form_id).value=="") || (document.getElementById(i+"_postal"+form_id) && document.getElementById(i+"_postal"+form_id).value=="") || (document.getElementById(i+"_country"+form_id) && document.getElementById(i+"_country"+form_id).value==""))
									seted=false;
								break;
	
							}
							
	
						case "type_checkbox":
						case "type_radio":
							{
								is=true;
								for(j=0; j<100; j++)
									if(document.getElementById(i+"_element"+form_id+j))
										if(document.getElementById(i+"_element"+form_id+j).checked)
										{
											is=false;										
											break;
										}
								if(is)
								seted=false;
								break;
							}
							
						case "type_time":
							{	
							if(document.getElementById(i+"_ss"+form_id))
								{
									if(document.getElementById(i+"_ss"+form_id).value=="" || document.getElementById(i+"_mm"+form_id).value=="" || document.getElementById(i+"_hh"+form_id).value=="")
										seted=false;
								}
								else
								{
									if(document.getElementById(i+"_mm"+form_id).value=="" || document.getElementById(i+"_hh"+form_id).value=="")
										seted=false;
								}
								break;
	
							}
							
						case "type_date":
							{	
								if(document.getElementById(i+"_element"+form_id).value=="")
									seted=false;
								break;
							}
						case "type_date_fields":
							{	
								if(document.getElementById(i+"_day"+form_id).value=="" || document.getElementById(i+"_month"+form_id).value=="" || document.getElementById(i+"_year"+form_id).value=="")
									seted=false;
								break;
							}
            case "type_star_rating":
							{
						
								if(document.getElementById(i+"_selected_star_amount"+form_id).value=="")
										seted=false;
									break;		
						    }
							
								case "type_scale_rating":
							{
						
								var scale_radio_checked=false;
								for(var k=1; k<100; k++){
								if(document.getElementById(i+"_scale_radio"+form_id+"_"+k)){
							
								if(document.getElementById(i+"_scale_radio"+form_id+"_"+k).checked==true)
								scale_radio_checked=true;
								}
								}	
					
								if(scale_radio_checked==false)
										seted=false;
									break;		
						    
							}
							case "type_spinner":
							{
						
								if(!document.getElementById(i+"_element"+form_id).getAttribute('aria-valuenow'))
										seted=false;
									break;		
						    }
							case "type_slider":
							{
						
								if(document.getElementById(i+"_slider_value"+form_id).value==document.getElementById(i+"_slider_min_value"+form_id).value)
										seted=false;
									break;		
						    }
							case "type_range":
							{
						
								if(!document.getElementById(i+"_element"+form_id+"0").getAttribute('aria-valuenow') && !document.getElementById(i+"_element"+form_id+"1").getAttribute('aria-valuenow'))
										seted=false;
									break;		
						    }
								case "type_grading":
							{
						
					        var grading_input=false;
					     	for(var k=0; k<100; k++){
							if(document.getElementById(i+"_element"+form_id+k)){
							
								if(document.getElementById(i+"_element"+form_id+k).value!="")
								grading_input=true;
							}
                            }	
					
								if(grading_input==false)
										seted=false;
									break;		
						    
							}
							case "type_matrix":
							{
						
								if(document.getElementById(i+"_input_type"+form_id).value=='radio' || document.getElementById(i+"_input_type"+form_id).value=='checkbox')
								{
								var radio_checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j).checked==true)
									{
									
									radio_checked=true;
									}
									}
									}
								}
								if(radio_checked==false)
								seted=false;
									
								}
								else
								{
								if(document.getElementById(i+"_input_type"+form_id).value=='text')
								{
								var checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_input_element"+form_id+k+"_"+j).value!="")
									{
									checked=true;
									}
									}
									}
								}
								if(checked==false)
								seted=false;
									
								}
								else
								{
								var checked=false;
								for(var k=1;k<=100;k++){
								    for(var j=1;j<=100;j++)
									{
									if(document.getElementById(i+"_select_yes_no"+form_id+k+"_"+j)){
									
									if(document.getElementById(i+"_select_yes_no"+form_id+k+"_"+j).value!="")
									{
									checked=true;
									}
									}
									}
								}
								if(checked==false)
								seted=false;
									
								
								}
								
								}
								break;	
		
									
						    }
					}	
					
				}
				else
				{	
					type=document.getElementById(i).getAttribute("type");
					if(type=="type_file_upload")
						ext_available=getfileextension(i, form_id);
							if(!ext_available)
							seted=false;
											
				}
		}
		else
		{
		
			if(!ext_available)
				{alert(WDF_FILE_TYPE_ERROR);
				break;}
			
			x=document.getElementById(i-1+'_element_label'+form_id);
			while(x.firstChild)
			{
				x=x.firstChild;
			}
			
			alert(ReqFieldMsg.replace('`FIELDNAME`', '"'+x.nodeValue+'" '));
			
			break;
		}
		
	}
	if(seted)
	for(i=0; i<=n; i++)
	{	
		if(document.getElementById(i))
			if(document.getElementById(i).getAttribute("type")=="type_submitter_mail")
				if (document.getElementById(i+"_element"+form_id).value!='' && document.getElementById(i+"_element"+form_id).value.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) == -1)
				{
							alert(WDF_INVALID_EMAIL);	
							return;
				}		

	}

	if (seted) {
		return true;
  }
}	
	
function create_headers(form_id) {
  if (a[form_id] == 1) {
    return;
  }
  a[form_id] = 1;
  document.getElementById("form" + form_id).submit();
}

var rated=false;

function change_src(id,a,form_id){
	if(rated==false){
	for(var j=0;j<=id;j++)
	document.getElementById(a+'_star_'+j).src = plugin_url+'/images/star_'+document.getElementById(a+'_star_color'+form_id).value+".png";
}
}


function reset_src(id,a){
	if(rated==false){
	for(var j=0;j<=id;j++)
	document.getElementById(a+'_star_'+j).src= plugin_url+'/images/star.png';
	}
}


function select_star_rating(id,a,form_id)
{
	rated=true;
	star_amount=document.getElementById(a+'_star_amount'+form_id).value;
	for(var j=0;j<=id;j++)
	document.getElementById(a+'_star_'+j).src = plugin_url+'/images/star_'+document.getElementById(a+'_star_color'+form_id).value+".png";
	for(var k=id+1;k<=star_amount-1;k++)
	document.getElementById(a+'_star_'+k).src = plugin_url+'/images/star.png';
	document.getElementById(a+'_selected_star_amount'+form_id).value=id+1;
}




function sum_grading_values(num,form_id){

	var sum = 0;
	for(var k=0; k<100;k++)
	{
		if(document.getElementById(num+'_element'+form_id+k))
			if(document.getElementById(num+'_element'+form_id+k).value)
			{
				sum = sum+parseInt(document.getElementById(num+'_element'+form_id+k).value);
			}
			
        if(document.getElementById(num+'_total_element'+form_id)){
		if (sum > document.getElementById(num+'_total_element'+form_id).innerHTML){
      document.getElementById(num+'_text_element'+form_id).innerHTML = WDF_GRADING_TEXT + ' ' + document.getElementById(num+'_total_element'+form_id).innerHTML;
      // document.getElementById(num+'_text_element'+form_id).innerHTML = " Your score should be less than "+document.getElementById(num+'_total_element'+form_id).innerHTML;
		}
		else{
		document.getElementById(num+'_text_element'+form_id).innerHTML="";
		}
		}
	}
	
	 if(document.getElementById(num+'_sum_element'+form_id))
	document.getElementById(num+'_sum_element'+form_id).innerHTML = sum;

}






function set_total_value(id,form_id) {
var div_paypal_show= jQuery('.paypal_total'+form_id);
var div_paypal_products = jQuery('.paypal_products'+form_id);
var div_paypal_tax = jQuery('.paypal_tax'+form_id);
var input_paypal_total = jQuery('.input_paypal_total'+form_id);
var total=0;

	if(div_paypal_products)
	div_paypal_products.html('');
	div_paypal_tax.html('');
	n=parseInt(document.getElementById('counter'+form_id).value);
	

	for(i=0; i<n; i++)


	{	
	

		if(document.getElementById(i+"_type"+form_id))
		{

				type=document.getElementById(i+"_type"+form_id).value;


					switch(type)


					{
	
						case "type_paypal_checkbox":
					
						case "type_paypal_radio":
					
						case "type_paypal_shipping":


							{

		

								for(j=0; j<100; j++)


									if(document.getElementById(i+"_element"+form_id+j))


										if(document.getElementById(i+"_element"+form_id+j).checked)


										{

										
											var div = document.createElement('div');
												div.style.cssText = "display:table-row";

											var span_label = document.createElement('div');
												span_label.style.cssText = "display:table-cell";
												span_label.innerHTML= document.getElementById(i+"_elementlabel_"+form_id+j).value;
											
											var span_value = document.createElement('div');
												span_value.style.cssText = "display:table-cell";
												span_value.style.cssText = 'margin-left: 7px;';
												
											if(document.getElementById(i+"_element_quantity"+form_id) && document.getElementById(i+"_element_quantity"+form_id).value!=1)
											{
												span_value.innerHTML= FormCurrency + document.getElementById(i+"_element"+form_id+j).value+' x'+document.getElementById(i+"_element_quantity"+form_id).value;
												total =total + document.getElementById(i+"_element_quantity"+form_id).value * parseInt(document.getElementById(i+"_element"+form_id+j).value);
										
											}	
											else
											{
												span_value.innerHTML= FormCurrency + document.getElementById(i+"_element"+form_id+j).value;
												total =total + parseInt(document.getElementById(i+"_element"+form_id+j).value);
											}		
												
												
												div.appendChild(span_label);
												div.appendChild(span_value);
												div_paypal_products.append(div);
												
																					
										
										


										}
                    if(FormPaypalTax != 0)
										div_paypal_tax.html('Tax: ' + FormCurrency + ((total*FormPaypalTax) / 100).toFixed(2));	
										
									jQuery('.div_total'+form_id).html(FormCurrency + (total *(1+FormPaypalTax/100)).toFixed(2));	
										
								break;

							}


							case "type_paypal_select":


							{	

							
								for(j=0; j<document.getElementById(i+"_element"+form_id).childNodes.length; j++)

								
									if(document.getElementById(i+"_element"+form_id).childNodes[j].selected==true && document.getElementById(i+"_element"+form_id).childNodes[j].value)


										{

									
											var div = document.createElement('div');
												div.style.cssText = "display:table-row";

											var span_label = document.createElement('div');
												span_label.style.cssText = "display:table-cell";
												span_label.innerHTML= document.getElementById(i+"_element"+form_id).childNodes[j].innerHTML;
											
											var span_value = document.createElement('div');
												span_value.style.cssText = "display:table-cell";
												span_value.style.cssText = 'margin-left: 7px;';
												
											if(document.getElementById(i+"_element_quantity"+form_id) && document.getElementById(i+"_element_quantity"+form_id).value!=1)
											{
												span_value.innerHTML= FormCurrency + document.getElementById(i+"_element"+form_id).childNodes[j]+' x'+document.getElementById(i+"_element_quantity"+form_id).value;
												total =total + document.getElementById(i+"_element_quantity"+form_id).value * parseInt(document.getElementById(i+"_element"+form_id).childNodes[j].value);
										
											}	
											else
											{
												span_value.innerHTML= FormCurrency + document.getElementById(i+"_element"+form_id).childNodes[j].value;
												total =total + parseInt(document.getElementById(i+"_element"+form_id).childNodes[j].value);
											}	
											
											
												div.appendChild(span_label);
												div.appendChild(span_value);
												div_paypal_products.append(div);
												
																					
										
										


										}
										
									if(FormPaypalTax != 0)
										div_paypal_tax.html('Tax: ' + FormCurrency + ((total*FormPaypalTax) / 100).toFixed(2));	
																	
									jQuery('.div_total'+form_id).html(FormCurrency + (total *(1+FormPaypalTax/100)).toFixed(2));	
										

								break;


							}
							
							case "type_paypal_price":


							
							{	

							if(document.getElementById(i+"_element_dollars"+form_id).value || document.getElementById(i+"_element_cents"+form_id).value)
							{
							
								
											var div = document.createElement('div');
												div.style.cssText = "display:table-row";
												

											var span_label = document.createElement('div');
												span_label.style.cssText = "display:table-cell";
												span_label.innerHTML= document.getElementById(i+"_element_label"+form_id).innerHTML;
										

											var span_value = document.createElement('div');
												span_value.style.cssText = "display:table-cell";
												span_value.style.cssText = 'margin-left: 7px;';
												
												if(document.getElementById(i+"_element_cents"+form_id) && document.getElementById(i+"_element_cents"+form_id).value)
												{
													if(document.getElementById(i+"_element_dollars"+form_id).value)
													var dollars = document.getElementById(i+"_element_dollars"+form_id).value;
													else
													var dollars = 0;
													
														if(document.getElementById(i+"_element_cents"+form_id).value.length==1)
														span_value.innerHTML=  dollars+'.0'+document.getElementById(i+"_element_cents"+form_id).value;
													
														else
														span_value.innerHTML= dollars+'.'+document.getElementById(i+"_element_cents"+form_id).value;
													
												}
												else
												span_value.innerHTML=  document.getElementById(i+"_element_dollars"+form_id).value;

												
												
												total =total + parseFloat(span_value.innerHTML);
												span_value.innerHTML = FormCurrency + span_value.innerHTML;
												
												
												div.appendChild(span_label);
												div.appendChild(span_value);
												div_paypal_products.append(div);
										
							}
              if(FormPaypalTax != 0)
										div_paypal_tax.html('Tax: ' + FormCurrency + ((total*FormPaypalTax) / 100).toFixed(2));	
																	
									jQuery('.div_total'+form_id).html(FormCurrency + (total *(1+FormPaypalTax/100)).toFixed(2));	
								break;
							}
					}	
		}
	}
  input_paypal_total.val(FormCurrency + (total *(1+FormPaypalTax/100)).toFixed(2))  ;	
}
