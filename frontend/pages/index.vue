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
	const { current_page, per_page, last_page, from, to, total } = response.value
</script>

<template>
	<q-page padding>
		<LoadingState v-if="pending" />
		<div v-else class="row justify-center">
			<DonorPageContent
				:donors="donorStore.donors"
				:selectedBloodGroup="null"
				:initialPagingData="{ current_page, per_page, last_page, from, to, total }"
			/>
		</div>
	</q-page>
</template>
