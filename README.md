# Hausers

## Setup
1. `composer update`

2. .env.example -> .env

No database setup needed at the moment

3. `yarn` / `npm install` (yarn is faster, recommend v1.22)

4. `yarn dev` / `npm run dev`


Components in js/Components/*.vue are imported automatically (components.js)

PrimeVue components as well but not everything has been added (see prime.js if you need to add/remove something globally)

Starting points:
* resources/js/Pages/Index.vue
* resources/js/Layouts/GuestLayout.vue

CSS overrides:
* presets/lara/{component}/index.js

## Additional info

PrimeVue components

https://tailwind.primevue.org/overview/

PrimeVue main (maybe doesn't have the Tailwind specifics but more about all the components)

https://primevue.org/introduction/


Inertia.js docs

https://inertiajs.com/pages

Laravel route rendering with Inertia (js/Pages/Index.vue):
```php
Route::get('/', function () {
    return Inertia::render('Index');
});
```

https://laravel.com/docs/10.x/


Vue 3 (set API preference to Composition API on the documentation page)

https://vuejs.org/guide/introduction.html


We typically use the Composition API with script setup so there's less boilerplate.
```js
<script setup>
import { ref, onMounted } from 'vue'

// reactive state
const count = ref(0)

// functions that mutate state and trigger updates
function increment() {
  count.value++
}

// lifecycle hooks
onMounted(() => {
  console.log(`The initial count is ${count.value}.`)
})
</script>

<template>
  <button @click="increment">Count is: {{ count }}</button>
</template>
```


Everything should be covered in the above docs but ask freely to get exact pointers where you can find something in the docs/how to do something.