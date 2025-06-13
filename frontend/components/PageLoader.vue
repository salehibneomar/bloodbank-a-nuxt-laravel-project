<template>
	<div class="loading-container">
		<div class="loading-content">
			<div class="q-mb-none">
				<Icon name="mdi:blood-bag" class="text-red-5" size="40px" />
			</div>
			<q-spinner-dots color="red-5" size="3em" />
			<div class="text-subtitle2 text-red-5 q-mt-none">Loading</div>
		</div>
	</div>
</template>

<style scoped>
	.loading-container {
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 60vh;
	}

	.loading-content {
		text-align: center;
	}
</style>
