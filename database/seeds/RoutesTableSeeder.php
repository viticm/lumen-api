<?php

use App\Models\Role;
use App\Models\Route;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

global $list, $list_new;

$list = "
[{
		\"path\": \"/redirect\",
		\"component\": \"layout/Layout\",
		\"hidden\": true,
		\"constant\": true,
		\"children\": [{
			\"path\": \"/redirect/:path*\",
			\"component\": \"views/redirect/index\"
		}]
	},
	{
		\"path\": \"/login\",
		\"constant\": true,
		\"component\": \"views/login/index\",
		\"hidden\": true
	},
	{
		\"path\": \"/auth-redirect\",
		\"constant\": true,
		\"component\": \"views/login/auth-redirect\",
		\"hidden\": true
	},
	{
		\"path\": \"/404\",
		\"constant\": true,
		\"component\": \"views/error-page/404\",
		\"hidden\": true
	},
	{
		\"path\": \"/401\",
		\"constant\": true,
		\"component\": \"views/error-page/401\",
		\"hidden\": true
	},
	{
		\"path\": \"\",
		\"constant\": true,
		\"component\": \"layout/Layout\",
		\"redirect\": \"dashboard\",
		\"children\": [{
			\"path\": \"dashboard\",
			\"component\": \"views/dashboard/index\",
			\"name\": \"Dashboard\",
			\"meta\": {
				\"title\": \"dashboard\",
				\"icon\": \"dashboard\",
				\"affix\": true
			}
		}]
	},
	{
		\"path\": \"/documentation\",
		\"component\": \"layout/Layout\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/documentation/index\",
			\"name\": \"Documentation\",
			\"meta\": {
				\"title\": \"documentation\",
				\"icon\": \"documentation\",
				\"affix\": true
			}
		}]
	},
	{
		\"path\": \"/guide\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/guide/index\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/guide/index\",
			\"name\": \"Guide\",
			\"meta\": {
				\"title\": \"guide\",
				\"icon\": \"guide\",
				\"noCache\": true
			}
		}]
	},
	{
		\"path\": \"/permission\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/permission/index\",
		\"alwaysShow\": true,
		\"meta\": {
			\"title\": \"permission\",
			\"icon\": \"lock\",
			\"roles\": [
				\"admin\",
				\"editor\"
			]
		},
		\"children\": [{
				\"path\": \"page\",
				\"component\": \"views/permission/page\",
				\"name\": \"PagePermission\",
				\"meta\": {
					\"title\": \"pagePermission\",
					\"roles\": [
						\"admin\"
					]
				}
			},
			{
				\"path\": \"directive\",
				\"component\": \"views/permission/directive\",
				\"name\": \"DirectivePermission\",
				\"meta\": {
					\"title\": \"directivePermission\"
				}
			},
			{
				\"path\": \"role\",
				\"component\": \"views/permission/role\",
				\"name\": \"RolePermission\",
				\"meta\": {
					\"title\": \"rolePermission\",
					\"roles\": [
						\"admin\"
					]
				}
			}
		]
	},
	{
		\"path\": \"/icon\",
		\"component\": \"layout/Layout\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/icons/index\",
			\"name\": \"Icons\",
			\"meta\": {
				\"title\": \"icons\",
				\"icon\": \"icon\",
				\"noCache\": true
			}
		}]
	},
	{
		\"path\": \"/components\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"name\": \"ComponentDemo\",
		\"meta\": {
			\"title\": \"components\",
			\"icon\": \"component\"
		},
		\"children\": [{
				\"path\": \"tinymce\",
				\"component\": \"views/components-demo/tinymce\",
				\"name\": \"TinymceDemo\",
				\"meta\": {
					\"title\": \"tinymce\"
				}
			},
			{
				\"path\": \"markdown\",
				\"component\": \"views/components-demo/markdown\",
				\"name\": \"MarkdownDemo\",
				\"meta\": {
					\"title\": \"markdown\"
				}
			},
			{
				\"path\": \"json-editor\",
				\"component\": \"views/components-demo/json-editor\",
				\"name\": \"JsonEditorDemo\",
				\"meta\": {
					\"title\": \"jsonEditor\"
				}
			},
			{
				\"path\": \"split-pane\",
				\"component\": \"views/components-demo/split-pane\",
				\"name\": \"SplitpaneDemo\",
				\"meta\": {
					\"title\": \"splitPane\"
				}
			},
			{
				\"path\": \"avatar-upload\",
				\"component\": \"views/components-demo/avatar-upload\",
				\"name\": \"AvatarUploadDemo\",
				\"meta\": {
					\"title\": \"avatarUpload\"
				}
			},
			{
				\"path\": \"dropzone\",
				\"component\": \"views/components-demo/dropzone\",
				\"name\": \"DropzoneDemo\",
				\"meta\": {
					\"title\": \"dropzone\"
				}
			},
			{
				\"path\": \"sticky\",
				\"component\": \"views/components-demo/sticky\",
				\"name\": \"StickyDemo\",
				\"meta\": {
					\"title\": \"sticky\"
				}
			},
			{
				\"path\": \"count-to\",
				\"component\": \"views/components-demo/count-to\",
				\"name\": \"CountToDemo\",
				\"meta\": {
					\"title\": \"countTo\"
				}
			},
			{
				\"path\": \"mixin\",
				\"component\": \"views/components-demo/mixin\",
				\"name\": \"ComponentMixinDemo\",
				\"meta\": {
					\"title\": \"componentMixin\"
				}
			},
			{
				\"path\": \"back-to-top\",
				\"component\": \"views/components-demo/back-to-top\",
				\"name\": \"BackToTopDemo\",
				\"meta\": {
					\"title\": \"backToTop\"
				}
			},
			{
				\"path\": \"drag-dialog\",
				\"component\": \"views/components-demo/drag-dialog\",
				\"name\": \"DragDialogDemo\",
				\"meta\": {
					\"title\": \"dragDialog\"
				}
			},
			{
				\"path\": \"drag-select\",
				\"component\": \"views/components-demo/drag-select\",
				\"name\": \"DragSelectDemo\",
				\"meta\": {
					\"title\": \"dragSelect\"
				}
			},
			{
				\"path\": \"dnd-list\",
				\"component\": \"views/components-demo/dnd-list\",
				\"name\": \"DndListDemo\",
				\"meta\": {
					\"title\": \"dndList\"
				}
			},
			{
				\"path\": \"drag-kanban\",
				\"component\": \"views/components-demo/drag-kanban\",
				\"name\": \"DragKanbanDemo\",
				\"meta\": {
					\"title\": \"dragKanban\"
				}
			}
		]
	},
	{
		\"path\": \"/charts\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"name\": \"Charts\",
		\"meta\": {
			\"title\": \"charts\",
			\"icon\": \"chart\"
		},
		\"children\": [{
				\"path\": \"keyboard\",
				\"component\": \"views/charts/keyboard\",
				\"name\": \"KeyboardChart\",
				\"meta\": {
					\"title\": \"keyboardChart\",
					\"noCache\": true
				}
			},
			{
				\"path\": \"line\",
				\"component\": \"views/charts/line\",
				\"name\": \"LineChart\",
				\"meta\": {
					\"title\": \"lineChart\",
					\"noCache\": true
				}
			},
			{
				\"path\": \"mixchart\",
				\"component\": \"views/charts/mixChart\",
				\"name\": \"MixChart\",
				\"meta\": {
					\"title\": \"mixChart\",
					\"noCache\": true
				}
			}
		]
	},
	{
		\"path\": \"/nested\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/nested/menu1/menu1-1\",
		\"name\": \"Nested\",
		\"meta\": {
			\"title\": \"nested\",
			\"icon\": \"nested\"
		},
		\"children\": [{
				\"path\": \"menu1\",
				\"component\": \"views/nested/menu1/index\",
				\"name\": \"Menu1\",
				\"meta\": {
					\"title\": \"menu1\"
				},
				\"redirect\": \"/nested/menu1/menu1-1\",
				\"children\": [{
						\"path\": \"menu1-1\",
						\"component\": \"views/nested/menu1/menu1-1\",
						\"name\": \"Menu1-1\",
						\"meta\": {
							\"title\": \"menu1-1\"
						}
					},
					{
						\"path\": \"menu1-2\",
						\"component\": \"views/nested/menu1/menu1-2\",
						\"name\": \"Menu1-2\",
						\"redirect\": \"/nested/menu1/menu1-2/menu1-2-1\",
						\"meta\": {
							\"title\": \"menu1-2\"
						},
						\"children\": [{
								\"path\": \"menu1-2-1\",
								\"component\": \"views/nested/menu1/menu1-2/menu1-2-1\",
								\"name\": \"Menu1-2-1\",
								\"meta\": {
									\"title\": \"menu1-2-1\"
								}
							},
							{
								\"path\": \"menu1-2-2\",
								\"component\": \"views/nested/menu1/menu1-2/menu1-2-2\",
								\"name\": \"Menu1-2-2\",
								\"meta\": {
									\"title\": \"menu1-2-2\"
								}
							}
						]
					},
					{
						\"path\": \"menu1-3\",
						\"component\": \"views/nested/menu1/menu1-3\",
						\"name\": \"Menu1-3\",
						\"meta\": {
							\"title\": \"menu1-3\"
						}
					}
				]
			},
			{
				\"path\": \"menu2\",
				\"name\": \"Menu2\",
				\"component\": \"views/nested/menu2/index\",
				\"meta\": {
					\"title\": \"menu2\"
				}
			}
		]
	},
	{
		\"path\": \"/example\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/example/list\",
		\"name\": \"Example\",
		\"meta\": {
			\"title\": \"example\",
			\"icon\": \"example\"
		},
		\"children\": [{
				\"path\": \"create\",
				\"component\": \"views/example/create\",
				\"name\": \"CreateArticle\",
				\"meta\": {
					\"title\": \"createArticle\",
					\"icon\": \"edit\"
				}
			},
			{
				\"path\": \"edit/:id(\\\\d+)\",
				\"component\": \"views/example/edit\",
				\"name\": \"EditArticle\",
				\"meta\": {
					\"title\": \"editArticle\",
					\"noCache\": true
				},
				\"hidden\": true
			},
			{
				\"path\": \"list\",
				\"component\": \"views/example/list\",
				\"name\": \"ArticleList\",
				\"meta\": {
					\"title\": \"articleList\",
					\"icon\": \"list\"
				}
			}
		]
	},
	{
		\"path\": \"/tab\",
		\"component\": \"layout/Layout\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/tab/index\",
			\"name\": \"Tab\",
			\"meta\": {
				\"title\": \"tab\",
				\"icon\": \"tab\"
			}
		}]
	},
	{
		\"path\": \"/error\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"name\": \"ErrorPages\",
		\"meta\": {
			\"title\": \"errorPages\",
			\"icon\": \"404\"
		},
		\"children\": [{
				\"path\": \"401\",
				\"component\": \"views/error-page/401\",
				\"name\": \"Page401\",
				\"meta\": {
					\"title\": \"page401\",
					\"noCache\": true
				}
			},
			{
				\"path\": \"404\",
				\"component\": \"views/error-page/404\",
				\"name\": \"Page404\",
				\"meta\": {
					\"title\": \"page404\",
					\"noCache\": true
				}
			}
		]
	},
	{
		\"path\": \"/error-log\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"children\": [{
			\"path\": \"log\",
			\"component\": \"views/error-log/index\",
			\"name\": \"ErrorLog\",
			\"meta\": {
				\"title\": \"errorLog\",
				\"icon\": \"bug\"
			}
		}]
	},
	{
		\"path\": \"/excel\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/excel/export-excel\",
		\"name\": \"Excel\",
		\"meta\": {
			\"title\": \"excel\",
			\"icon\": \"excel\"
		},
		\"children\": [{
				\"path\": \"export-excel\",
				\"component\": \"views/excel/export-excel\",
				\"name\": \"ExportExcel\",
				\"meta\": {
					\"title\": \"exportExcel\"
				}
			},
			{
				\"path\": \"export-selected-excel\",
				\"component\": \"views/excel/select-excel\",
				\"name\": \"SelectExcel\",
				\"meta\": {
					\"title\": \"selectExcel\"
				}
			},
			{
				\"path\": \"export-merge-header\",
				\"component\": \"views/excel/merge-header\",
				\"name\": \"MergeHeader\",
				\"meta\": {
					\"title\": \"mergeHeader\"
				}
			},
			{
				\"path\": \"upload-excel\",
				\"component\": \"views/excel/upload-excel\",
				\"name\": \"UploadExcel\",
				\"meta\": {
					\"title\": \"uploadExcel\"
				}
			}
		]
	},
	{
		\"path\": \"/zip\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/zip/download\",
		\"alwaysShow\": true,
		\"meta\": {
			\"title\": \"zip\",
			\"icon\": \"zip\"
		},
		\"children\": [{
			\"path\": \"download\",
			\"component\": \"views/zip/index\",
			\"name\": \"ExportZip\",
			\"meta\": {
				\"title\": \"exportZip\"
			}
		}]
	},
	{
		\"path\": \"/pdf\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"/pdf/index\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/pdf/index\",
			\"name\": \"PDF\",
			\"meta\": {
				\"title\": \"pdf\",
				\"icon\": \"pdf\"
			}
		}]
	},
	{
		\"path\": \"/pdf/download\",
		\"component\": \"views/pdf/download\",
		\"hidden\": true
	},
	{
		\"path\": \"/theme\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/theme/index\",
			\"name\": \"Theme\",
			\"meta\": {
				\"title\": \"theme\",
				\"icon\": \"theme\"
			}
		}]
	},
	{
		\"path\": \"/clipboard\",
		\"component\": \"layout/Layout\",
		\"redirect\": \"noRedirect\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/clipboard/index\",
			\"name\": \"ClipboardDemo\",
			\"meta\": {
				\"title\": \"clipboardDemo\",
				\"icon\": \"clipboard\"
			}
		}]
	},
	{
		\"path\": \"/i18n\",
		\"component\": \"layout/Layout\",
		\"children\": [{
			\"path\": \"index\",
			\"component\": \"views/i18n-demo/index\",
			\"name\": \"I18n\",
			\"meta\": {
				\"title\": \"i18n\",
				\"icon\": \"international\"
			}
		}]
	},
	{
		\"path\": \"external-link\",
		\"component\": \"layout/Layout\",
		\"children\": [{
			\"path\": \"https://github.com/PanJiaChen/vue-element-admin\",
			\"meta\": {
				\"title\": \"externalLink\",
				\"icon\": \"link\"
			}
		}]
	},
	{
		\"path\": \"*\",
		\"redirect\": \"/404\",
		\"hidden\": true
	}
]
";

$list_new = "
[   {
		\"path\": \"/redirect\",
		\"component\": \"Layout\",
		\"hidden\": true,
		\"constant\": true,
		\"children\": [{
			\"path\": \"/redirect/:path*\",
			\"component\": \"views/redirect\"
		}]
	},
	{
		\"path\": \"/signin\",
		\"constant\": true,
		\"component\": \"views/signin\",
		\"hidden\": true
	},
	{
		\"path\": \"/auth-redirect\",
		\"constant\": true,
		\"component\": \"views/auth-redirect\",
		\"hidden\": true
	},
	{
		\"path\": \"/404\",
		\"constant\": true,
		\"component\": \"views/error-page/404\",
		\"hidden\": true
	},
	{
		\"path\": \"/401\",
		\"constant\": true,
		\"component\": \"views/error-page/401\",
		\"hidden\": true
	},
	{
		\"path\": \"/\",
		\"constant\": true,
		\"component\": \"Layout\",
		\"redirect\": \"/dashboard\",
        \"meta\": {
            \"title\": \"index\",
            \"icon\": \"mdi-chevron-up\",
            \"icon-alt\": \"mdi-chevron-down\",
            \"affix\": true
        },
        \"children\": [
        {
			\"path\": \"dashboard\",
			\"component\": \"views/dashboard\",
			\"name\": \"Dashboard\",
			\"meta\": {
				\"title\": \"dashboard\",
				\"icon\": \"mdi-view-dashboard\",
				\"affix\": true
			}
        },
        {
			\"path\": \"settings\",
			\"component\": \"views/settings\",
			\"name\": \"settings\",
			\"meta\": {
				\"title\": \"settings\",
				\"icon\": \"mdi-image-filter-vintage\",
				\"affix\": true
			}
        }
        ]
    },
    {
        \"path\": \"/route\",
        \"component\": \"Layout\",
        \"redirect\": \"/route/table\",
        \"name\": \"route\",
        \"meta\": {
            \"title\": \"routes\",
            \"icon\": \"mdi-chevron-up\",
            \"icon-alt\": \"mdi-chevron-down\",
            \"affix\": true
        },
        \"children\": [
        {
			\"path\": \"table\",
			\"component\": \"views/route/table\",
			\"name\": \"routeTable\",
			\"meta\": {
				\"title\": \"routes\",
				\"icon\": \"mdi-router\",
				\"affix\": true
			}
        }
        ]
    }
]
";

class RoutesTableSeeder extends Seeder
{

    /**
     * Insert one data.
     *
     * @param array $array The route data.
     * @param array $ids The add all ids.
     *
     * @return integer
     */
    public function insert_one($array, &$ids)
    {
        $role = new Route();
        $children_ids = [];
        if (array_key_exists('id', $array)) { 
            unset($array['id']);
        }
        foreach ($array as $k => $v) {
            if ($k != 'children') {
                $role->$k = 'meta' == $k ? json_encode($v) : $v;
            } else {
                foreach ($v as $children){
                    $id = self::insert_one($children, $ids);
                    if ($id != -1) {
                        array_push($children_ids, $id);
                    }
                }
            }
        }
        if (count($children_ids) > 0) {
            $role->children = implode(":", $children_ids);
        }
        if ($role->save()) {
            array_push($ids, $role->id);
            return $role->id;
        }
        return -1;
    }

    /**
     * Set role routes.
     *
     * @return void
     */
    public function set_role_routes($key, $routes = [])
    {
        $row = Role::where('key', $key)->first();
        if (!is_null($row)) {
            $row->routes = implode(':', $routes);
            $row->save();
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        global $list_new;
        $fileStr = Storage::get('routes.json');
		$array = json_decode($fileStr ? $fileStr : $list_new, true);
        $admin_ids = [];
        $editor_ids = [];
        $visitor_ids = [];
        foreach ($array as $val) {
            $val['root'] = true;
            $ids = [];
            $this->insert_one($val, $ids);
            if (count($ids) > 0) {
                $path = $val['path'];
                if ('/' === $path) {
                    $visitor_ids = array_merge($visitor_ids, $ids);
                } 
                if ($path !== '/permission') {
                    $editor_ids = array_merge($editor_ids, $ids);
                }
                $admin_ids = array_merge($admin_ids, $ids);
            }
         }
        $this->set_role_routes('admin', $admin_ids);
        $this->set_role_routes('editor', $editor_ids);
        $this->set_role_routes('visitor', $visitor_ids);
    }

}
