<template>
<q-layout view='hHh Lpr lFf'>
  <q-header  class='bg-red-2 text-dark'>
    <q-toolbar class='q-pl-lg q-py-md' style='border-bottom: 1px solid #ffcccc;'>
        <NuxtLink to='/' style='text-decoration: none;'>
        <q-toolbar-title class='text-h5 text-weight-bold flex items-center cursor-pointer'>
            <Icon name='mdi:blood-bag' class='q-mr-sm text-red-5' size='28px' />
            <span class='text-grey-10  q-pt-xs'>BloodBank</span>
        </q-toolbar-title>
        </NuxtLink>
      <q-space />
     <NuxtLink
        to='/auth/login'
        class='q-mx-sm'
      >
        <q-btn flat label='Login' no-caps unelevated class='full-width' :class="$route.path === '/auth/login' ? 'text-red-7' : 'text-grey-10'" />
      </NuxtLink>
      <q-separator vertical inset class='q-mx-xs bg-red-3 opacity-50' />
      <NuxtLink
        to='/auth/donor/register'
        class='q-mx-sm'
      >
        <q-btn flat label='Register' no-caps unelevated class='full-width' :class="$route.path === '/auth/donor/register' ? 'text-red-7' : 'text-grey-10'" />
      </NuxtLink>
    </q-toolbar>
  </q-header>

  <q-page-container>
    <slot />
  </q-page-container>

  <q-footer class='text-center bg-grey-2 q-pa-md shadow-1' style='border-top: 1px solid #f5f5f5;'>
    <span class='text-grey-7'>© {{ new Date().getFullYear() }} BloodBank</span>
  </q-footer>
</q-layout>
</template>
