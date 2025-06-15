import { useRemoteApi } from '~/composables/useRemoteApi'
import { useLocalApiCreateError } from '~/composables/useLocalApiCreateError'

export default defineEventHandler(async (event) => {
	const httpClient = useRemoteApi()
	const payload = await readBody(event)
	try {
		const { data: response } = await httpClient.post('/auth/donors/register', payload)
		setResponseStatus(event, response.status?.code)

		return response
	} catch (error: any) {
		useLocalApiCreateError(event, error)
	}
})
