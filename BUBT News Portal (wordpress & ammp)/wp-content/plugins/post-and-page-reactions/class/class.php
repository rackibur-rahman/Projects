<?php
/*********
class function used for creating plugin tables
on activation hook
*************/
class ai_wp_smileys_class
{
    function ai_wp_create_table()
    {
        GLOBAL $wpdb;
		$version = '1.0.5';
        $settings        = $wpdb->base_prefix . 'arete_wp_smiley_settings';
        $smiley_save     = $wpdb->base_prefix . 'arete_wp_smileys';
        $smiley_bp       = $wpdb->base_prefix . 'arete_wp_smileys_manage';
        $charset_collate = '';
        if (!empty($wpdb->charset)) {
            $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
        }
        if (!empty($wpdb->collate)) {
            $charset_collate .= " COLLATE {$wpdb->collate}";
        }
		if($wpdb->get_var("SHOW TABLES LIKE '$settings'") != $settings) 
		{
			$sql = "CREATE TABLE $settings (
					id mediumint(11) NOT NULL AUTO_INCREMENT,
					type VARCHAR(255) DEFAULT '' NOT NULL,
					value VARCHAR(255) DEFAULT '' NOT NULL,
					UNIQUE KEY id (id)
				) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		if($wpdb->get_var("SHOW TABLES LIKE '$smiley_save'") != $smiley_save) 
		{
			$smiley    = "CREATE TABLE $smiley_save (
				id mediumint(11) NOT NULL AUTO_INCREMENT,
				image VARCHAR(255) DEFAULT '' NOT NULL,
				name VARCHAR(255) DEFAULT '' NOT NULL,
				front VARCHAR(255) DEFAULT '' NOT NULL,
				UNIQUE KEY id (id)
			) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($smiley);
		}
		if($wpdb->get_var("SHOW TABLES LIKE '$smiley_bp'") != $smiley_bp) 
		{ 
			$bp_smiley = "CREATE TABLE $smiley_bp(
				id mediumint(11) NOT NULL AUTO_INCREMENT,
				smiley_id VARCHAR(255) DEFAULT '' NOT NULL,
				user_id VARCHAR(255) DEFAULT '' NOT NULL,
				post_id VARCHAR(255) DEFAULT '' NOT NULL,
				ip VARCHAR(255) DEFAULT '' NOT NULL,
				timestamp VARCHAR(11) DEFAULT '' NOT NULL,	
				UNIQUE KEY id (id)
			) $charset_collate;";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($bp_smiley);
		}

		update_option('ai_post_and_page_reactions_version', $version);
    }
}
/*********
function used for inserting default values 
in database tables on activation 
*************/
function ai_wp_post_reactions()
{
    global $wpdb;
    $settings        = $wpdb->base_prefix . 'arete_wp_smileys';
	$location        = $wpdb->base_prefix . 'arete_wp_smiley_settings';
	
	$enable_query = ai_post_reactions_settings_check_existance($location , 'page', "n");
	$enable_query = ai_post_reactions_settings_check_existance($location , 'post', "y");
	$enable_query = ai_post_reactions_settings_check_existance($location , 'guest', "yes");
	$enable_query = ai_post_reactions_settings_check_existance($location , 'location', "after");
	
	$enable_query = ai_post_reactions_check_existance($settings, 'Like', 'like.png');
	$enable_query = ai_post_reactions_check_existance($settings, 'Love', 'love.png');
	$enable_query = ai_post_reactions_check_existance($settings, 'Thankful', 'thankful.png');	
	$enable_query = ai_post_reactions_check_existance($settings, 'Ha Ha', 'haha.png');
	$enable_query = ai_post_reactions_check_existance($settings, 'Wow', 'wow.png');
	$enable_query = ai_post_reactions_check_existance($settings, 'Sad', 'sad.png');
	$enable_query = ai_post_reactions_check_existance($settings, 'Angry', 'angry.png');
  
    dbDelta($enable_query);
}
/****************
function for check 
reactions value already
exist in table.
***************/
function ai_post_reactions_check_existance($table, $name, $image)
{
	GLOBAL $wpdb;
	$exist=$wpdb->get_var("SELECT id from $table WHERE name='$name'");
	if(empty($exist))
	{
		$wpdb->insert($table, array(
			'id' => "",
			'name' =>$name,
			'image' =>$image,
			'front' => 'checked'
		), array(
			'%d',
			'%s',
			'%s',
			'%s'
		));
	}
}

/****************
function for check
if value already exist
in table.
***************/
function ai_post_reactions_settings_check_existance($table, $condition, $value)
{
	GLOBAL $wpdb;
	$condition =trim($condition);
	$exist=$wpdb->get_var("SELECT id from $table WHERE type='$condition'");
	if(empty($exist))
	{
		$enable=$wpdb->insert($table,array('id'=>"",'type'=>$condition,'value'=>$value),array('%d','%s','%s'));
		return $enable;
	}
}
/*********
function used for drop and truncate 
database tables on deactivation 
*************/
function ai_wp_post_reactions_truncate()
{
    global $wpdb;
    $settings  = $wpdb->base_prefix .'arete_wp_smileys';
	$smiley_setting = $wpdb->base_prefix .'arete_wp_smiley_settings';
	
    $wpdb->query("DROP TABLE IF EXISTS $settings");
	$wpdb->query("DROP TABLE IF EXISTS $smiley_setting");
}

/*********
function for enqueue js files
*************/
function ai_load_wp_js_smiley()
{
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script('arete-tabs_wp_smiley', plugins_url('js/ai_post_reactions_jquery.tabs.js', dirname(__FILE__)));
	wp_enqueue_script('arete-chart', plugins_url('js/ai_post_reactions_chart.js', dirname(__FILE__)));
    wp_enqueue_script('arete-custom_ai_wp_smiley', plugins_url('js/ai_post_reactions.js', dirname(__FILE__)));
}

/*********
function for enqueue style files
*************/
function ai_load_wp_css_smiley()
{
    wp_enqueue_style('arete-tabs_wp_smiley1', plugins_url('css/ai_post_reactions_jquery.tabs.css', dirname(__FILE__)));
    wp_enqueue_style('arete-custom-style_wp_admin', plugins_url('css/ai_post_reactions_custom.css', dirname(__FILE__)));
}
add_action('admin_enqueue_scripts', 'ai_load_wp_js_smiley');
add_action('admin_enqueue_scripts', 'ai_load_wp_css_smiley');

/*********
function for enqueue style and js files in front end
*************/
function ai_wp_smiley_pro_f_scripts()
{
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script('arete-custom_ai_wp_front_mobile', plugins_url('js/ai_post_reactions_jquery.touch.min.js', dirname(__FILE__)));	
    wp_enqueue_script('arete-custom_ai_wp_front_smiley', plugins_url('js/ai_post_reactions.js', dirname(__FILE__)));
    wp_enqueue_script('arete-custom_ai_wp_front_tipsy', plugins_url('js/ai_post_reactions_jquery.tipsy-min.js', dirname(__FILE__)));
	wp_enqueue_script('arete-custom_ai_smiley_lb', plugins_url('js/ai_post_reactions_vex.combined.min.js', dirname(__FILE__)));	
    wp_enqueue_style('arete-custom-style_wp_front_smiley', plugins_url('css/ai_post_reactions_custom.css', dirname(__FILE__)));
    wp_enqueue_style('arete-custom-style_wp_tipsy', plugins_url('css/ai_post_reactions_tipsy.min.css', dirname(__FILE__)));
	wp_enqueue_style('arete-custom_ai_smiley_lb_main_css', plugins_url('css/ai_post_reactions_vex.css', dirname(__FILE__)));
	wp_enqueue_style('arete-custom_ai_smiley_lb_css', plugins_url('css/ai_post_reactions_vex-theme-flat-attack.css', dirname(__FILE__)));
}
add_action('wp_enqueue_scripts', 'ai_wp_smiley_pro_f_scripts');

/*****
function for animation
css according to reaction 
count
******/
function ai_post_reaction_main_animation_css()
{
	if ( !is_admin() ) 
	{ 
		$ob_temp= new ai_wp_manage_reactions_temp;
		$total_reactions=json_decode(ai_post_reaction_get_main_animation_css_mod());
		$single_count=$total_reactions->reactions_count;
		for($i=1; $i<=$single_count; $i++)
		{
			$animation_style=json_decode($ob_temp->ai_wp_reactions_animation_css_temp($i));
			echo $animation_style->html;
		}
	}
}
add_action('wp_enqueue_scripts', 'ai_post_reaction_main_animation_css');

/*********
wordpress class extended to show smileys 
in admin panel form where administrator
manage smileys 
*************/
class ai_wp_list_table_class_extend extends WP_List_Table
{
    public $main_data;
    public $type;
    /** ************************************************************************
     * Normally we would be querying data from a database and manipulating that
     * for use in your list table. For this example, we're going to simplify it
     * slightly and create a pre-built array. Think of this as the data that might
     * be returned by $wpdb->query().
     * 
     * @var array 
     **************************************************************************/
    public static function ai_wp_get_smiley($per_page, $page_number = 1)
    {
        global $wpdb;
        $main_data = array();
        $result    = "";
        $sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys";
        if (!empty($_REQUEST['orderby'])) {
            $sql .= ' ORDER BY ' . esc_sql($_REQUEST['orderby']);
            $sql .= !empty($_REQUEST['order']) ? ' ' . esc_sql($_REQUEST['order']) : ' ASC';
        }
        if (!empty($per_page)) {
            $sql .= " LIMIT $per_page";
            $sql .= ' OFFSET ' . ($page_number - 1) * $per_page;
        }
        $result = $wpdb->get_results($sql);
		$count =1;
        foreach ($result as $val) {
            $image = $val->image;
          
            $image_plugin = plugins_url('post-and-page-reactions/img/') . $image;
			$main_data[] = array(
				'smiley' => $image_plugin,
				'name' => $val->name,
				'id' => $val->id,
				'action'=> $val->front,
				'serial' =>$count
			);
			$count++;
        }
        return $main_data;
    }
    public static function ai_wp_smiley_delete_this_record($main_id, $type)
    {
        global $wpdb;
        $db = $wpdb->base_prefix . 'arete_wp_smileys';
        $wpdb->delete($db, array(
            'id' => $main_id
        ), array(
            '%d'
        ));
    }
    
    /** ************************************************************************
     * REQUIRED. Set up a constructor that references the parent constructor. We 
     
     * use the parent reference to set some default configs.
     ***************************************************************************/
    function __construct()
    {
        global $status, $page;
        //Set parent defaults
        parent::__construct(array(
            'singular' => 'main_id', //singular name of the listed records
            'plural' => 'main_ids', //plural name of the listed records
            'ajax' => false //does this table support ajax?
        ));
    }
    /** ************************************************************************
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title() 
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as 
     * possible.
     *
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     * 
     * For more detailed insight into how columns are handled, take a look at 
     * WP_List_Table::single_row_columns()
     * 
     * @param array $item A singular item (one full row's worth of data)
     * @param array $column_name The name/slug of the column to be processed
     * @return string Text or HTML to be placed inside the column <td>
     **************************************************************************/
    function column_default($item, $column_name)
    {
        $type = $this->type;
        if ($type == "smiley") {
            switch ($column_name) {
                case 'serial':
                case 'name':
                    return $item[$column_name];
                case 'smiley':
                    $img = '<img  src="' . $item[$column_name] . '" height="60" width="60"/>';
                    return $img;
                case 'action':
					$html ='';
					if($item['id'] != 1)
					{
						if($item[$column_name] == "checked")
						{
							$html .= '<input type="checkbox" name="ai_front_wp_post" class="ai_front_wp_post" checked value="1" ai_id='.$item['id'].'>';
						}
						else
						{
							$html .= '<input type="checkbox" name="ai_front_wp_post" class="ai_front_wp_post" value="0" ai_id='.$item['id'].'>';
						}
					}
                    return $html;
                default:
                    return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
        }
    }
    /** ************************************************************************
        * Recommended. This is a custom column method and is responsible for what
    
    * is rendered in any column with a name/slug of 'title'. Every time the class
    
    * needs to render a column, it first looks for a method named 
    
    * column_{$column_title} - if it exists, that method is run. If it doesn't
    
    * exist, column_default() is called instead.
    
    * 
    
    * This example also illustrates how to implement rollover actions. Actions
    
    * should be an associative array formatted as 'slug'=>'link html' - and you
    
    * will need to generate the URLs yourself. You could even ensure the links
    
    * 
    
    * 
    * @see WP_List_Table::::single_row_columns()
    
    * @param array $item A singular item (one full row's worth of data)
    
    * @return string Text to be placed inside the column <td> (main_id title only)
    
    **************************************************************************/
    function column_title($item)
    {
    }
    /** ************************************************************************
    
    * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
    * is given special treatment when columns are processed. It ALWAYS needs to
    * have it's own method.
    
    * 
    
    * @see WP_List_Table::::single_row_columns()
    
    * @param array $item A singular item (one full row's worth of data)
    
     * @return string Text to be placed inside the column <td> (main_id title only)
    
    **************************************************************************/
    function column_cb($item)
    {
        $type = $this->type;
        if ($type == "smiley") {
            $main_id = $item['id'];
        }
        return sprintf('<input type="checkbox" name="%1$s[]" value="%2$s" />', /*$1%s*/ $this->_args['singular'], //Let's simply repurpose the table's singular label ("main_id")
            /*$2%s*/ $main_id //The value of the checkbox should be the record's id
            );
    }
    function get_columns()
    {
        $type = $this->type;
        if ($type == "smiley") {
            $columns = array(
				'serial' =>'S.No',
                'name' => 'Name',
                'smiley' => 'Smiley',
				'action' => 'Status (only checked reactions are displayed to be used)'
            );
        }
        return $columns;
    }
    /** ************************************************************************
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle), 
       * you will need to register it here. This should return an array where the 
    * key is the column that needs to be sortable, and the value is db column to 
    
    * sort by. Often, the key and value will be the same, but this is not always
    
    * the case (as the value is a column name from the database, not the list table).
    
    * This method merely defines which columns should be sortable and makes them
    
    * clickable - it does not handle the actual sorting. You still need to detect
    
    * the ORDERBY and ORDER querystring variables within prepare_items() and sort
    
    
    * your data accordingly (usually by modifying your query).
    
    * 
    * @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
    
    **************************************************************************/
    function ai_wp_get_sortable_columns($type)
    {
        if ($type == "smiley") {
            $sortable_columns = array(
			'name' => array('name',false),//true means it's already sorted
            );
        }
        return $sortable_columns;
    }
    /** ************************************************************************
    
    * Optional. If you need to include bulk actions in your list table, this is
    
    * the place to define them. Bulk actions are an associative array in the format
    
    * 'slug'=>'Visible Title'
    
    * If this method returns an empty value, no bulk action will be rendered. If
    
    * you specify any bulk actions, the bulk actions box will be rendered with
    
    * the table automatically on display().
    
    * 
    
    * Also note that list tables are not automatically wrapped in <form> elements,
    
    * so you will need to create those manually in order for bulk actions to function.
    
    * 
    
    * @return array An associative array containing all the bulk actions: 'slugs'=>'Visible Titles'
    
    **************************************************************************/
   /* function get_bulk_actions()
    {
        if ($this->type == "smiley") {
            $actions = array(
                'delete' => 'Delete'
            );
        }
        return $actions;
    }*/
    /** ************************************************************************
    
    * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
    
    * For this example package, we will handle it in the class to keep things
    
        * clean and organized.
    
    * @see $this->prepare_items()
    
    **************************************************************************/
    function process_bulk_action()
    {
        //Detect when a bulk action is being triggered..
        if ('delete' === $this->current_action()) {
            if (!empty($_REQUEST['main_id'])) {
                foreach ($_REQUEST['main_id'] as $main_id) {
                    //$video will be a string containing the ID of the video
                    //i.e. $video = "123";
                    //so you can process the id however you need to.
                    $type = $this->type;
                    $this->ai_wp_smiley_delete_this_record($main_id, $type);
                }
            }
        }
    }
    /** ************************************************************************
    * REQUIRED! This is where you prepare your data for display. This method will
    * usually be used to query the database, sort and filter the data, and generally
    * get it ready to be displayed. At a minimum, we should set $this->items and
    * $this->set_pagination_args(), although the following properties and methods
    * are frequently interacted with here...
    * @global WPDB $wpdb
    * @uses $this->_column_headers
    * @uses $this->items
    * @uses $this->get_columns()
    * @uses $this->ai_wp_get_sortable_columns()
    * @uses $this->get_pagenum()
    
    * @uses $this->set_pagination_args()
        **************************************************************************/
    function ai_wp_prepare_items($type, $id)
    {
        global $wpdb; //This is used only if making any database queries
        $this->type            = $type;
        /**
         * First, lets decide how many records per page to show
        
        */
        $per_page              = 20;
        /**
        * REQUIRED. Now we need to define our column headers. This includes a complete
        
        * array of columns to be displayed (slugs & titles), a list of columns
        
        * to keep hidden, and a list of columns that are sortable. Each of these
        
        * can be defined in another method (as we've done here) before being
        
        * used to build the value for our _column_headers property.
        
        */
        $columns               = $this->get_columns();
        $hidden                = array();
        $sortable              = $this->ai_wp_get_sortable_columns($type);
        $filter                = $this->ai_wp_get_sortable_columns($type);
        /**
        
        * REQUIRED. Finally, we build an array to be used by the class for column 
        
        * headers. The $this->_column_headers property takes an array which contains
        
        * 3 other arrays. One for all columns, one for hidden columns, and one
        
        * for sortable columns.
        
        */
        $this->_column_headers = array(
            $columns,
            $hidden,
            $sortable
        );
        /**
        
        * Optional. You can handle your bulk actions however you see fit. In this
        
        * case, we'll handle them within our package just to keep things clean.
        
        */
        $this->process_bulk_action();
        /**
        * Instead of querying a database, we're going to fetch the example data
        
        * property we created for use in this plugin. This makes this example 
                
        * package slightly different than one you might build on your own. In 
        
        * this example, we'll be using array manipulation to sort and paginate 
        
        * our data. In a real-world implementation, you will probably want to 
        
        * use sort and pagination data to build a custom query instead, as you'll
        
        * be able to use your precisely-queried data immediately.
        
        */
        if ($type == "smiley") {
            $data = $this->ai_wp_get_smiley("", 1);
        }
        /***********************************************************************
        
        * ---------------------------------------------------------------------
        
        * vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
        
        * In a real-world situation, this is where you would place your query.
        
        * For information on making queries in WordPress, see this Codex entry:
        
        * http://codex.wordpress.org/Class_Reference/wpdb
        
        
        **********************************************************************/
        /**
        
        * REQUIRED for pagination. Let's figure out what page the user is currently 
        
        * looking at. We'll need this later, so you should always include it in 
        
        * your own package classes.
        
        */
        $current_page = $this->get_pagenum();
        /**
        
        * REQUIRED for pagination. Let's check how many items are in our data array. 
        
        * In real-world use, this would be the total number of items in your database, 
        
        * without filtering. We'll need this later, so you should always include it 
        
        * in your own package classes.
        
        */
        $total_items  = count($data);
        /**
        * The WP_List_Table class does not handle pagination for us, so we need
        
        * to ensure that the data is trimmed to only the current page. We can use
        
        * array_slice() to 
        */
        $data         = array_slice($data, (($current_page - 1) * $per_page), $per_page);
        /**
        * REQUIRED. Now we can add our *sorted* data to the items property, where 
        
        * it can be used by the rest of the class.
        
        */
        $this->items  = $data;
        /**
        * REQUIRED. We also have to register our pagination options & calculations.
        
        */
        $this->set_pagination_args(array(
            'total_items' => $total_items, //WE have to calculate the total number of items
            'per_page' => $per_page, //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items / $per_page) //WE have to calculate the total number of pages
        ));
    }
}

/*****************
function by which smileys shows 
on front end activity panel
********************************/
function ai_wp_smiley_html($content)
{
	global $wpdb;
	$activity_id  = get_the_ID();
	$type= get_post_type($activity_id);
	$location =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','location');
	$pages =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','page');
	$post =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','post');
	if(($type == "post" && $post == "y" && is_single()) || ($type == "page" && $pages == "y"))
	{
		$html = '';
		if(is_user_logged_in())
		{
			$image_plugin = plugins_url('post-and-page-reactions/img/') . "unlike.png";
			$user_id      = get_current_user_id();
			$table        = $wpdb->base_prefix . 'arete_wp_smileys_manage';
			$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
			$html .= '<div id="ai_post_reaction_main" main_id="'.get_the_ID().'">';
			$html .= ai_wp_get_already_checked($activity_id);
			$current_user_id  = intval(get_current_user_id());
			$user_query       = $wpdb->get_results("select * from $table where post_id='$activity_id' and user_id='$current_user_id'");
			$user_query_count = $wpdb->num_rows;
			if ($user_query && $wpdb->num_rows <> 0) {
				foreach ($user_query as $user_check) {
					$userid = $user_check->user_id;
					if ($userid == $current_user_id) {
						$current_user_smiley = $user_check->smiley_id;
						$html .= ai_wp_user_smiley($current_user_smiley, $userid);
					}
				}
			}
			$non_user_query = $wpdb->get_results("select * from $table where post_id='$activity_id' and user_id !='$current_user_id'");
			if ($non_user_query && $wpdb->num_rows <> 0) {
				if ($user_query_count == 0) {
					$html .= '<div class="ai_post_reactions_default_cont">
								<a href="" class="ai_post_reactions_default ai_post_reaction_button">
									<img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="1">
									<span>Like</span>
								</a>
							</div>
							<div class="ai_icon_loader">
								<a href="" class="ai_emo_button">
									<i class="ai-bp-ajax-loading-icon ai-bp-icon ai-bp-icon-refresh ai-bp-icon-spin"></i>
								</a>
							</div>';
				}
				$username     = array();
				$smiley_check = array();
				$html.="<div class='ai_post_reactions_overcome'>";
				foreach ($non_user_query as $user_check) {
					$userid    = $user_check->user_id;
					$smiley_id = $user_check->smiley_id;
					if (in_array($smiley_id, $smiley_check)) {
					} else {
						$check_users = ai_wp_check_users($smiley_id, $activity_id);
						$html .= ai_wp_other_user_smiley_activity($check_users, $smiley_id, $userid);
					}
					$smiley_check[] = $smiley_id;
					$check++;
				}
				$html.="</div>";
			}
			$query = $wpdb->get_results("select * from $table where post_id='$activity_id'");
			$arr   = $wpdb->num_rows;
			if (empty($arr)) {
				$html .= '<div class="ai_post_reactions_default_cont">
							<a href="" class="ai_post_reactions_default ai_post_reaction_button">
								<img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="1">
								<span>Like</span>
							</a>
						</div>
						<div class="ai_icon_loader">
							<a href="" class="ai_emo_button">
								<i class="ai-bp-ajax-loading-icon ai-bp-icon ai-bp-icon-refresh ai-bp-icon-spin"></i>
							</a>
						</div>';
			}
			$count = "";
			if (!empty($arr)) {
				$count = $arr;
			} else {
				$count = '';
			}
			$selected_name = ai_get_selected_users_name_post($activity_id);
			$html .= '<div class="ai_post_reactions_counter"><a href="" class="ai_wp_counter ai_post_reaction_button" original-title="' . esc_attr($selected_name) .'" ai_counter_activity_id="'.$activity_id.'"><span class="ai_post_counter">' . $count . '</span></a></div></div>';
		}
		else
		{
			$image_plugin = plugins_url('post-and-page-reactions/img/') . "unlike.png";
			$user_id      = 0;
			$table        = $wpdb->base_prefix . 'arete_wp_smileys_manage';
			$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
			$html .= '<div id="ai_post_reaction_main" main_id="'.get_the_ID().'">';
			$html .= ai_wp_get_already_checked($activity_id);
			$current_user_id  = 0;
			$ip 		 = $_SERVER['REMOTE_ADDR'];
			$user_query       = $wpdb->get_results("select * from $table where post_id='$activity_id' and user_id='$current_user_id' and ip='$ip'");
			$user_query_count = $wpdb->num_rows;
			if ($user_query && $wpdb->num_rows <> 0) {
				foreach ($user_query as $user_check) {
					$userid = $user_check->user_id;
					$ip_get = $user_check->ip;
					if ($ip_get == $ip) {
						$current_user_smiley = $user_check->smiley_id;
						$html .= ai_wp_user_smiley($current_user_smiley, $userid);
					}
				}
			}
			$non_user_query = $wpdb->get_results("select * from $table where post_id='$activity_id'");
			if ($non_user_query && $wpdb->num_rows <> 0) {
				if ($user_query_count == 0) {
					$html .= '<div class="ai_post_reactions_default_cont">
								<a href="" class="ai_post_reactions_default ai_post_reaction_button">
									<img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="1">
								<span>Like</span>
								</a>
							</div>
							<div class="ai_icon_loader">
								<a href="" class="ai_emo_button">
									<i class="ai-bp-ajax-loading-icon ai-bp-icon ai-bp-icon-refresh ai-bp-icon-spin"></i>
								</a>
							</div>';
				}
				$username     = array();
				$smiley_check = array();
				$html.="<div class='ai_post_reactions_overcome'>";
				foreach ($non_user_query as $user_check) {
					$userid    = $user_check->user_id;
					$smiley_id = $user_check->smiley_id;
					$ip_get = $user_check->ip;
					if($userid == 0 && $ip_get == $ip )
					{
						
					}
					else
					{
						if (in_array($smiley_id, $smiley_check)) {
						} else {
							$check_users = ai_wp_check_users($smiley_id, $activity_id);
							$html .= ai_wp_other_user_smiley_activity($check_users, $smiley_id, $userid);
						}
						$smiley_check[] = $smiley_id;
						$check++;
					}
				}
				$html.="</div>";
			}
			$query = $wpdb->get_results("select * from $table where post_id='$activity_id'");
			$arr   = $wpdb->num_rows;
			if (empty($arr))
			{
				$html .= '<div class="ai_post_reactions_default_cont">
							<a href="" class="ai_post_reactions_default ai_post_reaction_button">
								<img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="1">
								<span>Like</span>
							</a>
						</div>
						<div class="ai_icon_loader">
							<a href="" class="ai_emo_button">
								<i class="ai-bp-ajax-loading-icon ai-bp-icon ai-bp-icon-refresh ai-bp-icon-spin"></i>
							</a>
						</div>';
			}
			$count = "";
			if (!empty($arr)) {
				$count = $arr;
			} else {
				$count = '';
			}
			$selected_name = ai_get_selected_users_name_post($activity_id);
			$html .= '<div class="ai_post_reactions_counter"><a href="" class="ai_wp_counter ai_post_reaction_button" ai_counter_activity_id="'.$activity_id.'" original-title="' . esc_attr($selected_name) .'" ><span class="ai_post_counter">' . $count . '</span></a></div></div>';
		}
		
		if($location == 'after')
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$content.$html.'</div>';
		}
		elseif($location == 'both')
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$html.$content.$html.'</div>';
		}
		else
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$html.$content.'</div>';
		}
		return $htmlcontent;
	}
	else
	{
		return $content;
	}
}

function ai_wp_smiley_non_logged_in($content)
{
    global $wpdb;
	$activity_id  = get_the_ID();
	$location =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','location');
	$type= get_post_type($activity_id);
	$pages =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','page');
	$post =ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','post');
	if(($type == "post" && $post == "y" && is_single()) || ($type == "page" && $pages == "y"))
	{
		$image_plugin = plugins_url('post-and-page-reactions/img/') . "unlike.png";
		$table        = $wpdb->base_prefix . 'arete_wp_smileys_manage';
		$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
		$html = '<div id="ai_post_reaction_main" main_id="'.get_the_ID().'">';
		$non_user_query = $wpdb->get_results("select * from $table where post_id='$activity_id'");
		if ($non_user_query && $wpdb->num_rows <> 0) 
		{
			$username     = array();
			$smiley_check = array();
			$html.="<div class='ai_post_reactions_overcome'>";
			foreach ($non_user_query as $user_check) {
				$userid    = intval($user_check->user_id);
				$smiley_id = intval($user_check->smiley_id);
				if (in_array($smiley_id, $smiley_check)) {
				} else {
					$check_users = ai_wp_check_users($smiley_id, $activity_id);
					$html .= ai_wp_other_user_smiley_activity($check_users, $smiley_id, $userid);
				}
				$smiley_check[] = $smiley_id;
				$check++;
			}
			$html.="</div'>";
		}
		$query = $wpdb->get_results("select * from $table where post_id='$activity_id'");
		$arr   = $wpdb->num_rows;
		$count = "";
		if (!empty($arr)) {
			$count = $arr;
		} else {
			$count = '';
		}
		$html .= '<div class="ai_post_reactions_counter">
					<a href="" class="ai_wp_counter ai_post_reaction_button">
						<span class="ai_post_counter" ai_counter_activity_id="'.$activity_id.'">' . $count . '</span>
					</a>
				</div></div>';
		if($location == 'after')
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$content.$html.'</div>';
		}
		elseif($location == 'both')
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$html.$content.$html.'</div>';
		}
		else
		{
			$htmlcontent = '<div class="ai_main_container_reactions">'.$html.$content.'</div>';
		}
		return $htmlcontent;
	}
	else
	{
		return $content;
	}
}
function ai_wp_not_logged_in()
{
	GLOBAL $wpdb;
	if(is_user_logged_in())
	{
		add_filter('the_content', 'ai_wp_smiley_html');
	}
	else
	{
		if(ai_wp_smiley_get_single_details('arete_wp_smiley_settings', 'value', 'type','guest')== "no") 
		{
			add_filter('the_content', 'ai_wp_smiley_non_logged_in');
		}
		else
		{
			add_filter('the_content', 'ai_wp_smiley_html');
		}	
	}
}
add_action( 'init', 'ai_wp_not_logged_in' );
/*****************
function for getting users name 
who selected smileys on posts
showed on hover count  
******************************/
function ai_get_selected_users_name_post($activity_id)
{
	global $wpdb;
	$table = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	$sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys_manage where post_id='$activity_id' ORDER BY id desc limit 10 ";
    $result   = $wpdb->get_results($sql);
	//$username = array();
    $user_id  = get_current_user_id();
	$username ='';
    foreach ($result as $val) {
        $userid = $val->user_id;
		if($userid != "0")
		{
			$user_info = get_userdata($userid);
			$username .= $user_info->user_login.'</br>';
		}
    }
    return $username;
}
/*****************
function for checking 
which smiley selected 
by users and get there 
name in an array 
*******************/
function ai_wp_check_users($smiley_id, $activity_id)
{
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->base_prefix}arete_buddypress_smileys_manage where smiley_id='$smiley_id' and post_id='$activity_id'";
    $result   = $wpdb->get_results($sql);
    $username = array();
    $user_id  = intval(get_current_user_id());
    foreach ($result as $val) {
        $userid = $val->user_id;
        if ($user_id != $userid) {
            $user_info  = get_userdata($userid);
            $username[] = $user_info->user_login;
        }
    }
    $usernames = ai_convert_array_to_string_smiley($username);
    return $usernames;
}
/*****************
function for checking 
logged-in user selected 
smiley
********************/
function ai_wp_user_smiley($current_user_smiley, $userid)
{
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys where id='$current_user_smiley'";
    $result = $wpdb->get_results($sql);
	$html ='';
    foreach ($result as $val) {
        $id          = $val->id;
        $name_smiley = $val->name;
        $image       = $val->image;
       
        $image_plugin = plugins_url('post-and-page-reactions/img/') . $image;
        $html .= '<div class="ai_post_reactions_default_cont">
					<a href="" class="ai_post_reactions_default ai_post_reaction_button">
						<img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="' . intval($id) . '">
						<span>' . esc_html($name_smiley) . '</span>
					 </a>
				 </div>
				<div class="ai_icon_loader">
					<a href="" class="ai_emo_button">
						<i class="ai-bp-ajax-loading-icon ai-bp-icon ai-bp-icon-refresh ai-bp-icon-spin"></i>
					</a>
				</div>';
    }
    return $html;
}
/*****************
function for checking smileys 
selected by non-logged in users   
******************************/
function ai_wp_other_user_smiley_activity($check_users, $smiley_id, $userid)
{
    global $wpdb;
    $sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys where id='$smiley_id'";
    $result = $wpdb->get_results($sql);
	$html ='';
    foreach ($result as $val) {
        $id          = $val->id;
        $name_smiley = $val->name;
        $image       = $val->image;
    
        $image_plugin = plugins_url('post-and-page-reactions/img/') . $image;
        $html .= '<a href smiley_id="' . intval($id) . '" class="ai_post_reactions_overcome_img ai_post_reaction_button expand" original-title="' . esc_attr($name_smiley) .'"><img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img" smiley_id="' . intval($id) . '" "></a>';
    }
    return $html;
}
/*****************
function for showing smileys 
div which showed on hover like ai_post_reaction_button
******************************/
function ai_wp_get_already_checked($activity_id)
{
    global $wpdb;
    $main_data = array();
    $result    = "";
    $sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys";
    $result = $wpdb->get_results($sql);
    $count   = 0;
	$html = '';
	$main_count = 1;
	if(is_user_logged_in())
	{
		$user_id = intval(get_current_user_id());
	}
    else
	{
		$user_id = 0;
	}
    foreach ($result as $val) {
            $id          = $val->id;
            $name_smiley = $val->name;
            $image       = $val->image;
			$check       = $val->front;
            $image_plugin = plugins_url('post-and-page-reactions/img/') . $image;
			if($check == 'checked')
			{
				$html .= '<li><a href smiley_id="' . intval($id) . '" class="ai_wp_post_reactions expand" original-title="' . esc_attr($name_smiley) . '"><img src="' . esc_url($image_plugin) . '" class="ai_post_reaction_img ai_'.$count.'" smiley_id="' . intval($id) . '" ></a></li>';
				$main_count++;
			}
			$count++;
    }
	$final_width=$main_count*42;
	return '<div class="ai_main_smiley_div" style="display:none;">
				<ul style="width:'.$final_width.'px" id="ai_reactions_main">'.$html.'
				</ul>
			</div>';
}
/*****************
function converting array to string 
******************************/
function ai_convert_array_to_string_smiley($array)
{
    $comma_separated = implode(",", $array);
    return $comma_separated;
}
/*****************
function worked through ajax when 
user selected or deleted selected smiley 
form activity
******************************/
add_action('wp_ajax_ai_wp_save_smiley', 'ai_wp_save_smiley');
add_action('wp_ajax_nopriv_ai_wp_save_smiley', 'ai_wp_save_smiley');
function ai_wp_save_smiley()
{
    GLOBAL $wpdb;
    $smiley_id   = intval($_REQUEST['id']);
    $user_id    = intval(get_current_user_id());
    $activity_id = intval($_REQUEST['activity_id']);
	$ip 		 = $_SERVER['REMOTE_ADDR'];
    $time        = time();
	$table = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	
	// to check if there is any reaction for this post/page by this user
	if($user_id > 0)
	{
		$post_check = ai_post_reaction_check_row("arete_wp_smileys_manage","smiley_id",array("post_id"=>$activity_id,"user_id"=>$user_id),"AND"); 
	}
	else
	{
		$post_check = ai_post_reaction_check_row("arete_wp_smileys_manage","smiley_id",array("post_id"=>$activity_id,"user_id"=>$user_id,"ip"=>$ip),"AND");
	}
	
	if($post_check==true)
	{
		if($user_id > 0)
		{
			$reaction_check = ai_post_reaction_check_row("arete_wp_smileys_manage","smiley_id",array("post_id"=>$activity_id,"user_id"=>$user_id,"smiley_id"=>$smiley_id),"AND");
		}
		else
		{
			$reaction_check = ai_post_reaction_check_row("arete_wp_smileys_manage","smiley_id",array("post_id"=>$activity_id,"user_id"=>$user_id,"smiley_id"=>$smiley_id,"ip"=>$ip),"AND");
		}
		
		if($reaction_check==true)
		{
			if($user_id > 0)
			{
				$wpdb->delete( $table, array('smiley_id' => $smiley_id, 'post_id' =>$activity_id,'user_id'=>$user_id ), array( '%s','%s','%s') );
			}
			else
			{
				$wpdb->delete( $table, array('smiley_id' => $smiley_id, 'post_id' =>$activity_id,'user_id'=>$user_id ,'ip'=>$ip ), array( '%s','%s','%s','%s' ) );
			}
			$arr  = ai_post_reaction_compile_results($user_id,$activity_id,$smiley_id,"unreact");
			echo $arr;				
		}
		else
		{
			if($user_id > 0)
			{
				$wpdb->update($table,array( 'smiley_id' => $smiley_id), array( 'post_id' =>$activity_id,'user_id'=>$user_id ), array( '%s'), array( '%s','%s' ) );
			}
			else
			{
				$wpdb->update($table,array( 'smiley_id' => $smiley_id), array( 'post_id' =>$activity_id,'user_id'=>$user_id,'ip'=>$ip ), array( '%s'), array( '%s','%s','%s' ) );
			}
			
			$arr  = ai_post_reaction_compile_results($user_id,$activity_id,$smiley_id,"react");
			echo $arr;					
		}	
	}
	else
	{
		 $wpdb->insert($table, array(
            'id' => "",
            'smiley_id' => $smiley_id,
            'user_id' => $user_id,
            'post_id' => $activity_id,
            'ip' => $ip,
            'timestamp' => $time
        ), array(
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        ));		
		$arr  = ai_post_reaction_compile_results($user_id,$activity_id,$smiley_id,"react");
		echo $arr;
	}

    die();
}
/*****************
function for storing admin-ajax url
******************************/
add_action('wp_footer', 'ai_wp_footer_custom_codes');
function ai_wp_footer_custom_codes()
{
    $content = "";
    $content .= '<input check=" " type="hidden" name="web_url" class="web_url" value="' . admin_url('admin-ajax.php') . '"/><input check=" " type="hidden" name="ai_home_url" class="ai_home_url" value="' . get_site_url() . '"/>';
    echo $content;
}
/*****************
function getting single
details from any table
********************/
function ai_wp_smiley_get_single_details($table, $field, $condition, $value)
{
    global $wpdb;
    $db     = $wpdb->base_prefix . $table;
    $select = $wpdb->get_row("SELECT $field FROM {$db} where $condition='$value'");
    return $result = $select->$field;
}
/*****************
function for update location of smiley
before or after or both 
post content
******************************/
function ai_post_reaction_update_location($location)
{
	global $wpdb;
	$table = $wpdb->base_prefix . 'arete_wp_smiley_settings';
    $wpdb->update($table, array(
        'value' => $location
    ), array(
       'type' => "location"
    ), array(
        '%s'
    ), array(
        '%s'
    ));
}
/*****************
function for update guest-user 
wheather react or not in post
***********************/
function ai_post_reaction_update_guest($guest_user)
{
	global $wpdb;
	$table = $wpdb->base_prefix . 'arete_wp_smiley_settings';
    $wpdb->update($table, array(
        'value' => $guest_user
    ), array(
       'type' => "guest"
    ), array(
        '%s'
    ), array(
        '%s'
    ));
}
/*****************
function for update 
smileys on pages
******************/
function ai_post_reaction_update_pages($posts)
{
	global $wpdb;
	$table = $wpdb->base_prefix . 'arete_wp_smiley_settings';
	if(check_empty_value_smiley($posts) == false)
	{
		if(in_array('post',$posts ))
		{
			$wpdb->update($table, array(
				'value' => 'y'
				), array(
				   'type' => "post"
				), array(
					'%s'
				), array(
					'%s'
				));
		}
		else
		{
			$wpdb->update($table, array(
				'value' => 'n'
				), array(
				   'type' => "post"
				), array(
					'%s'
				), array(
					'%s'
				));
		}
		if(in_array('page',$posts ))
		{
			$wpdb->update($table, array(
				'value' => 'y'
				), array(
				   'type' => "page"
				), array(
					'%s'
				), array(
					'%s'
				));
		}
		else
		{
			$wpdb->update($table, array(
				'value' => 'n'
				), array(
				   'type' => "page"
				), array(
					'%s'
				), array(
					'%s'
				));
		}
		
		add_action( 'admin_notices', 'ai_wp_success_action_message_updated' );
	}
	else
	{
		add_action( 'admin_notices', 'ai_wp_error_action_message_updated' );
	}
}
/*****************
function worked through ajax when 
user selected or deleted selected smiley 
form activity
******************************/
add_action('wp_ajax_ai_get_activity_reactions_list_post', 'ai_get_activity_reactions_list_post');
add_action('wp_ajax_nopriv_ai_get_activity_reactions_list_post', 'ai_get_activity_reactions_list_post');
function ai_get_activity_reactions_list_post()
{
	GLOBAL $wpdb;
	$result=array();
	if($_REQUEST['type'] == "guest")
	{
		$activity_id =$_REQUEST['activity_id'];	
		$header="Guests who reacted";
	}
	else if ($_REQUEST['type'] == "registered")
	{
		$activity_id =$_REQUEST['activity_id'];	
		$header="Recent 10 registered users who reacted";
	}
	else
	{
		$activity_id = intval(str_replace("activity-","",$_REQUEST['activity_id']));
		$header="Recent 10 registered users who reacted";		
	}
	$html="<div class='ai_recent_reactions_list'><div class='ai_recent_reaction_users'><h5>".$header."</h5></div><div class='ai_post_react_tabs'><ul><li><a id='".$activity_id."' class='ai_registered_data ai_post_react_tabs_active' href=''>Registered Users</a></li><li><a id='".$activity_id."' class='ai_guest_data' href='' >Guests</a></li></ul></div><ul>";
	$table = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	$query_check = $wpdb->get_results("select * from $table where post_id='$activity_id' ORDER BY id desc limit 10 ");
	if($query_check && $wpdb->num_rows <> 0)
	{	
		if($_REQUEST['type'] == "guest")
		{
			$smiley_check = array();
			foreach ($query_check as $user_check) 
			{
				$user_id=$user_check->user_id;
				if($user_id == "0")
				{
					$reaction_id=$user_check->smiley_id;
					if (in_array($reaction_id, $smiley_check)) {
					} else {
						$check_smiley_count = ai_wp_check_smiley_count($reaction_id, $activity_id);
						$html.="<li>".ai_get_single_reaction_post($reaction_id)."<a href='#'>".$check_smiley_count."</a></li>";
					}
					$smiley_check[] = $reaction_id;
				}
			}
		}
		else
		{
			foreach ($query_check as $user_check) 
			{
				$user_id=$user_check->user_id;
				if($user_id != "0")
				{
					$reaction_id=$user_check->smiley_id;
					$user_info  = get_userdata($user_id);
					$username	= $user_info->user_login;	
					$html.="<li><a href='#'>".$username."</a>".ai_get_single_reaction_post($reaction_id)."</li>";
				}
			}
		}
		$html.="</ul></div>";
	}
	$result['html']=$html;
	echo json_encode($result);
	die();
}
/*********check smiley count of guest users*******/
function ai_wp_check_smiley_count($reaction_id, $activity_id)
{
	GLOBAL $wpdb;
	$table = $wpdb->base_prefix .'arete_wp_smileys_manage';
	$query_check = $wpdb->get_results("select * from $table where post_id='$activity_id' and smiley_id='$reaction_id' and user_id='0'");
	if($query_check && $wpdb->num_rows <> 0)
	{	
		$count = $wpdb->num_rows;
	}
	return $count;
}
/*****************
function to get single reaction 
******************************/
function ai_get_single_reaction_post($reaction_id)
{
    global $wpdb;
    $main_data = array();
    $result    = "";
    $sql = "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys WHERE id='$reaction_id'";
    $result = $wpdb->get_results($sql);
    $html = "<span class='ai_single_reaction'>";
    $user_id = get_current_user_id();
    foreach ($result as $val) {
            $id          = $val->id;
            $name_smiley = $val->name;
            $image       = $val->image;
			$check       = $val->front;
            $image_plugin = esc_url(plugins_url('post-and-page-reactions/img/') . $image);

				$html .= '<a href smiley_id="' . $id . '" user_id="' . $user_id . '" class="ai_reaction_inner" original-title="' . esc_attr($name_smiley) . '-"><img src="' . esc_url($image_plugin) . '" class="ai_reaction_image" smiley_id="' . $id . '" user_id="' . $user_id . '"></a>';
    }
    $html .= '</span>';
	return $html;
}
/**********check empty value************/
function check_empty_value_smiley($value)
{
	if (!isset($value) || empty($value) || $value==" ")
	{
		return true;
	}
	else
	{
		return false;
	}
}
/*****************
function for saving checked and unchecked 
smileys in table
only checked smileys showed in front end
******************************/
add_action('wp_ajax_ai_wp_post_front_smiley', 'ai_wp_post_front_smiley');
add_action('wp_ajax_nopriv_ai_wp_post_front_smiley', 'ai_wp_post_front_smiley');
function ai_wp_post_front_smiley()
{
	$smiley_id   = $_REQUEST['id'];
    $check_value  = $_REQUEST['check_value'];
    GLOBAL $wpdb;
	$table =$wpdb->base_prefix .'arete_wp_smileys';
	if($check_value == '1')
	{
		 $wpdb->update( $table,array( 'front' => 'unchecked'), array( 'id' =>$smiley_id ), array( '%s'), array( '%d' ) );
	}
	else
	{
		 $wpdb->update( $table,array( 'front' => 'checked'), array( 'id' =>$smiley_id ), array( '%s'), array( '%d' ) );
	}
	die();
}
/********show pie chart in admin panel posts and pages********/

add_action( 'admin_menu', 'ai_create_post_meta_box' );

function ai_create_post_meta_box() {
	add_meta_box( 'ai-reaction-meta-box', 'Post Reactions', 'ai_post_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'ai-reaction-meta-box', 'Page Reactions', 'ai_post_meta_box', 'page', 'normal', 'high' );
}

function ai_post_meta_box( $object, $box ) 
{ 
	GLOBAL $wpdb;
	GLOBAL $post;
	$table   = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
	$post_id = $post->ID;
	?>
	<div class="ai_post_reaction_guest">
	<?php
	$query_guest       = $wpdb->get_results("select * from $table where post_id='$post_id' and user_id='0'");
	$data = array();
	if ($query_guest && $wpdb->num_rows <> 0) {
		foreach ($query_guest as $value) 
		{
			$smiley_id = $value->smiley_id;
			if (in_array($smiley_id, $data)) {
			}
			else
			{
				$name[] = ai_wp_name_smiley($smiley_id);
				$count_guest[] = ai_wp_count_smiley($smiley_id,$post_id,"guest");
			}
			$data[] = $smiley_id;
		}
		$js_labels_guest = json_encode($name,true);
		$js_cols_guest = json_encode($count_guest,true);
		?>
			<canvas id="ai_guest_reactions" width="300" height="300"></canvas>
			<script>
			var ctx = document.getElementById("ai_guest_reactions");
			var data = {
				labels:<?php echo $js_labels_guest; ?>,
				datasets: [
					{
						data: <?php echo $js_cols_guest; ?>,
						backgroundColor: [
							"#FF6384",
							"#36A2EB",
							"#FFCE56",
							"#9CBABA",
							"#D18177",
							"#6AE128",
							"#811BD6",
						]
					}]
			};
				var myPieChart = new Chart(ctx,{
					type: 'pie',
					data: data,
					options: {
						title: {
							display: true,
							text: 'Guest Users'
						}
					}
				});
			</script>
		<?php
	}
	else
	{
		?>
		<p>No Reactions by Guest Users.</p>
		<?php	
	}
	?>
	</div>
	<div class="ai_post_reaction_registered">
	<?php
	$query       = $wpdb->get_results("select * from $table where post_id='$post_id' and user_id !='0'");
	$data_registered = array();
	if ($query && $wpdb->num_rows <> 0) {
		foreach ($query as $value) 
		{
			$smiley_id = $value->smiley_id;
			if (in_array($smiley_id, $data_registered)) {
			}
			else
			{
				$labels[] = ai_wp_name_smiley($smiley_id);
				$count[] = ai_wp_count_smiley($smiley_id,$post_id,"registered");
			}
			$data_registered[] = $smiley_id;
		}
		$js_labels = json_encode($labels,true);
		$js_cols = json_encode($count,true);
	?>
		<canvas id="ai_registered_reactions" width="300" height="300"></canvas>
		<script>
		var ctx = document.getElementById("ai_registered_reactions");
		var data = {
			labels:<?php echo $js_labels; ?>,
			datasets: [
				{
					data: <?php echo $js_cols; ?>,
					backgroundColor: [
						"#FF6384",
						"#36A2EB",
						"#FFCE56",
						"#9CBABA",
						"#D18177",
						"#6AE128",
						"#811BD6",
					]
				}]
		};
			var myPieChart = new Chart(ctx,{
				type: 'pie',
				data: data,
				options: {
					title: {
						display: true,
						text: 'Registered Users'
					}
				}
			});
		</script>
	<?php 
	}
	else
	{
		?>
		<p>No Reactions by Registered Users.</p>
		<?php	
	}
	?>
	</div>
	<div style="clear:both;"></div>
	<?php
}
function ai_wp_name_smiley($smiley_id)
{
	GLOBAL $wpdb;
	$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
	$query       = $wpdb->get_results("select * from $smiley_table where id='$smiley_id'");
	 foreach ($query as $val) {
        $name_smiley = $val->name;
	 }
	 return $name_smiley;
}
function ai_wp_count_smiley($smiley_id,$post_id,$type)
{
	GLOBAL $wpdb;
	GLOBAL $post;
	$table   = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	$smiley_table = $wpdb->base_prefix . 'arete_wp_smileys';
	if($type == "registered")
	{
		$query       = $wpdb->get_results("select * from $table where post_id='$post_id' and smiley_id='$smiley_id' and user_id !='0'");
	}
	else
	{
		$query       = $wpdb->get_results("select * from $table where post_id='$post_id' and smiley_id='$smiley_id' and user_id ='0'");
	}
	$query_count = $wpdb->num_rows;
	return $query_count;
}

/****get checked total reactions count****/
function ai_post_reaction_get_main_animation_css_mod()
{
	GLOBAL $wpdb;
	$result = array();
	$sql= "SELECT * FROM {$wpdb->base_prefix}arete_wp_smileys WHERE front='checked' order by id asc";
	$query = $wpdb->get_results($sql);
	$count = $wpdb->num_rows;
	$result['reactions_count']=$count;
	return json_encode($result);	
}

// Function to check total count on post/page //
function ai_post_reaction_get_activity_total_count($post_id)
{
	GLOBAL $wpdb;
	$table        = $wpdb->base_prefix . 'arete_wp_smileys_manage';
	$query = $wpdb->get_results("select * from $table where post_id='$post_id'");
	return  $arr   = $wpdb->num_rows;
}
// FUNCTION TO CHECK IF ROW EXIST //

function ai_post_reaction_check_row($table,$field,$conditions,$operator)
{
	GLOBAL $wpdb;
	$prefix_table =$wpdb->base_prefix .$table;
	$condition_query="";
	foreach($conditions as $key=> $condition)
	{
		$condition_query.=" ".$operator." $key='$condition'";
	}
	$query = $wpdb->get_results("SELECT $field from $prefix_table WHERE $field <> 0 $condition_query");
	if($query && $wpdb->num_rows <> 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}


// FUNCTION TO COMPILE THE RESULTS FOR THE REACTIONS PROCESS //

function ai_post_reaction_compile_results($user_id,$activity_id,$smiley_id,$module)
{
	GLOBAL $wpdb;
	
		$arr                = array();
		if($user_id > 0)
		{
			$user_info         = get_userdata($user_id);
			$arr['username']   = esc_html($user_info->user_login);
		}
		else
		{
			$arr['username']   = "Guest";
		}
		$arr['user_id']     = intval($user_id);

	
				
	if($module=="unreact")
	{		
				if(intval(ai_post_reaction_get_activity_total_count($activity_id))==0) 
				{
					$reaction_count="";
				}
				else
				{
					$reaction_count=intval(ai_post_reaction_get_activity_total_count($activity_id));			
				}
			$arr['reaction_id']  = intval(1);
			$arr['reaction_name'] = "Like";		
			$arr['reaction_count']      = $reaction_count;	
			$arr['reaction_img'] = esc_url(plugins_url('post-and-page-reactions/img/') . "unlike.png");						
	}	
	else
	{
			$arr['reaction_id']  = intval($smiley_id);
			$arr['reaction_name'] = esc_html(ai_wp_smiley_get_single_details('arete_wp_smileys', 'name', 'id', $smiley_id)); 
			$arr['reaction_img'] = esc_url(plugins_url('post-and-page-reactions/img/'). esc_html(ai_wp_smiley_get_single_details('arete_wp_smileys', 'image', 'id', $smiley_id)));
			$arr['reaction_count']  = intval(ai_post_reaction_get_activity_total_count($activity_id));			
	}			

 return json_encode($arr);	
	
} 
?>