{partial view=_AdminShared}

<div class="basic-page-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a><br>
    <a rel="ajax" href="{action action=EditArticle id=$model->ID}">&lt; Back to Article Edit Page</a>
    <h2>Edit Topic: {$origtitle}</h2>
    {form upload=true}
        <div class="nice-forms nice-centered">
            <p>
                {label for=Title}
                {field for=Title model=$model}
                {validation for=Title}
            </p>
            <p>
                {label for=TagLine}
                {field for=TagLine model=$model}
                {validation for=TagLine}
            </p>
            <p>
                {label for=CategoryID text=Category}
                {select for=CategoryID model=$model}
                {validation for=CategoryID}
            </p>
            <p>
                {label for=Url}
                {field for=Url model=$model}
                {validation for=Url}
            </p>
            <p>
                {label for=Date}
                {field for=Date value=$model->Date|date_format:'Y-m-d' html_class='datepicker'}
                {validation for=Date}
            </p>
            <p>
                {label for=BannerImage text='Banner Image'}
                {field type=file for=BannerImage}
                {validation for=BannerImage}
            </p>
            <p>
                {label for=ArchivesImage text='Archives Image'}
                {field type=file for=ArchivesImage}
                {validation for=ArchivesImage}
            </p>
            <p>
                {checkbox for=UseDarkTheme model=$model}
                {label for=UseDarkTheme text='Use Dark Colour Theme'}
            </p>
            <p>
                {label for=NewsText text='Optional News Post'}
                {textarea for=NewsText model=$model}
            </p>
            <p>
                {label for=ClosingText text='Optional Closing Text'}
                {textarea for=ClosingText model=$model}
            </p>
            <p>
                {label for=TopicTags text='Tags'}<br>
                {hidden for=AllTags value=$AllTags}
                {hidden for=TopicTags value=$TopicTags html_class=tags}
            </p>
            <p>
                {submit value='Edit Topic'}
            </p>
        </div>
    {/form}
</div>