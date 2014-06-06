{partial view=_AdminShared}

<div class="post-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a><br>
    <a rel="ajax" href="{action action=Topics}">&lt; Back to Topic List</a>
    <h2>Editing Article For Topic: {$model->Title}</h2>
    <a rel="ajax" href="{action action=EditTopic id=$model->ID}">Edit Topic Details &gt;</a><br>
    <a rel="ajax" href="{action action=PublishTopic id=$model->ID}">Publish &gt;</a>
    <div class="post-container">
        {$art = $articles[0]}
        {$dis = !$model->Published && Authentication::GetUserID() != $art->UserID}
        {$tg = $art->TagLine}
        {$cn = $art->Content}
        {if $dis}
            {$tg = preg_replace('/[a-z0-9]/i', '?', $tg)}
            {$cn = preg_replace('/[a-z0-9]/i', '?', $cn)}
        {/if}
        {form}
            <div class="post-single nice-forms nice-960">
                <p>
                    {hidden for=ID model=$art}
                    {label for=UserID text='Author'}
                    {select for=UserID model=$art disabled=$dis}
                </p>
                <p>
                    {label for=TagLine text='Tag Line'}
                    {field for=TagLine value=$tg disabled=$dis}
                    {validation for=TagLine}
                </p>
                <p>
                    {checkbox for=Ready model=$art disabled=$dis}
                    {label for=Ready text='Ready to publish'}
                </p>
                <p>
                    <a rel="ajax" href="{action action=PreviewArticle id=$art->ID}">View Article Preview &gt;</a>
                </p>
                <p>
                    {label for=Content}
                    {textarea for=Content value=$cn disabled=$dis html_class='enormous'}
                    {validation for=Content}
                </p>
                <p>
                    {submit value='Edit' disabled=$dis}
                </p>
            </div>
        {/form}
    </div>
</div>