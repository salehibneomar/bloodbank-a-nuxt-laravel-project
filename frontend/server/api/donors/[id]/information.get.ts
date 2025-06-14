import { useRemoteApi } from '~/composables/useRemoteApi'

export default defineEventHandler(async (event) => {
	const httpClient = useRemoteApi()
	const { id } = getRouterParams(event)
	const { data: response } = await httpClient.get(`/donors/${id}/information`)
	return response
})
