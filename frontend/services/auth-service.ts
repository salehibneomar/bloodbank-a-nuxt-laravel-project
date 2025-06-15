export const useAuthService = () => {
	const client = useLocalApi()

	const login = async (payload: AuthLogin) => {
		return await client.post('/auth/login', payload)
	}

	const donorRegister = async (payload: AuthDonor) => {
		return await client.post('/auth/donors/register', payload)
	}

	return {
		login,
		donorRegister
	}
}
