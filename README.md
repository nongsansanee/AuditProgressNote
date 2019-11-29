# client side  
  * npm i vue --save-dev
# https://inertiajs.com/
```
import { InertiaApp } from '@inertiajs/inertia-vue'
import Vue from 'vue'

Vue.use(InertiaApp)

const app = document.getElementById('app')

new Vue({
  render: h => h(InertiaApp, {
    props: {
      initialPage: JSON.parse(app.dataset.page),
      resolveComponent: name => require(`./Pages/${name}`).default,
    },
  }),
}).$mount(app)
```
# สร้าง floder/file.vue  Ext.   /Pages/Welcome.vue

# ใน webpack mix.js('resources/js/app.js','public/js') 

# server side 
 * composer require inertiajs/inertia-laravel

# /views  create file app.blade.php
# web.php
```
  use Inertia\Inertia;
 Route::get('/welcome', function () {
    return Inertia::render('Welcome',[]);
});
```