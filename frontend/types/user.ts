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

export interface BareUSer {
	id: number
	name: string
	email: string
	phone?: string | null
	is_active: number | boolean
	created_at?: string
}

export interface AuthUser extends BareUSer {
	role: Role
}

export interface Donor extends BareUSer {
	blood_group: string
	address: string | null
	age: number | null
	profession: string | null
	religion: string | null
	medical_conditions: string | null
	is_available: number | boolean
	last_donation_date: string | null
}
