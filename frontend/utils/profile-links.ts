interface ProfileLink {
	label: string
	route: string
	roles: Role[]
	icon: string
	slug?: string
}

export const profileLinks: ProfileLink[] = [
	{
		label: 'Dashboard',
		route: '/admin',
		roles: ['admin'],
		icon: 'dashboard',
		slug: 'admin-dashboard'
	},
	{
		label: 'Home',
		route: '/donor',
		roles: ['donor'],
		icon: 'home',
		slug: 'donor-home'
	},
	{
		label: 'Edit Profile',
		route: '/donor/profile',
		roles: ['donor'],
		icon: 'person',
		slug: 'edit-profile'
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
