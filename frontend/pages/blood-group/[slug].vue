<script setup lang="ts">
	const DonorPageContent = defineAsyncComponent(() => import('~/components/Donor/PageContent.vue'))

	const route = useRoute()
	const donorStore = useDonorStore()
	const bloodGroupSlug = route.params?.slug as string
	const bloodGroupInfo = bloodGroups.find((bg) => bg.value === bloodGroupSlug)

	if (!bloodGroupInfo) {
		throw createError({
			statusCode: 404,
			statusMessage: 'Blood group not found'
		})
	}

	definePageMeta({
		name: 'blood-group-view',
		title: 'Blood Group View',
		requireAuth: false
	})

	useHead({
		title: `${bloodGroupInfo.label} Donors - BloodBank`
	})

	const { data: response, pending } = await useAsyncData(`donor-list-${bloodGroupSlug}`, () =>
		donorStore.getAll({ blood_group: bloodGroupSlug })
	)
	const { current_page, per_page, last_page, from, to, total } = response.value
</script>

<template>
	<q-page padding>
		<LoadingState v-if="pending" />
		<div v-else class="row justify-center">
			<DonorPageContent
				:donors="donorStore.donors"
				:selectedBloodGroup="bloodGroupInfo"
				:initial-paging-data="{ current_page, per_page, last_page, from, to, total }"
			/>
		</div>
	</q-page>
</template>
