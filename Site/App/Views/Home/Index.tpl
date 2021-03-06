{content name=Header}
    {$latest=$topics[0]}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/Banners/{$latest->BannerImage}"}');">
        <div class="topic-info {$latest->Class}">
            <h4 class="latest">Latest feature</h4>
            <h1><a href="{resolve path=$latest->Url}">{$latest->Title}</a></h1>
            <h2>{$latest->TagLine}</h2>
            <h3>Published {Date::Format('j F, Y', $latest->Date)}</h3>
        </div>
    </div>
{/content}

<div class="index-container">

    <div class="left-column">

        {foreach $activities as $activity}
            {if $activity->Type == 'News'}
                <div class="{$activity->Class} news-article">
                    <div class="news-label">
                        <span class="label-text">{$activity->SectionName}</span>
                    </div>
                    <a class="news-article-image" href="{action action=News controller=Home id=$activity->ID}" style="background-image: url('{resolve path="Content/News/{$activity->Image}"}')"></a>
                    <div class="news-article-content">
                        <h2>{actlink text=$activity->Heading action=News controller=Home id=$activity->ID}</h2>
                        <p><i>Published {Date::Format('j F, Y', $activity->Created)} by <strong>{$activity->UserName}</strong></i></p>
                        <div>{$activity->HtmlSummary}</div>
                    </div>
                </div>
            {elseif $activity->Type == 'Topic'}
                <a class="{$activity->Class} article-alert" href="{resolve path=$activity->HtmlSummary}"><img src="{resolve path='Content/Images/icon-archive.svg'}"> New article: {$activity->Heading}</a>
            {/if}
        {/foreach}

    </div>

    <div class="right-column">
        <div class="search">
            <p><img src="{resolve path='Content/Images/icon-search.svg'}" alt="Search"></p> <input type="text">
        </div>
        <ul class="site-tools">
            <li><a href="http://feeds.feedburner.com/Invert-x?format=xml"><img src="{resolve path='Content/Images/social-rss.svg'}" alt="RSS"></a></li>
            <li><a href="http://facebook.com/invertx"><img src="{resolve path='Content/Images/social-facebook.svg'}" alt="FB"></a></li>
            <!--li><a href="#"><img src="{resolve path='Content/Images/social-reddit.svg'}" alt="Reddit"></a></li>
            <li><a href="#"><img src="{resolve path='Content/Images/social-twitter.svg'}" alt="Twitter"></a></li-->
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
