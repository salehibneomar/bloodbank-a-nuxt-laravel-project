<script setup lang="ts">
	definePageMeta({
		name: 'admin-dashboard',
		title: 'Admin Dashboard',
		requireAuth: true,
		roles: ['admin']
	})

	useHead({
		title: 'Admin - Dashboard'
	})

	const isLoading = ref(true)

	const adminStore = useAdminStore()

	onMounted(async () => {
		await adminStore.getDashboardData()
		isLoading.value = false
	})
</script>

<template>
	<LoadingState v-if="isLoading" />
	<div v-else class="row justify-center">
		<div class="col-md-6 col-sm-8 col-12">
			<div class="q-pa-lg">
				<!-- Banner -->
				<div class="bg-red-1 rounded-borders q-pa-xl q-mb-lg border-section flex items-center">
					<Icon name="mdi:view-dashboard" size="40px" class="text-red-5 q-mr-md" />
					<div>
						<div class="text-h5 text-weight-bold text-grey-10">Welcome, Admin!</div>
						<div class="text-body2 text-grey-7 text-caption">Here is your system overview.</div>
					</div>
				</div>

				<!-- Info Cards -->
				<div class="row q-col-gutter-md">
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:account-group" size="32px" class="text-red-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Total Users</div>
							<div class="text-h5 text-red-7 text-weight-bold">
								{{ adminStore.dashboardData?.total_users }}
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:account-check" size="32px" class="text-green-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Active Users</div>
							<div class="text-h5 text-green-7 text-weight-bold">
								{{ adminStore.dashboardData?.active_users }}
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:account-off" size="32px" class="text-grey-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Blocked Users</div>
							<div class="text-h5 text-grey-6 text-weight-bold">
								{{ adminStore.dashboardData?.inactive_users }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped lang="css">
	.rounded-borders {
		border-radius: 5px;
	}
	.border-section {
		border: 1.5px solid #e0e0e0;
		box-shadow: none;
	}
	.info-card-fill {
		flex: 1 1 0%;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		height: 100%;
	}
</style>
