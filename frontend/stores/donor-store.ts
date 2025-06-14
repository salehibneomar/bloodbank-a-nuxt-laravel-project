export const useDonorStore = defineStore('donorStore', () => {
	const donorService = useDonorService()
	const donors = ref([])
	const donor = ref({})

	async function getAll(query = {} as QueryObject) {
		let response: any | null = null
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await donorService.getAll(query)
			if (+code === 200) {
				donors.value = data?.data
				response = data
			}
		} catch (error) {
			console.error('Error fetching donors:', error)
		}

		return response
	}

	async function getById(id: string | number) {
		let response: any | null = null
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await donorService.getById(id)
			if (+code === 200) {
				donor.value = data
				response = data
			}
		} catch (error) {
			console.error('Error fetching donors:', error)
		}

		return response
	}

	return { donors, donor, getAll, getById }
})
