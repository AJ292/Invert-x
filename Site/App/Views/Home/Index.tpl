{content name=Header}
    <div class="article-header-container" style="background-image: url('{resolve path='Content/Banners/Dear-Esther.jpg'}');">
        <div class="topic-info">
            <h4>Latest feature</h4>
            <h1><a href="article-01.html">Dear Esther</a></h1>
            <h2>Questioning what makes a game, a game.</h2>
            <h3>Published 31 March, 2013</h3>
        </div>
    </div>
{/content}

<style>
    .news-label .label-text:after {
        background: url("/ix/Content/Images/game-news-label.svg") repeat scroll 0 0 rgba(0, 0, 0, 0);
        content: " ";
        height: 20px;
        width: 20px;
        z-index: 9999;
    }
</style>

<div class="index-container">

    <div class="left-column">

        {foreach $news as $n}
            <div class="int-news-article">
                <div class="news-label">
                    <span class="label-text {$n->Class}">{$n->SectionName}</span>
                </div>
                <img src="{resolve path='Content/Images/contentMusic.jpg'}" class="int-news-article-image" alt="{$n->Heading|escape}">
                <h2>{actlink text=$n->Heading action=News controller=Home id=$n->ID}</h2>
                <p><i>Published {Date::Format('j F, Y', $n->Created)} by <strong>{$n->UserName}</strong></i></p>
                <div>{$n->HtmlSummary}</div>
            </div>
        {/foreach}

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
