<?php
/*
Plugin Name: Vivocha Activation Tool
Version: 1.0
Plugin URI: http://www.vivocha.com/wordpress/
Description: Vivocha is a cloud-based service, tailored to businesses looking to engage their customers online, using the most effective communication channel at the right time. With Vivocha Activation Tool, you can add easily and automatically the Activation Script on your Wordpress Web Site, and in only one minute, start to Engage your Customers and Visitors!
Author: Mattia Soragni
Author URI: http://www.vivocha.com/
*/

function vivocha_activation_code() {

	$vivocha_options = get_option('vivocha_options');

	echo '
  
  <!-- Vivocha Activation Plugin for Wordpress -->
  <!-- Info@ http://www.vivocha.com/wordpress/ -->
  <script src="//www.vivocha.com/a/'.$vivocha_options['vivocha_id'].'/api/vivocha.js"></script>
  <!-- End Vivocha Activation Plugin -->

  ';
}

function vivocha_admin_section() {
	
	$vivocha_options = get_option('vivocha_options');
	
  if(empty($vivocha_options['vivocha_id'])){
    $signup = '<div style="background:#FFF000; width:700px;"><h2>Hi There!!<br/>Do you haven\'t a Vivocha Account? <a href="http://www.vivocha.com/wordpress/" target="_blank">SignUp for Free Now!</a></h2></div>';
    echo $signup;
  }

	if (isset($_POST['update_options_submit'])) {
		$vivocha_options['vivocha_id'] = $_POST['vivocha_id'];
		update_option('vivocha_options', $vivocha_options);
    echo '<meta http-equiv="refresh" content="0">';
	}

?>

<div class=wrap>
  <form method="POST">
    <h2>Vivocha Activation Plugin for Wordpress</h2>
    <fieldset class="options" name="general">
    <br/>
      <table class="editform">
        <tr>
          <td colspan="2">
            <?php _e('<h3>Enter your Vivocha User ID:</h3>', 'vivocha') ?><br />
            <input name="vivocha_id" type="text" id="vivocha_id" value="<?php echo $vivocha_options['vivocha_id']; ?>" size="30" />
          </td>
        </tr>
      </table>
    </fieldset>
    
    <div class="submit">
      <input type="submit" name="update_options_submit" value="<?php _e('Activate Vivocha!', 'vivocha') ?>" />
	</div>
  </form>

  <?php
  if(!empty($vivocha_options['vivocha_id']))
    {
      ?>
      <table width="400px">
        <tr>
          <td colspan="2" align="center"><h3>Go To Your Vivocha</h3></td>
        </tr>
        <tr>
          <td width="50%" style="font-size:20px" align="center"><a href="https://www.vivocha.com/a/<?php echo $vivocha_options['vivocha_id']; ?>/dash/" target="_blank">Dashboard</a></td>
          <td width="50%" style="font-size:20px" align="center"><a href="https://www.vivocha.com/a/<?php echo $vivocha_options['vivocha_id']; ?>/desk/" target="_blank">Agent Desktop</a></td>
        </tr>
        <tr>
          <td align="center"><i>See Reports, Personalize</br>Widgets and Services</i></td>
          <td align="center"><i>Start Engaging your</br>Visitors, Now!</i></td>
        </tr>
      </table>
      <?php
    }
  ?>
</div>

<?php
}

function vivocha_admin_submenu() {
  add_submenu_page('options-general.php', 'Vivocha Activation', 'Vivocha Activation', 8, __FILE__, 'vivocha_admin_section');
}
  add_action('admin_menu', 'vivocha_admin_submenu');
  add_action('wp_footer', 'vivocha_activation_code');
?>