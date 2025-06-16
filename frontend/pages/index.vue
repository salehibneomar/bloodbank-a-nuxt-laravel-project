<script setup lang="ts">
	definePageMeta({
		name: 'landing-page',
		title: 'Landing Page',
		requireAuth: false
	})
	useHead({
		title: 'Welcome to BloodBank'
	})

	const donorStore = useDonorStore()
	const isLoading = ref(true)

	onMounted(() => {
		isLoading.value = false
	})

	const { data: response } = await useAsyncData('donor-list', () => donorStore.getAll())
	const { current_page, per_page, last_page, from, to, total } = response.value
</script>

<template>
	<q-page padding>
		<LoadingState v-if="isLoading" />
		<div v-else class="row justify-center">
			<DonorSection
				:donors="donorStore.donors"
				:selectedBloodGroup="null"
				:initialPagingData="{ current_page, per_page, last_page, from, to, total }"
			/>
		</div>
	</q-page>
</template>
