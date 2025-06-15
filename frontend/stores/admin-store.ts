export const useAdminStore = defineStore('adminStore', () => {
	const adminService = useAdminService()
	const donors = ref([])
	const dashboardData = ref<AdminDashboardData | null>(null)

	const getDashboardData = async (query = {} as QueryObject) => {
		let response: AdminDashboardData = {} as AdminDashboardData
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await adminService.getDashboardData(query)
			if (+code === 200) {
				dashboardData.value = { ...data }
				response = data
			}
		} catch (error) {
			console.error('Error fetching dashboard data.', error)
		}

		return response
	}

	const getAllDonors = async (query = {} as QueryObject) => {
		let response: any | null = null
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await adminService.getAllDonors(query)
			if (+code === 200) {
				donors.value = data?.data
				response = data
			}
		} catch (error) {
			console.error('Error fetching donors:', error)
		}

		return response
	}

	return { donors, dashboardData, getDashboardData, getAllDonors }
})
