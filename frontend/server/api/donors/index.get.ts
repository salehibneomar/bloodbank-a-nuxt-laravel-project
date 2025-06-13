import { useRemoteApi } from '~/composables/useRemoteApi'

export default defineEventHandler(async () => {
	const httpClient = useRemoteApi()
	const { data: response } = await httpClient.get('/donors')
	return response
})
