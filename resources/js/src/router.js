import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: '/',
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes: [

    {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
      path: '/',
      component: () => import('./layouts/main/Main.vue'),
      children: [

        {
          path: '/admin/areas',
          name: '/admin/areas',
          component: () => import('./views/pages/areas/index.vue'),
        },

        {
          path: '/',
          redirect: '/admin/areas'
        },
      ]
    },

    // Redirect to 404 page, if no match found
    {
      path: '*',
      redirect: '/pages/error-404'
    }
  ]
})

router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

router.beforeEach((to, from, next) => {
    // If auth required, check login. If login fails redirect to login page
    if (to.meta.authRequired) {
      if (!(auth.isAuthenticated())) {
        router.push({ path: '/pages/login', query: { to: to.path } })
      }
    }

    return next()

  })


export default router
