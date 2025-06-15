<script setup lang="ts">
	definePageMeta({
		name: 'donor-dashboard',
		title: 'Donor Dashboard',
		requireAuth: true
	})

	useHead({
		title: 'Donor - Dashboard'
	})

	const authStore = useAuthStore()
	const donor = ref<AuthUser>({} as AuthUser)

	onMounted(() => {
		donor.value = authStore.authUser as AuthUser
	})
</script>

<template lang="">
	<div class="row justify-center">
		<div class="col-md-6 col-sm-8 col-12">
			<div class="q-pa-lg">
				<!-- Banner -->
				<div class="bg-red-1 rounded-borders q-pa-xl q-mb-lg border-section flex items-center">
					<Icon name="mdi:hand-heart" size="40px" class="text-red-5 q-mr-md" />
					<div>
						<div class="text-h5 text-weight-bold text-grey-10">Welcome, {{ donor?.name }}!</div>
						<div class="text-body2 text-grey-7 text-caption">
							Thank you for being a life saver. Here is your dashboard.
						</div>
					</div>
				</div>

				<!-- Info Cards -->
				<div class="row q-col-gutter-md">
					<div class="col-12 col-md-4 flex">
						<div
							class="bg-white rounded-borders border-section q-pa-lg flex column items-center text-center info-card-fill"
						>
							<Icon name="mdi:calendar-plus" size="32px" class="text-blue-5 q-mb-sm" />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Joined At</div>
							<div class="text-body2 text-grey-8 text-caption">
								{{ utcToLocalDateTime(donor?.created_at) }}
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
									donor?.last_donation_date ? utcToLocalDateTime(donor?.last_donation_dat) : 'N/A'
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
								v-if="donor?.is_available"
							/>
							<Icon name="mdi:close-circle" size="32px" class="text-red-5 q-mb-sm" v-else />
							<div class="text-subtitle1 text-grey-10 text-weight-bold">Available for Donation</div>
							<q-chip
								:color="donor?.is_available ? 'green-1' : 'red-1'"
								:text-color="donor?.is_available ? 'green-8' : 'red-8'"
								size="sm"
								class="q-mt-xs"
								square
							>
								{{ donor?.is_available ? 'Yes' : 'No' }}
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
