{partial view=_AdminShared}

<div class="post-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a><br>
    <a rel="ajax" href="{action action=News}">&lt; Back to News List Page</a>
    <h2>Edit News: {$origheading}</h2>
    {form upload=true}
        <div class="nice-forms nice-960 nice-centered">
            <p>
                {label for=Heading}
                {field for=Heading model=$model}
                {validation for=Heading}
            </p>
            <p>
                {label for=CategoryID text=Category}
                {select for=CategoryID model=$model}
                {validation for=CategoryID}
            </p>
            <p>
                {label for=Image text='Image'}
                {field type=file for=Image model=$model}
                {validation for=Image}
            </p>
            <p>
                {label for=Summary text='Summary'}
                {textarea for=Summary model=$model}
            </p>
            <p>
                {label for=Content text='Content'}
                {textarea for=Content model=$model}
            </p>
            <p>
                {label for=NewsTags text='Tags'}<br>
                {hidden for=AllTags value=$AllTags}
                {hidden for=NewsTags value=$NewsTags html_class=tags}
            </p>
            <p>
                {submit value='Edit News'}
            </p>
        </div>
    {/form}
    <a rel="ajax" href="{action action=DeleteNews id=$model->ID}">Delete this News &gt;</a>
</div>