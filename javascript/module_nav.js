var initModuleNav;

(function($) {


// remove the tab
$('#accessoryTabs > ul > li > a.module_tab').parent('li').remove()

/**
 * Initialize Module Nav
 */
initModuleNav = function(lang, modules) {

	var $addonsHeading = $('#navigationTabs > li > a:contains("'+lang.addons+'")'),
		$addonsMenu = $addonsHeading.next(),
		$adminMenu = $('#navigationTabs > li > a:contains("'+lang.admin+'")').next(),
		$lastAdminDivider = $('> .nav_divider:last', $adminMenu);

	// Add-on Administration
	if ($adminMenu.length > 0) {
		$('<li class="nav_divider" />').insertAfter($lastAdminDivider);
		$('<li class="parent"><a href="#" tabindex="-1">'+lang.addon_administration+'</a></li>')
			.insertAfter($lastAdminDivider)
			.append($addonsMenu);
	} else {
		$addonsMenu.remove();
	}

	// Modules
	$addonsHeading.html(lang.modules);
	var $modulesMenu = $('<ul />').insertAfter($addonsHeading),
		$lastModulesDivider = $('<li class="bubble_footer" />').appendTo($modulesMenu);

	for (var i=0; i<modules.length; i++) {
		var module = modules[i];
		$('<li><a href="'+module[1]+'">'+module[0]+'</a></li>').insertBefore($lastModulesDivider);
	}

};


})(jQuery);
