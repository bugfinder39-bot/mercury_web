import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
import layout from './layout'
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
* @see \App\Http\Controllers\Admin\DashboardWidgetController::reset
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
export const reset = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reset.url(options),
    method: 'post',
})

reset.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/reset',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::reset
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
reset.url = (options?: RouteQueryOptions) => {
    return reset.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::reset
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
reset.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: reset.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::reset
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
    const resetForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: reset.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::reset
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:143
 * @route '/admin/dashboard-widgets/reset'
 */
        resetForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: reset.url(options),
            method: 'post',
        })
    
    reset.form = resetForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
export const exportMethod = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportMethod.url(options),
    method: 'get',
})

exportMethod.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard-widgets/export',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportMethod.url = (options?: RouteQueryOptions) => {
    return exportMethod.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportMethod.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: exportMethod.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
exportMethod.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: exportMethod.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
    const exportMethodForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: exportMethod.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
        exportMethodForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportMethod.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::exportMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:156
 * @route '/admin/dashboard-widgets/export'
 */
        exportMethodForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: exportMethod.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    exportMethod.form = exportMethodForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
export const importMethod = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importMethod.url(options),
    method: 'post',
})

importMethod.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/import',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
importMethod.url = (options?: RouteQueryOptions) => {
    return importMethod.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
importMethod.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: importMethod.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
    const importMethodForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: importMethod.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::importMethod
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:197
 * @route '/admin/dashboard-widgets/import'
 */
        importMethodForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: importMethod.url(options),
            method: 'post',
        })
    
    importMethod.form = importMethodForm
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
export const data = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: data.url(options),
    method: 'get',
})

data.definition = {
    methods: ["get","head"],
    url: '/admin/dashboard-widgets/data',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
data.url = (options?: RouteQueryOptions) => {
    return data.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
data.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: data.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
data.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: data.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
    const dataForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: data.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
        dataForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: data.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::data
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:253
 * @route '/admin/dashboard-widgets/data'
 */
        dataForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: data.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    data.form = dataForm
const dashboardWidgets = {
    index: Object.assign(index, index),
update: Object.assign(update, update),
layout: Object.assign(layout, layout),
reset: Object.assign(reset, reset),
export: Object.assign(exportMethod, exportMethod),
import: Object.assign(importMethod, importMethod),
data: Object.assign(data, data),
}

export default dashboardWidgets