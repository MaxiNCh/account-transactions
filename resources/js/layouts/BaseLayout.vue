<template>
  <BaseHeader />
  <slot />
  <BaseFooter />
</template>

<script setup>
import BaseHeader from '@/components/BaseHeader.vue';
import BaseFooter from '@/components/BaseFooter.vue';
</script>

<style lang="scss" scoped></style>
