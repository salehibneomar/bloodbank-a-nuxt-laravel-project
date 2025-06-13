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

	instance.interceptors.response.use(
		(response: AxiosResponse) => {
			const HTTP_METHOD = response.config.method?.toUpperCase() ?? ''
			if (showSuccessToastFor[HTTP_METHOD]) {
				const message = response.data?.status?.message ?? 'Request successful!'
				showToast && toaster('positive', message)
			}
			return response
		},
		(error) => {
			let message = 'An error occurred!'
			if (error.response?.data?.status?.message) {
				message = error.response.data.status.message
			} else if (error.message && error.code === 'ERR_NETWORK') {
				message = 'Network error!'
			}
			showToast && toaster('negative', message)

			return Promise.reject(error)
		}
	)

	return instance
}

let localInstance: AxiosInstance | null = null
let remoteInstance: AxiosInstance | null = null

export function localHttpClient(): AxiosInstance {
	if (localInstance) return localInstance

	const baseURL = '/api/'

	localInstance = createHttpClient(baseURL, true)
	return localInstance
}

export function remoteHttpClient(): AxiosInstance {
	if (remoteInstance) return remoteInstance

	const baseURL = import.meta.env.VITE_API_BASE_URL as string

	remoteInstance = createHttpClient(baseURL)
	return remoteInstance
}
