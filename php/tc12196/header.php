<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Page Title</title>

	<style type="text/css">
	/* ref: https://color.adobe.com/Fjord-color-theme-11756940/edit/?copy=true&base=2&rule=Custom&selected=3&name=Copy%20of%20Fjord&mode=rgb&rgbvalues=0.19607843137254902,0.2784313725490196,0.34901960784313724,0.396078431372549,0.47843137254901963,0.5490196078431373,0.9490196078431372,0.9490196078431372,0.9490196078431372,0.7490196078431373,0.6980392156862745,0.43529411764705883,0.5490196078431373,0.4627450980392157,0.30196078431372547&swatchOrder=0,1,2,3,4; */
	/* ref: https://css-tricks.com/snippets/css/system-font-stack/ */
	/* Define the "system" font family */
	@font-face {
	  font-family: system;
	  font-style: normal;
	  font-weight: 300;
	  src: local(".SFNSText-Light"), local(".HelveticaNeueDeskInterface-Light"), local(".LucidaGrandeUI"), local("Ubuntu Light"), local("Segoe UI Light"), local("Roboto-Light"), local("DroidSans"), local("Tahoma");
	}

	/* Now, let's apply it on an element */
	body {
	  font-family: "system";
		background: #657A8C;
	}

	#wrapper {
		width: 800px;
		margin: auto;
		border: 2px solid #BFB26F;
		background: #ffffff;
		border-radius: 22px;
	}

	#masthead {
		background: #8C764D;
		color: #ffffff;
		font-size: 150%;
		height: 80px;
		padding: 1px 0;
		border-radius: 20px 20px 0 0;
		overflow: hidden;
	}

	#pagefooter {
		background: #324759;
		color: #ffffff;
		font-size: 90%;
		padding: 1px 0;
		height: 125px;
		border-radius: 0 0 20px 20px;
	}

	#content {
		padding: 10px 50px;

	}

	#flashmessage {
		background: #F2F2F2;
		border: 1px solid #BFB26F;
		padding: 0.5em 1px;
	}

	form label { 
		display: block;
		margin-bottom: 0.5em;
	}
	form label span, form label input {
		display: inline-block;
	}
	form label span { 
		width: 150px; 
		text-align: right;
		margin-right: 1em;
	}

	</style>
</head>
<body>
	<div id="wrapper">
		<div id="masthead">
			<h1>Demo App</h1>
		</div>

		<div id="content">
			<!-- begin content -->
<?php
		// check for flash messages
		if (!empty($_SESSION['flashMessage'])) {
			?>
			<div id="flashmessage"><?php echo $_SESSION['flashMessage']; ?></div>
			<?php
			unset($_SESSION['flashMessage']); // clear message store
		}

