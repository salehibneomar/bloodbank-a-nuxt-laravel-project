<script setup lang="ts">
	definePageMeta({
		name: 'auth-donor-register',
		title: 'Donor Registration',
		requireAuth: false,
		layout: 'global'
	})

	useHead({
		title: 'Donor - Registration | BloodBank'
	})

	const registerFormData = ref<AuthDonor>({
		name: '',
		email: '',
		blood_group: '',
		password: '',
		password_confirmation: ''
	})

	const bloodGroupOptions = bloodGroups

	const emailRule = (val: string): boolean | string => {
		if (!val) return 'Email is required'
		return isValidEmail(val) || 'Valid email required'
	}

	function onSubmit() {
		// TODO: Implement registration logic
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
				<div class="text-h5 text-weight-bold text-grey-10 q-mt-sm">BloodBank</div>
			</div>
			<q-form @submit.prevent="onSubmit">
				<q-input
					v-model="registerFormData.name"
					type="text"
					label="Full Name"
					outlined
					dense
					color="red-5"
					:rules="[(val) => !!val || 'Full Name is required']"
					bg-color="white"
				>
					<template #prepend>
						<Icon name="mdi:account-outline" class="text-red-5" size="18px" />
					</template>
				</q-input>
				<q-input
					v-model="registerFormData.email"
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
					v-model="registerFormData.blood_group"
					:options="bloodGroupOptions"
					label="Blood Group"
					outlined
					dense
					color="red-5"
					bg-color="white"
					:rules="[(val) => !!val || 'Blood Group is required']"
					emit-value
					options-dense
				>
					<template #prepend>
						<Icon name="mdi:water-outline" class="text-red-5" size="18px" />
					</template>
				</q-select>
				<q-input
					v-model="registerFormData.password"
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
				<q-input
					v-model="registerFormData.password_confirmation"
					type="password"
					label="Retype Password"
					outlined
					dense
					color="red-5"
					:rules="[(val) => !!val || 'Retype your password']"
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
