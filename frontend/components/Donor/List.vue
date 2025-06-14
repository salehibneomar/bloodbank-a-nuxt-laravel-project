<script setup lang="ts">
	interface Props {
		donors: Donor[]
		pagingData: PagingData
	}

	const { donors, pagingData } = defineProps<Props>()

	const emit = defineEmits(['page-change', 'view-details'])

	const onPageChange = (page: number) => {
		emit('page-change', page)
	}
</script>

<template>
	<div>
		<q-list class="bg-white rounded-borders" separator bordered>
			<template v-if="donors.length">
				<DonorListItem
					v-for="donor in donors"
					:key="donor.id"
					:donor="donor"
					@view-details="
						(event) => {
							emit('view-details', event)
						}
					"
				/>
			</template>
			<div v-else class="text-center text-grey-6 q-pa-lg text-caption">No donors found.</div>
		</q-list>

		<div v-if="+pagingData.last_page > 1" class="flex justify-center q-mt-md">
			<q-pagination
				v-model="pagingData.current_page as number"
				:max="pagingData.last_page"
				:max-pages="5"
				direction-links
				color="red-5"
				active-design="unelevated"
				active-color="red-2"
				active-text-color="red-6"
				@update:model-value="onPageChange"
			/>
		</div>
	</div>
</template>
