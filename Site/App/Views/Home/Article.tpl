{content name=Header}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/Banners/{$model->BannerImage}"}');">
        <div class="article-nav">
            {if $prev}
                <a class="prev-article" href="{resolve path=$prev->Url}"><img src="{resolve path='Content/Images/nav-arrow.png'}"></a>
            {/if}
            {if $next}
                <a class="next-article" href="{resolve path=$next->Url}"><img src="{resolve path='Content/Images/nav-arrow.png'}"></a>
            {/if}
        </div>
        <div class="topic-info">
            <h1>{$model->Title}</h1>
            <h2>{$model->TagLine}</h2>
            <h3>Published {Date::Format('j F, Y', $model->Date)}</h3>
            <div class="content-jump">
                <a href="#" class="content-jump-button"><img src="{resolve path='Content/Images/nav-arrow.png'}"></a>
            </div>
        </div>
    </div>
{/content}

<div class="post-container">

    {$article = $articles[0]}
    <div class="post-one">
        <div class="author-container">
            <div class="author-info">
                <img src="{resolve path="Content/Avatars/{$article->AvatarImage}"}" alt="{$article->UserName}">
                <br>By <span class="author-name">{$article->UserName}</span>
            </div>
            <h2>{$article->TagLine}</h2>
        </div>
        <div class="article-content">
            {$article->HtmlContent}
        </div>
    </div>

    {$article = $articles[1]}
    <div class="post-two">
        <div class="author-container">
            <div class="author-info">
                <img src="{resolve path="Content/Avatars/{$article->AvatarImage}"}" alt="{$article->UserName}">
                <br>By <span class="author-name">{$article->UserName}</span>
            </div>
            <h2>{$article->TagLine}</h2>
        </div>
        <div class="article-content">
            {$article->HtmlContent}
        </div>
    </div>
</div>
<p class="closing-paragraph">Dear Esther is available on <a href="#">Steam</a> and other outlets.</p>
<ul class="site-tools">
    <li><a href="#"><img src="{resolve path='Content/Images/rss.png'}" alt="RSS"></a></li>
    <li><a href="#"><img src="{resolve path='Content/Images/facebook.png'}" alt="FB"></a></li>
    <li><a href="#"><img src="{resolve path='Content/Images/google.png'}" alt="G+"></a></li>
</ul>
<h2 class="comments-header">COMMENTS</h2>
<div class="comments">

</div>