{partial view=_AdminShared}

<div class="post-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a>
    <h2>Newses</h2>
    <ul class="admin-list">
        {foreach $model as $news}
            <li><a rel="ajax" href="{action action=EditNews id=$news->ID}">{$news->Heading}</a></li>
        {/foreach}
    </ul>
</div>