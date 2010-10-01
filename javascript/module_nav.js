var addModuleNav;

(function($) {

// remove the tab
$('#accessoryTabs > ul > li > a.module_tab').parent('li').remove()


var $addonsHeading = $('#navigationTabs > li > a:contains("Add-Ons")'),
	$addonsMenu = $addonsHeading.next(),
	$adminMenu = $('#navigationTabs > li > a:contains("Admin")').next(),
	$lastAdminDivider = $('> .nav_divider:last', $adminMenu);

// Add-on Administration
$('<li class="nav_divider" />').insertAfter($lastAdminDivider);
$('<li class="parent"><a href="#" tabindex="-1">Add-on Administration</a></li>')
	.insertAfter($lastAdminDivider)
	.append($addonsMenu);

// Modules
$addonsHeading.html('Modules');
var $modulesMenu = $('<ul />').insertAfter($addonsHeading),
	$lastModulesDivider = $('<li class="bubble_footer" />').appendTo($modulesMenu);


/**
 * Add Module Nav Item
 */
addModuleNav = function(name, url) {
	$('<li><a href="'+url+'">'+name+'</a></li>').insertBefore($lastModulesDivider);
};

})(jQuery);
