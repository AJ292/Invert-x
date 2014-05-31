
<div class="post-container">
    <h2>Category: {$model->Name}</h2>

    <h3>Articles</h3>
    <ul>
    {foreach $model->Find('Topic') as $topic}
        <li><a href="{resolve path=$topic->Url}">{$topic->Title}</a></li>
    {/foreach}
    </ul>

    <h3>News Posts</h3>
    <ul>
    {foreach $model->Find('News') as $news}
        <li><a href="{action action=News controller=Home id=$news->ID}">{$news->Heading}</a></li>
    {/foreach}
    </ul>
</div>