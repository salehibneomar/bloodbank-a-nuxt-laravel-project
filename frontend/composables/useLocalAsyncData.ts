export const useLocalAsyncData = async (key: string, storeCallBack: () => Promise<any>) => {
	return await useAsyncData(key, storeCallBack, { server: false })
}
