<div class="author-container">
    <div class="author-info">
        <img src="{resolve path="Content/Avatars/{$model->AvatarImage}"}" alt="{$model->UserName}">
        <br>By <span class="author-name">{$model->UserName}</span>
    </div>
    <h2>{$model->TagLine}</h2>
</div>
<div class="article-content">
    {$model->HtmlContent}
</div>