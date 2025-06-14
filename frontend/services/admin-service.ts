export const useAdminService = () => {
	const client = useLocalApi()

	const getDashboardData = async (query: QueryObject) => {
		return await client.get(`/admin/dashboard`, { params: query })
	}
	const getAllDonors = async (query: QueryObject) => {
		return await client.get(`/donors/manage`, { params: query })
	}

	return {
		getDashboardData,
		getAllDonors
	}
}
