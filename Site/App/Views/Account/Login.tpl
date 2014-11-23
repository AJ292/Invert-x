
{content name=Header}
    <div class="article-header-container" style="background-image: url('{resolve path="Content/Banners/Gandalf.jpg"}');">
        <div class="topic-info">
            <h1>YOU SHALL NOT PASS</h1>
            <h2>...without a login.</h2>
        </div>
    </div>
{/content}

<div class="post-container">
    <div class="nice-forms">
        {form}
            <h2>Login With OpenID</h2>
            <p>
                {label for=Authentication::$post_openid text='OpenID'}
                {field type=openid for=Authentication::$post_openid html_class=''}
                {validation for=Authentication::$post_openid}
            </p>
            <p>
                {field for=Authentication::$post_remember type=checkbox html_class=''}
                {label for=Authentication::$post_remember text='Remember Me'}
            </p>
            <p>
                {submit}
            </p>
        {/form}
    </div>
</div>