import { queryParams, type RouteQueryOptions, type RouteDefinition, applyUrlDefaults } from './../../../wayfinder'
import items from './items'
/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
export const update = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put"],
    url: '/admin/sections/{section}',
} satisfies RouteDefinition<["put"]>

/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
update.url = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { section: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'id' in args) {
            args = { section: args.id }
        }
    
    if (Array.isArray(args)) {
        args = {
                    section: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        section: typeof args.section === 'object'
                ? args.section.id
                : args.section,
                }

    return update.definition.url
            .replace('{section}', parsedArgs.section.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \App\Http\Controllers\Admin\PageController::update
 * @see app/Http/Controllers/Admin/PageController.php:77
 * @route '/admin/sections/{section}'
 */
update.put = (args: { section: number | { id: number } } | [section: number | { id: number } ] | number | { id: number }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
const sections = {
    update: Object.assign(update, update),
items: Object.assign(items, items),
}

export default sections