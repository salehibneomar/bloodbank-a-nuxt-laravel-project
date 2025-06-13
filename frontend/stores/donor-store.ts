export const useDonorStore = defineStore('donorStore', () => {
	const donorService = useDonorService()

	const donors = ref([])
	const donor = ref({})

	async function getAll(query = {} as QueryObject) {
		try {
			const {
				data: { status, data }
			} = await donorService.getAll(query)
			donors.value = data?.data
			return data
		} catch (error) {
			console.error('Error fetching donors:', error)
		}
	}

	// Add more actions here as needed

	return { donors, donor, getAll }
})
