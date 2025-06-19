<script setup lang="ts">
	const DonorPageContent = defineAsyncComponent(() => import('~/components/Donor/PageContent.vue'))

	definePageMeta({
		name: 'landing-page',
		title: 'Landing Page',
		requireAuth: false
	})
	useHead({
		title: 'Welcome to BloodBank'
	})

	const donorStore = useDonorStore()

	const { data: response, pending } = await useAsyncData('donor-list', () => donorStore.getAll())
	const initialPagingData = ref({
		current_page: 1,
		per_page: 10,
		last_page: 1,
		from: 1,
		to: 10,
		total: 0
	})
	if (response.value) {
		const { current_page, per_page, last_page, from, to, total } = response.value
		initialPagingData.value = { current_page, per_page, last_page, from, to, total }
	}
</script>

<template>
	<q-page padding>
		<LoadingState v-if="pending" />
		<div v-else class="row justify-center">
			<DonorPageContent
				:donors="donorStore.donors"
				:selectedBloodGroup="null"
				:initialPagingData="initialPagingData"
			/>
		</div>
	</q-page>
</template>
