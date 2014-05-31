{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a>
    {if count($drafts) > 0}
    <h2>Draft Topics</h2>
    <ul>
        {foreach $drafts as $topic}
            <li><a rel="ajax" href="{action action=EditArticle id=$topic->ID}">{$topic->Title}</a> [{$topic->Type}]</li>
        {/foreach}
    </ul>
    {/if}
    <h2>Published Topics</h2>
    <ul class="admin-list">
        {foreach $model as $topic}
            <li><a rel="ajax" href="{action action=EditArticle id=$topic->ID}">{$topic->Title}</a> [{$topic->Type}]</li>
        {/foreach}
    </ul>
</div>