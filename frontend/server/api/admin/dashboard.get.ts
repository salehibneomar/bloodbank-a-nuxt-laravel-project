import { useRemoteApi } from '~/composables/useRemoteApi'

export default defineEventHandler(async (event) => {
	const httpClient = useRemoteApi()
	const params = getQuery(event)
	const { data: response } = await httpClient.get('/admin/dashboard', { params })
	return response
})
