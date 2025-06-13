<script setup lang="ts">
	import { onMounted } from 'vue'

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
	const { pending } = await useLocalAsyncData('donor-list', () =>
		donorStore.getAll({} as QueryObject)
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
				<DonorList :donors="donorStore.donors" />
			</div>
		</div>
	</div>
</template>
