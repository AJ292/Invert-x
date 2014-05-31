{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=EditArticle id=$model->ID}">&lt; Back to Edit Page</a>
    <h2>Publish Article</h2>
    {if $can_publish}
        {form}
        <div class="nice-forms nice-centered">
            <p>
                Both authors are ready to publish this topic! Publishing will make the topic viewable to the public.
            </p>
            <p>
                {submit value='Publish Now!'}
            </p>
        </div>
        {/form}
    {else}
        <p>
            One or both of the authors are not ready to publish this topic, please tell them to hurry up and finish their article!
        </p>
    {/if}
</div>