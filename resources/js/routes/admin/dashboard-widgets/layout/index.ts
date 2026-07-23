import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
export const update = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

update.definition = {
    methods: ["post"],
    url: '/admin/dashboard-widgets/layout',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
update.url = (options?: RouteQueryOptions) => {
    return update.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
update.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: update.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
    const updateForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\Admin\DashboardWidgetController::update
 * @see app/Http/Controllers/Admin/DashboardWidgetController.php:89
 * @route '/admin/dashboard-widgets/layout'
 */
        updateForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(options),
            method: 'post',
        })
    
    update.form = updateForm
const layout = {
    update: Object.assign(update, update),
}

export default layout