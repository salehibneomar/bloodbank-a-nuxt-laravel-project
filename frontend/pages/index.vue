<script setup lang="ts">
	definePageMeta({
		name: 'landing-page',
		title: 'Landing Page',
		requireAuth: false,
		layout: 'global'
	})
	useHead({
		title: 'Welcome to BloodBank'
	})
	const donorStore = useDonorStore()

	const pagingInformation = {
		per_page: 20,
		current_page: 1,
		total: 10
	}
	const { pending } = await useLocalAsyncData('donor-list', () =>
		donorStore.getAll(pagingInformation)
	)
</script>

<template>
	<div class="q-pa-lg">
		<!-- Loading Screen -->
		<PageLoader
			v-if="pending"
			title="Loading donors..."
			subtitle="Please wait while we fetch the data"
		/>

		<!-- Content -->
		<div v-else class="row justify-center">
			<div class="col-md-6 col-12">
				<DonorList
					:donors="donorStore.donors"
					:current-page="pagingInformation.current_page"
					:total-pages="pagingInformation.total"
				/>
			</div>
		</div>
	</div>
</template>
