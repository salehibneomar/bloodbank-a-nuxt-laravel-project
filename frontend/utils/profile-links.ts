interface ProfileLink {
	label: string
	route: string
	roles: Role[]
	icon: string
	slug?: string
}

export const profileLinks: ProfileLink[] = [
	{
		label: 'Profile',
		route: '/donor/profile',
		roles: ['donor'],
		icon: 'person',
		slug: 'profile'
	},
	// {
	// 	label: 'Update Password',
	// 	route: '/update-password',
	// 	roles: ['donor', 'admin'],
	// 	icon: 'lock'
	// },
	{
		label: 'Manage Donors',
		route: '/donor/manage',
		roles: ['admin'],
		icon: 'manage_accounts',
		slug: 'manage-donors'
	}
]
