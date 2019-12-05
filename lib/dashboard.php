<?php namespace Evermade\Dashboard;

// remove welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

function customDashboardSetup()
{
    global $app, $wp_meta_boxes;

    // remove all default dashboard meta boxes
    $wp_meta_boxes['dashboard']['normal']['core'] = array();
    $wp_meta_boxes['dashboard']['side']['core'] = array();

    // add custom welcome text widget
    add_meta_box('custom_dashboard_readme', $app->getText('Welcome'), '\Evermade\Dashboard\customDashboardReadme', 'dashboard', 'normal', 'high');

    // add custom quick links
    add_meta_box('custom_dashboard_quick_links', $app->getText('Quick Links'), '\Evermade\Dashboard\customDashboardQuickLinks', 'dashboard', 'side', 'high');
}

function customDashboardReadme() { ?>
    <p><img src="/wp-content/themes/everblox/assets/img/logo-dark.png" width="100" style="float: right; margin: 10px 10px 15px 25px;" /></p>
    <h1><strong>[SITE NAME] Administration Area</strong></h1>
    <p>This is the content management area for the <strong>[SITE NAME]</strong> website.
    If you are a new user, please read through the guide below before making any changes.</p>
    <p><a href="#" target="_blank" class="button button-primary">Content Management Guide</a></p>
    <h3 style="font-size: 18px; margin-top: 30px;"><strong>Technical details</strong></h3>
    <p>[SITE NAME] is a WordPress system with the <strong>Everblox</strong> theme by <a href="https://evermade.fi" target="_blank">Evermade</a>.
    The Pages are built with the <strong>Everblox system</strong>, which gives you full control over the structure.</p>
    <p>There's a caching system in place, meaning that some changes made may not be instantly visible to all users. If you get
    reports of changes not showing up, please click the button below to clear the cache.</p>
    <p><a href="options-general.php?page=wpsupercache&tab=contents" class="button">Clear Cache</a></p>
<?php }

function customDashboardQuickLinks() { ?>
    <h3 style="font-size: 18px; margin-top: 30px;"><strong>Pages</strong></h3>
    <p>Use the Everblox system to create and manage pages.</p>
    <p><a href="edit.php?post_type=page" class="button button-primary">Manage Pages</a></p>
    <h3 style="font-size: 18px; margin-top: 30px;"><strong>Posts</strong></h3>
    <p>Manage the different content types using the WordPress WYSIWYG editor.</p>
    <ul style="list-style-type: disc; padding-left: 15px;">
        <li><a href="edit.php?post_type=story">Stories</a></li>
        <li><a href="edit.php?post_type=contact">Contacts</a></li>
    </ul>
    <h3 style="font-size: 18px; margin-top: 30px;"><strong>Settings</strong></h3>
    <p>Control the global website settings from Website Options. Use the WordPress menu manager to make changes to the navigation structure.</p>
    <p><a href="admin.php?page=theme-general-settings" class="button button-primary">Website Options</a> <a href="nav-menus.php" class="button">Manage Menus</a></p>
<?php }

add_action('wp_dashboard_setup', '\Evermade\Dashboard\customDashboardSetup', 9999 );
