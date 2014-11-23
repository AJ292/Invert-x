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

    {if $model->Type == 'Dual'}
        <div class="post-one">
            {partial view=_Article model=$articles[0] side='left'}
        </div>
        <div class="post-two">
            {partial view=_Article model=$articles[1] side='right'}
        </div>
    {else}
        {partial view=_Article model=$articles[0] side=''}
    {/if}
</div>

{if $model->HtmlClosingText}
    <div class="closing-paragraph">
        {$model->HtmlClosingText}
    </div>
{/if}

{if count($tags)}
    <h3 class="article-tags">
        Tagged under:
        {$first=true}
        {foreach $tags as $tag}
            {if !$first}, {/if}
            {$first=false}
            {actlink text=$tag->Tag action=Tag controller=Home tag=$tag->Tag}
        {/foreach}
    </h3>
{/if}

<ul class="site-tools">
    <li><a href="#"><img src="{resolve path='Content/Images/social-rss.svg'}" alt="RSS"></a></li>
    <li><a href="#"><img src="{resolve path='Content/Images/social-facebook.svg'}" alt="FB"></a></li>
    <li><a href="#"><img src="{resolve path='Content/Images/social-reddit.svg'}" alt="Reddit"></a></li>
    <li><a href="#"><img src="{resolve path='Content/Images/social-twitter.svg'}" alt="Twitter"></a></li>
</ul>
<h2 class="comments-header">COMMENTS</h2>
<div class="comments">

</div>