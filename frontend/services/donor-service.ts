export const useDonorService = () => {
	const client = useLocalApi()
	const MODEL = 'donors'
	const getAll = async (query: QueryObject) => {
		return await client.get(`/${MODEL}`, { params: query })
	}

	const getById = async (id: string | number) => {
		return await client.get(`/${MODEL}/${id}/information`)
	}

	return {
		getAll,
		getById
	}
}
