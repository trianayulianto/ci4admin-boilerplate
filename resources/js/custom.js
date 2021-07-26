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
