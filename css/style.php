html{
	height: 100%;
	font-size: 0.625em;
}
body {
	font-family: 'serif';
	max-height: 100%;
	min-width: 600px;
}
a{
	color: #000;
}
form{
	display: inline-block;
}


.showRed{
	color: #ff1919;
}
.showGreen{
	color: #198c19;
}

#header{
	border-bottom: 1px solid #999;
	background-color: #fff;
	color: #000;
	width: 85%;
	margin: 0 auto;
	height: 7%;
}

#logo a{
	position: absolute;
	top: 5%;
	left: 8.2%;

	font-family: 'Merriweather Sans','serif';
	font-weight: bold;
	font-size: 1.6em;
	color: #2b9f7f;
	text-decoration: none;

	transition: 0.3s;
}
#logo a:hover{
	transition: 0.2s;
}

#logo #quoteLogo{
	position: absolute;
	left: 10.8%;
	opacity: 0;
}
#logo #quoteLogo:hover{
	top: 4.2%;
	left: 10.8%%;
	opacity: 1;
	color: #2b9f7f;
	transition: 0.2s;
}

#nav{
	margin: 0 5% 0 0;
	font-size: 1.5em;
	list-style: none;
	text-transform: capitalize;
	display: flex;
	align-items: center;
	-webkit-justify-content: center;
	justify-content: center;
	-webkit-align-items: center;
	z-index: 10;
}
#nav .navlink{
	position: relative;
	display: block;
	height: auto;
	bottom:0;
	top:0;
	left:0;
	right:0;
	padding-top: 1em;
	padding-bottom: .5em;
	padding-right: .5em;
	padding-left: .1em;
}
#nav .navlink a{ text-decoration: none; padding: .4em 1em;}
#nav .navlink a:hover{ background-color: rgba(204,204,153,0.3);}


/* Search box / Submit button*/
#floatleft{
	float: left;
	top: 3%;
	position: absolute;
}
#search{ float: left;}
#search
{
	padding-left: 5px;
	height: 32px;
	width: 125px;
	border: 1px solid #a4c3ca;
	font: normal 13px 'trebuchet MS', arial, helvetica;
	background: #f1f1f1;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);
	float: left;
}
#lookbtn
{
	background-color: #fff;
	background-image: linear-gradient(#fff, #2b9f7f);
	border-radius: 3px 30px 30px 3px;
	border: 0px;
	border-style: solid;
	border-color: #7eba7c #578e57 #447d43;
	box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
	height: 0;
	margin: 0;
	padding: 0;
	width: 90px;
	font: bold .8em Arial, Helvetica;
	color: #23441e;
	text-shadow: 0 1px 0 rgba(255,255,255,0.5);
}
#homebtn:hover, #lookbtn:hover, #searchbtn:hover, #historybtn:hover {
	background-color: #fff;
	background-image: linear-gradient(#e9f5f2, #55b298);
}
#homebtn:active, #lookbtn:active, #searchbtn:active, #historybtn:active {
background: #7fc5b2;
outline: none;
box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
}
#homebtn, #searchbtn, #historybtn, #lookbtn
{
	text-decoration: none;
	text-align: center;
	line-height: 150%;
	background-color: #fff;
	background-image: linear-gradient(#fff, #2b9f7f);
	border: 0;
	box-shadow: 0 0 1px rgba(0, 0, 0, 0.3),0 1px 0 rgba(255, 255, 255, 0.3) inset;
	height: 32px;
	width: 90px;
	font: bold .8em Arial, Helvetica;
	color: #23441e;
	text-shadow: 0 1px 0 rgba(255,255,255,0.5);
	float: left;
}

#introduction{
	border: 3px solid #000;
	width: 550px;
	margin: 30px auto;
}
#searchtable{
	margin: 25px auto 0px auto;
	min-width: 500px;
}
#symboltable{
	margin: 10px auto 0px auto;
	width: 500px;
}
#keytable{
	margin: 5px auto 0px auto;
	width: 500px;
	background: #0096fd;
}
#quotetable{
	margin: 7px auto;
	width: 500px;
}
#fundamentalkeytable{
	margin: 5px auto 0px auto;
	width: 500px;
	background: #0096fd;
}
#fundamentaltable{
	margin: 7px auto;
	width: 500px;
}
#historytitles{
	margin: 0 auto;
	width: 500px;
	border-bottom: 1px solid #0096fd;
}
#historytable{
	margin: 0 auto;
	width: 500px;
}
.request{
	padding-top: 10px;
	text-align: center;
}
#overflow{
	overflow-y: auto;
	overflow-x: hidden;
	margin: 0 auto;
	width: 500px;
	height: 250px;
}
#findtable{
	margin: 7px auto;
	width: 500px;
	max-height: 400px;
	overflow: auto;
}

.date{
	padding: 0 0 0 5px;
	width: 95px;
}
.last{
	width: 80px;
}
.change{
	width: 80px;
	
}
.percentChange{
	width: 80px;
}
.volume{
	width: 100px;
}
.greenbottom{
	border-bottom: 1px solid #b0bda5 !important;
}

#lookkeytable{
	margin: 15px auto 0px auto;
	width: 500px;
	background: #0096fd;
}
.lookone{
	width: 250px;
}
.looktwo{
	width: 95px;
}
.lookthree{
	width: 60px;
}
.lookthree a{
	color: #3232ff;
	text-decoration: none;
}
.lookfour{
	width: 70px;
}
.lookfour a{
	color: #3232ff;
}

#backbtn{
	text-align: center;
	font-size: 1.5em;
	margin: 10px 0 3px 0;
}

.fundFirst{
	width: 145px;
}
.fundSecond{
	text-align: left;
	width: 125px;
}
.fundThird{
	text-align: left;
}
.fundFourth{
	text-align: right;
}

@media (max-width: 780px){
	#logo a{
		left: 5.8%;
	}
	#logo #quoteLogo{
		left: 5.8%;
	}
	#logo #quoteLogo:hover{
		left: 5.8%%;
	}
}

@media (max-width: 715px){
	#logo a{
		left: 2.8%;
	}
	#logo #quoteLogo{
		left: 2.8%;
	}
	#logo #quoteLogo:hover{
		left: 2.8%%;
	}
}
@media (max-width: 655px){
	#search
	{
		width: 105px;
	}
}
@media (max-width: 655px){
	#homebtn, #searchbtn, #historybtn, #lookbtn
	{
		width: 75px;
	}
}

@media (max-height: 570px){
	#header{
		border: none;
	}
}