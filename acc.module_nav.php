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
	 * Set Sections
	 */
	function set_sections()
	{
		if ($this->EE->session->userdata['can_access_modules'] == 'y')
		{
			$this->EE->cp->load_package_js('module_nav');
			$this->EE->lang->loadfile('module_nav');

			$lang = array(
				'addons' => $this->EE->lang->line('nav_addons'),
				'admin' => $this->EE->lang->line('nav_admin'),
				'addon_administration' => $this->EE->lang->line('nav_addon_administration'),
				'modules' => $this->EE->lang->line('nav_modules')
			);

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

			$modules = array();

			if ($query->num_rows())
			{
				foreach ($query->result_array() as $row)
				{
					$class = strtolower($row['module_name']);
					$this->EE->lang->loadfile($class);
					$name = $this->EE->lang->line($class.'_module_name');
					$url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module='.$class;

					$modules[] = array($name, $url);
				}
			}

			$this->EE->cp->add_to_foot('<script type="text/javascript">initModuleNav('
				.   $this->EE->javascript->generate_json($lang, TRUE) . ', '
				.   $this->EE->javascript->generate_json($modules, TRUE)
				. ');</script>');
		}
	}

}
