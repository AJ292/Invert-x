{content name=js}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{resolve path='Content/Scripts/select2.min.js'}"></script>
    <script type="text/javascript" src="{resolve path='Content/Scripts/Admin.js'}"></script>
    <link rel="stylesheet" href="{resolve path='Content/Styles/select2.css'}" />
    <link rel="stylesheet" href="{resolve path='Content/Styles/style-nice-forms.css'}" />
    <style type="text/css">
        @import "https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/dot-luv/jquery-ui.css";
    </style>
    <style>
        .content-container {
            overflow: hidden;
        }
        .post-container {
            transition: all 0.2s ease-in-out;
            left: 0;
            position: relative;
        }
        .post-container.hide-left {
            left: -100%;
        }
        .post-container.hide-right {
            transition: none;
            left: 100%;
        }
        div.nice-forms input[type="checkbox"] {
            margin-left: 0 !important;
        }
        .post-left {
            float: left;
        }
        .post-right {
            float: right;
        }

        .select2-container {
            width: 100%;
        }

        .admin .article-header-container {
            background-position: center;
        }
    </style>
{/content}
{content name=Header}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/Images/AdminBanners/{$banner}"}');">
        <div class="topic-info">
            <h1>THE ADMIN PANEL</h1>
            <h2>Here be dragons!</h2>
        </div>
    </div>
{/content}