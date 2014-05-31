{content name=Header}
    {$latest = $topics[0]}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/Banners/{$latest->BannerImage}"}');">
        <div class="topic-info">
            <h4>Latest feature</h4>
            <h1><a href="{resolve path=$latest->Url}">{$latest->Title}</a></h1>
            <h2>{$latest->TagLine}</h2>
            <h3>Published {Date::Format('j F, Y', $latest->Date)}</h3>
        </div>
    </div>
{/content}

<style>
    /* Proposed changes */
    .news-article-image {
        border: 1px solid white;
        border-radius: 4px;
        box-shadow: 2px 2px 2px #CCCCCC;
    }
    .games .news-article-image {
        border-color: #E13C36;
    }
    .films .news-article-image {
        border-color: #15948B;
    }
</style>

<div class="index-container">

    <div class="left-column">

        {foreach $news as $n}
            <div class="{$n->Class} news-article">
                <div class="news-label">
                    <span class="label-text">{$n->SectionName}</span>
                </div>
                <img src="{resolve path="Content/News/{$n->Image}"}" class="news-article-image" alt="{$n->Heading|escape}">
                <h2>{actlink text=$n->Heading action=News controller=Home id=$n->ID}</h2>
                <p><i>Published {Date::Format('j F, Y', $n->Created)} by <strong>{$n->UserName}</strong></i></p>
                <div>{$n->HtmlSummary}</div>
            </div>
        {/foreach}
        <div class="games news-article">
   						<div class="news-label">
   							<span class="label-text">INVERT-Xtras</span>
   						</div>
   						<img src="{resolve path='Content/Images/contentMusic.jpg'}" class="news-article-image" alt="Article name">
   						<h2><a href="game-news-article.html">Music of the Week: Magical Trick Society</a></h2>
   						<p><i>Published 31 March, 2013 by <a href="#">AJ</a></i></p>
   						<p>Kotaku has posted some excellent news on what Wright has been up to lately, with some great art to go with it. Well worth a read.</p>
   					</div>

    </div>

    <div class="right-column">
        <ul class="site-tools">
            <li><a href="#"><img src="{resolve path='Content/Images/rss.png'}" alt="RSS"></a></li>
            <li><a href="#"><img src="{resolve path='Content/Images/facebook.png'}" alt="FB"></a></li>
            <li><a href="#"><img src="{resolve path='Content/Images/google.png'}" alt="G+"></a></li>
        </ul>
        <h2>What is this place?</h2>
        <p>Built from scratch and captained by two Australian nerds, <a href="http://scrub-studios.com/">AJ</a> and <a href="http://logic-and-trick.com">Logic &amp; Trick</a>, Invert-x is a game and film blog containing a variety of dual-author columns, short-form articles and musings about all things gaming and all things cinema.</p>
        <p>Want to send something for us to take a look at? <a href="mailto:contact@invert-x.com">Get in touch with us.</a></p>
        <h2>Latest features</h2>

        {foreach $topics as $topic}
            <a class="promo-reel-section {$topic->Class}" href="{resolve path=$topic->Url}">
                <div class="promo-reel-image" style="background-image: url('{resolve path="Content/Banners/{$topic->ArchivesImage}"}')">
                    <div class="promo-reel-item item-film">
                        <h1>{$topic->Title}</h1>
                        <h2>{$topic->TagLine}</h2>
                    </div>
                </div>
            </a>
        {/foreach}
    </div>

</div>
