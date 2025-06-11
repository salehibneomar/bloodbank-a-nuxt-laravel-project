export interface AuthLogin {
  email: string
  password: string
}

export interface AuthRegister extends AuthLogin{
  name: string
  password_confirmation: string
}

export interface AuthDonor extends AuthRegister {
  blood_group: string
}
