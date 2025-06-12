import axios from 'axios'
import type { AxiosInstance, AxiosResponse } from 'axios'
import { Notify } from 'quasar'

const baseURL: string = import.meta.env.VITE_API_BASE_URL as string
const showSuccessToastFor: Record<string, boolean> = {
	POST: true,
	PUT: true,
	PATCH: true,
	DELETE: true
}

const httpClient = (): AxiosInstance => {
	const instance = axios.create({
		baseURL,
		headers: {
			'Content-Type': 'application/json',
			Accept: 'application/json'
		}
	})

	instance.interceptors?.response?.use(
		(response: AxiosResponse) => {
			const HTTP_METHOD: string = response.config.method?.toUpperCase() ?? ''

			if (showSuccessToastFor[HTTP_METHOD]) {
				const message = response.data?.status?.message ?? 'Request successful!'
				Notify.create({ type: 'positive', message })
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
			Notify.create({ type: 'negative', message })
			return Promise.reject(error)
		}
	)

	return instance
}

export default defineNuxtPlugin(() => {
	return {
		provide: {
			httpClient: httpClient()
		}
	}
})

