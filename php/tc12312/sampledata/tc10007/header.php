<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>City of London Investment Group PLC - Overview</title>
<link rel="stylesheet" href="CSS/responsive.css" />
<link rel="stylesheet" href="CSS/slicknav.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>

<body>
<div id="wrapper">
    <div id="topnav">
    	<?php if (empty($_SESSION['user'])): ?>
      <a href="login.php" alt="Client Login" title="Client Login">Client Login</a><span class="topNavbody">&nbsp;|&nbsp;</span>
      <?php else: ?>
      <a href="?logout=1" alt="Log out" title="Log out">Log Out</a><span class="topNavbody">&nbsp;|&nbsp;</span>
      <?php endif; ?>
        <a href="#" alt="Investor Relations" title="Investor Relations">Investor Relations</a><span class="topNavbody">&nbsp;|&nbsp;</span>
        <a href="#" alt="Contact Us" title="Contact Us">Contact Us</a>
    </div>
	<div id="logo"><a href="#"><img src="images/COLShield-PLC.png" border="0" class="colLogo" alt="City of London Investment Group PLC" title="City of London Investment Group PLC Logo" /></a></div>
    <div id="mobilemenu"></div>
    <div id="mainnav">
      <ul id="menu">
        <li><a href="#" alt="City of London Investment Group PLC Homepage">Home</a></li>
        <li class="has-child"><a href="company_overview.html" alt="About Us">About Us</a>
          <ul class="child">
            <li><a href="company_overview.html" alt="Company Overview">Company Overview</a></li>
            <li><a href="#" alt="History">History</a></li>
            <li><a href="#" alt="Investment Process">Investment Process</a></li>
            <li><a href="#" alt="Investment Offices">Investment Offices</a></li>
          </ul>
        </li>
        <li class="has-child"><a href="#" alt="Strategies">Strategies</a>
          <ul class="child">
            <li><a href="#" alt="Emerging Market CEF Strategy">Emerging Market CEF Strategy</a></li>
            <li><a href="#" alt="Developed CEF Strategy">Developed CEF Strategy</a></li>
            <li><a href="#" alt="Frontier Markets Fund Strategy">Frontier Markets Fund Strategy</a></li>
            <li><a href="#" alt="GTAA CEF Strategy">GTAA CEF Strategy</a></li>
            <li><a href="#" alt="Tactical Income CEF Strategy">Tactical Income CEF Strategy</a></li>
          </ul>
        </li>
        <li class="has-child"><a href="#" alt="UCITS">UCITS</a>
          <ul class="child">
            <li><a href="#" alt="Overview">Overview</a></li>
            <li><a href="#" alt="The Emerging World Fund">The Emerging World Fund</a></li>
            <li><a href="#" alt="The Emerging World Fund Italiano">The Emerging World Fund Italiano</a></li>
            <li><a href="#" alt="The Global Equity Fund">The Global Equity Fund</a></li>
            <li><a href="#" alt="Fund Prices">Fund Prices</a></li>
            <li><a href="#" alt="UK Tax">UK Tax</a></li>
          </ul>
        </li>
        <li class="has-child"><a href="#" alt="Macro">Macro</a>
          <ul class="child">
            <li><a href="#" alt="Emerging Markets Outlook">Emerging Markets Outlook</a></li>
            <li><a href="#" alt="Developed Markets Outlook">Developed Markets Outlook</a></li>
            <li><a href="#" alt="Frontier Markets Outlook">Frontier Markets Outlook</a></li>
          </ul>
        </li>
        <li><a href="#" alt="Closed-End Fund Corporate Governance">CEF CG</a></li>
        <li><a href="#" alt="Environmental, Social and Governance Investing">CEF ESG</a></li>
      </ul>
    </div>
    <div id="maincontent">
