Invert-x
========

--SCRIPTING CHANGES TO BE MADE--

RSS
- Utilise main article image for each post
- Remove avatar images
- Add footer note "[Article name] first appeared on <a href="article-link">invert-x</a>."
- Proper RSS protocol for authorship

Admin Panel
- New user registration as a permanent fixture (what are the downsides?)
- Once you log in, go straight to Admin Panel, not return to front page

Global
- How do we solve the image background position issue? Manual override per post?



--TO DO--

Global
- Create subheading styles for all article types
- Create reverse logo

Admin Panel
- Completely restructure
- Devise new logic for bbcode styling

	BBCODE considerations
		- Image positioning for feature articles
		- Subheadings
		- Quotes?

News articles
- Create styling for news articles [DONE]
- Create an archive page for news articles [DONE]

Film archives
- Write explanatory paragraph
- Dates on all content?

Game archives
- Write explanatory paragraph
- Dates on all content?

About
- Write new content for advertising guidelines
- Write disclaimer and legal information

Contact page
- Redesign contact page

Dedicated mobile version of the site



--GENERAL QUESTIONS--

Articles
- Do we give each article type a brand name? Do we use an icon to distinguish between them, or leave it as is?

Search
- Yes or no?

Rich media
- Will HTML-based embed codes work in the editor?
- Do we need some kind of 'enlarge image' JQuery? CSS will resize any image to fit within posts, however.

Content tagging
- Yes or no? Can get very complicated very quickly, but can be useful for establishing related content, particularly for news. Database of tags with clear method of calling them into a post is preferred (instead of database of game titles, film titles and associated information)

Content sharing
- Facebook, Google+ and Twitter are mandatory. Reddit? ShareThis controls. 



--GENERAL NOTES--

Colour styling between sections
1. A class is applied to the body tag. This will bring in the relevant colour scheme.
2. Under <ul class="main-menu-nav">, the logo image file name needs to be altered.

Article types
1. This is controlled entirely by separate stylesheets that correspond to each article type. 

Various sub-heading types
1. Due to the H# tags being used for specific article content, user mandated subheadings are styled with various P classes.

<label>Blah</label><input /> (validation errors go in spans here)
