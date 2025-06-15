// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
	compatibilityDate: '2025-05-15',
	devtools: { enabled: false },

	modules: [
		'@nuxt/eslint',
		// '@nuxt/fonts',
		'@nuxt/scripts',
		'@nuxt/test-utils',
		'@nuxt/icon',
		'@pinia/nuxt',
		'pinia-plugin-persistedstate/nuxt',
		'nuxt-quasar-ui'
	],
	quasar: {
		plugins: ['Dialog', 'Loading', 'LoadingBar', 'Notify', 'Dark'],
		extras: {
			font: 'roboto-font'
		},
		config: {
			notify: {
				timeout: 2000,
				progress: true,
				actions: [
					{
						icon: 'close',
						color: 'white',
						round: true,
						flat: true,
						size: 'sm'
					}
				]
			}
		}
	},

	pinia: {
		storesDirs: ['stores/**']
	},

	imports: {
		dirs: ['composables', 'utils', 'types', 'services']
	},

	plugins: []
})
