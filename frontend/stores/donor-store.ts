export const useDonorStore = defineStore('donorStore', () => {
	const donorService = useDonorService()
	const donors = ref<Donor[]>([])
	const donor = ref<Donor | null>(null)
	const profileData = ref<Donor | null>(null)
	const authStore = useAuthStore()

	const getAll = async (query = {} as QueryObject) => {
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

	const getById = async (id: string | number) => {
		let response: any | null = null
		donor.value = response
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
			console.error('Error fetching donor:', error)
		}

		return response
	}

	const profile = async () => {
		let response: any | null = null
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await donorService.profile()
			if (+code === 200) {
				profileData.value = data
				response = data
			}
		} catch (error) {
			console.error('Error fetching profile:', error)
		}

		return response
	}

	const updateProfile = async (payload: Donor) => {
		let response: any | null = null
		try {
			const {
				data: {
					status: { code },
					data
				}
			} = await donorService.updateProfile(payload)
			if (+code === 200) {
				profileData.value = {
					...payload,
					...data,
					is_available: Boolean(
						data.hasOwnProperty('is_available') ? +data.is_available : +payload?.is_available
					)
				}
				const { name, email, phone } = data
				authStore.authUser = {
					...authStore.authUser,
					name,
					email,
					phone
				} as AuthUser
				response = data
			}
		} catch (error) {
			console.error('Error updating profile:', error)
		}

		return response
	}

	return { donors, donor, profileData, getAll, getById, profile, updateProfile }
})
