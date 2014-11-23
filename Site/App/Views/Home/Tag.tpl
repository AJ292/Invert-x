<h1>Tagged with {$tag}</h1>
{foreach $model as $tag}
    <div class="tagged-article">
        {if $tag->Type == 'News'}
            <a class="tagged-article-image" href="{action action=News controller=Home id=$tag->ID}" style="background-image: url('{resolve path="Content/News/{$tag->Image}"}')"></a>
            <div class="tagged-article-content">
                <h2>{actlink text=$tag->Heading action=News controller=Home id=$tag->ID}</h2>
                <p><i>Published {Date::Format('j F, Y', $tag->Created)} by <strong>{$tag->UserName}</strong></i></p>
                <div>{$tag->HtmlSummary}</div>
            </div>
        {elseif $tag->Type == 'Topic'}
            <a class="tagged-article-image" href="{resolve path=$tag->Url}" style="background-image: url('{resolve path="Content/Banners/{$tag->Image}"}')"></a>
            <div class="tagged-article-content">
                <h2><a href="{resolve path=$tag->Url}">{$tag->Heading}</a></h2>
                <p><i>Published {Date::Format('j F, Y', $tag->Created)}</i></p>
                <p>{$tag->HtmlSummary}</p>
            </div>
        {/if}
    </div>
{/foreach}