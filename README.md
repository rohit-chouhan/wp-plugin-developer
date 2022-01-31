# wp-plugin-developer
A hookbook for creating WordPress plugin

# What is WordPress (WP)
WordPress is a free and open-source content management system written in PHP and paired with a MySQL or MariaDB database. Features include a plugin architecture and a template system, referred to within WordPress as Themes.

# What is WP Plugin
WordPress plugins are apps that allow you to add new features and functionality to your WordPress website. Exactly the same way as apps do for your smartphone. There are more than 48,000 free plugins available right now on the WordPress.org plugin directory.

## Create First Plugin
for creating your first wp plugin, you need to create a one folder inside your wordpress directory. follow the step below mention
- Go to your WordPress Root Folder **\wordpress-folder\wp-content\plugins**
- Create new Folder Inside e.x. **wp-demo**
- Open your **wp-demo** in VSCODE

Those all are your first step to create wordpress plugin folder, now you have to start coding part.

## Plugin Details
![](https://awesomescreenshot.s3.amazonaws.com/image/2293567/21182350-ad74eda4db221956bba883eb76c69dc4.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJSCJQ2NM3XLFPVKA%2F20220131%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20220131T063449Z&X-Amz-Expires=28800&X-Amz-SignedHeaders=host&X-Amz-Signature=fa4d8040786ce1db792422d72bcb931a635aecdbcdce67707364b02d0cc20ef7)

You need to give your plugin details like name, description, author etc, mention in above photo. follow below step to create plugin deatails file.

### Step
- Create new file inside your plugin folder with name **init.php**
- And Put The code in this file mention below

```php
<?php
/*
Plugin Name: My First Plugin
Plugin URI: https://rohitchouhan.com
Description: This is my first wordpress plugin
Version: 1.0.0
Author: Rohit Chouhan
Author URI: https://rohitchouhan.com
*/
```
Write this code and save it, you will see this plugin in your wordpress plugin page.

## Create Menu and Pages
First mind the function need to be use in creating menu and page, when you create menu, pages will also created automatically in back-end you just need to add front-end.
***Note:*** which parameters are inside {}, its fixed name do not replace or change.
|   function| desc  | parameter  |
| ------------ | ------------ | ------------ |
|  add_action(); |  Predefined function to add actions/componanet to wp plugin  |   `{admin_menu}`, `function_name` |
|  add_menu_page() | will add menu to sidebar of wordpress page  | `page_title` , `menu_name`, `{manage_options}`, `menu_slug`, `page_function`  |
|  add_submenu_page() |  to add sub menu in parent menu | `parent_menu_slug`,  `page_title` , `menu_name`, `{manage_options}`, `menu_slug`, `page_function`   |

