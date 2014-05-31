{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=EditNews id=$model->ID}">&lt; Back to News Post</a>
    <h2>Delete News: {$model->Heading}</h2>
    {form}
        <p>
            Are you sure you want to delete this news post?<br>
            {$model->Heading}
        </p>
        <p>
            {submit value='Delete'}
        </p>
    {/form}
</div>