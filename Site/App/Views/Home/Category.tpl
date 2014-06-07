{content name=Header}
    {if $latest}
        <div class="article-header-container" style="background-image: url('{resolve path="Content/Banners/{$latest->BannerImage}"}');">
            <div class="section-info"><h2>{$model->Name}</h2></div>
            <div class="topic-info {$latest->Class}">
                <h4 class="latest">Latest feature</h4>
                <h1><a href="{resolve path=$latest->Url}">{$latest->Title}</a></h1>
                <h2>{$latest->TagLine}</h2>
                <h3>Published {Date::Format('j F, Y', $latest->Date)}</h3>
            </div>
        </div>
    {/if}
{/content}

<div class="post-container">
    <div class="recent-archive-container">
        {foreach $recent as $topic}
            <div class="archive-table-poster" style="background-image: url('{resolve path="Content/Banners/{$topic->ArchivesImage}"}');">
                <a href="{resolve path=$topic->Url}" title="{$topic->Title|escape}">{$topic->Title}</a>
            </div>
        {foreachelse}
            <em>There isn't anything here yet. Come back later!</em>
        {/foreach}
    </div>
    {$prev=null}
    {foreach $remaining as $group}
        <ul class="archive-list">
            {foreach $group as $topic}
                {$year=Date::Format('Y', $topic->Date)}
                {if $prev != $year}
                    <li class="year">{$year}</li>
                    {$prev=$year}
                {/if}
                <li><a href="{resolve path=$topic->Url}">{$topic->Title}</a></li>
            {/foreach}
        </ul>
    {/foreach}
</div>