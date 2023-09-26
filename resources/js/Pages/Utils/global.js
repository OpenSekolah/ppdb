import { usePage } from '@inertiajs/vue3';

const alertMessage = () => {
	if(usePage().props?.flash?.success !== null && usePage().props?.flash?.success !== undefined) {
		ToastAlert.fire({
			position: 'top-end',
			icon: 'success',
			toast: true,
			title: usePage().props?.flash?.success
		});
	}
	
	if(usePage().props?.flash?.warnings !== null && usePage().props?.flash?.warnings !== undefined) {
		ToastAlert.fire({
			position: 'top-end',
			icon: 'error',
			toast: true,
			title: usePage().props?.flash?.warnings
		});
	}
};

const alertMessageSuccess = (messages) => {
	ToastAlert.fire({
		position: 'top-end',
		icon: 'success',
		toast: true,
		title: messages
	});
};

const alertMessageError = (messages) => {
	ToastAlert.fire({
		position: 'top-end',
		icon: 'error',
		toast: true,
		title: messages
	});
};

export { alertMessage, alertMessageSuccess, alertMessageError };
