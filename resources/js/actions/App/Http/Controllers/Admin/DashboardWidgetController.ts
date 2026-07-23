import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard-widgets',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::index
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:30
 * @route '/admin/dashboard-widgets'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:54
 * @route '/admin/dashboard-widgets/{id}'
 */
export const update = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/dashboard-widgets/{id}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:54
 * @route '/admin/dashboard-widgets/{id}'
 */
update.url = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { id: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    id: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        id: args.id,
                }

    return update.definition.url
            .replace('{id}', parsedArgs.id.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:54
 * @route '/admin/dashboard-widgets/{id}'
 */
update.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:54
 * @route '/admin/dashboard-widgets/{id}'
 */
    const updateForm = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:54
 * @route '/admin/dashboard-widgets/{id}'
 */
        updateForm.put = (args: { id: string | number } | [id: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::updateLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
export const updateLayout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateLayout.url(options),
    method: 'post',
})

updateLayout.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/layout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::updateLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
updateLayout.url = (options?: RouteQueryOptions) => {
    return updateLayout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::updateLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
updateLayout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: updateLayout.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::updateLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
    const updateLayoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: updateLayout.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::updateLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
        updateLayoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: updateLayout.url(options),
            method: 'post',
        })
    
    updateLayout.form = updateLayoutForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::resetLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
export const resetLayout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resetLayout.url(options),
    method: 'post',
})

resetLayout.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/reset',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::resetLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
resetLayout.url = (options?: RouteQueryOptions) => {
    return resetLayout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::resetLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
resetLayout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: resetLayout.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::resetLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
    const resetLayoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: resetLayout.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::resetLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
        resetLayoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: resetLayout.url(options),
            method: 'post',
        })
    
    resetLayout.form = resetLayoutForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
export const exportLayout = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportLayout.url(options),
    method: 'get',
})

exportLayout.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard-widgets/export',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportLayout.url = (options?: RouteQueryOptions) => {
    return exportLayout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportLayout.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportLayout.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportLayout.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: exportLayout.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
    const exportLayoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: exportLayout.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
        exportLayoutForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportLayout.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
        exportLayoutForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportLayout.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    exportLayout.form = exportLayoutForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
export const importLayout = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importLayout.url(options),
    method: 'post',
})

importLayout.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/import',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
importLayout.url = (options?: RouteQueryOptions) => {
    return importLayout.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
importLayout.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importLayout.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
    const importLayoutForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: importLayout.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importLayout
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
        importLayoutForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: importLayout.url(options),
            method: 'post',
        })
    
    importLayout.form = importLayoutForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
export const getWidgetData = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getWidgetData.url(options),
    method: 'get',
})

getWidgetData.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard-widgets/data',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
getWidgetData.url = (options?: RouteQueryOptions) => {
    return getWidgetData.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
getWidgetData.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getWidgetData.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
getWidgetData.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getWidgetData.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
    const getWidgetDataForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getWidgetData.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
        getWidgetDataForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getWidgetData.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::getWidgetData
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
        getWidgetDataForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getWidgetData.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getWidgetData.form = getWidgetDataForm
const DashboardWidgetController = { index, update, updateLayout, resetLayout, exportLayout, importLayout, getWidgetData }

export default DashboardWidgetController