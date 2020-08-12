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
    id: 17,
    name: 'icons',
    path: '/icons',
    component: Layout,
    meta: {
      icon: 'mdi-tools'
    },
    alwaysShow: true,
    children: [
      {
        id: 16,
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
    redirect: 'noRedirect',
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
    id: 22,
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
        id: 21,
        path: 'index',
        component: () => import('@/views/error-log/index'),
        meta: {
          title: 'errorLog'
        }
      }
    ]
  },
  {
    id: 24,
    path: '/profile',
    component: Layout,
    redirect: '/profile/index',
    meta: [],
    hidden: true,
    children: [
      {
        id: 23,
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
  },
  {
    id: 32,
    name: 'Table',
    path: '/table',
    component: Layout,
    redirect: '/table/complex-table',
    meta: {
      title: 'table',
      icon: 'mdi-table'
    },
    children: [
      {
        id: 30,
        name: 'DynamicTable',
        path: 'dynamic-table',
        component: () => import('@/views/table/dynamic-table/index'),
        meta: {
          title: 'dynamicTable'
        }
      },
      {
        id: 31,
        name: 'ComplexTable',
        path: 'complex-table',
        component: () => import('@/views/table/complex-table'),
        meta: {
          title: 'complexTable'
        }
      }
    ]
  },
  {
    id: 36,
    name: 'Example',
    path: '/example',
    component: Layout,
    redirect: '/example/list',
    meta: {
      title: 'example',
      icon: 'mdi-orbit'
    },
    alwaysShow: true,
    children: [
      {
        id: 33,
        name: 'ArticleList',
        path: 'list',
        component: () => import('@/views/example/list'),
        meta: {
          title: 'articleList',
          icon: 'mdi-playlist-edit'
        }
      },
      {
        id: 34,
        name: 'CreateArticle',
        path: 'create',
        component: () => import('@/views/example/create'),
        meta: {
          icon: 'mdi-pencil-box',
          title: 'createArticle'
        }
      },
      {
        id: 35,
        name: 'EditArticle',
        path: 'edit/:id(\\d+)',
        component: () => import('@/views/example/edit'),
        meta: {
          title: 'editArticle',
          noCache: true,
          activeMenu: '/example/list'
        },
        hidden: true
      }
    ]
  },
  {
    id: 43,
    name: 'Game',
    path: '/game',
    component: Layout,
    redirect: '/game/server-list',
    meta: {
      title: 'game',
      icon: 'mdi-gamepad-variant'
    },
    children: [
      {
        id: 37,
        name: 'ServerList',
        path: '/game/server-list',
        component: () => import('@/views/game/server-list'),
        meta: {
          icon: 'mdi-format-list-bulleted',
          title: 'serverList'
        }
      },
      {
        id: 38,
        name: 'ServerOptList',
        path: '/game/server-opt-list',
        component: () => import('@/views/game/server-opt-list'),
        meta: {
          icon: 'mdi-format-list-checks',
          title: 'serverOptList'
        }
      },
      {
        id: 39,
        name: 'ServerCreate',
        path: 'server-create',
        component: () => import('@/views/game/server-create'),
        meta: {
          title: 'serverCreate'
        },
        hidden: true
      },
      {
        id: 40,
        name: 'ServerEdit',
        path: 'server-edit/:id(\\d+)',
        component: () => import('@/views/game/server-edit'),
        meta: {
          title: 'serverEdit'
        },
        hidden: true
      },
      {
        id: 41,
        name: 'ServerOptCreate',
        path: 'server-opt-create',
        component: () => import('@/views/game/server-opt-create'),
        meta: {
          title: 'serverOptCreate'
        },
        hidden: true
      },
      {
        id: 42,
        name: 'ServerOptEdit',
        path: 'server-opt-edit/:id(\\d+)',
        component: () => import('@/views/game/server-opt-edit'),
        meta: {
          title: 'serverOptEdit'
        },
        hidden: true
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
  },
  {
    id: 29,
    name: 'Nested',
    path: '/nested',
    component: Layout,
    redirect: '/nested/menu1/menu1-1',
    meta: {
      title: 'nested',
      icon: 'mdi-view-list'
    },
    children: [
      {
        id: 27,
        name: 'Menu1',
        path: 'menu1',
        component: () => import('@/views/nested/menu1/index'),
        redirect: '/nested/menu1/menu1-1',
        meta: {
          title: 'menu1'
        },
        children: [
          {
            id: 25,
            name: 'Menu1-1',
            path: 'menu1-1',
            component: () => import('@/views/nested/menu1/menu1-1'),
            meta: {
              title: 'menu1-1'
            }
          },
          {
            id: 26,
            name: 'Menu1-2',
            path: 'menu1-2',
            component: () => import('@/views/nested/menu1/menu1-2'),
            meta: {
              title: 'menu1-2'
            }
          }
        ]
      },
      {
        id: 28,
        name: 'Menu2',
        path: 'menu2',
        component: () => import('@/views/nested/menu2/index'),
        meta: {
          title: 'menu2'
        }
      }
    ]
  }
]