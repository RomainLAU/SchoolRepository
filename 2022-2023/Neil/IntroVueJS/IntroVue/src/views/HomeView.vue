<!-- eslint-disable @typescript-eslint/no-unused-vars -->
<script setup lang="ts">
import ToggleInput from "../components/ToggleInput.vue";
import { ref } from "vue";

const isActive = ref(false);
</script>

<template>
  <ToggleInput v-model="isActive" />
  <!-- <p>{{ isActive }}</p> -->
</template>
