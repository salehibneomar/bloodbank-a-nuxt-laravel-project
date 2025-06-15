export default defineNuxtRouteMiddleware((from, to) => {
	const authStore = useAuthStore()

	if (authStore.hasAuthUser && !to.meta.requireAuth) {
		return navigateTo('/')
	}
})
