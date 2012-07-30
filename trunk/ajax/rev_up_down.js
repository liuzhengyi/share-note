var xmlHttp = getXmlHttpObject();

function rev_up(rid)
{
	if(xmlHttp == null) {
		alert("您的浏览器不支持ajax");
		return;
	}
	url = "action/ajax/rev_up.php";
	url += "?rid=";
	url += rid;
//	xmlHttp.open("GET", url, true);
	xmlHttp.open("GET", url, false);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange=stateChangedUp(rid);
}

function rev_down(rid)
{
	if(xmlHttp == null) {
		alert("您的浏览器不支持ajax");
		return;
	}
	url = "action/ajax/rev_down.php";
	url += "?rid=";
	url += rid;
//	xmlHttp.open("GET", url, true);
	xmlHttp.open("GET", url, false);
	xmlHttp.send(null);
	xmlHttp.onreadystatechange=stateChangedDown(rid);
}

function stateChangedUp(id)
{
	if(xmlHttp.readyState == 4 || xmlHttp.readgState == "complete") {
		text = xmlHttp.responseText;
		hintid = 'txthint'+id;
		id = 'pa'+id;
		if('a' == text) {
			msg = "不登录可没法投票";
		} else if ('b' == text) {
//			oldmsg = document.getElementById(id).innerHTML;
			msg = "您票已投，多投无效。";
//			setTimeout("document.getElementById(id).innerHTML=oldmsg", 1000);
		} else {
			msg = "你勇敢的表达了支持。";
			document.getElementById(id).innerHTML=text;
		}
		document.getElementById(hintid).innerHTML=msg;
	}
}

function stateChangedDown(id)
{
	if(xmlHttp.readyState == 4 || xmlHttp.readgState == "complete") {
		text = xmlHttp.responseText;
		hintid = 'txthint'+id;
		id = 'ca'+id;
		if('a' == text) {
			msg = "不登录可没法投票";
		} else if ('b' == text) {
			msg = "您票已投，多投无效。";
		} else {
			msg = "你勇敢的表达了反对。";
			document.getElementById(id).innerHTML=text;
		}
		document.getElementById(hintid).innerHTML=msg;

	}
}


function getXmlHttpObject()
{
	var xmlHttp = null;
	try{
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		try{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}

	return xmlHttp;
}
