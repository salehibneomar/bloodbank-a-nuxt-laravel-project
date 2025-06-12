<script setup lang="ts">
import { onMounted } from 'vue'

definePageMeta({
  name: 'landing-page',
  title: 'Landing Page',
  requireAuth: false,
  layout: 'global'
})

useHead({
  title: 'Welcome to BloodBank',
})

const donors = [
  {
    id: 1,
    name: 'Amit Sharma',
    email: 'amit@example.com',
    available: true,
    blood_group: 'A+',
    phone: '9876543210',
    blocked: false
  },
  {
    id: 2,
    name: 'Priya Singh',
    email: 'priya@example.com',
    available: false,
    blood_group: 'O-',
    phone: null,
    blocked: true
  },
  {
    id: 3,
    name: 'Rahul Verma',
    email: 'rahul@example.com',
    available: true,
    blood_group: 'B+',
    phone: '9123456789',
    blocked: false
  }
]

import DonorList from '~/components/Donor/List.vue'
const { $httpClient } = useNuxtApp()
onMounted(async () => {
  try {
    const { data } = await $httpClient.get('donors')
    console.log('Donors API response:', data)
  } catch (err) {
    console.error('Error fetching donors:', err)
  }
})
</script>

<template>
  <div class="q-pa-lg">
    <div class="row justify-center">
      <div class="col-md-6 col-12">
        <DonorList :donors="donors" />
      </div>
    </div>
  </div>
</template>
