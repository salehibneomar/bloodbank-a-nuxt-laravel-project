export const useAuthStore = defineStore(
	'authStore',
	() => {
		const authService = useAuthService()
		const registeredDonor = ref<Donor | null>(null)
		const authUser = ref<AuthUser | null | false>(null)
		const authUserToken = ref<string | null | false>(null)
		const authUserRole = ref<Role | null | false>(null)
		const hasAuthUser = ref<boolean>(false)

		const login = async (payload: AuthLogin) => {
			let response: AuthUser | null = null
			try {
				const {
					data: {
						status,
						data: { user, token }
					}
				} = await authService.login(payload)
				if (status.code === 200) {
					authUser.value = user
					authUserToken.value = token
					authUserRole.value = user.role as Role
					hasAuthUser.value = true
					response = user
				}
			} catch (error) {
				console.error('Login failed:', error)
			}
			return response
		}

		const logout = async () => {
			let response: any | null = null
			try {
				const {
					data: { status, data }
				} = await authService.logout()
				if (status.code === 200) {
					await reset()
					await navigateTo('/')
				}
				response = data
			} catch (error) {
				console.error('Logout failed:', error)
			}
			return response
		}

		const donorRegister = async (payload: AuthDonor) => {
			let response: Donor | null = null
			try {
				const {
					data: { status, data: donor }
				} = await authService.donorRegister(payload)
				if (status.code === 201) {
					registeredDonor.value = donor
					response = donor
				}
			} catch (error) {
				console.error('Registration failed:', error)
			}

			return response
		}

		const reset = async () => {
			authUser.value = false
			authUserToken.value = false
			authUserRole.value = false
			hasAuthUser.value = false
		}

		return {
			registeredDonor,
			authUser,
			authUserToken,
			authUserRole,
			hasAuthUser,
			donorRegister,
			login,
			logout,
			reset
		}
	},
	{
		persist: {
			key: 'auth',
			storage: piniaPluginPersistedstate.cookies(),
			pick: ['authUser', 'authUserToken', 'authUserRole', 'hasAuthUser']
		}
	}
)
