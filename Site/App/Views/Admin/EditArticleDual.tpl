{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a><br>
    <a rel="ajax" href="{action action=Topics}">&lt; Back to Topic List</a>
    <h2>Editing Articles For Topic: {$model->Title}</h2>
    <a rel="ajax" href="{action action=EditTopic id=$model->ID}">Edit Topic Details &gt;</a><br>
    <a rel="ajax" href="{action action=PublishTopic id=$model->ID}">Publish &gt;</a>
    <div class="post-container">
        {$arr = array('left', 'right')}
        {for $i = 0; $i < 2; $i++}
            {$lr = $arr[$i]}
            {$art = $articles[$i]}
            {$dis = !$model->Published && Authentication::GetUserID() != $art->UserID}
            {$tg = $art->TagLine}
            {$cn = $art->Content}
            {if $dis}
                {$tg = preg_replace('/[a-z0-9]/i', '?', $tg)}
                {$cn = preg_replace('/[a-z0-9]/i', '?', $cn)}
            {/if}
            {form}
                <div class="post-{$lr} nice-forms nice-480">
                    <p>
                        {hidden for=ID model=$art}
                        {label for=UserID text='Author' html_for="AuthorForm$lr"}
                        {select for=UserID model=$art disabled=$dis html_id="AuthorForm$lr"}
                    </p>
                    <p>
                        {label for=TagLine text='Tag Line' html_for="TagLineForm$lr"}
                        {field for=TagLine value=$tg disabled=$dis html_id="TagLineForm$lr"}
                        {validation for=TagLine}
                    </p>
                    <p>
                        {checkbox for=Ready model=$art disabled=$dis html_id="ReadyForm$lr"}
                        {label for=Ready text='Ready to publish' html_for="ReadyForm$lr"}
                    </p>
                    <p>
                        <a rel="ajax" href="{action action=PreviewArticle id=$art->ID}">View Article Preview &gt;</a>
                    </p>
                    <p>
                        {label for=Content html_for="ContentForm$lr"}
                        {textarea for=Content value=$cn html_class='ridiculous' disabled=$dis html_id="ContentForm$lr"}
                        {validation for=Content}
                    </p>
                    <p>
                        {checkbox for=Switch disabled=$dis html_id="SwitchForm$lr"}
                        {label for=Switch text='Switch left and right articles' html_for="SwitchForm$lr"}
                    </p>
                    <p>
                        {submit value='Edit' disabled=$dis}
                    </p>
                </div>
            {/form}
        {/for}
    </div>
</div>