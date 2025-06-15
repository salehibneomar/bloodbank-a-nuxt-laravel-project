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
		async (error) => {
			const errorResponse = await error.response
			const errorData = errorResponse?.data || {}
			let message = errorData?.statusMessage || 'An error occurred!'

			if (errorData?.status?.message) {
				console.log('1, CULPRIT')
				message = errorData.status.message
			} else if (errorData?.message && +errorData?.statusCode !== 500) {
				console.log('2, CULPRIT')
				message = errorData.message
				console.log('2.0, CULPRIT', message)
				const messageData = JSON.parse(JSON.stringify(message))
				if (typeof messageData === 'object') {
					console.log('2.1, CULPRIT')
					message = Object.values(messageData).join(', ')
				}
			} else if (error.code === 'ERR_NETWORK') {
				console.log('3, CULPRIT')
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

	const siteUrl = import.meta.env.VITE_SITE_URL
	const baseURL = siteUrl ? `${siteUrl}/api/` : `${siteUrl}/api/`

	localInstance = createHttpClient(baseURL, true)
	return localInstance
}

export function remoteHttpClient(): AxiosInstance {
	if (remoteInstance) return remoteInstance

	const baseURL = import.meta.env.VITE_API_BASE_URL as string

	remoteInstance = createHttpClient(baseURL)
	return remoteInstance
}
