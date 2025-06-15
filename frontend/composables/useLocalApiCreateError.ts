import type { H3Event } from 'h3'

export const useLocalApiCreateError = (event: H3Event, error: any) => {
	setResponseStatus(event, error.response?.data?.status?.code || 500)

	throw createError({
		statusCode: error.response?.data?.status?.code || 500,
		statusMessage: error.response?.data?.status?.message || 'Registration failed'
	})
}
