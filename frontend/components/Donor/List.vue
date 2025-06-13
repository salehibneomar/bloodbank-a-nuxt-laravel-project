<script setup lang="ts">
	interface Props {
		donors: Donor[]
		currentPage?: number
		totalPages?: number
	}

	const { donors, currentPage = 1, totalPages = 1 } = defineProps<Props>()

	// Emit page change to parent
	const emit = defineEmits<{
		'page-change': [page: number]
	}>()

	const onPageChange = (page: number) => {
		emit('page-change', page)
	}
</script>

<template>
	<div>
		<!-- Donor List -->
		<q-list class="bg-white rounded-borders" separator bordered>
			<DonorListItem v-for="donor in donors" :key="donor.id" :donor="donor" />
			<div v-if="!donors.length" class="text-center text-grey-6 q-pa-lg text-caption">
				No donors found.
			</div>
		</q-list>

		<!-- Pagination -->
		<div v-if="totalPages > 1" class="flex justify-center q-mt-md">
			<q-pagination
				:model-value="currentPage"
				:max="totalPages"
				:max-pages="6"
				direction-links
				boundary-links
				color="red-5"
				active-design="unelevated"
				active-color="red-5"
				active-text-color="white"
				@update:model-value="onPageChange"
			/>
		</div>
	</div>
</template>
