<script setup lang="ts">
	definePageMeta({
		name: 'donor-manage',
		title: 'Manage Donors',
		requireAuth: true,
		layout: 'default'
	})
	useHead({
		title: 'Manage Donors - BloodBank'
	})

	const adminStore = useAdminStore()

	const pagingData = ref<PagingData>({
		current_page: 1,
		last_page: 1,
		total: 0,
		to: 0,
		per_page: 10,
		from: 0
	})

	const isLoading = ref(true)
	const search = ref('')

	const columns = ref([
		{ name: 'id', label: 'ID', field: 'id', align: 'left' as const },
		{ name: 'name', label: 'Name', field: 'name', align: 'left' as const },
		{ name: 'email', label: 'Email', field: 'email', align: 'left' as const },
		{
			name: 'blood_group',
			label: 'Blood Group',
			field: 'blood_group',
			align: 'left' as const
		},
		{
			name: 'is_active',
			label: 'Status',
			field: 'is_active',
			align: 'left' as const
		},
		{ name: 'action', label: 'Action', field: 'action', align: 'center' as const }
	])

	onMounted(async () => {
		await getAllDonors()
		isLoading.value = false
	})

	const syncPagingData = (response: PagingData | null) => {
		if (!response) return
		const { current_page, per_page, last_page, from, to, total } = response
		pagingData.value = { ...pagingData.value, current_page, per_page, last_page, from, to, total }
	}

	const getAllDonors = async (query = {} as QueryObject) => {
		isLoading.value = true
		const response = await adminStore.getAllDonors({
			...pagingData.value,
			...query,
			email: search.value
		})
		syncPagingData(response)
		isLoading.value = false
	}

	const onRequest = async (props: any) => {
		const { page, rowsPerPage } = props.pagination
		const query = { per_page: rowsPerPage, page }
		await getAllDonors(query)
	}

	const emailSearch = async () => {
		const response = await getAllDonors({ email: search.value })
		return response
	}

	const toggleStatus = (row: any) => {
		// TODO: Implement status toggle functionality
	}
</script>

<template>
	<div class="q-pa-lg">
		<LoadingState v-if="isLoading" />
		<div v-else class="row justify-center">
			<div class="col-md-8 col-12">
				<div class="row items-center q-mb-md">
					<div class="col text-subtitle1 text-grey-10 text-weight-bold">Manage Donors</div>
					<div class="col-auto">
						<q-input
							v-model.trim="search"
							class="q-ml-md"
							dense
							outlined
							color="red-5"
							bg-color="white"
							placeholder="Type Email..."
							hide-bottom-space
							debounce="500"
							clearable
							@update:model-value="emailSearch"
						>
							<template #prepend>
								<Icon name="mdi:magnify" class="text-red-5" />
							</template>
						</q-input>
					</div>
				</div>
				<q-table
					:rows="adminStore.donors"
					:columns="columns"
					row-key="id"
					flat
					bordered
					:rows-per-page-options="[10, 20, 50]"
					color="red-5"
					:loading="isLoading"
					server-side
					:pagination="{
						page: +pagingData.current_page,
						rowsPerPage: +pagingData.per_page,
						rowsNumber: +pagingData.total
					}"
					@request="onRequest"
				>
					<template #body-cell-blood_group="props">
						<q-td :props="props">
							<q-chip color="red-1" text-color="red-8" size="sm" square>{{
								props.row.blood_group
							}}</q-chip>
						</q-td>
					</template>
					<template #body-cell-is_active="props">
						<q-td :props="props">
							<q-chip
								:color="props.row.is_active ? 'green-1' : 'red-1'"
								:text-color="props.row.is_active ? 'green-8' : 'red-8'"
								size="sm"
								square
							>
								{{ props.row.is_active ? 'Active' : 'Blocked' }}
							</q-chip>
						</q-td>
					</template>
					<template #body-cell-action="props">
						<q-td :props="props">
							<q-btn
								:color="props.row.is_active ? 'red-5' : 'green-5'"
								size="sm"
								unelevated
								no-caps
								@click="toggleStatus(props.row)"
								round
								dense
							>
								<Icon :name="props.row.is_active ? 'mdi:block' : 'mdi:check-circle'" size="18px" />
							</q-btn>
						</q-td>
					</template>
					<template #no-data>
						<div class="text-center text-grey-6 q-pa-lg">No donors found.</div>
					</template>
				</q-table>
			</div>
		</div>
	</div>
</template>
