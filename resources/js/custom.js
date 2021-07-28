// set refresh token expiration global
window.refreshTokenExpiration = new Date(new Date().getTime() + 60 * 60 * 1000); // 15 minutes

// get refresh token
window.onload = () => {
	cookieStore.get('token').then((cookie) => {
    if (cookie === null) { return; }

		if (Date.now() > cookie.expires) {
			$.ajax({
				url: '/refresh',
				type: 'POST',
				success: (response) => {
					Cookies.set('token', response.access_token, { 
						expires: refreshTokenExpiration 
					});
				}
			});
		}
    });
}

$(window).resize(function () {
    if ($(window).width() < 992) {
        $('#accordionSidebar').addClass('toggled');
        
        if ($(window).width() < 768) {
            $('#page-top').addClass('sidebar-toggled');
        }
        
        return false;
    }
    
    $('#accordionSidebar').removeClass('toggled');
    $('#page-top').removeClass('sidebar-toggled');
});

if ($(window).width() < 992) {
    if ($(window).width() < 768) {
        $('#page-top').addClass('sidebar-toggled');
    }
    
    $('#accordionSidebar').addClass('toggled');
}
