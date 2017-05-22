<?php

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { 
	die('You are not allowed to call this page directly.');
}

$es_c_email_subscribers_ver = get_option('email-subscribers');
if ($es_c_email_subscribers_ver <> "2.9") {
	?>
	<div class="error fade">
		<p>
		Note: You have recently upgraded the plugin and your tables are not sync. 
		Please <a title="Sync plugin tables." href="<?php echo ES_ADMINURL; ?>?page=es-settings&amp;ac=sync"><?php _e('Click Here', 'email-subscribers'); ?></a> to sync the table. 
		This is mandatory and it will not affect your data.
		</p>
	</div>
	<?php
}

// Form submitted, check the data
if (isset($_POST['frm_es_display']) && $_POST['frm_es_display'] == 'yes') {
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	es_cls_security::es_check_number($did);

	$es_success = '';
	$es_success_msg = FALSE;

	// First check if ID exist with requested ID
	$result = es_cls_compose::es_template_count($did);
	if ($result != '1') {
		?><div class="error fade"><p><strong><?php echo __('Oops, selected details doesnt exist.', 'email-subscribers'); ?></strong></p></div><?php
	} else {
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '') {
			//	Just security thingy that wordpress offers us
			check_admin_referer('es_form_show');

			//	Delete selected record from the table
			es_cls_compose::es_template_delete($did);

			//	Set success message
			$es_success_msg = TRUE;
			$es_success = __('Selected record was successfully deleted.', 'email-subscribers');
		}
	}
	
	if ($es_success_msg == TRUE) {
		?><div class="updated fade"><p><strong><?php echo $es_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-plugins" class="icon32"></div>
    <h2><?php echo __(ES_PLUGIN_DISPLAY, 'email-subscribers'); ?></h2>
	<h3><?php echo __('Compose Mail', 'email-subscribers'); ?>  
	<a class="add-new-h2" href="<?php echo ES_ADMINURL; ?>?page=es-compose&amp;ac=add"><?php echo __('Add New', 'email-subscribers'); ?></a></h3>
    <div class="tool-box">
	<?php
		$myData = array();
		$myData = es_cls_compose::es_template_select(0);
	?>
	<form name="frm_es_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
			<th scope="col"><?php echo __('Email subject', 'email-subscribers'); ?></th>
			<th scope="col"><?php echo __('Status', 'email-subscribers'); ?></th>
            <th scope="col"><?php echo __('Type', 'email-subscribers'); ?></th>
			<th scope="col"><?php echo __('Action', 'email-subscribers'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
			<th scope="col"><?php echo __('Email subject', 'email-subscribers'); ?></th>
			<th scope="col"><?php echo __('Status', 'email-subscribers'); ?></th>
            <th scope="col"><?php echo __('Type', 'email-subscribers'); ?></th>
			<th scope="col"><?php echo __('Action', 'email-subscribers'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
				$i = 0;
				$displayisthere = FALSE;
				if(count($myData) > 0) {
					$i = 1;
					foreach ($myData as $data) {
					?>
						<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
					  		<td><?php echo esc_html(stripslashes($data['es_templ_heading'])); ?></td>
							<td><?php echo $data['es_templ_status']; ?></td>
							<td><?php echo $data['es_email_type']; ?></td>
							<td>
								<a title="Edit" href="<?php echo ES_ADMINURL; ?>?page=es-compose&amp;ac=edit&amp;did=<?php echo $data['es_templ_id']; ?>"><?php echo __('Edit', 'email-subscribers'); ?></a> 
								| <a onClick="javascript:_es_delete('<?php echo $data['es_templ_id']; ?>')" href="javascript:void(0);"><?php echo __('Delete', 'email-subscribers'); ?></a>
								| <a title="Preview" href="<?php echo ES_ADMINURL; ?>?page=es-compose&amp;ac=preview&amp;did=<?php echo $data['es_templ_id']; ?>"><?php echo __('Preview', 'email-subscribers'); ?></a>
							</td>
						</tr>
					<?php
						$i = $i+1;
					}
				} else {
					?><tr><td colspan="4" align="center"><?php _e('No records available.', 'email-subscribers'); ?></td></tr><?php 
				}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('es_form_show'); ?>
		<input type="hidden" name="frm_es_display" value="yes"/>
      </form>	
	  <div class="tablenav">
		  <h2>
			<a class="button add-new-h2" href="<?php echo ES_ADMINURL; ?>?page=es-compose&amp;ac=add"><?php echo __('Add New', 'email-subscribers'); ?></a>
			<a class="button add-new-h2" target="_blank" href="<?php echo ES_FAV; ?>"><?php echo __('Help', 'email-subscribers'); ?></a>
		  </h2>
	  </div>
	  <div style="height:10px;"></div>
	  <p class="description"><?php echo ES_OFFICIAL; ?></p>
	</div>
</div>