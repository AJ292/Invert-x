{partial view=_AdminShared}

<div class="post-container">
    <a rel="ajax" href="{action action=Index}">&lt; Back to Admin Panel</a>
    <h2>Create New {$Type} Topic</h2>
    {form upload=true}
        <div class="nice-forms nice-960 nice-centered">
            <p>
                {label for=Title}
                {field for=Title}
                {validation for=Title}
            </p>
            <p>
                {label for=TagLine}
                {field for=TagLine}
                {validation for=TagLine}
            </p>
            <p>
                {label for=CategoryID text=Category}
                {select for=CategoryID}
                {validation for=CategoryID}
            </p>
            <p>
                {label for=Url}
                {field for=Url}
                {validation for=Url}
            </p>
            <p>
                {label for=Date}
                {field for=Date html_class='datepicker'}
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
                {checkbox for=UseDarkTheme}
                {label for=UseDarkTheme text='Use Dark Colour Theme'}
            </p>
            <p>
                {label for=NewsText text='Optional News Post'}
                {textarea for=NewsText}
            </p>
            <p>
                {label for=ClosingText text='Optional Closing Text'}
                {textarea for=ClosingText}
            </p>
            {if $Type == 'Dual'}
            <p>
                {label for=Users text='Authors'}<br>
                {select for=Users multiple=true multiple_style=checkbox}
                {validation for=Users}
            </p>
            {/if}
            <p>
                {label for=TopicTags text='Tags'}<br>
                {hidden for=AllTags value=$AllTags}
                {hidden for=TopicTags value=$TopicTags html_class=tags}
            </p>
            <p>
                {submit value='Create Topic'}
            </p>
        </div>
    {/form}
</div>