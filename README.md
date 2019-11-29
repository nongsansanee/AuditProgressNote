# **การติดตั้ง  inertiajs (Framework adapters)**
# 1. npm i vue --save-dev
# 2. set client side 
   * อ่านที่ https://inertiajs.com/client-side-setup
   ## 2.1 npm install @inertiajs/inertia @inertiajs/inertia-vue
   ## 2.2 Initialize app โดย เพิ่ม code ที่ /resources/js/app.js
        
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
        
   ## 2.3 ทดลอง สร้าง floder/file.vue  ใน /resources/js/  Ext.   /Pages/Welcome.vue
        <template>
         <div>
            <h1>Welcome</h1>
         </div>
        </template>

   ## 2.4 config  ใน webpack.mix.js เพื่อให้ compile js 
    
    ...
    mix.js('resources/js/app.js','public/js')
    ...
    

# 3. set server side 
 * อ่านที่ https://inertiajs.com/server-side-setup
 ## 3.1 composer require inertiajs/inertia-laravel

 ## 3.2 setup the root template  โดย   create file /views/app.blade.php
    แล้วใส่  code ตามคู่มือ ดังนี้
     
    <!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
      </head>
      <body>
        @inertia
      </body>
    </html>
    
# 4. ทดลอง สร้าง route ที่ web.php
```javascript
  use Inertia\Inertia;
  Route::get('/welcome', function () {
     return Inertia::render('Welcome',[]);
  });
  ```

# 5. npm run dev
