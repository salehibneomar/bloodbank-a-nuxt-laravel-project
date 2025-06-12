<template>
  <q-list class="bg-white rounded-borders" separator bordered>
    <DonorListItem v-for="donor in donors" :key="donor.id" :donor="donor" />
    <div v-if="!donors.length" class="text-center text-grey-6 q-pa-lg">
      No donors found.
    </div>
  </q-list>
</template>

<script setup lang="ts">
defineProps<{ donors: Array<any> }>()
</script>
