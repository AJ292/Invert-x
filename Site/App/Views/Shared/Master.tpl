<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{if $page_title}{$page_title} &ndash; {/if}Invert-x &ndash; The non-competitive, duel to the death.</title>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{resolve path='Content/Styles/normalize.css'}">
        <link rel="stylesheet" href="{resolve path='Content/Styles/style-combined.css'}">
        <link rel="stylesheet" href="{resolve path='Content/Styles/bbcode.css'}">
        <link rel="stylesheet" href="{resolve path='Content/Styles/phoenix.css'}">
		<link rel="shortcut icon" href="{resolve path='Content/Images/favicon.png'}">
        <link rel="alternate" type="application/rss+xml" title="RSS" href="http://feeds.feedburner.com/Invert-x?format=xml">
        <script type="text/javascript" src="{resolve path='Content/Scripts/jquery-1.8.2.min.js'}"></script>
        <script type="text/javascript" src="{resolve path='Content/Scripts/jquery.scrollTo-1.4.3.1.min.js'}"></script>
        <script type="text/javascript" src="{resolve path='Content/Scripts/jquery.easing.1.3.js'}"></script>
        <script type="text/javascript" src="{resolve path='Content/Scripts/site.js'}"></script>
        {placeholder name=js}
	</head>
    <body class="{$body_class|default:''}">
        {partial view=Nav}
        {placeholder name=Header}
        <div class="content-container">
            {$content}
        </div>
        <div id="footer">
            <p>
                Invert-x is copyright <a href="http://scrub-studios.com/">Scrub</a> and <a href="http://logic-and-trick.com/">Logic & Trick</a>, 2014.
                All written content is owned by their respective authors, unless otherwise stated.<br>
                All opinions expressed on the site are that of their authors.
            </p>
            <p>
                <a href="http://scrub-studios.com"><img src="{resolve path='Content/Images/logo-scrub.png'}" alt="Scrub"></a>
                <a href="http://logic-and-trick.com/"><img src="{resolve path='Content/Images/logo-lnt.png'}" alt="Logic & Trick"></a>
            </p>
            <p>
                {actlink text='Admin Login' action=Login controller=Account}
            </p>
            {$phoenix_debug}
        </div>
    </body>
</html>