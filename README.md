# 1. npm i vue --save-dev
# 2. set client side 
   * อ่านที่ https://inertiajs.com/client-side-setup
   ## 2.1 npm install @inertiajs/inertia @inertiajs/inertia-vue
   ## 2.2 Initialize app โดย เพิ่ม code ที่ /resources/js/app.js
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
   ## 2.3 ทดลอง สร้าง floder/file.vue  ใน /resources/js/  Ext.   /Pages/Welcome.vue

   ## 2.4 config  ใน webpack.mix.js เพื่อให้ compile js 
    ```
    mix.js('resources/js/app.js','public/js')
     ```

# 3. set server side 
 * composer require inertiajs/inertia-laravel

# /views  create file app.blade.php
# web.php
```
  use Inertia\Inertia;
 Route::get('/welcome', function () {
    return Inertia::render('Welcome',[]);
});
```
