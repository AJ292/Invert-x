<div class="author-container">
    {if $side == 'right'}
        <h2 class="author-content">{$model->TagLine}</h2>
    {/if}
    <div class="author-info">
        <img src="{resolve path="Content/Avatars/{$model->AvatarImage}"}" alt="{$model->UserName}">
        <br>By <span class="author-name">{$model->UserName}</span>
    </div>
    {if $side != 'right'}
        <h2 class="author-content">{$model->TagLine}</h2>
    {/if}
</div>
<div class="article-content">
    {$model->HtmlContent}
</div>