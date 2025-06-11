<script setup lang="ts">
definePageMeta({
  name: 'auth-login',
  title: 'Login',
  requireAuth: false,
})

useHead({
  title: 'Login | BloodBank',
});

const authFormData: AuthLogin = {
  email: '',
  password: '',
}

const emailRule = (val: string): boolean | string => {
  if (!val) return 'Email is required'
  return isValidEmail(val) || 'Valid email required'
}

function onSubmit() {
  // TODO: Implement login logic
}
</script>

<template>
  <div class="q-pa-xl flex flex-center" style="min-height: 80vh">
    <q-card
      class="q-pa-xl"
      flat
      bordered
      style="width: 100%; max-width: 400px; background: #fff5f5"
    >
      <div class="text-center q-mb-lg">
        <Icon name="mdi:blood-bag" class="text-red-5" size="40px" />
        <div class="text-h5 text-weight-bold text-grey-10 q-mt-sm">
          BloodBank
        </div>
      </div>
      <q-form @submit.prevent="onSubmit">
        <q-input
          v-model="authFormData.email"
          type="email"
          label="Email"
          outlined
          dense
          color="red-5"
          :rules="[emailRule]"
          bg-color="white"
        >
          <template #prepend>
            <Icon name="mdi:email-outline" class="text-red-5" size="18px" />
          </template>
        </q-input>
        <q-input
          v-model="authFormData.password"
          type="password"
          label="Password"
          outlined
          dense
          color="red-5"
          :rules="[(val) => !!val || 'Password is required']"
          bg-color="white"
        >
          <template #prepend>
            <Icon name="mdi:lock-outline" class="text-red-5" size="18px" />
          </template>
        </q-input>
        <q-btn
          type="submit"
          color="red-5"
          class="full-width q-mt-md"
          label="Login"
          unelevated
          no-caps
        />
      </q-form>
      <div class="text-center q-mt-md">
        <span class="text-grey-7">Don't have an account?</span>
        <NuxtLink
          to="/auth/donor/register"
          class="text-red-5 text-weight-bold q-ml-xs"
          >Register</NuxtLink
        >
      </div>
    </q-card>
  </div>
</template>
