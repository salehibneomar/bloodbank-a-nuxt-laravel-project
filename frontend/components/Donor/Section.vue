<script setup lang="ts">
	const DonorDetails = defineAsyncComponent(() => import('~/components/Donor/Details.vue'))
	const router = useRouter()
	const donorStore = useDonorStore()
	interface Props {
		donors: Donor[]
		selectedBloodGroup?: BloodGroup | null
		initialPagingData?: PagingData | null
	}

	const props = withDefaults(defineProps<Props>(), {
		selectedBloodGroup: null,
		initialPagingData: null
	})

	onMounted(() => {
		if (props.initialPagingData) {
			syncPagingData(props.initialPagingData)
		}
	})

	const pagingData = ref<PagingData>({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 20,
		from: 0
	})
	const isLoading = ref(false)
	const openDonorDetails = ref(false)
	const donorDetailsLoading = ref(false)

	const syncPagingData = (response: PagingData | null) => {
		if (!response) return
		const { current_page, per_page, last_page, from, to, total } = response
		pagingData.value = { ...pagingData.value, current_page, per_page, last_page, from, to, total }
	}
	const onPageChange = async (page: number) => {
		isLoading.value = true
		pagingData.value = {
			...pagingData.value,
			current_page: page
		}

		const query: QueryObject = { page, ...pagingData.value }
		if (props.selectedBloodGroup?.value) {
			query.blood_group = props.selectedBloodGroup.value
		}

		const { data: response } = await donorStore.getAll(query)
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
		} else {
			await router.push('/')
		}
	}
</script>

<template>
	<div class="col-md-6 col-12">
		<div v-if="donors.length" class="row justify-between items-center q-mb-md">
			<div class="col-auto">
				<q-chip color="red-2" text-color="red-8" size="md" class="text-weight-bold" square>
					<Icon name="mdi:account-group" class="q-mr-xs" size="16px" />
					Total: {{ pagingData.total || 0 }}
				</q-chip>
			</div>
			<div class="col-auto">
				<q-select
					:model-value="selectedBloodGroup"
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
			:donors="donors"
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
</template>
