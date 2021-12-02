// get refresh token
window.onload = () => {
	cookieStore.get('token').then((cookie) => {
    	if (cookie === null) { return; }
    	let expiration = Math.floor((cookie.expires - Date.now()) / 1000 / 60);

		if (expiration < 2850) {
			$.ajax({
				url: '/refresh',
				type: 'POST',
				success: (response) => {
					Cookies.set('token', response.access_token, { 
						expires: new Date(new Date().getTime() + response.expires_in * 60 * 1000)
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
