<script setup lang="ts">
	definePageMeta({
		name: 'auth-donor-register',
		title: 'Donor Registration',
		requireAuth: false,
		middleware: 'guest'
	})

	useHead({
		title: 'Donor - Registration | BloodBank'
	})

	const router = useRouter()
	const authStore = useAuthStore()

	const registerFormData = ref<AuthDonor>({
		name: '',
		email: '',
		blood_group: '',
		password: '',
		password_confirmation: ''
	})
	const bloodGroupOptions = bloodGroups

	const nameRule = (val: string): boolean | string => {
		if (!val) return 'Full Name is required'
		if (val.length < 3) return 'Full Name must be at least 3 characters'
		return true
	}

	const emailRule = (val: string): boolean | string => {
		if (!val) return 'Email is required'
		return isValidEmail(val) || 'Valid email required'
	}

	const passwordRule = (val: string): boolean | string => {
		if (!val) return 'Password is required'
		if (val.length < 6) return 'Password must be at least 6 characters'
		return true
	}

	const passwordConfirmationRule = (val: string): boolean | string => {
		if (!val) return 'Retype your password'
		if (val !== registerFormData.value.password) return 'Passwords do not match'
		return true
	}

	const handleRegister = async () => {
		const response: Donor | null = await authStore.donorRegister(registerFormData.value)
		if (response) {
			await router.push({ path: '/auth/login', query: { registered: response?.email } })
		}
	}
</script>

<template lang="">
	<div class="q-pa-xl flex flex-center" style="min-height: 80vh">
		<q-card
			class="q-pa-xl"
			flat
			bordered
			style="width: 100%; max-width: 400px; background: #fff5f5"
		>
			<div class="text-center q-mb-lg">
				<Icon name="mdi:blood-bag" class="text-red-5" size="40px" />
				<div class="text-h5 text-weight-bold text-grey-10 q-mt-sm">{{ APP_NAME }}</div>
			</div>
			<q-form @submit.prevent="handleRegister">
				<q-input
					v-model.trim="registerFormData.name"
					type="text"
					label="Full Name"
					outlined
					dense
					color="red-5"
					:rules="[nameRule]"
					bg-color="white"
				>
					<template #prepend>
						<Icon name="mdi:account-outline" class="text-red-5" size="18px" />
					</template>
				</q-input>
				<q-input
					v-model.trim="registerFormData.email"
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
				<q-select
					v-model.trim="registerFormData.blood_group"
					:options="bloodGroupOptions"
					label="Blood Group"
					outlined
					dense
					color="red-5"
					bg-color="white"
					:rules="[(val) => !!val || 'Blood Group is required']"
					emit-value
					map-options
					option-value="label"
					option-label="label"
					options-dense
				>
					<template #prepend>
						<Icon name="mdi:water-outline" class="text-red-5" size="18px" />
					</template>
				</q-select>
				<q-input
					v-model.trim="registerFormData.password"
					type="password"
					label="Password"
					outlined
					dense
					color="red-5"
					:rules="[passwordRule]"
					bg-color="white"
				>
					<template #prepend>
						<Icon name="mdi:lock-outline" class="text-red-5" size="18px" />
					</template>
				</q-input>
				<q-input
					v-model.trim="registerFormData.password_confirmation"
					type="password"
					label="Retype Password"
					outlined
					dense
					color="red-5"
					:rules="[passwordConfirmationRule]"
					bg-color="white"
				>
					<template #prepend>
						<Icon name="mdi:lock-reset" class="text-red-5" size="18px" />
					</template>
				</q-input>
				<q-btn
					type="submit"
					color="red-5"
					class="full-width q-mt-md"
					label="Register"
					unelevated
					no-caps
				/>
			</q-form>
			<div class="text-center q-mt-md">
				<span class="text-grey-7">Already have an account?</span>
				<NuxtLink to="/auth/login" class="text-red-5 text-weight-bold q-ml-xs">Login</NuxtLink>
			</div>
		</q-card>
	</div>
</template>

<style lang=""></style>
