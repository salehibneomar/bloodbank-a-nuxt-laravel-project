export type Role = 'admin' | 'donor' | 'visitor'
export const roles: Role[] = ['admin', 'donor', 'visitor']

export const roleRootRoutes: Record<Role, string> = {
	visitor: '/home',
	donor: '/donor',
	admin: '/admin'
}
