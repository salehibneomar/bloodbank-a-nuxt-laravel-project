export type Role = 'admin' | 'donor' | 'visitor'
export const roles: Role[] = ['admin', 'donor', 'visitor']

export const roleRootRoutes: Record<Role, string> = {
	visitor: '/home',
	donor: '/donor',
	admin: '/admin'
}

export const hasRoleMatch = (allowedRoles: Role[], role: Role): boolean => {
	return allowedRoles.includes(role)
}
