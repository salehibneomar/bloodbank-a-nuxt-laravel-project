<script setup lang="ts">
	interface Props {
		donor: Donor
	}
	const { donor } = defineProps<Props>()
</script>

<template>
	<q-item>
		<!-- Blood Group Badge -->
		<div class="flex flex-center q-mr-sm" style="min-width: 64px; min-height: 64px">
			<div
				class="bg-red-1 text-red-5 text-h6 text-weight-bold flex flex-center"
				style="width: 48px; height: 48px; border-radius: 12px"
			>
				{{ donor.blood_group }}
			</div>
		</div>
		<!-- Donor Info -->
		<q-item-section>
			<div class="text-subtitle1 text-grey-10 text-weight-bold">
				{{ donor.name }}
			</div>
			<div class="column">
				<div class="row items-center">
					<div class="col-12 col-sm-auto flex items-center">
						<span class="text-grey-8 flex items-center">
							<Icon
								name="mdi:email-outline"
								size="18px"
								class="q-mr-xs"
								style="vertical-align: middle; color: #1976d2"
							/>
							<span class="q-ml-xs text-caption">{{ donor.email }}</span>
						</span>
					</div>
					<div v-if="donor.phone" class="col-12 col-sm-auto flex items-center">
						<span class="text-grey-8 flex items-center q-ml-md q-ml-sm-none">
							<Icon
								name="mdi:phone-outline"
								size="18px"
								class="q-mr-xs"
								style="vertical-align: middle; color: #388e3c"
							/>
							<span class="q-ml-xs text-caption">{{ donor.phone }}</span>
						</span>
					</div>
				</div>
				<div class="row items-center q-gutter-x-sm">
					<q-chip
						:color="donor.is_available ? 'green-1' : 'grey-3'"
						:text-color="donor.is_available ? 'green-8' : 'grey-7'"
						size="sm"
						class="q-mt-sm"
						square
					>
						{{ donor.is_available ? 'Available' : 'Unavailable' }}
					</q-chip>
				</div>
			</div>
		</q-item-section>
		<q-item-section side>
			<q-btn flat round dense aria-label="View Details" text-color="red-4" size="xs">
				<Icon name="mdi:information-outline" size="22px" />
				<q-tooltip> View Details </q-tooltip>
			</q-btn>
		</q-item-section>
	</q-item>
</template>
