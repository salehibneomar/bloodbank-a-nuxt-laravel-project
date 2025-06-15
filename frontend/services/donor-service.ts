export const useDonorService = () => {
	const client = useHttpClient()
	const MODEL = 'donors'
	const getAll = async (query: QueryObject) => {
		return await client.get(`/${MODEL}`, { params: query })
	}

	const getById = async (id: string | number) => {
		return await client.get(`/${MODEL}/${id}/information`)
	}

	const profile = async () => {
		return await client.get(`${MODEL}/profile`)
	}

	const updateProfile = async (payload: Donor) => {
		return await client.put(`${MODEL}/profile`, payload)
	}

	return {
		getAll,
		getById,
		profile,
		updateProfile
	}
}
