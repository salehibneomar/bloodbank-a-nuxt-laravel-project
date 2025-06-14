export interface QueryObject {
	[key: string]: any
}

export interface PagingData extends QueryObject {
	current_page: number | string
	last_page: number | string
	total: number | string
	to: number | string
	per_page: number | string
	from: number | string
}

export interface ResponseModel<S, D> {
	status: S
	data: D
}
export interface StatusModel {
	code: number
	message: string
	[key: string]: any
}
