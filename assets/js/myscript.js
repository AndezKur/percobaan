const pesan = $('.flash-data').data('flashdata');

if (pesan) {
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 2000,
	});

	Toast.fire({
		icon: 'success',
		title: pesan
	});
}
