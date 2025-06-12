<script setup lang="ts">
import { ref } from 'vue'

type Donor = {
  id: number
  name: string
  email: string
  blood_group: string
  is_active: boolean
}

const rows = ref<Donor[]>([])
const loading = ref(false)
const pagination = ref({
  page: 1,
  rowsPerPage: 10,
  rowsNumber: 0,
  sortBy: 'id',
  descending: false
})
const search = ref('')

const columns = [
  { name: 'id', label: 'ID', field: 'id', align: 'left' as const, sortable: true },
  { name: 'name', label: 'Name', field: 'name', align: 'left' as const, sortable: true },
  { name: 'email', label: 'Email', field: 'email', align: 'left' as const, sortable: true },
  { name: 'blood_group', label: 'Blood Group', field: 'blood_group', align: 'left' as const, sortable: true },
  { name: 'is_active', label: 'Status', field: 'is_active', align: 'left' as const, sortable: true },
  { name: 'action', label: 'Action', field: 'action', align: 'center' as const }
]

function fetchDonors(params: any = {}) {
  // TODO: Replace with real API call or remove if handled elsewhere
  rows.value = []
  pagination.value.rowsNumber = 0
  loading.value = false
}

function onRequest(props: any) {
  const { page, rowsPerPage, sortBy, descending } = props.pagination
  fetchDonors({
    page,
    rowsPerPage,
    sortBy,
    descending,
    search: search.value
  })
  pagination.value = { ...pagination.value, ...props.pagination }
}

function onSearch() {

}

function toggleStatus(row: Donor) {

}

// Initial fetch
fetchDonors(pagination.value)
</script>

<template>
  <div class="q-pa-lg">
    <div class="row justify-center">
      <div class="col-md-6 col-12">
         <div class="row items-center q-mb-md">
      <div class="col text-subtitle1 text-grey-10 text-weight-bold">Manage Donors</div>
      <div class="col-auto">
        <q-input
          v-model="search"
          dense
          outlined
          color="red-5"
          bg-color="white"
          placeholder="Type Email..."
          class="q-ml-md custom-search-input"
          hide-bottom-space
          @keyup.enter="onSearch"
          type="search"
        >
          <template #prepend>
            <Icon name="mdi:magnify" class="text-red-5"  />
          </template>
        </q-input>
      </div>
    </div>
    <q-table
      :rows="rows"
      :columns="columns"
      row-key="id"
      flat
      bordered
      :rows-per-page-options="[10, 20, 50]"
      color="red-5"
      :loading="loading"
      :pagination="pagination"
      @request="onRequest"
    >
      <template #body-cell-blood_group="props">
        <q-td :props="props">
          <q-chip color="red-1" text-color="red-8" size="sm" square>{{ props.row.blood_group }}</q-chip>
        </q-td>
      </template>
      <template #body-cell-is_active="props">
        <q-td :props="props">
          <q-chip :color="props.row.is_active ? 'green-1' : 'red-1'" :text-color="props.row.is_active ? 'green-8' : 'red-8'" size="sm" square>
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
            <Icon :name="props.row.is_active ? 'mdi:block' : 'mdi:check-circle'" size="18px"  />
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

<style scoped lang="css">
:deep(.custom-search-input .q-field__control),
:deep(.custom-search-input .q-field__native),
:deep(.custom-search-input .q-field__marginal) {
  min-height: 28px !important;
  height: 28px !important;
  line-height: 1.1 !important;
  font-size: 14px;
  padding-top: 0 !important;
  padding-bottom: 0 !important;
}
</style>