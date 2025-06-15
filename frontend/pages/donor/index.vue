<script setup lang="ts">
	definePageMeta({
		name: 'donor-dashboard',
		title: 'Home',
		requireAuth: true,
		roles: ['donor']
	})

	useHead({
		title: 'Home'
	})

	const authStore = useAuthStore()
	const donorStore = useDonorStore()
	const isLoading = ref(true)

	onMounted(async () => {
		await donorStore.profile()
		isLoading.value = false
	})
</script>

<template lang="">
	<LoadingState v-if="isLoading" />
	<div v-else class="row justify-center">
		<div class="col-md-6 col-sm-8 col-12">
			<div class="q-pa-lg">
				<!-- Banner -->
				<div class="bg-red-1 rounded-borders q-pa-xl q-mb-lg border-section flex items-center">
					<Icon name="mdi:hand-heart" size="40px" class="text-red-5 q-mr-md" />
					<div>
						<div class="text-h5 text-weight-bold text-grey-10">
							Welcome, {{ authStore.authUser?.name }}!
						</div>
						<div class="text-body2 text-grey-7 text-caption">
							Thank you for being a life saver. Here is your dashboard.
						</div>
					</div>
				</div>

				<!-- Info Cards -->
				<div v-if="donorStore.profileData" class="row q-col-gutter-md">
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:calendar-plus" size="32px" class="text-blue-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Joined At</div>
							<div class="text-body2 text-grey-8 text-caption">
								{{
									utcToLocalDateTime(
										donorStore.profileData?.created_at,
										{
											year: 'numeric',
											month: '2-digit',
											day: '2-digit'
										},
										'sv-SE'
									)
								}}
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:calendar-heart" size="32px" class="text-red-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Last Donation</div>
							<div class="text-body2 text-grey-8 text-caption">
								{{
									donorStore.profileData?.last_donation_date
										? utcToLocalDateTime(
												donorStore.profileData?.last_donation_date,
												{
													year: 'numeric',
													month: '2-digit',
													day: '2-digit'
												},
												'sv-SE'
										  )
										: 'N/A'
								}}
							</div>
						</div>
					</div>
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon
								name="mdi:check-circle"
								size="32px"
								class="text-green-5 q-mb-sm"
								v-if="donorStore.profileData?.is_available"
							/>
							<Icon name="mdi:close-circle" size="32px" class="text-red-5 q-mb-sm" v-else />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Available for Donation</div>
							<q-chip
								:color="donorStore.profileData?.is_available ? 'green-1' : 'red-1'"
								:text-color="donorStore.profileData?.is_available ? 'green-8' : 'red-8'"
								size="sm"
								class="q-mt-xs"
								square
							>
								{{ donorStore.profileData?.is_available ? 'Yes' : 'No' }}
							</q-chip>
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
