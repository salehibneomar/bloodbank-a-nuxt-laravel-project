export interface AuthLogin {
	email: string
	password: string
}

export interface AuthRegister extends AuthLogin {
	name: string
	password_confirmation: string
}

export interface AuthDonor extends AuthRegister {
	blood_group: string
}

export interface Donor {
	id: number
	name: string
	email: string
	blood_group: string
	phone: string | null
	address: string | null
	age: number | null
	profession: string | null
	religion: string | null
	medical_conditions: string | null
	is_available: number | boolean
	last_donation_date: string | null
}
