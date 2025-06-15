export default defineNuxtRouteMiddleware((to) => {
	const authStore = useAuthStore()
	const roles = (to.meta?.roles || []) as Role[]
	const requiresAuth = to.meta?.requireAuth || false

	if (requiresAuth) {
		if (!authStore.hasAuthUser) {
			return navigateTo('/auth/login')
		} else if (roles?.length && !hasRoleMatch(roles, authStore.authUserRole as Role)) {
			return navigateTo(roleRootRoutes[authStore.authUserRole as Role])
		}
	}
})
