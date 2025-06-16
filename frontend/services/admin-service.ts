export const useAdminService = () => {
	const client = useHttpClient()

	const getDashboardData = async (query: QueryObject) => {
		return await client.get(`/admin/dashboard`, { params: query })
	}

	const getAllDonors = async (query: QueryObject) => {
		return await client.get(`/donors/manage`, { params: query })
	}

	const changeDonorStatus = async (donorId: string | number, status: boolean) => {
		return await client.put(`/donors/change-status/${donorId}`, { is_active: status })
	}

	return {
		getDashboardData,
		getAllDonors,
		changeDonorStatus
	}
}
