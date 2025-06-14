<script setup lang="ts">
	interface Props {
		donor?: Donor
		loading?: boolean
	}

	const { donor, loading = true } = defineProps<Props>()
	const isOpen = defineModel<boolean>({ default: false })
</script>

<template>
	<q-dialog v-model="isOpen" persistent>
		<q-card style="min-width: 400px; max-width: 600px" class="q-pa-none">
			<q-card-section class="bg-red-1 text-red-8 q-pa-lg">
				<div class="row items-center no-wrap">
					<div class="col">
						<div class="text-h6 text-weight-bold flex items-center">
							<Icon name="mdi:account-circle" class="q-mr-sm text-red-5" size="32px" />
							Donor Details
						</div>
					</div>
					<div class="col-auto">
						<q-btn flat round dense v-close-popup icon="close" color="red-5" size="md" />
					</div>
				</div>
			</q-card-section>

			<q-card-section v-if="loading" class="q-pa-lg bg-white">
				<LoadingState />
			</q-card-section>

			<q-card-section v-else-if="donor" class="q-pa-lg bg-white">
				<div class="row q-col-gutter-xs">
					<div class="col-12 col-md-6">
						<div class="text-subtitle1 text-weight-bold text-grey-8 q-mb-md flex items-center">
							<Icon name="mdi:account-outline" class="q-mr-sm text-red-5" size="20px" />
							Personal Information
						</div>
						<div class="row q-col-gutter-xs">
							<div class="col-12">
								<div class="detail-item">
									<div class="detail-label">Full Name</div>
									<div class="detail-value">{{ donor?.name }}</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Age</div>
									<div class="detail-value">{{ donor?.age || 'N/A' }}</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Blood Group</div>
									<div class="detail-value">
										<q-chip
											color="red-2"
											text-color="red-8"
											size="sm"
											class="text-weight-bold q-ml-none"
										>
											{{ donor?.blood_group }}
										</q-chip>
									</div>
								</div>
							</div>

							<div class="col-12">
								<div class="detail-item">
									<div class="detail-label">Availability</div>
									<div class="detail-value">
										<q-chip
											:color="donor?.is_available ? 'green-2' : 'grey-3'"
											:text-color="donor?.is_available ? 'green-8' : 'grey-7'"
											size="sm"
											class="text-weight-bold q-ml-none"
										>
											{{ donor?.is_available ? 'Available' : 'Unavailable' }}
										</q-chip>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="text-subtitle1 text-weight-bold text-grey-8 q-mb-md flex items-center">
							<Icon name="mdi:contacts-outline" class="q-mr-sm text-red-5" size="20px" />
							Contact Information
						</div>
						<div class="row q-col-gutter-xs">
							<div class="col-12">
								<div class="detail-item">
									<div class="detail-label">Email</div>
									<div class="detail-value">
										<a :href="`mailto:${donor?.email}`" class="text-blue-6 text-decoration-none">
											{{ donor?.email }}
										</a>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="detail-item">
									<div class="detail-label">Phone</div>
									<div class="detail-value">
										<a
											v-if="donor?.phone"
											:href="`tel:${donor.phone}`"
											class="text-green-6 text-decoration-none"
										>
											{{ donor.phone }}
										</a>
										<span v-else class="text-grey-5">N/A</span>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="detail-item">
									<div class="detail-label">Address</div>
									<div class="detail-value">
										{{ `${donor?.address || 'N/A'}` }}
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12">
						<q-separator class="q-my-lg" />
						<div class="text-subtitle1 text-weight-bold text-grey-8 q-mb-md flex items-center">
							<Icon name="mdi:information-outline" class="q-mr-sm text-red-5" size="20px" />
							Additional Information
						</div>
						<div class="row q-col-gutter-xs">
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Profession</div>
									<div class="detail-value">{{ donor?.profession || 'N/A' }}</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Religion</div>
									<div class="detail-value">{{ donor?.religion || 'N/A' }}</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Last Donation</div>
									<div class="detail-value">
										{{ utcToLocalDateTime(donor?.last_donation_date) ?? 'N/A' }}
									</div>
								</div>
							</div>
							<div class="col-12 col-sm-6">
								<div class="detail-item">
									<div class="detail-label">Medical Conditions</div>
									<div class="detail-value">{{ donor?.medical_conditions || 'N/A' }}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</q-card-section>
		</q-card>
	</q-dialog>
</template>

<style scoped>
	.detail-item {
		margin-bottom: 16px;
	}

	.detail-label {
		font-size: 12px;
		font-weight: 600;
		color: #666;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		margin-bottom: 4px;
	}

	.detail-value {
		font-size: 12px;
		font-weight: 500;
		color: #333;
		line-height: 1.4;
	}
</style>
