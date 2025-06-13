import { useRemoteApi } from '~/composables/useRemoteApi'

export default defineEventHandler(async (event) => {
	const httpClient = useRemoteApi()
	const params = getQuery(event)
	console.log('params', params)
	const { data: response } = await httpClient.get('/donors', { params })
	return response
})
