"use strict"

var themeOptionArr = {
			typography: '',
			version: '',
			layout: '',
			primary: '',
			headerBg: '',
			navheaderBg: '',
			sidebarBg: '',
			sidebarStyle: '',
			sidebarPosition: '',
			headerPosition: '',
			containerLayout: '',
			//direction: '',
		};





(function($) {

	"use strict"

	//var direction =  getUrlParams('dir');
	var theme =  getUrlParams('theme');

	/* Dz Theme Demo Settings  */

	var dlabThemeSet0 = { /* Default Theme */
		typography: "poppins",
		version: "light",
		layout: "vertical",
		primary: "color_1",
		headerBg: "color_1",
		navheaderBg: "color_1",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};

	var dlabThemeSet1 = {
		typography: "poppins",
		version: "light",
		layout: "vertical",
		primary: "color_12",
		headerBg: "color_12",
		navheaderBg: "color_12",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};

	var dlabThemeSet2 = {
		typography: "poppins",
		version: "light",
		layout: "vertical",
		primary: "color_10",
		headerBg: "color_4",
		navheaderBg: "color_4",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "boxed",
	};


	var dlabThemeSet3 = {
		typography: "poppins",
		version: "light",
		layout: "vertical",
		primary: "color_7",
		headerBg: "color_1",
		navheaderBg: "color_7",
		sidebarBg: "color_7",
		sidebarStyle: "compact",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};

	var dlabThemeSet4 = {
		typography: "poppins",
		version: "light",
		layout: "horizontal",
		primary: "color_10",
		headerBg: "color_10",
		navheaderBg: "color_10",
		sidebarBg: "color_1",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};

	var dlabThemeSet5 = {
		typography: "poppins",
		version: "light",
		layout: "horizontal",
		primary: "color_12",
		headerBg: "color_12",
		navheaderBg: "color_12",
		sidebarBg: "color_12",
		sidebarStyle: "full",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};
	var dlabThemeSet6 = {
		typography: "poppins",
		version: "light",
		layout: "vertical",
		primary: "color_11",
		headerBg: "color_1",
		navheaderBg: "color_11",
		sidebarBg: "color_11",
		sidebarStyle: "mini",
		sidebarPosition: "fixed",
		headerPosition: "fixed",
		containerLayout: "full",
	};



	/*  set switcher option start  */
	function getElementAttrs(el) {
		return [].slice.call(el.attributes).map((attr) => {
			return {
				name: attr.name,
				value: attr.value
			}
		});
	}

	function handleSetThemeOption(item, index, arr) {

		var attrName = item.name.replace('data-','').replace('-','_');

		if(attrName === "sidebarbg" || attrName === "primary" || attrName === "headerbg" || attrName === "nav_headerbg" ){
			if(item.value === "color_1"){
				return false;
			}
			var attrNameColor = attrName.replace("bg","")
			document.getElementById(attrNameColor+"_"+item.value).checked = true;
		}else if(attrName === "navigationbarimg"){
			document.getElementById("sidebar_img_"+item.value.split('sidebar-img/index.html')[1].split('.')[0]).checked = true;
		}else if(attrName === "sidebartext"){
			document.getElementById("sidebar_text_"+item.value).checked = true;
		} else if(attrName === "sidebar_style" || attrName === "sidebar_position" || attrName === "header_position" || attrName === "typography" || attrName === "theme_version" ){
			if(item.value === "cairo" || item.value === "full" || item.value === "fixed"|| item.value === "light"){return false}
			document.getElementById(attrName).value = item.value;
		}else if(attrName === "layout"){
			if(item.value === "vertical"){return false}
			document.getElementById("clients").value = item.value;
		}
		else if(attrName === "container"){
			if(item.value === "wide"){return false}
			document.getElementById("container").value = item.value;
		}


	}
	/* / set switcher option end / */
	function themeChange(theme){
		var themeSettings = {};
		themeSettings = eval('dlabThemeSet'+theme);
		dlabSettingsOptions = themeSettings; /* For Screen Resize */
		new dlabSettings(themeSettings);

		/* To Set Sidebar left panel in the horizontal view */
		if(themeSettings.layout == 'horizontal'){
			jQuery('.wallet-bar').removeClass('active');
			jQuery('.wallet-open').removeClass('active');

		}else{
			jQuery('.wallet-bar').addClass('active');
			jQuery('.wallet-open').addClass('active');
		}

		setThemeInCookie(themeSettings);
	}

	function setThemeInCookie(themeSettings)
	{
		//console.log(themeSettings);
		jQuery.each(themeSettings, function(optionKey, optionValue) {
			setCookie(optionKey,optionValue);
		});
	}

	function setThemeLogo() {
		var logo = getCookie('logo_src');

		var logo2 = getCookie('logo_src2');

		if(logo != ''){
			jQuery('.nav-header .logo-abbr').attr("src", logo);
		}

		if(logo2 != ''){
			jQuery('.nav-header .logo-compact, .nav-header .brand-title').attr("src", logo2);
		}
	}

	function setThemeOptionOnPage(){
		if(getCookie('version') != '')
		{
			jQuery.each(themeOptionArr, function(optionKey, optionValue) {
				var optionData = getCookie(optionKey);
				themeOptionArr[optionKey] = (optionData != '')?optionData:dlabSettingsOptions[optionKey];
			});
			//console.log(themeOptionArr);
			dlabSettingsOptions = themeOptionArr;
			new dlabSettings(dlabSettingsOptions);

			setThemeLogo();


			/* To Set Sidebar left panel in the horizontal view */
			if(themeOptionArr.layout == 'horizontal'){
				jQuery('.wallet-bar').removeClass('active');
				jQuery('.wallet-open').removeClass('active');
			}else{
				jQuery('.wallet-bar').addClass('active');
				jQuery('.wallet-open').addClass('active');
			}

		}
	}



	jQuery(document).on('click', '.dlab_theme_demo', function(){

		setTimeout(() => {
			var allAttrs = getElementAttrs(document.querySelector('body'));
			allAttrs.forEach(handleSetThemeOption);
			$('.default-select').selectpicker('refresh');
		},1500);
		var demoTheme = jQuery(this).data('theme');
		themeChange(demoTheme, 'ltr');


	});

	jQuery(document).on('click', '.dlab_theme_demo_rtl', function(){
		var demoTheme = jQuery(this).data('theme');
		themeChange(demoTheme, 'rtl');
	});



	jQuery(window).on('load', function(){
		//direction = (direction != undefined)?direction:'ltr';
		if(theme != undefined){
			themeChange(theme);

			/* Activate demo */
			jQuery('.dlab-demo-bx').removeClass('demo-active');
			jQuery('[data-theme="'+theme+'"]').parent().parent().addClass('demo-active');


		}else if(getCookie('version') == ''){
				themeChange(0);

		}
		setTimeout(() => {
			var allAttrs = getElementAttrs(document.querySelector('body'));
			allAttrs.forEach(handleSetThemeOption);
			$('.default-select').selectpicker('refresh');
		},1500);

		/* Set Theme On Page From Cookie */
		setThemeOptionOnPage();


	});
	jQuery(window).on('resize', function(){
		setThemeOptionOnPage();
	});



})(jQuery);
