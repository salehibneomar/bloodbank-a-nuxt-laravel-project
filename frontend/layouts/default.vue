<script setup lang="ts">
	// No import needed for profileLinks due to Nuxt auto-imports
	function logout() {
		// TODO: Implement logout logic
	}
</script>

<template>
	<q-layout view="Hhh lpr Fff">
		<q-header class="bg-red-2 text-dark">
			<q-toolbar class="q-pl-lg q-py-md" style="border-bottom: 1px solid #ffcccc">
				<NuxtLink to="/" style="text-decoration: none">
					<q-toolbar-title class="text-h5 text-weight-bold flex items-center cursor-pointer">
						<Icon name="mdi:blood-bag" class="q-mr-sm text-red-5" size="28px" />
						<span class="text-grey-10 q-pt-xs">BloodBank</span>
					</q-toolbar-title>
				</NuxtLink>
				<q-space />
				<q-btn round flat size="sm" class="q-mx-sm">
					<q-avatar size="36px">
						<img src="https://cdn.quasar.dev/img/avatar.png" alt="User Avatar" />
					</q-avatar>
					<q-menu anchor="bottom right" self="top right" dense>
						<q-list style="min-width: 140px" dense>
							<template v-for="(link, index) in profileLinks" :key="index">
								<q-item class="text-grey-8" :to="link?.route" clickable v-close-popup dense>
									<q-item-section avatar>
										<q-icon :name="link?.icon" />
									</q-item-section>
									<q-item-section style="margin-left: -20px">{{ link?.label }}</q-item-section>
								</q-item>
							</template>
							<q-separator />
							<q-item class="text-grey-8" clickable v-close-popup @click="logout" dense>
								<q-item-section avatar>
									<q-icon name="logout" />
								</q-item-section>
								<q-item-section style="margin-left: -20px">Logout</q-item-section>
							</q-item>
						</q-list>
					</q-menu>
				</q-btn>
			</q-toolbar>
		</q-header>

		<q-page-container>
			<slot />
		</q-page-container>

		<q-footer class="text-center bg-grey-2 q-pa-md shadow-1" style="border-top: 1px solid #f5f5f5">
			<span class="text-grey-7">© {{ new Date().getFullYear() }} BloodBank</span>
		</q-footer>
	</q-layout>
</template>
