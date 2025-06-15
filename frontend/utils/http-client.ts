import axios from 'axios'
import type { AxiosInstance, AxiosResponse } from 'axios'

const showSuccessToastFor: Record<string, boolean> = {
	POST: true,
	PUT: true,
	PATCH: true,
	DELETE: true
}

const toaster = async (type: 'positive' | 'negative', message: string): Promise<void> => {
	if (typeof window !== 'undefined') {
		const { Notify } = await import('quasar')
		Notify.create({ type, message })
	}
}

function createHttpClient(baseURL: string, showToast: boolean = true): AxiosInstance {
	const instance = axios.create({
		baseURL,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		}
	})

	instance.interceptors.request.use((config) => {
		try {
			const authStore = useAuthStore()
			if (authStore.hasAuthUser && authStore.authUserToken) {
				config.headers.Authorization = `Bearer ${authStore.authUserToken}`
			}
		} catch (error) {}
		return config
	})

	instance.interceptors.response.use(
		(response: AxiosResponse) => {
			const HTTP_METHOD = response.config.method?.toUpperCase() ?? ''
			if (showSuccessToastFor[HTTP_METHOD]) {
				const message = response.data?.status?.message ?? 'Request successful!'
				showToast && toaster('positive', message)
			}
			return response
		},
		async (error) => {
			const errorResponse = await error.response
			const errorData = errorResponse?.data || {}
			let message = errorData?.statusMessage || 'An error occurred!'

			if (errorData?.status?.message) {
				message = errorData.status.message
				try {
					const messageData = JSON.parse(message)
					if (typeof messageData === 'object') {
						message = Object.values(messageData).join(', ')
					}
				} catch (e) {}
			} else if (error.code === 'ERR_NETWORK') {
				message = 'Network error!'
			}

			showToast && toaster('negative', message)

			return Promise.reject(error)
		}
	)

	return instance
}

let axiosInstance: AxiosInstance | null = null

export function httpClient(): AxiosInstance {
	if (axiosInstance) return axiosInstance

	const baseURL = import.meta.env.VITE_API_BASE_URL as string

	axiosInstance = createHttpClient(baseURL)
	return axiosInstance
}
