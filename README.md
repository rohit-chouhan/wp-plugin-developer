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
**And Activate It**

## Create Menu and Pages
First mind the function need to be use in creating menu and page, when you create menu, pages will also created automatically in back-end you just need to add front-end.
***Note:*** which parameters are inside {}, its fixed name do not replace or change.
|   function| desc  | parameter  |
| ------------ | ------------ | ------------ |
|  add_action(); |   add actions/componenet to wp plugin  |   `{admin_menu}`, `function_name` |
|  add_menu_page() | add menu to sidebar of wordpress page  | `page_title` , `menu_name`, `{manage_options}`, `menu_slug`, `page_function`  |
|  add_submenu_page() |  add sub menu in parent menu | `parent_menu_slug`,  `page_title` , `menu_name`, `{manage_options}`, `menu_slug`, `page_function`   |

Example: 
```php
function my_demo_menu()
{
	//parent menu
	add_menu_page(
		'Demo Plugin First Page', //page title
		'Demo Dashboard', //menu title
		'manage_options', //capabilities
		'demo_dashboard', //menu slug
		'mydemo_dashboard', //page function
	);

	//this is a submenu
	add_submenu_page(
		'demo_dashboard', //parent slug
		'My New Page', //page title
		'New Page', //menu title
		'manage_options', //capability
		'demo_new_page', //menu slug
		'mydemo_new_page'
	); 
}
add_action('admin_menu', 'my_demo_menu');
```

Now your plugin menus are created inside bar of wordpress site, now you need to create a page for all menus pages. as in above syntax we have **page function**, so you need to create function with name of **page function**. so create new file inside your wordpress plugin e.x. **dashboard.php** and write code in side.

```php
<?php
    function mydemo_dashboard() {
?>
    <h1>Dashboard</h1>
    <p>Hello this is dashboard page</p>
<?php 
    }
?>
```
After creating this page, please inlucde this page to **init.php**.
```php
require_once(plugin_dir_path(__FILE__).'dashboard.php');
```
paste this code in **init.php** after plugin details page.
Now when you click on Demo Dashboard from Menu, you will see this page, So same as your can create multiple function.

Screenshot: 
![](https://awesomescreenshot.s3.amazonaws.com/image/2293567/21186193-83ca1d6a9df3830640e45b64abcb3e1d.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJSCJQ2NM3XLFPVKA%2F20220205%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20220205T133952Z&X-Amz-Expires=28800&X-Amz-SignedHeaders=host&X-Amz-Signature=6aaff1d645c352fb0495bed445cf60a7c5dab6454478b4f3620929c2a23b16d7)

## Load CSS & JS in Plugin or Webpage
If you want to load your custom css and ls file in side your plugin page, then here you need to use **add_action('admin_enqueue_scripts','{}')**, follow below table for function.
### Registring Path
| Function           | Functionality                   | Syntax                                       |
|--------------------|---------------------------------|----------------------------------------------|
| wp_register_style  | Create link path for css styles | wp_register_style(name,path,false,version); and wp_enqueue_style('name');  |
| wp_register_script | Create Link path for JS file    | wp_register_script(name,path,false,version); and wp_enqueue_script('name');|

### Initilizing
| Function           | Functionality                   | Syntax                                       |
|--------------------|---------------------------------|----------------------------------------------|
| admin_enqueue_scripts  | Initilize CSS & JS in admin panel |add_action('admin_enqueue_scripts', 'function_name');  |
| enqueue_scripts  | Initilize CSS & JS in whole site page |add_action('enqueue_scripts', 'function_name');  |

Example:-
```php
function load_static()
{
		wp_register_style('bulma_datatable_css', 'https://cdn.datatables.net/1.11.4/css/dataTables.bulma.min.css', false, '1.0.0');
		wp_enqueue_style('bulma_datatable_css');

		wp_register_script('jquery_js', 'https://code.jquery.com/jquery-3.5.1.js', false, '1.0.0');
		wp_enqueue_script('jquery_js');	
}

add_action('admin_enqueue_scripts', 'load_static');
```
Screenshot:

![](https://i.ibb.co/YphGwY1/links.jpg)

## Form Handling in WP Plugin
Sometime we need to create user input control to get some data from users, so here i simple way to create from in wp plugin save with html input and php codes, just simply add
input form in **dashboard.php**.

Read for more reference: https://www.w3schools.com/php/php_forms.asp

Complete code of dashboard.php
```php
<?php
    function mydemo_dashboard() {
        
    $name = '';

    if(isset($_POST['click'])){
        $name = $_POST['username'];
    }
?>
    <h1>Dashboard</h1>
    <p>Hello, My name is <?php echo $name;?></p>
    <form action="" method="post">
        <label>Enter Your Name</label>
        <input type="text" name="username"/>
        <button type="submit" name="click">Click Me</button>
    </form>
<?php 
    }
?>
```
Screenshot:

![](https://awesomescreenshot.s3.amazonaws.com/image/2293567/21956560-eb1cd5188e00fc14d051ae07af4206e8.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJSCJQ2NM3XLFPVKA%2F20220210%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20220210T134741Z&X-Amz-Expires=28800&X-Amz-SignedHeaders=host&X-Amz-Signature=9971bee108ea888ea70cf35344547084d5e5657073a17078b147da4f2024860f)
## More content adding soon...
