export function isValidEmail(email: string): boolean {
	return /^[\w.!#$%&'*+/=?^_`{|}~-]+@[\w-]+(\.[\w-]+)+$/.test(email)
}

export const objectToApiQuery = (query: QueryObject): string => {
	const params = Object.entries(query)
		.filter((entry) => entry[1] !== undefined && entry[1] !== null && entry[1] !== '')
		.map(
			([k, v]) =>
				encodeURIComponent(k) + '=' + encodeURIComponent(typeof v === 'string' ? v : String(v))
		)
		.join('&')
	return params ? `?${params}` : ''
}

export const utcToLocalDateTime = (
	utcString: string | null,
	options?: Intl.DateTimeFormatOptions
): string | null => {
	if (!utcString) return null
	const date = new Date(utcString)
	return date.toLocaleString('en-US', options)
}
