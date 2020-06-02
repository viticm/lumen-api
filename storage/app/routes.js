/* This file is generate by lumen api(leafly) */

import Layout from '@/layout'

/**
 * constantRoutes
 * a base page that does not have permission requirements
 * all roles can be accessed
 */
export const constantRoutes = [
  {
    id: 2,
    path: '/redirect',
    component: Layout,
    hidden: true,
    children: [
      {
        id: 1,
        path: '/redirect/:path*',
        component: () => import('@/views/redirect')
      }
    ]
  },
  {
    id: 3,
    path: '/signin',
    component: () => import('@/views/signin'),
    hidden: true
  },
  {
    id: 4,
    path: '/auth-redirect',
    component: () => import('@/views/auth-redirect'),
    hidden: true
  },
  {
    id: 5,
    path: '/404',
    component: () => import('@/views/error-page/404'),
    hidden: true
  },
  {
    id: 6,
    path: '/401',
    component: () => import('@/views/error-page/401'),
    hidden: true
  },
  {
    id: 9,
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    meta: {
      title: 'index',
      icon: 'mdi-home',
      affix: true
    },
    children: [
      {
        id: 7,
        name: 'Dashboard',
        path: 'dashboard',
        component: () => import('@/views/dashboard'),
        meta: {
          title: 'dashboard',
          icon: 'mdi-view-dashboard',
          affix: true
        }
      },
      {
        id: 8,
        name: 'settings',
        path: 'settings',
        component: () => import('@/views/settings'),
        meta: {
          title: 'settings',
          icon: 'mdi-image-filter-vintage',
          affix: true
        }
      }
    ]
  },
  {
    id: 16,
    name: 'icons',
    path: '/icons',
    component: Layout,
    meta: {
      icon: 'mdi-tools'
    },
    alwaysShow: true,
    children: [
      {
        id: 17,
        name: 'IconShow',
        path: 'index',
        component: () => import('@/views/icons'),
        meta: {
          title: 'icons'
        }
      }
    ]
  },
  {
    id: 20,
    name: 'ErrorPages',
    path: '/error',
    component: Layout,
    meta: {
      title: 'errorPages',
      icon: 'mdi-alert-decagram-outline'
    },
    alwaysShow: true,
    children: [
      {
        id: 18,
        name: 'Page401',
        path: '401',
        component: () => import('@/views/error-page/401'),
        meta: {
          title: 'page401',
          noCache: true
        }
      },
      {
        id: 19,
        name: 'Page404',
        path: '404',
        component: () => import('@/views/error-page/404'),
        meta: {
          title: 'page404',
          noCache: true
        }
      }
    ]
  },
  {
    id: 21,
    path: '/error-log',
    component: Layout,
    meta: {
      icon: 'mdi-bug',
      title: 'errorLog',
      'icon-alt': 'mdi-bug'
    },
    alwaysShow: true,
    children: [
      {
        id: 22,
        path: 'index',
        component: () => import('@/views/error-log/index'),
        meta: {
          title: 'errorLog'
        }
      }
    ]
  },
  {
    id: 23,
    path: '/profile',
    component: Layout,
    redirect: '/profile/index',
    meta: {},
    hidden: true,
    children: [
      {
        id: 24,
        name: 'Profile',
        path: 'index',
        component: () => import('@/views/profile/index'),
        meta: {
          title: 'profile',
          noCache: true,
          icon: 'mdi-account-cog'
        }
      }
    ]
  }
]

/**
 * asyncRoutes
 * the routes that need to be dynamically loaded based on user roles
 */
export const asyncRoutes = [
  {
    id: 11,
    name: 'route',
    path: '/route',
    component: Layout,
    redirect: '/route/table',
    meta: {
      title: 'routes',
      icon: 'mdi-router-network'
    },
    children: [
      {
        id: 10,
        name: 'routeTable',
        path: 'table',
        component: () => import('@/views/route/table'),
        meta: {
          title: 'routeTable',
          icon: 'mdi-router'
        }
      }
    ]
  },
  {
    id: 15,
    name: 'Permission',
    path: '/permission',
    component: Layout,
    redirect: '/permission/page',
    meta: {
      title: 'permission',
      icon: 'mdi-security'
    },
    alwaysShow: true,
    children: [
      {
        id: 12,
        name: 'PagePermission',
        path: 'page',
        component: () => import('@/views/permission/page'),
        meta: {
          title: 'pagePermission'
        }
      },
      {
        id: 13,
        name: 'DirectivePermission',
        path: 'directive',
        component: () => import('@/views/permission/directive'),
        meta: {
          title: 'directivePermission'
        }
      },
      {
        id: 14,
        name: 'RolePermission',
        path: 'role',
        component: () => import('@/views/permission/role'),
        meta: {
          title: 'rolePermission'
        }
      }
    ]
  }
]