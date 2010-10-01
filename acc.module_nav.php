<?php if (! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Module Tab Accessory Class for EE2
 *
 * @package   Module Tab
 * @author    Brandon Kelly <brandon@pixelandtonic.com>
 * @copyright Copyright (c) 2010 Pixel & Tonic, LLC
 */

class Module_nav_acc {

	var $name        = 'Module Tab';
	var $id          = 'module_tab';
	var $version     = '1.0';
	var $description = 'My accessory has a lovely description.';
	var $sections    = array();

	/**
	 * Constructor
	 */
	function Module_nav_acc()
	{
		$this->EE =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	 * Insert JS
	 */
	private function _insert_js($js)
	{
		$this->EE->cp->add_to_foot('<script type="text/javascript">'.$js.'</script>');
	}

	// --------------------------------------------------------------------

	/**
	 * Set Sections
	 */
	function set_sections()
	{
		if ($this->EE->session->userdata['can_access_modules'] == 'y')
		{
			$this->EE->cp->load_package_js('module_nav');

			$group_id = $this->EE->session->userdata['group_id'];

			if ($group_id == 1)
			{
				$query = $this->EE->db->query('SELECT module_name
				                               FROM exp_modules
				                               WHERE has_cp_backend = "y"
				                               ORDER BY module_name');
			}
			else
			{
				$query = $this->EE->db->query('SELECT m.module_name
				                               FROM exp_modules m, exp_module_member_groups mmg
				                               WHERE m.module_id = mmg.module_id
				                               AND mmg.group_id = '.$group_id.'
				                               AND m.has_cp_backend = "y"
				                               ORDER BY m.module_name');
			}

			if ($query->num_rows())
			{
				foreach ($query->result_array() as $row)
				{
					$name = $row['module_name'];
					$url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.strtolower($name);
					$this->_insert_js('addModuleNav("'.$name.'", "'.$url.'");');
				}
			}
		}
	}

}
