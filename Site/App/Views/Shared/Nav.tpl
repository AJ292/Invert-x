<div class="main-menu-container">
    <div class="main-menu">
        <ul class="main-menu-nav">
            <li class="main-menu-logo">
                <a href="{action controller='Home' action='Index'}">
                    <img src="{resolve path='Content/Images/menu-bar-invert.png'}" alt="Invert" class="menu-nav-invert">
                    <img src="{resolve path='Content/Images/menu-bar-x.png'}" alt="X" class="menu-nav-x">
                </a>
                <ul>
                    <li><a href="{action action=Category controller=Home cat=1}">GAMES</a></li>
                    <li><a href="{action action=Category controller=Home cat=2}">FILMS</a></li>
                    <li><a href="{action action=About controller=Home}">ABOUT</a></li>
                    <li><a href="mailto:contact@invert-x.com">CONTACT</a></li>
                    <li>
                        <div class="search">
                            <p><img src="{resolve path='Content/Images/icon-search-white.svg'}" alt="Search"></p> <input type="text">
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>