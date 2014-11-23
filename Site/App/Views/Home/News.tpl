<div class="post-container">
    <div class="news-label">
        <span class="label-text">{$model->SectionName}</span>
    </div>
    <div class="news-article-leader-image">
        <img src="{resolve path="Content/News/{$model->Image}"}">
    </div>
    <div class="news-article-content">
        <div class="author-container">
            <p>
                <img src="{resolve path="Content/Avatars/{$model->AvatarImage}"}" alt="{$model->UserName|escape}"><br>
                By <span class="author-name">{$model->UserName}</span>
            </p>
        </div>
        <h1>{$model->Heading}</h1>
        <h2>Published {Date::Format('j F, Y', $model->Created)}</h2>
        <div>
            {$model->HtmlContent}
        </div>
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
    </div>
</div>
<h2 class="comments-header">COMMENTS</h2>
<div class="comments">

</div>