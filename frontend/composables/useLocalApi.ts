import { localHttpClient } from '~/utils/http-client'

export const useLocalApi = () => {
	return localHttpClient()
}
