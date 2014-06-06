{partial view=_AdminShared}

<div class="post-container">
    <div class="admin-tools-column">
        <h2>Article Tools</h2>
        <ul class="admin-nav">
            <li><a rel="ajax" href="{action action=CreateTopic type=Dual}"><img src="{resolve path='Content/Images/admin-new.png'}">Create new dual-author article</a></li>
            <li><a rel="ajax" href="{action action=CreateTopic type=Single}"><img src="{resolve path='Content/Images/admin-new.png'}">Create new single-author article</a></li>
            <li><a rel="ajax" href="{action action=Topics}"><img src="{resolve path='Content/Images/admin-edit.png'}">Edit existing article</a></li>
        </ul>
    </div>
    <div class="admin-tools-column">
        <h2>News Tools</h2>
        <ul class="admin-nav">
            <li><a rel="ajax" href="{action action=CreateNews}"><img src="{resolve path='Content/Images/admin-new.png'}">Create new news item</a></li>
            <li><a rel="ajax" href="{action action=News}"><img src="{resolve path='Content/Images/admin-edit.png'}">Edit existing news item</a></li>
        </ul>
    </div>
    <div style="clear: both;"></div>
    <div class="admin-tools-column">
        <h2>General Tools</h2>
        <ul class="admin-nav">
            <li><a rel="ajax" href="#"><img src="{resolve path='Content/Images/admin-new.png'}">Register new user</a></li>
            <li><a rel="ajax" href="#"><img src="{resolve path='Content/Images/admin-tools.png'}">Stats and tools</a></li>
        </ul>
    </div>
    <div class="admin-tools-column">
        <h2>Tool Tools</h2>
        <ul class="admin-nav">
            <li><a rel="ajax" href="{action action=Index}"><img src="{resolve path="Content/Images/admin-{$joke[0]}.png"}">{$joke[1]}</a></li>
        </ul>
    </div>
</div>