<script setup lang="ts">
	const DonorDetails = defineAsyncComponent(() => import('~/components/Donor/Details.vue'))

	definePageMeta({
		name: 'landing-page',
		title: 'Landing Page',
		requireAuth: false,
		layout: 'global'
	})
	useHead({
		title: 'Welcome to BloodBank'
	})

	const router = useRouter()
	const donorStore = useDonorStore()

	const pagingData = ref<PagingData>({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 20,
		from: 0
	})
	const isLoading = ref(true)
	const selectedBloodGroup = ref(null)
	const openDonorDetails = ref(false)
	const donorDetailsLoading = ref(false)

	onMounted(() => {
		isLoading.value = false
	})

	const syncPagingData = (response: PagingData | null) => {
		if (!response) return
		const { current_page, per_page, last_page, from, to, total } = response
		pagingData.value = { ...pagingData.value, current_page, per_page, last_page, from, to, total }
	}
	const { data: response } = await useAsyncData('donor-list', () =>
		donorStore.getAll(pagingData.value)
	)
	syncPagingData(response.value)

	const onPageChange = async (page: number) => {
		isLoading.value = true
		pagingData.value = {
			...pagingData.value,
			current_page: page
		}
		const { data: response } = await useAsyncData(`donor-list-${page}`, () =>
			donorStore.getAll({ page, ...pagingData.value })
		)
		syncPagingData(response.value)
		isLoading.value = false
	}

	const onViewDonorDetails = async (id: number | string) => {
		openDonorDetails.value = true
		donorDetailsLoading.value = true
		await donorStore.getById(id)
		donorDetailsLoading.value = false
	}

	const onSelectBloodGroup = async (bloodGroup: BloodGroup) => {
		if (bloodGroup?.value) {
			await router.push(`/blood-group/${bloodGroup.value}`)
		}
	}
</script>

<template>
	<q-page padding>
		<LoadingState v-if="isLoading" />
		<div v-else class="row justify-center">
			<div class="col-md-6 col-12">
				<div v-if="donorStore.donors.length" class="row justify-between items-center q-mb-md">
					<div class="col-auto">
						<q-chip color="red-2" text-color="red-8" size="md" class="text-weight-bold" square>
							<Icon name="mdi:account-group" class="q-mr-xs" size="16px" />
							Total: {{ pagingData.total || 0 }}
						</q-chip>
					</div>
					<div class="col-auto">
						<q-select
							v-model="selectedBloodGroup"
							:options="bloodGroups"
							label="Blood Group"
							outlined
							dense
							color="red-5"
							bg-color="white"
							clearable
							emit-object
							behavior="menu"
							style="min-width: 200px"
							options-dense
							@update:model-value="onSelectBloodGroup"
						>
							<template #prepend>
								<Icon name="mdi:water-outline" class="text-red-5" size="18px" />
							</template>
						</q-select>
					</div>
				</div>

				<DonorList
					:donors="donorStore.donors"
					:pagingData="pagingData"
					@page-change="onPageChange"
					@view-details="onViewDonorDetails"
				/>
				<DonorDetails
					v-if="openDonorDetails"
					v-model="openDonorDetails"
					:donor="donorStore.donor as Donor"
					:loading="donorDetailsLoading"
				/>
			</div>
		</div>
	</q-page>
</template>
