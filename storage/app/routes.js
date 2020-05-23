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
      icon: 'mdi-chevron-up',
      'icon-alt': 'mdi-chevron-down',
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
      icon: 'mdi-chevron-up',
      'icon-alt': 'mdi-chevron-down',
      affix: true
    },
    children: [
      {
        id: 10,
        name: 'routeTable',
        path: 'table',
        component: () => import('@/views/route/table'),
        meta: {
          title: 'routeTable',
          icon: 'mdi-router',
          affix: true
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
      icon: 'mdi-chevron-up',
      'icon-alt': 'mdi-chevron-down'
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