<script setup>
import { onMounted } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import HeaderHome from './PartialsHome/Header.vue';
import FooterHome from './PartialsHome/Footer.vue';

defineProps({
    title: String,
});

onMounted(() => {
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
});
</script>

<template>
    <Head :title="title" />
    
    <HeaderHome :title="title" />
    <slot />

    <FooterHome />

</template>

<style>
	body {
		padding-top: 80px !important;
	}

	.close-menu,
.open-menu {
  position: absolute;
  cursor: pointer;
  display: none;
}

.open-menu {
  top: 50%;
  right: 20px;
  transform: translateY(-50%);
}

.close-menu {
  top: 20px;
  right: 20px;
}

#check {
  display: none;
}

@media (max-width: 800px) {
  .menu {
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 73%;
    height: 100vh;
    position: fixed;
    top: 0;
    right: -100%;
    z-index: 100;
    background-color: #000;
    color: #fff;
    transition: all 0.5s ease-in-out;
    text-transform: uppercase;
    font-size: 24px;
  }

  .menu li {
    margin-top: 40px;
  }

  .menu li a {
    padding: 10px;
  }

  .close-menu,
  .open-menu {
    display: block;
  }

  #check:checked ~ .menu {
    right: 0;
  }
}

</style>
