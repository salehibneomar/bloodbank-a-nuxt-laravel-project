export const useAuthService = () => {
	const client = useHttpClient()
	const PREFIX = '/auth'

	const login = async (payload: AuthLogin) => {
		return await client.post(`${PREFIX}/login`, payload)
	}

	const logout = async () => {
		return await client.post(`${PREFIX}/logout`)
	}

	const donorRegister = async (payload: AuthDonor) => {
		return await client.post(`${PREFIX}/donors/register`, payload)
	}

	return {
		login,
		logout,
		donorRegister
	}
}
