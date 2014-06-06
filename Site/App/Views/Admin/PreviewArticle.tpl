{partial view=_AdminShared}

{content name=Header}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/{$banner}"}');">
        <div class="topic-info">
            <h1>{$topic->Title}</h1>
            <h2>{$topic->TagLine}</h2>
        </div>
    </div>
{/content}

<div class="post-container">
    <a rel="ajax" href="{action action=EditArticle id=$topic->ID}">&lt; Back to Edit Page</a>
    <h2>Preview Article</h2>
    {if strlen(trim($topic->NewsText)) > 0}
    <div class="news">
        <h3>News</h3>
        {$topic->HtmlNewsText}
    </div>
    {/if}
    <div class="post-container">
        {$arr = array('left', 'right')}
        {for $i = 0; $i < 2; $i++}
            {$lr = $arr[$i]}
            {$art = $model}
            <article class="post-{$lr}">
                {if $lr == $side}
                <header>
                    <div class="author-container-{$lr}">
                        <p>
                            <img src="/Content/Avatars/{$art->Get('User')->AvatarImage}" alt="{$art->Get('User')->Name}"><br>
                            By {$art->Get('User')->Name}
                        </p>
                    </div>
                    <h2>{$art->TagLine}</h2>
                </header>
                {$art->HtmlContent}
                {/if}
            </article>
        {/for}
    </div>
    {hidden for=BannerOverride value="/Banners/{$topic->BannerImage}"}
    {hidden for=TopicOverride value=strtoupper($topic->Title)}
    {if $topic->UseDarkTheme}{hidden for=AltScheme value="YES"}{/if}
</div>