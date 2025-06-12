<script setup lang="ts">
import { ref } from 'vue'

const form = ref({
  name: '',
  email: '',
  phone: '',
  address: '',
  blood_group: '',
  is_available: false,
  last_donation_date: '',
  profession: '',
  religion: '',
  age: '',
  medical_conditions: ''
})

const bloodGroupOptions = bloodGroups
const showDatePicker = ref(false)

const emailRule = (val: string): boolean | string => {
  if (!val) return 'Email is required'
  return isValidEmail(val) || 'Valid email required'
}

function saveProfile() {
  // TODO: Implement save logic (API call or store update)
}
</script>

<template lang="">
  <div class="row justify-center">
    <div class="col-md-7 col-sm-10 col-12">
      <q-card class="q-pa-xl bg-white rounded-borders" flat>
        <div class="text-h5 text-weight-bold text-grey-10 q-mb-md text-center">
          Profile
        </div>
        <q-form @submit.prevent="saveProfile">
          <div class="row q-col-gutter-md q-gutter-y-none">
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.name" label="Name" outlined dense color="red-5" bg-color="white" :rules="[val => !!val || 'Name is required']" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.email" label="Email" type="email" outlined dense color="red-5" bg-color="white" :rules="[emailRule]" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.phone" label="Phone" type="tel" outlined dense color="red-5" bg-color="white" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.address" label="Address" outlined dense color="red-5" bg-color="white" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-select
                v-model="form.blood_group"
                :options="bloodGroupOptions"
                label="Blood Group"
                outlined
                dense
                color="red-5"
                bg-color="white"
                emit-value
                option-value="value"
                option-label="label"
                :rules="[val => !!val || 'Blood group is required']"
                hide-bottom-space
              />
            </div>
            <div class="col-12 col-md-6 flex items-center q-mb-xs">
              <q-toggle v-model="form.is_available" label="Available for Donation" color="red-6" />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <div @click="showDatePicker = true" style="width: 100%">
                <q-input
                  v-model="form.last_donation_date"
                  label="Last Donation Date"
                  outlined
                  dense
                  color="red-5"
                  bg-color="white"
                  readonly
                  :rules="[]"
                  class="cursor-pointer"
                >
                  <template #append>
                    <q-icon name="event" />
                  </template>
                </q-input>
              </div>
              <q-dialog v-model="showDatePicker">
                <q-date
                  v-model="form.last_donation_date"
                  mask="YYYY-MM-DD"
                  color="red-5"
                  @update:model-value="showDatePicker = false"
                />
              </q-dialog>
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.profession" label="Profession" outlined dense color="red-5" bg-color="white" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.religion" label="Religion" outlined dense color="red-5" bg-color="white" hide-bottom-space />
            </div>
            <div class="col-12 col-md-6 q-mb-xs">
              <q-input v-model="form.age" label="Age" type="number" min="0" outlined dense color="red-5" bg-color="white" hide-bottom-space />
            </div>
            <div class="col-12 q-mb-xs">
              <q-input v-model="form.medical_conditions" label="Medical Conditions" outlined dense color="red-5" bg-color="white" type="textarea" autogrow hide-bottom-space />
            </div>
          </div>
          <div class="row justify-center q-mt-md">
            <q-btn type="submit" color="red-5" label="Save" unelevated no-caps class="q-px-xl" />
          </div>
        </q-form>
      </q-card>
    </div>
  </div>
</template>

<style scoped>
.rounded-borders {
  border-radius: 16px;
}
</style>