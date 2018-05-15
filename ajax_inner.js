// JavaScript Document
var xmlHttp
// start functions for the second inner div

function district(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
function stateChangedinner() 
{ 
document.getElementById("inner").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner").innerHTML=xmlHttp.responseText;
$(".select3").select2();
}
}

function GetXmlHttpObjectinner()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
// end functions for the inner div

function stateChangedinner() 
{ 
document.getElementById("inner").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}

function ward(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner2();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner2;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function lap_unit(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner2();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner2;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChangedinner2() 
{ 
document.getElementById("inner2").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner2").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner2()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
// end functions for the inner2 div

function gbv_unit(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner61();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner61;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

//functionn of gbv category name
function stateChangedinner61() 
{ 
document.getElementById("inner61").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner61").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner61()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}

//end of gbv function
function streetApply(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner3();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner3;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

function stateChangedinner3() 
{ 
document.getElementById("inner3").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner3").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner3()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
// end functions for the inner3 div

function typeApply(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner4();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner4;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

function dispute_client(strone, strtwo, strthree)
{ 
xmlHttp=GetXmlHttpObjectinner4();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo + "&s=" + strthree; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner4;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
} 

function stateChangedinner4() 
{ 
document.getElementById("inner4").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner4").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner4()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
// end functions for the inner4 div

function dispute_status(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner5();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner5;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChangedinner5() 
{ 
document.getElementById("inner5").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner5").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner5()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
// end functions for the inner5 div


function gbv_category(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectrheka();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="ajax_inputs.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedrheka;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

//functionn of gbv category name
function stateChangedrheka() 
{ 
document.getElementById("rheka").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("rheka").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectrheka()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}
