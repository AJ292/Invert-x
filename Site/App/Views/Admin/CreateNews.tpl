{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a>
    <h2>Create New News</h2>
    {form upload=true}
        <div class="nice-forms nice-centered">
            <p>
                {label for=Heading}
                {field for=Heading}
                {validation for=Heading}
            </p>
            <p>
                {label for=CategoryID text=Category}
                {select for=CategoryID}
                {validation for=CategoryID}
            </p>
            <p>
                {label for=Image text='Image'}
                {field type=file for=Image}
                {validation for=Image}
            </p>
            <p>
                {label for=Summary text='Summary'}
                {textarea for=Summary}
            </p>
            <p>
                {label for=Content text='Content'}
                {textarea for=Content}
            </p>
            <p>
                {label for=NewsTags text='Tags'}<br>
                {hidden for=AllTags value=$AllTags}
                {hidden for=NewsTags value=$NewsTags html_class=tags}
            </p>
            <p>
                {submit value='Create News'}
            </p>
        </div>
    {/form}
</div>