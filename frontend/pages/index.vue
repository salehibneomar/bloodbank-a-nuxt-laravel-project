<script setup lang="ts">
// Example donors data, replace with API call or props as needed
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
</script>

<template>
  <div class="q-pa-lg">
    <div class="row justify-center">
      <div class="col-lg-4 col-md-6 col-12">
        <q-list class="bg-white rounded-borders" separator bordered>
      <q-item
        v-for="donor in donors"
        :key="donor.id"
        clickable
      >
        <!-- Blood Group Badge -->
        <div
          class="flex flex-center q-mr-sm"
          style="min-width: 64px; min-height: 64px;"
        >
          <div
            class="bg-red-1 text-red-5 text-h6 text-weight-bold flex flex-center"
            style="width: 48px; height: 48px; border-radius: 12px;"
          >
            {{ donor.blood_group }}
          </div>
        </div>
        <!-- Donor Info -->
        <q-item-section>
          <div class="text-subtitle1 text-grey-10 text-weight-bold">
            {{ donor.name }}
          </div>
          <div class="column">
            <div class="row items-center">
              <div class="col-12 col-sm-auto flex items-center">
                <span class="text-grey-8 flex items-center">
                  <Icon name="mdi:email-outline" size="18px" class="q-mr-xs" style="vertical-align: middle; color: #1976d2;" />
                  <span class="q-ml-xs text-caption">{{ donor.email }}</span>
                </span>
              </div>
              <div v-if="donor.phone" class="col-12 col-sm-auto flex items-center">
                <span class="text-grey-8 flex items-center q-ml-md q-ml-sm-none">
                  <Icon name="mdi:phone-outline" size="18px" class="q-mr-xs"  style="vertical-align: middle; color: #388e3c;" />
                  <span class="q-ml-xs text-caption">{{ donor.phone }}</span>
                </span>
              </div>
            </div>
            <div class="row items-center q-gutter-x-sm">
              <q-chip
                :color="donor.available ? 'green-1' : 'grey-3'"
                :text-color="donor.available ? 'green-8' : 'grey-7'"
                size="sm"
                class="q-ml-none q-mt-sm"
                square
              >
                {{ donor.available ? 'Available' : 'Unavailable' }}
              </q-chip>
              <q-chip
                :color="donor.blocked ? 'red-1' : 'blue-1'"
                :text-color="donor.blocked ? 'red-8' : 'blue-8'"
                size="sm"
                class="q-ml-xs q-mt-sm"
                square
              >
                {{ donor.blocked ? 'Blocked' : 'Active' }}
              </q-chip>
            </div>
          </div>
        </q-item-section>
        <q-item-section side>
          <q-btn flat round dense aria-label="Block Donor" color="red-5" size="xs">
            <q-icon :name="donor.blocked ? 'check_circle' : 'block'" size="22px" />
            <q-tooltip>
              {{ donor.blocked ? 'Unblock Donor' : 'Block Donor' }}
            </q-tooltip>
          </q-btn>
        </q-item-section>
      </q-item>
      <div v-if="!donors.length" class="text-center text-grey-6 q-pa-lg">
        No donors found.
      </div>
    </q-list>
      </div>
    </div>
  </div>
</template>
