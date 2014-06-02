<div class="post-container">
    <div class="author-container">
        <p>
            <img src="{resolve path="Content/Avatars/{$model->AvatarImage}"}" alt="{$model->UserName|escape}"><br>
            By <span class="author-name">{$model->UserName}</span>
        </p>
    </div>
    <div class="news-article-leader-image">
        <img src="{resolve path="Content/News/{$model->Image}"}">
    </div>
    <h1>{$model->Heading}</h1>
    <h2>Published {Date::Format('j F, Y', $model->Created)}</h2>
    <div>
        {$model->HtmlContent}
    </div>
    {if count($tags)}
        <h3>
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
<h2 class="comments-header">COMMENTS</h2>
<div class="comments">

</div>