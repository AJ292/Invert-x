{partial view=_AdminShared}

<div class="post-container">
    <a rel="ajax" href="{action action=EditArticle id=$model->ID}">&lt; Back to Edit Page</a>
    <h2>Publish Article</h2>
    {if $can_publish}
        {form}
        <div class="nice-forms nice-960 nice-centered">
            <p>
                {if $model->Type == 'Dual'}
                    Both authors are ready to publish this topic!
                {else}
                    You are ready to publish this topic!
                {/if}
                Publishing will make the topic viewable to the public.
            </p>
            <p>
                {submit value='Publish Now!'}
            </p>
        </div>
        {/form}
    {else}
        <p>
            {if $model->Type == 'Dual'}
                One or both of the authors are not ready to publish this topic, please tell them to hurry up and finish their article!
            {else}
                The article for this topic could not be located! Something appears to be going wrong.
            {/if}
        </p>
    {/if}
</div>